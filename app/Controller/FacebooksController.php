<?php

//if (!session_id()) {
//    session_start();
//}
require_once ROOT . './app/Plugin/fb/src/Facebook/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;

App::uses('AppController', 'Controller','StringAction');
Configure::load('facebook');
App::import('Vendor', 'phpmailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php'));
Configure::load('api');
class FacebooksController extends AppController {
    public $components = array('Curl','CurlApi');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('login_payment_web', 'checkaddress', 'login_payment', 'save_data_feed', 'finish_step_5', 'finish_step_4', 'finish_step_3', 'register_payment', 'postRegisterPayment', 'getSuggestion', 'register_step_3', 'register_back', 'loginfb', 'fbcallback', 'sign_up_1', 'register_step_1', 'register_step_2', 'check_code', 'register_3', 'download','checkcompany','infocompany'));
    }
   
    function loginfb() {
        $this->autoRender = false;
        $fb = new Facebook\Facebook([
            'app_id' => Configure::read('Facebook.appId'),
            'app_secret' => Configure::read('Facebook.secret'),
            'default_graph_version' => 'v2.4',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $link = Router::url(array('controller' => 'facebooks', 'action' => 'fbcallback'), false);
        $loginUrl = $helper->getLoginUrl('http://'.$_SERVER['SERVER_NAME'].$link, $permissions);
        return $this->redirect($loginUrl);
    }

    function fbcallback() {
        $this->autoRender = false;
        $fb = new Facebook\Facebook([
            'app_id' => Configure::read('Facebook.appId'),
            'app_secret' => Configure::read('Facebook.secret'),
            'default_graph_version' => 'v2.4',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error  
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues  
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
            return $this->redirect('/sign_up');
            exit;
        }

        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,first_name,last_name,email,gender,birthday,picture.width(100).height(100)', $accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            //echo 'Facebook SDK returned an error: ' . $e->getMessage();
            return $this->redirect('/sign_up');
            exit;
        }

        $object = $response->getGraphObject();
        $this->Session->write('email_rg', $object->getProperty('email'));
        $this->Session->write('first_name_rg', $object->getProperty('first_name'));
        $this->Session->write('last_name_rg', $object->getProperty('last_name'));
        $this->Session->write('phone_rg', $object->getProperty('phone'));
        $this->Session->write('fb_picture', $object->getProperty('picture')->asArray()["url"]);

        return $this->redirect("/sign_up");
    }

    function getSuggestion() {
        $this->autoRender = false;
        $this->layout = null;
        
        // call api
        $url = Configure::read('api.api_url').'api/user/getsuggestaddress';
        $result = json_decode($this->CurlApi->to($url)->get());
        
        return $result;
    }
    
    function register_payment() {
        $this->set('title_for_layout', 'Sign up');
        $this->layout = 'skin';
        $this->autoRender = false;

        $token = $this->params['url']['token'];
        $email = $this->params['url']['email'];
        $userId = $this->params['url']['userId'];
        
        $mobile = 1;
        
        $this->set(compact('step', 'email', 'token', 'userId', 'mobile'));
        $this->render('sign_up_step_3');
    }
    
    function login_payment() {
        $this->set('title_for_layout', 'Payment');
        $this->layout = 'skin';
        $this->autoRender = false;

        $token = $this->params['url']['token'];
        $email = $this->params['url']['email'];
        $userId = $this->params['url']['userId'];
        
        $mobile = 1;
        $login = 1;
        
        $this->set(compact('step', 'email', 'token', 'userId', 'mobile', 'login'));
        $this->render('sign_up_step_3');
    }
    
    function login_payment_web() {
        $this->set('title_for_layout', 'Payment');
        $this->layout = 'skin';
        $this->autoRender = false;

        $token = $this->params['url']['token'];
        $email = $this->params['url']['email'];
        $userId = $this->params['url']['userId'];
        
        $mobile = 0;
        $login = 1;
        
        $this->set(compact('step', 'email', 'token', 'userId', 'mobile', 'login'));
        $this->render('sign_up_step_3');
    }
    
    function postRegisterPayment() {
        $this->layout = null;
        $this->autoRender = false;
        
        $email = $this->request->data['email'];
        $token = $this->request->data['token'];
        $userId = $this->request->data['userId'];
        $payment_type = $this->request->data['payment_type'];
        $quantity = $this->request->data['quantity'];
        $payment_method = $this->request->data['payment_method'];
        $card_name = $this->request->data['card_name'];
        $card_number = $this->request->data['card_number'];
        $card_verification_number = $this->request->data['card_verification_number'];
        $card_expiry_month = $this->request->data['card_expiry_month'];
        $card_expiry_year = $this->request->data['card_expiry_year'];
        $total_price = $this->request->data['total_price'];
        
        $firstName = '';
        $info = $this->Session->read('regis_rs_info');
        if($info && isset($info->name)) {
            $firstName = $info->name;
        }

        // call api
        $url = Configure::read('api.api_url').'api/user/paywaytransactionasregisterapp';
        $header = array(
            'sessionid:' . $token
        );
        $body = array(
            "user_id" => $userId,
            "payment_type" => $payment_type,
            "quantity" => $quantity,
            "payment_method" => $payment_method,
            "card_name" => $card_name,
            "card_number" => $card_number,
            "card_verification_number" => $card_verification_number,
            "card_expiry_month" => $card_expiry_month,
            "card_expiry_year" => $card_expiry_year,
            "total_price" => $total_price,
            "receipt_email" => $email,
            "first_name" => $firstName
        );
        //echo json_encode($body); die();
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //echo json_encode($result); die();
        
        if ($result && isset($result->status) && $result->status == 'success') {
            if ($payment_type == 0) {
                $data['error'] = 0;
            }
            else {
                if (isset($result->payway_code->summaryCode) && $result->payway_code->summaryCode == 0) {
                    $data['error'] = 0;
                }
                else {
                    $data['error'] = 1;
                    if (isset($result->payway_code->responseText)) {
                        $data['msg'] = $result->payway_code->responseText;
                    }
                    else {
                        $data['msg'] = 'Cannot Payment';
                    }
                }
            }
        }
        else {
            $data['error'] = 1;
            if (isset($result->payway_code->responseText)) {
                $data['msg'] = $result->payway_code->responseText;
            }
            else {
                $data['msg'] = 'Cannot Payment';
            }
        }
        
        return json_encode($data);
    }
    
    function finish_step_5() {
        $this->autoRender = false;
        $this->Session->destroy();
        
        return $this->redirect("/home_current");
    }
    
    function finish_step_4() {
        $this->autoRender = false;
        $this->Session->write('step_rg', 5);
        
        return $this->redirect("/sign_up");
    }
    
    function finish_step_3() {
        $this->autoRender = false;
        $type = (isset($this->params['url']['type'])) ? $this->params['url']['type'] : 0; // 0 - Not enter car info; 1 - Has enter
        
        if ($type == 0) {
            $info = $this->Session->read('regis_rs_info');
            if($info && isset($info->name) && $info->email) {
                // call api send mail
                $url = Configure::read('api.api_url') . 'api/user/sendmailpayment';
                $body = array(
                    "first_name" => $info->name,
                    "email" => $info->email
                );
                $this->CurlApi->to($url)->withData(json_encode($body))->post();
            }
        }
        
        $is_create_company = $this->Session->read('regis_rs_info_create_company');
        if ($is_create_company) {
            $this->Session->write('step_rg', 4);
        }
        else {
            $this->Session->write('step_rg', 5);
        }
        
        return $this->redirect("/sign_up");
    }
    
    function save_data_feed() {
        $this->layout = null;
        $this->autoRender = false;
        // get data
        $arrIdDatafeed = (isset($this->request->data['datafeed'])) ? $this->request->data['datafeed'] : '';
        $agree = (isset($this->request->data['agree'])) ? $this->request->data['agree'] : 0;
        $notDMS = (isset($this->request->data['not_dms'])) ? $this->request->data['not_dms'] : 0;
        
        $info = $this->Session->read('regis_rs_info');
        $firstName = '';
        $email = '';
        if($info && isset($info->name) && $info->email) {
            $firstName = $info->name;
            $email = $info->email;
        }
            
        $arrNameDatafeed = array();
        $arrEmailDatafeed = array();
        if ($arrIdDatafeed != '') {
            foreach ($arrIdDatafeed as $id) {
                foreach ($info->datafeed_all as $data) {
                    if($data->_id == $id) {
                        $arrNameDatafeed[] = $data->name;
                        $arrEmailDatafeed[] = $data->email;
                        break;
                    }
                }
            }
        }
        $arrNameDatafeed = (isset($arrNameDatafeed) && $arrNameDatafeed)? $arrNameDatafeed : '';
        $arrEmailDatafeed = (isset($arrEmailDatafeed) && $arrEmailDatafeed)? $arrEmailDatafeed : '';
        
        // call api
        $url = Configure::read('api.api_url').'api/user/updatedatafeedsincompany';
        $body = array(
            "company_id" => $info->company_info->_id,
            "company_name" => $info->company_info->name,
            "company_email" => ($info->company_info->email)? $info->company_info->email : '',
            "arr_id_datafeed" => $arrIdDatafeed,
            "arr_name_datafeed" => $arrNameDatafeed,
            "arr_email_datafeed" => $arrEmailDatafeed,
            "user_name" => $firstName,
            "user_email" => $email,
            "is_agree" => $agree,
            "not_dms" => $notDMS
        );
        //echo json_encode($body); die();
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->post());
        //echo json_encode($result); die();
        if ($result && isset($result->status) && $result->status == 'success') {
            $datareturn['error'] = 0;
            $this->Session->write('regis_rs_info', '');
            $this->Session->write('regis_rs_info_create_company', '');
            $this->Session->write('step_rg', '');
            $this->Session->write('email_rg', '');
            $this->Session->write('password_rg', '');
            $this->Session->write('first_name_rg', '');
            $this->Session->write('last_name_rg', '');
            $this->Session->write('phone_rg', '');
            $this->Session->write('token_rg', '');
            $this->Session->write('agree_rg', '');
        }
        else {
            $datareturn['error'] = 1;
            $datareturn['msg'] = ($result && isset($result->response))? $result->response : 'Failure !';
            $datareturn['code'] = ($result && isset($result->code))? $result->code : '';
        }
        return json_encode($datareturn);
    }
    
    function sign_up_1() {
        //debug($this->Session->read('regis_rs_info'));die();
        if ($this->Auth->login()) {
            return $this->redirect('/home');
        }
        else {
            $this->set('title_for_layout', 'Sign up');
            $this->layout = 'skin_new';
            $this->autoRender = false;
            
            $step = $this->Session->read('step_rg');
            if (!$step) {
                $this->Session->write('step_rg', 1);
                $step = 1;
            }
            
            if ($step == 3) {
                //call api setting register step 3
                $url = Configure::read('api.api_url').'api/user/getsettingtimefreecarzapp';
                $header = array(
                    'sessionid:'.CakeSession::read('Auth.User.session_id')
                );
                $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
                if($result->status == 'success'){
                    $line1 = $result->result[0]->line1 ;
                    $line2 = $result->result[0]->line2 ;
                    $line3 = $result->result[0]->line3 ;
//                  $line4 = $result->result[0]->line4 ;
                    $line5 = $result->result[0]->line5 ;
                    $line6 = $result->result[0]->line6 ;
                    $time_free_not_enter_payment = $result->result[0]->time_free_not_enter_payment ;
                    $time_free_enter_payment = $result->result[0]->time_free_enter_payment ;

                }
                $info = $this->Session->read('regis_rs_info');
                $email = $info->email;
                $token = $info->token;
                $userId = $info->id;
                $mobile = 0;
                $this->set(compact('step', 'email', 'token', 'userId', 'mobile','line1','line2','line3','line5','line6','time_free_not_enter_payment','time_free_enter_payment'));
            }
            elseif ($step == 4) {
                $info = $this->Session->read('regis_rs_info');
                $datafeed_select = array();
                if (isset($info->datafeed_select) && $info->datafeed_select != '') {
                    foreach ($info->datafeed_select as $data) {
                        $datafeed_select[] = $data->_id;
                    }
                }
                $is_create_company = $this->Session->read('regis_rs_info_create_company');
                
                $this->set(compact('step', 'info', 'datafeed_select', 'is_create_company'));
            }
            else {
                $this->set(compact('step'));
            }
            $this->render('sign_up_step_' . $step);
        }
    }
    
    function register_back() {
        $this->autoRender = false;
        $this->layout = null;
        
        $step = $this->Session->read('step_rg');
        if (!$step || $step < 2) {
            $this->Session->write('step_rg', 1);
            $step = 1;
        }
        else {
            $this->Session->write('step_rg', --$step);
        }
        
        return $this->redirect('/sign_up');
    }
    
    function register_step_1() {
        $this->autoRender = false;
        $this->layout = null;
        if (isset($this->request->data)) {
            $email = isset($this->request->data['email'])? $this->request->data['email'] : '';
            $password = isset($this->request->data['password'])? $this->request->data['password'] : '';
            $first_name = isset($this->request->data['name'])? $this->request->data['name'] : '';
            $last_name = isset($this->request->data['last_name'])? $this->request->data['last_name'] : '';
            $phone = isset($this->request->data['phone'])? $this->request->data['phone'] : '';
            $token = sha1($this->request->data['email'] . rand(0, 1000));
            $agree = isset($this->request->data['agree'])? $this->request->data['agree'] : '';

            // call api
            $url = Configure::read('api.api_url').'api/user/checkemailregister';
            $body = array(
                "email" => $email,
                "phone" => $phone,
                "first_name" => $first_name,
                "last_name" => $last_name
            );

            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->post());
            //die(json_encode($result));
            if ($result->status != 'success') {
                $data['error'] = 1;
                $data['msg'] = 'This email already exists in Carzapp';
            } else {
                $this->Session->write('step_rg', 2);
                $this->Session->write('email_rg', $email);
                $this->Session->write('password_rg', $password);
                $this->Session->write('first_name_rg', $first_name);
                $this->Session->write('last_name_rg', $last_name);
                $this->Session->write('phone_rg', $phone);
                $this->Session->write('token_rg', $token);
                $this->Session->write('agree_rg', $agree);
                $data['error'] = 0;
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Please enter informations as requested';
        }
        echo json_encode($data);
    }

    function register_step_2() {

        $this->autoRender = false;
        $this->layout = null;
        if($this->Session->read('email_rg')){

            if ($this->request->data) {
                //die(json_encode($this->request->data));
                // get parameters
                $company_id = isset($this->request->data['company_id'])? $this->request->data['company_id'] : '';
                $company_name = isset($this->request->data['company_name'])? $this->request->data['company_name'] : '';
                $license_number = isset($this->request->data['license_number'])? $this->request->data['license_number'] : '';
                $license_number_old = isset($this->request->data['license_number_old'])? $this->request->data['license_number_old'] : '';
                $is_principle = (isset($this->request->data['is_principle'])) ? $this->request->data['is_principle'] : '0';
                $is_upgrade =isset($this->request->data['is_upgrade'])? $this->request->data['is_upgrade'] : '';
                $address = isset($this->request->data['addresscompany'])? $this->request->data['addresscompany'] : null;
                $address1 = isset($this->request->data['address'])? $this->request->data['address'] : '';
                $address2 = isset($this->request->data['address2'])? $this->request->data['address2'] : '';
                $address3 = isset($this->request->data['address3'])? $this->request->data['address3'] : '';
                $suburb = isset($this->request->data['suburb'])? $this->request->data['suburb'] : '';
                $postcode = isset($this->request->data['postcode'])? $this->request->data['postcode'] : '';
                $state = isset($this->request->data['state'])? $this->request->data['state'] : '';
                $country = isset($this->request->data['country'])? $this->request->data['country'] : '';
                
                if ($company_id) {
                    $license_number = $license_number_old;
                }
                
                // call api
                $url_regis = Configure::read('api.api_url').'api/user/register';
                $body_regis = array(
                    "email" => $this->Session->read('email_rg'),
                    "phone" => $this->Session->read('phone_rg'),
                    "name" => $this->Session->read('first_name_rg'),
                    "last_name" => $this->Session->read('last_name_rg'),
                    "pword" => $this->Session->read('password_rg'),
                    "data_source" => '',
                    "easy_car_number" => '',
                    "company_id" => $company_id,
                    //"carzapp_code" => $carzapp_code,
                    "license_number" => $license_number,
                    "license_number_old" => $license_number_old,
                    "company_name" => $company_name,
                    "is_upgrade"=>$is_upgrade,
                    "branch_address_id"  => $address,
                    "address1" => $address1,
                    "address2" => $address2,
                    "address3" => $address3,
                    "suburb" => $suburb,
                    "postcode" => $postcode,
                    "state" => $state,
                    "country" => $country,
                    "is_principle" => (int)$is_principle,
                    "device_id" =>'',
                    "os_type" => 3,
                    "version" =>'2.1.2'
                );
                $result_regis = json_decode($this->CurlApi->to($url_regis)->withData( json_encode($body_regis))->post());

                if ($result_regis->status == 'success') {
                    $this->Session->write('regis_rs_info', $result_regis->info);
                    $this->Session->write('step_rg', 3);
                    if ($company_id) {
                        $this->Session->write('regis_rs_info_create_company', 0);
                    }
                    else {
                        $this->Session->write('regis_rs_info_create_company', 1);
                    }
                    $data['error'] = 0;
                } else {
                    $data['error'] = 1;
                    if ($result_regis->code == '208') {
                        $data['msg'] = 'Carzapp code does not exist';
                    }
                    elseif ($result_regis->code == '209') {
                        $data['msg'] = 'License Number does not exist';
                    }
                    elseif ($result_regis->code == '205') {
                        $data['msg'] = 'This License Number already exists in the system. Please try again or contact us on support@carzapp.com.au.';
                    }
                    else {
                        $data['msg'] = $result_regis->response ;
                    }
                }
            } else {
                $data['error'] = 1;
                $data['msg'] = 'Please enter the required fields';
            }
        }else{
            $data['error'] = 1;
            $data['msg'] = 'Please enter the information in Step 1';
        }
        echo json_encode($data);
    }

    function register_step_3() {
        $this->autoRender = false;
        $this->layout = null;
        
        $this->Session->write('step_rg', 4);
        
        return $this->redirect('/sign_up');
    }
    
    function check_code() {
        $this->autoRender = false;
        $this->layout = null;
        if ($this->request->data) {
            //cat chư A,B
            $this->loadModel('User');
            $carzapp_code = str_replace('A', '', $this->request->data['codef']);
            $check = $this->User->find('first', array('conditions' => array(
                    'User.carzapp_code !=' => 0,
                    'User.carzapp_code' => $carzapp_code
            )));

            if ($check) {
                $data['error'] = 0;
                $data['companyname'] = $check['User']['company_name'];
                $data['dealernumber'] = $check['User']['license_number'];
                $datasource = $check['User']['data_source'];
                $arr = str_replace(array('[', ']', '"'), array("", "", ""), $datasource);
                $ar_id = explode(",", $arr);

                $data["list"] = $ar_id;
            } else {
                $data['error'] = 1;
                $data['msg'] = 'This code not exits in system!';
                $data['companyname'] = '';
                $data['dealernumber'] = '';
                $data["list"] = '';
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Please enter your code';
            $data['companyname'] = '';
            $data['dealernumber'] = '';
            $data["list"] = '';
        }
        echo json_encode($data);
    }

    function checkaddress(){
        $this->autoRender = FALSE;
        // get parameters
        $keyword  = $this->params['url']['keyword'];
        // call api
        $url = Configure::read('api.api_url').'api/user/searchaddressregister?keyword='.$keyword;
        $result = json_decode($this->CurlApi->to($url)->get());
//        debug($result);die();
        if ($result->status == 'success' && $result->adrress) {
            $list = $result->adrress;
        }
        else {
            $list = null;
        }
        
        $ds = '';
        if(count($list) > 0){
            $ds .= '<div class="grouplist group-address">';
            $ds .= '<table class="list-company-table">';
            $ds .= '<thead>
                        <th>Address</th>
                    </thead>';
            foreach($list as $rs){
                $ds .= '<tr data-id="'.$rs->_id.'" data-suburb="'.$rs->Suburb.'" data-state="'.$rs->State.'" data-post-code="'.$rs->Post_Code.'"><td style="width: 300px;">'.$rs->Street.'</td></tr>';
            }
            $ds .= '</table></div>';
        }      
        $data['ds'] = $ds;
        echo json_encode($data);
    }
    
    function checkcompany(){
        $this->autoRender = FALSE;
        // get parameters
        $keyword  = $this->params['url']['keyword'];
        // call api
        $url = Configure::read('api.api_url').'api/user/getallcompanyaddressregister?keyword='.$keyword;
        $result = json_decode($this->CurlApi->to($url)->get());
        //debug($result);die();
        if ($result->status == 'success' && $result->companies) {
            $list = $result->companies;
            /*die(json_encode($list));*/
        }
        else {
            $list = null;
        }
        
        $companyId = '';
        $ds = '';
        if(count($list) > 0){
            $ds .= '<div class="grouplist group-company">';
            $ds .= '<table class="list-company-table">';
            $ds .= '<thead>
                        <th>Dealership</th>
                    </thead>';
            foreach($list as $rs){
                $ds .= '<tr data-id="'.$rs->company_info->_id.'"><td style="width: 300px;">'.$rs->company_info->name.'</td></tr>';
                if (strtoupper(trim($rs->company_info->name)) == strtoupper(trim($keyword))) {
                    $keyword = $rs->company_info->name;
                    $companyId = $rs->company_info->_id;
                }
            }
            $ds .= '</table></div>';
        }      
        $data['ds'] = $ds;
        $data['list_company'] = $list;
        $data['keyword'] = $keyword;
        $data['company_id'] = $companyId;
        echo json_encode($data);
    }
    
    function infocompany(){
        $this->autoRender = FALSE;
        $id        = $this->request->data['id'];
        $url = Configure::read('api.api_url').'api/user/getuserbyid?user_id='.$id;
        $result = json_decode($this->CurlApi->to($url)->get());
        if($result->status == 'success'){
            $rs = $result->user;
            $data['company_name'] = $rs->company_name;
            $data['carzapp_code'] = 'A'.$rs->carzapp_code;
            $data['dealer_number'] = $rs->dealer_number;
            $data['license_number'] = $rs->license_number;
        }else{
            $data['company_name'] = '';
            $data['carzapp_code'] = '';
            $data['dealer_number'] = '';
            $data['license_number'] = '';
        }
        echo json_encode($data);
    }
    function download($method = 'curl')  // default method: cURL
    {
        $save_to = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']).'/img/uploads/users_avatar/';
        $this->autoRender = false;
        $source = $this->Session->read('fb_picture');
        $arr = explode( '?', basename($source));
        $arr_2 = explode( '.', $arr[0]);
        $img_name = $arr_2[0];
        $info = @GetImageSize($source);
        $mime = $info['mime'];
        $type = substr(strrchr($mime, '/'), 1);
        switch ($type)
        {
        case 'jpeg':
            $image_create_func = 'ImageCreateFromJPEG';
            $image_save_func = 'ImageJPEG';
            $new_image_ext = 'jpg';
            break;

        case 'png':
            $image_create_func = 'ImageCreateFromPNG';
            $image_save_func = 'ImagePNG';
            $new_image_ext = 'png';
            break;

        case 'bmp':
            $image_create_func = 'ImageCreateFromBMP';
            $image_save_func = 'ImageBMP';
            $new_image_ext = 'bmp';
            break;

        case 'gif':
            $image_create_func = 'ImageCreateFromGIF';
            $image_save_func = 'ImageGIF';
            $new_image_ext = 'gif';
            break;

        case 'vnd.wap.wbmp':
            $image_create_func = 'ImageCreateFromWBMP';
            $image_save_func = 'ImageWBMP';
            $new_image_ext = 'bmp';
            break;

        case 'xbm':
            $image_create_func = 'ImageCreateFromXBM';
            $image_save_func = 'ImageXBM';
            $new_image_ext = 'xbm';
            break;

        default:
            $image_create_func = 'ImageCreateFromJPEG';
            $image_save_func = 'ImageJPEG';
            $new_image_ext = 'jpg';
        }

        $new_name = $img_name.'.'.$new_image_ext;
        $save_to = $save_to.$new_name;
      
        if($method == 'curl')
        {
            echo $save_image = $this->LoadImageCURL($source,$save_to);
        }
        elseif($method == 'gd')
        {
            $img = $image_create_func($source);

            if(isSet($quality))
            {
               $save_image = $image_save_func($img, $save_to, $quality);
            }
            else
            {
               $save_image = $image_save_func($img, $save_to);
            }
        }

        return $new_name;
    }
    function LoadImageCURL($source,$save_to)
    {
        $ch = curl_init($source);
        $fp = fopen($save_to, "wb");
        // set URL and other appropriate options
        $options = array(CURLOPT_FILE => $fp,
                         CURLOPT_HEADER => 0,
                         CURLOPT_FOLLOWLOCATION => 0,
                         CURLOPT_SSL_VERIFYPEER => false,
                         CURLOPT_TIMEOUT => 60); // 1 minute timeout (should be enough)

        curl_setopt_array($ch, $options);

        curl_exec($ch);
        curl_close($ch);
        //fclose($fp);
    }
    public function subscription(){
        $this->set('title_for_layout', 'Setting subscription step 3');
        $this->layout = 'admintrator';
        //call api
        $url = Configure::read('api.api_url').'api/user/getsettingtimefreecarzapp';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        //debug($result);die();
        if($result->status == 'success'){
            $line1 = $result->result[0]->line1 ;
            $line2 = $result->result[0]->line2 ;
            $line3 = $result->result[0]->line3 ;
//            $line4 = $result->result[0]->line4 ;
            $line5 = $result->result[0]->line5 ;
            $line6 = $result->result[0]->line6 ;
            $time_free_not_enter_payment = $result->result[0]->time_free_not_enter_payment ;
            $time_free_enter_payment = $result->result[0]->time_free_enter_payment ;

        }
        $this->set(compact(array('line1','line2','line3','line5','line6','time_free_not_enter_payment','time_free_enter_payment')));
        $this->render('subscription');
    }
    public function save_set_supscription(){
        $this->autoRender = false;
        $this->layout = null;
        //get params
        if($this->request->data) {
            $line1 = isset($this->request->data['line1']) && $this->request->data['line1'] ? $this->request->data['line1'] : '';
            $line2 = isset($this->request->data['line2']) && $this->request->data['line2'] ? $this->request->data['line2'] : '';
            $line3 = isset($this->request->data['line3']) && $this->request->data['line3'] ? $this->request->data['line3'] : '';
//            $line4 = isset($this->request->data['line4']) && $this->request->data['line4'] ? $this->request->data['line4'] : '';
            $line5 = isset($this->request->data['line5']) && $this->request->data['line5'] ? $this->request->data['line5'] : '';
            $line6 = isset($this->request->data['line6']) && $this->request->data['line6'] ? $this->request->data['line6'] : '';
            $date_not_payment = isset($this->request->data['date_not_payment']) && $this->request->data['date_not_payment'] ? $this->request->data['date_not_payment'] : '';
            $date_payment = isset($this->request->data['date_payment']) && $this->request->data['date_payment'] ? $this->request->data['date_payment'] : '';
            //call api
            $url = Configure::read('api.api_url') . 'api/user/settingtimefreecarzapp';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                'line1' => $line1,
                'line2' => $line2,
                'line3' => $line3,
                'line5' => $line5,
                'line6' => $line6,
                'time_free_not_enter_payment' => $date_not_payment,
                'time_free_enter_payment' => $date_payment,
            );

            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
            }
        return json_encode($data);

        }

    }


}
