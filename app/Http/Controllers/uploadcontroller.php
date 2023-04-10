<?php

namespace App\Http\Controllers;
use Session;
use App\Models\savedfiles;
use App\Models\actiontrail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class uploadcontroller extends Controller
{
    
    //upload new file to DB
    public function uploadfile(Request $request){

        $this->validate($request, [
            'fileName' => 'required',
	        'fileCateg' => 'required',
            'mainfile' => 'required'
        ]);
        
        $fileName = $request->input('fileName');
        $fileCateg = $request->input('fileCateg');
        $SHA256 = $request->input('filehashcode');
    
        #create uniquefile ID
        $lastID = DB::table('tbl_saved_files')->orderBy('id', 'DESC')->first();
            if($lastID)
            {
                $VALlastID = 1 + $lastID->id;
                $fileID = "FILE_".$VALlastID;
            }
            else
            {
                $fileID = "FILE_1";
            }

        //to transfer file
        $mainuploadedfile = $request->file('mainfile'); 
        $uploadedfileName = $fileID.'.'.$mainuploadedfile->extension();  
        $mainuploadedfile->move(public_path('/files'), $uploadedfileName);


        //check if already exist or not
        $existalready = DB::table('tbl_saved_files')->get();
        foreach($existalready as $list)
        {
            $test = password_verify($SHA256, $list->HashValue);

            if($test) 
            {
                return back()->with('success', "Failed, file exist already!");
            }
            else
            {

            }
        }

      
        #get user id
        if(session()->has('systemsession'))
        {
            $account = DB::table('tbl_useraccounts')->where('id', '=', session('systemsession'))->first();
            $postedBy = $account->usr_name;
        }
        else
        {
            $postedBy = "000000000";
        }
        

        #THIS IS FOR DSA ALGO
        $data = "/files".$uploadedfileName;


        $new_key_pair = openssl_pkey_new(array(
            "private_key_bits" => 3072,
            "private_key_type" => OPENSSL_KEYTYPE_DSA,
        ));

        openssl_pkey_export($new_key_pair, $private_key_pem);
        $details = openssl_pkey_get_details($new_key_pair);
        $public_key_pem = $details['key'];

        //create signature
        openssl_sign($data, $signature, $private_key_pem, OPENSSL_ALGO_SHA256);


        //save for later
        file_put_contents("openssl/$fileID.private_key.pem", $private_key_pem);
        file_put_contents("openssl/$fileID.public_key.pem", $public_key_pem);
        file_put_contents("openssl/$fileID.signature.dat", $signature);


        #use Argon2 to secure hash code
        $Argon2 = password_hash($SHA256, PASSWORD_ARGON2ID);

        
        //save to database
        $savedfiles = new savedfiles([
                'FileID' => $fileID,
                'FileName' => $fileName,
                'FileCateg' => $fileCateg,
                'HashValue' => $Argon2,
                'PrivateKey' => "$fileID.private_key.pem",
                'PublicKey' => "$fileID.public_key.pem",
                'Signature' => "$fileID.signature.dat",
                'PostedBy' => $postedBy,
                'PostedDate' => NOW()
            ]);
        $savedfiles->save(); 


        #actiontrail
        $actiontrail = new actiontrail([
            'user_id' => $postedBy,
            'action_taken' => "Uploaded ".$fileID. " to DB as original file copy",
            'ip_add' => $request->ip(),
            'http_browser' => $request->userAgent()
        ]);
        $actiontrail->save(); 


        return back()->with('success', "File Uploaded!");

        
    }
}
