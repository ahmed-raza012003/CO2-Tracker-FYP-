<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['user_id', 'goal', 'target_co2', 'current_co2'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
