<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class savedfiles extends Model
{
    use HasFactory;

    protected $table = 'tbl_saved_files';

    protected $fillable = [
        'FileID',
        'FileName',
        'FileCateg',
        'HashValue',
        'PrivateKey',
        'PublicKey',
        'Signature',
        'PostedBy',
        'PostedDate'
    ];
}
