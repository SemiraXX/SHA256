<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reports extends Model
{
    use HasFactory;

    protected $table = 'tbl_reports';

    protected $fillable = [
        'FileUploaded',
        'FileSHA256value',
        'OriginalFileID',
        'Admin',
        'Ip_add',
        'Http_browser',
        'Result',
        'Remarks'
    ];
}
