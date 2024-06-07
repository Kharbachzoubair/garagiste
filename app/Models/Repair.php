<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 
        'status', 
        'start_date', 
        'end_date', 
        'vehicle_id', 
        'client_id', 
        'mechanic_id', 
        'cost'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(User::class, 'mechanic_id');
    }

    public function spareParts()
    {
        return $this->hasMany(SparePart::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
