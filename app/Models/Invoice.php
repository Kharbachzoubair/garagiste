<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'repair_id', 'additional_charges', 'total_amount',
    ];
    // Define relationships
    public function repair()
    {
        return $this->belongsTo(Repair::class);  // One invoice belongs to one repair
    }
}
