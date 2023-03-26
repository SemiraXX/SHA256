<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actiontrail extends Model
{
    use HasFactory;

    protected $table = 'tbl_action_trail';

    protected $fillable = [
        'user_id',
        'action_taken',
        'ip_add',
        'http_browser'
    ];
}
