<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'room_id',
        'fullname',
        'phone',
        'title',
        'description',
        'user_id'
    ];
}
