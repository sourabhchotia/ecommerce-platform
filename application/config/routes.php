<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'Main_controller';
$route['404_override'] = 'error_page/page_not_found';
$route['translate_uri_dashes'] = FALSE;


$route['404-error'] = 'error_page/page_not_found';

$route['admin/404-error'] = 'admin/error_page/page_not_found';

// Admin Registration and Login Routes;

$route['admin'] = 'admin/Main_controller';
$route['admin-login'] = 'admin/Main_controller/admin_login';

$route['admin-logout'] = 'admin/Main_controller/admin_logout';

// Dash board Route
$route['admin/dashboard'] = 'admin/dashboard/dashboard';


// Category Routes

$route['admin/category/parent-category'] = 'admin/category/category_management';
$route['admin/category/main-category'] = 'admin/category/category_management/main_category';
$route['admin/category/sub-category'] = 'admin/category/category_management/sub_category';
$route['admin/category/inner-category'] = 'admin/category/category_management/inner_category';
$route['admin/category/save-category'] = 'admin/category/category_management/save_category';
$route['admin/category/get-categories-ajax'] = 'admin/category/category_management/get_ajax_category';
$route['admin/category/change-category-status'] = 'admin/category/category_management/change_status';
$route['admin/category/edit-category'] = 'admin/category/category_management/edit_category';


// Attribute Routes

$route['admin/attributes/add-attribute'] = 'admin/attribute/attribute_management';
$route['admin/attributes/save-attribute'] = 'admin/attribute/attribute_management/add_attributes';
$route['admin/attributes/change-attribute-status'] = 'admin/attribute/attribute_management/change_att_status';
$route['admin/attributes/get-attribute'] = 'admin/attribute/attribute_management/get_attribute';

	// Attribute Options Routes

	$route['admin/attributes/add-options'] = 'admin/attribute/attribute_management/add_attribute_options';
	$route['admin/attributes/save-option'] = 'admin/attribute/attribute_management/save_attribute_option';
	$route['admin/attributes/change-option-status'] = 'admin/attribute/attribute_management/change_attribute_option_status';
	$route['admin/attributes/get-option'] = 'admin/attribute/attribute_management/get_attribute_option';

	// Other Attribute Related Routes
	$route['admin/attributes/get-attribute-options'] = 'admin/attribute/attribute_management/get_attribute_options';
	$route['admin/attributes/assign-attributes-to-category'] = 'admin/attribute/attribute_management/assign_to_attribute';
	$route['admin/attributes/save-options-to-attributes'] = 'admin/attribute/attribute_management/save_to_attribute';
	$route['admin/attributes/edit-options-to-attributes'] = 'admin/attribute/attribute_management/edit_assigned_attribute';
	$route['admin/attributes/update-options-to-attributes'] = 'admin/attribute/attribute_management/update_assigned_attribute';

// Brands Routes

	$route['admin/brands/add-brand'] = 'admin/brands/brands_management';
	$route['admin/brands/save-brands'] = 'admin/brands/brands_management/save_brands';
	$route['admin/brands/edit-brand'] = 'admin/brands/brands_management/edit_brand';
	$route['admin/brands/change-brand-status'] = 'admin/brands/brands_management/change_brand_status';

// Product Routes

$route['admin/products/add-product'] = 'admin/products/product_management';
$route['admin/products/add-wholesale-rates'] = 'admin/products/product_management/wholesale_rates';

$route['admin/products/get-attributes-by-category'] = 'admin/products/product_management/get_attribute_by_category';
$route['admin/products/save-products'] = 'admin/products/product_management/save_products';
$route['admin/products/products-listing'] = 'admin/products/product_management/all_products';
$route['admin/products/get-products-listing'] = 'admin/products/product_management/get_product_listing';
$route['admin/products/update-status'] = 'admin/products/product_management/update_status';
$route['admin/products/edit-product'] = 'admin/products/product_management/edit_product';
$route['admin/products/update-products'] = 'admin/products/product_management/update_product';
$route['admin/products/import-export-products'] = 'admin/products/product_management/import_export_products';
$route['admin/products/import-products'] = 'admin/products/product_management/import_products';
$route['admin/products/export-products'] = 'admin/products/product_management/export_products';
$route['admin/products/upload-media-files'] = 'admin/products/product_management/mediaFiles';
$route['admin/products/save-media'] = 'admin/products/product_management/upload_media';
$route['admin/products/delete-media'] = 'admin/products/product_management/delete_media';

$route['admin/products/product-stock'] = 'admin/products/product_management/all_products_stock';
$route['admin/products/get-products-stock'] = 'admin/products/product_management/get_product_stock';

