<?php
$siteViews = [
    'site.view.login' => 'تسجيل الدخول',
    'site.view.remember_me' => ' تذكرني',
    'site.view.username' => 'اسم المستخدم',
    'site.view.password' => 'كلمة المرور',
    'site.view.create_an_account' => 'إنشاء حساب؟',
    'site.view.sign_up' => 'تسجيل حساب جديد',
    'site.view.my_shops' => 'متاجري',
    'site.view.profile' => 'الملف الشخصي',
    "site.view.login_form_error" => "اسم المستخدم أو كلمة المرور غير صحيحة.",
    "nav.logout" => "تسجيل الخرج",

    "site.index.search" => "بحث",
    "site.index.items" => "العناصر",

    "site.login.welcome" => "أهلا بك",
    'site.sign_up.email' => 'البريد الإلكتروني',
];

$shop = [
    "shop.fields.name" => "الاسم",
    "shop.fields.name_ar" => "الاسم بالعربية",
    "shop.fields.phone_number" => "رقم الهاتف",
    "shop.fields.description" => "الوصف",
    "shop.fields.description_ar" => "الوصف باللغة العربية",
    "shop.fields.open_at" => "فتح عند",
    "shop.fields.close_at" => "إغلاق عند",
    "shop.fields.rate" => "التقيم",
    "shop.fields.status" => "الحالة",
    "shop.fields.picture" => "صورة",
    "shop.fields.pick_image" => "اختر صورة",
    "shop.add_shop" => "إضافة متجر",
    "shop.update_shop" => "تحديث متجر",
];

$category = [
    'category.title' => "التصنيفات",
    'category.add_btn' => "إضافة فئة",
    'category.update_btn' => "تحديث الفئة",
    'category.add_name_btn' => "أضف اسم الفئة",
    'category.fields.name' => "الاسم",
    'category.fields.name_ar' => "الاسم بالعربية",
    'category.added_message_1' => "قبل المسؤول اسم الفئة",
    'category.added_message_2' => "قبل المسؤول أسماء الفئات",
    'category.add_message' => "شكرا لك على إضافة اسم الفئة. سنقبل به في أقرب وقت ممكن.",
];

$item = [
    "item.title" => "العناصر",
    "item.add_btn" => "اضافة عنصر",
    "item.view_btn" => "عرض العنصر",
    "item.update_btn" => "تحديث العنصر",
    "item.fields.name" => "الاسم باللغة الإنجليزية",
    "item.fields.name_ar" => "الاسم بالعربية",
    "item.fields.price_after_sale" => "السعر بعد الخصم",
    "item.fields.old_price" => "السعر القديم",
    "item.fields.description" => "الوصف بالإنجليزية",
    "item.fields.description_ar" => "الوصف باللغة العربية",
    "item.fields.picture" => "صورة",
    "item.fields.category" => "اسم الفئة",
    "item.add_arabic_translations" => "إضافة الترجمة باللغة العربية",
    "item.update_arabic_translations" => "تحديث الترجمة بالعربية",

    "item.search.fields.item_name" => "اسم العنصر",
    "item.search.fields.shop_rate" => "تقييم المتجر",
    "item.search.fields.nearest_shops" => "أقرب المحلات",
    "item.search.fields.lowest_price" => "أقل سعر",
];

$buttons = [
    "buttons.update" => "تحديث",
    "buttons.feedback" => "موجز",
    "buttons.send" => "إرسال",
    "buttons.delete" => "حذف",
    "buttons.submit" => "التأكد",
    "buttons.save" => "حفظ",
    "buttons.add" => "إضافة",
    "buttons.filter" => "تصفية",
    "buttons.edit_password" => "تحرير كلمة المرور !!",
];

return array_merge($siteViews, $shop, $buttons, $category, $item);