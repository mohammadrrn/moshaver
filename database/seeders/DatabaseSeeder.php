<?php

namespace Database\Seeders;

use App\Http\Controllers\AssistantController;
use App\Models\Area;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SubscriptionPlans;
use App\Models\SubscriptionPlansItem;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::create([
            'name' => 'admin',
            'display_name' => 'مدیر',
            'description' => 'مدیر کل سیستم',
        ]);
        $permission_admin = Permission::create([
            'name' => 'add-author',
            'display_name' => 'افزودن نویسنده',
            'description' => 'امکان افزودن نویسنده',
        ]);
        $admin_role->attachPermissions([$permission_admin]);

        $author_role = Role::create([
            'name' => 'writer',
            'display_name' => 'نویسنده',
            'description' => 'نویسنده سایت',
        ]);
        $permission_author = Permission::create([
            'name' => 'confirm-file',
            'display_name' => 'تایید فایل',
            'description' => 'تایید ملک های ثبت شده توسط کاربر',
        ]);
        $author_role->attachPermissions([$permission_author]);

        $user_role = Role::create([
            'name' => 'user',
            'display_name' => 'کاربر عادی',
            'description' => 'کاربر عادی سایت',
        ]);

        $admin = User::create([
            'full_name' => 'سعید قلی پور',
            'mobile_number' => '09900787232',
            'mac_address' => 'mac_address', // AssistantController::getMacAddress()
            'password' => bcrypt('saeed23s'),
        ]);
        $author = User::create([
            'full_name' => 'محمدرضا',
            'mobile_number' => '09921190611',
            'mac_address' => 'mac_address', // AssistantController::getMacAddress()
            'password' => bcrypt('saeed23s'),
        ]);
        $admin->attachRole($admin_role);
        $author->attachRole($author_role);

        $admin->attachPermission($permission_admin);
        $admin->attachPermission($permission_author);
        $author->attachPermission($permission_author);

        Area::create([
            'text' => 'منطقه 1 : هاشمیه - الهیه - سجاد'
        ]);
        Transfer::create([
            'text' => 'خرید'
        ]);
        Transfer::create([
            'text' => 'رهن و اجاره'
        ]);
        Estate::create([
            'text' => 'آپارتمان'
        ]);

        Direction::create([
            'text' => 'شمالی'
        ]);
        Direction::create([
            'text' => 'جنوبی'
        ]);

        SubscriptionPlans::create([
            'title' => 'اشتراک طلایی',
            'icon' => 'icon/PanelAdmin/diamond-gold.svg',
            'properties' => json_encode([
                'property 1',
                'property 2',
            ]),
        ]);
        SubscriptionPlansItem::create([
            'plan_id' => 1,
            'plan_price' => 20000,
            'time' => 2,
        ]);
        SubscriptionPlansItem::create([
            'plan_id' => 1,
            'plan_price' => 10000,
            'time' => 1,
        ]);

        SubscriptionPlans::create([
            'title' => 'اشتراک نقره ای',
            'icon' => 'icon/PanelAdmin/diamond-silver.svg',
            'properties' => json_encode([
                'property 1',
                'property 2',
            ]),
        ]);
        SubscriptionPlansItem::create([
            'plan_id' => 2,
            'plan_price' => 10000,
            'time' => 2,
        ]);
        SubscriptionPlansItem::create([
            'plan_id' => 2,
            'plan_price' => 5000,
            'time' => 1,
        ]);
    }
}
