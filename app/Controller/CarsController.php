<?php
App::uses('AppController', 'Controller', 'Lib', 'Html');
Configure::load('api');

class CarsController extends AppController {

    public $components = array('Curl', 'Paginator', 'RequestHandler', 'CurlApi');
    public $helpers = array(
        'Layout',
        'GoogleMap',
        'Html'
    );
    public function ajaxgetimageflicka() {
        $this->autoRender = FALSE;
        
        $id = $this->request->data['id'];
        
        $url = Configure::read('api.api_url') . 'api/user/getimagescarbyid?car_id=' . $id;
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if (isset($result->imgagecars) && $result->imgagecars != '') {
            echo json_encode($result->imgagecars);
        } else {
            echo json_encode([]);
        }
    }
    
    public function ajaxgetcountmenunotify() {
        $this->autoRender = FALSE;
        
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "user_email" => CakeSession::read('Auth.User.email')
        );
        
        $url = Configure::read('api.api_url') . 'api/user/getmenucountnumbers';
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        $data['error'] = 0;
        $data['count_transaction'] = $result->count_transaction;
        $data['count_invite'] = $result->count_invite;
        $data['count_set4get_notification'] = $result->count_set4get_notification;
        $data['count_other_notification'] = $result->count_other_notification;
        $data['count_customer'] = $result->count_customer;
        
