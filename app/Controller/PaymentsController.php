<?php

App::uses('AppController', 'Controller');
Configure::load('api');
class PaymentsController extends AppController {
    public $components = array('CurlApi', 'Payway');
    public $totalPay = 100;
    public $paypal_test = 1;// 1: Là test, 0: Là public
    public $api_sandbox_username = "phamthanhthuy07i1-facilitator_api1.gmail.com";
    public $api_sandbox_password = "4P9YLMYSKSCZDQTC";
    public $api_sandbox_signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31A2IGCahCATgS0lyEXaT37wMevS84";
    
    public $api_username = "";
    public $api_password = "";
    public $api_signature = "";
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array(
            'index',
            'checkoutreturn'
        ));
    }

    public function index($id = null) {
        if ($id == '57199318a677439ab683b674') {
            $this->Payway->checkOut([[
                'product_name' => '1 month',
                'quantity' => 1,
                'price' => 1,
            ]]);
        }
        else {
            $this->Payway->checkOut([[
                'product_name' => '1 year',
                'quantity' => 1,
                'price' => 10,
            ]]);
        }
    }
    
    public function ajaxpurchase() {
        $this->autoRender = FALSE;

        $cardNumber = $this->request->data["cardNumber"];
        $cardVerificationNumber = $this->request->data["cardVerificationNumber"];
        $cardExpiryYear = $this->request->data["cardExpiryYear"];
        $cardExpiryMonth = $this->request->data["cardExpiryMonth"];
        $orderAmountCents = number_format((float) $this->request->data["orderAmount"] * 100, 0, '.', '');

        $result = $this->Payway->purchase($orderAmountCents, $cardNumber, $cardVerificationNumber, $cardExpiryYear, $cardExpiryMonth);
        
        $data = array();
        
        if ($result["response.responseCode"] == '08') {
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            
            $type = ($orderAmountCents == 100) ? 0 : 1;
            
            $body = array(
                'payment_number' => $result["response.receiptNo"],
                'type' => $type,
                'user_id' => CakeSession::read('Auth.User._id')
            );

            $url = Configure::read('api.api_url') . 'api/user/paywaytransaction';
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            
            if ($result->status == 'success') {
                $data['error'] = 0;
                $data['msg'] = 'Your transaction was successfully';
            }
            else {
                if ($result->code != 205) {
                    $data['error'] = 1;
                    $data['msg'] = $result->response;
                }
            }
        }
        else {
            $data['error'] = 1;
            $data['msg'] = $result["response.text"];
        }
        
        echo json_encode($data);
    }
        
    public function checkoutreturnPayWay() {
        $encryptedParametersText = isset($this->params['url']['EncryptedParameters']) ? $this->params['url']['EncryptedParameters'] : '';
        $signatureText = isset($this->params['url']['Signature']) ? $this->params['url']['Signature'] : '';
        
        $paras = $this->Payway->decrypt_parameters($encryptedParametersText, $signatureText);
        if ($paras['payment_status'] == 'approved') {
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );

            $type = 0;
            if ($paras['payment_amount'] == '10.00') {
                $type = 1;
            }
            
            $body = array(
                'payment_number' => $paras['payment_number'],
                'type' => $type,
                'user_id' => CakeSession::read('Auth.User._id')
            );

            $url = Configure::read('api.api_url') . 'api/user/paywaytransaction';
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            
            if ($result->status == 'success') {
                $this->Session->setFlash('Your transaction was successfully', 'flash_custom', array('type'=>0));
            }
            else {
                if ($result->code != 205) {
                    $this->Session->setFlash($result->response, 'flash_custom', array('type'=>1));
                }
            }
        }
        else {
            $this->Session->setFlash('Your transaction was rejected', 'flash_custom', array('type'=>1));
        }
        
        return $this->redirect('/in_app_purchase');
    }
    
    public function index1($id=null) {
        $url = Router::url('/', true);
        $this->Session->write("payment_token", $this->createToken());
        $url_options = Configure::read('api.api_url').'api/user/getoptionpaypalid';
        $body_options = array(
            "option_id" => $id
        );
        $option_pay = json_decode($this->CurlApi->to($url_options)->withData( json_encode($body_options))->post())->option_paypals[0];

        if($option_pay){
            $total_pay = $option_pay->price;

            $data = array(
                'METHOD' => 'SetExpressCheckout',
                'MAXAMT' => $this->totalPay,
                'RETURNURL' => $url.'checkoutreturn/'.$id,
                'CANCELURL' => $url.'payment/'.$id,
                'REQCONFIRMSHIPPING' => 0,
                'NOSHIPPING' => 0,
                'LOCALECODE' => 'EN',
                'LANDINGPAGE' => 'Login',
                'CHANNELTYPE' => 'Merchant',
            );
            $data_shipping = array();

            $data = array_merge($data, $data_shipping);
            $data = array_merge($data, $this->paymentRequestInfo($total_pay));

            if ($this->Session->read("payment_token")) {
                $data['IDENTITYACCESSTOKEN'] = $this->Session->read("payment_token");
            }
            $result = $this->call($data);

            $this->Session->write("paypal_token", $result['TOKEN']);
            if ($this->paypal_test == 1) {
                return $this->redirect('https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $this->Session->read("paypal_token"));
            } else {
                return $this->redirect('https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $this->Session->read("paypal_token"));
            }
        }else{
            $this->Session->setFlash(__('Value not exits'));
            if($this->Session->read('Auth.User._id')){
                return $this->redirect('/in_app_purchase');
            }else{
                return $this->redirect('/home_current');
            }
            
        }
    }
    
    public function checkoutreturn($id){
       
        $url_options = Configure::read('api.api_url').'api/user/getoptionpaypalid';
        $body_options = array(
            "option_id" => $id
        );
        $option_pay = json_decode($this->CurlApi->to($url_options)->withData( json_encode($body_options))->post())->option_paypals[0];
        $total_pay = $option_pay->price;
        
        $data = array(
            'METHOD' => 'GetExpressCheckoutDetails',
            'TOKEN' => $this->Session->read("paypal_token")
        );

        $result = $this->call($data);
        $this->Session->write("paypal_payerid", $result['PAYERID']);
        $this->Session->write("paypal_result", $result);

        $user_id = 1;

        $paypal_data = array(
            'TOKEN' => $this->Session->read("paypal_token"),
            'PAYERID' => $this->Session->read("paypal_payerid"),
            'METHOD' => 'DoExpressCheckoutPayment',
            'PAYMENTREQUEST_0_NOTIFYURL' => $this->url.'payment/pp_express/ipn',
            'RETURNFMFDETAILS' => 1
        );

        $paypal_data = array_merge($paypal_data, $this->paymentRequestInfo($total_pay));

        $result = $this->call($paypal_data);

        
        $status = 0;
        if ($result['ACK'] == 'Success' || $result['ACK'] == 'SuccessWithWarning') {
            if ($result['PAYMENTINFO_0_PAYMENTSTATUS'] == "Completed") {
                $status = 1;
                // truong hop mua lan dau
                $url_check = Configure::read('api.api_url').'api/user/getpurchaseappuser';
                if($this->Session->read('Auth.User._id')){
                    $body_check = array("user_id" => $this->Session->read('Auth.User._id'));
                }else{
                    $body_check = array("user_id" => $this->Session->read('User.id'));
                }  
                $check = json_decode($this->CurlApi->to($url_check)->withData( json_encode($body_check))->post())->purchase_apps[0];
                if(!$check){
                    $expired_date = time() + $option_pay->number_month * 30 * 86400 ;
                    $url_add_pur = Configure::read('api.api_url').'api/user/addpurchaseappuser';
                    $body_add_pur = array(
                        "user_id" => $this->Session->read('User.id'),
                        "purchased_date" => time(),
                        "expired_date" => $expired_date
                    );
                    $result_add_pur = json_decode($this->CurlApi->to($url_add_pur)->withData( json_encode($body_add_pur))->post());
                    if($result_add_pur->status == 'success'){
                        $user_login = Configure::read('api.api_url').'api/user/getuserbyid?user_id='.$this->Session->read('User.id');
                        $this->Auth->Session->write('Auth.User._id',$user_login->_id);
                        $this->Auth->Session->write('Auth.User.email', $user_login->email);
                        $this->Auth->Session->write('Auth.User.name', $user_login->name);
                        $this->Auth->Session->write('Auth.User.avatar', $user_login->avatar);   
                    }
                }else{
                    $url_update_pur = Configure::read('api.api_url').'api/user/updatepurchaseappuser';
                    $body_update_pur = array(
                        "purchase_apps_id" => $check->_id,
                        "expired_date" => $check->expired_date + $option_pay->number_month * 30 * 86400
                    );
                    json_decode($this->CurlApi->to($url_update_pur)->withData( json_encode($body_update_pur))->post());
                }
  
                if($this->Session->read('Auth.User._id')){
                    return $this->redirect('/in_app_purchase');
                }else{
                    return $this->redirect('/home');
                }
         
            }
        }
        $this->Session->delete("payment_token");
        
        die();
    }
    
    function paymentRequestInfo($total_pay) {
        //$item_total = $this->totalPay;
        $item_total = $total_pay;
        $data['PAYMENTREQUEST_0_PAYMENTACTION'] = "Sale";
        $data['PAYMENTREQUEST_0_CURRENCYCODE'] = "USD";

        $data['L_PAYMENTREQUEST_0_DESC0'] = 'Deposit Funds';
        $data['L_PAYMENTREQUEST_0_NAME0'] = "Deposit Funds";
        $data['L_PAYMENTREQUEST_0_NUMBER0'] = 'Deposit Funds';
        $data['L_PAYMENTREQUEST_0_QTY0'] = 1;
        $data['L_PAYMENTREQUEST_0_AMT0'] = $item_total;

        $data['PAYMENTREQUEST_0_ITEMAMT'] = number_format($item_total, 2, '.', '');
        $data['PAYMENTREQUEST_0_AMT'] = number_format($item_total, 2, '.', '');
        return $data;
    }


    public function call($data) {

        if ($this->paypal_test == 1) {
            $api_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
            $user = $this->api_sandbox_username;
            $password = $this->api_sandbox_password;
            $signature = $this->api_sandbox_signature;
        } else {
            $api_endpoint = 'https://api-3t.paypal.com/nvp';
            $user = $this->api_username;
            $password = $this->api_password;
            $signature = $this->api_signature;
        }

        $settings = array(
            'USER' => $user,
            'PWD' => $password,
            'SIGNATURE' => $signature,
            'VERSION' => '109.0',
            'BUTTONSOURCE' => 'OpenCart_2.0_EC',
        );
        $defaults = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_URL => $api_endpoint,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
            CURLOPT_FRESH_CONNECT => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FORBID_REUSE => 1,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_POSTFIELDS => http_build_query(array_merge($data, $settings), '', "&")
        );

        $ch = curl_init();

        curl_setopt_array($ch, $defaults);

        if (!$result = curl_exec($ch)) {
            die("cURL failed");
        }

        curl_close($ch);

        return $this->cleanReturn($result);
    }

    public function cleanReturn($data) {
        $data = explode('&', $data);

        $arr = array();

        foreach ($data as $k => $v) {
            $tmp = explode('=', $v);
            $arr[$tmp[0]] = urldecode($tmp[1]);
        }

        return $arr;
    }

    public function createToken($len = 32) {
        $base = 'ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
        $max = strlen($base) - 1;
        $activate_code = '';
        mt_srand((float) microtime() * 1000000);

        while (strlen($activate_code) < $len + 1) {
            $activate_code .= $base{mt_rand(0, $max)};
        }

        return $activate_code;
    }

}