$route['admin/products/update-stock'] = 'admin/products/product_management/update_stock';


$route['admin/products/sale-exceptions'] = 'admin/products/product_management/sale_exceptions';
$route['admin/products/sale-exception-product'] = 'admin/products/product_management/get_product_sale_exceptions';
$route['admin/products/save-sale-exceptions'] = 'admin/products/product_management/save_exceptions';


$route['admin/products/get-product-by-ajax'] = 'admin/products/product_management/get_product_by_ajax';

$route['admin/products/save-wholesale-rate'] = 'admin/products/product_management/save_wholesale_rates';

// Blogs Routes

$route['admin/blogs/blogs-category'] = 'admin/blogs/blogs_management';
$route['admin/blogs/get-category-by-ajax'] = 'admin/blogs/blogs_management/get_category_by_ajax';
$route['admin/blogs/add-blog'] = 'admin/blogs/blogs_management/add_blog';
$route['admin/blogs/blogs-listing'] = 'admin/blogs/blogs_management/blogs_listing';
$route['admin/blogs/blog-comments'] = 'admin/blogs/blogs_management/comments_listing';

$route['admin/blogs/save-blogs-category'] = 'admin/blogs/blogs_management/save_blogs_category';
$route['admin/blogs/change-blogs-category-status'] = 'admin/blogs/blogs_management/change_category_status';
$route['admin/blogs/edit-blogs-category'] = 'admin/blogs/blogs_management/get_category';

$route['admin/blogs/save-blog'] = 'admin/blogs/blogs_management/save_blog';
$route['admin/blogs/get-blogs-listing'] = 'admin/blogs/blogs_management/get_blogs_listing';
$route['admin/blogs/update-blog-status'] = 'admin/blogs/blogs_management/disable_blogs';
$route['admin/blogs/edit-blog/(:any)'] = 'admin/blogs/blogs_management/edit_blog/$1';
$route['admin/blogs/update-blog'] = 'admin/blogs/blogs_management/update_blog';



/*
	
	Order Routing URL's

*/

$route['admin/orders/order-listing'] = 'admin/orders/order_management';
$route['admin/orders/wholesale-order-listing'] = 'admin/orders/order_management/wholesale_orders';
$route['admin/orders/order-detail'] = 'admin/orders/order_management/order_detail';
$route['admin/orders/order-invoice'] = 'admin/orders/order_management/order_invoice';
$route['admin/orders/order-status-update'] = 'admin/orders/order_management/order_status_update';

$route['admin/orders/return-request-listing'] = 'admin/orders/order_management/return_listing';


/*
	
	Location Routing 

	Author : Sourabh Chotia

*/

$route['admin/location/countries'] = 'admin/location/location_management';
$route['admin/location/add-country'] = 'admin/location/location_management/add_country';
$route['admin/location/update-country'] = 'admin/location/location_management/update_country_status';
$route['admin/location/edit-country'] = 'admin/location/location_management/edit_country';



$route['admin/location/states'] = 'admin/location/location_management/states';
$route['admin/location/add-state'] = 'admin/location/location_management/add_state';
$route['admin/location/update-state'] = 'admin/location/location_management/update_state_status';
$route['admin/location/edit-state'] = 'admin/location/location_management/edit_state';



$route['admin/location/cities'] = 'admin/location/location_management/cities';
$route['admin/location/add-city'] = 'admin/location/location_management/add_city';
$route['admin/location/update-city'] = 'admin/location/location_management/update_city_status';
$route['admin/location/edit-city'] = 'admin/location/location_management/edit_city';


$route['admin/location/zipcodes'] = 'admin/location/location_management/zipcodes';
$route['admin/location/add-zipcode'] = 'admin/location/location_management/add_zipcode';
$route['admin/location/update-zipcode'] = 'admin/location/location_management/update_zipcode_status';
$route['admin/location/edit-zipcode'] = 'admin/location/location_management/edit_zipcode';



$route['admin/location/get-state-from-country'] = 'admin/location/location_management/get_state_by_country';
$route['admin/location/get-city-from-state'] = 'admin/location/location_management/get_city_by_state';
$route['admin/location/get-zipcode-from-city'] = 'admin/location/location_management/get_zipcode_by_city';

/*
	
	Page SEO Setting URL
	AUTHOR : Sourabh Chotia

*/

$route['admin/page-seo-setting'] = 'admin/seo/seo_management';
$route['admin/get-page-detail'] = 'admin/seo/seo_management/get_page';
$route['admin/save-page-detail'] = 'admin/seo/seo_management/save_page';
$route['admin/slider-settings'] = 'admin/seo/seo_management/sliders';
$route['admin/save-slider'] = 'admin/seo/seo_management/save_slider';
$route['admin/edit-slider'] = 'admin/seo/seo_management/get_slider';
$route['admin/change-slider-status'] = 'admin/seo/seo_management/change_slider_status';

