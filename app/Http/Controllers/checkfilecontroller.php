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

        $reports = DB::table('tbl_reports')->orderby('id', 'Desc')->get();  

        return view('dashboard',
        ['reports' => $reports]);  
    }
    //sort dashboard
    public function sortreportsdashboard(Request $request){

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


    //upload new file to DB
    public function checkfileaunthenticity(Request $request){

        #get file hash value
        $filehashcode = $request->input('filehashcode');

        #decode original file from argon2 to sha256
        $originalfile = $request->input('originalfile');
        $fileselector = $request->input('fileselector');
        

        #check if orinal file exist in DB
        $allfiles = DB::table('tbl_savedfiles')->where('SHA256Argon2', $originalfile)->first();
        if($allfiles)
        {
            $originalfilename = $allfiles->fileName;
            $originalfileID = $allfiles->fileID;

            #compare code value
            if(password_verify($filehashcode, $originalfile)){

                $result = "<p class='resultlabel1'><strong>Remarks:</strong> File Authentic</p>";
                $remarks = "File Authentic";
                $mark = 1;
            }
            else
            {
                $result = "<p class='resultlabel2'><strong>Remarks:</strong> File Fake</p>";
                $remarks = "File Fake";
                $mark = 0;
            }

            #get user name
            if(session()->has('systemsession'))
            {
                $account = DB::table('tbl_useraccounts')->where('id', '=', session('systemsession'))->first();
                $postedBy = $account->usr_name;
            }
            else
            {
                $postedBy = "000000000";
            }

            $date = NOW();
            $ip = $request->ip();
            $browser = $request->userAgent();

            #this is save report in DB
            $reports = new reports([
                'FileUploaded' => $fileselector,
                'FileSHA256value' => $filehashcode,
                'OriginalFileID'=> $originalfileID,
                'Admin' => $postedBy,
                'Ip_add' => $ip,
                'Http_browser' => $browser,
                'Result' => $mark,
                'Remarks' => $remarks
            ]);
            $reports->save();

            $maskvalue = substr_replace($filehashcode, str_repeat('*', strlen($filehashcode)-7), 1, -6);

            #validate
            echo "
            
            <div class='resultscontainer'>

                <p class='inputlabel2'>
                <strong>Results Date:</strong> $date <br><br>
                <strong>Inputs</strong><br>
                <strong>F1:</strong> $fileselector <br>
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
                'action_taken' => "Check ".$fileselector. " file aunthenticity to ".$originalfileID. " with remarks: (".$remarks.")",
                'ip_add' => $ip,
                'http_browser' => $browser
            ]);
            $actiontrail->save(); 

            #end

        }
        else
        {
            echo "We can't find the original file.";
        }

    }
}
