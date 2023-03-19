<?php

namespace App\Http\Controllers;
use Session;
use App\Models\savedfiles;
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
            'postedBy' => 'required',
            'postedDate' => 'required',
        ]);

        $fileName = $request->input('fileName');
        $fileCateg = $request->input('fileCateg');
        $postedBy = $request->input('postedBy');
        $postedDate = $request->input('postedDate');
        $mainfile = $request->input('mainfile');

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

        
        #upload file to new folder
        $mainfile = $request->file('mainfile'); 
        $created = $fileID.'.'.$mainfile->extension();  
        $mainfile->move(public_path('/saved'), $created);

        #create hash
        $SHA256 = hash_file('sha256', public_path('/saved//'.$created));

        #use Argon2 to secure hash code
        $Argon2 = password_hash($SHA256, PASSWORD_ARGON2ID);

        $savedfiles = new savedfiles([
                'fileID' => $fileID,
                'fileName' => $fileName,
                'fileUrl' => $created,
                'fileCateg' => $fileCateg,
                'SHA256Argon2' => $Argon2,
                'postedBy' => $postedBy,
                'postedDate' => $postedDate
            ]);
        $savedfiles->save(); 


        return back()->with('success', "File Uploaded!");
    }
}
