<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;

    protected $table = 'tbl_useraccounts';

    protected $fillable = [
        'cat_id',
        'usr_name',
        'pwd',
    ];
}
