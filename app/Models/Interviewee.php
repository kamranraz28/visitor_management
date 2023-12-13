<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interviewee extends Model
{
    use HasFactory;

    protected $table = 'interviewees';
    protected $fillable = [
        'name','phone','nid','purpose','bar_code'
    ];

}
