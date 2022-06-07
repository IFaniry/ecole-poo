<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, UUID;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'firstName',
        'department',
        'dateCreated'
    ];

    public function timers()
    {
        return $this->hasMany(Timer::class, 'employeeId', 'id');
    }
}
