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
            'plans' => $plans
        ];
        foreach ($plans as $plan) {
            echo "<h1>$plan->title</h1>";
            foreach ($plan->items as $item) {
                echo "time : " . $item->time . ' month <br>' . "price : " . $item->plan_price . '<br>';
                echo "<a href='buy/" . $plan->title . "/" . $item->id . "'>Buy</a>";
                echo "<hr>";
            }
            echo "<br>";
        }
        //return view('subscription.plans', compact('data'));
    }

    public function buy($planName, $itemId)
    {
        $planCheckExist = SubscriptionPlans::where('title', $planName)->first();
        $itemCheckExist = SubscriptionPlansItem::find($itemId);
        if ($planCheckExist && $itemCheckExist && $itemCheckExist->plan_id == $planCheckExist->id) {
            $checkSubscriptionUser = Subscription::where('user_id', auth()->id())->first();
            if (!$checkSubscriptionUser) {
                $now = Carbon::now();
                $dayToAdd = $itemCheckExist->time * 30;
                Subscription::create([
                    'user_id' => auth()->id(),
                    'plan_id' => $planCheckExist->id,
                    'item_id' => $itemCheckExist->id,
                    'expiry_date' => $now->addDay($dayToAdd)
                ]);
                $updateStatus = User::find(auth()->id()); // update user status
                $updateStatus->status = 1;
                $updateStatus->save();
                return redirect(route('home'))->with(['success' => 'عملیات با موفقیت انجام شد']);
            } else {
                echo "شما اشتراک فعال دارید";
            }
        } else {
            echo "not found";
        }
    }
}
