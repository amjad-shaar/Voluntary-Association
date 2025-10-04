<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Report;
use App\Models\TaskUser;

class TaskController extends Controller
{
     /**
     * عرض تفاصيل حملة معينة
     */
    public function task($id)
    {
        $task = Task::find($id);
        if(!$task){
            return redirect()->back()
            ->with(['notifyType' => 'warning','notifyTitle' => 'غير موجود','notifyMsg' =>'المهمة التي تحاول عرضها غير موجودة او ربما تم حذفها.']);
        }
        $compaign = $task->campaign;
        if(!$compaign){
            return redirect()->back()
            ->with(['notifyType' => 'warning','notifyTitle' => 'غير موجود','notifyMsg' =>'المهمة التي تحاول عرضها غير تابعة لاي حملة.']);
        }
        return view('front.task', compact('task','compaign'));
    }
    public function addReport(Request $request, $id)
    {
        $task = Task::find($id);
        if(!$task){
            return redirect()->back()
            ->with(['notifyType' => 'warning','notifyTitle' => 'غير موجود','notifyMsg' =>'المهمة التي تحاول عرضها غير موجودة او ربما تم حذفها.']);
        }
        $request->validate([
            'report' => 'required|string|max:2000',
        ]);

        $user = auth()->user();
        if(!$user){
            return redirect()->back()
            ->with(['notifyType' => 'warning','notifyTitle' => 'غير مسجل','notifyMsg' =>'يجب عليك تسجيل الدخول اولا.']);
        }

        // التحقق من أن المستخدم هو متطوع في هذه المهمة
        if(!$task->volunteers->contains($user->id)){
            return redirect()->back()
            ->with(['notifyType' => 'warning','notifyTitle' => 'غير مسجل في المهمة','notifyMsg' =>'يجب ان تكون مسجلا في هذه المهمة لتتمكن من رفع تقرير عنها.']);
        }

        // التحقق من أن المستخدم لم يقم برفع تقرير مسبقاً
        if($task->report && $task->report->user_id == $user->id){
            return redirect()->back()
            ->with(['notifyType' => 'info','notifyTitle' => 'تم الرفع مسبقاً','notifyMsg' =>'لقد قمت برفع تقرير مسبقاً عن هذه المهمة.']);
        }
        $oldreport = Report::where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->first();
        if($oldreport){
            return redirect()->back()
            ->with(['notifyType' => 'info','notifyTitle' => 'تم الرفع مسبقاً','notifyMsg' =>'لقد قمت برفع تقرير مسبقاً عن هذه المهمة.']);
        }
        // إنشاء التقرير
        $report = Report::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
            'content' => $request->input('report'),
            'status' => 'pending'
        ]);
        TaskUser::where('task_id', $task->id)
            ->where('user_id', $user->id)
            ->update(['status' => 'completed']);

        return redirect()->route('profile')
            ->with(['notifyType' => 'success','notifyTitle' => 'تم الرفع بنجاح','notifyMsg' =>'تم رفع التقرير بنجاح عن المهمة.']);
    }
}
