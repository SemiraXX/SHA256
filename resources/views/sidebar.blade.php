






<?php
if(session()->has('systemsession'))
{
    $account = DB::table('tbl_useraccounts')->where('id', '=', session('systemsession'))->first();
    $accountcateg = DB::table('tbl_category')->where('id', $account->cat_id)->first();

    if($accountcateg)
    {
        $accountroles = DB::table('tbl_userroles')->where('cat_id', $account->cat_id)->first();

        if($accountroles)
        {

            ?>
            <p class="MENUtitle">Welcome <br>{{$accountcateg->cat_name}} <br> {{$account->usr_name}} </p>
            <br>

            @if($accountroles->ViewReport == 1)
            <a class="menulink" href="/"><i class="fa fa-tachometer" aria-hidden="true"></i> &nbsp; Dashboard</a><br><br>
            @else
            @endif

            @if($accountroles->Checkfile == 1)
            <a class="menulink" href="/Check/File"><i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp; Check File</a><br><br>
            @else
            @endif

            @if($accountroles->UploadFile == 1)
            <a class="menulink" href="/File/Upload"><i class="fa fa-database" aria-hidden="true"></i> &nbsp; Saved Files</a><br><br>
            @else
            @endif

            <hr>
            <br>
            @if($accountroles->ViewActionTrail == 1)
            <a class="menulink" href="/Action/Trail"><i class="fa fa-history" aria-hidden="true"></i> &nbsp; Action Trail</a><br><br>
            @else
            @endif

            @if($accountroles->ViewTeams == 1)
            <a class="menulink" href="/Teams"><i class="fa fa-users" aria-hidden="true"></i> &nbsp; Teams</a><br><br>
            @else
            @endif

            @if($accountroles->ViewCategories == 1)
            <a class="menulink" href="/Categories"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp; Categories</a><br><br>
            @else
            @endif

            <a class="menulink" href="/Profile"><i class="fa fa-user-circle-o" aria-hidden="true"></i> &nbsp; Profile</a><br><br>
            <a class="menulink" href="/Logout"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp; Logout</a>

            <?php
        }
        else
        {
            Session()->put('notes', "Error: Account role invalid!");
            echo '<meta http-equiv="refresh" content="0;url=/Login">';
    
        }
    }
    else
    {
        Session()->put('notes', "Error: Account category not found");
        echo '<meta http-equiv="refresh" content="0;url=/Login">';

    }

}
else
{
    echo '<meta http-equiv="refresh" content="0;url=/Login">';
}
?>  
