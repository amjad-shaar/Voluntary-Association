<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;

class AdminTaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    /**
     * عرض جميع المهام
     */
    public function index()
    {
        $campaigns = Campaign::with(['owner', 'tasks'])->latest()->paginate(10);

        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * صفحة إنشاء مهمة جديدة
     */
    public function create()
    {
       
        return view('admin.campaigns.create');
    }

    /**
     * حفظ مهمة جديدة في قاعدة البيانات
     */
    public function store(TaskRequest $request)
    {
        $user = Auth::user();

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'required_volunteers' => $request->required_volunteers,
            'execution_time' => $request->execution_time,
            'campaign_id' => $request->campaign_id,
        ]);

        
        return redirect()->back()->with(['notifyType' => 'success','notifyTitle' => 'إضافة مهمة  ','notifyMsg' =>'تم إضافة المهمة بنجاح.']);
    }

  
    /**
     * صفحة تعديل مهمة
     */
    public function edit(Campaign $campaign)
    {
        $organizers = User::where('role', 'organizer')->get();
        return view('admin.campaigns.edit', compact('campaign', 'organizers'));
    }

    /**
     * تحديث بيانات مهمة
     */
    public function update(TaskRequest $request, Task $task)
    {
        $data = [];

        foreach (['title', 'description', 'required_volunteers', 'execution_time', 'status'] as $field) {
            if ($request->filled($field)) { 
                $data[$field] = $request->$field;
            }
        }

        $task->update($data);

        return redirect()->back()->with([
            'notifyType' => 'success',
            'notifyTitle' => 'تعديل المهمة',
            'notifyMsg' => 'تم تعديل المهمة بنجاح.',
        ]);
    }

    /**
     * حذف مهمة
     */
    public function destroy(Task $task)
    {
        //observer will handle detaching users
        $task->delete();
        return redirect()->route('campaign',$task->campaign_id)->with([
            'notifyType' => 'success',
            'notifyTitle' => 'حذف المهمة',
            'notifyMsg' => 'تم حذف المهمة بنجاح.',
        ]);
    }
}