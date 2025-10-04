<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * قبل كل شيء: الأدمن يحصل على كل الصلاحيات
     */
    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return $this->allow(); // يسمح للأدمن بكل شيء
        }
    }

    /**
     * عرض جميع المهام
     */
    public function viewAny(User $user)
    {
        // الجميع يستطيعون مشاهدة المهام
        return $this->allow();
    }

    /**
     * عرض مهمة معينة
     */
    public function view(User $user, Task $task)
    {
        return $this->allow(); // أي مستخدم يمكنه العرض
    }

    /**
     * إنشاء مهمة جديدة
     */
    public function create(User $user)
    {
        if (in_array($user->role, ['organizer'])) {
            return $this->allow();
        }

        return $this->deny('ليس لديك صلاحية لإنشاء المهام'); // رسالة مخصصة
    }

    /**
     * تعديل مهمة
     */
    public function update(User $user, Task $task)
    {
        if ($user->role === 'organizer' && $task->campaign->created_by === $user->id) {
            return $this->allow();
        }

        return $this->deny('لا يمكنك تعديل هذه المهمة لأنها لا تتبع حملتك');
    }

    /**
     * حذف مهمة
     */
    public function delete(User $user, Task $task)
    {
        if ($user->role === 'organizer' && $task->campaign->created_by === $user->id) {
            return $this->allow();
        }

        return $this->deny('لا يمكنك حذف هذه المهمة لأنها لا تتبع حملتك');
    }
}
