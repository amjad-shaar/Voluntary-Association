<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 
    public function getRole()
    {
        return match ($this->role) {
            'admin'       => 'مدير الموقع',
            'organizer'   => 'منظم حملات',
            'volunteer'     => 'متطوع',
            default         => 'غير معروف',
        };
    }

   /* public function tasks()
    {
        return $this->hasManyThrough(
            Task::class,
            TaskUser::class
        );
        return $this->hasManyThrough(
        Task::class,     // الموديل النهائي اللي نريد الوصول له
        TaskUser::class, // الموديل الوسيط
        'task_id', // المفتاح الخارجي في الموديل الوسيط الذي يشير للموديل الأول
        'id',        // المفتاح الخارجي في الموديل النهائي الذي يشير للموديل الوسيط
        'id',   // المفتاح الأساسي (أو المحلي) في الموديل الأول
        'id'    // المفتاح الأساسي (أو المحلي) في الموديل الوسيط
    );
    }*/
   public function tasks()
    {
        return $this->belongsToMany(
            Task::class,        // الموديل المرتبط
            'task_users',       // اسم جدول الربط
            'user_id',          // المفتاح الأجنبي لهذا الموديل في الجدول الوسيط
            'task_id'           // المفتاح الأجنبي للموديل المرتبط في الجدول الوسيط
        )
        ->withPivot('joined_at', 'status')
        ->withTimestamps();
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function campaigns()
    {
        return $this->hasMany(Campaign::class,'organizer_id');
    }

}
