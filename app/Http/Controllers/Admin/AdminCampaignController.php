<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CampaignRequest;

class AdminCampaignController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Campaign::class, 'campaign');
    }

    /**
     * عرض جميع الحملات
     */
    public function index()
    {
        $campaigns = Campaign::with(['owner', 'tasks'])->latest()->paginate(10);

        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * صفحة إنشاء حملة جديدة
     */
    public function create()
    {
       
        return view('admin.campaigns.create');
    }

    /**
     * حفظ حملة جديدة في قاعدة البيانات
     */
    public function store(CampaignRequest $request)
    {
        
        $imagePath = null;
        $user = Auth::user();


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath =$image->store('campaign/images', 'public');
            $imagePath = asset('storage/app/public/'.$imagePath);
        }

        //$campaignData = ;

        $campaign = Campaign::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image' => $imagePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => $user->id,
            'organizer_id' => $request->organizer_id,
        ]);

        
        return redirect()->route('campaigns.index')->with(['notifyType' => 'success','notifyTitle' => 'إضافة حملة  ','notifyMsg' =>'تم إضافة الحملة بنجاح.']);
    }


    /**
     * صفحة تعديل حملة
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    /**
     * تحديث بيانات حملة
     */
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        $data = [];
        $imagePath = null;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath =$image->store('campaign/images', 'public');
            $imagePath = asset('storage/app/public/'.$imagePath);
        }

        foreach (['title', 'description', 'location', 'image',
             'start_date', 'end_date', 'created_by'] as $field) {
            if ($request->filled($field)) { 
                if($imagePath != null){
                    if($field == 'image'){$data[$field] = $imagePath;}
                    continue;
                }
                $data[$field] = $request->$field;
            }
        }


        $campaign->update($data);

        return redirect()->route('campaign',$campaign->id)->with([
            'notifyType' => 'success',
            'notifyTitle' => 'تعديل الحملة',
            'notifyMsg' => 'تم تعديل الحملة بنجاح.',
        ]);
    }

    /**
     * حذف حملة
     */
    public function destroy(Campaign $campaign)
    {
        //observer will handle detaching tasks,users
        $campaign->delete();
        return redirect()->route('campaigns.index')->with([
            'notifyType' => 'success',
            'notifyTitle' => 'حذف الحملة',
            'notifyMsg' => 'تم حذف الحملة بنجاح.',
        ]);
    }
}