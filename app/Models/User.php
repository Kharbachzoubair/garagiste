<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log; // Correct namespace for Log

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if ($user->role === 'client') {
                try {
                    $user->client()->create([
                        'full_name' => $user->name,
                        'address' => $user->address ?? '',
                        'phone_number' => $user->phone_number ?? '',
                        'email' => $user->email,
                    ]);
                } catch (\Exception $e) {
                    Log::error("Error creating client for user {$user->id}: " . $e->getMessage());
                }
            }
        });
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function repairs()
    {
        return $this->hasMany(Repair::class, 'mechanic_id')->orWhere('user_id', $this->id);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }
    public function isAdmin()
    {
        return $this->role === 'admin'; // Adjust this condition based on your role setup
    }
}
