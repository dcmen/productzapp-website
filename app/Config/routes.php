<?php
    Router::connect('/', array('controller' => 'pages', 'action' => 'index'));
    Router::connect('/home_current', array('controller' => 'pages', 'action' => 'index_current'));
    Router::connect('/home', array('controller' => 'pages', 'action' => 'home_login'));
    Router::connect('/forgot_password', array('controller' => 'pages', 'action' => 'forgot_password'));
    
    Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
    Router::connect('/forgot', array('controller' => 'pages', 'action' => 'ajax_forgot'));
    Router::connect('/del_regis_brochure', array('controller' => 'pages', 'action' => 'del_regis_brochure'));
    Router::connect('/del_regis_brochure_search', array('controller' => 'pages', 'action' => 'del_regis_brochure_search'));
    
    Router::connect('/Aboutus', array('controller' => 'pages', 'action' => 'aboutus'));
    Router::connect('/aboutus', array('controller' => 'pages', 'action' => 'aboutus'));
    Router::connect('/AboutUs', array('controller' => 'pages', 'action' => 'aboutus'));
    Router::connect('/contactus', array('controller' => 'pages', 'action' => 'contact'));
    Router::connect('/sendcontactajax', array('controller' => 'pages', 'action' => 'sendcontactajax'));
    Router::connect('/Contactus', array('controller' => 'pages', 'action' => 'contact'));
    Router::connect('/privacypolicy', array('controller' => 'pages', 'action' => 'privacypolicy'));
    Router::connect('/PrivacyPolicy', array('controller' => 'pages', 'action' => 'privacypolicy'));
    Router::connect('/support', array('controller' => 'pages', 'action' => 'support'));
    Router::connect('/support-v220', array('controller' => 'pages', 'action' => 'supportv220'));
    Router::connect('/support-v212', array('controller' => 'pages', 'action' => 'supportv212'));
    Router::connect('/Support', array('controller' => 'pages', 'action' => 'support'));
    Router::connect('/terms', array('controller' => 'pages', 'action' => 'term'));
    Router::connect('/Terms', array('controller' => 'pages', 'action' => 'term'));
    Router::connect('/invite_dealer', array('controller' => 'pages', 'action' => 'invite_dealer'));
    Router::connect('/invite_dealer_sent', array('controller' => 'pages', 'action' => 'invite_dealer_sent'));
    Router::connect('/emailverificationlink', array('controller' => 'pages', 'action' => 'emailverificationlink'));
    Router::connect('/verifychangingemail', array('controller' => 'pages', 'action' => 'verifychangingemail'));
    
    Router::connect('/ajaxsendinvitedealer', array('controller' => 'pages', 'action' => 'ajaxsendinvitedealer'));
    Router::connect('/ajaxsendmail', array('controller' => 'pages', 'action' => 'ajaxsendmail'));
    
    Router::connect('/connect_datafeed', array('controller' => 'Datafeeds', 'action' => 'connect_datafeed'));
    Router::connect('/admin_datafeed_detail', array('controller' => 'Datafeeds', 'action' => 'show'));
    Router::connect('/admin_datafeed_edit', array('controller' => 'Datafeeds', 'action' => 'edit'));
    Router::connect('/update_datafeed', array('controller' => 'Datafeeds', 'action' => 'update'));
    Router::connect('/admin_datafeed_add', array('controller' => 'Datafeeds', 'action' => 'add'));
    Router::connect('/store_datafeed', array('controller' => 'Datafeeds', 'action' => 'store'));
    Router::connect('/del_datafeed', array('controller' => 'Datafeeds', 'action' => 'delete'));

    Router::connect('/admin_datafeed_details_edit', array('controller' => 'Datafeeds', 'action' => 'edit_details'));
    Router::connect('/update_datafeed_details', array('controller' => 'Datafeeds', 'action' => 'update_details'));
    Router::connect('/admin_datafeed_details_add', array('controller' => 'Datafeeds', 'action' => 'add_details'));
    Router::connect('/store_datafeed_details', array('controller' => 'Datafeeds', 'action' => 'store_details'));
    Router::connect('/del_datafeed_details', array('controller' => 'Datafeeds', 'action' => 'delete_details'));

    Router::connect('/admin_company', array('controller' => 'Companies', 'action' => 'index'));
    Router::connect('/admin_address', array('controller' => 'Companies', 'action' => 'index_address'));
    Router::connect('/admin_company_detail', array('controller' => 'Companies', 'action' => 'show'));
    Router::connect('/admin_company_edit', array('controller' => 'Companies', 'action' => 'edit'));
    Router::connect('/update_company', array('controller' => 'Companies', 'action' => 'update'));
    Router::connect('/admin_company_add', array('controller' => 'Companies', 'action' => 'add'));
    Router::connect('/store_company', array('controller' => 'Companies', 'action' => 'store'));
    Router::connect('/del_company', array('controller' => 'Companies', 'action' => 'delete'));
    Router::connect('/admin_address_edit', array('controller' => 'Companies', 'action' => 'editaddress'));
    Router::connect('/update_address', array('controller' => 'Companies', 'action' => 'updateaddress'));

    /*Router::connect('/cardetails', array('controller' => 'Cars', 'action' => 'car_detail'));*/
    Router::connect('/cardetails/:id/:car_name', array('controller' => 'cars', 'action' => 'car_detail_by_key'), array('pass' => array('id', 'car_name')));

    Router::connect('/share/*', array('controller' => 'Cars', 'action' => 'share'));
    Router::connect('/ajaxshare', array('controller' => 'Cars', 'action' => 'ajaxshare'));
    Router::connect('/car_detail_transfer/*', array('controller' => 'Cars', 'action' => 'car_detail_transfer'));
    Router::connect('/flicka', array('controller' => 'Cars', 'action' => 'flicka'));
    Router::connect('/flicka_ajax', array('controller' => 'Cars', 'action' => 'flicka_ajax'));
    Router::connect('/pulse', array('controller' => 'Cars', 'action' => 'pulse'));
    Router::connect('/admin_pulse', array('controller' => 'Cars', 'action' => 'admin_pulse'));
    Router::connect('/addpulse', array('controller' => 'Cars', 'action' => 'addpulse'));
    Router::connect('/loadmynetwork', array('controller' => 'Cars', 'action' => 'loadmynetwork'));
    Router::connect('/loadmygroups', array('controller' => 'Cars', 'action' => 'loadmygroups'));
    Router::connect('/pulse_detail/*', array('controller' => 'Cars', 'action' => 'pulse_detail'));
    Router::connect('/report_pulse/*', array('controller' => 'Cars', 'action' => 'report_pulse'));
    Router::connect('/pulse_user/*', array('controller' => 'Cars', 'action' => 'pulse_user'));
    Router::connect('/del_pulse/*', array('controller' => 'Cars', 'action' => 'del_pulse'));
    Router::connect('/del_report/*', array('controller' => 'Cars', 'action' => 'del_report'));
    Router::connect('/admin_pulse_detail/*', array('controller' => 'Cars', 'action' => 'admin_pulse_detail'));
    Router::connect('/admin_report_pulse/*', array('controller' => 'Cars', 'action' => 'admin_report_pulse'));
    Router::connect('/admin_pulse_user/*', array('controller' => 'Cars', 'action' => 'admin_pulse_user'));
    Router::connect('/admin_add_pulse', array('controller' => 'Cars', 'action' => 'admin_add_pulse'));
    Router::connect('/admin_load_user', array('controller' => 'Cars', 'action' => 'admin_load_user'));
    Router::connect('/admin_add_pulse_step_2', array('controller' => 'Cars', 'action' => 'admin_add_pulse_step_2'));
    Router::connect('/pulse_report', array('controller' => 'Cars', 'action' => 'pulse_report'));
    Router::connect('/pulse_report_detail/*', array('controller' => 'Cars', 'action' => 'pulse_report_detail'));
    Router::connect('/del_pulse_report/*', array('controller' => 'Cars', 'action' => 'del_pulse_report'));
    Router::connect('/del_report_pulse/*', array('controller' => 'Cars', 'action' => 'del_report_pulse'));

    Router::connect('/list_car_no_data', array('controller' => 'Cars', 'action' => 'list_car_no_data'));
    Router::connect('/set_display_car_ajax', array('controller' => 'Cars', 'action' => 'set_display_car_ajax'));
    
    Router::connect('/list_car', array('controller' => 'Cars', 'action' => 'list_car'));
    Router::connect('/view_car/*', array('controller' => 'Cars', 'action' => 'view_car'));
    Router::connect('/edit_car/*', array('controller' => 'Cars', 'action' => 'edit_car'));
    //Analysis in web admin
    Router::connect('/list_car_analysis', array('controller' => 'Cars', 'action' => 'list_car_analysis'));
    Router::connect('/view_car_analysis/*', array('controller' => 'Cars', 'action' => 'view_car_analysis'));
    Router::connect('/analytic', array('controller' => 'Analytics', 'action' => 'analytic'));

    Router::connect('/del_stock/*', array('controller' => 'Cars', 'action' => 'del_stock'));
    
    Router::connect('/carsforsale', array('controller' => 'cars', 'action' => 'cars_for_sale'));
    Router::connect('/resultcarsforsale', array('controller' => 'cars', 'action' => 'resultcarsforsale'));

    Router::connect('/set_forget', array('controller' => 'cars', 'action' => 'set_forget'));
    Router::connect('/get_setforget', array('controller' => 'cars', 'action' => 'get_setforget'));
    Router::connect('/set_forget_manage_current', array('controller' => 'cars', 'action' => 'set_forget_manage_current'));
    Router::connect('/set_forget_view', array('controller' => 'cars', 'action' => 'set_forget_view'));
    Router::connect('/set_forget_id/*', array('controller' => 'cars', 'action' => 'set_forget_id'));
    Router::connect('/set_forget_search', array('controller' => 'cars', 'action' => 'set_forget_search'));
    Router::connect('/set_forget_search_customer', array('controller' => 'cars', 'action' => 'set_forget_search_customer'));
    Router::connect('/getsetforgetflicka', array('controller' => 'cars', 'action' => 'getsetforgetflicka'));

    Router::connect('/followed', array('controller' => 'cars', 'action' => 'followed'));

    Router::connect('/analysis/*', array('controller' => 'cars', 'action' => 'analysis'));
    
    Router::connect('/my_stock/*', array('controller' => 'cars', 'action' => 'my_stock'));
    Router::connect('/view_stock', array('controller' => 'cars', 'action' => 'view_stock'));
    Router::connect('/other_stock', array('controller' => 'cars', 'action' => 'other_stock'));
    Router::connect('/car_my_network', array('controller' => 'cars', 'action' => 'car_my_network'));
    Router::connect('/add_stock_by_manual', array('controller' => 'cars', 'action' => 'add_stock_by_manual'));
    Router::connect('/add_stock_by_vin', array('controller' => 'cars', 'action' => 'add_stock_by_vin'));
    Router::connect('/hidden_stock', array('controller' => 'cars', 'action' => 'hidden_stock'));
    
    Router::connect('/transaction', array('controller' => 'cars', 'action' => 'transaction'));
    Router::connect('/customer', array('controller' => 'cars', 'action' => 'customer'));
    Router::connect('/editcustomer/*', array('controller' => 'cars', 'action' => 'editcustomer'));
    Router::connect('/addcustomer', array('controller' => 'cars', 'action' => 'addcustomer'));
    Router::connect('/customer_del/*', array('controller' => 'cars', 'action' => 'customer_del'));
    Router::connect('/customer_search', array('controller' => 'cars', 'action' => 'customer_search'));
    
    Router::connect('/offerboard', array('controller' => 'cars', 'action' => 'offerboard'));
    Router::connect('/tenderoffer', array('controller' => 'cars', 'action' => 'tenderoffer'));
    Router::connect('/ajaxgetcountmenunotify', array('controller' => 'cars', 'action' => 'ajaxgetcountmenunotify'));
    Router::connect('/ajaxgetcountothermenunotify', array('controller' => 'cars', 'action' => 'ajaxgetcountothermenunotify'));
    Router::connect('/ajaxgetimageflicka', array('controller' => 'cars', 'action' => 'ajaxgetimageflicka'));
    
    Router::connect('/mynetwork', array('controller' => 'networks', 'action' => 'mynetwork'));
    Router::connect('/block_network', array('controller' => 'networks', 'action' => 'block_network'));
    Router::connect('/network_info_user', array('controller' => 'networks', 'action' => 'network_info_user'));
    Router::connect('/request_network', array('controller' => 'networks', 'action' => 'request_network'));
    Router::connect('/network_del/*', array('controller' => 'networks', 'action' => 'network_del'));
    Router::connect('/blockuser/*', array('controller' => 'networks', 'action' => 'blockuser'));
    Router::connect('/unblockuser/*', array('controller' => 'networks', 'action' => 'unblockuser'));
    Router::connect('/group', array('controller' => 'networks', 'action' => 'group'));
    Router::connect('/add_group', array('controller' => 'networks', 'action' => 'add_group'));
    Router::connect('/group_detail/*', array('controller' => 'networks', 'action' => 'group_detail'));
    Router::connect('/edit_group/*', array('controller' => 'networks', 'action' => 'edit_group'));
    Router::connect('/get_list_dealer_not_in_group', array('controller' => 'networks', 'action' => 'getlistdealernotingroup'));
    Router::connect('/add_group_member', array('controller' => 'networks', 'action' => 'add_group_member'));
    
    Router::connect('/transfer', array('controller' => 'Transfers', 'action' => 'index'));
    Router::connect('/add_transfers', array('controller' => 'cars', 'action' => 'add_transfers'));
    Router::connect('/sellcar', array('controller' => 'cars', 'action' => 'sellcar'));
    Router::connect('/update_sell_buy', array('controller' => 'cars', 'action' => 'update_sell_buy'));
    Router::connect('/cancel_transfers', array('controller' => 'cars', 'action' => 'cancel_transfers'));
    Router::connect('/update_accept', array('controller' => 'cars', 'action' => 'update_accept'));
    Router::connect('/car_detail_action_page', array('controller' => 'cars', 'action' => 'car_detail_action_page'));
    Router::connect('/share_car_setting', array('controller' => 'cars', 'action' => 'share_car_setting'));
    Router::connect('/setting_make_offer', array('controller' => 'cars', 'action' => 'setting_make_offer'));
    Router::connect('/setting_tender', array('controller' => 'cars', 'action' => 'setting_tender'));
    
    Router::connect('/sign_up', array('controller' => 'facebooks', 'action' => 'sign_up_1'));
    Router::connect('/loginfb', array('controller' => 'facebooks', 'action' => 'loginfb'));
    Router::connect('/fbcallback', array('controller' => 'facebooks', 'action' => 'fbcallback'));
    Router::connect('/download', array('controller' => 'facebooks', 'action' => 'download'));
    Router::connect('/checkcompany', array('controller' => 'facebooks', 'action' => 'checkcompany'));
    Router::connect('/infocompany', array('controller' => 'facebooks', 'action' => 'infocompany'));
    Router::connect('/searchcompanyajax', array('controller' => 'facebooks', 'action' => 'searchcompanyajax'));
    Router::connect('/register_payment', array('controller' => 'facebooks', 'action' => 'register_payment'));
    Router::connect('/finish_step_3', array('controller' => 'facebooks', 'action' => 'finish_step_3'));
    Router::connect('/finish_step_4', array('controller' => 'facebooks', 'action' => 'finish_step_4'));
    Router::connect('/login_payment', array('controller' => 'facebooks', 'action' => 'login_payment'));
    Router::connect('/login_payment_web', array('controller' => 'facebooks', 'action' => 'login_payment_web'));
    Router::connect('/subscription', array('controller' => 'facebooks', 'action' => 'subscription'));
    
    Router::connect('/logintw', array('controller' => 'twitters', 'action' => 'logintw'));
    Router::connect('/twcallback', array('controller' => 'twitters', 'action' => 'twcallback'));
    
    Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
    Router::connect('/logout_admin', array('controller' => 'users', 'action' => 'logout_admin'));
    Router::connect('/myprofile', array('controller' => 'users', 'action' => 'myprofile'));
    Router::connect('/profileuser/*', array('controller' => 'users', 'action' => 'profileuser'));
    Router::connect('/changepassword', array('controller' => 'users', 'action' => 'changepassword'));

    Router::connect('/admin', array('controller' => 'Users', 'action' => 'admin_login','admin' => true));
    Router::connect('/all_user', array('controller' => 'Users', 'action' => 'all_user'));
    Router::connect('/sendmail', array('controller' => 'Users', 'action' => 'sendmail'));
    Router::connect('/inactivate_user', array('controller' => 'Users', 'action' => 'inactivate_user'));
    Router::connect('/view_os', array('controller' => 'Users', 'action' => 'view_os'));
    Router::connect('/view_info_user/*', array('controller' => 'Users', 'action' => 'view_info_user'));
    Router::connect('/edit_info_user/*', array('controller' => 'Users', 'action' => 'edit_info_user'));
    Router::connect('/activate_user', array('controller' => 'Users', 'action' => 'activate_user'));
    Router::connect('/getlistmailuser', array('controller' => 'users', 'action' => 'getlistmailuser')); 
    Router::connect('/import_user', array('controller' => 'Users', 'action' => 'import_user'));   
    Router::connect('/redeemcodes', array('controller' => 'RedeemCodes', 'action' => 'index'));
    Router::connect('/create_code', array('controller' => 'RedeemCodes', 'action' => 'create_code'));
    Router::connect('/list_register', array('controller' => 'Users', 'action' => 'list_register'));
    
    Router::connect('/redeemcodeactive', array('controller' => 'Devices', 'action' => 'index'));
    Router::connect('/create_code_active', array('controller' => 'Devices', 'action' => 'create_code_active'));
    
    Router::connect('/purchaseapps', array('controller' => 'PurchaseApps', 'action' => 'index'));
    Router::connect('/in_app_purchase', array('controller' => 'PurchaseApps', 'action' => 'in_app_purchase'));
    
    Router::connect('/price_sell_app', array('controller' => 'OptionPaypals', 'action' => 'index'));
    Router::connect('/edit_price/*', array('controller' => 'OptionPaypals', 'action' => 'edit'));
    Router::connect('/add_price', array('controller' => 'OptionPaypals', 'action' => 'add'));

    Router::connect('/other_notifications', array('controller' => 'OtherNotifications', 'action' => 'index'));
    Router::connect('/notifications', array('controller' => 'OtherNotifications', 'action' => 'index_notification'));
    Router::connect('/notification_setting', array('controller' => 'OtherNotifications', 'action' => 'notification_setting'));
    Router::connect('/ajaxreadtypenotification', array('controller' => 'OtherNotifications', 'action' => 'ajaxreadtypenotification'));
    Router::connect('/ajaxgetcountothermenunotify', array('controller' => 'cars', 'action' => 'ajaxgetcountothermenunotify'));
    Router::connect('/ajaxgetcountcarsnotify', array('controller' => 'OtherNotifications', 'action' => 'ajaxgetcountcarsnotify'));
    Router::connect('/ajaxgetcountothernotify', array('controller' => 'OtherNotifications', 'action' =>'ajaxgetcountothernotify'));
    Router::connect('/get_new_notify_ajax1', array('controller' => 'OtherNotifications', 'action' =>'get_new_notify_ajax1'));

    Router::connect('/payment/*', array('controller' => 'Payments', 'action' => 'index'));
    Router::connect('/checkoutreturn/*', array('controller' => 'Payments', 'action' => 'checkoutreturn'));
    Router::connect('/ajaxpurchase', array('controller' => 'Payments', 'action' => 'ajaxpurchase'));
    
    Router::connect('/list_regis_brochures', array('controller' => 'Regisbrochures', 'action' => 'index'));
    Router::connect('/result_search_brochures', array('controller' => 'Regisbrochures', 'action' => 'result_search'));

    Router::connect('/checkoutreturnPayWay', array('controller' => 'Payments', 'action' => 'checkoutreturnPayWay'));
    
    Router::connect('/logtimes', array('controller' => 'Logtimes', 'action' => 'index'));

    //send email for tender
    Router::connect('/email_send_tender', array('controller' => 'EmailContents', 'action' => 'email_send_tender'));
    CakePlugin::routes();
    require CAKE . 'Config' . DS . 'routes.php';
