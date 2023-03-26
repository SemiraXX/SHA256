<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = 'tbl_category';

    protected $fillable = [
        'cat_name',
        'cat_desc',
    ];
}
