<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Campaign extends Model
{
    use HasRelationships; // أضف هذا
    
    protected $fillable = [
        'title',
        'description',
        'location',
        'image',
        'start_date',
        'end_date',
        'created_by',
        'organizer_id',
        'activity',
    ];// لا تنسى deleted_at في المستقبل

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];
    

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getImageAttribute($value){ 
        if($value){
            return asset($value);
        }
        return asset('storage/app/public/campaign/images/default-image.png');
    }

    /*public function volunteers()
    {
        return $this->hasManyDeep(
            User::class, // الجدول النهائي
            [User::class] // الجداول الوسيطة
        );
    }*/
        
   public function volunteers()
{
    return $this->hasManyDeep(
        User::class,
        [Task::class, TaskUser::class],
        [
            'campaign_id', // Task.campaign_id → Campaign.id
            'task_id',     // TaskUser.task_id → Task.id
            'id'           // User.id ← TaskUser.user_id
        ],
        [
            'id',          // Campaign.id
            'id',          // Task.id
            'user_id'      // TaskUser.user_id → User.id
        ]
    );
}


   
}
