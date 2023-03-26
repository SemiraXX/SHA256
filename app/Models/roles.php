<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;

    protected $table = 'tbl_userroles';

    protected $fillable = [
        'cat_id',
        'ViewReport',
        'DeleteReport',
        'Checkfile',
        'UploadFile',
        'ViewActionTrail',
        'ViewTeams',
        'AddnewTeam',
        'RemoveTeam',
        'ViewCategories',
        'Addnewcategory',
        'Removecategory'
    ];
}
