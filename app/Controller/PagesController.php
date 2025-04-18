<?php
App::uses('AppController', 'Controller');
App::uses('StringAction', 'Lib');
App::import('Vendor', 'phpmailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php'));
Configure::load('api');
class PagesController extends AppController {
	public $uses = array();
        public $helpers = array('Layout');
        public $components = array('Paginator','Curl','CurlApi');
        public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array(
                'aboutus',
                'contact',
                'privacypolicy',
                'support',
                'supportv212',
                'supportv220',
                'term',
                'index_current',
                'forgot_password',
                'ajax_forgot',
                'regis_brochure',
                'emailverificationlink',
                'verifychangingemail',
                'sendcontactajax'
            ));
        }
        public function index(){
            if ($this->Auth->login()) {
                if (CakeSession::read('Auth.User.is_admin')) {
                    return $this->redirect('/list_regis_brochures');
                }

                return $this->redirect('/home');
            }
            $this->set('title_for_layout','CarZapp');
            $this->layout = 'cooming_soon';
            $messages = '';
            $this->set(compact('CarZapp','messages'));
        }
        public function emailverificationlink(){
            $this->set('title_for_layout','Verification');
            $this->layout = 'skin';
            
            $userid = $this->params['url']['userid'];
            $url = Configure::read('api.api_url').'api/user/changeUserStatus?userid='.$userid.'&status=2';
            json_decode($this->CurlApi->to($url)->get());
        }
        
        public function verifychangingemail(){
            $this->set('title_for_layout','Verification');
            $this->set('title_for_layout','Verification');
            $userid = $this->params['url']['userid'];
            $url = Configure::read('api.api_url').'api/user/changeUserStatus?userid='.$userid.'&status=1';
            json_decode($this->CurlApi->to($url)->get());
        }
        public function regis_brochure(){
            $this->autoRender = false;
            $this->layout = null;
            if(isset($this->request->data)){
                $email = $this->request->data['email'];
                $f_name = $this->request->data['first_name'];
                $l_name = $this->request->data['last_name'];
                $name = $f_name.' '.$l_name;
                $subject = 'CarZapp';
                $content = 'Dear: '.$name.'<br /><br /><br />';
                $content .= 'Thank you for registering on our website to receive a copy of <a href="www.carzapp.com.au/files/CarZapp_Brochure.pdf"> <b>the CarZapp brochure.</b></a> <br /><br /><br />';
                $content .= 'Please find enclosed a link to download the brochure in PDF format.<br /><br /><br />';
                $content .= 'Thank you <br />';
                $content .= 'Kind regards <br /><br /><br />';
                $content .= 'CarZapp team.';
                if($this->Curl->send_mail_smtp($email,$subject,$content)){
                    $subject_ad = 'Brochure Download Alert';
                    $content_ad = 'Hi,<br /><br />';
                    $content_ad .= 'Please note that a brochure has been downloaded from the carzappp website by :<br />';
                    $content_ad .= 'Name : '.$name.'<br />';
                    $content_ad .= 'Dealership : <br />';
                    $content_ad .= 'Email : '.$email.'<br />';
                    $content_ad .= 'Thank you <br /><br />';
                    $content_ad .= 'CarZapp Website';
                    $this->Curl->mail_smtp('admin@carzapp.com.au',$subject_ad,$content_ad);

                    $url = Configure::read('api.api_url').'api/user/addregisbrochure';
                    $body = array(
                        "first_name" => trim($this->request->data['first_name']),
                        "last_name" => trim($this->request->data['last_name']),
                        "email" => $this->request->data['email'],
                        "messages" => $this->request->data['messages'],
                        "create_date" => date('Y-m-d H:i:s',time())
                    );
                    $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body) )->post());
                    if($result->status == 'success'){

                    }else{
                        $this->Session->setFlash(__('Error.'));
                    }
                    
                }
            }else{
                $this->Session->setFlash(__('ERROR.'));    
            }
        }
       
        public function index_current(){
            if($this->Session->read('Auth.User.is_admin')){
                return $this->redirect('/list_regis_brochures');
            }
            
            if($this->Session->read('Auth.User.id')){
                return $this->redirect('/home');
            }
            
            
            $this->layout = 'effect';
            
            $this->set('title_for_layout','CarZapp');

        }
        
        public function aboutus(){
            $this->set('title_for_layout','About Us');
        }
        
        public function contact(){
            $this->set('title_for_layout','Contact');
        }
        
        public function sendcontactajax(){
            $this->autoRender = false;
            $this->layout = null;
            
            if($this->request->data){
                $url = Configure::read('api.api_url') . 'api/user/addcontactus';
                $body = array(
                    "name" => $this->request->data['name'],
                    "email" => $this->request->data['email'],
                    "phone" => isset($this->request->data['phone'])? $this->request->data['phone'] : '',
                    "content" => $this->request->data['content']
                );
                $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->post());
                
                if($result && isset($result->status) && $result->status == 'success'){
                    $data['error'] = 0;
                }else {
                    $data['error'] = 1;
                }
                
                echo json_encode($data);die();
            }
        }
        
        public function privacypolicy(){
            $this->set('title_for_layout','Privacy Policy');
        }
        public function supportv220(){
            $this->set('title_for_layout','Support');
        }
        public function support(){
            $this->set('title_for_layout','Support');
        }
        public function supportv212(){
            $this->set('title_for_layout','Support');
        }
        public function forgot_password(){
            $this->layout = 'skin';
            
            if($this->request->data){
                $url = Configure::read('api.api_url') . 'api/user/changepasswordforgot';
                $body = array(
                    "email" => $this->request->data['email'],
                    "new_password" => $this->request->data['password']
                );
                $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->post());

                if($result->status == 'success'){
                    $this->set('type', 666);//Successfully
                }else {
                   $this->set('type', 3);
                }
            }
            else {
                if(!isset($this->params['url']['email']) || !isset($this->params['url']['secretstring'])){
                    $this->set('title_for_layout','');
                    $this->set('email', '');
                    $this->set('secretstring','');
                    die();
                } else {
                    // check data
                    $url = Configure::read('api.api_url') . 'api/user/checkforgotpassword';
                    $body = array(
                        "email" => $this->params['url']['email'],
                        "secretstring" => $this->params['url']['secretstring']
                    );
                    $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->post());
                    if($result->status){
                        $this->set('type', 555);
                    }
                    else {
                        $this->set('type',$result->type);
                    }
                }
            }
            $this->set('title_for_layout','Forgot Password');
            $this->set('email',$this->params['url']['email']);
            $this->set('secretstring',$this->params['url']['secretstring']);
        }

        public function ajax_forgot(){
            $this->autoRender = false;
            if($this->request->data){
                $url = Configure::read('api.api_url').'api/user/forgotpassword?email='.$this->request->data['email'];
                $header = array(
                    'userid:'.$this->Session->read('Auth.User._id'),
                    'sessionid:'.$this->Session->read('Auth.User.session_id')
                );
                $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
                if($result->status == 'success'){
                    $data['error'] = 0;
                    $data['msg'] = 'Please check your email!';
                }else{
                    if (isset($result->code) && $result->code == 201) {
                        $data['error'] = 1;
                        $data['msg'] = 'Email does not exists in the system';
                    }
                    else {
                        $data['error'] = 1;
                        $data['msg'] = 'Error';
                    }
                }
            }else{
                $data['error'] = 1;
                $data['msg'] = 'Please enter your email';
            }

            echo json_encode($data);
        }
        
        public function term(){
            $this->set('title_for_layout','Terms and Conditions');
            
        }
        function home_login(){
            $this->layout = 'cz_home';
            $this->set('title_for_layout', 'Dashboard');
            $this->set('wailLoadFull', true);
            
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            
            // get cars slide
            $urlGetCars = Configure::read('api.api_url') . 'api/user/getflicarrloadmorenewversion';
            $bodyGetCars = [
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
                'limit' => 20
            ];
            $resultGetCars = json_decode($this->CurlApi->to($urlGetCars)->withData(json_encode($bodyGetCars))->withOption('HTTPHEADER', $header)->post());
            if ($resultGetCars && isset($resultGetCars->cars) && $resultGetCars->cars) {
                $listcars = $resultGetCars->cars;
            }
            else {
                $listcars = '';
            }
            
            // get info data
            $url = Configure::read('api.api_url').'api/user/getwelcomeinfornewversion';
            $body = array(
                'user_id' => $this->Session->read('Auth.User._id')
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if($result->status == 'success'){
                $info = $result->infor;
            }else{
                echo "<script>";
                echo "alert('Your session has expired, Please log in again','Messages');";
                echo "window.location.href = 'logout'; ";
                echo "</script>";
            }
            $post = array(
                "user_id" => $this->Session->Read("Auth.User.id"),
                "type" => 0
            );
            
            $cars_follow = $info->cars_follow;
            $cars_sold = $info->cars_sold;
            $cars_set_and_forget = $info->cars_set_and_forget;
            $my_stock = $info->network_cars->count;
            $customer_count = $info->customer_count;
            $network_cars = $info->dealers_count;  
            $count_pulse = $info->count_pulse;
            $count_offer = $info->count_offer;

            $this->set(compact('breadcrumb', 'listcars','cars_follow','cars_sold','cars_set_and_forget','network_cars','customer_count','count_pulse','my_stock', 'count_offer'));
        }
        

        public function display() {
            $title_for_layout = 'Carzapp';
            $path = func_get_args();

            $count = count($path);
            if (!$count) {
                    return $this->redirect('/');
            }
            $page = $subpage = $title_for_layout = null;

            if (!empty($path[0])) {
                    $page = $path[0];
            }
            if (!empty($path[1])) {
                    $subpage = $path[1];
            }
            if (!empty($path[$count - 1])) {
                    $title_for_layout = Inflector::humanize($path[$count - 1]);
            }
            $this->set(compact('page', 'subpage', 'title_for_layout'));

            try {
                    $this->render(implode('/', $path));
            } catch (MissingViewException $e) {
                if (Configure::read('debug')) {
                    throw $e;
                }
                throw new NotFoundException();
            }
	}
        public function invite_dealer(){
            $helpers = array('Common');
            $this->set('title_for_layout', 'Invite a Dealer');
            $this->set('breadcrumb', [
                    (object) ['title' => 'Home'], 
                    (object) ['title' => 'Invite a Dealer', 'active' => true]
            ]);
            $this->layout = 'cz_home';
        }
        
        public function invite_dealer_sent() {
            $helpers = array('Common');
            $this->set('title_for_layout', 'Invitations sent');
            $this->set('breadcrumb', [
                    (object) ['title' => 'Home'], 
                    (object) ['title' => 'Invite a Dealer', 'active' => true]
            ]);
            $this->layout = 'cz_home';
        }

        public function ajaxsendinvitedealer() {
            $this->autoRender = false;
            $this->layout = null;
            if(isset($this->request->data)){
                $email = $this->request->data['email'];
                $subject = '[CARZAPP] Invitation from ' . CakeSession::read('Auth.User.name');
                $content = '<p style="margin-bottom: 5px;">' . CakeSession::read('Auth.User.name') . ' has invited you to join the CarZapp dealer network.</p><br/>
                                <p style="text-indent: 10px;">- Connect with Dealers</p>
                                <p style="text-indent: 10px;">- Buy and Sell Cars Fast</p>
                                <p style="text-indent: 10px; margin-bottom: 5px;">- Grow Your Network</p><br/>
                                <p style="margin-bottom: 5px;">Please download the app by clicking on one of these links to proceed:</p><br/>
                                <p style="margin-bottom: 5px; color:blue;">iOS - <a href="https://appsto.re/au/iJXK9.i">https://appsto.re/au/iJXK9.i</a></p><br/>
                                <p style="margin-bottom: 8px; color:blue;">Android - <a href=" https://play.google.com/store/apps/details?id=com.carzapp.australia">https://play.google.com/store/apps/details?id=com.carzapp.australia</a></p><br/>
                                <p>The CarZapp Team.</p>';
                
                if($this->Curl->mail_smtp($email, $subject, $content)){
                    return $this->redirect('/invite_dealer_sent');
                }
                else {
                    $this->Session->setFlash('Failure!', 'flash_custom', array('type'=>1));
                    return $this->redirect('/invite_dealer');
                }
            }else{
                $this->Session->setFlash('Failure!', 'flash_custom', array('type'=>1));
                return $this->redirect('/invite_dealer');
            }
        }
        
        public function ajaxsendmail() {
            $this->autoRender = false;
            $this->layout = null;
            if(isset($this->request->data)){
                $email = $this->request->data['email'];
                $subject = $this->request->data['subject'];
                $content = $this->request->data['content'];
                
                if($this->Curl->mail_smtp($email, $subject, $content)){
                    return json_encode(['error' => 0]);
                }
                else {
                    return json_encode(['error' => 1]);
                }
            }else{
                return json_encode(['error' => 1]);
            }
        }
        
        public function list_regis_brochures(){
            $this->layout = 'admintrator';
            $this->set('title_for_layout','List regis brochures');
            $this->loadModel('Regisbrochure');
            $this->Regisbrochure->recursive = 0;
            $this->Paginator->settings = array(
                'recursive' => 1,
                'limit' => 1,
                'maxLimit' => 100,
                'order' => 'Regisbrochure.id DESC'
            );
            $this->set('regisbrochures', $this->Paginator->paginate('Regisbrochure'));
        }

        public function del_regis_brochure(){
            $this->autoRender = FALSE;
            $id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
            $page = (isset($this->params['url']['page'])) ? $this->params['url']['page'] : '';
            if($id != ''){
                $url = Configure::read('api.api_url').'api/user/delregisbrochure';
                $header = array(
                    'sessionid:'.CakeSession::read('Auth.User.session_id')
                );

                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    'register_id' => $id,
                );
                $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
   
                if($result->status == 'success'){
                    $this->Session->setFlash('Deleted successfully');
                }else{
                    $this->Session->setFlash('Deleted not successfully');
                }
                
            }else{
                $this->Session->setFlash('Deleted not successfully');
            }
            return $this->redirect('/list_regis_brochures?page='.$page);
        }
        public function del_regis_brochure_search(){
            $this->autoRender = FALSE;
            $id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
            $page = (isset($this->params['url']['page'])) ? $this->params['url']['page'] : '';
            $key = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : '';
            $date_from = (isset($this->params['url']['date_from'])) ? $this->params['url']['date_from'] : '';
            $date_to = (isset($this->params['url']['date_from'])) ? $this->params['url']['date_to'] : '';
            $limit = (isset($this->params['url']['limit'])) ? $this->params['url']['limit'] : '';
            if($id != ''){
                $url = Configure::read('api.api_url').'api/user/delregisbrochure';
                $header = array(
                    'sessionid:'.CakeSession::read('Auth.User.session_id')
                );

                $body = array(
                    "user_id" => CakeSession::read('Auth.User._id'),
                    'register_id' => $id,
                );
                $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
   
                if($result->status == 'success'){
                    $this->Session->setFlash('Deleted successfully');
                }else{
                    $this->Session->setFlash('Deleted not successfully');
                }
                
            }else{
                $this->Session->setFlash('Deleted not successfully');
            }
            return $this->redirect('/result_search_brochures?key='.$key.'&date_from='.$date_from.'&date_to='.$date_to.'&limit='.$limit.'&page='.$page);
        }
         public function updateanalyticsviewscreenbysession(){
             $this->autoRender = FALSE;;
             $this->layout = null;
             //get params
             $new_analytics_session_id = isset($this->request->data['new_analytics_session_id']) && $this->request->data['new_analytics_session_id'] ? $this->request->data['new_analytics_session_id'] : '';
             $keyscreen = isset($this->request->data['keyscreen']) && $this->request->data['keyscreen'] ? $this->request->data['keyscreen'] : '';
             //call api UpdateAnalyticsViewScreenBySession
             $url_4 = Configure::read('api.api_url').'api/user/updateanalyticsviewscreenbysession';
             $header_4 = array(
                 'userid:'.$this->Session->read('Auth.User._id'),
                 'sessionid:'.$this->Session->read('Auth.User.session_id')
             );
             $body_4 = array(
                 "analytics_session_id" => $this->Session->read('new_analytics_session_id'),
                 "keyscreen" => $keyscreen
             );
             $result_count_screen = json_decode($this->CurlApi->to($url_4)->withData(json_encode($body_4))->withOption('HTTPHEADER', $header_4)->post());
            if($result_count_screen->status == 'success'){
                $data['error'] = 0;
            }else{
                $data['error'] = 1;
            }
            return json_encode($data);
         }
}
