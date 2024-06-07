<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'make', 
        'model', 
        'fuel_type', 
        'registration', 
        'photo', 
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