        echo json_encode($data);
    }
    //function get count other menu notificatify
    public function ajaxgetcountothermenunotify() {
        $this->autoRender = FALSE;
        
        $url = Configure::read('api.api_url') . 'api/user/getothernotificationcount?user_id=' . CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result2 = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        
        $data['count_dealer_network'] = $result2->count_dealer_network;
        $data['count_car_add_stock'] = $result2->count_car_add_stock;
        $data['count_car_add_network_stock'] = $result2->count_car_add_network_stock;
        $data['count_car_updated'] = $result2->count_car_updated;
        $data['count_car_following'] = $result2->count_car_following;
        $data['count_pulse'] = $result2->count_pulse;
        
        echo json_encode($data);
    }
    //function change car price
    public function ajaxchangecarprice() {
        $this->autoRender = FALSE;
        
        $carId = $this->request->data['car_id'];
        $type = $this->request->data['type']; // 0 - wholesale; 1 - Retail
        $price = $this->request->data['price'];
        
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        
        $body = array(
            "car_id" => $carId
        );
        
        if ($type == 0) {
            $body['price'] = $price;
        }
        else {
            $body['retail'] = $price;
        }
        
        $url = Configure::read('api.api_url') . 'api/user/editpriceofcar';
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result->status == 'success') {
            $data['error'] = 0;
            $data['price'] = $price;
            $data['price_format'] = '$' . number_format($price,0,',',',');
        }
        else {
            $data['error'] = 1;
            $data['msg'] = 'Changed not successfully';
        }
        
        echo json_encode($data);
    }
    
    public function ResultCountMenu() {
        $url = Configure::read('api.api_url') . 'api/user/getmenucountnumbers';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "user_email" => CakeSession::read('Auth.User.email')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if (isset($result) && $result->status == 'success') {
            return $result;
        } else {
            return null;
        }
    }

    public function ResultGetUrl($url, $id1) {
        $header = array(
            'userid:' . CakeSession::read('Auth.User._id'),
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url . $id1)->withOption('HTTPHEADER', $header)->get());
        if ($result->status == 'success') {
            return $result;
        } else {
            return null;
        }
    }
    //function result count other notification
    public function ResultOtherNotificationcount() {
        $url = Configure::read('api.api_url') . 'api/user/getothernotificationcount?user_id=' . CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if (isset($result->status)) {
            return null;
        } else {
            return $result;
        }
    }
    //function result image car
    public function ResultImageCar($id) {
        $url = Configure::read('api.api_url') . 'api/user/getimagescarbyid?car_id=' . $id;
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if (isset($result->imgagecars) && $result->imgagecars != '') {
            return $result->imgagecars;
        } else {
            return null;
        }
    }
    //function result my network
    public function ResultMyNetwork() {
        $url = Configure::read('api.api_url') . 'api/user/getmynetwork';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => '',
            'type' => 1,
            'start' => 0,
            'limit' => 100,
            'total' => 1
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            return $result->networks;
        } else {
            return null;
        }
    }
    //List follow
    public function ResultListFollow($url) {
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());

        if ($result->status == 'success') {
            return $result->followers;
        } else {
            return null;
        }
    }
    //Return result car from set for get
    public function ResultGetcarsfromset4get($user_id) {
        $url = Configure::read('api.api_url') . 'api/user/getcarsfromset4get?user_id=' . $user_id;
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if ($result->status == 'success') {
            return $result->set4get;
        } else {
            return null;
        }
    }
    //function car detail by key
    public function car_detail_by_key($id, $car_name) {
        $helpers = array('Common');
        $this->set('title_for_layout', 'Car Details');
        $this->set('wailLoadFull', true);
        $this->set('breadcrumb', [
            (object) ['title' => 'Home'],
            (object) ['title' => 'Car Details', 'active' => true]
        ]);
        $this->layout = 'cz_home';

        // view user follow
        $url_follow = Configure::read('api.api_url') . 'api/user/getlistfollow?car_id=' . $id;
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url_follow)->withOption('HTTPHEADER', $header)->get());
        //debug($result);die();
        $count_follow = $result->followers;
        $user_session = $this->Session->read('Auth.User._id');
        $rsInfo = $this->ResultCarId($id);
        //get info if customer is a zooper
        $custom_zooper =isset($rsInfo->car[0]->custom_zooper) ? $rsInfo->car[0]->custom_zooper : null;
        // get info car
        $car = isset($rsInfo->car[0]->cars)? $rsInfo->car[0]->cars : null;
        $company =isset($rsInfo->car[0]->company_info)? $rsInfo->car[0]->company_info : null;
        //debug($car);die();
        if(($company->company_id != CakeSession::read('Auth.User.company_id') && ($car->is_active == 2) || ($company->company_id != CakeSession::read('Auth.User.company_id') && isset($car->is_sold) && $car->is_sold == 1))){
            $this->redirect('/home');
        }else {
            $price = $car->price;
            $is_buying = ($rsInfo->other_infor->is_buying == false) ? 0 : 1;
            $is_selling = ($rsInfo->other_infor->is_selling == false) ? 0 : 1;
            $is_tender_offer = ($rsInfo->other_infor->is_tender_offer == false) ? 0 : 1;
            // get info client-no
            $info_client_no = isset($rsInfo->car[0]->company_info) ? $rsInfo->car[0]->company_info : null;
            // get info tranfer
            $trans_user = isset($rsInfo->other_infor->transaction_infor) ? $rsInfo->other_infor->transaction_infor : null;
            // get images cars
            $images = isset($rsInfo->other_infor->images) ? $rsInfo->other_infor->images : null;
            // check follow car
            $view_info_car = isset($rsInfo->car[0]->views) ? $rsInfo->car[0]->views : null;
            $is_follow = isset($view_info_car->is_follow) && $view_info_car->is_follow == true ? 1 : 0;
            $follow = (isset($view_info_car->is_follow) && $view_info_car->is_follow) ? 1 : 0;
            if (isset($car->location) && $car->location != '') {
                $address = $car->location;
                $local_car = str_replace(' ', '+', $car->location);
                $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $local_car . '&sensor=false');
                $output = json_decode($geocode);
                $lat2 = (isset($output->results[0])) ? $output->results[0]->geometry->location->lat : '';
                $lng2 = (isset($output->results[0])) ? $output->results[0]->geometry->location->lng : '';
            } else {
                $address = '';
                $lat2 = '';
                $lng2 = '';
            }
            // add addViewCount
            $url1 = Configure::read('api.api_url') . 'api/user/addviewcount';
            $body1 = array(
                'car_id' => $id,
            );
            $this->ResultPostUrl($url1, $body1);

            // get notes
            $url_notes = Configure::read('api.api_url') . 'api/user/getnotes';
            $body_notes = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "car_id" => $id
            );
            $notes = json_decode($this->CurlApi->to($url_notes)->withData(json_encode($body_notes))->withOption('HTTPHEADER', $header)->post())->notes;
            //get GetUsersOfBranch
            $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : 20;
            if (isset($this->params['url']['page'])) {
                $page = $this->params['url']['page'];
                $s_page = $this->params['url']['page'];
            } else {
                $page = 0;
                $s_page = 1;
            }
            $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
            $url_getuserbranch = Configure::read('api.api_url') . 'api/user/getusersofbranch';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body_getuserbranch = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                'start' => $start,
                'limit' => $limit,
                'branch_address_id' => $car->branch_address_id,
                'company_id' => CakeSession::read('Auth.User.company_id'),
            );

            $getuserbranchs = json_decode($this->CurlApi->to($url_getuserbranch)->withData(json_encode($body_getuserbranch))->withOption('HTTPHEADER', $header)->post())->user_company;
            $this->set(compact('car', 'user_session', 'count_follow', 'notes', 'address', 'lat2', 'lng2', 'id', 'follow', 'info_client_no', 'trans_user', 'action_trans_user', 'images', 'view_info_car', 'is_buying', 'is_selling', 'getuserbranchs', 'price', 'custom_zooper','is_follow','is_tender_offer'));
            $this->render('car_detail');
        }
    }
    //Send mail attach file adf when make an offer
    public function ajaxsendmailattachfileadf(){
        //get params
        $carId = (isset($this->request->data['car_id']) && ($this->request->data['car_id']) ? $this->request->data['car_id'] : '');
        $comments = (isset($this->request->data['comments']) && ($this->request->data['comments']) ? $this->request->data['comments'] : '');
        $url = Configure::read('api.api_url') . 'api/user/sendmailattachfileadf';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "car_id" => $carId,
            "comments"=> $comments
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        return $result;
    }
    //Send email attach list file adf when send email to dealer
    public function ajaxsendmailattachlistfileadf(){
        //get params
        $carId = (isset($this->request->data['car_id']) && ($this->request->data['car_id']) ? $this->request->data['car_id'] : '');
        $url = Configure::read('api.api_url') . 'api/user/sendmailattachlistfileadf';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "car_ar_id" => $carId,
            "comments"=> "User sent an email enquiry."
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        return $result;
    }
    //Result car by id
    public function ResultCarId($id) {
        $url = Configure::read('api.api_url') . 'api/user/getcardetail';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $CompanyId= $this->Session->read('Auth.User.company_id') ;
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "car_id" => $id,
            "login_company_id"=>$CompanyId
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        return $result;
    }
    //Return url ò post
    public function ResultPostUrl($url, $body = array()) {
        $header = array(
            'userid:' . CakeSession::read('Auth.User._id'),
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        if ($body != null) {
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        } else {
            $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->post());
        }
        return $result;
    } 

    public function share($id = null) {
        $this->set('title_for_layout', 'Share');
        
        $rsCarInfo = $this->ResultCarId($id);
        $custom_zooper =  $car = $rsCarInfo->car[0]->custom_zooper;
        $car = $rsCarInfo->car[0]->cars;
        $images = $rsCarInfo->other_infor->images;

        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : 20;
        
        if(isset($this->params['url']['page'])){
            $page = $this->params['url']['page'];
            $s_page = $this->params['url']['page'];
        }else{
            $page = 0;
            $s_page = 1;
        }      
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1); 
        
        // get dealer on my network
        $url_mynetwork = Configure::read('api.api_url') . 'api/user/getmynetwork';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body_mynetwork = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => '',
            'type' => 1,
            'start' => $start,
            'limit' => $limit,
            'total' => 1
        );
        $result_mynetwork = json_decode($this->CurlApi->to($url_mynetwork)->withData(json_encode($body_mynetwork))->withOption('HTTPHEADER', $header)->post());
        if ($result_mynetwork->status == 'success') {
            if($result_mynetwork->networks != null){
                $l = $result_mynetwork->networks;
              /*  $total = $result_mynetwork->total;*/
                $total_ = count($l);
                for($i = 0; $i < $total_ ; $i++){
                    $ar[] = $l[$i];
                }
                if(isset($ar)){
                    $dealers = $ar;
                   /* $maxpages = $this->Page($total, $limit);*/
                }
            }else{
                $dealers = '';
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $dealers = '';
            $maxpages = 0;
            $total = 0;
        }

        // get group
        $url_group = Configure::read('api.api_url') . 'api/user/getallgroupexistsmember';
        $body_group = array(
            "user_id" => $this->Session->read('Auth.User._id'),
            'limit' => $limit,
            'start' => $start,
        );
        $result_group = json_decode($this->CurlApi->to($url_group)->withData(json_encode($body_group))->withOption('HTTPHEADER', $header)->post());
        if ($result_group->status == 'success') {
            $groups = $result_group->results;
        }
        else {
            $groups = null;
        }
        
        if ($this->request->data) {
            $this->autoRender = FALSE;
            if ($this->request->data['share_id'] == 0 || $this->request->data['share_id'] == 1) {
                $is_share_dealers = '';
            } else if ($this->request->data['share_id'] == 2 || $this->request->data['share_id'] == 3) {
                $str_dealer_ = ltrim($this->request->data['is_share_dealers'],",");
                if(!empty($str_dealer_)){
                    $ar_dealer = explode(',', $str_dealer_);
                    $str_dealer = '';
                    foreach ($ar_dealer as $item) {
                        $is_share_dealers[] = $item;
                    }
                }
            }
            
            $url_share = Configure::read('api.api_url') . 'api/user/sharecartopulse';
            $header_share = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body_share = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "car_id" => $id,
                "subject" => $this->request->data['subject'],
                "content" => $this->request->data['content'],
                "is_network" => $this->request->data['share_id'],
                "is_share_dealers" => $is_share_dealers
            );
            $result_share = json_decode($this->CurlApi->to($url_share)->withData(json_encode($body_share))->withOption('HTTPHEADER', $header_share)->post());
            if (!empty($result_share)) {
                if ($result_share->status == "success") {
                    $data['error'] = 0;
                } else {
                    $data['error'] = 1;
                }
            } else {
                $data['error'] = 1;
            }
            echo json_encode($data);
        }else{
            $this->layout = 'cz_home';
        }
        
        $this->set(compact('images','car','id', 'dealers','groups', 'total', 'key', 'limit', 'maxpages','rsCarInfo','custom_zooper'));
    }

    public function Page($total, $limit) {
        if ($total % $limit != 0) {
            if ($total / $limit > round($total / $limit)) {
                return round($total / $limit) + 1;
            } else {
                return round($total / $limit);
            }
        } else {
            return $total / $limit;
        }
    }

    public function ajaxshare() {
        $this->autoRender = FALSE;
        
        if ($this->request->data) {

            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );

            if ($this->request->data['type_share'] == 0) { // share car
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "car_id" => $this->request->data['share_id'],
                    "subject" => $this->request->data['subject'],
                    "content" => $this->request->data['content'],
                    "is_network" => $this->request->data['type'],
                    "is_share_dealers" => '',
                );
            }
            else { // share rss
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "rss_id" => $this->request->data['share_id'],
                    "is_network" => $this->request->data['type'],
                    "is_share_dealers" => '',
                );
            }

            if ($body['is_network'] == 2) {
                $body['is_share_dealers'] = $this->request->data['dealer'];
            }
            else if ($body['is_network'] == 3) {
                $body['is_share_dealers'] = $this->request->data['group'];
            }

            $url = Configure::read('api.api_url') . 'api/user/sharecartopulse';
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            }
            else {
                $data['error'] = 1;
                $data['msg'] = 'Shared not successfully';
            }
        }
        else {
            $data['error'] = 1;
            $data['msg'] = 'Shared not successfully';
        }
        
        echo json_encode($data);
    }
    //add pulse
    public function addpulse() {
        $this->set('title_for_layout', 'Add new pulse');
        if ($this->request->data) {
            $this->autoRender = FALSE;
            if (!empty($_FILES['file'])) {
                $cfile1 = "";
                $cfile2 = "";
                $cfile3 = "";
                $cfile4 = "";
                $cfile5 = "";
                $cfile6 = "";
                $ar_file_data = array();
                $target_path = WWW_ROOT . "datafeed/easycars/";
                for ($i = 0; $i < sizeof($_FILES['file']['name']); $i++) {
                    if ($_FILES['file']['size'][$i] > 0) {
                        $validextensions = array("jpeg", "jpg", "png");
                        $ext = explode('.', basename($_FILES['file']['name'][$i]));
                        $file_extension = end($ext);

                        if ($file_extension == "jpg") {
                            $mime = "image/jpeg";
                        } else if ($file_extension == "png") {
                            $mime = "image/png";
                        } else if ($file_extension == "gif") {
                            $mime = "image/gif";
                        }
                        $filename = time() . rand() . '.' . $file_extension;
                        move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path . $filename);

                        $ar_file_data[] = array(
                            'name' => $filename,
                            'path' => $target_path . $filename,
                            'type' => $mime
                        );
                    }
                }
                $file = $ar_file_data;
                if (!empty($file[0])) {
                    $cfile1 = $this->getCurlValue($file[0]["path"], $file[0]["type"], $file[0]["name"]);
                }
                if (!empty($file[1])) {
                    $cfile2 = $this->getCurlValue($file[1]["path"], $file[1]["type"], $file[1]["name"]);
                }
                if (!empty($file[2])) {
                    $cfile3 = $this->getCurlValue($file[2]["path"], $file[2]["type"], $file[2]["name"]);
                }
                if (!empty($file[3])) {
                    $cfile4 = $this->getCurlValue($file[3]["path"], $file[3]["type"], $file[3]["name"]);
                }
                if (!empty($file[4])) {
                    $cfile5 = $this->getCurlValue($file[4]["path"], $file[4]["type"], $file[4]["name"]);
                }
                if (!empty($file[5])) {
                    $cfile6 = $this->getCurlValue($file[5]["path"], $file[5]["type"], $file[5]["name"]);
                }
            }
            $url_add = Configure::read('api.api_url') . 'api/user/addcarpulse';
            $header_add = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id'),
            );

            $subject = $this->request->data['subject'];
            $content = $this->request->data['content'];
            if ($this->request->data['share_id'] == 0 || $this->request->data['share_id'] == 1) {
                $is_share_dealers = '';
            } else if ($this->request->data['share_id'] == 2 || $this->request->data['share_id'] == 3) {
                $str_dealer_ = ltrim($this->request->data['is_share_dealers'],",");
                if(!empty($str_dealer_)){
                    $ar_dealer = explode(',', $str_dealer_);
                    $str_dealer = '';
                    foreach ($ar_dealer as $item) {
                        $str_dealer .='"' . $item . '",';
                    }
                    $str_dealer = rtrim($str_dealer, ",");
                    $is_share_dealers = '[' . $str_dealer . ']';
                }
            }
            $body_add = array(
                'user_id' => CakeSession::read('Auth.User._id'),
                'subject' => $subject,
                'content' => $content,
                'is_network' => 0,
                'is_admin' => 1,
                'is_share_dealers' => $is_share_dealers,
                'images[0]' => $cfile1,
                'images[1]' => $cfile2,
                'images[2]' => $cfile3,
                'images[3]' => $cfile4,
                'images[4]' => $cfile5,
                'images[5]' => $cfile6
            );
            $ch = curl_init();
            $options = array(CURLOPT_URL => $url_add,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $header_add,
                CURLINFO_HEADER_OUT => TRUE, //Request header
                CURLOPT_HEADER => false, //Return header
                CURLOPT_SSL_VERIFYPEER => false, //Don't veryify server certificate
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body_add
            );

            curl_setopt_array($ch, $options);
            $response = curl_exec($ch);
            $result = json_decode($response, false);
            curl_close($ch);

            if (!empty($result)) {
                if ($result->status == "success") {
                    $data['error'] = 0;
                } else {
                    $data['error'] = 1;
                }
            } else {
                $data['error'] = 1;
            }
            echo json_encode($data);
        }else{
            $this->layout = 'home';
        }
        
    }
    
    function getCurlValue($filename, $contentType, $postname) {
        // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
        // See: https://wiki.php.net/rfc/curl-file-upload
        if (function_exists('curl_file_create')) {
            return curl_file_create($filename, $contentType, $postname);
        }

        // Use the old style if using an older version of PHP
        $value = "@{$this->filename};filename=" . $postname;
        if ($contentType) {
            $value .= ';type=' . $contentType;
        }

        return $value;
    }

    public function loadmynetwork() {
        if ($this->request->data) {
            $this->autoRender = false;
            $member_str = ltrim($this->request->data['member_id'], ',');
            $ar_member = explode(",", $member_str);
            CakeSession::write('dealer.id', $ar_member);
            
        } else {
            $listMember = array();
            if(!empty(CakeSession::read('dealer.id'))){
                $listMember = CakeSession::read('dealer.id');
            }
            $this->set('title_for_layout', '');
            $this->layout = 'ajax';
            $step = (isset($this->params['url']['step']) && $this->params['url']['step'] != '') ? $this->params['url']['step'] : 1;
            $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
            $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : 20;

            if (isset($this->params['url']['page'])) {
                $page = $this->params['url']['page'];
                $s_page = $this->params['url']['page'];
            } else {
                $page = 0;
                $s_page = 1;
            }

            $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
            $url = Configure::read('api.api_url').'api/user/getmynetwork';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'user_email' =>$this->Session->read('Auth.User.email'),
                'keyword' => $key,
                'type' => 1,
                'start' => $start,
                'limit' => $limit,
                'total' => 1
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result != null) {
                $l = $result->networks;
                $total = $result->count_network;
                $total_ = count($l);
                for ($i = 0; $i < $total_; $i++) {
                    $ar[] = $l[$i];
                }
                if (isset($ar)) {
                    $dealers = $ar;
                    $maxpages = $this->Page($total, $limit);
                } else {
                    $dealers = '';
                    $maxpages = 0;
                    $mails = '';
                }
            } else {
                $dealers = '';
                $maxpages = 0;
                $total = 0;
                $mails = '';
            }

            $this->set(compact('step', 'dealers', 'total', 'key','listMember','total','maxpages','limit','s_page'));
        }
    }
    
    public function loadmygroups() {
        if ($this->request->data) {
            $this->autoRender = false;
            $member_str = ltrim($this->request->data['member_id'], ',');
            $ar_member = explode(",", $member_str);
            CakeSession::write('dealer.id', $ar_member);
            
        } else {
            $listMember = array();
            if(!empty(CakeSession::read('dealer.id'))){
                $listMember = CakeSession::read('dealer.id');
            }
            $this->set('title_for_layout', '');
            $this->layout = 'ajax';
            $step = (isset($this->params['url']['step']) && $this->params['url']['step'] != '') ? $this->params['url']['step'] : 1;
            $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
            $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : 20;

            if (isset($this->params['url']['page'])) {
                $page = $this->params['url']['page'];
                $page_s = $this->params['url']['page'];
            } else {
                $page = 0;
                $page_s = 1;
            }

            $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
            $url = Configure::read('api.api_url').'api/user/getallgroupexistsmember';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );

            $body = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'limit' => $limit,
                'start' => $start,
                'keyword' => $key
            );
            $result_group = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

            if ($result_group->status == 'success') {
                $l = $result_group->results;
                $total = $result_group->total;
                $total_ = count($l);
                for($i = 0; $i < $total_ ; $i++){
                    $ar[] = $l[$i];
                }
                if(isset($ar)){
                    $groups = $ar;
                    $maxpages = $this->Page($total, $limit);
                }
            } else {
                $groups = '';
                $maxpages = 0;
                $total = 0;
            }
            $this->set(compact('step', 'groups', 'total', 'key', 'limit','listMember', 'maxpages'));
        }
    }
    
    public function pulse() {
        // get parameters
        $type = (isset($this->params['url']['type'])) ? $this->params['url']['type'] : 'all';
        $filter = (isset($this->params['url']['filter'])) ? $this->params['url']['filter'] : '';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 10;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $url = Configure::read('api.api_url') . 'api/user/getcarssharepulse';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        if ($type == 'mypulse') {
            $this->set('title_for_layout', 'My Posts');
            if ($filter != '') {
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "limit" => $limit,
                    "start" => $start,
                    "type" => 1,
                    "time_zones" => CakeSession::read('time_zones'),
                    "filter" => $filter
                );
            } else {
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "limit" => $limit,
                    "start" => $start,
                    "type" => 1,
                    "time_zones" => CakeSession::read('time_zones'),
                );
            }
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success' && isset($result->share_my_pulse) && $result->share_my_pulse) {
                $list = $result->share_my_pulse;
		        $total = $result->total;
		$maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $this->set('title_for_layout', 'News & Posts');
            if ($filter != '') {
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "limit" => $limit,
                    "start" => $start,
                    "type" => 0,
                    "time_zones" => CakeSession::read('time_zones'),
                    "filter" => $filter
                );
            } else {
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "limit" => $limit,
                    "start" => $start,
                    "type" => 0,
                    "time_zones" => CakeSession::read('time_zones'),
                );
            }
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success' && isset($result->share_pulse) && $result->share_pulse) {
                $list = $result->share_pulse;
                $total = $result->total;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $maxpages = 0;
                $total = 0;
            }
        }
        
        if ($ajax == 0) {
            // get dealer on my network
            $url_mynetwork = Configure::read('api.api_url') . 'api/user/getmynetwork';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body_mynetwork = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'user_email' =>$this->Session->read('Auth.User.email'),
                'keyword' => '',
                'type' => 1,
                'start' => $start,
                'limit' => $limit,
                'total' => 1
            );
            $result_mynetwork = json_decode($this->CurlApi->to($url_mynetwork)->withData(json_encode($body_mynetwork))->withOption('HTTPHEADER', $header)->post());
            if ($result_mynetwork->status == 'success') {
                $dealers = $result_mynetwork->networks;
            }
            else {
                $dealers = null;
            }
            // get group
            $url_group = Configure::read('api.api_url') . 'api/user/getallgroupexistsmember';
            $body_group = array(
                "user_id" => $this->Session->read('Auth.User._id'),
                'limit' => $limit,
                'start' => $start,
            );
            $result_group = json_decode($this->CurlApi->to($url_group)->withData(json_encode($body_group))->withOption('HTTPHEADER', $header)->post());
            if ($result_group->status == 'success') {
                $groups = $result_group->results;
            }
            else {
                $groups = null;
            }
            
            //get recommend cars
            $urlRecommendCar = Configure::read('api.api_url') . 'api/user/getflicarrloadmorenewversionnorandom';
            $bodyRecommendCar = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'type' => 0,
                'start' => 0,
                'limit' => 9
            );
            $result = json_decode($this->CurlApi->to($urlRecommendCar)->withData(json_encode($bodyRecommendCar))->withOption('HTTPHEADER', $header)->post());
            if ($result != null) {
                $cars = $result->cars;
            } else {
                $cars = '';
            }

            $this->set(compact('list', 'maxpages', 'total', 'type', 'limit', 'page', 'filter', 'dealers', 'groups', 'cars'));

            $helpers = array('Common');
            $this->layout = 'cz_home';
            $this->render('pulse');
            
        } else {
            $this->set(compact('list', 'maxpages', 'total', 'type', 'limit', 'page', 'filter'));
            
            $this->layout = null;
            $this->render('pulse_ajax');
        }
    }
    //Detail of pulse
    public function pulse_detail($id = null) {
        $this->set('title_for_layout', 'Post Detail');
        $this->layout = 'cz_home';
        $url = Configure::read('api.api_url') . 'api/user/getpulsedetail?pulse_id=' . $id;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );       
        $rs = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get())->share_pulse;
        if ($rs->images != null && sizeof($rs->images) > 0) {
            $images = $rs->images;
        }else {
            $images = null;
        }
        $car = ($rs->cars != null) ? $rs->cars : '';
        
        $tz_object = new DateTimeZone(CakeSession::read('time_zones'));
        $date = new DateTime($rs->created_at);
        $date->setTimezone($tz_object);
        $rs->created_at = $date->format('Y-m-d H:i:s');
                                    
        $this->set(compact('rs', 'car', 'images'));
    }

    public function pulse_user($id = null) {
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 10;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getpulsebyuser';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => $id,
            "limit" => $limit,
            "start" => $start,
            "time_zones" => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        if ($result && isset($result->status) && $result->status == 'success' && isset($result->pulse_of_user) && $result->pulse_of_user) {
            $list = $result->pulse_of_user;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }

        $nofilter = 1;
        if ($ajax == 0) {
            // get dealer on my network
            $url_mynetwork = Configure::read('api.api_url') . 'api/user/getmynetwork';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body_mynetwork = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'user_email' =>$this->Session->read('Auth.User.email'),
                'keyword' => '',
                'type' => 1,
                'start' => $start,
                'limit' => $limit,
                'total' => 1
            );
            $result_mynetwork = json_decode($this->CurlApi->to($url_mynetwork)->withData(json_encode($body_mynetwork))->withOption('HTTPHEADER', $header)->post());
            if ($result_mynetwork->status == 'success') {
                $dealers = $result_mynetwork->networks;
            }
            else {
                $dealers = null;
            }
            // get group
            $url_group = Configure::read('api.api_url') . 'api/user/getallgroupexistsmember';
            $body_group = array(
                "user_id" => $this->Session->read('Auth.User._id'),
                'limit' => $limit,
                'start' => $start,
            );
            $result_group = json_decode($this->CurlApi->to($url_group)->withData(json_encode($body_group))->withOption('HTTPHEADER', $header)->post());
            if ($result_group->status == 'success') {
                $groups = $result_group->results;
            }
            else {
                $groups = null;
            }
            
            //get recommend cars
            $urlRecommendCar = Configure::read('api.api_url') . 'api/user/getflicarrloadmorenewversionnorandom';
            $bodyRecommendCar = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'type' => 0,
                'start' => 0,
                'limit' => 9
            );
            $result = json_decode($this->CurlApi->to($urlRecommendCar)->withData(json_encode($bodyRecommendCar))->withOption('HTTPHEADER', $header)->post());
            if ($result != null) {
                $cars = $result->cars;
            } else {
                $cars = '';
            }
            
            $this->set(compact('id', 'list', 'maxpages', 'total', 'type', 'limit', 'page', 'nofilter', 'dealers', 'groups', 'cars'));
            $this->set('title_for_layout', 'User\'s Post');
            $this->helpers = array('Common');
            $this->layout = 'cz_home';
            $this->render('pulse_user');
            
        } else {
            $this->set(compact('id', 'list', 'maxpages', 'total', 'type', 'limit', 'page', 'nofilter'));
            
            $this->layout = null;
            $this->render('pulse_user_ajax');
        }
    }

    public function report_pulse($id = null) {
        $this->autoRender = false;
        if ($this->request->data) {
            $url = Configure::read('api.api_url') . 'api/user/addreportbypulse';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "pulse_id" => $id,
                "comment" => $this->request->data['comment']
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
            }
        } else {
            $data['error'] = 1;
        }
        echo json_encode($data);
    }

    public function admin_pulse() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'All Posts');
        $title = 'All Posts';
        $keyword = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : "";
        $date_from = (isset($this->params['url']['date_from']) && $this->params['url']['date_from'] != '') ? date('Y-m-d 00:00:00', strtotime($this->params['url']['date_from'])) : "";
        $date_to = (isset($this->params['url']['date_to']) && $this->params['url']['date_to'] != '') ? date('Y-m-d 00:00:00', strtotime($this->params['url']['date_to'])) : "";
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        $limit = (isset($this->params['url']['limit'])) ? $this->params['url']['limit'] : 20;
        $type = (isset($this->params['url']['type'])) ? $this->params['url']['type'] : 0;
        
        if ($sort == 'desc') {
            $u_sort = 'asc';
        } else {
            $u_sort = 'desc';
        }
        if (empty($this->params['url']['ajax'])) {
            $ajax = 1;
        } else {
            $ajax = 0;
        }
        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
            $s_page = $this->params['url']['page'];
        } else {
            $page = 0;
            $s_page = 1;
        }
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $stt = $start + 1;
        $url = Configure::read('api.api_url') . 'api/user/getallpulseadmin';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "limit" => $limit,
            "start" => $start,
            "date_from" => $date_from,
            "date_to" => $date_to,
            "fieldsort" => $fieldsort,
            "sort" => $sort,
            "type" => $type
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result->status == 'success') {
            if ($result->pulse != null) {
                $l = $result->pulse;
                $total = $result->total;
                $total_ = count($l);
                for ($i = 0; $i < $total_; $i++) {
                    $ar[] = $l[$i];
                }
                $list = $ar;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }

        $this->set(compact('list', 'maxpages', 'total', 'type', 'limit', 'title', 'keyword', 'date_from', 'date_to', 's_page', 'stt', 'fieldsort', 'u_sort', 'sort', 'type'));
    }

    //Admin pulse

    public function admin_pulse_user($id = null) {
        $this->set('title_for_layout', 'User\'s pulse');
        $title = 'User\'s pulse';
        $limit = 10;
        if (empty($this->params['url']['ajax'])) {
            $ajax = 1;
        } else {
            $ajax = 0;
        }
        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        } else {
            $page = 0;
        }
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $url = Configure::read('api.api_url') . 'api/user/getpulsebyuser';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => $id,
            "limit" => $limit,
            "start" => $start,
            "time_zones" => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            if ($result->pulse_of_user != null) {
                $l = $result->pulse_of_user;
                $total = $result->total;
                $total_ = count($l);
                for ($i = 0; $i < $total_; $i++) {
                    $ar[] = $l[$i];
                }
                $list = $ar;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }

        $this->set(compact('list', 'maxpages', 'total', 'type', 'limit', 'title', 'id'));
        if ($ajax == 1) {
            $this->layout = 'admintrator';
            $this->render('admin_pulse_user');
        } else {
            $this->layout = null;
            $this->render('admin_pulse_user_ajax');
        }
    }

    public function admin_pulse_detail($id = null) {
        $this->set('title_for_layout', 'Pulse Details');
        $this->layout = 'admintrator';
        $id = (isset($this->params['url']['id']))?$this->params['url']['id']:$id;
        $keyword = (isset($this->params['url']['key']))?$this->params['url']['key']:'';
        $date_from = (isset($this->params['url']['date_from']))?$this->params['url']['date_from']:'';
        $date_to = (isset($this->params['url']['date_to']))?$this->params['url']['date_to']:'';
        $s_page = (isset($this->params['url']['page']))?$this->params['url']['page']:'';
        $url = Configure::read('api.api_url') . 'api/user/getpulsedetail?pulse_id=' . $id;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $rs = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get())->share_pulse;
        
        if ($rs->images != null) {
            $im = $rs->images;
            foreach ($im as $img):
                $images[] = $img->image_file_name;
            endforeach;
        }else {
            $images = '';
        }
        $car = (isset($rs->cars) && $rs->cars != null) ? $rs->cars : '';
        $this->set(compact('rs','car' ,'keyword','date_from','date_to', 'images','s_page'));
    }

    public function admin_report_pulse($id = null) {
        $this->set('title_for_layout', 'Pulse reports');
        $this->layout = 'admintrator';
        $limit = 10;
        if (empty($this->params['url']['ajax'])) {
            $ajax = 1;
        } else {
            $ajax = 0;
        }
        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        } else {
            $page = 0;
        }
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $url = Configure::read('api.api_url') . 'api/user/getallreportofpulse';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "pulse_id" => $id,
            "limit" => $limit,
            "start" => $start
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            if ($result->report_of_pulse != null) {
                $l = $result->report_of_pulse;
                $total = $result->total;
                $total_ = count($l);
                for ($i = 0; $i < $total_; $i++) {
                    $ar[] = $l[$i];
                }
                $list = $ar;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }
        $this->set(compact('list', 'maxpages', 'total', 'limit', 'id'));
        if ($ajax == 1) {
            $this->layout = 'admintrator';
            $this->render('admin_report_pulse');
        } else {
            $this->layout = null;
            $this->render('admin_report_pulse_ajax');
        }
    }

    public function admin_add_pulse() {
        CakeSession::delete('dealer.id');
        $this->set('title_for_layout', 'Add new pulse');
        
        $step = (isset($this->params['url']['step']) && $this->params['url']['step'] != '') ? $this->params['url']['step'] : 1;
        $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : 5;

        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
            $page_s = $this->params['url']['page'];
        } else {
            $page = 0;
            $page_s = 1;
        }

        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $url = Configure::read('api.api_url') . 'api/user/getalluseradmin';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );

        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "keyword" => '',
            "date_from" => '',
            "date_to" => '',
            "type" => 4,
            "start" => $start,
            "limit" => $limit,
            "sort" => 0,
            "time_zones" => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result != null) {
            $l = $result->users;
            $total = $result->total;
            $total_ = count($l);
            for ($i = 0; $i < $total_; $i++) {
                $ar[] = $l[$i];
            }
            if (isset($ar)) {
                $dealers = $ar;
                $maxpages = $this->Page($total, $limit);
            } else {
                $dealers = '';
                $maxpages = 0;
                $mails = '';
            }
        } else {
            $dealers = '';
            $maxpages = 0;
            $total = 0;
            $mails = '';
        }

        if ($this->request->data) {
            $this->autoRender = FALSE;
            if (!empty($_FILES['file'])) {
                $cfile1 = "";
                $cfile2 = "";
                $cfile3 = "";
                $cfile4 = "";
                $cfile5 = "";
                $cfile6 = "";

                $ar_file_data = array();
                $target_path = WWW_ROOT . "datafeed/easycars/";
                for ($i = 0; $i < sizeof($_FILES['file']['name']); $i++) {
                    if ($_FILES['file']['size'][$i] > 0) {
                        $validextensions = array("jpeg", "jpg", "png");
                        $ext = explode('.', basename($_FILES['file']['name'][$i]));
                        $file_extension = strtolower(end($ext));

                        if ($file_extension == "jpg") {
                            $mime = "image/jpeg";
                        } else if ($file_extension == "png") {
                            $mime = "image/png";
                        } else if ($file_extension == "gif") {
                            $mime = "image/gif";
                        }
                        $filename = time() . rand() . '.' . $file_extension;
                        move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path . $filename);

                        $ar_file_data[] = array(
                            'name' => $filename,
                            'path' => $target_path . $filename,
                            'type' => $mime
                        );
                    }
                }
                $file = $ar_file_data;
                if (!empty($file[0])) {
                    $cfile1 = $this->getCurlValue($file[0]["path"], $file[0]["type"], $file[0]["name"]);
                }
                if (!empty($file[1])) {
                    $cfile2 = $this->getCurlValue($file[1]["path"], $file[1]["type"], $file[1]["name"]);
                }
                if (!empty($file[2])) {
                    $cfile3 = $this->getCurlValue($file[2]["path"], $file[2]["type"], $file[2]["name"]);
                }
                if (!empty($file[3])) {
                    $cfile4 = $this->getCurlValue($file[3]["path"], $file[3]["type"], $file[3]["name"]);
                }
                if (!empty($file[4])) {
                    $cfile5 = $this->getCurlValue($file[4]["path"], $file[4]["type"], $file[4]["name"]);
                }
                if (!empty($file[5])) {
                    $cfile6 = $this->getCurlValue($file[5]["path"], $file[5]["type"], $file[5]["name"]);
                }
            }
            $url_add = Configure::read('api.api_url') . 'api/user/addcarpulse';
            $header_add = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id'),
            );

            $subject = $this->request->data['subject'];
            $content = $this->request->data['content'];
            if ($this->request->data['share_id'] == 0) {
                $is_share_dealers = '';
            } else if ($this->request->data['share_id'] == 2) {
                $str_dealer_ = ltrim($this->request->data['is_share_dealers'],",");
                if(!empty($str_dealer_)){
                    $ar_dealer = explode(',', $str_dealer_);
                    $str_dealer = '';
                    foreach ($ar_dealer as $item) {
                        $str_dealer .='"' . $item . '",';
                    }
                    $str_dealer = rtrim($str_dealer, ",");
                    $is_share_dealers = '[' . $str_dealer . ']';
                }
            }
            $body_add = array(
                'user_id' => CakeSession::read('Auth.User._id'),
                'subject' => $subject,
                'content' => $content,
                'is_network' => 0,
                'is_admin' => 1,
                'is_share_dealers' => $is_share_dealers,
                'images[0]' => $cfile1,
                'images[1]' => $cfile2,
                'images[2]' => $cfile3,
                'images[3]' => $cfile4,
                'images[4]' => $cfile5,
                'images[5]' => $cfile6
            );
            $ch = curl_init();
            $options = array(CURLOPT_URL => $url_add,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $header,
                CURLINFO_HEADER_OUT => TRUE, //Request header
                CURLOPT_HEADER => false, //Return header
                CURLOPT_SSL_VERIFYPEER => false, //Don't veryify server certificate
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body_add
            );

            curl_setopt_array($ch, $options);
            $response = curl_exec($ch);
            $result = json_decode($response, false);
            curl_close($ch);

            if (!empty($result)) {
                if ($result->status == "success") {
                    $data['error'] = 0;
                } else {
                    $data['error'] = 1;
                }
            } else {
                $data['error'] = 1;
            }
            echo json_encode($data);
        }else{
            $this->layout = 'admintrator';
        }
        $this->set(compact('step', 'dealers', 'total', 'key', 'limit', 'maxpages'));
        
    }

    public function admin_load_user() {
        if ($this->request->data) {
            $this->autoRender = false;
            $member_str = ltrim($this->request->data['member_id'], ',');
            $ar_member = explode(",", $member_str);
            CakeSession::write('dealer.id', $ar_member);
            
        } else {
            $listMember = array();
            if(!empty(CakeSession::read('dealer.id'))){
                $listMember = CakeSession::read('dealer.id');
            }
            $this->set('title_for_layout', 'Add new pulse');
            $this->layout = 'ajax';
            $step = (isset($this->params['url']['step']) && $this->params['url']['step'] != '') ? $this->params['url']['step'] : 1;
            $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
            $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : 20;

            if (isset($this->params['url']['page'])) {
                $page = $this->params['url']['page'];
                $page_s = $this->params['url']['page'];
            } else {
                $page = 0;
                $page_s = 1;
            }

            $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
            $url = Configure::read('api.api_url') . 'api/user/getalluseradmin';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );

            $body = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "keyword" => $key,
                "date_from" => '',
                "date_to" => '',
                "type" => 4,
                "start" => $start,
                "limit" => $limit,
                "sort" => 0
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

            if ($result != null) {
                $l = $result->users;
                $total = $result->total;
                $total_ = count($l);
                for ($i = 0; $i < $total_; $i++) {
                    $ar[] = $l[$i];
                }
                if (isset($ar)) {
                    $dealers = $ar;
                    $maxpages = $this->Page($total, $limit);
                } else {
                    $dealers = '';
                    $maxpages = 0;
                    $mails = '';
                }
            } else {
                $dealers = '';
                $maxpages = 0;
                $total = 0;
                $mails = '';
            }

            $this->set(compact('step', 'dealers', 'total', 'key','listMember'));
        }
    }

    public function del_pulse() {
        $this->autoRender = false;
        $id = $this->params['url']['id'];
        $key = $this->params['url']['key'];
        $date_from = $this->params['url']['date_from'];
        $date_to = $this->params['url']['date_to'];
        $page = $this->params['url']['page'];
        $url = Configure::read('api.api_url') . 'api/user/updatestatuspulse';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "pulse_id" => $id,
            "status" => 1,
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            $this->Session->setFlash('Deleted successfully');
        } else {
            $this->Session->setFlash('Deleted not successfully');
        }

        return $this->redirect('/admin_pulse?key=' . $key . '&date_from=' . $date_from . '&date_to=' . $date_to . '&page=' . $page);
    }

    public function del_report($id = null) {
        $this->autoRender = false;
        $url = Configure::read('api.api_url') . 'api/user/updatestatusreport';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "report_id" => $id,
            "status" => 1,
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        return $this->redirect('/admin_report_pulse/' . $id);
    }

    public function car_detail_transfer($id = null) {
        $this->set('title_for_layout', 'Cars detail');
        $this->layout = 'home';
        $type = $this->params['url']['type'];
        $user_session = $this->Session->read('Auth.User._id');
        $url_follow = Configure::read('api.api_url') . 'api/user/getlistfollow?car_id=' . $id;
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url_follow)->withOption('HTTPHEADER', $header)->get());
        $count_follow = $result->followers;
        $car = $this->ResultCarTranferId($id)->car[0]->cars;
        // get info client-no
        $info_client_no = $this->ResultCarTranferId($id)->car[0]->users;

        //get us_receivers
        $us_receivers = $this->ResultCarTranferId($id)->other_infor->us_receivers;
        //us_trans
        $us_trans = $this->ResultCarTranferId($id)->other_infor->us_trans;
        if ($car->location != '') {
            $address = $car->location;
            $local_car = str_replace(' ', '+', $car->location);
            $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $local_car . '&sensor=false');
            $output = json_decode($geocode);
            $lat2 = $output->results[0]->geometry->location->lat;
            $lng2 = $output->results[0]->geometry->location->lng;
        } else {
            $address = '';
            $lat2 = '';
            $lng2 = '';
        }

        // get notes
        $url_notes = Configure::read('api.api_url') . 'api/user/getnotes';
        $body_notes = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "car_id" => $id
        );
        $notes = json_decode($this->CurlApi->to($url_notes)->withData(json_encode($body_notes))->withOption('HTTPHEADER', $header)->post())->notes;

        $this->set(compact('car', 'user_session', 'count_follow', 'info_client_no', 'notes', 'address', 'lat2', 'lng2', 'type', 'trans', 'us_trans', 'us_receivers'));
    }

    public function ResultCarTranferId($id) {
        $url = Configure::read('api.api_url') . 'api/user/getcarreceiverbyid';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "car_id" => $id
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        return $result;
    }

    public function khoangcach($id = null) {
        $this->autoRender = false;
        $url = Configure::read('api.api_url') . 'api/user/getcardetail';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $CompanyId= $this->Session->read('Auth.User.company_id') ;
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "car_id" => $id,
            'login_company_id'=>$CompanyId
        );
        $car = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post())->car[0]->cars;
        if (isset($this->request->data)) {
            $data['error'] = 0;
            $lat1 = $this->request->data['latitude'];
            $lng1 = $this->request->data['longitude'];
            if ($car->location != '') {
                $local_car = str_replace(' ', '+', $car->location);
                $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $local_car . '&sensor=false');
                $output = json_decode($geocode);
                $lat2 = $output->results[0]->geometry->location->lat;
                $lng2 = $output->results[0]->geometry->location->lng;
                $theta = $lng2 - $lng1;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $data['kc'] = number_format($miles * 1.609344, 0, ',', ',');
            } else {
                $data['kc'] = '0';
            }
        } else {
            $data['error'] = 1;
        }

        echo json_encode($data);
        die();
    }
    // sell a car
    public function sellcar() {
        $this->autoRender = false;
        if ($this->request->data) {
            $id = $this->request->data['id'];
            $transactor_id = $this->request->data['transactor_id'];

            $url = Configure::read('api.api_url') . 'api/user/createtransaction';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'car_id' => $id,
                'transactor_id' => $transactor_id,
                'action_transactor_id' => $this->Session->read('Auth.User._id'),
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
                $data['msg'] = $result->response;
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Error';
        }
        echo json_encode($data);
    }
    //buy a car
    public function buycar() {
        $this->autoRender = false;
        if ($this->request->data) {
            $id = $this->request->data['id'];
            $url = Configure::read('api.api_url') . 'api/user/createtransaction';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'car_id' => $id,
                'transactor_id' => $this->Session->read('Auth.User._id'),
                'action_transactor_id' => $this->Session->read('Auth.User._id'),
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
                $data['msg'] = $result->response;
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Error';
        }
        echo json_encode($data);
    }

    public function update_sell_buy() {
        $this->autoRender = false;
        if ($this->request->data) {
            $id = $this->request->data['id'];
            $url = Configure::read('api.api_url') . 'api/user/canceltransaction?car_id=' . $id;
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
                $data['msg'] = $result->response;
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Error';
        }
        echo json_encode($data);
    }

    public function update_accept() {
        $this->autoRender = false;
        if ($this->request->data) {
            $id = $this->request->data['id'];
            $rsInfo = $this->ResultCarId($id);
            $car = isset($rsInfo->car[0]->cars)? $rsInfo->car[0]->cars : null;
            $carName = trim($car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox);
            $url = Configure::read('api.api_url') . 'api/user/accepttransaction';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'car_id' => $id,
                'action_transactor_id' => -1,
                'user_id' => $rsInfo->transactor_id,
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

            if ($result->status == 'success') {
                return $this->redirect('/cardetails/'.$car->_id.'/'.str_replace(' ', '-', $carName));
            }
        }
    }

    // update content comment in table car
    public function update_comment() {
        $this->autoRender = false;
        $this->layout = null;
        if ($this->request->data) {
            $id = $this->request->data['id'];
            $rsInfo = $this->ResultCarId($id);
            $car = isset($rsInfo->car[0]->cars)? $rsInfo->car[0]->cars : null;
            $carName = trim($car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox);
            $url = Configure::read('api.api_url') . 'api/user/editcomment';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id'),
            );
            $body = array(
                'comment' => $this->request->data['comments'],
                'user_id' => $this->Session->read('Auth.User._id'),
                'car_id' => $id,
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                return $this->redirect('/cardetails/'.$car->_id.'/'.str_replace(' ', '-', $carName));
            }
        }
    }

    // update content comment in table commnent
    public function update_notes() {
        $this->autoRender = false;
        $this->layout = null;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id'),
        );
        if ($this->request->data) {
            $car_id = $this->request->data['car_id'];
            $user_id = $this->request->data['user_id'];
            $rsInfo = $this->ResultCarId($car_id);
            $car = isset($rsInfo->car[0]->cars)? $rsInfo->car[0]->cars : null;
            $carName = trim($car->manu_year.' '.$car->make.' '.$car->model.' '.$car->series.' '.$car->gearbox);
            $url = Configure::read('api.api_url') . 'api/user/addnotes';
            $body = array(
                'user_id' => $user_id,
                'notes' => $this->request->data['comment'],
                'car_id' => $car_id
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

            if ($result->status == 'success') {
                return $this->redirect('/cardetails/'.$car->_id.'/'.str_replace(' ', '-', $carName));
            }
        }
    }

    public function add_transfers() {
        $this->autoRender = FALSE;
        if ($this->request->data) {
            $id = $this->request->data['car_id'];
            $receiver_id = $this->request->data['receiver_id'];
            $url = Configure::read('api.api_url') . 'api/user/transfercar';
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'transfer_id' => $this->Session->read('Auth.User._id'),
                'car_id' => $id,
                'transfer_name' => $this->Session->read('Auth.User.name'),
                'receiver_id' => $receiver_id
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
                $data['msg'] = $result->response;
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Error';
        }
        echo json_encode($data);
    }

    public function cancel_transfers() {
        $this->autoRender = false;
        $this->layout = null;
        $id = $this->request->data['id'];
        $type = $this->request->data['type'];
        $url = Configure::read('api.api_url') . 'api/user/canceltransfercar?transfer_car_id=' . $id;
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );

        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if ($result->status == 'success') {
            if ($type == 'transferring') {
                return $this->redirect('/transferring');
            } else {
                return $this->redirect('/transfered');
            }
        }
    }

    public function accept_transfers() {
        $this->autoRender = false;
        $id = $this->request->data['id'];
        $type = $this->request->data['type'];
        $url = Configure::read('api.api_url') . 'api/user/accepttransfercar?transfer_car_id=' . $id;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());

        if ($result->status == 'success') {
            if ($type == 'transferring') {
                return $this->redirect('/transferring');
            } else {
                return $this->redirect('/transfered');
            }
        }
    }

    public function flicka() {
        if ($this->Auth->login()) {
            $input = $this->params['url'];
            // filter by
            $type = isset($input['type']) ? 1 : 0;
            $year_from = isset($input['year_from']) ? $input['year_from'] : '';
            $year_to = isset($input['year_to']) ? $input['year_to'] : '';
            $price_from = isset($input['price_from']) ? $input['price_from'] : '';
            $price_to = isset($input['price_to']) ? $input['price_to'] : '';
            $location = isset($input['location']) ? $input['location'] : '';
            $distance = isset($input['distance']) ? $input['distance'] : '';
            if ($distance) {
                $arrDistance = split(',', $distance);
                $distance_from = isset($arrDistance[0])? $arrDistance[0] : 0;
                $distance_to = isset($arrDistance[1])? $arrDistance[1] : 1000;
        }
            // get ajax
            $ajax = isset($input['ajax']) ? $input['ajax'] : '';
            // pagination
            $limit = (isset($input['limit']) && $input['limit']) ? $input['limit'] : 20;
            $page = (isset($input['page']) && $input['page'])? $input['page'] : 1;
            $start = $limit * ($page - 1);
            
            // call api: header, url, body
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $url = Configure::read('api.api_url') . 'api/user/getflicarrloadmorenewversion';
            $body = [
                'company_id' => CakeSession::read('Auth.User.company_id'),
                'user_id' => CakeSession::read('Auth.User._id'),
                'type' => $type,
                'year_from' => $year_from,
                'year_to' => $year_to,
                'price_from' => $price_from,
                'price_to' => $price_to,
                'distance_from' => isset($distance_from)? $distance_from : '',
                'distance_to' => isset($distance_to)? $distance_to : '',
                'location' => $location,
                'start' => $start,
                'limit' => $limit
            ];
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result && isset($result->cars) && $result->cars) {
                $list = $result->cars;
               // debug($list);die();
            } else {
                $list = null;
            }
            $this->set(compact(array('list', 'limit', 'page', 'type', 'price_from', 'price_to', 'year_from', 'year_to')));
            if ($ajax == 0) {
                $this->helpers = array('Common');
                $this->set('title_for_layout', 'Flicka');
                $this->layout = 'cz_home';
                $this->render('flicka');
            } else {
                $this->layout = null;
                $this->render('flicka_ajax');
            }
        }
        else {
            return $this->redirect('/');
        }
    }
    //Car for sale
    public function cars_for_sale() {
        $this->set('title_for_layout', 'Cars For Sale');
        $this->set('breadcrumb', [
                (object) ['title' => 'Home'], 
                (object) ['title' => 'Cars For Sale', 'active' => true]
        ]);
        $this->layout = 'cz_home';

        // get data for filter
        $result2 = $this->ResultDatasearch();
        if ($result2 != null) {
            foreach ($result2[0] as $rs) {
                if ($rs->field_name == 'make') { $makes = $rs->values;}
                if ($rs->field_name == 'gearbox') { $gearboxs = $rs->values;}
                if ($rs->field_name == 'body_colour') { $colos = $rs->values;}
                if ($rs->field_name == 'body') { $bodys = $rs->values;}
                if ($rs->field_name == 'fuel_type') { $fuel_types = $rs->values;}
                if ($rs->field_name == 'seats') { $seats = $rs->values;}
                if ($rs->field_name == 'doors') { $doors = $rs->values;}
                if ($rs->field_name == 'post_code') { $post_codes = $rs->values;}
                if ($rs->field_name == 'location') { $locations = $rs->values;}
                if ($rs->field_name == 'manu_year_from') { $manu_year_from = $rs->values;}
                if ($rs->field_name == 'manu_year_to') { $manu_year_to = $rs->values;}
                if ($rs->field_name == 'odometer_from') { $odometer_from = $rs->values;}
                if ($rs->field_name == 'odometer_to') { $odometer_to = $rs->values;}
                if ($rs->field_name == 'price_from') { $price_from = $rs->values;}
                if ($rs->field_name == 'price_to') { $price_to = $rs->values;}
                if ($rs->field_name == 'engine_capacity') { $engine_capacity = $rs->values;}
                if ($rs->field_name == 'cylinders') { $cylinders = $rs->values;}
                if ($rs->field_name == 'gears') { $gears = $rs->values;}
            }
        }
        // get recommend cars
        $url1 = Configure::read('api.api_url') . 'api/user/getflicarrloadmorenewversionnorandom';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body_api = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'type' => 0,
            'start' => 0,
            'limit' => 8
        );
        $result = json_decode($this->CurlApi->to($url1)->withData(json_encode($body_api))->withOption('HTTPHEADER', $header)->post());
        if ($result != null) {
            $cars = $result->cars;
        } else {
            $cars = '';
        }

        $this->set(compact('doors', 'gears', 'cylinders', 'engine_capacity', 'makes', 'colos', 'gearboxs', 'bodys', 'locations', 'fuel_types', 'seats', 'cars', 'post_codes', 'manu_year_from', 'manu_year_to', 'odometer_from', 'odometer_to', 'price_from', 'price_to'));
    }
    //Search result
    public function ResultDatasearch() {
        $url = Configure::read('api.api_url') . 'api/user/datasearch';
        $header = array(
            'userid:' . CakeSession::read('Auth.User._id'),
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if (isset($result) && $result->status == 'success') {
            return $result->message;
        } else {
            return null;
        }
    }
    //get make list
    public function getmakelist() {
        $this->autoRender = false;
        $this->layout = null;
        
        if ($this->request->data) {
            // call api
            $url = Configure::read('api.api_url') . 'api/user/getlistofmakesyearfromto';
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "type_code" => 'A',
                "year_from" => isset($this->request->data['year_from'])? $this->request->data['year_from'] : '',
                "year_to" => isset($this->request->data['year_to'])? $this->request->data['year_to'] : '',
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            
            $ds = '';
            $list = array();
            $textDefault = isset($this->request->data['text_defaut'])? $this->request->data['text_defaut'] : 'Any';
            
            if ($result && isset($result->list_make) && count($result->list_make) > 0) {
                $ds .= '<option value="">'.$textDefault.'</option>';
                foreach ($result->list_make as $make) {
                    $ds .= '<option data-code="' . $make->code . '" value="' . $make->name . '">' . $make->name . '</option>';
                    $list[$make->name] = $make->code;
                }
            } else {
                $ds .= '<option value="">'.$textDefault.'</option>';
            }
            
            echo json_encode(['html' => $ds, 'list' => $list]);
        }
    }
    //get model list
    public function getmodellist() {
        $this->autoRender = false;
        $this->layout = null;
        
        if ($this->request->data) {
            // call api
            $url = Configure::read('api.api_url') . 'api/user/getlistofmodelsyearfromto';
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "type_code" => 'A',
                "year_from" => isset($this->request->data['year_from'])? $this->request->data['year_from'] : '',
                "year_to" => isset($this->request->data['year_to'])? $this->request->data['year_to'] : '',
                "manufacturer_code" => isset($this->request->data['make'])? $this->request->data['make'] : '',
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            
            $ds = '';
            $list = array();
            $textDefault = isset($this->request->data['text_defaut'])? $this->request->data['text_defaut'] : 'Any';
            if ($result && isset($result->list_model) && count($result->list_model) > 0) {
                $ds .= '<option value="">'.$textDefault.'</option>';
                foreach ($result->list_model as $model) {
                    $ds .= '<option data-code="' . $model->code . '" value="' . $model->name . '">' . $model->name . '</option>';
                    $list[$model->name] = $model->code;
                }
            } else {
                $ds .= '<option value="">'.$textDefault.'</option>';
            }
            
            echo json_encode(['html' => $ds, 'list' => $list]);
        }
    }
    //get vanriant list
    public function getvariantlist() {
        $this->autoRender = false;
        $this->layout = null;
        
        if ($this->request->data) {
            // call api
            $url = Configure::read('api.api_url') . 'api/user/getlistofvariantsyearfromto';
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "type_code" => 'A',
                "year_from" => isset($this->request->data['year_from'])? $this->request->data['year_from'] : '',
                "year_to" => isset($this->request->data['year_to'])? $this->request->data['year_to'] : '',
                "manufacturer_code" => isset($this->request->data['make'])? $this->request->data['make'] : '',
                "family_code" => isset($this->request->data['model'])? $this->request->data['model'] : ''
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            
            $ds = '';
            $textDefault = isset($this->request->data['text_defaut'])? $this->request->data['text_defaut'] : 'Any';
            if ($result && isset($result->list_variants) && count($result->list_variants) > 0) {
                $ds .= '<option value="">'.$textDefault.'</option>';
                foreach ($result->list_variants as $variant) {
                    $ds .= '<option value="' . $variant->name . '">' . $variant->name . '</option>';
                }
            } else {
                $ds .= '<option value="">'.$textDefault.'</option>';
            }
            
            echo json_encode(['html' => $ds]);
        }
    }
    //get series list
    public function getserieslist() {
        $this->autoRender = false;
        $this->layout = null;
        if ($this->request->data) {
            // call api
            $url = Configure::read('api.api_url') . 'api/user/getlistofseriesyearfromto';
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "type_code" => 'A',
                "year_from" => isset($this->request->data['year_from'])? $this->request->data['year_from'] : '',
                "year_to" => isset($this->request->data['year_to'])? $this->request->data['year_to'] : '',
                "manufacturer_code" => isset($this->request->data['make'])? $this->request->data['make'] : '',
                "family_code" => isset($this->request->data['model'])? $this->request->data['model'] : '',
                "variant_name" => isset($this->request->data['variant'])? $this->request->data['variant'] : '',
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            
            $ds = '';
            $list = array();
            $textDefault = isset($this->request->data['text_defaut'])? $this->request->data['text_defaut'] : 'Any';
            if ($result && isset($result->list_series) && count($result->list_series) > 0) {
                $ds .= '<option value="">'.$textDefault.'</option>';
                foreach ($result->list_series as $series) {
                    $ds .= '<option data-code="' . $series->code . '" value="' . $series->name . '">' . $series->name . '</option>';
                    $list[$series->name] = $series->code;
                }
            } else {
                $ds .= '<option value="">'.$textDefault.'</option>';
            }
            
            echo json_encode(['html' => $ds, 'list' => $list]);
        }
    }
    //change make
    public function changemake() {
        $this->autoRender = false;
        if ($this->request->data) {
            $make = $this->request->data['make'];
            
            $models = array();
            if (isset($make) && $make) {
                $rsIdenticar = $this->searchIdenticar($make);
                foreach ($rsIdenticar->results as $rsIden) {
                    $models[] = $rsIden->name;
                }
            }
            $models = array_unique($models);
        
            $ds = '';
            if (isset($models) && count($models) > 0) {
                $ds .= '<option value="">Any</option>';
                for ($i = 0; $i < sizeof($models); $i++) {
                    $ds .= '<option value="' . $models[$i] . '">' . $models[$i] . '</option>';
                }
            } else {
                $ds .= '<option value="">Any</option>';
            }
            $data['ds'] = $ds;
            echo $ds;
        }
    }
    //Search indenticar by make
    public function searchIdenticar($make) {
        $urlIdenticar = 'http://ppsr.identicar.com.au/api/search/make/' . $make;
        
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n"
            )
        );

        $context = stream_context_create($opts);
        
        $data = json_decode(file_get_contents($urlIdenticar, false, $context));
        return $data;
    }
    //Change make in car for sale
    public function changemake_car4sale() {
        $this->autoRender = false;
        if ($this->request->data) {
            $make = $this->request->data['make'];
            $url = Configure::read('api.api_url') . 'api/user/getmodelbymakeforcarsale?make=' . $make;
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
            
            $ds = '';
            if (isset($result->model) && count($result->model) > 0) {
                $ds .= '<option value="">Any</option>';
                for ($i = 0; $i < sizeof($result->model); $i++) {
                    $ds .= '<option value="' . $result->model[$i] . '">' . $result->model[$i] . '</option>';
                }
            } else {
                $ds .= '<option value="">Any</option>';
            }
            $data['ds'] = $ds;
            echo $ds;
        }
    }
    //change model
    public function changemodel() {
        $this->autoRender = false;
        if ($this->request->data) {
            $make = $this->request->data['make'];
            $model = $this->request->data['model'];
            
            $series = array();
            if (isset($make) && $make) {
                $rsIdenticar = $this->searchIdenticar($make);
                foreach ($rsIdenticar->results as $rsIden) {
                    if (strtolower(trim($rsIden->name)) == strtolower(trim($model))) {
                        foreach ($rsIden->models as $idenModel) {
                            $series[] = $idenModel->name;
                        }
                    }
                }
            }
            $series = array_unique($series);
            
            $ds = '';
            if (count($series) > 0) {
                $ds .= '<option value="">-- Choose a series --</option>';
                for ($i = 0; $i < sizeof($series); $i++) {
                    $ds .= '<option value="' . $series[$i] . '">' . $series[$i] . '</option>';
                }
            } else {
                $ds .= '<option value="-1">-- Not found --</option>';
            }
            $data['ds'] = $ds;
            echo $ds;
        }
    }
    //change model in car for sale
    public function changemodel_car4sale() {
        $this->autoRender = false;
        if ($this->request->data) {
            $make = $this->request->data['make'];
            $model = $this->request->data['model'];
            $url = Configure::read('api.api_url') . 'api/user/getseriesbymakemodelforcarsale';
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "make" => $make,
                "model" => $model
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if (isset($result)) {
                $series = $result->series;
            }
            $ds = '';
            if (count($series) > 0) {
                $ds .= '<option value="">-- Choose a series --</option>';
                for ($i = 0; $i < sizeof($series); $i++) {
                    $ds .= '<option value="' . $series[$i] . '">' . $series[$i] . '</option>';
                }
            } else {
                $ds .= '<option value="-1">-- Not found --</option>';
            }
            $data['ds'] = $ds;
            echo $ds;
        }
    }
    //result car in car for sale
    public function resultcarsforsale() {
        //$this->set('title_for_layout', 'Cars for sale');//
        // get parameters
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : '8';
        $keyword = (isset($this->params['url']['keyword']) && $this->params['url']['keyword'] != '') ? $this->params['url']['keyword'] : '';
        $make = (isset($this->params['url']['make']) && $this->params['url']['make'] != '') ? $this->params['url']['make'] : '';
        $model = (isset($this->params['url']['model']) && $this->params['url']['model'] != '') ? $this->params['url']['model'] : '';
        $series = (isset($this->params['url']['series'])) ? $this->params['url']['series'] : '';
        $manu_year_from = (isset($this->params['url']['manu_year_from']) && $this->params['url']['manu_year_from'] != '') ? $this->params['url']['manu_year_from'] : '';
        $manu_year_to = (isset($this->params['url']['manu_year_to']) && $this->params['url']['manu_year_to'] != '') ? $this->params['url']['manu_year_to'] : '';
        $gearbox = (isset($this->params['url']['gearbox']) && $this->params['url']['gearbox'] != '') ? $this->params['url']['gearbox'] : '';
        $body_colour = (isset($this->params['url']['body_colour']) && $this->params['url']['body_colour'] != '') ? $this->params['url']['body_colour'] : '';
        $body = (isset($this->params['url']['body']) && $this->params['url']['body'] != '') ? $this->params['url']['body'] : '';
        $price_from = (isset($this->params['url']['price_from']) && $this->params['url']['price_from'] != '') ? $this->params['url']['price_from'] : '';
        $price_to = (isset($this->params['url']['price_to']) && $this->params['url']['price_to'] != '') ? $this->params['url']['price_to'] : '';
        $odometer_from = (isset($this->params['url']['odometer_from']) && $this->params['url']['odometer_from'] != '') ? $this->params['url']['odometer_from'] : '';
        $odometer_to = (isset($this->params['url']['odometer_to']) && $this->params['url']['odometer_to'] != '') ? $this->params['url']['odometer_to'] : '';
        $location = (isset($this->params['url']['location']) && $this->params['url']['location'] != '') ? $this->params['url']['location'] : '';
        $postcode = (isset($this->params['url']['postcode']) && $this->params['url']['postcode'] != '') ? $this->params['url']['postcode'] : '';
        $distance = (isset($this->params['url']['distance']) && $this->params['url']['distance'] != '') ? $this->params['url']['distance'] : '';
        $drive = (isset($this->params['url']['drive']) && $this->params['url']['drive'] != '') ? $this->params['url']['drive'] : '';
        $fuel_type = (isset($this->params['url']['fuel_type']) && $this->params['url']['fuel_type'] != '') ? $this->params['url']['fuel_type'] : '';
        $seats = (isset($this->params['url']['seats']) && $this->params['url']['seats'] != '') ? $this->params['url']['seats'] : '';
        
        $post_code = (isset($this->params['url']['post_code']) && $this->params['url']['post_code'] != '') ? $this->params['url']['post_code'] : '';
        $engine_capacity = (isset($this->params['url']['engine_capacity']) && $this->params['url']['engine_capacity'] != '') ? $this->params['url']['engine_capacity'] : '';
        $cylinders = (isset($this->params['url']['cylinders']) && $this->params['url']['cylinders'] != '') ? $this->params['url']['cylinders'] : '';
        $gears = (isset($this->params['url']['gears']) && $this->params['url']['gears'] != '') ? $this->params['url']['gears'] : '';
        $doors = (isset($this->params['url']['doors']) && $this->params['url']['doors'] != '') ? $this->params['url']['doors'] : '';

        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // call api search car
        $url = Configure::read('api.api_url') . 'api/user/searchcarnewversion';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body_search = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "keyword" => ($keyword != '') ? $keyword : '',
            "make" => ($make != '') ? $make : '',
            "series" => ($series != '') ? $series : '',
            "model" => ($model != '') ? $model : '',
            "tranmission" => ($gearbox != '') ? $gearbox : '',
            "body_colour" => ($body_colour != '') ? $body_colour : '',
            "body" => ($body != '') ? $body : '',
            "location" => ($location != '') ? $location : '',
            "drive_type" => ($drive != '') ? $drive : '',
            "fuel_type" => ($fuel_type != '') ? $fuel_type : '',
            "seats" => ($seats != '') ? $seats : '',
            "price_from" => ($price_from != '') ? $price_from : '',
            "price_to" => ($price_to != '') ? $price_to : '',
            "kilometer_from" => ($odometer_from != '') ? $odometer_from : '',
            "kilometer_to" => ($odometer_to != '') ? $odometer_to : '',
            "year_from" => ($manu_year_from != '') ? $manu_year_from : '',
            "year_to" => ($manu_year_to != '') ? $manu_year_to : '',
            "post_code" => $post_code,
            "cylinders" => $cylinders,
            "doors" => $doors,
            "capacity" => $engine_capacity,
            "gears" => $gears,
            "start" => $start,
            "limit" => $limit,
            "type" => $sort,
            "total" => 1
        );
        $result_api = json_decode($this->CurlApi->to($url)->withData(json_encode($body_search))->withOption('HTTPHEADER', $header)->post());
        if ($result_api != null) {
            if ($result_api->cars != null) {
                $list = $result_api->cars;
                $total = $result_api->total;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = '';
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $list = '';
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact('list', 'total', 'limit', 'maxpages', 'sort', 'keyword', 'make', 'model', 'series', 'manu_year_from', 'manu_year_to', 'gearbox', 'body_colour', 'body', 'price_from', 'price_to', 'odometer_from', 'odometer_to', 'location', 'postcode', 'distance', 'drive', 'fuel_type', 'seats'));
        
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Cars For Sale');
            $this->set('breadcrumb', [
                (object) ['title' => 'Home'], 
                (object) ['title' => 'Cars For Sale', 'active' => true]
            ]);
            $this->layout = 'cz_home';
            $this->render('resultcarsforsale');
        } else {
            $this->layout = null;
            $this->render('resultcarsforsale_ajax');
        }
    }
    //set for get
    public function set_forget() {
        $this->set('title_for_layout', 'Set a Search');
        $this->layout = 'cz_home';
        
        // get price list
        $this->user_id = $this->Session->read('Auth.User.id');
        $result2 = $this->ResultDatasearch();
        if ($result2 != null) {
            foreach ($result2[0] as $rs) {
                if ($rs->field_name == 'price_from') { $price_from = $rs->values;}
                if ($rs->field_name == 'price_to') { $price_to = $rs->values;}
            }
        }
        // get year list
        $manu_year_from = $this->getyearlist();
        $manu_year_to = $manu_year_from;
        
        // get customers
        $url = Configure::read('api.api_url') . 'api/user/getcustomer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'limit' => 200,
            'start' => 0
        );
        $result_customer = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        $customers = (isset($result_customer)) ? $result_customer->customers : '';
        
        // get my networks
        $url_network = Configure::read('api.api_url') . 'api/user/getmynetwork';
        $body_network = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => '',
            'type' => 1,
            'start' => 0,
            'limit' => 100,
             'total' => 1
        );
        $result_network = json_decode($this->CurlApi->to($url_network)->withData(json_encode($body_network))->withOption('HTTPHEADER', $header)->post());
        $mynetwork = (isset($result_network)) ? $result_network->networks : '';
        //debug($result_network);
        //debug($mynetwork);
        //die();
        
        //get recommend cars
        $url1 = Configure::read('api.api_url') . 'api/user/getflicarrloadmorenewversionnorandom';
        $body_api = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'type' => 0,
            'start' => 0,
            'limit' => 5
        );
        $result = json_decode($this->CurlApi->to($url1)->withData(json_encode($body_api))->withOption('HTTPHEADER', $header)->post());
        if ($result != null) {
            $cars = $result->cars;
        } else {
            $cars = '';
        }
        
        $this->set(compact('price_from', 'price_to', 'manu_year_from', 'manu_year_to', 'makes', 'cars', 'customers', 'mynetwork'));
    }
    //get list year
    public function getyearlist() {
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistofyears?type_code=A';
        $result = json_decode($this->CurlApi->to($url)->get());
        if ($result && isset($result->list_year) && $result->list_year) {
            return $result->list_year;
        }
        return null;
    }
    //change make series
    public function change_make_Series() {
        $this->autoRender = false;
        if ($this->request->data) {
            $sURL = "http://ppsr.identicar.com.au/api/search/make/" . $this->request->data['make'];
            $aHTTP['http']['method'] = 'POST';
            $aHTTP['http']['header'] = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
            $aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
            $context = stream_context_create($aHTTP);
            $contents = file_get_contents($sURL, false, $context);
            $contents = json_decode($contents);
            $models = $contents->results;
            $ds = '';
            if (count($models) > 0) {
                $ds .= '<option value="" style="display:none">---Choose a model---</option>';
                for ($j = 0; $j < sizeof($models) - 1; $j++) {
                    $v = $models[$j]->name;
                    $k = $models[$j + 1]->name;
                    if ($v != $k) {
                        $ds .= '<option value="' . $models[$j]->name . '">' . $models[$j]->name . '</option>';
                    }
                }
            } else {
                $ds .= '<option value="" style="display:none">---Not found---</option>';
            }
            $data['ds'] = $ds;
            echo $ds;
        }
    }
    //change series model
    public function change_Series_Model() {
        $this->autoRender = false;
        if ($this->request->data) {
            $sURL = "http://ppsr.identicar.com.au/api/search/make/" . $this->request->data['make'];
            $aHTTP['http']['method'] = 'POST';
            $aHTTP['http']['header'] = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
            $aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
            $context = stream_context_create($aHTTP);
            $contents = file_get_contents($sURL, false, $context);
            $contents = json_decode($contents);
            $series = $contents->results;
            $ds = '';
            if (count($series) > 0) {
                $ds .= '<option value="">Series: Any Series</option>';
                for ($i = 0; $i < sizeof($series); $i++) {
                    $rs = $series[$i]->models;
                    $ds .= '<option value="' . $rs[$i]->name . '">' . $rs[$i]->name . '</option>';
                }
            } else {
                $ds .= '<option value="">---Not found---</option>';
            }
            $data['ds'] = $ds;
            echo $ds;
        }
    }
    //get set forget
    public function get_setforget() {
        // get parameters
        $this->user_id = $this->Session->read('Auth.User._id');
        $option = (isset($this->params['url']['option']) && $this->params['url']['option'] != '') ? $this->params['url']['option'] : '';
        $keyword = (isset($this->params['url']['keyword']) && $this->params['url']['keyword'] != '') ? $this->params['url']['keyword'] : '';
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : '8';
        $make = (isset($this->params['url']['make'])) ? $this->params['url']['make'] : '';
        $model = (isset($this->params['url']['model'])) ? $this->params['url']['model'] : '';
        $variant = (isset($this->params['url']['variant'])) ? $this->params['url']['variant'] : '';
        $series = (isset($this->params['url']['series'])) ? $this->params['url']['series'] : '';
        $makeCode = (isset($this->params['url']['make_code'])) ? $this->params['url']['make_code'] : '';
        $modelCode = (isset($this->params['url']['model_code'])) ? $this->params['url']['model_code'] : '';
        $seriesCode = (isset($this->params['url']['series_code'])) ? $this->params['url']['series_code'] : '';
        $manu_year_from = (isset($this->params['url']['manu_year_from'])) ? $this->params['url']['manu_year_from'] : '';
        $manu_year_to = (isset($this->params['url']['manu_year_to'])) ? $this->params['url']['manu_year_to'] : '';
        $price_from = (isset($this->params['url']['price_from'])) ? $this->params['url']['price_from'] : '';
        $price_to = (isset($this->params['url']['price_to'])) ? $this->params['url']['price_to'] : '';
        $arr_mynetwork = (isset($this->params['url']['arr_mynetwork']) && $this->params['url']['arr_mynetwork'] != '') ? explode('|', $this->params['url']['arr_mynetwork']) : '';
        $mynetwork = array();
        if ($arr_mynetwork != '') {
            foreach ($arr_mynetwork as $k => $v) {
                if ($v != '') {
                    $mynetwork[] = $v;
                }
            }
        }
        $gearbox = (isset($this->params['url']['gearbox'])) ? $this->params['url']['gearbox'] : '';
        $body_colour = (isset($this->params['url']['body_colour'])) ? $this->params['url']['body_colour'] : '';
        $body = (isset($this->params['url']['body'])) ? $this->params['url']['body'] : '';
        $odometer_from = (isset($this->params['url']['odometer_from'])) ? $this->params['url']['odometer_from'] : '';
        $odometer_to = (isset($this->params['url']['odometer_to'])) ? $this->params['url']['odometer_to'] : '';
        $location = (isset($this->params['url']['location'])) ? $this->params['url']['location'] : '';
        $drive = (isset($this->params['url']['drive'])) ? $this->params['url']['drive'] : '';
        $fuel_type = (isset($this->params['url']['fuel_type'])) ? $this->params['url']['fuel_type'] : '';
        $seats = (isset($this->params['url']['seats'])) ? $this->params['url']['seats'] : '';
        
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        // call api save set & forget
        if ($option == 1) {
            $url_setforget = Configure::read('api.api_url') . 'api/user/setandforget';
            if ($keyword) {
                $search_params['keyword'] = $keyword;
            }
            if ($make) {
                $search_params['make'] = $make;
            }
            if ($model) {
                $search_params['model'] = $model;
            }
            if ($series) {
                $search_params['series'] = $series;
            }
            if ($manu_year_from) {
                $search_params['manu_year_from'] = $manu_year_from;
            }
            if ($manu_year_to) {
                $search_params['manu_year_to'] = $manu_year_to;
            }
            if ($price_from) {
                $search_params['price_from'] = $price_from;
            }
            if ($price_to) {
                $search_params['price_to'] = $price_to;
            }
            
            $code_params['keyword'] = $keyword;
            $code_params['make'] = $makeCode;
            $code_params['model'] = $modelCode;
            $code_params['variant'] = $variant;
            $code_params['series'] = $seriesCode;
            $code_params['manu_year_from'] = $manu_year_from;
            $code_params['manu_year_to'] = $manu_year_to;
            $code_params['price_from'] = $price_from;
            $code_params['price_to'] = $price_to;
            
            $body_setforget = array(
                "search_params" => $search_params,
                "code_search" => $code_params,
                "user_id" => CakeSession::read('Auth.User._id'),
                "customer_id" => $this->params['url']['customer_id'],
                "arr_share_dealer" => $mynetwork
            );//debug($body_setforget); die();
            $result_setforget = json_decode($this->CurlApi->to($url_setforget)->withData(json_encode($body_setforget))->withOption('HTTPHEADER', $header)->post());
            
            if (isset($result_setforget->status) && $result_setforget->status  == 'success') {
                $this->Session->setFlash('Created successfully!', 'flash_custom', array('type'=>0));
            }
            else {
                $this->Session->setFlash('Created not successfully!', 'flash_custom', array('type'=>1));
            }
        }
        // call api search
        $url_search = Configure::read('api.api_url') . 'api/user/searchcarnewversion';
        
        $body_search = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "keyword" => ($keyword != '') ? $keyword : '',
            "make" => ($make != '') ? $make : '',
            "series" => ($series != '') ? $series : '',
            "model" => ($model != '') ? $model : '',
            "tranmission" => ($gearbox != '') ? $gearbox : '',
            "body_colour" => ($body_colour != '') ? $body_colour : '',
            "body" => ($body != '') ? $body : '',
            "location" => ($location != '') ? $location : '',
            "drive_type" => ($drive != '') ? $drive : '',
            "fuel_type" => ($fuel_type != '') ? $fuel_type : '',
            "seats" => ($seats != '') ? $seats : '',
            "price_from" => ($price_from != '') ? $price_from : '',
            "price_to" => ($price_to != '') ? $price_to : '',
            "kilometer_from" => ($odometer_from != '') ? $odometer_from : '',
            "kilometer_to" => ($odometer_to != '') ? $odometer_to : '',
            "year_from" => ($manu_year_from != '') ? $manu_year_from : '',
            "year_to" => ($manu_year_to != '') ? $manu_year_to : '',
            "start" => $start,
            "limit" => $limit,
            "type" => $sort
        );
        $result_api = json_decode($this->CurlApi->to($url_search)->withData(json_encode($body_search))->withOption('HTTPHEADER', $header)->post());
        
        if ($result_api && isset($result_api->cars) && $result_api->cars != null) {
            $list = $result_api->cars;
            $total = $result_api->total_car;
            $maxpages = $this->Page($total, $limit);
        }
        else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'sort', 'limit', 'keyword', 'make', 'model', 'series', 'manu_year_from', 'manu_year_to', 'gearbox', 'body_colour', 'price_from', 'price_to', 'odometer_from', 'odometer_to', 'location', 'postcode', 'distance', 'drive', 'fuel_type', 'option', 'seats', 'body'));
    
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Set & Forget');
            $this->set('breadcrumb', [
                    (object) ['title' => 'Home'], 
                    (object) ['title' => 'Set & Forget', 'active' => true]
            ]);
            $this->layout = 'cz_home';
            
            $this->render('get_setforget');
        } else {
            $this->layout = null;
            $this->render('get_setforget_ajax');
        }
    }

    public function set_forget_manage_current() {
        $this->set('title_for_layout', 'Manage Current');
        $this->layout = 'cz_home';
        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        } else {
            $page = 0;
        }

        $url = Configure::read('api.api_url') . 'api/user/getmanagecurrent';
        $header = array(
            "sessionid:" . CakeSession::read('Auth.User.session_id'),
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "type" => 0
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        $this->set(compact('result', 'customers', 'manage_customers'));
    }
    //get set forget from flicka
    public function getsetforgetflicka() {
        $this->layout = 'home';
        $this->set('title_for_layout', 'Set & Forget');
        $user_id = $this->params['url']['user_id'];
        $strset4get_ids = '56d8e1c315e994a4b3ef96f0,';
        $arr = explode(',', $strset4get_ids);
        foreach ($arr as $a):
            if ($a != '') {
                $arr_set4get_ids[] = $a;
            }
        endforeach;
        $url = Configure::read('api.api_url') . 'api/user/getset4getofflicka';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => $user_id,
            "set4get_ids" => $arr_set4get_ids
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            $list = $result->set4get;
        } else {
            $list = null;
        }
        $this->set(compact('list'));
    }
    //delete set and forget
    public function deleteSetandForget() {
        $this->autoRender = FALSE;
        if ($this->request->data) {
            $setforgetid = $this->request->data['setforgetid'];
            $url = Configure::read('api.api_url') . 'api/user/deletesetandforget?manage_id=' . $setforgetid;
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
                $data['msg'] = $result->response;
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Error';
        }
        echo json_encode($data);
    }

    public function set_forget_view() {
        $helpers = array('Common');
        $this->set('title_for_layout', 'Manage Current');
        $this->set('breadcrumb', [
                (object) ['title' => 'Home'],
                (object) ['title' => 'Set & Forget'],
                (object) ['title' => 'Manage Current', 'active' => true]
        ]);
        $this->layout = 'cz_home';
        // call api
        $this->user_id = $this->Session->read('Auth.User.id');
        $url = Configure::read('api.api_url') . 'api/user/getmanagecurrent';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id'),
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "type" => 0
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        $manage_customers = array();
        foreach ($result as $rs):
            $manage_customers = array_merge($manage_customers, $rs->manage);
        endforeach;

        $this->set('manage_customers', $manage_customers);
    }

    public function set_forget_id($id = null) {
        if ($this->request->data) {//debug($this->request->data); die();
            $keyword = (isset($this->request->data['keyword']) && $this->request->data['keyword'] != '') ? trim($this->request->data['keyword']) : '';
            $make = (isset($this->request->data['make'])) ? $this->request->data['make'] : '';
            $model = (isset($this->request->data['model'])) ? $this->request->data['model'] : '';
            $variant = (isset($this->request->data['variant'])) ? $this->request->data['variant'] : '';
            $series = (isset($this->request->data['series'])) ? $this->request->data['series'] : '';
            $makeCode = (isset($this->request->data['make_code'])) ? $this->request->data['make_code'] : '';
            $modelCode = (isset($this->request->data['model_code'])) ? $this->request->data['model_code'] : '';
            $seriesCode = (isset($this->request->data['series_code'])) ? $this->request->data['series_code'] : '';
            $manu_year_from = (isset($this->request->data['manu_year_from'])) ? $this->request->data['manu_year_from'] : '';
            $manu_year_to = (isset($this->request->data['manu_year_to'])) ? $this->request->data['manu_year_to'] : '';
            $price_from = (isset($this->request->data['price_from'])) ? $this->request->data['price_from'] : '';
            $price_to = (isset($this->request->data['price_to'])) ? $this->request->data['price_to'] : '';
            $arr_mynetwork = (isset($this->request->data['arr_mynetwork']) && $this->request->data['arr_mynetwork'] != '') ? explode('|', $this->request->data['arr_mynetwork']) : '';
            $mynetwork = array();
            if ($arr_mynetwork != '') {
                foreach ($arr_mynetwork as $k => $v) {
                    if ($v != '') {
                        $mynetwork[] = $v;
                    }
                }
            }
            if ($keyword) {
                $search_params['keyword'] = $keyword;
            }
            if ($make) {
                $search_params['make'] = $make;
            }
            if ($model) {
                $search_params['model'] = $model;
            }
            if ($series) {
                $search_params['series'] = $series;
            }
            if ($manu_year_from) {
                $search_params['manu_year_from'] = $manu_year_from;
            }
            if ($manu_year_to) {
                $search_params['manu_year_to'] = $manu_year_to;
            }
            if ($price_from) {
                $search_params['price_from'] = $price_from;
            }
            if ($price_to) {
                $search_params['price_to'] = $price_to;
            }
            
            $code_params['keyword'] = $keyword;
            $code_params['make'] = $makeCode;
            $code_params['model'] = $modelCode;
            $code_params['variant'] = $variant;
            $code_params['series'] = $seriesCode;
            $code_params['manu_year_from'] = $manu_year_from;
            $code_params['manu_year_to'] = $manu_year_to;
            $code_params['price_from'] = $price_from;
            $code_params['price_to'] = $price_to;

            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $url_ud = Configure::read('api.api_url') . 'api/user/updatesetandforget';
            $body_ud = array(
                "search_params" => $search_params,
                "code_search" => $code_params,
                "manage_id" => $id,
                "customer_id" => $this->request->data['customer_id'],
                "arr_share_dealer" => $mynetwork
            );
            //debug($body_ud); die();
            $result_ud = json_decode($this->CurlApi->to($url_ud)->withData(json_encode($body_ud))->withOption('HTTPHEADER', $header)->post());
            //debug($url_ud); debug($header); debug(json_encode($body_ud)); debug($result_ud); die();
            $this->Session->setFlash(__('Updated successfully'), 'flash_custom', array('type'=>0));
            
            return $this->redirect('/set_forget_id/'.$id);
        }
        
        $this->set('title_for_layout', 'Manage Current');
        $this->layout = 'cz_home';
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getset4getbyid?set4get_id=' . $id;
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        //debug($url); debug($result); die();
        if ($result->status == 'success') {
            $rel = $result->set4get->code_search;
            $dataSet4Get = json_decode($result->set4get->search_params);
            $rel->manu_year_from = $dataSet4Get->manu_year_from;
            $rel->manu_year_to = $dataSet4Get->manu_year_to;
            $rel->keyword = isset($dataSet4Get->keyword)? $dataSet4Get->keyword : '';
            $arr_share_dealer = $result->set4get->arr_share_dealer;
            $setfirst = $result->set4get->customer_id;
        }
        // get price list
        $this->user_id = $this->Session->read('Auth.User.id');
        $result2 = $this->ResultDatasearch();
        if ($result2 != null) {
            foreach ($result2[0] as $rs) {
                if ($rs->field_name == 'price_from') { $price_from = $rs->values;}
                if ($rs->field_name == 'price_to') { $price_to = $rs->values;}
            }
        }
        // get year list
        $manu_year_from = $this->getyearlist();
        $manu_year_to = $manu_year_from;
        // get makes
        $makes = $this->getmakelistdata($rel->manu_year_from, $rel->manu_year_to);
        // get models
        $models = $this->getmodellistdata($rel->manu_year_from, $rel->manu_year_to, $rel->make);
        // get variant
        $variants = $this->getvariantlistdata($rel->manu_year_from, $rel->manu_year_to, $rel->make, $rel->model);
        // get series
        $series = null;
        if (isset($rel->variant)) {
            $series = $this->getserieslistdata($rel->manu_year_from, $rel->manu_year_to, $rel->make, $rel->model, $rel->variant);
        }
        //debug($makes); debug($models); debug($variants); debug($series); die();
        // get customer
        $url = Configure::read('api.api_url') . 'api/user/getcustomer';
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'limit' => 200,
            'start' => 0
        );
        $result_customer = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        $customers = $result_customer->customers;
        
        // get my network
        $url_network = Configure::read('api.api_url') . 'api/user/getmynetwork';
        $body_network = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => '',
            'type' => 1,
            'start' => 0,
            'limit' => 100,
            'total' => 1
        );
        $result_network = json_decode($this->CurlApi->to($url_network)->withData(json_encode($body_network))->withOption('HTTPHEADER', $header)->post());
        $mynetwork = $result_network->networks;
        
        $this->set(compact('variants', 'price_from', 'price_to', 'manu_year_from', 'manu_year_to', 'id', 'makes', 'models', 'series', 'customers', 'mynetwork', 'rel', 'setfirst', 'arr_share_dealer'));
    }
    //get data from list make
    public function getmakelistdata($yearFrom, $yearTo) {
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistofmakesyearfromto';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "type_code" => 'A',
            "year_from" => $yearFrom,
            "year_to" => $yearTo,
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result && isset($result->list_make) && count($result->list_make) > 0) {
            return $result->list_make;
        } else {
            return null;
        }
    }
    //get list model data
    public function getmodellistdata($yearFrom, $yearTo, $make) {
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistofmodelsyearfromto';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "type_code" => 'A',
            "year_from" => $yearFrom,
            "year_to" => $yearTo,
            "manufacturer_code" => $make,
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result && isset($result->list_model) && count($result->list_model) > 0) {
            return $result->list_model;
        } else {
            return null;
        }
    }
    //get list variant data
    public function getvariantlistdata($yearFrom, $yearTo, $make, $model) {
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistofvariantsyearfromto';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "type_code" => 'A',
            "year_from" => $yearFrom,
            "year_to" => $yearTo,
            "manufacturer_code" => $make,
            "family_code" => $model
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->list_variants) && count($result->list_variants) > 0) {
            return $result->list_variants;
        } else {
            return null;
        }
    }
    //get data  list series
    public function getserieslistdata($yearFrom, $yearTo, $make, $model, $variant) {
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistofseriesyearfromto';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "type_code" => 'A',
            "year_from" => $yearFrom,
            "year_to" => $yearTo,
            "manufacturer_code" => $make,
            "family_code" => $model,
            "variant_name" => $variant,
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result && isset($result->list_series) && count($result->list_series) > 0) {
            return $result->list_series;
        } else {
            return null;
        }
    }
    //get list make
    public function getListMake() {
        $urlIdenticar = 'http://ppsr.identicar.com.au/api/list/makes';
        
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n"
            )
        );

        $context = stream_context_create($opts);
        
        $data = json_decode(file_get_contents($urlIdenticar, false, $context));
        
        if ($data && isset($data->success) && $data->success && isset($data->makes) && $data->makes) {
            return $data->makes;
        }
        else {
            return array();
        }
    }
    //search from set for get
    public function set_forget_search() {
        $this->autoRender = false;
        $this->user_id = $this->Session->read('Auth.User.id');
        if ($this->request->data) {
            $key = $this->request->data['key'];
            $this->loadModel('Customer');
            $this->loadModel('Setandforget');
            $customers = $this->Customer->find('list', array('conditions' => array('Customer.user_id' => $this->user_id)));
            $ds = '';
            $arr = array();
            foreach ($customers as $k => $v):
                $arr[] = $v;
            endforeach;
            $manage_customers = $this->Setandforget->find('all', array(
                'conditions' => array(
                    'Setandforget.customer_id' => $arr,
                    'Setandforget.search_params like' => '%' . $key . '%',
                )
            ));
            if (count($manage_customers) > 0) {
                foreach ($manage_customers as $m):
                    $ds .= '<div class="row_set">';
                    $ds .= '<div class="r_customer">';
                    $ds .= '<div class="col-lg-6 col-xs-12">';
                    $ds .= '<div>';
                    $ds .= '<i class="fa fa-car"></i>';
                    $rel = json_decode($m['Setandforget']['search_params']);
                    $a = '';
                    if (isset($rel->make)) {
                        $a .= $rel->make . ' ';
                    }
                    if (isset($rel->model)) {
                        $a .= $rel->model . ' ';
                    }
                    if (isset($rel->series)) {
                        $a .= $rel->series . ' ';
                    }
                    if (isset($rel->gearbox)) {
                        $a .= $rel->gearbox . ' ';
                    }
                    $ds .= ($a != '') ? $a : 'Not set';

                    $ds .= '</div>';
                    $ds .= '<div>';
                    $ds .= '<i class="fa fa-tachometer"></i>';
                    $d = '';
                    if (isset($rel->odometer_from)) {
                        $d .= $rel->odometer_from;
                    }
                    if (isset($rel->odometer_to)) {
                        $d .= ' ' . $rel->odometer_to;
                    }
                    $ds .= ($d != '') ? $d : 'Not set';

                    $ds .= '</div>';
                    $ds .= '<div>';
                    $ds .= '<i class="fa fa-square"></i>';
                    $j = '';
                    if (isset($rel->body_colour)) {
                        $j .= $rel->body_colour;
                    }
                    $ds .= ($j != '') ? $j : 'Not set';
                    $ds .= '</div>';
                    $ds .= '</div>';
                    $ds .= '<div class="col-lg-6 col-xs-12">';
                    $ds .= '<div>';
                    $ds .= '<i class="fa fa-clock-o"></i>';
                    $ds .= ($m['Setandforget']['updated_at']) ? $m['Setandforget']['updated_at'] : 'Not set';
                    $ds .= '</div>';
                    $ds .= '<div>';
                    $ds .= '<i class="fa fa-calendar"></i>';
                    $c = '';
                    if (isset($rel->manu_year_from)) {
                        $c .= $rel->manu_year_from;
                    }
                    if (isset($rel->manu_year_to)) {
                        $c .= ' ' . $rel->manu_year_to;
                    }
                    $ds .= ($c != '') ? $c : 'Not set';
                    $ds .= '</div>';
                    $ds .= '<div>';
                    $ds .= 'A<i class="fa fa-usd"></i>';
                    $e = '';
                    if (isset($rel->price_from)) {
                        $e .= $rel->price_from;
                    }
                    if (isset($rel->price_to)) {
                        $e .= ' ' . $rel->price_to;
                    }
                    $ds .= ($e != '') ? $e : 'Not set';
                    $ds .= 'E</div>';
                    $ds .= '</div>';
                    $ds .= '<div class="col-xs-12">';
                    $ds .= '<div class="group_bt_set">';
                    $ds .= '<button type="button" class="btn btn-view">Email</button>';
                    $ds .= '<button type="button" class="btn btn-view">Chat</button>';
                    $ds .= '<button type="button" class="btn btn-view">View</button>';
                    $ds .= '</div>';
                    $ds .= '</div>';
                    $ds .= '</div>';
                    $ds .= '</div>';
                endforeach;
            } else {
                $ds .= 'Not find data';
            }


            $data['ds'] = $ds;
            echo json_encode($data);
            die();
        }
    }
    //search customer from set for get
    public function set_forget_search_customer() {
        $this->autoRender = false;
        $this->layout = null;
        $this->user_id = $this->Session->read('Auth.User.id');
        if ($this->request->data) {
            $key = $this->request->data['key'];
            $this->loadModel('Customer');
            $customers = $this->Customer->find('all', array('conditions' => array(
                    'Customer.user_id' => $this->user_id,
                    'OR' => array(
                        'Customer.full_name' => '%' . $key . '%',
                        'Customer.phone' => '%' . $key . '%',
                        'Customer.email' => '%' . $key . '%',
                    )
            )));
            $ds = '';
            if ($customers) {
                foreach ($customers as $rs):
                    $manage_customers = $this->Setandforget->find('all', array(
                        'conditions' => array(
                            'Setandforget.customer_id' => $rs['Customer']['id'],
                        )
                    ));
                    $ds .= '<div class="info_customer">';
                    $ds .= '<div class="avatar_cus">';
                    $ds .= $this->Html->image('/images/no-avatar.png');
                    $ds .= '</div>';
                    $ds .= '<ul class="info_cus">';
                    $ds .= '<li>';
                    $ds .= '<i class="fa fa-user"></i>';
                    $ds .= $rs['Customer']['full_name'];
                    $ds .= '</li>';
                    $ds .= '<li>';
                    $ds .= '<i class="fa fa-phone"></i>';
                    $ds .= $rs['Customer']['phone'];
                    $ds .= '</li>';
                    $ds .= '<li>';
                    $ds .= '<i class="fa fa-envelope-o"></i>';
                    $ds .= $rs['Customer']['email'];
                    $ds .= '</li>';
                    $ds .= '</ul>';
                    $ds .= '<div class="click_cus cus" style="display: none">';
                    foreach ($manage_customers as $m):
                        $ds .= '<div class="r_customer">';
                        $ds .= '<div class="col-lg-12">';
                        $ds .= '<i class="fa fa-car"></i>';

                        $rel = json_decode($m['Setandforget']['search_params']);
                        $a = '';
                        if (isset($rel->make)) {
                            $a .= $rel->make;
                        }
                        if (isset($rel->model)) {
                            $a .= $rel->model;
                        }
                        if (isset($rel->series)) {
                            $a .= $rel->series;
                        }
                        if (isset($rel->gearbox)) {
                            $a .= $rel->gearbox;
                        }
                        $ds .= ($a != '') ? $a : 'Not set';
                        $ds .= '</div>';
                        $ds .= '<div class="col-lg-6">';
                        $ds .= '<div>';
                        $ds .= '<i class="fa fa-clock-o"></i>';
                        $ds .= ($m['Setandforget']['updated_at']) ? $m['Setandforget']['updated_at'] : 'Not set';
                        $ds .= '</div>';
                        $ds .= '<div>';
                        $ds .= '<i class="fa fa-calendar"></i>';

                        $c = '';
                        if (isset($rel->manu_year_from)) {
                            $c .= $rel->manu_year_from;
                        }
                        if (isset($rel->manu_year_to)) {
                            $c .= ' ' . $rel->manu_year_to;
                        }
                        $ds .= ($c != '') ? $c : 'Not set';
                        $ds .= '</div>';
                        $ds .= '</div>';
                        $ds .= '<div class="col-lg-6">';
                        $ds .= '<div>';
                        $ds .= '<i class="fa fa-tachometer"></i>';

                        $d = '';
                        if (isset($rel->odometer_from)) {
                            $d .= $rel->odometer_from;
                        }
                        if (isset($rel->odometer_to)) {
                            $d .= ' ' . $rel->odometer_to;
                        }
                        $ds .= ($d != '') ? $d : 'Not set';

                        $ds .= '</div>';
                        $ds .= '<div>';
                        $ds .= 'A<i class="fa fa-usd"></i>';

                        $e = '';
                        if (isset($rel->price_from)) {
                            $e .= $rel->price_from;
                        }
                        if (isset($rel->price_to)) {
                            $e .= ' ' . $rel->price_to;
                        }
                        $ds .= ($e != '') ? $e : 'Not set';

                        $ds .= '</div>';
                        $ds .= '</div>';
                        $ds .= '</div>';
                    endforeach;
                    $ds .= '</div>';
                    $ds .= '</div>';
                endforeach;
            } else {
                $ds .= 'Not found';
            }
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }
        $data['ds'] = $ds;
        echo json_encode($data);
    }

    public function hidden_stock() {
        //soft by
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : '9';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getmystockhidecar';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "company_id" => CakeSession::read('Auth.User.company_id'),
            "start" => $start,
            "type" => $sort,
            "limit" => $limit,
            "total" => 1
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($url); debug(json_encode($body)); debug($result); die();
        if ($result != null) {
            if ($result->cars != null) {
                $list = $result->cars;
                $total = $result->total;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $total = 0;
                $maxpages = 0;
            }
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'sort')));
        
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Hidden Stock');
            $this->layout = 'cz_home';
            $this->render('hidden_stock');
        } else {
            $this->layout = null;
            $this->render('hidden_stock_ajax');
        }
    }

    public function my_stock() {
        // get parameter
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : '9';
        $filter = (isset($this->params['url']['filter'])) ? $this->params['url']['filter'] : '0';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getmystocknewversion';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "company_id" => CakeSession::read('Auth.User.company_id'),
            "start" => $start,
            "type" => $sort,
            "filter" => $filter,
            "limit" => $limit,
            "total" => 1
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($url); debug(json_encode($body)); debug($result); die();
        if ($result != null) {
            if ($result->cars != null) {
                $list = $result->cars;
                $total = $result->total;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $total = 0;
                $maxpages = 0;
            }
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'sort', 'filter')));
        
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'My Stock');
            $this->set('breadcrumb', [
                (object) ['title' => 'Home'],
                (object) ['title' => 'My Stock', 'active' => true]
            ]);
            $this->layout = 'cz_home';
            $this->render('my_stock');
        } else {
            $this->layout = null;
            $this->render('my_stock_ajax');
        }
    }
    
    public function del_stock($id = null) {
        $this->autoRender = FALSE;
        
        $url = Configure::read('api.api_url') . 'api/user/changestatuscarmystock';
        $header = array(
            'userid:' . CakeSession::read('Auth.User._id'),
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "car_id" => $id,
            "is_active" => 0
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result && isset($result->status) && $result->status == 'success') {
            $this->Session->setFlash('Deleted successfull!', 'flash_custom', array('type'=>0));
        }
        else {
            $this->Session->setFlash('Failure to delete car!', 'flash_custom', array('type'=>1));
        }
        
        return $this->redirect('/my_stock');
    }

    public function deleteMyStock() {
        $this->autoRender = FALSE;
        if ($this->request->data) {
            $id = $this->request->data['id'];
            $url = Configure::read('api.api_url') . 'api/user/changestatuscarmystock';
            $header = array(
                'userid:' . CakeSession::read('Auth.User._id'),
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "car_id" => $id,
                "is_active" => 0
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

            if ($result && isset($result->status) && $result->status == 'success') {
                $data['error'] = 0;
            }
            else {
                $data['error'] = 1;
                $data['msg'] = 'Failure';
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Failure';
        }
        echo json_encode($data);
    }
    
    public function setDisplayCar() {
        $this->autoRender = FALSE;
        if ($this->request->data) {
            $id = $this->request->data['car_id'];
            $type = $this->request->data['type'];
            
            $url = Configure::read('api.api_url') . 'api/user/changestatuscarmystock';
            $header = array(
                'userid:' . CakeSession::read('Auth.User._id'),
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "car_id" => $id,
                "is_active" => $type
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            //die(json_encode($result));
            if ($result && isset($result->status) && $result->status == 'success') {
                $data['error'] = 0;
            }
            else {
                $data['error'] = 1;
                $data['msg'] = 'Failure';
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Failure';
        }
        echo json_encode($data);
    }

    public function other_stock() {
        // get parameters
        $id = $this->params['url']['car'];
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : '1';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        
        // get car detail
        $carInfo = $this->ResultCarId($id)->car[0];
        $car = $carInfo->cars;
        $car_user = $carInfo->company_info;
        
        // get other stock
        $url = Configure::read('api.api_url') . 'api/user/getotherstocknewversion';
        $header = array(
            'userid:' . CakeSession::read('Auth.User._id'),
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "company_id" => $car_user->company_id,
            "type" => $sort,
            "start" => $start,
            "limit" => $limit
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        
        if ($result != null && $result->cars != null) {
            $list = $result->cars;
            $total = isset($result->total_car)? $result->total_car : '';
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'addnetwork', 'car', 'car_user', 'sort', 'id'));
        
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Other Stock');
            $this->layout = 'cz_home';
            $this->render('other_stock');
        } else {
            $this->layout = null;
            $this->render('other_stock_ajax');
        }
    }

    public function view_stock() {
        // get parameters
        $this->set('title_for_layout', "My Network's Stock");
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : 8;
        $make = (isset($this->params['url']['make'])) ? $this->params['url']['make'] : '';

        $ar_id = explode('|', $this->params['url']['id']);
        foreach ($ar_id as $ar) {
            if ($ar != '') {
                $arr[] = $ar;
            }
        }
        
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $url = Configure::read('api.api_url') . 'api/user/getstocknetworknewversion';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => $this->Session->read('Auth.User._id'),
            "limit" => $limit,
            "network_ids" => $arr,
            "start" => $start,
            "type" => $sort
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result != null && $result->cars != null) {
            $list = $result->cars;
            $total = isset($result->total_car) ? $result->total_car : 0;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'ar_id', 'sort'));
        
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'My Network\'s Stock');
            $this->set('breadcrumb', [
                (object) ['title' => 'Home'],
                (object) ['title' => 'My Network'],
                (object) ['title' => 'My Network\'s Stock', 'active' => true]
            ]);
            $this->layout = 'cz_home';
            $this->render('view_stock');
        } else {
            $this->layout = null;
            $this->render('view_stock_ajax');
        }
    }
    //add stock by manual
    public function add_stock_by_manual() {
        if ($this->request->data) {
            $file = array();
            if (isset($_FILES['file'])) {
                $ar_file_data = array();
                $target_path = WWW_ROOT . "datafeed/easycars/";
                for ($i = 0; $i < sizeof($_FILES['file']['name']); $i++) {
                    if ($_FILES['file']['size'][$i] > 0) {
                        $validextensions = array("jpeg", "jpg", "png");
                        $ext = explode('.', basename($_FILES['file']['name'][$i]));
                        $file_extension = end($ext);

                        if ($file_extension == "jpg") {
                            $mime = "image/jpeg";
                        } else if ($file_extension == "png") {
                            $mime = "image/png";
                        } else if ($file_extension == "gif") {
                            $mime = "image/gif";
                        }
                        $filename = time() . rand() . '.' . $file_extension;
                        move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path . $filename);

                        $ar_file_data[] = array(
                            'name' => $filename,
                            'path' => $target_path . $filename,
                            'type' => $mime
                        );
                    }
                }
                
                $file = $ar_file_data;
            }

            $url = Configure::read('api.api_url') . 'api/user/addcar';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'client_no' => CakeSession::read('Auth.User._id'),
                'company_id' => CakeSession::read('Auth.User.company_id'),
                'stock_no' => '',
                'dealer_code' => '',
                'manu_year' => $this->request->data['manu_year'],
                'make' => $this->request->data['make'],
                'model' => $this->request->data['model'],
                'variant' => $this->request->data['variant'],
                'series' => ($this->request->data['series'] != -1) ? $this->request->data['series'] : '',
                'badge' => '',
                'body' => $this->request->data['body'],
                'doors' => '',
                'notes' => $this->request->data['notes'],
                'registration_date' => $this->request->data['registration_date'],
                'seats' => $this->request->data['seats'],
                'body_colour' => $this->request->data['body_colour'],
                'trim_colour' => '',
                'gears' => '',
                'fuel_type' => $this->request->data['fuel_type'],
                'retail' => $this->request->data['retail'],
                'price' => $this->request->data['price'],
                'rego' => '',
                'odometer' => $this->request->data['odometer'],
                'cylinders' => '',
                'engine_capacity' => '',
                'vin_number' => $this->request->data['vin_number'],
                'manu_month' => '',
                'options' => '',
                'comments' => $this->request->data['comments'],
                'nvic' => '',
                'redbookcode' => '',
                'location' => $this->request->data['location'],
                'gearbox' => $this->request->data['gearbox'],
                'engine_number' => '',
                'status' => '',
                'sync' => '',
                'inventory' => '',
                'egc' => '',
                'drive_away_amount' => '',
                'is_drive_away' => '',
                'drive_type' => '',
                'video_url' => (isset($this->request->data['video_url'])) ? $this->request->data['video_url'] : ''
            );
            
            for($i = 0; $i < sizeof($file); $i++) {
                $body['images['.$i.']'] = $this->getCurlValue($file[$i]["path"], $file[$i]["type"], $file[$i]["name"]);
            }     
            //debug($body); die();
            
            $ch = curl_init();
            $options = array(CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $header,
                CURLINFO_HEADER_OUT => true, //Request header
                //CURLOPT_HEADER => true, //Return header
                CURLOPT_SSL_VERIFYPEER => false, //Don't veryify server certificate
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body
            );

            curl_setopt_array($ch, $options);
            $response = curl_exec($ch);
            $result = json_decode($response);
            curl_close($ch);
            if (isset($result->status)) {
                if ($result->status == "success") {
                    $this->Session->setFlash('Added successfully!', 'flash_custom', array('type'=>0));
                    return $this->redirect('/my_stock');
                } else {
                    $this->Session->setFlash($result->response, 'flash_custom', array('type'=>1));
                }
            } else {
                $this->Session->setFlash('Sent not successfully', 'flash_custom', array('type'=>1));
            }
            return $this->redirect('/add_stock_by_manual');
        }
        else {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Add Stock By Manual');
            $this->layout = 'cz_home';
            
            $this->user_id = $this->Session->read('Auth.User._id');
            $result2 = $this->ResultDatasearch();
            foreach ($result2[0] as $rs) {
                if ($rs->field_name == 'gearbox') { $gearboxs = $rs->values;}
                if ($rs->field_name == 'body_colour') { $colos = $rs->values;}
                if ($rs->field_name == 'body') { $bodys = $rs->values;}
                if ($rs->field_name == 'fuel_type') { $fuel_types = $rs->values;}
                if ($rs->field_name == 'seats') { $seats = $rs->values;}
                if ($rs->field_name == 'doors') { $doors = $rs->values;}
                if ($rs->field_name == 'post_code') { $post_codes = $rs->values;}
                if ($rs->field_name == 'location') { $locations = $rs->values;}
                if ($rs->field_name == 'odometer_from') { $odometer_from = $rs->values;}
                if ($rs->field_name == 'odometer_to') { $odometer_to = $rs->values;}
                if ($rs->field_name == 'price_from') { $price_from = $rs->values;}
                if ($rs->field_name == 'price_to') { $price_to = $rs->values;}
                if ($rs->field_name == 'engine_capacity') { $engine_capacity = $rs->values;}
                if ($rs->field_name == 'cylinders') { $cylinders = $rs->values;}
                if ($rs->field_name == 'gears') { $gears = $rs->values;}
            }
            // get year list
            $years = $this->getyearlist();
        
            $this->set(compact('years', 'doors', 'colos', 'gearboxs', 'bodys', 'locations', 'fuel_types', 'seats'));
        }
    }
    //add stock by vin
    public function add_stock_by_vin() {
        $helpers = array('Common');
        $this->set('title_for_layout', 'Add Stock By VIN');
        $this->set('breadcrumb', [
            (object) ['title' => 'Home'],
            (object) ['title' => 'My Stock'],
            (object) ['title' => 'Add Stock', 'active' => true]
        ]);
        $this->layout = 'cz_home';

        $this->user_id = $this->Session->read('Auth.User._id');
        $result2 = $this->ResultDatasearch();
        foreach ($result2[0] as $rs) {
            if ($rs->field_name == 'gearbox') { $gearboxs = $rs->values;}
            if ($rs->field_name == 'body_colour') { $colos = $rs->values;}
            if ($rs->field_name == 'body') { $bodys = $rs->values;}
            if ($rs->field_name == 'fuel_type') { $fuel_types = $rs->values;}
            if ($rs->field_name == 'seats') { $seats = $rs->values;}
            if ($rs->field_name == 'doors') { $doors = $rs->values;}
            if ($rs->field_name == 'post_code') { $post_codes = $rs->values;}
            if ($rs->field_name == 'location') { $locations = $rs->values;}
            if ($rs->field_name == 'manu_year_from') { $manu_year_from = $rs->values;}
            if ($rs->field_name == 'manu_year_to') { $manu_year_to = $rs->values;}
            if ($rs->field_name == 'odometer_from') { $odometer_from = $rs->values;}
            if ($rs->field_name == 'odometer_to') { $odometer_to = $rs->values;}
            if ($rs->field_name == 'price_from') { $price_from = $rs->values;}
            if ($rs->field_name == 'price_to') { $price_to = $rs->values;}
            if ($rs->field_name == 'engine_capacity') { $engine_capacity = $rs->values;}
            if ($rs->field_name == 'cylinders') { $cylinders = $rs->values;}
            if ($rs->field_name == 'gears') { $gears = $rs->values;}
        }
        // get year list
        $years = $this->getyearlist();
        
        $this->set(compact('years', 'doors', 'colos', 'gearboxs', 'bodys', 'locations', 'fuel_types', 'seats'));
    }
    //Analysis
    public function analysis() {
        // get parameter
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : '9';
        $filter = (isset($this->params['url']['filter'])) ? $this->params['url']['filter'] : '0';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $url = Configure::read('api.api_url') . 'api/user/analysiscarsofdealership';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "company_id" => CakeSession::read('Auth.User.company_id'),
            "start" => $start,
            "type" => $sort,
            "filter" => $filter,
            "limit" => $limit,
            "total" => 1,
            "time_zones" => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        // debug($url); debug(json_encode($body)); debug($result); die();
        if ($result != null) {
            if ($result->cars != null) {
                $list = $result->cars;
                $total = $result->total;
                //debug($total);die();
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $total = 0;
                $maxpages = 0;
            }
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        //debug($maxpages);die();
        $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'sort', 'filter')));

        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Analysis');
            $this->set('breadcrumb', [
                (object) ['title' => 'Home'],
                (object) ['title' => 'Analysis', 'active' => true]
            ]);
            $this->layout = 'cz_home';
            $this->render('analysis');
        } else {
            $this->layout = null;
            $this->render('my_stock_ajax');
        }
    }
    //search vin
    public function search_vin() {
        $vin = $this->request->data['vin'];
        $year = isset($this->request->data['manu_year'])? $this->request->data['manu_year'] : '2005';
        // call api
        $url = Configure::read('api.api_url') . 'api/user/searchcarbyvin';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "retrieval_type" => 'DRDT_0002',
            "vin_number" => $vin,
            "year" => $year
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //echo json_encode($result); die();
        if ($result && isset($result->status) && $result->status == "success" && isset($result->list_search[0])) {
            $data = $result->list_search[0];
        }
        else {
            $data = null;
        }

        echo json_encode($data); die();
    }
    //Reject offer
    public function rejectOfferAjax() {
        $this->autoRender = false;
        $this->layout = null;
        
        // get params
        $offerId = $this->request->data['offer_id'];
        $carId = $this->request->data['car_id'];
        $buyerId = $this->request->data['buyer_id'];
        $CompanyName =  $this->Session->read('Auth.User.company_info')->name;
        $is_zooper = $this->request->data['is_zooper'];
        // call api
        $url = Configure::read('api.api_url') . 'api/user/rejectoffer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "offer_id" => $offerId,
            "car_id" => $carId,
            "buyer_id"=>$buyerId,
            "is_custom_zooper" => $is_zooper,
            "seller_user_name"=>$CompanyName
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }
    //accept offer
    public function acceptOfferAjax() {
        $this->autoRender = false;
        $this->layout = null;
        
        // get params
        $offerId = $this->request->data['offer_id'];
        $carId = $this->request->data['car_id'];
        $BuyerId = $this->request->data['buyer_id'];
        $is_zooper = $this->request->data['is_custom_zooper'];
        $CompanyName = $this->Session->read('Auth.User.company_info')->name;
        // call api
        $url = Configure::read('api.api_url') . 'api/user/acceptoffer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => $this->Session->read('Auth.User._id'),
            "offer_id" => $offerId,
            "car_id" => $carId,
            "buyer_id"=> $BuyerId,
            "is_custom_zooper" => $is_zooper,
            "seller_user_name"=>$CompanyName
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($body);die();
        //die(json_encode($result));
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['data'] = $result;
        }
        else {
            $data['error'] = 1;
            $data['data'] = $result;
        }
        
        return json_encode($data);
    }
    //Send invitation to tender
    public function SendInvitationTenderAjax() {
        $this->autoRender = false;
        $this->layout = null;

        // get params
        $tenderId = $this->request->data['tender_id'];
        $CompanyId= $this->Session->read('Auth.User.company_id') ;
        // call api
        $url = Configure::read('api.api_url') . 'api/user/sendinvitetenderfordealer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "tender_id" => $tenderId,
            "company_id"=>$CompanyId
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        debug($result);die();
        if ($result && isset($result->status) && $result->status == 'success'){
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    public function StartTenderAjax() {
        $this->autoRender = false;
        $this->layout = null;

        // get params
        $tenderId = $this->request->data['tender_id'];
        $CompanyId= $this->Session->read('Auth.User.company_id') ;
        // call api
        $url = Configure::read('api.api_url') . 'api/user/startorstoptender';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "tender_id" => $tenderId,
            "company_id"=>$CompanyId,
            "start_tender"=>1
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    public function StopTenderAjax() {
        $this->autoRender = false;
        $this->layout = null;

        // get params
        $tenderId = $this->request->data['tender_id'];
        $CompanyId= $this->Session->read('Auth.User.company_id') ;
        // call api
        $url = Configure::read('api.api_url') . 'api/user/startorstoptender';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "tender_id" => $tenderId,
            "company_id"=>$CompanyId,
            "start_tender"=>2
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result);die();
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }
     //function cancel accept offer
    public function cancelAcceptOfferAjax() {
        $this->autoRender = false;
        $this->layout = null;
        
        // get params
        $offerId = $this->request->data['offer_id'];
        $carId = $this->request->data['car_id'];
        $buyerId = $this->request->data['buyer_id'];
        $is_zooper = $this->request->data['is_zooper'];
        $CompanyName = $this->Session->read('Auth.User.company_info')->name;
        // call api
        $url = Configure::read('api.api_url') . 'api/user/cancelacceptoffer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "company_id" => $this->Session->read('Auth.User.company_id'),
            "user_id" => $this->Session->read('Auth.User._id'),
            "offer_id" => $offerId,
            "car_id" => $carId,
            "buyer_id"=>$buyerId,
            "seller_user_name"=>$CompanyName,
            "is_custom_zooper" => $is_zooper
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }

    public function DeleteCarOfTenderAjax() {
        $this->autoRender = false;
        $this->layout = null;

        // get params
        $tenderId = $this->request->data['tender_id'];
        $carId = $this->request->data['car_id'];

        // call api
        $url = Configure::read('api.api_url') . 'api/user/removecarordealerintotender';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "tender_id" => $tenderId,
            "car_id" => $carId,
        );
         
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }
    
    public function deleteOfferAjax() {
        $this->autoRender = false;
        $this->layout = null;
        
        // get params
        $offerId = $this->request->data['offer_id'];
        // call api
        $url = Configure::read('api.api_url') . 'api/user/removeoffer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "offer_id" => $offerId,
            "user_id" => $this->Session->read('Auth.User._id')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($body);debug($result);die();
        //die(json_encode($result));
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['data'] = $result;
        }
        else {
            $data['error'] = 1;
            $data['data'] = $result;
        }
        
        return json_encode($data);
    }

    public function listofferbuying() {
        // get params
        $filter = isset($this->params['url']['filter']) ? $this->params['url']['filter'] : 0; // 0 - all; 1 - from car; 2 - from tender
        $carId = (isset($this->params['url']['car_id']) && $this->params['url']['car_id'])? $this->params['url']['car_id'] : '';
        $companyId = (isset($this->params['url']['company_id']) && $this->params['url']['company_id'])? $this->params['url']['company_id'] : '';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistofferbuyingofcar';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "company_id" => $this->Session->read('Auth.User.company_id'),
            "user_id" => $this->Session->read('Auth.User._id'),
            "car_id" => $carId,
            "filter" => $filter,
            "limit" => $limit,
            "start" => $start,
            "time_zones" => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->list_dealer) && $result->list_dealer) {
            $list = $result->list_dealer;
            $is_show_submit = $result->is_show_submit;
            $total = isset($result->total)? $result->total : 0;
            $maxpages = $this->Page($total, $limit);
            $showsendoffer = $result->is_show_submit;
        }
        else {
            $list = null;
            $total = 0;
            $maxpages = 0;
            $showsendoffer = false;
            $is_show_submit = true;
        }
        
        if ($ajax == 0) {
            // get car info
            $carInfo = $this->ResultCarId($carId);
            if (isset($carInfo->car[0])) {
                $car = $carInfo->car[0];
                $custom_zooper = $carInfo->car[0]->custom_zooper;
                $price = $carInfo->car[0]->cars->price;
            }
            else {
                $car = null;
            }
            $this->set(compact(array('is_show_submit','list', 'total', 'maxpages', 'limit', 'page', 'showsendoffer', 'carId', 'companyId', 'filter', 'car','custom_zooper','price')));
            
            $helpers = array('Common');
            $this->set('title_for_layout', 'Buying Offers');
            $this->layout = 'cz_home';
            $this->render('listofferbuying');
        } else {
            $this->set(compact(array('is_show_submit','list', 'total', 'maxpages', 'limit', 'page', 'showsendoffer', 'carId', 'companyId', 'filter')));
            
            $this->layout = null;
            $this->render('listofferbuying_ajax');
        }
    }
    //List offer buying view from tender
    public function listofferbuyingviewtender() {
        // get params
        $filter = isset($this->params['url']['filter']) ? $this->params['url']['filter'] : 0; // 0 - all; 1 - from car; 2 - from tender
        $carId = (isset($this->params['url']['car_id']) && $this->params['url']['car_id'])? $this->params['url']['car_id'] : '';
        $companyId = (isset($this->params['url']['company_id']) && $this->params['url']['company_id'])? $this->params['url']['company_id'] : '';
        $TenderId = (isset($this->params['url']['tender_id']) && $this->params['url']['tender_id'])? $this->params['url']['tender_id'] : '';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistofferbuyingofcar';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "car_id" => $carId,
            "user_id" => $this->Session->read('Auth.User._id'),
            "limit" => $limit,
            "start" => $start,
            "time_zones" => CakeSession::read('time_zones'),
            "filter"=>$filter,
            "tender_id"=>$TenderId,
            "company_id"=>$companyId
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result && isset($result->list_dealer) && $result->list_dealer) {
            $list = $result->list_dealer;
            $total = isset($result->total)? $result->total : 0;
            $tender_info = $result->tender_info;
            $maxpages = $this->Page($total, $limit);
            $showsendoffer = $result->is_show_submit;
        }
        else {
            $list = null;
            $total = 0;
            $maxpages = 0;
            $tender_info = null;
            $showsendoffer = false;
        }

        $this->set(compact(array('tender_info','list', 'total', 'maxpages', 'limit', 'page', 'showsendoffer', 'carId', 'companyId','filter')));
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Tender Offers');
            $this->layout = 'cz_home';
            $this->render('listofferbuyingviewtender');
        } else {
            $this->layout = null;
            $this->render('listofferbuyingviewtender_ajax');
        }
    }

    public function listdealersentoffer() {
        // get params
        $carId = (isset($this->params['url']['car_id']) && $this->params['url']['car_id'])? $this->params['url']['car_id'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'])? $this->params['url']['sort'] : 0;
        $filter = (isset($this->params['url']['filter']) && $this->params['url']['filter'])? $this->params['url']['filter'] : 0;
        
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 15;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistdealersentoffer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "company_id" => $this->Session->read('Auth.User.company_id'),
            "user_id" => $this->Session->read('Auth.User._id'),
            "car_id" => $carId,
            "sort" => $sort,
            "filter" => $filter,
            "limit" => $limit,
            "start" => $start,
            "time_zones" => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
       // debug($result);die();
        if ($result && isset($result->list_dealer) && $result->list_dealer) {
            $list = $result->list_dealer;
            $total = isset($result->total)? $result->total : 0;
            $maxpages = $this->Page($total, $limit);
        }
        else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        if ($ajax == 0) {
            // get car info
            $carInfo = $this->ResultCarId($carId);
            if (isset($carInfo->car[0])) {
                $car = $carInfo->car[0];
            }
            else {
                $car = null;
            }
            $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'carId', 'filter', 'sort', 'car')));
            
            $this->helpers = array('Common');
            $this->set('title_for_layout', 'Selling Offers');
            $this->layout = 'cz_home';
            $this->render('listdealersentoffer');
        } else {
            $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'carId', 'filter', 'sort', 'car')));
            $this->layout = null;
            $this->render('listdealersentoffer_ajax');
        }
    }

    public function listdealersentofferviewtender() {
        // get params
        $carId = (isset($this->params['url']['car_id']) && $this->params['url']['car_id'])? $this->params['url']['car_id'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'])? $this->params['url']['sort'] : 0;
        $filter = (isset($this->params['url']['filter']) && $this->params['url']['filter'])? $this->params['url']['filter'] : 0;
        $TenderId = (isset($this->params['url']['tender_id']) && $this->params['url']['tender_id'])? $this->params['url']['tender_id'] : 0;
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistdealersentoffer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "car_id" => $carId,
            "sort" => $sort,
            "filter" => $filter,
            "limit" => $limit,
            "start" => $start,
            "time_zones" => CakeSession::read('time_zones'),
            "tender_id"=>$TenderId,
            "user_id" => $this->Session->read('Auth.User._id'),
            "company_id"=>CakeSession::read('Auth.User.company_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->list_dealer) && $result->list_dealer) {
            $list = $result->list_dealer;
            $tender_info = $result->tender_info;
            $total = isset($result->total)? $result->total : 0;
            $maxpages = $this->Page($total, $limit);
        }
        else {
            $list = null;
            $tender_info = null;
            $total = 0;
            $maxpages = 0;
        }
        $this->set(compact(array('tender_info','list', 'total', 'maxpages', 'limit', 'page', 'carId', 'filter', 'sort')));
        if ($ajax == 0) {
            $this->helpers = array('Common');
            $this->set('title_for_layout', 'Tender Offers');
            $this->layout = 'cz_home';
            $this->render('listdealersentofferviewtender');
        } else {
            $this->layout = null;
            $this->render('listdealersentofferviewtender_ajax');
        }
    }

    public function offerboard() {
        // get parameter
        $type = isset($this->params['url']['type']) ? $this->params['url']['type'] : 1; // 0 - all; 1 - buying; 2 - selling; 3 - history
        $filter = isset($this->params['url']['filter']) ? $this->params['url']['filter'] : 0; // 0 - all; 1 - from car; 2 - from tender
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistoffer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "company_id" => CakeSession::read('Auth.User.company_id'),
            "start" => $start,
            "limit" => $limit,
            "type" => $type,
            "filter" => $filter,
            "time_zones" => CakeSession::read('time_zones')
        );
        if (!$ajax) {
            $body['total'] = 1;
        }
        
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            switch ($type) {
                case 1:
                    $list =  $result->buying;
                    break;
                case 2:
                    $list =  $result->selling;
                    break;
                case 3:
                    $list =  $result->history_offer;
                    break;
                default:
                    $list =  null;
                    break;
            }
            $total = isset($result->total)? $result->total : 0;
            $maxpages = $this->Page($total, $limit);
        }
        else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'type', 'filter')));
        if ($ajax == 0) {
            $this->helpers = array('Common');
            $this->set('title_for_layout', 'Offer Board');
            $this->layout = 'cz_home';
            $this->render('offerboard');
        } else {
            $this->layout = null;
            $this->render('offerboard_ajax');
        }
    }

    public function listcaroftender() {
        // get parameter
        $tenderId = $this->params['url']['tender_id'];
        $type = isset($this->params['url']['type']) ? $this->params['url']['type'] : 1; // 1 - My Tenders; 2 - Other Tenders
        $viewBy = isset($this->params['url']['view_by']) ? $this->params['url']['view_by'] : 1; // 0 - view dealers; 1 - view cars
        
        // call api
        $url = Configure::read('api.api_url') . 'api/user/gettenderdetail';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "tender_id" =>$tenderId,
            "time_zones" => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result);die();
        if ($result && isset($result->status) && $result->status == 'success') {
            if ($viewBy == 1) {
                $list = $result->car_invitation;
                $custom_zooper = $result->car_invitation[0]->custom_zooper;
                $price = $result->car_invitation[0]->cars->price;

            }
            else {
                $list = $result->dealer_invitation;
                $custom_zooper = $result->car_invitation[0]->custom_zooper;
                $custom_zooper = $result->car_invitation[0]->cars->price;
            }
            $totalCars = sizeof($result->car_invitation);
            $totalDealers = sizeof($result->dealer_invitation);
            $inProgress = $result->tender_in_progress;
        }
        else {
            $list = null;
            $totalCars = 0;
            $totalDealers = 0;
            $inProgress = 0;
        }
        $this->set(compact(array('tenderId', 'list','totalCars','totalDealers','viewBy','type','tenderId','inProgress','custom_zooper','price')));
        
        $this->helpers = array('Common');
        $this->set('title_for_layout', 'Tender Detail');
        $this->layout = 'cz_home';
        $this->render('listcaroftender');
    }

    public function listcaroftenderajax() {
        $this->layout = null;
        $this->autoRender = false;
        // get parameter
        $tenderId = $this->params['url']['tender_id'];
        $viewBy = isset($this->params['url']['view_by']) ? $this->params['url']['view_by'] : 1; // 0 - view dealers; 1 - view cars
        
        // call api
        $url = Configure::read('api.api_url') . 'api/user/gettenderdetail';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "tender_id" =>$tenderId,
            "time_zones" => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            if ($viewBy == 1) {
                $list = $result->car_invitation;
            }
            else {
                $list = $result->dealer_invitation;
            }
        }
        else {
            $list = null;
        }
        $this->set(compact(array('tenderId', 'list')));
        
        if ($viewBy) {
            return $this->render('tender_cars_ajax');
        }
        else {
            return $this->render('tender_dealers_ajax');
        }
    }
    
    public function tenderoffer() {
        // get parameter
        $type = isset($this->params['url']['type']) ? $this->params['url']['type'] : 1; // 0 - all; 1 - buying; 2 - selling; 3 - history
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlisttender';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "start" => $start,
            "limit" => $limit,
            "type"=>$type,
            "time_zones" => CakeSession::read('time_zones')
        );
        if (!$ajax) {
            $body['total'] = 1;
        }

        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            switch ($type) {
                case 1:
                    $list =  $result->my_tender;
                    break;
                case 2:
                    $list =  $result->other_tender;
                    break;
                default:
                    $list =  null;
                    break;
            }
            $total = isset($result->total)? $result->total : 0;
            $maxpages = $this->Page($total, $limit);
            
        }
        else {
            $list = null;
            $total = 0;
            $maxpages = 0;
            $in_progress = 2;
        }
       // debug($total); die();
        $this->set(compact(array('list', 'total', 'maxpages', 'limit', 'page', 'type', 'filter')));
        if ($ajax == 0) {
            $this->helpers = array('Common');
            $this->set('title_for_layout', 'Tenders');
            $this->layout = 'cz_home';
            $this->render('tenderoffer');
        } else {
            $this->layout = null;
            $this->render('tenderoffer_ajax');
        }
    }

    public function transaction() {

        $action = (isset($this->params['url']['action'])) ? $this->params['url']['action'] : 'buy';
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : '';
        $make = (isset($this->params['url']['make'])) ? $this->params['url']['make'] : '';
        $order = array();
        if ($sort == 'features') {
            $order = 0;
            $str = 'Features';
        } else if ($sort == 'pricelow') {
            $order = 3;
            $str = 'Price (High to low)';
        } else if ($sort == 'pricehigh') {
            $order = 4;
            $str = 'Price (Low to high)';
        } else {
            $order['Car.random_code'] = 'ASC';
            $order = 0;
            $str = 'Features';
        }
        // get cars
        if (empty($this->params['url']['ajax'])) {
            $ajax = 1;
        } else {
            $ajax = 0;
        }
        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        } else {
            $page = 0;
        }
        $limit = 20;
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $url = Configure::read('api.api_url') . 'api/user/gettransactionloadmorenewversion';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        // get history 
        $body_history = array(
            "company_id" =>CakeSession::read('Auth.User.company_id'),
            "user_id" => CakeSession::read('Auth.User._id'),
            "start" => 0,
            "limit" => 20,
            "type" => 3,
            "time_zones" => '+07:00',
            "total" => 1
        );
        $result_history = json_decode($this->CurlApi->to($url)->withData(json_encode($body_history))->withOption('HTTPHEADER', $header)->post());
        if (isset($result_history) && $result_history->cars != null) {
            foreach ($result_history->cars as $rs):
                $history[] = $rs->cars;
                $view_his = $rs->views;
            endforeach;
        }else {
            $history = '';
        }
        if ($action == 'buy') {
            $this->set('title_for_layout', 'Cars buying');
            $title = 'Cars buying';
            if ($make != '') {
                $makearr = explode(',', rtrim($make, ','));
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "start" => $start,
                    "limit" => $limit,
                    "type" => 1,
                    "time_zones" => '+07:00',
                    "total" => 1,
                    "sort" => $order,
                    "makearr" => $makearr
                );
            } else {
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "start" => $start,
                    "limit" => $limit,
                    "type" => 1,
                    "time_zones" => '+07:00',
                    "total" => 1,
                    "sort" => $order
                );
            }
        } else {
            $this->set('title_for_layout', 'Cars selling');
            $title = 'Cars selling';
            if ($make != '') {
                $makearr = explode(',', rtrim($make, ','));
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "start" => $start,
                    "limit" => $limit,
                    "type" => 1,
                    "time_zones" => '+07:00',
                    "total" => 1,
                    "sort" => $order,
                    "makearr" => $makearr
                );
            } else {
                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    "start" => $start,
                    "limit" => $limit,
                    "type" => 2,
                    "time_zones" => '+07:00',
                    "total" => 1,
                    "sort" => $order
                );
            }
        }
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if (isset($result) && $result->cars != null) {
            foreach ($result->cars as $rs):
                $l[] = $rs->cars;
                $views = $rs->views;
                $users = $rs->users;
            endforeach;
            $total = $result->total;
            if (isset($l)) {
                $cars = $l;
                $maxpages = $this->Page($total, $limit);
            } else {
                $cars = '';
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $cars = '';
            $maxpages = 0;
            $total = 0;
        }
        $this->set(compact('cars', 'total', 'limit', 'maxpages', 'views', 'users', 'title', 'type', 'action', 'history', 'carmakes', 'str', 'view_his'));
        if ($ajax == 1) {
            $this->layout = 'home';
            $this->render('transaction');
        } else {
            $this->layout = null;
            $this->render('transaction_ajax');
        }
    }

    public function deleteHistory() {
        $this->autoRender = FALSE;
        $url = Configure::read('api.api_url') . 'api/user/deletehistory';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id'),
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "history_id" => $this->request->data['id']
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }
        echo json_encode($data);
    }
    //redirect customer after added successfully
    public function redirectCustomerAfterAddSuccess() {
        $this->Session->setFlash('Added successfully!', 'flash_custom', array('type'=>0));
        return $this->redirect('/customer');
    }

    public function customer() {
        $helpers = array('Common');
	$this->set('title_for_layout', 'My Customers');
	$this->set('breadcrumb', [
            (object) ['title' => 'Home'], 
            (object) ['title' => 'My Customers', 'active' => true]
	]);
	$this->layout = 'cz_home';
        
        if ($this->request->data) {
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            
            if ($this->request->data['type'] == 'add') {
                $url = Configure::read('api.api_url') . 'api/user/addcustomer';
                $result[] = array(
                    'full_name' => $this->request->data['full_name'],
                    'phone' => $this->request->data['phone'],
                    'email' => $this->request->data['email']
                );
                $body = array(
                    'user_id' => $this->Session->read('Auth.User._id'),
                    'arr_customer' => $result
                );
            }
            else {
                $url = Configure::read('api.api_url') . 'api/user/updatecustomer';
            
                $body = array(
                    'customer_id' => $this->request->data['id'],
                    'full_name' => $this->request->data['full_name'],
                    'email' => $this->request->data['email'],
                    'phone' => $this->request->data['phone']
                );
            }
            
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            
            if ($result->status == 'success') {
                $this->Session->setFlash('Successfully!', 'flash_custom', array('type'=>0));
            } else {
                $this->Session->setFlash('Failure!', 'flash_custom', array('type'=>1));
            }
        }
        
        // get search
        $keyword = isset($this->params['url']['keyword']) ? $this->params['url']['keyword'] : '';
        
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getcustomer';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'limit' => 200,
            'start' => 0
        );
        if ($keyword) {
            $body['keyword'] = $keyword;
        }
        
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result->status == 'success') {
            $list = $result->customers;
        } else {
            $list = null;
        }
        $this->set(compact('list', 'keyword'));
    }

    public function editcustomer($id = null) {
        $url_user = Configure::read('api.api_url') . 'api/user/getcustomerbyid?customer_id=' . $id;
        $rs = json_decode($this->CurlApi->to($url_user)->get())->user;

        $this->set(compact('rs'));
    }

    public function updatecustomer() {
        $this->autoRender = FALSE;
        if ($this->request->data) {
            $url = Configure::read('api.api_url') . 'api/user/updatecustomer';
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'customer_id' => $this->request->data['id'],
                'full_name' => $this->request->data['full_name'],
                'email' => $this->request->data['email'],
                'phone' => $this->request->data['phone']
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
            }
        } else {
            $data['error'] = 1;
        }
        echo json_encode($data);
    }

    public function addcustomer() {
        $this->autoRender = FALSE;
        if ($this->request->data) {
            $url = Configure::read('api.api_url') . 'api/user/addcustomer';
            $result[] = array(
                'full_name' => $this->request->data['full_name'],
                'phone' => $this->request->data['phone'],
                'email' => $this->request->data['email']
            );
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'arr_customer' => $result
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
                $data['msg'] = 'This customer has been added to your list';
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Please enter your form';
        }
        echo json_encode($data);
    }

    public function addcustomer_ajax() {
        $this->autoRender = FALSE;
        if ($this->request->data) {
            $url = Configure::read('api.api_url') . 'api/user/addcustomer';
            $result[] = array(
                'full_name' => $this->request->data['full_name'],
                'phone' => $this->request->data['phone'],
                'email' => $this->request->data['email']
            );
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'arr_customer' => $result
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $data['error'] = 0;
            } else {
                $data['error'] = 1;
                $data['msg'] = 'This customer has been added to your list';
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = 'Please choose one customer';
        }
        echo json_encode($data);
    }

    public function customer_del($id = null) {
        $this->autoRender = FALSE;
        $url = Configure::read('api.api_url') . 'api/user/deletecustomer?customer_id=' . $id;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id'),
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if ($result && $result->status && $result->status == 'success') {
            echo json_encode(['error' => 0]);
            //$this->Session->setFlash('Successfull!', 'flash_custom', array('type'=>0));
        }
        else {
            echo json_encode(['error' => 1]);
            //$this->Session->setFlash('Failure!', 'flash_custom', array('type'=>1));
        }
        
        //return $this->redirect('/customer');
    }

    public function customer_search() {
        $this->user_id = $this->Session->read('Auth.User.id');
        $this->set('title_for_layout', 'My Customer');
        $this->layout = 'home';
        $keyword = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
        $url = Configure::read('api.api_url') . 'api/user/searchcustomerdealer';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "keywords" => $keyword
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        $list = $result->dealers;
        $this->set(compact('list', 'keyword'));
    }

    public function followed() {
        // get type show: 0 - I follow; 1 - you follow
        $type_show = isset($this->params['url']['type_show']) ? $this->params['url']['type_show'] : 0;
        // get sort
        $sort = (isset($this->params['url']['sort'])) ? $this->params['url']['sort'] : '8';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : 0;
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getfollowednewversion';
        $header = array(
            'userid:' . CakeSession::read('Auth.User._id'),
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "company_id" => CakeSession::read('Auth.User.company_id'),
            "start" => $start,
            "type" => $sort,
            "type_show" => $type_show,
            "limit" => $limit,
            "total" => 1
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($url); debug($header); debug(json_encode($body)); debug($result); die();
        if ($result != null) {
            if ($type_show == 0) {
                $list = $result->i_follow;
            }
            else {
                $list = $result->you_follow;
            }
            $total = $result->total;
            //debug($total);die();
            $maxpages = $this->Page($total, $limit);
        } else {
            $total = 0;
            $list = '';
            $maxpages = 0;
        }
        $this->set(compact('list', 'total', 'limit', 'maxpages', 'page', 'type_show', 'sort'));
        
        if ($ajax == 0) {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Followed Cars');
            $this->set('breadcrumb', [
                (object) ['title' => 'Home'], 
                (object) ['title' => 'Followed Cars', 'active' => true]
            ]);
            $this->layout = 'cz_home';
            $this->render('followed');
        } else {
            $this->layout = null;
            $this->render('followed_ajax');
        }
    }

    public function follow() {
        $this->autoRender = false;
        if ($this->request->data) {
            $type = $this->request->data['type'];
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'user_id' => $this->request->data['user_id'],
                'car_id' => $this->request->data['car_id']
            );
            if ($type == 1) {
                $url = Configure::read('api.api_url') . 'api/user/unfollowcar';
                $result_device1 = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
                if ($result_device1->status == 'success') {
                    $data['error'] = 0;
                } else {
                    $data['error'] = 1;
                    $data['msg'] = "This car not exits in system. You don't follow it";
                }
            } else {
                $url = Configure::read('api.api_url') . 'api/user/followcar';
                $result_device = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
                if ($result_device->status == 'success') {
                    $data['error'] = 0;
                } else {
                    $data['error'] = 1;
                    $data['msg'] = "You don't dis-follow this car.";
                }
            }
        } else {
            $data['error'] = 1;
            $data['msg'] = "Lỗi ko có dữ liệu";
        }
        echo json_encode($data);
    }

    public function view($id = null) {
        if (!$this->Car->exists($id)) {
            throw new NotFoundException(__('Invalid car'));
        }
        $options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id));
        $this->set('car', $this->Car->find('first', $options));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Car->create();
            if ($this->Car->save($this->request->data)) {
                $this->Session->setFlash(__('The car has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The car could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        if (!$this->Car->exists($id)) {
            throw new NotFoundException(__('Invalid car'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Car->save($this->request->data)) {
                $this->Session->setFlash(__('The car has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The car could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Car.' . $this->Car->primaryKey => $id));
            $this->request->data = $this->Car->find('first', $options);
        }
    }

    public function delete() {
        $this->autoRender = false;
        $this->layout = null;
        if ($this->request->data) {
            $arr['id'] = $this->request->data['id'];
            $arr['is_active'] = 1;
            $this->Car->save($arr);
        }
    }

    public function change_transfer() {
        $this->autoRender = false;
        $this->layout = null;
        if ($this->request->data) {
            $arr['car_id'] = $this->request->data['car_id'];
            $arr['transfer_id'] = $this->Session->read('Auth.User.id');
            $arr['receiver_id'] = $this->request->data['receiver_id'];
            $this->loadModel('Transfer');
            $this->Transfer->create();
            if ($this->Transfer->save($arr)) {
                return $this->redirect('/my_stock');
            }
        }
    }

    public function pulse_report() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Post Reports');
        $title = 'Report';
        $keyword = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : "";
        $date_from = (isset($this->params['url']['date_from']) && $this->params['url']['date_from'] != '') ? date('Y-m-d 00:00:00', strtotime($this->params['url']['date_from'])) : "";
        $date_to = (isset($this->params['url']['date_to']) && $this->params['url']['date_to'] != '') ? date('Y-m-d 00:00:00', strtotime($this->params['url']['date_to'])) : "";
        $limit = (isset($this->params['url']['limit'])) ? $this->params['url']['limit'] : 20;

        if (empty($this->params['url']['ajax'])) {
            $ajax = 1;
        } else {
            $ajax = 0;
        }
        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
            $s_page = $this->params['url']['page'];
        } else {
            $page = 0;
            $s_page = 1;
        }
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $stt = $start + 1;
        $url = Configure::read('api.api_url') . 'api/user/getpulseexistreport';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "limit" => $limit,
            "start" => $start,
            "date_from" => $date_from,
            "date_to" => $date_to
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            if ($result->pulse_report != null) {
                $l = $result->pulse_report;
                $total = $result->total;
                $total_ = count($l);
                for ($i = 0; $i < $total_; $i++) {
                    $ar[] = $l[$i];
                }
                $list = $ar;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }

        $this->set(compact('list', 'maxpages', 'total', 'type', 'limit', 'title', 'keyword', 'date_from', 'date_to', 's_page', 'stt'));
    }

    public function pulse_report_detail() {
        $this->set('title_for_layout', 'Report details');
        $this->layout = 'admintrator';
        
        $id = $this->params['url']['id'];
        $keyword = (isset($this->params['url']['key']) || $this->params['url']['key'] != '')?$this->params['url']['key']:'';
        $date_from = (isset($this->params['url']['date_from']) || $this->params['url']['date_from'] != '')?$this->params['url']['date_from']:'';
        $date_to = (isset($this->params['url']['date_to']) || $this->params['url']['date_to'] != '')?$this->params['url']['date_to']:'';
        $s_page = (isset($this->params['url']['page']) || $this->params['url']['page'] != '')?$this->params['url']['page']:'';
        $limit = (isset($this->params['url']['limit']) || $this->params['url']['limit'] != '')?$this->params['url']['limit']:'';
        //Get info detail pulse
        $url_detail = Configure::read('api.api_url') . 'api/user/getpulsedetail?pulse_id=' . $id;
        
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $rs = json_decode($this->CurlApi->to($url_detail)->withOption('HTTPHEADER', $header)->get())->share_pulse;
        if ($rs->images != null) {
            $im = $rs->images;
            foreach ($im as $img):
                $images[] = $img->image_file_name;
            endforeach;
        }else {
            $images = '';
        }
        $car = ($rs->cars != null) ? $rs->cars : '';
        //Get All report
        //$limit = 10;
        if (empty($this->params['url']['ajax'])) {
            $ajax = 1;
        } else {
            $ajax = 0;
        }
        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        } else {
            $page = 0;
        }
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $url = Configure::read('api.api_url') . 'api/user/getallreportofpulse';
        $body = array(
            "pulse_id" => $id,
            "limit" => $limit,
            "start" => $start,
            'time_zones' => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            if ($result->report_of_pulse != null) {
                $l = $result->report_of_pulse;
                $total = $result->total;
                $total_ = count($l);
                for ($i = 0; $i < $total_; $i++) {
                    $ar[] = $l[$i];
                }
                $list = $ar;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }
        $this->set(compact('list', 'maxpages', 'total', 'limit', 'id', 'rs', 'car', 'images', 'keyword', 'date_from', 'date_to','s_page'));
        if ($ajax == 1) {
            $this->layout = 'admintrator';
            $this->render('pulse_report_detail');
        } else {
            $this->layout = null;
            $this->render('admin_report_pulse_ajax');
        }
    }

    public function del_pulse_report(){
        $this->autoRender = false;
        $id = $this->params['url']['id'];
        $key = $this->params['url']['key'];
        $date_from = $this->params['url']['date_from'];
        $date_to = $this->params['url']['date_to'];
        $page = $this->params['url']['page'];
        $url = Configure::read('api.api_url').'api/user/updatestatuspulse';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "pulse_id" => $id,
            "status" => 1,
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result->status == 'success'){
            $this->Session->setFlash('Deleted successfully');
        }else{
            $this->Session->setFlash('Deleted not successfully');
        }
        return $this->redirect('/pulse_report?key='.$key.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$page);
    }
    public function del_report_pulse(){
        $this->autoRender = false;
        $id = $this->params['url']['id'];
        $pulse_id = $this->params['url']['pulse_id'];
        $keyword = (isset($this->params['url']['key']) || $this->params['url']['key'] != '')?$this->params['url']['key']:'';
        $date_from = (isset($this->params['url']['date_from']) || $this->params['url']['date_from'] != '')?$this->params['url']['date_from']:'';
        $date_to = (isset($this->params['url']['date_to']) || $this->params['url']['date_to'] != '')?$this->params['url']['date_to']:'';
        $s_page = (isset($this->params['url']['page']) || $this->params['url']['page'] != '')?$this->params['url']['page']:'';
        
        $url = Configure::read('api.api_url').'api/user/updatestatusreport';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "report_id" => $id,
            "status" => 1
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        return $this->redirect('/pulse_report_detail?id='.$pulse_id.'&key='.$keyword.'&date_from='.$date_from.'&date_to='.$date_to.'&page='.$s_page);
    }
    
    function set_display_car() {
        $this->autoRender = FALSE;
        
        $no_image_showing = isset($this->request->data['no_image_showing']) ? $this->request->data['no_image_showing'] : 0;
        $no_vin_showing = isset($this->request->data['no_vin_showing']) ? $this->request->data['no_vin_showing'] : 0;
        $no_year_showing = isset($this->request->data['no_year_showing']) ? $this->request->data['no_year_showing'] : 0;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        
        $body = array(
            "image_showing" => !$no_image_showing,
            "vin_showing" => !$no_vin_showing,
            "year_showing" => !$no_year_showing
        );
        $url = Configure::read('api.api_url') . 'api/user/setviewcar';
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result->status == 'success') {
            $this->Session->setFlash('Setting was saved successfully');
        }
        else {
            $this->Session->setFlash('Failure', 'default', array('class' => 'error'));
        }
        return $this->redirect($this->referer());
    }
    
    function set_display_car_ajax() {
        $this->autoRender = FALSE;
        
        $no_image_showing = (isset($this->params['url']['no_image_showing'])) ? $this->params['url']['no_image_showing'] : 0;
        $no_vin_showing = (isset($this->params['url']['no_vin_showing'])) ? $this->params['url']['no_vin_showing'] : 0;
        
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        
        $body = array(
            "image_showing" => !$no_image_showing,
            "vin_showing" => !$no_vin_showing
        );
        
        $url = Configure::read('api.api_url') . 'api/user/setviewcar';
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }
        
        echo json_encode($data);
    }
    //List car
    function list_car() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'All Cars');
        $title = 'All Cars';
        //get parameter
        $keyword = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : "";
        $filter = (isset($this->params['url']['filter'])) ? $this->params['url']['filter'] : 0; // 0 - all; 1 - car no image; 2 - car no vin
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        // pagination
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 20;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getallcar';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "start" => $start,
            "limit" => $limit,
            "filter" => $filter,
            "type" => 0
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result && isset($result->cars) && $result->cars) {
            $list = $result->cars;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
            $showing = $result->showing;
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
            $showing = null;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'title', 'keyword', 'filter', 'showing', 'fieldsort', 'sort'));
    }
    
    function view_car($id = null) {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Car Detail');
        // call api
        $url = Configure::read('api.api_url').'api/user/getdetailofcar?car_id=' . $id;
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if($result && $result->car){
            $rs = $result->car;
        }else{
            $rs = null;
        }

        return $this->set(compact('rs', 'id'));
    }
    
    function edit_car($id = null){
        // post edit data
        if($this->request->data){
            $url_ud = Configure::read('api.api_url').'api/user/editcar';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body_ud = array(
                "car_id" => $id,
                "manu_year" => (isset($this->request->data['manu_year']))?$this->request->data['manu_year']:'',
                "make" => (isset($this->request->data['make']))?$this->request->data['make']:'',
                "model" => (isset($this->request->data['model']))?$this->request->data['model']:'',
                "series" => (isset($this->request->data['series']))?$this->request->data['series']:'',
                "badge" => (isset($this->request->data['badge']))?$this->request->data['badge']:'',
                "body" => (isset($this->request->data['body']))?$this->request->data['body']:'',
                "doors" => (isset($this->request->data['doors']))?$this->request->data['doors']:'',
                "seats" => (isset($this->request->data['seats']))?$this->request->data['seats']:'',
                "body_colour" => (isset($this->request->data['body_colour']))?$this->request->data['body_colour']:'',
                "trim_colour" => (isset($this->request->data['trim_colour']))?$this->request->data['trim_colour']:'',
                "gears" => (isset($this->request->data['gears']))?$this->request->data['gears']:'',
                "gearbox" => (isset($this->request->data['gearbox']))?$this->request->data['gearbox']:'',
                "fueltype" => (isset($this->request->data['fueltype']))?$this->request->data['fueltype']:'',
                "retail" => (isset($this->request->data['retail']))?$this->request->data['retail']:'',
                "price" => (isset($this->request->data['price']))?$this->request->data['price']:'',
                "rego" => (isset($this->request->data['rego']))?$this->request->data['rego']:'',
                "odometer" => (isset($this->request->data['odometer']))?$this->request->data['odometer']:'',
                "cylinders" => (isset($this->request->data['cylinders']))?$this->request->data['cylinders']:'',
                "engine_capacity" => (isset($this->request->data['engine_capacity']))?$this->request->data['engine_capacity']:'',
                "engineno" => (isset($this->request->data['engineno']))?$this->request->data['engineno']:'',
                "manu_month" => (isset($this->request->data['manu_month']))?$this->request->data['manu_month']:'',
                "options" => (isset($this->request->data['options']))?$this->request->data['options']:'',
                "comments" => (isset($this->request->data['comments']))?$this->request->data['comments']:'',
                "nvic" => (isset($this->request->data['nvic']))?$this->request->data['nvic']:'',
                "redbookcode" => (isset($this->request->data['redbookcode']))?$this->request->data['redbookcode']:'',
                "egc" => (isset($this->request->data['egc']))?$this->request->data['egc']:'',
                "stock_location_code" => (isset($this->request->data['stock_location_code']))?$this->request->data['stock_location_code']:'',
                "driveaway_amount" => (isset($this->request->data['driveaway_amount']))?$this->request->data['driveaway_amount']:'',
                "isdriveaway" => (isset($this->request->data['isdriveaway']))? 1 : 0,
                "regovalid" => (isset($this->request->data['regovalid']))?$this->request->data['regovalid']:'',
                "drive_type" => (isset($this->request->data['drive_type']))?$this->request->data['drive_type']:'',
                "receiveddate" => (isset($this->request->data['receiveddate']))?$this->request->data['receiveddate']:'',
                "status" => (isset($this->request->data['status']))?$this->request->data['status']:'',
                "inventory" => (isset($this->request->data['inventory']))?$this->request->data['inventory']:'',
            );
            $result_ud = json_decode($this->CurlApi->to($url_ud)->withData( json_encode($body_ud))->withOption('HTTPHEADER', $header)->post());
            if($result_ud->status == 'success') {
                $this->Session->setFlash(__('Updated successfully.'));
            } else {
                $this->Session->setFlash('Failure', 'default', array('class' => 'error'));
            }
            return $this->redirect('/list_car');
        }
        else {
            $this->layout = 'admintrator';
            $this->set('title_for_layout', 'Edit Car');
            // call api
            $url = Configure::read('api.api_url').'api/user/getdetailofcar?car_id=' . $id;
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
            //debug($result);die();
            if($result && $result->car){
                $rs = $result->car;
            }else{
                $rs = null;
            }

            return $this->set(compact('rs', 'id'));
        }
    }
    //list car analysis
    function list_car_analysis() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'All Cars in analysis');
        $title = 'All Cars in analysis';
        //get parameter
        $keyword = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : "";
        $filter = (isset($this->params['url']['filter'])) ? $this->params['url']['filter'] : 0; // 0 - all; 1 - car no image; 2 - car no vin
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        // pagination
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 20;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getallanalysiscars';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "start" => $start,
            "limit" => $limit,
            "filter" => $filter,
            "time_zones" => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result && isset($result->cars) && $result->cars) {
            $list = $result->cars;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }

        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'title', 'keyword', 'filter', 'showing', 'fieldsort', 'sort'));
    }
    //view car detail in analysis
    function view_car_analysis($id = null) {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Car Detail in analysis');
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getanalysiscardetail?car_id='.$id;
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "car_id" => $id,
            "time_zones" => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->car[0]) && $result->car[0]) {
            $buyer_info = isset($result->car[0]->type_analysis->buyer_info) ? $result->car[0]->type_analysis->buyer_info : null;
            $is_car_sold = isset($result->car[0]->type_analysis->is_car_sold) ? $result->car[0]->type_analysis->is_car_sold :null ;
            $latest_update = isset($result->car[0]->type_analysis->latest_update) ? $result->car[0]->type_analysis->latest_update : null;
            $rs = $result->car[0]->cars;
        }

        $this->set(compact('buyer_info', 'rs','is_car_sold','latest_update'));
    }

    function list_car_no_data() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Error Cars');
        $title = 'Error Cars';
        
        $keyword = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : "";
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        $limit = (isset($this->params['url']['limit'])) ? $this->params['url']['limit'] : 20;
        $type = (isset($this->params['url']['type'])) ? $this->params['url']['type'] : 0;
        
        if ($sort == 'desc') {
            $u_sort = 'asc';
        } else {
            $u_sort = 'desc';
        }
        if (empty($this->params['url']['ajax'])) {
            $ajax = 1;
        } else {
            $ajax = 0;
        }
        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
            $s_page = $this->params['url']['page'];
        } else {
            $page = 0;
            $s_page = 1;
        }
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $stt = $start + 1;
        
        $url = Configure::read('api.api_url') . 'api/user/getcarnoimageandvin';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "start" => $start,
            "limit" => $limit,
            "type" => $type
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result != null) {
            if ($result->cars != null) {
                $l = $result->cars;
                $total = $result->total;
                $total_ = count($l);
                for ($i = 0; $i < $total_; $i++) {
                    $ar[] = $l[$i];
                }
                $list = $ar;
                $showing = $result->showing;
                $maxpages = $this->Page($total, $limit);
            } else {
                $list = null;
                $showing = null;
                $maxpages = 0;
                $total = 0;
            }
        } else {
            $list = null;
            $maxpages = 0;
            $total = 0;
        }
        $this->set(compact('list', 'showing', 'maxpages', 'total', 'type', 'limit', 'title', 'keyword', 's_page', 'stt', 'fieldsort', 'u_sort', 'sort', 'type'));
    }

    //export car data
    function export_car_data(){
        $this->autoRender = FALSE;
        // get params
        $keyword = (isset($this->request->data['key']))?$this->request->data['key'] : '';
        $filter = (isset($this->request->data['filter']))?$this->request->data['filter'] : 0;
        $index = (isset($this->request->data['id']))?$this->request->data['id'] : 0;
        $limit = 500;
        $start = ($index - 1) * $limit;
        // call api
        $url = Configure::read('api.api_url').'api/user/exportcarerror';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "start" => $start,
            "limit" => $limit,
            "filter" => $filter,
            "type" => 0
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result && isset($result->url_excel) && $result->url_excel){
            $data['error'] = 0;
            $data['id'] = $index;
            $data['link'] = $result->url_excel;
        }else{
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }
    //detail car in action page
    public function car_detail_action_page() {
        // get params
        $companyId = isset($this->params['url']['company_id'])? $this->params['url']['company_id'] : '';
        $carId = isset($this->params['url']['car_id'])? $this->params['url']['car_id'] : '';
        $openfrom = isset($this->params['url']['openfrom'])? $this->params['url']['openfrom'] : '';
        $keyword = isset($this->params['url']['keyword'])? $this->params['url']['keyword'] : '';
        $rsInfo = $this->ResultCarId($carId);
        $car = isset($rsInfo->car[0]->cars)? $rsInfo->car[0]->cars : null;
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 6;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);

        //call api get user in mynetwork
        $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ? $this->params['url']['key'] : '';
        // get ajax
        $ajax = isset($this->params['url']['ajax']) ? $this->params['url']['ajax'] : '';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 12;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        $url_mynetwork = Configure::read('api.api_url').'api/user/getmynetwork';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body_mynetwork = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => $key,
            'type' => 1,
            'limit' => $limit,
            'start' => $start,
            'total' => 1
        );
        $result_mynetwork = json_decode($this->CurlApi->to($url_mynetwork)->withData( json_encode($body_mynetwork))->withOption('HTTPHEADER', $header)->post());
        if ($result_mynetwork && isset($result_mynetwork->status) && $result_mynetwork->status == 'success' ) {
            $list_mynetwork = $result_mynetwork->networks;
        }
        else {
            $list = null;
        }

        // call api
        $url = Configure::read('api.api_url') . 'api/user/getusersofcompany';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "company_id" => $companyId,
            "limit" => $limit,
            "start" => $start,
            "sort" => 1,
            "keyword" => $keyword
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result && $result->status == "success" && isset($result->user_company) && $result->user_company){
            $list = $result->user_company;
            //debug($list);die();
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        }
        else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        if ($ajax == 0) {
            // get car detail
            $rsInfo = $this->ResultCarId($carId);
            $car = $rsInfo->car[0]->cars;
            $this->set(compact('list', 'total', 'maxpages', 'page', 'keyword', 'companyId', 'carId', 'openfrom', 'car','list_mynetwork'));
            $this->helpers = array('Common');
            $this->set('title_for_layout', 'Dealers In Company');
            $this->layout = 'cz_home';
            $this->render('car_detail_action_page');
        } else {
            $this->set(compact('list', 'total', 'maxpages', 'page', 'keyword', 'companyId', 'carId', 'openfrom','list_mynetwork'));
            $this->layout = null;
            $this->render('car_detail_action_page_ajax');
        }
    }
    
    public function share_car_setting() {
        $this->helpers = array('Common');
        $this->set('title_for_layout', 'Sharing');
        $this->layout = 'cz_home';
        // call api
        $url = Configure::read('api.api_url').'api/user/getstatussettingsharecar?company_id=' . CakeSession::read('Auth.User.company_id');
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if($result && $result->status_setting){
            $rs = $result->status_setting;
        }else{
            $rs = null;
        }

        return $this->set(compact('rs'));
    }
    //Set rule make offer
    public function setting_make_offer() {
        //change value of zooper type
        $this->helpers = array('Common');
        $this->set('title_for_layout', 'Offer rules');
        $this->layout = 'cz_home';
        // call api
        $url = Configure::read('api.api_url').'api/user/getstatussettingsharecar?company_id=' . CakeSession::read('Auth.User.company_id');
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        //debug($result);die();
        if($result && $result->status_setting){
            $rs = $result->status_setting;
        }else{
            $rs = null;
        }
        return $this->set(compact('rs'));
    }
    //Setting tender
    public function setting_tender() {
        //change value of zooper type
        $this->helpers = array('Common');
        $this->set('title_for_layout', 'Setting tender');
        $this->layout = 'cz_home';
        //call api
        $url = Configure::read('api.api_url').'api/user/checktendersettingofuser?user_id='.CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => CakeSession::read('Auth.User._id'),
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER',$header)->get());
        if($result && isset($result->status) && $result->status == 'success'){
            $option = $result->option;
            //debug($option);die();
        }else{
            $data['error'] = 1;
        }
        $this->set(compact(array('option')));
    }
    public function save_setting_tender() {
        $this->autoRender = false;
        $this->layout = null;
        if ($this->request->data) {
            // get parameters
            $option = isset($this->request->data['option']) && !empty($this->request->data['option']) ? $this->request->data['option'] : '';
            // call api
        }
        $url = Configure::read('api.api_url').'api/user/changestatussettingtender';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => CakeSession::read('Auth.User._id'),
            'option'  => $option
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result && isset($result->status) && $result->status == 'success'){
            $data['error'] = 0;
        }else{
            $data['error'] = 1;
        }
        return json_encode($data);
    }
    public function save_offer_rules() {
        $this->autoRender = false;
        $this->layout = null;
        if ($this->request->data) {
            // get parameters
            $set_by_price = isset($this->request->data['setbyprice']) && !empty($this->request->data['setbyprice']) ? $this->request->data['setbyprice'] : null;
            $set_by_percent = isset($this->request->data['setbypercent']) && !empty($this->request->data['setbypercent']) ? $this->request->data['setbypercent'] : null;
            //check type for offer rules
            if(!$set_by_price && $set_by_percent){
                $price_cheaper_type = 2;
                $price_cheaper_value = $set_by_percent;
            }
            elseif ($set_by_price && !$set_by_percent)
            {
                $price_cheaper_type = 1;
                $price_cheaper_value = $set_by_price;
            }
            else{
                $price_cheaper_type = null;
            }

        }
        // call api
        $url_set_make_offer = Configure::read('api.api_url').'api/user/settingmakeoffer';
        $body_set_make_offer = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'company_id' => $this->Session->read('Auth.User.company_id'),
            'price_cheaper_value' => $price_cheaper_value,
            'price_cheaper_type' => $price_cheaper_type,
        );
        $result = json_decode($this->CurlApi->to($url_set_make_offer)->withData( json_encode($body_set_make_offer))->post());
        //debug($url_set_make_offer);
        //debug($result);die();
        if($result && isset($result->status) && $result->status == 'success'){
            $data['error'] = 0;
        }else{
            $data['error'] = 1;
        }
        return json_encode($data);
    }

    public function change_share_car_setting() {
        $this->autoRender = false;
        $this->layout = null;

        // call api
        $url = Configure::read('api.api_url') . 'api/user/changesettingsharecar';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'company_id' => $this->Session->read('Auth.User.company_id'),
            'status_setting' => isset($this->request->data['status_setting']) ? $this->request->data['status_setting'] : ''
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }
    
    public function get_cars_random_ajax() {
        $this->autoRender = false;
        $this->layout = null;
        
        $limit = isset($this->params['url']['limit'])? $this->params['url']['limit'] : '10';
        
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/getflicarrloadmorenewversion';
        $body = [
            'company_id' => CakeSession::read('Auth.User.company_id'),
            'user_id' => CakeSession::read('Auth.User._id'),
            'type' => '',
            'year_from' => '',
            'year_to' => '',
            'price_from' => '',
            'price_to' => '',
            'distance_from' => '',
            'distance_to' => '',
            'location' => '',
            'start' => 0,
            'limit' => $limit
        ];
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->cars) && $result->cars) {
            $listcars = $result->cars;
        }
        else {
            $listcars = null;
        }
        
        $this->set(compact('listcars'));
        $this->render('random_cars_ajax');
    }
    //Send offer
    public function sendOffer() {
        $this->autoRender = false;
        $this->layout = null;
        // get params
        $car_id = (isset($this->request->data['car_id']))?$this->request->data['car_id'] : '';
        $make_on_offer = (isset($this->request->data['make_on_offer']))?$this->request->data['make_on_offer'] : 0;
        $car_price = (isset($this->request->data['car_price']))?$this->request->data['car_price'] : null;
        $offer_valid = (isset($this->request->data['offer_valid']))?$this->request->data['offer_valid'] : 0;
        $offer_to_dealers = (isset($this->request->data['offer_to_dealers']))?$this->request->data['offer_to_dealers'] : '';
        $option_offer = (isset($this->request->data['option_offer']))?$this->request->data['option_offer'] : '';
        $buyer_id = (isset($this->request->data['buyer_id']))?$this->request->data['buyer_id'] : null ;
        $is_zooper = (isset($this->request->data['is_custom_zooper']))?$this->request->data['is_custom_zooper'] : '';
        $arrOfferToDealers = explode('|', $offer_to_dealers);
            //call api
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $url = Configure::read('api.api_url') . 'api/user/sendoffer';
            $body = [
                'company_id' => $this->Session->read('Auth.User.company_id'),
                'user_id' => $this->Session->read('Auth.User._id'),
                'buyer_id' => $this->Session->read('Auth.User._id'),
                'is_cusstom_zooper' => $is_zooper,
                'car_id' => $car_id,
                'make_on_offer' => $make_on_offer,
                'offer_valid' => $offer_valid,
                'type_offer' => 0,
                'option_offer' => $option_offer,
                'offer_to_dealers' => $arrOfferToDealers
            ];

            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            //debug($body);debug($result);die();
            if ($result && isset($result->status) && $result->status == 'success') {
                $data['error'] = 0;
                //$this->Session->setFlash('Successfully', 'flash_custom', array('type' => 0));
            } else {
                if (isset($result->code) && $result->code == 203) {
                    $this->Session->setFlash('This car has been sold.', 'flash_custom', array('type' => 1));
                } else {
                    $this->Session->setFlash('Failure', 'flash_custom', array('type' => 1));
                }
            }
         return $this->redirect('/cars/listofferbuying?car_id=' . $car_id);
    }
    
    public function adjustOfferAjax() {
        $this->autoRender = false;
        $this->layout = null;
        
        // get params
        $offer_id = (isset($this->request->data['offer_id']))?$this->request->data['offer_id'] : '';
        $make_on_offer = (isset($this->request->data['make_on_offer']))?$this->request->data['make_on_offer'] : 0;
        $offer_valid = (isset($this->request->data['offer_valid']))?$this->request->data['offer_valid'] : 0;
        
        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/adjustoffer';
        $body = [
            'user_id' => $this->Session->read('Auth.User._id'),
            'offer_id' => $offer_id,
            'make_on_offer' => $make_on_offer,
            'offer_valid' => $offer_valid
        ];
        
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->offer_infor) && $result->offer_infor) {
            $data['error'] = 0;
            $result->offer_infor->new_offer_price = '$'.number_format($result->offer_infor->make_on_offer,0,',',',');
            $data['offer_infor'] = $result->offer_infor;
        }
        else {
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }
    
    public function counterOfferAjax() {
        $this->autoRender = false;
        $this->layout = null;
        // get params
        $offer_id = (isset($this->request->data['offer_id']))?$this->request->data['offer_id'] : '';
        $car_id = (isset($this->request->data['car_id']))?$this->request->data['car_id'] : '';
        $make_counter = (isset($this->request->data['make_counter']))?$this->request->data['make_counter'] : '';
        $buyer_id = (isset($this->request->data['buyer_id']))?$this->request->data['buyer_id'] : '';
        $CompanyName = $this->Session->read('Auth.User.company_info')->name;
        $is_zooper = $this->request->data['is_custom_zooper'];
        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/counteroffer';
        $body = [
            'offer_id' => $offer_id,
            'car_id' => $car_id,
            'make_counter' => $make_counter,
            'buyer_id'=>$buyer_id,
            'is_custom_zooper'=>$is_zooper,
            'seller_user_name'=> $CompanyName

        ];
        
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['result'] = $result;
        }
        else {
            $data['error'] = 1;
            $data['result'] = $result;
        }

        return json_encode($data);
    }
    //Get dealer in ccompany
    public function getDealersInCompanyAjax() {
        $this->autoRender = false;
        $this->layout = null;
        // get params
        $companyId = (isset($this->request->data['company_id']))?$this->request->data['company_id'] : '';
        $carId = (isset($this->request->data['car_id']))?$this->request->data['car_id'] : '';
        // pagination
        $limit = (isset($this->request->data['limit']) && $this->request->data['limit']) ? $this->request->data['limit'] : 20;
        $page = (isset($this->request->data['page']) && $this->request->data['page'])? $this->request->data['page'] : 1;
        $start = $limit * ($page - 1);
        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/getusersofcompany';
        $body = [
            'sort' => 1,
            'limit' => $limit,
            'start' => $start,
            'company_id' => $companyId,
            'car_id' => $carId,
            'user_id' => $this->Session->read('Auth.User._id')
        ];
        
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['list_dealer'] = $result->user_company;
        }
        else {
            $data['error'] = 1;
        }
        return json_encode($data);
    }
    //Get dealership in company
    public function getDealershipInCompanyAjax(){
        $this->autoRender = false;
        $this->layout = null;
        // get params branch_address_id :"581fe4dea058bb9c1300011a"
        $branch_address_id  = (isset($this->request->data['branch_address_id']))?$this->request->data['branch_address_id'] : '';
        // pagination
        $limit = (isset($this->request->data['limit']) && $this->request->data['limit']) ? $this->request->data['limit'] : 20;
        $page = (isset($this->request->data['page']) && $this->request->data['page'])? $this->request->data['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url').'api/user/getusersofbranch';
        $body = [
            'sort' => 1,
            'limit' => $limit,
            'start' => $start,
            'user_id' => $this->Session->read('Auth.User._id'),
            'branch_address_id'=>$branch_address_id,
            'company_id' => CakeSession::read('Auth.User.company_id'),

        ];

        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['list_dealer'] = $result->user_company;
        }
        else {
            $data['error'] = 1;
        }
        return json_encode($data);

    }
    //Get email dealership in company
    public function getEmailDealershipInCompanyAjax(){
        $this->autoRender = false;
        $this->layout = null;

        // get params branch_address_id :"581fe4dea058bb9c1300011a"
        $branch_address_id  = (isset($this->request->data['branch_address_id']))?$this->request->data['branch_address_id'] : '';
        // pagination
        $limit = (isset($this->request->data['limit']) && $this->request->data['limit']) ? $this->request->data['limit'] : 20;
        $page = (isset($this->request->data['page']) && $this->request->data['page'])? $this->request->data['page'] : 1;
        $start = $limit * ($page - 1);

        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url').'api/user/getusersofbranch';
        $body = [
            'sort' => 1,
            'limit' => $limit,
            'start' => $start,
            'user_id' => $this->Session->read('Auth.User._id'),
            'branch_address_id'=>$branch_address_id,
            'company_id' => CakeSession::read('Auth.User.company_id'),

        ];

        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['list_dealer'] = $result->user_company;
        }
        else {
            $data['error'] = 1;
        }
        return json_encode($data);

    }
    //get principles in company
    public function getPrinciplesInCompanyAjax() {
        $this->autoRender = false;
        $this->layout = null;
        
        // get params
        $companyId = (isset($this->request->data['company_id']))?$this->request->data['company_id'] : '';
        
        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/getprincipleofcompany?company_id=' . $companyId;
        
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        //die(json_encode($result));
        
        if ($result && isset($result->status) && $result->status) {
            $data['error'] = 0;
            $data['list_dealer'] = $result->user_company;
        }
        else {
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }
    //Get dealer in network
    public function getDealersInNetworkAjax() {
        $this->autoRender = false;
        $this->layout = null;
        
        // pagination
        $limit = (isset($this->request->data['limit']) && $this->request->data['limit']) ? $this->request->data['limit'] : 20;
        $page = (isset($this->request->data['page']) && $this->request->data['page'])? $this->request->data['page'] : 1;
        $start = $limit * ($page - 1);
        
        // get dealer on my network
        $url = Configure::read('api.api_url') . 'api/user/getmynetwork';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => '',
            'limit' => $limit,
            'start' => $start,
            'type' => 1
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['list_dealer'] = $result->networks;
        }
        else {
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }
    //Get group in network
    public function getGroupsInNetworkAjax() {
        $this->autoRender = false;
        $this->layout = null;
        // pagination
        $limit = (isset($this->request->data['limit']) && $this->request->data['limit']) ? $this->request->data['limit'] : 20;
        $page = (isset($this->request->data['page']) && $this->request->data['page'])? $this->request->data['page'] : 1;
        $start = $limit * ($page - 1);
        
        // get groups on my network
        $url = Configure::read('api.api_url') . 'api/user/getallgroupexistsmember';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => $this->Session->read('Auth.User._id'),
            'limit' => $limit,
            'start' => $start,
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['list_dealer'] = $result->results;
        }
        else {
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }
    //o offer ajax
    public function sendOfferAjax() {
        $this->autoRender = false;
        $this->layout = null;
        
        // get params
        $car_id = (isset($this->request->data['car_id']))?$this->request->data['car_id'] : '';
        $make_on_offer = (isset($this->request->data['make_on_offer']))?$this->request->data['make_on_offer'] : 0;
        $offer_valid = (isset($this->request->data['offer_valid']))?$this->request->data['offer_valid'] : 0;
        $type_offer = (isset($this->request->data['type_offer']))?$this->request->data['type_offer'] : 0;
        $option_offer = (isset($this->request->data['option_offer']))?$this->request->data['option_offer'] : 1;
        $is_custom_zooper = (isset($this->request->data['is_custom_zooper ']) && !empty($this->request->data['is_custom_zooper ']))? $this->request->data['is_custom_zooper '] : 0;
        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/sendoffer';
        if( $is_custom_zooper == 1){
            $buyer_id = $this->Session->read('Auth.User.company_id');

        }else{
            $buyer_id = $this->Session->read('Auth.User._id');
        }
        $body = [
            'user_id' => $this->Session->read('Auth.User._id'),
            'buyer_id' => $buyer_id,
            'car_id' => $car_id,
            'make_on_offer' => $make_on_offer,
            'offer_valid' => $offer_valid,
            'type_offer' => $type_offer,
            'option_offer' => $option_offer,
            'is_cusstom_zooper' => $is_custom_zooper
        ];

        if ($option_offer == 2 || $option_offer == 3) {
            $body['offer_to_dealers'] = (isset($this->request->data['offer_to_dealers']))? $this->request->data['offer_to_dealers'] : null;
        }
        
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }
    
    public function sendOfferList() {
        $this->autoRender = false;
        $this->layout = null;
        // get params
        $isCustomZooper = (isset($this->request->data['is_custom_zooper']))?$this->request->data['is_custom_zooper'] : '';
        $tender_id = (isset($this->request->data['tender_id']))?$this->request->data['tender_id'] : '';
        $car_offer = (isset($this->request->data['car_offer']))?$this->request->data['car_offer'] : '';
        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/sendlistoffer';
        $body = [
            'is_custom_zooper' => $isCustomZooper,
            'user_id' => $this->Session->read('Auth.User._id'),
            'buyer_id' => $this->Session->read('Auth.User._id'),
            'tender_id' => $tender_id,
            'car_offer' => $car_offer
        ];
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
            $data['result'] = $result;
        }
        
        return json_encode($data);
    }
    //Request offer ajax
    public function requestOfferAjax() {
        $this->autoRender = false;
        $this->layout = null;
        // get params
        $car_id = (isset($this->request->data['car_id']))?$this->request->data['car_id'] : '';
        $type = (isset($this->request->data['type']))?$this->request->data['type'] : 0;
        // call api
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/requestoffer';
        $body = [
            'seller_id' => $this->Session->read('Auth.User._id'),
            'car_id' => $car_id,
            'type' => $type
        ];
        
        if ($type != 0) {
            $body['arr_offer_dealer'] = (isset($this->request->data['arr_offer_dealer']))? $this->request->data['arr_offer_dealer'] : '';
        }
        
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug(json_encode($body)); debug($result); die();
        
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['data'] = $result;
        }
        else {
            $data['error'] = 1;
            $data['data'] = $result;
        }
        
        return json_encode($data);
    }
    
    public function add_tender(){
        if($this->request->data){
            // post add tender
            $is_zooper = (isset($this->request->data['is_custom_zooper']))?$this->request->data['is_custom_zooper'] : 0;
            $this->autoRender = false;
            $url_add = Configure::read('api.api_url').'api/user/addtender';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $array_tender=(isset($this->request->data['arr_tender_dealer']))? $this->request->data['arr_tender_dealer'] : 0;
            $body_add = array(
                "user_id" => $this->Session->read('Auth.User._id'),
                "title" => isset($this->request->data['title'])? $this->request->data['title'] : '',
                "start_date" => isset($this->request->data['start_date'])? $this->request->data['start_date'] . ':00' : '',
                "end_date" => isset($this->request->data['end_date'])? $this->request->data['end_date'] . ':00' : '',
                "inspection" => isset($this->request->data['inspection'])? $this->request->data['inspection'] : '',
                "inspect_datetime_start" => isset($this->request->data['inspect_datetime_start'])? $this->request->data['inspect_datetime_start'] : '',
                "arr_tender_car" => isset($this->request->data['arr_tender_car'])? $this->request->data['arr_tender_car'] : '',
                "arr_tender_dealer" => isset($array_tender)? array_unique($array_tender) : '',
                "time_zones" => $this->Session->read('time_zones'),
                'is_custom_zooper' => $is_zooper
            );
            $result = json_decode($this->CurlApi->to($url_add)->withData( json_encode($body_add))->withOption('HTTPHEADER', $header)->post());


            if($result && isset($result->status) && $result->status == 'success'){
                $data['error'] = 0;
            }else{
                $data['error'] = 1;
                $data['result'] = $result;
            }
            
            return json_encode($data);
            
        } else { // get view add tender
            $limit = 100;
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            // get cars in my stock
            $urlMyStock = Configure::read('api.api_url') . 'api/user/getmystocknewversion';
            $bodyMyStock = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "company_id" => CakeSession::read('Auth.User.company_id'),
                "type" => 9,
                "filter" => 1,
                "start" => 0,
                "limit" => $limit,
                "total" => 1
            );
            $resultMyStock = json_decode($this->CurlApi->to($urlMyStock)->withData(json_encode($bodyMyStock))->withOption('HTTPHEADER', $header)->post());
            if ($resultMyStock && isset($resultMyStock->cars) && $resultMyStock->cars) {
                $listMyStock = $resultMyStock->cars;
                $totalMyStock = $resultMyStock->total;
                $maxpagesMyStock = $this->Page($totalMyStock, $limit);
            } else {
                $listMyStock = null;
                $totalMyStock = 0;
                $maxpagesMyStock = 0;
            }


            //get my network and network group
            $urlNetworkGroup=Configure::read('api.api_url') . 'api/user/getmynetworksandnetworkgroups';
            $bodyNetworkGroup = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                "company_id" => CakeSession::read('Auth.User.company_id'),
                'type' => 2,
                'start' => 0,
                'limit' => $limit,
                'total' => 1
            );
            $resultNetworkGroup = json_decode($this->CurlApi->to($urlNetworkGroup)->withData(json_encode($bodyNetworkGroup))->withOption('HTTPHEADER', $header)->post());
            //debug($urlNetworkGroup);die(json_encode($bodyNetworkGroup));debug($resultNetworkGroup);die();
            if ($resultNetworkGroup && isset($resultNetworkGroup->network_groups) && $resultNetworkGroup->network_groups) {
                $listNetworkGroup = $resultNetworkGroup->network_groups;
                $totalNetworkGroup = $resultNetworkGroup->count_network_group;
                $maxpagesetNworkGroup = $this->Page($totalNetworkGroup, $limit);
            } else {
                $listNetworkGroup = null;
                $totalNetworkGroup = 0;
                $maxpagesNetworkGroup = 0;
            }


            // get my network
            $urlMyNetwork = Configure::read('api.api_url') . 'api/user/getmynetwork';
            $bodyMyNetwork = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'user_email' =>$this->Session->read('Auth.User.email'),
                'keyword' => '',
                'type' => 1,
                'start' => 0,
                'limit' => $limit,
                'total' => 1
            );
            $resultMyNetwork = json_decode($this->CurlApi->to($urlMyNetwork)->withData(json_encode($bodyMyNetwork))->withOption('HTTPHEADER', $header)->post());
            //debug($urlMyNetwork);debug($bodyMyNetwork);debug($resultMyNetwork);die();

            if ($resultMyNetwork && isset($resultMyNetwork->networks) && $resultMyNetwork->networks) {
                $listMyNetwork = $resultMyNetwork->networks;
                $totalMyNetwork = $resultMyNetwork->count_network;
                $maxpagesMyNetwork = $this->Page($totalMyNetwork, $limit);
            } else {
                $listMyNetwork = null;
                $totalMyNetwork = 0;
                $maxpagesMyNetwork = 0;
            }
            
            $this->set(compact(array('listMyStock', 'totalMyStock', 'maxpagesMyStock', 'listMyNetwork', 'totalMyNetwork', 'maxpagesMyNetwork','listNetworkGroup','totalNetworkGroup','maxpagesNetworkGroup', 'limit')));
            $this->helpers = array('Common');
            $this->set('title_for_layout', 'Add Tender');
            $this->layout = 'cz_home';
        }
    }
    //Get network ajax
    public function getNetworkAjax() {
        $this->layout = null;
        $this->autoRender = false;

        $keyword = (isset($this->request->data['keyword']))?$this->request->data['keyword'] : '';
        $page = (isset($this->request->data['page']))?$this->request->data['page'] : 1;
        $limit = (isset($this->request->data['limit']))?$this->request->data['limit'] : 10;
        $start = ($page - 1)*$limit;

        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );

        $urlNetworkGroup = Configure::read('api.api_url') . 'api/user/getmynetworksandnetworkgroups';
        $bodyMyNetwork = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'company_id' =>$this->Session->read('Auth.User.company_id'),
            'keyword' => $keyword,
            'type' => 1,
            'start' => $start,
            'limit' => $limit
        );
        $resultMyNetwork = json_decode($this->CurlApi->to($urlNetworkGroup)->withData(json_encode($bodyMyNetwork))->withOption('HTTPHEADER', $header)->post());

        // check dk
        $networks = $resultMyNetwork->my_networks;

        $this->set(compact('networks'));
        return $this->render('networks_ajax');
    }

    
    public function add_item_into_tender() {
        $this->autoRender = false;
        $this->layout = null;
        
        // get params
        $addtype = (isset($this->request->data['type']))?$this->request->data['type'] : 1; // 0 - add dealer; 1  add car
        $tender_id = (isset($this->request->data['tender_id']))?$this->request->data['tender_id'] : '';
        $arr_tender_car = (isset($this->request->data['arr_tender_car']))?$this->request->data['arr_tender_car'] : null;
        $arr_tender_dealer = (isset($this->request->data['arr_tender_dealer']))?$this->request->data['arr_tender_dealer'] : null;
        
        // call api
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $url = Configure::read('api.api_url') . 'api/user/addcarordealerintotender';
        $body = [
            'tender_id' => $tender_id
        ];
        if ($addtype == 1) {
            $body['arr_tender_car'] = $arr_tender_car;
        }
        else {
            $body['arr_tender_dealer'] = $arr_tender_dealer;
        }
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        
        if ($result && isset($result->status) && $result->status == 'success') {
            $this->Session->setFlash('Added Successfully', 'flash_custom', array('type'=>0));
        }
        else {
            $this->Session->setFlash('Failure', 'flash_custom', array('type'=>1));
        }
        
        return $this->redirect('/cars/listcaroftender?tender_id=' . $tender_id . '&type=1&view_by=' . $addtype);
    }
    
    public function get_select_stock_for_tender_ajax() {
        $this->autoRender = false;
        $this->layout = null;
        // get params
        $carsRemove = (isset($this->request->data['car_ids']) && $this->request->data['car_ids'])? $this->request->data['car_ids'] : null;
        
        // get cars in my stock
        $urlMyStock = Configure::read('api.api_url') . 'api/user/getmystocknewversion';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $bodyMyStock = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "company_id" => CakeSession::read('Auth.User.company_id'),
            "type" => 9,
            "filter" => 1,
            "start" => 0,
            "limit" => 200
        );
        $resultMyStock = json_decode($this->CurlApi->to($urlMyStock)->withData(json_encode($bodyMyStock))->withOption('HTTPHEADER', $header)->post());
        if ($resultMyStock && isset($resultMyStock->cars) && $resultMyStock->cars) {
            $listStock = $resultMyStock->cars;
        } else {
            $listStock = null;
        }
        
        $list = array();
        foreach ($listStock as $data) {
            if (!in_array($data->cars->_id, $carsRemove)) {
                $list[] = $data;
            }
        }
        
        $this->set(compact('list'));
        $this->render('select_cars_tender');
    }
    
    public function get_select_network_for_tender_ajax() {
        $this->autoRender = false;
        $this->layout = null;
        // get params
        $dealersRemove = (isset($this->request->data['dealer_ids']) && $this->request->data['dealer_ids'])? $this->request->data['dealer_ids'] : null;
        
        // get dealers in my network
        $urlMyNetwork = Configure::read('api.api_url') . 'api/user/getmynetwork';
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $bodyMyNetwork = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'user_email' =>$this->Session->read('Auth.User.email'),
            'keyword' => '',
            'type' => 1,
            'start' => 0,
            'limit' => 200,
            'total' => 1
        );
        $resultMyNetwork = json_decode($this->CurlApi->to($urlMyNetwork)->withData(json_encode($bodyMyNetwork))->withOption('HTTPHEADER', $header)->post());
        if ($resultMyNetwork && isset($resultMyNetwork->networks) && $resultMyNetwork->networks) {
            $listMyNetwork = $resultMyNetwork->networks;
        } else {
            $listMyNetwork = null;
        }
        
        $list = array();
        foreach ($listMyNetwork as $data) {
            if (!in_array($data->_id, $dealersRemove)) {
                $list[] = $data;
            }
        }
        $this->set(compact('list'));
        $this->render('select_dealers_tender');
    }

}
