<?php

namespace Database\Seeders;

use App\Http\Controllers\AssistantController;
use App\Models\Area;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\Permission;
use App\Models\Role;
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
            'name' => 'author',
            'display_name' => 'نویسنده',
            'description' => 'نویسنده سایت',
        ]);
        $permission_author = Permission::create([
            'name' => 'confirm-file',
            'display_name' => 'تایید فایل',
            'description' => 'تایید ملک های ثبت شده توسط کاربر',
        ]);
        $author_role->attachPermissions([$permission_author]);

        $admin = User::create([
            'full_name' => 'سعید قلی پور',
            'mobile_number' => '09900787232',
            'mac_address' => AssistantController::getMacAddress(),
            'password' => bcrypt('saeed23s'),
        ]);
        $author = User::create([
            'full_name' => 'محمدرضا',
            'mobile_number' => '09921190611',
            'mac_address' => AssistantController::getMacAddress(),
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
    }
}
