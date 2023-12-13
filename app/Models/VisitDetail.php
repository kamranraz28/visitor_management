<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitDetail extends Model
{
    use HasFactory;
    protected $table = 'visit_details';

    protected $fillable = [
        'visitor_id', 'department_id', 'staff_id','reason','status','check_in','checkout',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }
}
