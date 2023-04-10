<?php

namespace App\Http\Controllers;
use App\Models\savedfiles;
use App\Models\reports;
use App\Models\actiontrail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class checkfilecontroller extends Controller
{
    
    //view checkfile page as gust
    public function viewcheckfileasguest(Request $request){

        $allfiles = savedfiles::all();

        return view('index',
        ['allfiles' => $allfiles]);  
    }

    //view checkfile page as admin
    public function viewcheckfile(Request $request){

        $allfiles = savedfiles::all();

        return view('checkfile',
        ['allfiles' => $allfiles]);  
    }




    //view dashboard
    public function dashboardview(Request $request){

        //to clear prev session
        session()->forget('datefrom');
        session()->forget('dateto');

        $reports = DB::table('tbl_reports')->orderby('id', 'Desc')->get();  

        return view('dashboard',
        ['reports' => $reports]);  
    }
    //sort dashboard
    public function sortreportsdashboard(Request $request){

        //to clear prev session
        session()->forget('datefrom');
        session()->forget('dateto');

        //require field value
        $this->validate($request, [
            'datefrom' => 'required',
	        'dateto' => 'required'
        ]);

        $dateform = $request->input('datefrom');
        $dateto = $request->input('dateto');

        $reports = DB::table('tbl_reports')
        ->whereBetween('created_at', [$dateform, $dateto])
        ->orderby('id', 'Desc')->get();  

        return view('dashboard',
        ['reports' => $reports,
        'dateform' => $dateform,
        'dateto' => $dateto]);  
    }


    //check file
    public function checkfileaunthenticity(Request $request){

        $mainfile = $request->input('mainfile');
        $originalfile = $request->input('originalfile');
        $filehashcode = $request->input('filehashcode');
        
        $fileID = uniqid();
         

        //tempo transfer file to folder
        $mainuploadedfile = $request->file('mainfile'); 
        $uploadedfileName = $fileID.'.'.$mainuploadedfile->extension();  
        $mainuploadedfile->move(public_path("/saved"), $uploadedfileName);

    
        // Path to the file to be verified
        $file_path = "saved/".$uploadedfileName;
        $fileSHA256 =  hash_file('sha256', $file_path);
        $MYDATA = file_get_contents($file_path);


        #check if orinal file exist in DB
        $allfiles = DB::table('tbl_saved_files')->where('FileID', $originalfile)->first();
        if($allfiles)
        {
            $originalfilename = $allfiles->FileName;
            $originalfileID = $allfiles->FileID;
            $originalfilehash = $allfiles->HashValue;

            // Path to the signature file
            $signature_path = "openssl/".$allfiles->Signature;
            $public_key_path = "openssl/".$allfiles->PublicKey;
            // Read the contents of the file and the signature
            $signature = file_get_contents($signature_path);
            // Get the public key
            $public_key = openssl_get_publickey(file_get_contents($public_key_path));
            // Verify the signature
            $verified = openssl_verify($MYDATA, $signature, $public_key, OPENSSL_ALGO_SHA256);


            if ($verified == 1) {

                $result = "<p class='resultlabel1'><strong>Remarks:</strong> File Authentic</p>";
                $remarks = "File Authentic";
                $mark = 1;
            } elseif ($verified == 0) {
                $result = "<p class='resultlabel2'><strong>Remarks:</strong> File Fake</p>";
                $remarks = "File Fake";
                $mark = 0;
            } else {
                $result = "<p class='resultlabel2'><strong>Remarks:</strong> OpenSSL Error</p>";
                $remarks = " OpenSSL Error";
                $mark = 0;
            }


            // Free the key from memory
            openssl_free_key($public_key);
            unlink($file_path);


            #get user name
            if(session()->has('systemsession'))
            {
                $account = DB::table('tbl_useraccounts')->where('id', '=', session('systemsession'))->first();
                $postedBy = $account->usr_name;
            }
            else
            {
                $postedBy = "Guest";
            }



            $date = NOW();
            $ip = $request->ip();
            $browser = $request->userAgent();

            #this is save report in DB
            $reports = new reports([
                'FileUploaded' => $uploadedfileName,
                'FileSHA256value' => $fileSHA256,
                'OriginalFileID'=> $originalfileID,
                'Admin' => $postedBy,
                'Ip_add' => $ip,
                'Http_browser' => $browser,
                'Result' => $mark,
                'Remarks' => $remarks
            ]);
            $reports->save();

            $maskvalue = substr_replace($fileSHA256, str_repeat('*', strlen($fileSHA256)-7), 1, -6);

            #validate
            $date1 = "
            
            <div class='resultscontainer'>

                <p class='inputlabel2'>
                <strong>Results Date:</strong> $date <br><br>
                <strong>Inputs</strong><br>
                <strong>F1:</strong> $uploadedfileName <br>
                <strong>F2:</strong> $originalfileID - $originalfilename<br>
                <br>
                <strong>Outputs</strong><br>
                <strong>F1 SHA256:</strong> $maskvalue <br>
                <strong>Orginal file ID:</strong> $originalfileID <br>
                <strong>Admin:</strong> $postedBy <br>
                <strong>IP Address:</strong> $ip <br>
                <strong>Browser:</strong> $browser <br>
                <br>
                </p>
                $result

            </div>
            ";

           
            #actiontrail
            $actiontrail = new actiontrail([
                'user_id' => $postedBy,
                'action_taken' => "Check ".$uploadedfileName. " file aunthenticity to ".$originalfileID. " with remarks: (".$remarks.")",
                'ip_add' => $ip,
                'http_browser' => $browser
            ]);
            $actiontrail->save(); 

            return back()->with('dataresult', $date1);

            #end

        }
        else
        {
            echo "We can't find the original file.";
        }

    }
}
