<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'joined_at',
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
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
