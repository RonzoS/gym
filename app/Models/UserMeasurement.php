<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight',
        'height',
        'muscle_mass',
        'fat_mass',
        'water_mass',
        'bmi',
        'muscle_percentage',
        'fat_percentage',
        'water_percentage',
        'neck_circumference',
        'arm_circumference',
        'forearm_circumference',
        'wrist_circumference',
        'chest_circumference',
        'waist_circumference',
        'hip_circumference',
        'thigh_circumference',
        'calf_circumference',
        'ankle_circumference',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->weight && $model->height) {
                $model->bmi = $model->weight / (($model->height / 100) ** 2);
            }

            if ($model->muscle_mass && $model->weight) {
                $model->muscle_percentage = ($model->muscle_mass / $model->weight) * 100;
            }

            if ($model->fat_mass && $model->weight) {
                $model->fat_percentage = ($model->fat_mass / $model->weight) * 100;
            }

            if ($model->water_mass && $model->weight) {
                $model->water_percentage = ($model->water_mass / $model->weight) * 100;
            }
        });
    }
}
