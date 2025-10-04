<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VolunteerController extends Controller
{
    /**
     * انضمام المتطوع لمهمة معينة
     */
    public function joinTask($id)
    {
        $user = Auth::user();
        //return $user->tasks;

        $task = Task::with('campaign', 'volunteers')->find($id);
        if (!$task) {
            return redirect()->back()->with([
                'notifyType' => 'warning',
                'notifyTitle' => 'غير موجود',
                'notifyMsg' => 'هذه المهمة غير موجودة.',
            ]);
        }
     if ($task->status != 'pending' && $task->status != 'in_progress') {
        return redirect()->back()->with([
            'notifyType'  => 'warning',
            'notifyTitle' => 'غير سارية',
            'notifyMsg'   => 'هذه المهمة غير سارية المفعول الآن.',
        ]);
    }
        $alreadyJoined = TaskUser::whereHas('task', function ($q) use ($task) {
                $q->where('campaign_id', $task->campaign_id);
            })->where('user_id', $user->id)->exists();

        if ($alreadyJoined) {
            return redirect()->back()->with([
                'notifyType' => 'warning',
                'notifyTitle' => 'منضم سابقا',
                'notifyMsg' => 'لا يمكنك الانضمام لأكثر من مهمة مفعلة في نفس الحملة.',
            ]);
        }

        $currentCount = $task->volunteers()->count();
        if ($currentCount >= $task->required_volunteers) {
            return redirect()->back()->with([
                'notifyType' => 'warning',
                'notifyTitle' => 'ممتلئة',
                'notifyMsg' => 'المهمة ممتلئة بالفعل.',
            ]);
        }

        TaskUser::create([
            'task_id'   => $task->id,
            'user_id'   => $user->id,
            'joined_at' => Carbon::now(),
        ]);

        return redirect()->route('campaign', $task->campaign_id)
            ->with([
                'notifyType' => 'success',
                'notifyTitle' => 'تم الانضمام',
                'notifyMsg' => 'تم الانضمام الى المهمة بنجاح.',
            ]);
    }
}
