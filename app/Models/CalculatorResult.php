<?php

// app/Models/CalculatorResult.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculatorResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'selected_categories',
        'selected_items',
        'total_co2',
        'difference',
        'reduced_co2',
        'calculation_date',
    ];
    

    protected $casts = [
        'selected_categories' => 'array',
        'selected_items' => 'array',
    ];

    // Optionally, you can add relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
