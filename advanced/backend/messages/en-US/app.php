<?php
$siteViews = [
    'site.view.login' => 'Login',
    'site.view.remember_me' => 'Remember Me',
    'site.view.username' => 'Username',
    'site.view.password' => 'Password',
    'site.view.create_an_account' => 'Create an account?',
    'site.view.sign_up' => 'Sign up',
    'site.view.my_shops' => 'My Shops',
    'site.view.profile' => 'Profile',
    "site.view.login_form_error" => "Incorrect username or password.",
    "nav.logout" => "Logout",

    "site.index.search" => "Search",
    "site.index.items" => "Items",

    "site.login.welcome" => "WELCOME",
    'site.sign_up.email' => 'Email',
];

$shop = [
    "shop.fields.name" => "Name",
    "shop.fields.name_ar" => "Name in Arabic",
    "shop.fields.phone_number" => "Phone Number",
    "shop.fields.description" => "Description",
    "shop.fields.description_ar" => "Description in Arabic",
    "shop.fields.open_at" => "Open At",
    "shop.fields.close_at" => "Close At",
    "shop.fields.rate" => "Rate",
    "shop.fields.status" => "Status",
    "shop.fields.picture" => "Picture",
    "shop.fields.pick_image" => "Pick image",
    "shop.add_shop" => "Add Shop",
    "shop.update_shop" => "Update Shop",
];

$category = [
    'category.title' => "Categories",
    'category.add_btn' => "Add Category",
    'category.update_btn' => "Update Category",
    'category.add_name_btn' => "Add Category Name",
    'category.fields.name' => "Name",
    'category.fields.name_ar' => "Name in Arabic",
    'category.added_message_1' => "Admin accepted the category name",
    'category.added_message_2' => "Admin accepted the category names",
    'category.add_message' => "Thank you for adding category name. We will accepted it as soon as possible.",
];

$item = [
    "item.title" => "Items",
    "item.add_btn" => "Add Item",
    "item.view_btn" => "View Item",
    "item.update_btn" => "Update Item",
    "item.fields.name" => "Name",
    "item.fields.name_ar" => "Name in Arabic",
    "item.fields.price_after_sale" => "Price after sale",
    "item.fields.old_price" => "Old Price",
    "item.fields.description" => "Description",
    "item.fields.description_ar" => "Description in Arabic",
    "item.fields.picture" => "Picture",
    "item.fields.category" => "Category Name",
    "item.add_arabic_translations" => "Add translation in Arabic",
    "item.update_arabic_translations" => "Update translation in Arabic",

    "item.search.fields.item_name"=>"Item Name",
    "item.search.fields.shop_rate"=>"Shop Rate",
    "item.search.fields.nearest_shops"=>"Nearest Shops",
    "item.search.fields.lowest_price"=>"Lowest Price",
];

$buttons = [
    "buttons.update" => "Update",
    "buttons.feedback" => "Feedback",
    "buttons.send" => "Send",
    "buttons.delete" => "Delete",
    "buttons.submit" => "Submit",
    "buttons.save" => "Save",
    "buttons.add" => "Add",
    "buttons.filter" => "Filter",
    "buttons.edit_password" => "Edit Password !!",
];

return array_merge($siteViews, $shop, $buttons, $category, $item);