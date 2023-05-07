<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory,
        SoftDeletes;
    protected $fillable = [
        'id',
        'title',
        'content',
        'img',
        'contactInformation',
        'videoUrl',
        'ward_id',
        'district_id',
        'province_id',
        'rent_type_id',
        'detail_address',
        'area',
        'price',
        'user_id',
        'status',
        'sort',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roomImages()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    } 

    public function findUserReport()
    {
        $rooms = Room::join('reports', function ($join) {
                $join->on('rooms.id', '=', 'reports.room_id');
            })
            ->select(DB::raw('count(*) as total'))
            ->where('reports.user_id', $this->user_id)
            ->groupBy('rooms.id')
            ->first();

        if ($rooms && $rooms->total > 3) {
            return true;
        }

        return false;
    }
}
