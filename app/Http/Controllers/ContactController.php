<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddContact;
use App\Models\Contact;
use App\Models\ContactCategory;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactList()
    {
        $myContacts = Contact::where('user_id', auth()->id())->first();
        $data = [
            'categories' => ContactCategory::get(),
            'myContacts' => ($myContacts) ? unserialize($myContacts->list) : []
        ];
        return view('panel.contact.contactList', compact('data'));
    }

    public function addContact(AddContact $contact)
    {
        $contactCategory = ContactCategory::get();
        $userContactList = [];
        foreach ($contactCategory as $re) {
            $userContactList[$re->id] = $re->id;
            if ($re->id == $contact['contact_category_id']) {
                $userContactList[$re->id] = [[
                    'full_name' => $contact['full_name'],
                    'mobile_number' => $contact['mobile_number'],
                    'description' => $contact['description'],
                ]];
            }
        }
        $myContact = Contact::where('user_id', auth()->id())->first();

        if ($myContact) {
            $newContacts = [];
            $contactItems = unserialize($myContact->list);
            foreach ($contactItems as $key => $value) {
                $newContacts[$key] = $key;
                $newContacts[$key] = $value;
                if ($key == $contact['contact_category_id']) {
                    if (is_array($value)) {
                        $newContacts[$key] = array_merge($value, [[
                            'full_name' => $contact['full_name'],
                            'mobile_number' => $contact['mobile_number'],
                            'description' => $contact['description'],
                        ]]);
                    } else {
                        $newContacts[$key] = [[
                            'full_name' => $contact['full_name'],
                            'mobile_number' => $contact['mobile_number'],
                            'description' => $contact['description'],
                        ]];
                    }
                }
            }
            $myContact->list = serialize($newContacts);
            $myContact->save();
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        } else {
            Contact::create([
                'user_id' => auth()->id(),
                'list' => serialize($userContactList)
            ]);
            return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
        }
    }
}
