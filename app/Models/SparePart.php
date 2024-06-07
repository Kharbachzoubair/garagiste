<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $fillable = [
        'part_name', 
        'part_reference', 
        'supplier', 
        'price', 
        'stock',
        'repair_id' // This should be added if you're associating spare parts with repairs
    ];

    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}
