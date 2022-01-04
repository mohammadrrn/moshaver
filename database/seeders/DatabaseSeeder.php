<?php

namespace Database\Seeders;

use App\Http\Controllers\AssistantController;
use App\Models\Area;
use App\Models\ContactCategory;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\EstateRequest;
use App\Models\EstateRequestBuildingFacadesOption;
use App\Models\EstateRequestCabinetsOption;
use App\Models\EstateRequestCoolingSystemOption;
use App\Models\EstateRequestDocumentTypeOption;
use App\Models\EstateRequestFloorCoveringOption;
use App\Models\EstateRequestHeatingSystemOption;
use App\Models\EstateRequestWallPlugsOption;
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
            'area_id' => 1,
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

        $advisor_role = Role::create([
            'name' => 'advisor',
            'display_name' => 'مشاور',
            'description' => 'مشاور سایت',
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
        Permission::create([
            'name' => 'reject-confirmation-estate-request',
            'display_name' => 'رد تایید آگهی',
            'description' => 'رد تایید آگهی های ثبت ملک',
        ]);
        Permission::create([
            'name' => 'confirm-request',
            'display_name' => 'تایید درخواست',
            'description' => 'تایید درخواست ثبت شده',
        ]);
        Permission::create([
            'name' => 'update-request',
            'display_name' => 'ویرایش درخواست',
            'description' => 'ویرایش درخواست ثبت شده',
        ]);
        Permission::create([
            'name' => 'delete-request',
            'display_name' => 'حذف درخواست',
            'description' => 'حذف درخواست ثبت شده',
        ]);
        Permission::create([
            'name' => 'unconfirm-request',
            'display_name' => 'رد تایید درخواست',
            'description' => 'رد تایید درخواست ثبت شده',
        ]);
        /* Writer Permission */

        /* Advisor Permission */
        Permission::create([
            'name' => 'add-reminder',
            'display_name' => 'افزودن یادآوری',
            'description' => 'افزودن یادآوری',
        ]);
        /* Advisor Permission */

        /* Admin Permission */
        Permission::create([
            'name' => 'add-writer',
            'display_name' => 'افزودن نویسنده',
            'description' => 'افزودن نویسنده به سایت',
        ]);

        Permission::create([
            'name' => 'writer-list',
            'display_name' => 'لیست نویسندگان',
            'description' => 'لیست کامل نویسندگان سایت',
        ]);
        Permission::create([
            'name' => 'trusted-offices-list',
            'display_name' => 'لیست دفاتر مورداعتماد',
            'description' => 'لیست کامل دفاتر مورداعتماد',
        ]);
        Permission::create([
            'name' => 'users-list',
            'display_name' => 'لیست کاربران',
            'description' => 'لیست کامل کاربران',
        ]);
        Permission::create([
            'name' => 'confirmed-estate-request-list',
            'display_name' => 'لیست آگهی های تایید شده',
            'description' => 'لیست کامل آگهی های ثبت ملک تایید شده',
        ]);
        Permission::create([
            'name' => 'unconfirmed-estate-request-list',
            'display_name' => 'لیست آگهی های تایید نشده',
            'description' => 'لیست کامل آگهی های ثبت ملک تایید نشده',
        ]);
        Permission::create([
            'name' => 'confirmed-request-list',
            'display_name' => 'لیست درخواست های تایید شده',
            'description' => 'لیست کامل آگهی های ثبت درخواست تایید شده',
        ]);
        Permission::create([
            'name' => 'unconfirmed-request-list',
            'display_name' => 'لیست درخواست های تایید نشده',
            'description' => 'لیست کامل آگهی های ثبت درخواست تایید نشده',
        ]);
        Permission::create([
            'name' => 'zoonkan',
            'display_name' => 'زونکن',
            'description' => 'دسترسی به زونکن',
        ]);
        Permission::create([
            'name' => 'phonebook',
            'display_name' => 'دفترچه تلفن',
            'description' => 'دفترچه تلقن و لیست مخاطبین',
        ]);
        Permission::create([
            'name' => 'cession-list',
            'display_name' => 'لیست درخواست های واگذاری',
            'description' => 'لیست درخواست های واگذاری',
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

        /* Gold Sub Permission */
        Permission::create([
            'name' => 'show-detail-info',
            'display_name' => 'نمایش اطلاعات در جزئیات',
            'description' => 'نمایش اطلاعات در جزئیات آگهی هنگامی که واگذار شده است ',
        ]);
        Permission::create([
            'name' => 'educational-video',
            'display_name' => 'ویدئو آموزشی',
            'description' => 'قسمت ویدئو های آموزشی',
        ]);
        Permission::create([
            'name' => 'user-requests-list',
            'display_name' => 'لیست درخواست های کاربران',
            'description' => 'لیست درخواست های کاربران',
        ]);
        /* Gold Sub Permission */

        /* --------------------------- Permissions --------------------------- */


        /* --------------------------- Attach Permissions --------------------------- */
        $writer_role->attachPermissions(AssistantController::writerPermissions());
        $admin_role->attachPermissions(AssistantController::adminPermissions());
        $user_role->attachPermissions(AssistantController::userPermissions());
        /* --------------------------- Attach Permissions --------------------------- */

        $admin_user->attachRole('admin');
        $writer_user->attachRole('writer');
        $normal_user->attachRole('user');


        Area::create([
            'text' => 'منطقه 1 : هاشمیه - الهیه - سجاد',
            'status' => 1
        ]);
        Transfer::create([
            'text' => 'خرید'
        ]);
        Transfer::create([
            'text' => 'رهن و اجاره'
        ]);
        Transfer::create([
            'text' => 'رهن کامل'
        ]);
        Transfer::create([
            'text' => 'مشارکت'
        ]);
        Estate::create([
            'text' => 'آپارتمان'
        ]);
        Estate::create([
            'text' => 'دفتر کار'
        ]);
        Estate::create([
            'text' => 'ویلایی'
        ]);
        Estate::create([
            'text' => 'مغازه'
        ]);
        Estate::create([
            'text' => 'زمین'
        ]);

        Direction::create([
            'text' => 'شمالی'
        ]);
        Direction::create([
            'text' => 'جنوبی'
        ]);
        Direction::create([
            'text' => 'غربی'
        ]);
        Direction::create([
            'text' => 'شرقی'
        ]);
        Direction::create([
            'text' => 'دو نبش'
        ]);

        EstateRequestFloorCoveringOption::create([
            'text' => 'کف پوش'
        ]);
        EstateRequestCabinetsOption::create([
            'text' => 'کابینت'
        ]);
        EstateRequestWallPlugsOption::create([
            'text' => 'دیوارپوش'
        ]);
        EstateRequestBuildingFacadesOption::create([
            'text' => 'نمای ساختمان'
        ]);
        EstateRequestHeatingSystemOption::create([
            'text' => 'سیستم گرمایش'
        ]);
        EstateRequestCoolingSystemOption::create([
            'text' => 'سیستم سرمایش'
        ]);
        EstateRequestDocumentTypeOption::create([
            'text' => 'نوع سند'
        ]);

        SubscriptionPlans::create([
            'title' => 'اشتراک طلایی',
            'level' => 'gold',
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
            'level' => 'silver',
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


        $contactCategory = [
            'owner' => 'مالکین',
            'buyer' => 'خریداران',
            'mostajer' => 'مستاجران',
            'creator' => 'سازنده',
            'hamkaran' => 'همکاران',
            'other' => 'متفرقه',
        ];

        foreach ($contactCategory as $contact) {
            ContactCategory::create([
                'name' => $contact
            ]);
        }
        EstateRequest::create([
            'owner_name' => 'سعید قلی پور',
            'owner_mobile_number' => '09900787232',
            'image' => 'default.png',
            'thumbnail' => 'default-thumbnail.png',
            'estate_id' => 1,
            'address' => 'طلاب - دریای دوم',
            'area_id' => 1,
            'transfer_id' => 1,
            'area' => 200,
            'street_name' => 'حسینی محراب',
            'plaque' => 553,
            'floor' => 3,
            'number_of_floor' => 3,
            'apartment_unit' => 1,
            'year_of_construction' => 1,
            'direction_id' => 1,
            'mortgage_price' => 0,
            'rent_price' => 0,
            'buy_price' => 100000000,
            'description' => 'آپارتمان تازه ساخت هستش',
            'empty' => 1,
            'presell' => 1,
            'exchange' => 1,
            'parking' => 1,
            'warehouse' => 1,
            'elevator' => 1,
            'electric_door' => 1,
            'floor_covering_id' => 1,
            'cabinets_id' => 1,
            'wall_plugs_id' => 1,
            'building_facades_id' => 1,
            'heating_system_id' => 1,
            'cooling_system_id' => 1,
            'document_type_id' => 1,
        ]);
    }
}
