<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
     /**
     * عرض تفاصيل حملة معينة
     */
    public function campaign($id)
    {
        $campaign = Campaign::find($id);
        if(!$campaign){
            return redirect()->back()
            ->with(['notifyType' => 'warning','notifyTitle' => 'غير موجود','notifyMsg' =>'الحملة التي تحاول عرضها غير موجودة او ربما تم حذفها.']);
        }
        return view('front.campaign', compact('campaign'));
    }
    public function campaigns()
    {
        $campaigns = Campaign::get();
       
        return view('front.campaigns', compact('campaigns'));
    }
}
