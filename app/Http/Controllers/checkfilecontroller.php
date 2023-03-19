<?php

namespace App\Http\Controllers;
use App\Models\savedfiles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class checkfilecontroller extends Controller
{
    //view checkfile page
    public function viewcheckfile(Request $request){

        $allfiles = savedfiles::all();

        return view('index',
        ['allfiles' => $allfiles]);  
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

                $result = "<p class='resultlabel1'><strong>Remarks:</strong> File is authentic</p>";
            }
            else
            {
                $result = "<p class='resultlabel2'><strong>Remarks:</strong> File is NOT authentic</p>";
            }

            $date = NOW();
            $ip = $request->ip();
            $browser = $request->userAgent();

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
                <strong>F1 SHA256:</strong> $filehashcode <br>
                <strong>Orginal file ID:</strong> $originalfileID <br>
                <strong>Admin:</strong> Maiky Belmonte <br>
                <strong>IP Address:</strong> $ip <br>
                <strong>Browser:</strong> $browser <br>
                <br>
                </p>
                $result

            </div>
            ";

            #end

        }
        else
        {
            echo "We can't find the original file.";
        }

    }
}
