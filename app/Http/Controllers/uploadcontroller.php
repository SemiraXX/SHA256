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
        ]);

        $fileName = $request->input('fileName');
        $fileCateg = $request->input('fileCateg');
        $SHA256 = $request->input('filehashcode');

        #create uniquefile ID
        $lastID = DB::table('tbl_savedfiles')->orderBy('id', 'DESC')->first();
            if($lastID)
            {
                $VALlastID = 1 + $lastID->id;
                $fileID = "CERT_".$VALlastID;
            }
            else
            {
                $fileID = "CERT_1";
            }


        //check if already exist or not
        $existalready = DB::table('tbl_savedfiles')->get();
        foreach($existalready as $list)
        {
            $test = password_verify($SHA256, $list->SHA256Argon2);

            if($test) 
            {
                return back()->with('success', "Failed, file exist already!");
            }
            else
            {

            }
        }


         #use Argon2 to secure hash code
         $Argon2 = password_hash($SHA256, PASSWORD_ARGON2ID);
      
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


            $savedfiles = new savedfiles([
                    'fileID' => $fileID,
                    'fileName' => $fileName,
                    'fileCateg' => $fileCateg,
                    'SHA256Argon2' => $Argon2,
                    'postedBy' => $postedBy,
                    'postedDate' => NOW()
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
