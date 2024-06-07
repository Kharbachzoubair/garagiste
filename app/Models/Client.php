<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone_number',
        'user_id', // Assuming user_id is the foreign key
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}