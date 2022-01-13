<?php

namespace Database\Seeders;

use App\Http\Controllers\AssistantController;
use App\Models\Area;
use App\Models\Cities;
use App\Models\ContactCategory;
use App\Models\Direction;
use App\Models\Estate;
use App\Models\EstateRequest;
use App\Models\EstateRequestBuildingFacadesOption;
use App\Models\EstateRequestCabinetsOption;
use App\Models\EstateRequestCoolingSystemOption;
use App\Models\EstateRequestDensityOption;
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
use App\Models\WriterQueue;
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
            'name' => 'educational-video',
            'display_name' => 'ویدئو آموزشی',
            'description' => 'قسمت ویدئو های آموزشی',
        ]);
        Permission::create([
            'name' => 'special-link',
            'display_name' => 'لینک ویژه',
            'description' => 'لینک مخصوص ارائه به کاربران',
        ]);
        Permission::create([
            'name' => 'user-requests-list',
            'display_name' => 'لیست درخواست های کاربران',
            'description' => 'لیست درخواست های کاربران',
        ]);
        /* Gold Sub Permission */

        /* Silver Sub Permission */
        Permission::create([
            'name' => 'show-detail-info',
            'display_name' => 'نمایش اطلاعات در جزئیات',
            'description' => 'نمایش اطلاعات در جزئیات آگهی هنگامی که واگذار شده است ',
        ]);
        /* Silver Sub Permission */

        /* --------------------------- Permissions --------------------------- */


        /* --------------------------- Attach Permissions --------------------------- */
        $writer_role->attachPermissions(AssistantController::writerPermissions());
        $admin_role->attachPermissions(AssistantController::adminPermissions());
        $user_role->attachPermissions(AssistantController::userPermissions());
        /* --------------------------- Attach Permissions --------------------------- */

        $admin_user->attachRole('admin');
        $writer_user->attachRole('writer');
        $normal_user->attachRole('writer');


        Area::create([
            'text' => 'منطقه 1 : خیام-ملک آباد-فردوسی-سجاد -ملاصدرا-سازمان آب-آبکوه-فلسطین-کلاهدوز-سناباد-راهنمایی-احمد آباد-کوهسنگی-مطهری',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 2 :فرامرز عباسی-بلوار فردوسی- جانباز-خیام-ابوطالب-عبدالمطلب-موسوی قوچانی-هنرور-کریمی-عبادی',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 3 : گاز-رسالت-فاطمیه-ابوذر-طبرسی-المهدی-بلال حبشی-مهر مادر-المهدی-مسلم-مجلسی-خواجه ربیع-22 بهمن',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 4 : طبرسی- ایثار-شهید حاتمی -مفتح-نبوت-علامه امینی-ستایش-صاحب دلان-المهدی -وحید',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 5 : آوینی-سرخس-ولایت-مهر آباد-عبادت-همت آباد-عباس آباد-مهدی آباد-تلاش-کرامت-الزهرا-ولایت-بابا نظر',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 6:  مصلی-چمن-شیرودی-بلوار رستمی- محمد آباد-کارمندان - صدوقی(چهنو) - بیست و دو بهمن - چمن-پنجراه',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 7 : هفده شهریور-امام رضا-عنصری-فدائیان اسلام-کوشش-جمهوری اسلامی-ثامن-سپاه-رجایی-کوشش-ولیعصر-طرق',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 8 : دانشگاه-امام خمینی-پاسداران-آخوندی خراسانی-ارشاد-کوهسنگی-رازی-جهاد-نامجو-امام خمینی-رزم-گلستان',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 9 : وکیل آباد-نماز -دلاوان-رضوی -پیروزی -باهنر -کوثر -هاشمیه -هنرستان- هفت تیر -صیاد-اقبال- لادن – فکوری-صارمی',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 10 : اندیشه-حجاب-امامیه-ادیب-فلاحی -شاهد-شریعتی- حسابی-میثاق-مجیدیه',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 11 : وکیل آباد-امامت-جلال-سید رضی-دانش آموز-دانشجو-صدف-دندانپزشکان-فارغ التحصیلان-نمایشگاه-فرهنگ-معلم-آموزگار-مهران',
            'status' => 1
        ]);
        Area::create([
            'text' => 'منطقه 12 : الهیه-مجیدیه-اقدسیه-امیریه-میثاق-سجادیه-رحمانیه-مشایخی-عصمتیه-نقویه-بوستان-جاهد شهر-تقویه-هاشمی رفسنجانی فرد(میثاق)-صادقیه',
            'status' => 1
        ]);

        foreach (Area::get() as $area) {
            WriterQueue::create([
                'area_id' => $area->id,
                'last_writer_id' => 1
            ]);
        }
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
        Estate::create([
            'text' => 'سوله و انبار'
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
            'text' => 'سرامیک'
        ]);
        EstateRequestFloorCoveringOption::create([
            'text' => 'پارکت'
        ]);
        EstateRequestFloorCoveringOption::create([
            'text' => 'موکت'
        ]);
        EstateRequestFloorCoveringOption::create([
            'text' => 'کف پوش'
        ]);
        EstateRequestFloorCoveringOption::create([
            'text' => 'سنگ'
        ]);
        EstateRequestCabinetsOption::create([
            'text' => 'ام دی اف'
        ]);
        EstateRequestCabinetsOption::create([
            'text' => 'فلز'
        ]);
        EstateRequestCabinetsOption::create([
            'text' => 'های گلس'
        ]);
        EstateRequestCabinetsOption::create([
            'text' => 'طرح ام دی اف'
        ]);
        EstateRequestCabinetsOption::create([
            'text' => 'چوب'
        ]);
        EstateRequestWallPlugsOption::create([
            'text' => 'کاغذ دیواری'
        ]);
        EstateRequestWallPlugsOption::create([
            'text' => 'نقاشی'
        ]);
        EstateRequestWallPlugsOption::create([
            'text' => 'ترکیبی'
        ]);
        EstateRequestBuildingFacadesOption::create([
            'text' => 'سنگ'
        ]);
        EstateRequestBuildingFacadesOption::create([
            'text' => 'آجر سه سانت'
        ]);
        EstateRequestBuildingFacadesOption::create([
            'text' => 'سنگ و آجر'
        ]);
        EstateRequestBuildingFacadesOption::create([
            'text' => 'رومی'
        ]);
        EstateRequestBuildingFacadesOption::create([
            'text' => 'سرامیک'
        ]);
        EstateRequestBuildingFacadesOption::create([
            'text' => 'سایز'
        ]);
        EstateRequestHeatingSystemOption::create([
            'text' => 'بخاری'
        ]);
        EstateRequestHeatingSystemOption::create([
            'text' => 'پکیج'
        ]);
        EstateRequestHeatingSystemOption::create([
            'text' => 'هواساز'
        ]);
        EstateRequestHeatingSystemOption::create([
            'text' => 'گرمایش از کف'
        ]);
        EstateRequestHeatingSystemOption::create([
            'text' => 'چیلر'
        ]);
        EstateRequestCoolingSystemOption::create([
            'text' => 'کولر آبی'
        ]);
        EstateRequestCoolingSystemOption::create([
            'text' => 'کولر گازی'
        ]);
        EstateRequestCoolingSystemOption::create([
            'text' => 'هوا ساز'
        ]);
        EstateRequestCoolingSystemOption::create([
            'text' => 'چیلر'
        ]);
        EstateRequestDocumentTypeOption::create([
            'text' => 'شش دانگ'
        ]);
        EstateRequestDocumentTypeOption::create([
            'text' => 'سه دانگ'
        ]);
        EstateRequestDocumentTypeOption::create([
            'text' => 'وکالتی'
        ]);
        EstateRequestDocumentTypeOption::create([
            'text' => 'قولنامه ای'
        ]);
        EstateRequestDensityOption::create([
            'text' => 'کم'
        ]);
        EstateRequestDensityOption::create([
            'text' => 'متوسط'
        ]);
        EstateRequestDensityOption::create([
            'text' => 'زیاد'
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

        Cities::create([
            'text' => 'مشهد'
        ]);

        EstateRequest::create([
            'owner_name' => 'سعید قلی پور',
            'owner_mobile_number' => '09900787232',
            'image' => 'default.png',
            'thumbnail' => 'default-thumbnail.png',
            'estate_id' => 1,
            'address' => 'طلاب - دریای دوم',
            'area_id' => 1,
            'city_id' => 1,
            'transfer_id' => 1,
            'area' => 200,
            /*'street_name' => 'حسینی محراب',*/
            'plaque' => 553,
            'floor' => 3,
            'number_of_floor' => 3,
            'number_of_room' => 1,
            'apartment_unit' => 1,
            'year_of_construction' => 8,
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
