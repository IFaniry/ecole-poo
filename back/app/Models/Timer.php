<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    use HasFactory, UUID;

    public $timestamps = false;

    protected $fillable = [
        'employeeId',
        'dailyVolumeInHours',
        'checkIn',
        'checkOut',
        'comment'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employeeId');
    }
}
