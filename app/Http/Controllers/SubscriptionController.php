<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlans;
use App\Models\SubscriptionPlansItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function plans()
    {
        $plans = SubscriptionPlans::with('items')->get();
        $data = [
            'plans' => $plans,
            'gold' => $plans[0],
            'silver' => $plans[1],
        ];
        return view('panel.subscription.plans', compact('data'));
    }

    public function buy($planId, $itemId)
    {
        $planCheckExist = SubscriptionPlans::find($planId);
        $itemCheckExist = SubscriptionPlansItem::find($itemId);
        if ($planCheckExist && $itemCheckExist && $itemCheckExist->plan_id == $planCheckExist->id) {
            $checkSubscriptionUser = Subscription::where('user_id', auth()->id())->first();

            if (!$checkSubscriptionUser) {

                if ($planCheckExist->level == 'gold') // Attach Subscription Plan Permissions For User Role
                    auth()->user()->attachPermissions(AssistantController::goldPermissions());
                elseif ($planCheckExist->level == 'silver')
                    auth()->user()->attachPermissions(AssistantController::silverPermissions());

                $now = Carbon::now();
                $dayToAdd = $itemCheckExist->time * 30;
                Subscription::create([
                    'user_id' => auth()->id(),
                    'plan_id' => $planCheckExist->id,
                    'item_id' => $itemCheckExist->id,
                    'expiry_date' => $now->addDay($dayToAdd)
                ]);
                $user = User::find(auth()->id());
                $user->status = 1;
                $user->save();
                return redirect(route('panel.index'))->with(['success' => 'عملیات با موفقیت انجام شد']);
            } else {
                echo "شما اشتراک فعال دارید";
            }
        } else {
            echo "not found";
        }
    }
}
