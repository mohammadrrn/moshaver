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
        /* --------------------------- Default User --------------------------- */
        $admin_user = User::create([
            'full_name' => 'سعید قلی پور',
            'mobile_number' => '09900787232',
            'mac_address' => 'mac_address', // AssistantController::getMacAddress()
            'password' => bcrypt('saeed23s'),
        ]);

        $writer_user = User::create([
            'full_name' => 'محمدرضا',
            'mobile_number' => '09921190611',
            'mac_address' => 'mac_address', // AssistantController::getMacAddress()
            'password' => bcrypt('saeed23s'),
        ]);

        $normal_user = User::create([
            'full_name' => 'مهدی قلی پور',
            'mobile_number' => '09357144171',
            'mac_address' => 'mac_address', // AssistantController::getMacAddress()
            'password' => bcrypt('saeed23s'),
        ]);
        /* --------------------------- Default User --------------------------- */


        /* --------------------------- Roles --------------------------- */
        $admin_role = Role::create([
            'name' => 'admin',
            'display_name' => 'مدیر',
            'description' => 'مدیر کل سیستم',
        ]);

        $writer_role = Role::create([
            'name' => 'writer',
            'display_name' => 'نویسنده',
            'description' => 'نویسنده سایت',
        ]);

        $user_role = Role::create([
            'name' => 'user',
            'display_name' => 'کاربر عادی',
            'description' => 'کاربر عادی سایت',
        ]);
        /* --------------------------- Roles --------------------------- */

        /* --------------------------- Permissions --------------------------- */

        /* Writer Permission */
        Permission::create([
            'name' => 'confirm-estate-request',
            'display_name' => 'تایید ثبت ملک',
            'description' => 'تایید آگهی های ثبت ملک',
        ]);
        Permission::create([
            'name' => 'update-estate-request',
            'display_name' => 'ویرایش ثبت ملک',
            'description' => 'ویرایش آگهی های ثبت ملک',
        ]);
        Permission::create([
            'name' => 'delete-estate-request',
            'display_name' => 'حذف ثبت ملک',
            'description' => 'حذف آگهی های ثبت ملک',
        ]);
        /* Writer Permission */

        /* Admin Permission */
        Permission::create([
            'name' => 'add-writer',
            'display_name' => 'افزودن نویسنده',
            'description' => 'افزودن نویسنده به سایت',
        ]);

        Permission::create([
            'name' => 'inactivity-writer',
            'display_name' => 'مسدود سازی نویسنده',
            'description' => 'مسدود سازی نویسنده',
        ]);

        Permission::create([
            'name' => 'active-writer',
            'display_name' => 'آزادسازی نویسنده',
            'description' => 'آزادسازی نویسنده',
        ]);

        Permission::create([
            'name' => 'edit-writer',
            'display_name' => 'ویرایش نویسنده',
            'description' => 'ویرایش اطلاعات نویسنده',
        ]);
        /* Admin Permission */

        /* --------------------------- Permissions --------------------------- */


        /* --------------------------- Attach Permissions --------------------------- */
        $writer_role->attachPermissions(AssistantController::writerPermissions());
        $admin_role->attachPermissions(AssistantController::adminPermissions());
        /* --------------------------- Attach Permissions --------------------------- */

        $admin_user->attachRole('admin');
        $writer_user->attachRole('writer');
        $normal_user->attachRole('user');


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
