<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'work_start_time',
        'work_end_time',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->dailyCalorieIntake()->create([
                'calories' => 0,
                'carbohydrates' => 0,
                'fats' => 0,
                'protein' => 0,
            ]);
        });
    }

    public function measurements()
    {
        return $this->hasMany(UserMeasurement::class);
    }

    public function dailyCalorieIntake()
    {
        return $this->hasOne(DailyCalorieIntake::class);
    }

    public function userWorkouts()
    {
        return $this->hasMany(UserWorkout::class, 'user_id');
    }

}
