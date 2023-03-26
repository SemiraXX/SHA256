<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class savedfiles extends Model
{
    use HasFactory;

    protected $table = 'tbl_savedfiles';

    protected $fillable = [
        'fileID',
        'fileName',
        'fileCateg',
        'SHA256Argon2',
        'postedBy',
        'postedDate'
    ];
}