/*
	Admin User Listing Routes
	Author : Sourabh Chotia
*/


$route['admin/users/user-listing'] = 'admin/users/user_management';
$route['admin/users/user-detail'] = 'admin/users/user_management/user_details';
$route['admin/users/block-user'] = 'admin/users/user_management/change_status';

/*

	Admin Profile and site setting Management and Sub Admin Management URLs
	Author : Sourabh Chotia
*/

$route['admin/profile'] = 'admin/profile/profile_management';
$route['admin/update-profile'] = 'admin/profile/profile_management/update_profile';
$route['admin/change-password'] = 'admin/profile/profile_management/change_password';

$route['admin/add-new-admin'] = 'admin/profile/profile_management/add_admin';
$route['admin/save-admin'] = 'admin/profile/profile_management/save_admin';
$route['admin/edit-admin'] = 'admin/profile/profile_management/get_admin';
$route['admin/change-admin-status'] = 'admin/profile/profile_management/change_admin_status';




$route['admin/settings/site-settings'] = 'admin/site_settings';
$route['admin/settings/save-settings'] = 'admin/site_settings/save_settings';

$route['admin/settings/payment-settings'] = 'admin/site_settings/payment_settings';
$route['admin/settings/save-payment-settings'] = 'admin/site_settings/save_payment_settings';

/*

	User Routing From Here.

	Author : Sourabh Chotia

*/

	// Basic URLs

$route['cart'] = 'user/cart/cart_management';
$route['checkout'] = 'user/checkout/checkout_management';
$route['contact-us'] = 'user/contact/contact_management';
$route['my-wishlist'] = 'user/product/product_management/user_wishlist';
$route['my-account'] = 'user/profile/profile_management';
$route['my-orders'] = 'user/order/order_management';
$route['order-detail'] = 'user/order/order_management/order_detail';
$route['order-invoice'] = 'user/order/order_management/order_invoice';
$route['return-request'] = 'user/order/order_management/return_request';
$route['save-return-request'] = 'user/order/order_management/save_return_request';
$route['cancel-request'] = 'user/order/order_management/cancel_request';

$route['change-combination-by-id'] = 'user/product/product_management/change_slug_by_id';


// USER PROFILE URLs
$route['user-registration-verification'] = 'user/profile/profile_management/signup_verification';
$route['user-registration-completion'] = 'user/profile/profile_management/signup_complete';
$route['user-login'] = 'user/profile/profile_management/login';
$route['update-profile'] = 'user/profile/profile_management/update_profile';
$route['save-address'] = 'user/profile/profile_management/add_address';
$route['delete-address'] = 'user/profile/profile_management/delete_address';
$route['check-zip'] = 'user/profile/profile_management/check_zip';
$route['check-delivery-status'] = 'user/cart/cart_management/check_zip';
$route['update-password'] = 'user/profile/profile_management/change_password';

// PRODUCT ACTION URLs

$route['add-to-wishlist'] = 'user/product/product_management';
$route['order-confirmation'] = 'user/checkout/checkout_management/order_confirmation';
$route['remove-wishlist-product'] = 'user/product/product_management/remove_wishlist';
$route['add-to-cart'] = 'user/cart/cart_management/add_to_cart';
$route['delete-cart-item'] = 'user/cart/cart_management/delete_cart';
$route['update-cart'] = 'user/cart/cart_management/update_cart';



// LOGOUT URL
$route['user-logout'] = 'user/profile/profile_management/logout';

// Sync URL

$route['admin/sync/Sync'] = 'admin/sync/Sync';
$route['admin/sync/Sync_server'] = 'admin/sync/Sync_server';
$route['admin/sync/Sync/online_data_sync'] = 'admin/sync/Sync/online_data_sync';
$route['admin/sync/Sync_server/send_data_back'] = 'admin/sync/Sync_server/send_data_back';






// API URL

$route['admin/api/rest'] = 'Rest_server';
$route['api/example/users'] = 'api/Example/users_get';

// DYNAMIC URLs

$route['(:any)'] = 'user/url/Slug_management/index/$1';
$route['(:any)/(:any)'] = 'user/url/Slug_management/index/$1/$2';
$route['(:any)/(:any)/(:any)'] = 'user/url/Slug_management/index/$1/$2/$3';
$route['(:any)/(:any)/(:any)/(:any)'] = 'user/url/Slug_management/index/$1/$2/$3/$4';


