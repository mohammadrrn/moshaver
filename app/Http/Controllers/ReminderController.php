<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddReminder;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function addReminderForm()
    {
        return view('panel.reminder.addReminderForm');
    }

    public function addReminder(AddReminder $reminder)
    {
        $checkReminderExist = Reminder::where('title', $reminder['reminder_title'])->where('reminder_date', $reminder['reminder_date'])->first();

        if (!$checkReminderExist) {
            Reminder::create([
                'title' => $reminder['reminder_title'],
                'user_id' => auth()->id(),
                'reminder_date' => Carbon::now(), // TODO :: get calendar value
            ]);
            return redirect(route('panel.reminder.addReminderForm'))->with(['success' => 'عملیات با موفقیت انجام شد']);
        }

        return redirect(route('panel.reminder.addReminderForm'))->withErrors(['این یادآوری قبلا تنظیم شده است']);
    }
}
