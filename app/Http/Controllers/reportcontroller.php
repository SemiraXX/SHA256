<?php

namespace App\Http\Controllers;
use App\Models\savedfiles;
use App\Models\reports;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportcontroller extends Controller
{
    //ajax to view report
    public function viewreport(Request $request){

        $id = $request->input('id');

        $allfiles = DB::table('tbl_reports')->where('id', $id)->first();

        echo "
            
            <div class='container'>

                <p class='reportmodallabel'>
                <strong>Date Posted:</strong> $allfiles->created_at</p><br>
                <p class='reportmodallabel'>
                <strong>File Uploaded:</strong> $allfiles->FileUploaded</p>
                <p class='reportmodallabel'>
                <strong>File Uploaded SHA256:</strong> $allfiles->FileSHA256value</p>
                <p class='reportmodallabel'>
                <strong>Orginal File ID:</strong> $allfiles->OriginalFileID</p>
                <p class='reportmodallabel'>
                <strong>Posted By:</strong> $allfiles->Admin</p>
                <p class='reportmodallabel'>
                <strong>IP Address:</strong> $allfiles->Ip_add</p>
                <p class='reportmodallabel'>
                <strong>Browser:</strong> $allfiles->Http_browser</p>
                <br>
                <p class='reportmodallabel'>
                <strong>Remarks:</strong> $allfiles->Remarks</p>
                </p>


            </div>";
    }
}
