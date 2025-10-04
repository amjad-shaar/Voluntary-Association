<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'campaign_id',
        'title',
        'description',
        'required_volunteers',
        'execution_time',
        'status',
    ];


    public function getStatus()
    {
        return match ($this->status) {
            'pending'       => 'في الانتظار',
            'in_progress'   => 'قيد العمل',
            'completed'     => 'مكتملة',
            'failed'        => 'فشلت',
            'cancelled'     => 'أُلغيت',
            default         => 'غير معروف',
        };
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    /*public function volunteers()
    {
        return $this->hasManyThrough(
            User::class,
            TaskUser::class
        );
    }*/
    public function volunteers()
    {
        return $this->belongsToMany(User::class, 'task_users')
            ->withPivot('joined_at', 'status')
            ->withTimestamps();
    }
}
