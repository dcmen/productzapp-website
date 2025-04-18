<?php

Configure::load('api');
require_once(ROOT.DS.'app'.DS.'Vendor'.DS.'Spout'.DS.'Autoloader'.DS.'autoload.php'); 
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
class UsersController extends AppController {
    public $components = array('Paginator','Curl','CurlApi');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('test','ajaxlogin', 'admin_login','activate_device_code'));
    }
    public function index() {
        
    }
    public function import_user(){

        $type = explode('.', $_FILES['import_file']['name'])[1];
        $fileName = explode('.', $_FILES['import_file']['name'])[0].'_'.time();
        $uploadPath = WWW_ROOT.'import/';
        $uploadFile = $uploadPath.$fileName.'.'.$type;
        $tmp_name = $_FILES['import_file']['tmp_name'];
        

        if($type=='xls'){
            $reader = ReaderFactory::create(Type::XLS); // for XLS files
        }elseif($type=='xlsx'){
            $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
        }elseif($type=='csv'){
            $reader = ReaderFactory::create(Type::CSV); // for CSV files
        }else{
            $this->Session->setFlash('Imported not successfully. Only accept Excel or CSV file');
            $this->redirect('/all_user');
        }
        if($_FILES['import_file']['name'] != NULL){
            move_uploaded_file($tmp_name,$uploadFile);
        }
        $reader->open($uploadFile);

        $i=0;
        foreach ($reader->getSheetIterator() as $sheet) {
            $get_sheetData = $sheet->getRowIterator();
            foreach ($sheet->getRowIterator() as $row) {
                if($i!=0){ 
                    echo '<div><span>'.$row[0].'</span>';
                    echo '<span>'.$row[0].'</span>';
                    echo '<span>'.$row[0].'</span></div>';
                }
                $i++;
            }
            break;
        }
        $reader->close();
    }
    public function ResultGetUrl($url,$id1){
        $header = array(
            'userid:'.CakeSession::read('Auth.User._id'),
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url.$id1)->withOption('HTTPHEADER', $header)->get());
        return $result;
    }
    public function ResultPostUrl($url,$body = array()){
        $header = array(
            'userid:'.CakeSession::read('Auth.User._id'),
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        return $result;
    }
    function ajaxlogin($cookie = null) {
        $this->autoRender = false;
        if ($this->request->data) {
            if (!$this->Auth->login()) {
                $url = Configure::read('api.api_url').'api/user/login';
                $body = array(
                    'email' => $this->request->data['email'],
                    'password' => $this->request->data['password'],
                    'os' => 3
                );
                $result = json_decode($this->Curl->_curl_body($url,$body));
                if($result->status == 'success'){
                    $info = $result->info;
                    $us['User']['_id'] = $info->_id;
                    $us['User']['id'] = $info->id;
                    $us['User']['name'] = $info->name;
                    $us['User']['email'] = $info->email;
                    $us['User']['phone'] = $info->phone;
                    $us['User']['company_name'] = $info->company_name;
                    $us['User']['dealer_solution_number'] = $info->dealer_solution_number;
                    $us['User']['avatar'] = $info->avatar;
                    $us['User']['company_phone'] = $info->company_phone;
                    $us['User']['register_at'] = $info->register_at;
                    $us['User']['data_source'] = $info->data_source;
                    $us['User']['session_id'] = $result->session_id;
                    $us['User']['company_info'] = $info->company_info;
                    $us['User']['company_id'] = $info->company_info->_id;
                    $this->Session->write('time_zones', $this->request->data['time_zones']);
                    $this->Session->write('is_remain_time', $info->is_remain_time);
                    $this->Session->write('trial', $info->trial);
                    $option = $info->option_tender;
                    $this->Session->write('first_login', $info->first_login);
                    if($info->custom_zooper){
                        $this->Session->write('custom_zooper',$info->custom_zooper);
                        $this->Session->write('is_custom_zooper',$info->custom_zooper->price_cheaper_type);
                        $this->Session->write('price_cheaper_value',$info->custom_zooper->price_cheaper_value);
                        $this->Session->write('price_cheaper_type',$info->custom_zooper->price_cheaper_type);
                    }
                    if ($info->first_login) {
                        $this->Session->write('password', $this->request->data['password']);
                    }
                    if($info->is_active){
                        if($this->Auth->login($us['User'])){
                            $url_2 = Configure::read('api.api_url').'api/user/addHistoryLogin';
                            $header = array(
                                'userid:'.$this->Session->read('Auth.User._id'),
                                'sessionid:'.$this->Session->read('Auth.User.session_id')
                            );
                            $body_2 = array(
                                'user_id' => $this->Session->read('Auth.User._id'),
                                'os' => 3
                            );
                            $result_log = json_decode($this->CurlApi->to($url_2)->withData( json_encode($body_2))->withOption('HTTPHEADER', $header)->post());

                            if(isset($this->request->data['agree'])){
                                $agree = $this->request->data['agree'];
                                if($agree == 1){
                                    unset($this->request->data['agree']);
                                    //$this->Cookie->write('User.email', $this->request->data['email'],false, '2 weeks');
                                    //$this->Cookie->write('User.password', $this->request->data['password'],false, '2 weeks');
                                }
                            }
                            //call api CreateAnalyticsSession
                            $url_3 = Configure::read('api.api_url').'api/user/createanalyticssession';
                            $header_3 = array(
                                'userid:'.$this->Session->read('Auth.User._id'),
                                'sessionid:'.$this->Session->read('Auth.User.session_id')
                            );
                            $body_3 = array(
                                'new_session' => array(
                                    "device_id" => "",
                                    "user_id" => $this->Session->read('Auth.User._id'),
                                    "os_type" => 3,
                                    "version" => "1.2.2.0",
                                    "browser_name"=>$this->request->data['browsername'],
                                    "client_ip"=>$this->request->data['clientip']
                                ),
                                'update_session' => ''
                                );
                            $result_analytic = json_decode($this->CurlApi->to($url_3)->withData(json_encode($body_3))->withOption('HTTPHEADER', $header_3)->post());
                            //debug($body_3); debug($url_3); debug($result_analytic);die();
                            if($result_analytic->status == 'success')
                            {
                                $this->Session->write('new_analytics_session_id',$result_analytic->new_analytics_session_id);
                            }
                            //call api UpdateAnalyticsViewScreenBySession
                            $url_4 = Configure::read('api.api_url').'api/user/updateanalyticsviewscreenbysession';
                            $header_4 = array(
                                'userid:'.$this->Session->read('Auth.User._id'),
                                'sessionid:'.$this->Session->read('Auth.User.session_id')
                            );
                            $body_4 = array(
                                "analytics_session_id" => $this->Session->read('new_analytics_session_id'),
                                "keyscreen" => "count_dashboard"
                            );
                            $result_count_dashboard = json_decode($this->CurlApi->to($url_4)->withData(json_encode($body_4))->withOption('HTTPHEADER', $header_4)->post());


                        }
                        if(CakeSession::read('in_app_purchase') == 1){
                            $data['error'] = 3;
                        }else{
                            $data['error'] = 0;
                        }
                    }else{
                        if (!$info->is_blocked) {
                            $data['error'] = 1;
                            $data['msg'] = 'Your account has not been activated. Please contact support on support@carzapp.com';
                        }
                        else {
                            $data['error'] = 1;
                            $data['msg'] = 'Your account has been blocked by Admin. To discuss your account, please send an email to: admin@carzapp.com.au';
                        }
                    }

                }

                else {
                    if (isset($result->code) && $result->code == 207) {
                        $data['error'] = 1;
                        $data['msg'] = 'We have upgraded our server and made the app run 20 x faster. In doing this we have had to reset all passwords.<br>Please use the "Forgot password?" feature to reset your password.';
                    }
                    else {
                        if ($result->response == 'Error') {
                            $data['error'] = 1;
                            $data['msg'] = 'Incorrect email or password';
                        }
                        else {
                            $data['error'] = 1;
                            $data['msg'] = 'The email address provided does not exist in our database. Please register or contact support on support@carzapp.com.';
                        }
                    }
                }
            }else{
                $this->Cookie->delete('email');
                $this->Cookie->delete('password');
                $this->Session->destroy();
                $data['msg'] = 'Exits user';
                $data['error'] = 1;
            }
        }
        echo json_encode($data);
    }
    public function admin_login() {
        $this->set('title_for_layout', 'Login Admistrator');
        $this->layout = 'cooming_soon';
        //$this->Session->destroy();
        if (CakeSession::read('Auth.User')) {
            if (CakeSession::read('Auth.User.is_admin')) {
                return $this->redirect('/list_regis_brochures');
            }
            else {
                return $this->redirect('/home');
            }
        }
        if ($this->request->is('post')) {
            $email = $this->request->data['email'];
            $password = $this->request->data['password'];

            if (!$this->Auth->login()) {
                $url = Configure::read('api.api_url').'api/user/login';
                $body = array(
                    'email' => $email,
                    'password' => $password,
                    'os' => 3
                );
                $result = json_decode($this->Curl->_curl_body($url,$body));
                if($result->status == 'success'){
                    $info = $result->info;
                    $us['User']['_id'] = $info->_id;
                    $us['User']['id'] = $info->id;
                    $us['User']['name'] = $info->name;
                    $us['User']['email'] = $info->email;
                    $us['User']['phone'] = $info->phone;
                    $us['User']['company_name'] = $info->company_name;
                    $us['User']['dealer_solution_number'] = $info->dealer_solution_number;
                    $us['User']['avatar'] = $info->avatar;
                    $us['User']['company_phone'] = $info->company_phone;
                    $us['User']['register_at'] = $info->register_at;
                    $us['User']['data_source'] = $info->data_source;
                    $us['User']['session_id'] = $result->session_id;
                    if ($info->is_admin == 1) {
                        $this->Auth->login($us['User']);
                        $this->Auth->Session->write('Auth.User.is_admin', 1);
                        $this->Auth->Session->write('Auth.User.user_id', $info->id);
                        $this->Auth->Session->write('Auth.User.name', $info->name);
                        $this->Auth->Session->write('Auth.User.email', $info->email);
                        $this->Session->write('time_zones', $this->request->data['time_zones']);
                        
                        return $this->redirect('/list_regis_brochures');
                    }else{
                        $this->Session->setFlash(('you don\'t have login this system!'));
                        return $this->redirect('/admin');
                    }
                }else{
                    $this->Session->setFlash(('Username or password error'));
                }

            } else {
                $this->Session->destroy();
                return $this->redirect('/admin');
            }
        }
    }

    function logout_admin() {
        $this->autoRender = false;
        $this->Session->destroy();
        return $this->redirect('/admin');
    }
    function changepassword(){
        $this->autoRender = false;
        if($this->request->data) {

            if($this->Session->read('password')){
                $current_pass =  $this->Session->read('password');
            }
            else{
                $current_pass = $this->request->data['currentpassword'];
            }
            $url = Configure::read('api.api_url').'api/user/changepassword';
            $header = array(
                'userid:' . CakeSession::read('Auth.User._id'),
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                'user_id' => CakeSession::read('Auth.User._id'),
                'current_password' => $current_pass,
                'new_password' => $this->request->data['newpassword'],
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if($result->status == 'success'){
                $data['error'] = 0;
                $this->Session->write('first_login', false);
                $this->Session->write('password', false);

            }else{
                $data['error'] = 1;
                $data['msg'] = $result->response;
            }
        }else{
            $data['error'] = 1;
            $data['msg'] = 'No data post';
        }
        echo json_encode($data);
    }
    function activate_device_code(){
        $this->autoRender = false;
        if($this->request->data){
            $code = $this->request->data['code'];
            $this->loadModel('Device');
            $check = $this->Device->find('first',array('conditions' => array('Device.code' => $code)));
            if($check){
                
                $arr['id'] = $check['Device']['id'];
                $arr['device_id'] = $this->Session->read('User.id');
                if($this->Device->save($arr)){
                    $data['error'] = 0;
                    $user_info = $this->User->find('first', array(
                        'conditions' => array(
                            'User.id' => $this->Session->read('User.id'),
                        )
                    ));
                    if($this->Auth->login($user_info['User'])){
                      
                        $this->loadModel('Historylogin');
                        $check_his = $this->Historylogin->find('first',array('conditions' => array(
                            'Historylogin.user_id' => $user_info['User']['id'],
                            'Historylogin.os' => 2
                        )));
                        if($check_his){
                            $arr_h['id'] = $check_his['Historylogin']['id'];
                            $arr_h['time_login'] = time();
                            $arr_h['count_view'] = $check_his['Historylogin']['count_view'] + 1;
                            $this->Historylogin->save($arr_h);
                        }else{
                            $this->Historylogin->create();
                            $arr_h['user_id'] = $user_info['User']['id'];
                            $arr_h['time_login'] = time();
                            $arr_h['count_view'] = 1;
                            $arr_h['os'] = 2;
                            $this->Historylogin->save($arr_h);
                        }
                    }
                }else{
                    $data['error'] = 1;
                    $data['msg'] = 'Save not suscessful!';
                }
            }else{
                $data['error'] = 1;
                $data['msg'] = 'This code wrong !';
            }
        }else{
            $data['error'] = 1;
            $data['msg'] = 'Plese enter code active!';
        }
        echo json_encode($data);
    }

    function logout() {
        if (CakeSession::read('Auth.User.is_admin')) {
            $this->logout_admin();
        }
        else {
            $url_2 = Configure::read('api.api_url').'api/user/addhistorylogout';
            $header = array(
                'userid:'.$this->Session->read('Auth.User._id'),
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body_2 = array(
                'user_id' => $this->Session->read('Auth.User._id'),
                'os' => 3
            );
           $result = json_decode($this->CurlApi->to($url_2)->withData( json_encode($body_2))->withOption('HTTPHEADER', $header)->post());
            if($result->status == 'success'){
                $this->Cookie->delete('email');
                $this->Cookie->delete('password');
                $this->Cookie->delete('remember_me_cookie');
                $this->Cookie->delete('analytic');
                $this->Session->destroy();
                session_unset();     // unset $_SESSION variable for the run-time
                session_destroy();
                return $this->redirect('/home_current');
            }
        }
    }

    function home_login() {
        $this->layout = 'home';
        $data['title_for_layout'] = '';
        $this->loadModel('Car');
        $listcars = $this->Car->find('all', array(
            'recursive' => 1,
            'limit' => 50
        ));

        $this->set(compact('listcars'));
    }

    function check_email_login() {
        if ($this->request->is('post')) {
            $email = trim($this->request->data['email_input']);
            $num_users = $this->User->find('count', array('conditions' => array('User.email' => $email)));
            if ($num_users > 0) {
                die(json_encode(true));
            } else {
                die(json_encode(false));
            }
        }
    }

    function check_pass_login() {
        if ($this->request->is('post')) {
            $pass = trim($this->request->data['pass_input']);
            $num_users = $this->User->find('count', array('conditions' => array('User.encrypted_password' => md5($pass))));
            if ($num_users > 0) {
                die(json_encode(true));
            } else {
                die(json_encode(false));
            }
        }
    }
    //check zooper for setting
    function check_zooper(){

    }
    function sign_up() {
        $this->set('title_for_layout', 'Sign up');
        $this->layout = 'skin';
        $step = (isset($this->params['url']['step'])) ? $this->params['url']['step'] : '1';
        $this->loadModel('DataSourceCar');
        $data_source = $this->DataSourceCar->find('all');
        $this->set(compact('step', 'data_source'));
    }
    function upload() {
        $this->autoRender = false;
        $this->layout = null;
        //$max_file_size = 200 * 1024; #200kb
        $photo_src = $_FILES['photo']['tmp_name'];
        if (is_file($photo_src)) {
            //if (! $_FILES['photo']['error'] && $_FILES['photo']['size'] < $max_file_size) { 
            $photo_dest = 'img/uploads/users_avatar/' . time() . '.png';
            copy($photo_src, $photo_dest);
            echo '<script type="text/javascript">window.top.window.show_popup_crop("' . $photo_dest . '")</script>';
        } else {
            echo 'rrr';
        }
    }

    function crop_photo() {
        $targ_w = $_POST['targ_w'];
        $targ_h = $_POST['targ_h'];
        // quality
        $jpeg_quality = 90;
        // photo path
        $src = $_POST['photo_url'];
        // create new jpeg image based on the target sizes
        $img_r = @imagecreatefromjpeg($src);
        $dst_r = @ImageCreateTrueColor($targ_w, $targ_h);
        // crop photo
        @imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);
        // create the physical photo
        imagejpeg($dst_r, $src, $jpeg_quality);
        // display the  photo - "?time()" to force refresh by the browser
        echo '<img src="' . $src . '?' . time() . '">';
        exit;
    }

    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'flash_custom', array('type'=>0));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_custom', array('type'=>1));
            }
        }
        $roles = $this->User->Role->find('list');
        $invitedBies = $this->User->InvitedBy->find('list');
        $this->set(compact('roles', 'invitedBies'));
    }

    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'flash_custom', array('type'=>0));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_custom', array('type'=>1));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $roles = $this->User->Role->find('list');
        $invitedBies = $this->User->InvitedBy->find('list');
        $this->set(compact('roles', 'invitedBies'));
    }

    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'), 'flash_custom', array('type'=>0));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'), 'flash_custom', array('type'=>1));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function userprofile() {
        $this->helpers = array('Common');
	$this->set('title_for_layout', 'Profile');
	$this->layout = 'cz_home';
        $this->autoRender = false;
        
        // get params
        $userId = (isset($this->params['url']['user_id']) && $this->params['url']['user_id'])? $this->params['url']['user_id'] : '';
        // call api
        $url = Configure::read('api.api_url').'api/user/getprofile?user_id='.$userId;
        $header = array(
            'userid:'.$this->Session->read('Auth.User._id'),
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        $rs = $result->info;
        $this->Session->write('Auth.User.other_avatar', $result->info->avatar);
        $st_data_source = ($rs->data_source != null)?json_decode($rs->data_source):'';
        if($st_data_source != null){
            foreach($st_data_source as $m):
                $my_data_source[] = str_replace('0', '', $m);
            endforeach;
        }
        $data_source = $rs->data_feed;
        
        $arr_data_source = '';
        if ($this->request->data) {
            $source = array();
            if (isset($this->request->data['data_source'])) {
                $data_source2 = $this->request->data['data_source'];
                foreach ($data_source2 as $k => $v) {
                    $str = (strlen($v) == 1) ? "0" . $v : $v;
                    $source[] = $str;
                }
            }
            
            // image
            $imgBase64 = '';
            if (isset($this->request->data['image']) && $this->request->data['image']) {
                $path = $this->request->data['image'];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents('http://' . $_SERVER['SERVER_NAME'] . $path);
                $imgBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
            
            $url_profile = Configure::read('api.api_url').'api/user/editprofile';
            $body_profile = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "phone" => (isset($this->request->data['phone']))?$this->request->data['phone']:CakeSession::read('Auth.User.phone'),
                "name" => $this->request->data['name'],
                "last_name" => $this->request->data['last_name'],
                "license_number" => '',
                "data_source" => $source,
                "company_name" => (isset($this->request->data['company_name']))?$this->request->data['company_name']:'',
                "company_phone" => (isset($this->requets->data['tel']))?$this->requets->data['tel']:'',
                "company_email" => (isset($this->request->data['company_email']))?$this->request->data['company_email']:'',
                "company_address" => (isset($this->request->data['company_address']))?$this->request->data['company_address']:'',
                "latitude" => (isset($this->request->data['lat']))?$this->request->data['lat']:'',
                "longitude" => (isset($this->request->data['lng']))?$this->request->data['lng']:'',
                "main_fax" => '',
                "image" => $imgBase64,
                "main_fax" => (isset($this->request->data['fax']))?$this->request->data['fax']:'',
                "abn" => (isset($this->request->data['abn']))?$this->request->data['abn']:'',
                "acn" => (isset($this->request->data['acn']))?$this->request->data['acn']:'',
                "dun" => (isset($this->request->data['dun']))?$this->request->data['dun']:'',
                "company_toll_free" => (isset($this->request->data['company_toll_free']))?$this->request->data['company_toll_free']:'',
                "company_website" => (isset($this->request->data['company_website']))?$this->request->data['company_website']:'',
                "company_id" => CakeSession::read('Auth.User.company_id')
            );//debug($body_profile); die();
            $result = json_decode($this->CurlApi->to($url_profile)->withData( json_encode($body_profile))->withOption('HTTPHEADER', $header)->post());

            if ($result->status == 'success') {
                $this->Session->write('Auth.User.avatar', $result->info->avatar);
                $this->Session->write('Auth.User.name', $result->info->name);
                $this->Session->setFlash(__('Updated My profile successfully.'), 'flash_custom', array('type'=>0));
            }else{
                $this->Session->setFlash(__($result->response), 'flash_custom', array('type'=>1));
            }
            return $this->redirect('/myprofile');
        }

        $disableEdit = true;
        $this->set(compact('rs', 'data_source', 'my_data_source', 'disableEdit'));
        
        $this->render('myprofile');
    }
    
    public function myprofile() {
        $helpers = array('Common');
	$this->set('title_for_layout', 'My Profile');
	$this->set('breadcrumb', [
		(object) ['title' => 'Home'], 
		(object) ['title' => 'My Profile', 'active' => true]
	]);
	$this->layout = 'cz_home';
        
        $url = Configure::read('api.api_url').'api/user/getprofile?user_id='.CakeSession::read('Auth.User._id');
        $header = array(
            'userid:'.$this->Session->read('Auth.User._id'),
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        $rs = $result->info;
        $this->Session->write('Auth.User.avatar', $result->info->avatar);
        $st_data_source = ($rs->data_source != null)?json_decode($rs->data_source):'';
        if($st_data_source != null){
            foreach($st_data_source as $m):
                $my_data_source[] = str_replace('0', '', $m);
            endforeach;
        }
        $data_source = $rs->data_feed;
        $arr_data_source = '';
        if ($this->request->data) {
            $source = array();
            if (isset($this->request->data['data_source'])) {
                $data_source2 = $this->request->data['data_source'];
                foreach ($data_source2 as $k => $v) {
                    $str = (strlen($v) == 1) ? "0" . $v : $v;
                    $source[] = $str;
                }
            }
            
            // image
            $imgBase64 = '';
            if (isset($this->request->data['image']) && $this->request->data['image']) {
                $path = $this->request->data['image'];
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents('http://' . $_SERVER['SERVER_NAME'] . $path);
                $imgBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
            
            $url_profile = Configure::read('api.api_url').'api/user/editprofile';
            $body_profile = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "phone" => (isset($this->request->data['phone']))?$this->request->data['phone']:CakeSession::read('Auth.User.phone'),
                "name" => $this->request->data['name'],
                "last_name" => $this->request->data['last_name'],
                "license_number" => '',
                "data_source" => $source,
                "company_name" => (isset($this->request->data['company_name']))?$this->request->data['company_name']:'',
                "company_phone" => (isset($this->requets->data['tel']))?$this->requets->data['tel']:'',
                "company_email" => (isset($this->request->data['company_email']))?$this->request->data['company_email']:'',
                "company_address" => (isset($this->request->data['company_address']))?$this->request->data['company_address']:'',
                "latitude" => (isset($this->request->data['lat']))?$this->request->data['lat']:'',
                "longitude" => (isset($this->request->data['lng']))?$this->request->data['lng']:'',
                "main_fax" => '',
                "image" => $imgBase64,
                "main_fax" => (isset($this->request->data['fax']))?$this->request->data['fax']:'',
                "abn" => (isset($this->request->data['abn']))?$this->request->data['abn']:'',
                "acn" => (isset($this->request->data['acn']))?$this->request->data['acn']:'',
                "dun" => (isset($this->request->data['dun']))?$this->request->data['dun']:'',
                "company_toll_free" => (isset($this->request->data['company_toll_free']))?$this->request->data['company_toll_free']:'',
                "company_website" => (isset($this->request->data['company_website']))?$this->request->data['company_website']:'',
                "company_id" => CakeSession::read('Auth.User.company_id')
            );

            $result = json_decode($this->CurlApi->to($url_profile)->withData( json_encode($body_profile))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                $this->Session->write('Auth.User.avatar', $result->info->avatar);
                $this->Session->write('Auth.User.name', $result->info->name);
                $this->Session->setFlash(__('Updated My profile successfully.'), 'flash_custom', array('type'=>0));
            }else{
                $this->Session->setFlash(__($result->response), 'flash_custom', array('type'=>1));
            }
            return $this->redirect('/myprofile');
        }//debug($rs); die();
        return $this->set(compact('rs', 'data_source', 'my_data_source'));
    }

    public function profileuser($id = null){
        $this->layout = 'home';
        $url = Configure::read('api.api_url').'api/user/getuserbyid?user_id='.$id;
        $header = array(
            'userid:'.$this->Session->read('Auth.User._id'),
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        $rs = $result->user;
        $this->set(compact('rs'));
    }
    public function editemail(){
        $this->autoRender = FALSE;
        if($this->request->data){
            $url = Configure::read('api.api_url').'api/user/editemail';
            $header = array(
                'sessionid:'.CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "current_email" => $this->request->data['current_email'],
                "new_email" => $this->request->data['new_email'],
            );
            
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if(isset($result->code) && $result->code == 204){
                $data['error'] = 1;
                $data['msg'] = 'Old email not exit in system';
            }else if(isset ($result->code) && $result->code == 203){
                $data['error'] = 1;
                $data['msg'] = 'New email exited in system';
            }else if(isset ($result->code) && $result->code == 202){
                $data['error'] = 1;
                $data['msg'] = 'Old email is incorrect';
            }else if($result->status == 'success'){
                $data['error'] = 0;
                $data['msg'] = 'Change email successfull! Please check your new email.';
            }
        }else{
            $data['error'] = 1;
            $data['msg'] = 'Please enter your new email';
        }
        echo json_encode($data);
    }
            
    function all_user() {
        $this->set('title_for_layout', 'All Users');
        $type = (isset($this->params['url']['type']) && $this->params['url']['type'] != '') ? $this->params['url']['type'] : 4;
        $key = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : '';
        $key= trim($key," \t\n\r\0\x0B");
        $date_from = (isset($this->params['url']['date_from']) && $this->params['url']['date_from'] != '') ? date('Y/m/d 00:00:00', strtotime($this->params['url']['date_from'])) : '';
        $date_to = (isset($this->params['url']['date_to']) && $this->params['url']['date_to'] != '') ? date('Y/m/d 00:00:00', strtotime($this->params['url']['date_to'])) : '';
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : 20;
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 0;
        
        if(empty($this->params['url']['ajax'])){
            $ajax = 1;
        }else{
            $ajax = 0;
        }
        if(isset($this->params['url']['page'])){
            $page = $this->params['url']['page'];
            $page_s = $this->params['url']['page'];
        }else{
            $page = 0;
            $page_s = 1;
        }
    
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        if($sort == 1){
            $u_sort = 2;
            $i_sort = 0;
        }else if($sort == 2){
            $u_sort = 1;
            $i_sort = 1;
        }else if($sort == 3){
            $u_sort = 4;
            $i_sort = 0;
        }else if($sort == 4){
            $u_sort = 3;
            $i_sort = 1;
        }else if($sort == 5){
            $u_sort = 6;
            $i_sort = 0;
        }else if($sort == 6){
            $u_sort = 5;
            $i_sort = 1;
        }else if($sort == 7){
            $u_sort = 8;
            $i_sort = 0;
        }else if($sort == 8){
            $u_sort = 7;
            $i_sort = 1;
        }else if($sort == 9){
            $u_sort = 10;
            $i_sort = 0;
        }else if($sort == 10){
            $u_sort = 9;
            $i_sort = 1;
        }else{
            $i_sort = 0;
        }
        
        $url = Configure::read('api.api_url').'api/user/getalluseradmin';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "keyword" => $key,
            "date_from" => $date_from,
            "date_to" => $date_to,
            "type" => (int)$type,
            "start" => $start,
            "limit" => $limit,
            "sort" => $sort,
            "time_zones"=>$this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result != null){
            $l = $result->users;
            $total = $result->total;
            $total_ = count($l);
            for($i = 0; $i < $total_ ; $i++){
                $ar[] = $l[$i];
            }
            if(isset($ar)){
                $list = $ar;
                $maxpages = $this->Page($total, $limit);
                foreach($list as $u):
                    $mails[] = $u->email;
                endforeach;
            }else{
                $list = '';
                $maxpages = 0;
                $mails = '';
            }
        }else{
            $list = '';
            $maxpages = 0;
            $total = 0;
            $mails = '';
        }
        $this->set(compact(array('list','maxpages','total','limit','type','date_from','date_to','key','page','mails','sort','u_sort','i_sort','page_s')));
    
        if( $ajax == 1){
            $this->layout = 'admintrator';
            $this->render('all_user');
        }else{
            $this->layout = null;
            $this->render('all_user_ajax');
        }
    }
//    function export_user(){
//        $this->autoRender = FALSE;
//        $this->set('title_for_layout', 'All user');
//        $type = (isset($this->params['url']['type']) && $this->params['url']['type'] != '') ? $this->params['url']['type'] : 4;
//        $key = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : '';
//        $date_from = (isset($this->params['url']['date_from']) && $this->params['url']['date_from'] != '') ? date('Y/m/d 00:00:00', strtotime($this->params['url']['date_from'])) : '';
//        $date_to = (isset($this->params['url']['date_to']) && $this->params['url']['date_to'] != '') ? date('Y/m/d 11:59:59', strtotime($this->params['url']['date_to'])) : '';
//        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 0;
//        $limit = 200;
//        $url = Configure::read('api.api_url').'api/user/readusertoexcel';
//        $header = array(
//            'sessionid:'.CakeSession::read('Auth.User.session_id')
//        );
//         $body = array(
//            "keyword" => $key,
//            "date_from" => $date_from,
//            "date_to" => $date_to,
//            "type" => (int)$type,
//            "start" => 0,
//            "limit" => $limit,
//            "sort" => $sort
//        );
//        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
//        if($result->status  == 'success'){
//            $file = $result->url_excel;
//        }else{
//            $file = '';
//        }
//        return $this->redirect($file);
//    }
    
    function export_user(){
        $this->autoRender = FALSE;
        // get params
        $key = (isset($this->request->data['key']))?$this->request->data['key'] : '';
        $key= trim($key," \t\n\r\0\x0B");
        $date_from = (isset($this->request->data['date_from']) && $this->request->data['date_from'])? date('Y/m/d 00:00:00', strtotime($this->request->data['date_from'])) : '';
        $date_to = (isset($this->request->data['date_to']) && $this->request->data['date_to'])? date('Y/m/d 00:00:00', strtotime($this->request->data['date_to'])) : '';
        $type = (isset($this->request->data['type']))?$this->request->data['type'] : 4;
        $sort = (isset($this->request->data['sort']))?$this->request->data['sort'] : 0;
        $index = (isset($this->request->data['id']))?$this->request->data['id'] : 1;
        $limit = 500;
        $start = ($index - 1) * $limit;
        // call api
        $url = Configure::read('api.api_url').'api/user/readusertoexcel';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $key,
            "date_from" => $date_from,
            "date_to" => $date_to,
            "type" => (int)$type,
            "start" => $start,
            "limit" => $limit,
            "sort" => $sort
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //echo json_encode($body); die();
        if($result && isset($result->url_excel) && $result->url_excel){
            $data['error'] = 0;
            $data['id'] = $index;
            $data['link'] = $result->url_excel;
        }else{
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }

    function sendmail(){
        $this->autoRender = false;
        if($this->request->data){
            // get params
            $to = isset($this->request->data['to'])? trim($this->request->data['to']) : '';
            $cc = isset($this->request->data['cc'])? trim($this->request->data['cc']) : '';
            $bcc = isset($this->request->data['bcc'])? trim($this->request->data['bcc']) : '';
            $subject = isset($this->request->data['subject'])? trim($this->request->data['subject']) : '';
            $content = isset($this->request->data['content'])? trim($this->request->data['content']) : '';
            
            $arrTo = explode(';',  rtrim($to,';'));
            $arrCC = explode(';',  rtrim($cc,';'));
            $arrBCC = explode(';',  rtrim($bcc,';'));
            
            // send email
            if($this->Curl->send_mail_smtp_bcc($arrTo, $arrCC, $arrBCC, $subject, $content)){
                $data['error'] = 0;
            }
            else {
                $data['error'] = 1;
            }
        }
        else {
            $data['error'] = 1;
        }
        
        return json_encode($data);
    }
    
    function inactivate_user(){
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Inactivate Users');
        $key = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : '';
        $key= trim($key," \t\n\r\0\x0B");
        $limit_u = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 0;
        if(isset($this->params['url']['page'])){
            $page = $this->params['url']['page'];
            $page_s = $this->params['url']['page'];
        }else{
            $page = 0;
            $page_s = 1;
        }
        $limit = ($limit_u != '')? $limit_u : 20;
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        if($sort == 1){
            $u_sort = 2;
            $i_sort = 0;
        }else if($sort == 2){
            $u_sort = 1;
            $i_sort = 1;
        }else if($sort == 3){
            $u_sort = 4;
            $i_sort = 0;
        }else if($sort == 4){
            $u_sort = 3;
            $i_sort = 1;
        }else if($sort == 5){
            $u_sort = 6;
            $i_sort = 0;
        }else if($sort == 6){
            $u_sort = 5;
            $i_sort = 1;
        }else if($sort == 7){
            $u_sort = 8;
            $i_sort = 0;
        }else if($sort == 8){
            $u_sort = 7;
            $i_sort = 1;
        }else if($sort == 9){
            $u_sort = 10;
            $i_sort = 0;
        }else if($sort == 10){
            $u_sort = 9;
            $i_sort = 1;
        }else{
            $i_sort = 0;
        }
        $url = Configure::read('api.api_url').'api/user/getinactiveuseradmin';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "keyword" => $key,
            'start' => $start,
            'limit' => $limit,
            'sort' => $sort,
            'time_zones' => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result != null){
            $l = $result->users;
            $total = $result->total;
            $total_ = count($l);
            for($i = 0; $i < $total_ ; $i++){
                $ar[] = $l[$i];
            }
            if(isset($ar)){
                $list = $ar;
                $maxpages = $this->Page($total, $limit);
            }else{
                $list = '';
                $maxpages = 0;
            }
        }else{
            $list = '';
            $maxpages = 0;
            $total = 0;
        }
        $this->set(compact(array('list','maxpages','total','limit','key','page','mails','sort','u_sort','i_sort','page_s')));
    }

    function view_info_user($id = null) {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'User Information');
        //datasource
        //$url_ds = Configure::read('api.api_url').'api/user/getdatasource';
        //$datasource = json_decode($this->CurlApi->to($url_ds)->post())->options;
        
        // call api
        $url = Configure::read('api.api_url').'api/user/viewinforuseradmin';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => $this->Session->read('Auth.User._id'),
            "info_id" => $id
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        if($result != ''){
            $rs = $result->users[0];
        }else{
            $rs = '';
        }

        //return $this->set(compact('rs', 'datasource'));
        return $this->set(compact('rs', 'datasource'));
    }
    function edit_info_user($id = null){
        // post edit data
        if($this->request->data){//debug($this->request->data); die();
            if($this->request->data['license_number'] != ''){
                $license_number = $this->request->data['license_number'];
            }else{
                $license_number = $this->request->data['license_number_new'];
            }
            $url_ud = Configure::read('api.api_url').'api/user/updateuseradmin';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body_ud = array(
                "user_id" => $id,
                "name" => $this->request->data['name'],
                "last_name" => (isset($this->request->data['last_name']))?$this->request->data['last_name']:'',
                "company_name" => $this->request->data['company_name'],
                "company_phone" => (isset($this->request->data['company_phone']))?$this->request->data['company_phone']:'',
                "dealer_solution_number" => (isset($this->request->data['dealer_solution_number']))?$this->request->data['dealer_solution_number']:'',
                "license_number" => (isset($this->request->data['license_number']))?$this->request->data['license_number']:'',
                "easy_car_number" => (isset($this->request->data['easy_car_number']))?$this->request->data['easy_car_number']:'',
                "is_principle" => (isset($this->request->data['is_principle']))?(int)$this->request->data['is_principle']:'0',
                "is_admin" => (isset($this->request->data['is_admin']))?(int)$this->request->data['is_admin']:'0',
                "data_source" => (isset($this->request->data['data_source']))?$this->request->data['data_source']:'',
                "phone" => (isset($this->request->data['phone']))?$this->request->data['phone']:'',
                "email" => (isset($this->request->data['email']))?$this->request->data['email']:'',
                "company_id" => (isset($this->request->data['company_id']))?$this->request->data['company_id']:'',
                "address1" => (isset($this->request->data['address1']))?$this->request->data['address1']:'',
                "address2" => (isset($this->request->data['address2']))?$this->request->data['address2']:'',
                "address3" => (isset($this->request->data['address3']))?$this->request->data['address3']:'',
                "postcode" => (isset($this->request->data['postcode']))?$this->request->data['postcode']:'',
                "suburb" => (isset($this->request->data['suburb']))?$this->request->data['suburb']:'',
                "state" => (isset($this->request->data['postcode']))?$this->request->data['state']:'',
                "country" => (isset($this->request->data['country']))?$this->request->data['country']:'',
                "active_since_date" => (isset($this->request->data['active_since_date']))?$this->request->data['active_since_date']:''
            );
            //debug(json_encode($body_ud)); die();
            $result_ud = json_decode($this->CurlApi->to($url_ud)->withData( json_encode($body_ud))->withOption('HTTPHEADER', $header)->post());
            //debug($result_ud); die();
            if($result_ud && isset($result_ud->status) && $result_ud->status == 'success') {
                $this->Session->setFlash(__('Updated successfully.'));
            } else {
                if ($result_ud && isset($result_ud->code) && $result_ud->code == 205) {
                    $this->Session->setFlash(__('Email already exists in system'));
                }
                else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }
            return $this->redirect('/edit_info_user/'.$id);
        }
        else {
            $this->layout = 'admintrator';
            $this->set('title_for_layout', 'Update User');

            //$url_ds = Configure::read('api.api_url').'api/user/getdatasource';
            //$datasource = json_decode($this->CurlApi->to($url_ds)->post())->options;
            //debug($datasource); die();
            $url = Configure::read('api.api_url').'api/user/viewinforuseradmin';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "user_id" => $this->Session->read('Auth.User._id'),
                "info_id" => $id
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            //debug($result); die();
            if($result != ''){
                $rs = $result->users[0];
            }else{
                $rs = '';
            }
            //debug($rs); die();
            //$this->set(compact('rs', 'datasource'));
            $this->set(compact('rs'));
        }
    }
    function Del_cus() {
        $this->autoRender = false;
        $this->loadModel('Customer');
        $this->Customer->query("delete from customers where full_name like 'Default%'");
        $list = $this->User->find('all');
        foreach ($list as $rs):
            $arr['user_id'] = $rs['User']['id'];
            $arr['full_name'] = 'Default Customer(' . $rs['User']['name'] . ')';
            $arr['email'] = $rs['User']['email'];
            $arr['phone'] = $rs['User']['phone'];
            $arr['is_owner'] = 1;
            $this->Customer->create();
            $this->Customer->save($arr);
        endforeach;
    }

    function activate_user(){
        $this->autoRender = false;
        if($this->request->data){
            $url = Configure::read('api.api_url').'api/user/activeuseradmin';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "user_id" => $this->request->data['id'],
                "is_active" => $this->request->data['active']
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        }
    }

    public function list_register() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Registration page 1');
        $title = 'Registration page 1';
        //get parameter
        $keyword = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : "";
        $keyword=trim($keyword," \t\n\r\0\x0B");
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        // pagination
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 20;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistuserregister';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "start" => $start,
            "limit" => $limit
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($url); debug(json_encode($body)); debug($result); die();
        if ($result && isset($result->list_user) && $result->list_user) {
            $list = $result->list_user;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }
        
        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'title', 'keyword', 'fieldsort', 'sort'));
    }
    
    public function del_user_register() {
        $this->autoRender = FALSE;
        $email = (isset($this->params['url']['email'])) ? $this->params['url']['email'] : '';
        $page = (isset($this->params['url']['page'])) ? $this->params['url']['page'] : '';
        if ($email != '') {
            $url = Configure::read('api.api_url') . 'api/user/removeuserregister';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "email" => $email
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            //debug($header); debug($result); die();
            if ($result->status == 'success') {
                $this->Session->setFlash('Deleted successfully');
            } else {
                $this->Session->setFlash('Deleted not successfully');
            }
        } else {
            $this->Session->setFlash('Deleted not successfully');
        }
        
        return $this->redirect('/list_register?page=' . $page);
    }

    function view_os(){
        $this->layout = 'admintrator';
        $os = $this->params['url']['os'];
        $codis = array();
        $title = '';
        if($os == 0){
            $codis['os'] = 0;
            $title = 'IOS';
        }else if($os == 1){
            $codis['os'] = 1;
            $title = 'Android';
        }else{
            $codis['os'] = 2;
            $title = 'Web';
        }
        $this->set('title_for_layout','History logged '.$title);
        $limit_u = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : '';
        if(isset($this->params['url']['page'])){
            $page = $this->params['url']['page'];
        }else{
            $page = 0;
        }
        $limit = ($limit_u != '')? $limit_u : 20;
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        $url = Configure::read('api.api_url').'api/user/gethistorybyosadmin';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );
        
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            'os' => (int)$os,
            'start' => $start,
            "limit" => $limit
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result != null){
            $l = $result->users;
            $total = $result->total;
            $total_ = count($l);
            for($i = 0; $i < $total_ ; $i++){
                $ar[] = $l[$i];
            }
            if(isset($ar)){
                $list = $ar;
                $maxpages = $this->Page($total, $limit);
            }else{
                $list = '';
                $maxpages = 0;
            }
        }else{
            $list = '';
            $maxpages = 0;
            $total = 0;
        }
        $this->set(compact(array('list','maxpages','total','limit','os')));
    }
    public function Page($total,$limit){
        if($total % $limit != 0){
            if($total / $limit > round($total / $limit)){
                return round($total / $limit) + 1;
            }else{
                return round($total / $limit);
            }

        }else{
            return $total / $limit;
        }
    }
    public function getlistmailuser(){
        $this->autoRender = false;
        if ($this->request->data) {
            $url = Configure::read('api.api_url').'api/user/getallemailofuser';
            $header = array(
                'sessionid:'.CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "keyword" => $this->request->data['key'],
                "date_from" => $this->request->data['date_from'],
                "date_to" => $this->request->data['date_to'],
                "type" => $this->request->data['type']
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            //die(json_encode($result));
            if($result->status == "success"){
                $to = isset($result->pulse_report[0])? $result->pulse_report[0] : '';
                $cc = '';
                $bcc = '';
                if (sizeof($result->pulse_report) > 1) {
                    for($i = 1; $i < sizeof($result->pulse_report); $i++) {
                        $bcc .= $result->pulse_report[$i].';';
                    }
                }
                
                $data['error'] = 0;
                $data['to'] = $to;
                $data['cc'] = $cc;
                $data['bcc'] = $bcc;
            }
            else {
                $data['error'] = 1;
            }
        }
        else {
            $data['error'] = 1;
        }
        
        echo json_encode($data);
    }
    
    public function dealer_message() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Dealer Messages');
        $title = 'Dealer Message';
        //get parameter
        $keyword = (isset($this->params['url']['key'])) ? trim($this->params['url']['key']) : "";
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        // pagination
        $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 20;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getlistcontactus';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "keyword" => $keyword,
            "start" => $start,
            "limit" => $limit,
            'time_zones' => $this->Session->read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($url); debug(json_encode($body)); debug($result); die();
        
        if ($result && isset($result->contact_list) && $result->contact_list) {
            $list = $result->contact_list;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }

        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'title', 'keyword', 'fieldsort', 'sort'));
    }

    public function del_dealer_message() {
        $this->autoRender = FALSE;
        $id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
        $page = (isset($this->params['url']['page'])) ? $this->params['url']['page'] : '';
        if ($id != '') {
            $url = Configure::read('api.api_url') . 'api/user/removecontactus';
            $header = array(
                'sessionid:' . CakeSession::read('Auth.User.session_id')
            );
            $body = array(
                "contact_id" => $id
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            //debug($header); debug($result); die();
            if ($result && isset($result->status) && $result->status == 'success') {
                $this->Session->setFlash('Deleted successfully');
            } else {
                $this->Session->setFlash('Deleted not successfully');
            }
        } else {
            $this->Session->setFlash('Deleted not successfully');
        }
        
        return $this->redirect('/users/dealer_message?page=' . $page);
    }
    
    public function reply_dealer_message() {
        $this->autoRender = false;
        $this->layout = null;
        if(isset($this->request->data)){
            $email = $this->request->data['email'];
            $content = $this->request->data['content'];
            $subject = '[CARZAPP] Reply from Admin';

            if($this->Curl->mail_smtp($email, $subject, $content)){
                return json_encode(['error' => 0]);
            }
            else {
                return json_encode(['error' => 1, 'msg' => 'Failure']);
            }
        }else{
            return json_encode(['error' => 1, 'msg' => 'Not post parameters']);
        }
    }

}
