<?php

namespace App\Http\Controllers;
use App\Models\users;
use App\Models\category;
use App\Models\roles;
use App\Models\logs;
use App\Models\actiontrail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class usercontroller extends Controller
{

    //CREATE NEW USER CATEGORY
    public function addnewcategory(Request $request){

        $this->validate($request, [
            'CategoryName' => 'required',
            'Description' => 'required'
        ]);

        $CategoryName = $request->input('CategoryName');
        $Description = $request->input('Description');


        //save to database
        $category = new category([
            'cat_name' => $CategoryName,
            'cat_desc' => $Description
        ]);
        $category->save(); 


        //check user roles
        if($request->input('ViewReport')){ $ViewReport = 1; }else {  $ViewReport = 0; }
        if($request->input('DeleteReport')){ $DeleteReport = 1; }else {  $DeleteReport = 0; }
        if($request->input('Checkfile')){ $Checkfile = 1; }else {  $Checkfile = 0; }
        if($request->input('UploadFile')){ $UploadFile = 1; }else {  $UploadFile = 0; }
        if($request->input('ViewActionTrail')){ $ViewActionTrail = 1; }else {  $ViewActionTrail = 0; }
        if($request->input('ViewTeams')){ $ViewTeams = 1; }else {  $ViewTeams = 0; }
        if($request->input('AddnewTeam')){ $AddnewTeam = 1; }else {  $AddnewTeam = 0; }
        if($request->input('RemoveTeam')){ $RemoveTeam = 1; }else {  $RemoveTeam = 0; }
        if($request->input('ViewCategories')){ $ViewCategories = 1; }else {  $ViewCategories = 0; }
        if($request->input('Addnewcategory')){ $Addnewcategory = 1; }else {  $Addnewcategory = 0; }
        if($request->input('Removecategory')){ $Removecategory = 1; }else {  $Removecategory = 0; }


        $latestcategid = DB::table('tbl_category')->orderby('id', 'desc')->first();

        //save roles
        $roles = new roles([
            'cat_id' => $latestcategid->id,
            'ViewReport' => $ViewReport,
            'DeleteReport'=> $DeleteReport,
            'Checkfile'=> $Checkfile,
            'UploadFile'=> $UploadFile,
            'ViewActionTrail'=> $ViewActionTrail,
            'ViewTeams'=> $ViewTeams,
            'AddnewTeam'=> $AddnewTeam,
            'RemoveTeam'=> $RemoveTeam,
            'ViewCategories'=> $ViewCategories,
            'Addnewcategory'=> $Addnewcategory,
            'Removecategory' => $Removecategory
        ]);
        $roles->save(); 


        return back()->with('notes', "Password not match");
        
    }


    

    //CREATE NEW USER ACCOUNT
    public function addnewteam(Request $request){

        $this->validate($request, [
            'UserName' => 'required',
	        'Password' => 'required|min:8',
            'Category' => 'required'
        ]);

        $UserName = $request->input('UserName');
        $Password = $request->input('Password');
        $Category = $request->input('Category');


        //get category
        $selectcategory = DB::table('tbl_category')->where('id', $Category)->first();
        
        if($selectcategory)
        {
            //save to database
            $users = new users([
                'usr_name' => $UserName,
                'cat_id' => $selectcategory->id,
                'pwd' => bcrypt($Password)
            ]);
            $users->save(); 

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

            #actiontrail
            $actiontrail = new actiontrail([
                'user_id' => $postedBy,
                'action_taken' => "Added ".$UserName. " to team",
                'ip_add' => $request->ip(),
                'http_browser' => $request->userAgent()
            ]);
            $actiontrail->save(); 

            return back()->with('success', "Account Saved!");
        }
        else
        {

            return back()->with('success', "Category not valid");
        }

        
    }



    //LOGIN VALIDATION
    public function loginproceed(Request $request){

        $this->validate($request, [
            'UserName' => 'required',
	        'Password' => 'required'
        ]);

        $UserName = $request->input('UserName');
        $Password = $request->input('Password');

        //check if account exist
        $ifuserexist = DB::table('tbl_useraccounts')->where('usr_name', $UserName)->first();
        if($ifuserexist)
        {
            if(Hash::check($Password, $ifuserexist->pwd))
            {
                $usersessionholderID = $ifuserexist->id;
                $request->session()->put('systemsession', $usersessionholderID);

                //logs trail
                $logs = new logs([
                    'username' => $ifuserexist->usr_name,
                    'issuccess' => 1,
                    'isfailed' => 0,
                    'remarks' => "Successful Logged",
                    'ip_add' => $request->ip(),
                    'http_browser' => $request->userAgent()
                ]);
                $logs->save(); 

                return redirect()->route('profile'); 
            }
            else
            {
                //logs trail
                $logs = new logs([
                    'username' => $UserName,
                    'issuccess' => 0,
                    'isfailed' => 1,
                    'remarks' => "Password not match",
                    'ip_add' => $request->ip(),
                    'http_browser' => $request->userAgent()
                ]);
                $logs->save();

                return back()->with('notes', "Invalid username or password.");
            }
        }
        else
        {
            //logs trail
            $logs = new logs([
                'username' => $UserName,
                'issuccess' => 0,
                'isfailed' => 1,
                'remarks' => "Account not found",
                'ip_add' => $request->ip(),
                'http_browser' => $request->userAgent()
            ]);
            $logs->save();

            return back()->with('notes', "Invalid username or password.");
        }
        
    }


    //LOGOUT
    public function logout(Request $request){
        Session::flush();
        return redirect()->route('index'); 
    }



    //edit account
    public function editaccount(Request $request){
        
        $id = $request->input('id');

        //check if account exist
        $ifuserexist = DB::table('tbl_useraccounts')->where('id', $id)->first();

        if($ifuserexist)
        {
            $accountcateg = DB::table('tbl_category')->where('id', $ifuserexist->cat_id)->first();
            $ALLCATEG = DB::table('tbl_category')->where('id', '!=', $ifuserexist->cat_id)->get();

            if($accountcateg)
            {
                echo'
                <p class="inputlabel">Username (Read Only)</p>
                <input type="text" class="inputclass" value="'.$ifuserexist->usr_name.'" name="UserName" readonly>
                <br><br>
                <p class="inputlabel">Set Cetegory</p>
                <select class="inputclass" name="Category">
                <option value="'.$accountcateg->id.'">'.$accountcateg->cat_name.'</option>';
                foreach($ALLCATEG as $category)
                {
                    echo '<option value="'.$category->id.'">'.$category->cat_name.'</option>';
                }
                echo'
                </select>
                <input type="hidden" class="inputclass" value="'.$ifuserexist->id.'" name="id">
                <br><br>
                <button type="submit" class="loginbutton">Save Changes</button>
            
            ';

            }
            else
            {
                echo "ACCOUNT CATEGORY ERROR";
            }

            
        }
        else
        {
            echo "ACCOUNT NOT FOUND";
        }
    }


    //LOGOUT
    public function processupdate(Request $request){
        
        $id = $request->input('id');

        //check if account exist
        $ifuserexist = DB::table('tbl_useraccounts')->where('id', $id)->first();
        if($ifuserexist)
        {

            $Category = $request->input('Category');

            DB::table('tbl_useraccounts')
            ->where('id', $id)
            ->update(
                array(
                    'cat_id' => $Category,
                ));

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

            #actiontrail
            $actiontrail = new actiontrail([
                'user_id' => $postedBy,
                'action_taken' => "Edit ".$ifuserexist->usr_name. " user account category to ". $Category,
                'ip_add' => $request->ip(),
                'http_browser' => $request->userAgent()
            ]);
            $actiontrail->save();

            return back()->with('success', "Account Updated!");
        }
        else
        {
            return back()->with('notes', "Account not found.");
        }

    }



    //delete account
    public function deleteaccount(Request $request){
        
        $id = $request->input('id');

        //check if account exist
        $ifuserexist = DB::table('tbl_useraccounts')->where('id', $id)->first();

        if($ifuserexist)
        {
            $accountcateg = DB::table('tbl_category')->where('id', $ifuserexist->cat_id)->first();
            $ALLCATEG = DB::table('tbl_category')->where('id', '!=', $ifuserexist->cat_id)->get();

            if($accountcateg)
            {
                echo'
                <form action="/Process/Delete" method="get">
                <p class="inputlabel">Username (Read Only)</p>
                <input type="text" class="inputclass" value="'.$ifuserexist->usr_name.'" name="UserName" readonly>
                <br><br>
                <p class="inputlabel">Set Cetegory (Read Only)</p>
                <input type="text" class="inputclass" value="'.$accountcateg->cat_name.'" name="Cetegory" readonly>
                <input type="hidden" class="inputclass" value="'.$ifuserexist->id.'" name="id">
                <br><br><br>
                <p class="inputlabel">Note: You cannot undo once deleted</p>
                <button type="submit" class="redbutton">Delete</button>
                </form>
            
            ';

            }
            else
            {
                echo "ACCOUNT CATEGORY ERROR";
            }

            
        }
        else
        {
            echo "ACCOUNT NOT FOUND";
        }
    }



    //LOGOUT
    public function processdelete(Request $request){
        
        $id = $request->input('id');

        //check if account exist
        $ifuserexist = DB::table('tbl_useraccounts')->where('id', $id)->first();
        if($ifuserexist)
        {

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

            #actiontrail
            $actiontrail = new actiontrail([
                'user_id' => $postedBy,
                'action_taken' => "Removed ".$ifuserexist->usr_name. " account from team",
                'ip_add' => $request->ip(),
                'http_browser' => $request->userAgent()
            ]);
            $actiontrail->save();

            DB::table('tbl_useraccounts')
            ->where('id', $id)
            ->delete();

            return back()->with('success', "Account Removed!");
        }
        else
        {
            return back()->with('notes', "Account not found.");
        }

    }

}
