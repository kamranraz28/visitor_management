<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staffs';

    protected $fillable = [
        'department_id','name',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function visit()
    {
        return $this->hasMany(VisitDetail::class);
    }
}
