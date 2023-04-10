<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logs extends Model
{
    use HasFactory;

    protected $table = 'tbl_logs';

    protected $fillable = [
        'username',
        'issuccess',
        'isfailed',
        'remarks',
        'ip_add',
        'http_browser'
    ];
}
