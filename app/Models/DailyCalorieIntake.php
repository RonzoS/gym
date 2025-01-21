<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCalorieIntake extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = ['user_id', 'calories', 'carbohydrates', 'fats', 'protein'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
