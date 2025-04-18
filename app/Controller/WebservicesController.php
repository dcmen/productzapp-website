<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
App::import('Core', 'HttpSocket'); // Cake 1.x
App::uses('HttpSocket', 'Network/Http'); // Cake 2.x
require_once('/mail.utils/class.phpmailer.php');
require '/GCM.php';
class WebservicesController extends AppController {
	
	public $user_id = '';
	public $uses = array();
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array(
                'index',
                'login',
                'register',
                'getSearchByVin',
                'getMakeForSetForget',
                'getSeriesModelByMakeForSetForget',
                'editComment',
                'searchSetForGet',
                'getWellcomeInfor',
                'searchCar',
                'getComment',
                'getManageCurrent',
                'setAndForget',
                'updateSetAndForget',
                'deleteSetandForget',
                'addCar',
                'uploadImagesCar',
                'uploadVideoCar',
                'dataSearch',
                'getMyStock',
                'addComment',
                'deleteMyStock',
                'getOtherStock',
                'followCar',
                'unfollowCar',
                'addNetwork',
                'removeNetwork',
                'getFollowed',
                'getMyNetwork',
                'getStockNetwork',
                'getCarByType',
                'updateCarType',
                'getFlicarr',
				'getFlicarrLoadMore',
                'getVins',
                'addCustomer',
                'updateCustomer',
                'getCustomer',
                'deleteCustomer',
                'createTransaction',
                'cancelTransaction',
                'acceptTransaction',
                'getTransaction',
                'deleteHistory',
                'convertToTz',
                'copyCustomer',
                'getModelByMakeForCarSale',
                'getSeriesByMakeModelForCarSale',
                'editNotes',
                'addNotes',
                'getNotes',
                'getCarById',
                'addAppChat',
                'removeAppChat',
                'getAppChat',
                'RegisterPushNotification',
                'pushNo',
                'sendMailInvite',
                'sendMail',
                'InviteNetwork',
                'getInviteNetwork',
                'AcceptInviteNetwork',
                'CancelInviteNetwork',
                'searchCarDealer',
                'blockNetwork',
                'unLockNetwork',
                'getDealersSameCompany',
                'removeGCM',
                'TransferCar',
                'acceptTransferCar',
                'getTransfer',
                'cancelTransferCar',
                'checkDeviceID',
                'addDeviceID',
                'forgotPassword',
                'getTransactionCount',
				'getViewCount',
				'addViewCount',
				'checkRegisterInfor',
				'checkCarzappCode',
				'getProfile',
				'lengText',
				'editProfile',
				'getListFollow',
				'sendMailToBcc',
				'getMenuCountNumbers',
				'testQuery',
				'getNotificationSetting',
				'changeNotify',
				'getMyStockNewVersion',
				'getOtherInforFromCar',
				'searchCarNewVersion',
				'getOtherStockNewVersion',
				'getWellcomeInforNewVersion',
				'getFlicarrLoadMoreNewVersion'
            ));
      }
	
	public function index(){
		$this->autoRender = false;
		echo "service";
	}	
		
	public function testQuery(){ 
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Transfer')));
		$car_query = $this->Car->find('all', array('conditions' => array('Car.client_no' => '3')));
		//return json_decode($car_query);  
		var_dump($car_query);
	}
		
	public function login(){
		$this->autoRender = false;
		$this->loadModel('User');
		$this->loadModel('DataSourceCar');
		$user_infor = $this->User->find('first', array('recursive' => -1, 
            'conditions' => array('User.email' => $this->request->data['email'], 'User.encrypted_password' => md5($this->request->data['password']))));
		if($user_infor){
			$result = array();  
			$result['id'] = $user_infor['User']['id'];
			$result['name'] = $user_infor['User']['name'];
			$result['token'] = $user_infor['User']['authentication_token'];
			$result['email'] = $user_infor['User']['email'];
			$result['phone'] = $user_infor['User']['phone'];
			$result['company_name'] = $user_infor['User']['company_name'];
			$result['dealer_solution_number'] = $user_infor['User']['dealer_solution_number'];
			$result['avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user_infor['User']['avatar_file_name'];
			$result['company_phone'] = $user_infor['User']['company_phone'];
			$result['register_at'] = $user_infor['User']['current_sign_in_at'];
			$result['sign_in_count'] = 0;
			$result['current_sign_in_at'] = 0; 
			$result['cars_sold'] = 0; 
			$result['cars_follow'] = 0;
			$result['cars_set_and_forget'] = 0;
			$result['unread_conversations'] = 0;
			$result['dealers_count'] = 0;
			$result['network_cars'] = 0;
			//get data source
			$arr_code = json_decode($user_infor['User']['data_source']); 
			$data_source = array();
			if(sizeof($arr_code)){
				foreach($arr_code as $a_arr_code){
					$data_source = $this->DataSourceCar->find('first', array('recursive' => -1, 'conditions' => array('DataSourceCar.id' => $a_arr_code)));
					if($data_source){
						$data_source[] = $data_source['DataSourceCar'];
					}
				}
			}
			$result['data_source'] = $data_source;
            return json_encode(array("status" => 'success', 'info' => $result));
		}else{
			$user_email = $this->User->find('first', array('recursive' => -1, 
            'conditions' => array('User.email' => $this->request->data['email'])));
			if(!$user_email){
				 return json_encode(array("status" => 'fail', 'response' => "Email / password combination is not recognised. Please try again or click \"Forgot password\""));
			}else{
				 return json_encode(array("status" => 'fail', 'response' => "Email / password combination is not recognised. Please try again or click \"Forgot password\""));
			}
		}
	}
	
	public function register(){
		$this->autoRender = false;
		$this->loadModel('User');
		$this->loadModel('Customer');
		$this->loadModel('DataSourceCar');
		if (!isset($this->request->data['email'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post email', 'code' => '202')));
		}
		if (!isset($this->request->data['phone'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post phone','code' => '202')));
		}
		if (!isset($this->request->data['name'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post name','code' => '202')));
		}
		if (!isset($this->request->data['last_name'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not last name','code' => '202')));
		}
		if (!isset($this->request->data['company_name'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post company name','code' => '202')));
		}
		//if (!isset($this->request->data['company_phone'])){
		//	die(json_encode(array('status' => 'fail', 'response' => 'Not post company phone','code' => '202')));
		//}
		
		if (!isset($this->request->data['password'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post password','code' => '202')));
		}
		if (!isset($this->request->data['image'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post image','code' => '202')));
		}
		if(!isset($this->request->data['license_number'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post license number','code' => '202')));
		}
		if(!isset($this->request->data['data_source'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post data source','code' => '202')));
		}
		if(!isset($this->request->data['is_principle'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post is principle','code' => '202')));
		}
		/*$name_existed = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.name' => $this->request->data['name'])));
		if($name_existed){
			die(json_encode(array('status' => 'Fail', 'response' => 'This Username is currently in use. ', 'code'=> '101')));
		}*/
		
		$email_existed = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.email' => $this->request->data['email'])));
		if($email_existed){
			die(json_encode(array('status' => 'Fail', 'response' => 'Email already exists', 'code'=> '102')));
		}
		
		$folder_url = WWW_ROOT . "img/uploads/users_avatar";
		if(!is_dir($folder_url)) {
			mkdir($folder_url, 0777, true);
		}
		
		$img = $this->request->data['image'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file_name = uniqid() . '.png';
		$file_avatar = $folder_url .'/'. $file_name;
		$success = file_put_contents($file_avatar, $data); 
		
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_register['User']['authentication_token'] = md5(uniqid());
		$arr_register['User']['email'] = $this->request->data['email'];
		$arr_register['User']['phone'] = $this->request->data['phone'];
		$arr_register['User']['name'] = $this->request->data['name'];
		$arr_register['User']['last_name'] = $this->request->data['last_name'];
		$arr_register['User']['company_name'] = $this->request->data['company_name'];
		//$arr_register['User']['company_phone'] = $this->request->data['company_phone'];
		//$arr_register['User']['dealer_solution_number'] = $this->request->data['dealer_solution_number'];
		$arr_register['User']['encrypted_password'] = md5($this->request->data['password']);
		$arr_register['User']['avatar_file_name'] = $file_name;
		$arr_register['User']['avatar_updated_at'] = $current_time;
		$arr_register['User']['invitation_created_at'] = $current_time;
		$arr_register['User']['current_sign_in_at'] = $current_time;
		$arr_register['User']['reset_password_sent_at'] = $current_time;
		$arr_register['User']['data_source'] = $this->request->data['data_source'];
		$arr_register['User']['is_principle'] = $this->request->data['is_principle'];
		$arr_register['User']['license_number'] = $this->request->data['license_number'];
		if(isset($this->request->data['easy_car_number'])){
			$arr_register['User']['easy_car_number'] = $this->request->data['easy_car_number'];
		}
		if ($this->User->save($arr_register)) {
			$user_id = $this->User->id;
			//Update carzapp code
			$carzapp_code = 100000 + $user_id;
			$arr_update['User']['carzapp_code'] = $carzapp_code;
			$this->User->id = $user_id;
			if ($this->User->save($arr_update)) {
			}
			//Add default customer
			$array_customer = array();
			$date = new DateTime();
			$current_time = $date->format('Y-m-d H:i:s') ;
			$arr_customer['Customer']['user_id'] = $user_id;
			$arr_customer['Customer']['full_name'] = 'Default Customer'.'('.$arr_register['User']['name'].')';
			$arr_customer['Customer']['phone'] = $arr_register['User']['phone'];
			$arr_customer['Customer']['email'] =$arr_register['User']['email'];
			$arr_customer['Customer']['created_at'] = $current_time;
			$arr_customer['Customer']['updated_at'] = $current_time;
			$array_customer[] = $arr_customer;
			if ($this->Customer->saveAll($array_customer)) {}
			
			$result = array();
			$result['id'] = $user_id;
			$result['name'] = $arr_register['User']['name'];
			$result['last_name'] = $arr_register['User']['last_name'];
			$result['token'] = $arr_register['User']['authentication_token'];
			$result['email'] = $arr_register['User']['email'];
			$result['phone'] = $arr_register['User']['phone'];
			$result['company_name'] = $arr_register['User']['company_name'];
			//$result['dealer_solution_number'] = $arr_register['User']['dealer_solution_number'];
			$result['avatar'] = '/app/webroot/img/uploads/users_avatar/' . $file_name;
			//$result['company_phone'] = $arr_register['User']['company_phone'];
			$result['register_at'] = $current_time;
			$result['sign_in_count'] = 0;
			$result['current_sign_in_at'] = 0;
			$result['cars_sold'] = 0;
			$result['cars_follow'] = 0;
			$result['cars_set_and_forget'] = 0;
			$result['unread_conversations'] = 0;
			$result['dealers_count'] = 0;
			$result['network_cars'] = 0; 
			$result['carzapp_code'] = $carzapp_code;
			$result['is_principle'] = $arr_register['User']['is_principle'];
			$result['license_number'] = $arr_register['User']['license_number']; 
			//get data source
			$arr_code = json_decode($this->request->data['data_source']); 
			$data_source = array();
			if(sizeof($arr_code)){
				foreach($arr_code as $a_arr_code){
					$data_source = $this->DataSourceCar->find('first', array('recursive' => -1, 'conditions' => array('DataSourceCar.id' => $a_arr_code)));
					if($data_source){
						$data_source[] = $data_source['DataSourceCar'];
					}
				}
			}
			$result['data_source'] = $data_source;
            return json_encode(array("status" => 'success', 'info' => $result));
        } else{
			return json_encode(array("status" => 'fail', 'response' => "Fail register"));
		}
	}
	
	public function getSearchByVin(){
		$this->autoRender = false;
		$sURL = "http://ppsr.identicar.com.au/api/search/vininc/" . $this->request->data['vin'];
		$aHTTP['http']['method']  = 'POST';
		$aHTTP['http']['header']  = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
		$aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
		$context = stream_context_create($aHTTP);
		$contents = file_get_contents($sURL, false, $context);
		return $contents;
	}
	
	public function getMakeForSetForget(){
		$this->autoRender = false;
		 $sURL = "http://ppsr.identicar.com.au/api/list/makes";
		$aHTTP['http']['method']  = 'POST';
		$aHTTP['http']['header']  = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
		$aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
		$context = stream_context_create($aHTTP);
		$contents = file_get_contents($sURL, false, $context);
		return $contents;
	}
	
	public function getSeriesModelByMakeForSetForget(){
		$this->autoRender = false;
		//$sURL = "http://ppsr.identicar.com.au/api/search/make/".$this->request->data['make'];
		$sURL = "http://ppsr.identicar.com.au/api/search/make/". str_replace(" ", '%20', $this->request->data['make']);
		$aHTTP['http']['method']  = 'POST';
		$aHTTP['http']['header']  = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
		$aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
		$context = stream_context_create($aHTTP);
		$contents = file_get_contents($sURL, false, $context);
		return $contents;
	}
	
	public function editComment(){
	$this->autoRender = false;
		$this->loadModel('Car');
		if (!isset($this->request->data['comments'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post comments','code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		
		$my_car = $this->Car->find('first',array('recursive' => -1, 'conditions'=> array('Car.id' => $this->request->data['car_id'], 'Car.client_no' => $this->request->data['user_id'])));
		if($my_car){
			//$date = new DateTime();
			//$current_time = $date->format('Y-m-d H:i:s') ;
			//$arr_update['Car']['updated_at'] = $current_time;
			$arr_update['Car']['comments'] = $this->request->data['comments'];
			$this->Car->id = $this->request->data['car_id'];
			$this->Car->client_no = $this->request->data['user_id'];
			if ($this->Car->save($arr_update)) {
				die(json_encode(array('status' => 'success')));
			}else{
				die(json_encode(array('status' => 'fail', 'response' => 'This car is not belong to you')));
			}
		}else{
			die(json_encode(array('status' => 'fail', 'response' => 'This car is not belong to you')));
		}
		
	}
	public function lengText(){
		$this->autoRender = false;
		$str = "DangCongMen";
		echo substr($str,0,5); 
		echo strlen($str);
		$date = new DateTime();
		$current_time = $date->format('Y-M-d H:i:s') ;
		echo $current_time;
	}
	public function searchSetForGet(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		if($this->request->data['user_id'] == 154){
			$result_return['status'] = 'false';
			$result_return['cars'] = array();
			echo json_encode($result_return);
		}
		$where = array();
		$where_keyword = array();
		if (isset($this->request->data['keyword']) && !empty($this->request->data['keyword'])){
			$keyword = $this->request->data['keyword'];
			$where_keyword = array(
				array('Car.make like ' => '%'.$keyword.'%'),
				array('Car.series like ' => '%'.$keyword.'%'),
				array('Car.model like ' => '%'.$keyword.'%'),
				array('Car.price like ' => '%'.$keyword.'%'),
				array('Car.gearbox like ' => '%'.$keyword.'%'),
				array('Car.body_colour like ' => '%'.$keyword.'%'),
				array('Car.body like ' => '%'.$keyword.'%'),
				array('Car.location like ' => '%'.$keyword.'%'),
				array('Car.drive_type like ' => '%'.$keyword.'%'),
				array('Car.fuel_type like ' => '%'.$keyword.'%'),
				array('Car.seats like ' => '%'.$keyword.'%'),
				array('Car.odometer like ' => '%'.$keyword.'%'),
				array('Car.manu_year like ' => '%'.$keyword.'%'));
		}
		if ((isset($this->request->data['make']) && isset($this->request->data['series'])) || (isset($this->request->data['make']) && isset($this->request->data['model']))){
		}else{
			if (isset($this->request->data['make']) && !empty($this->request->data['make'])){
			$where['Car.make'] = $this->request->data['make'];
			}
			if (isset($this->request->data['series']) && !empty($this->request->data['series'])){
				$where['Car.series'] =  $this->request->data['series'];
			}
			if (isset($this->request->data['model']) && !empty($this->request->data['model'])){
				$where['Car.model'] =  $this->request->data['model'];
			}
		}
		if (isset($this->request->data['tranmission']) && !empty($this->request->data['tranmission'])){
			$where['Car.gearbox'] =  $this->request->data['tranmission'];
		}
		
		if (isset($this->request->data['body_colour']) && !empty($this->request->data['body_colour'])){
			$where['Car.body_colour'] =  $this->request->data['body_colour'];
		}
		
		if (isset($this->request->data['body']) && !empty($this->request->data['body'])){
			$where['Car.body'] =  $this->request->data['body'];
		}
		
		if (isset($this->request->data['location']) && empty($this->request->data['location'])){
			$where['Car.location'] =  $this->request->data['location'];
		}
		
		if (isset($this->request->data['drive_type']) && !empty($this->request->data['drive_type'])){
			$where['Car.drive_type'] =  $this->request->data['drive_type'];
		}
		if (isset($this->request->data['fuel_type']) && !empty($this->request->data['fuel_type'])){
			$where['Car.fuel_type'] =  $this->request->data['fuel_type'];
		}
		if (isset($this->request->data['seats']) && !empty($this->request->data['seats'])){
			$where['Car.seats'] =  $this->request->data['seats'];
		}
		if (isset($this->request->data['price_from']) && isset($this->request->data['price_to'])  && !empty($this->request->data['price_from'])  && !empty($this->request->data['price_to'])){
			$where[] = array('Car.price BETWEEN ? AND ?' => array($this->request->data['price_from'], $this->request->data['price_to']));
		}else if(isset($this->request->data['price_from']) && !empty($this->request->data['price_from'])){
			$where[] = array('Car.price >='. $this->request->data['price_from']);
		}else if(isset($this->request->data['price_to']) && !empty($this->request->data['price_to'])){
			$where[] = array('Car.price <='. $this->request->data['price_to']);
		} 
		
		if (isset($this->request->data['kilometer_from']) && isset($this->request->data['kilometer_to'])  && !empty($this->request->data['kilometer_from'])  && !empty($this->request->data['kilometer_to'])){
			$where[] = array('Car.odometer BETWEEN ? AND ?' => array($this->request->data['kilometer_from'], $this->request->data['kilometer_to'])); 
		} else if(isset($this->request->data['kilometer_from']) && !empty($this->request->data['kilometer_from'])){
			$where[] = array('Car.odometer >='. $this->request->data['kilometer_from']);
		}else if(isset($this->request->data['kilometer_to']) && !empty($this->request->data['kilometer_to'])){
			$where[] = array('Car.odometer <='. $this->request->data['kilometer_to']);
		}
		
		if (isset($this->request->data['year_from']) && isset($this->request->data['year_to'])  && !empty($this->request->data['year_from'])  && !empty($this->request->data['year_to'])){
			$where[] = array('Car.manu_year BETWEEN ? AND ?' => array($this->request->data['year_from'], $this->request->data['year_to']));
		}else if(isset($this->request->data['year_from']) && !empty($this->request->data['year_from'])){
			$where[] = array('Car.manu_year >='. $this->request->data['year_from']);
		}else if(isset($this->request->data['year_to']) && !empty($this->request->data['year_to'])){
			$where[] = array('Car.manu_year <='. $this->request->data['year_to']);
		} 
		//Get VIN from identicar
		if ((isset($this->request->data['make']) && isset($this->request->data['series'])) || (isset($this->request->data['make']) && isset($this->request->data['model'])) ){
			$sURL = '';
			if (isset($this->request->data['model'])){
				$sURL = "http://ppsr.identicar.com.au/api/search/model/".$this->request->data['make']."/".$this->request->data['model'];
			}else if(isset($this->request->data['series'])){
				$sURL = "http://ppsr.identicar.com.au/api/search/series/".$this->request->data['make']."/".$this->request->data['series'];
			}
			//if(strlen($sURL) > 0){
				$aHTTP['http']['method']  = 'POST';
				$aHTTP['http']['header']  = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
				$aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
				$context = stream_context_create($aHTTP);
				$contents = file_get_contents($sURL, false, $context);
				$json = json_decode($contents, true);
				//echo $contents;
				$arr_rs = array();
				if($json['success'] == true){
					foreach($json['results'] as $a){
						$arr_rs = array_merge($arr_rs, $a['other_vins']);	
					}
				}
				$arr = array();
				$text_size = 0;
				foreach($arr_rs as $a){
					$str = explode(' ', $a)[0];
					if(strlen($str) > $text_size)$text_size = strlen($str);
					$arr[] = $str;
				}
				if(sizeof($arr) > 0){
					$is_has_data = false;
					for($i=$text_size;$i>0 & !$is_has_data;$i--) {
						$where['substr(Car.vin_number,1,'.$i.')'] =  $arr;
						$result =$this->Car->find('all', array('recursive' => -1, 'conditions' => $where));
						$next_size = $i - 1;
						$j = 0;
						foreach($arr as $a_arr){
							if(strlen($a_arr) > $next_size){
								$arr[$j] = substr($a_arr, 0, $next_size);
							}
							$j++;
						}
						if($result)$is_has_data = true;
					}
					if($result){
					}else{
						return json_encode(array('status' => 'success', 'cars' => array()));
					}
				}else{
					return json_encode(array('status' => 'success', 'cars' => array()));
				}
			//}
		}else{
			if(isset($this->request->data['type']) && $this->request->data['type'] == 0){
				$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('OR' => array($where_keyword, $where), "Car.active = 0")));
			}else{
				$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('OR' => array($where_keyword, $where), "Car.active <> 2")));
			}
		}
		$car = array();
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result){
			foreach ($result as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				} 
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				}
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Check buy-0/sell-1/pending-2
					if($car_result['Car']['transactor_id'] != -1){
						$car_result['Car']['transaction_status'] = 2;
					}else{
						if($car_result['Car']['client_no'] == $this->request->data['user_id']){
							$car_result['Car']['transaction_status'] = 1;
						}else{
							$car_result['Car']['transaction_status'] = 0;
						}
					}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				
				$car[] = $car_result['Car'];
			}
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		}else{
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		} 
		echo json_encode($result_return);
		
	}
	public function searchCarNewVersion(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$where = array();
		$where_keyword = array();
		if($this->request->data['user_id'] == 154){
			$result_return['status'] = 'false';
			$result_return['cars'] = array();
			echo json_encode($result_return);
		}
		
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id', 'code' => '202')));
		}
		if (!isset($this->request->data['start'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post start', 'code' => '202')));
		}
		if (!isset($this->request->data['limit'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post end', 'code' => '202')));
		}
		if (!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type', 'code' => '202')));
		}
		$order_by = ' ';
		if($this->request->data['type'] == 1){
			$order_by = ' ORDER BY C1.price ASC '; 
		}else if($this->request->data['type'] == 2){
			$order_by = ' ORDER BY C1.price DESC ';
		}
		else if($this->request->data['type'] == 3){
			$order_by = ' ORDER BY C1.odometer ASC ';
		}
		else if($this->request->data['type'] == 4){
			$order_by = ' ORDER BY C1.odometer DESC ';
		}
		else if($this->request->data['type'] == 5){
			$order_by = ' ORDER BY C1.manu_year ASC ';
		}else if($this->request->data['type'] == 6){
			$order_by = ' ORDER BY C1.manu_year DESC ';
		}
		else if($this->request->data['type'] == 7){
			 $order_by = ' ORDER BY C1.make DESC, C1.model DESC '; 
		}
		else if($this->request->data['type'] == 8){
			$order_by = ' ORDER BY C1.make ASC, C1.model ASC '; 
		}
		
		$result = array();
		$arr_where = array();
		$query_keyword = "SELECT COUNT(images.id) AS image_count, images.is_server_sdc,
							IF(images.is_server_sdc = 1, '/app/webroot/datafeed/' + images.image_file_name, images.image_file_name) AS image_url, 
							IF(networks.id > 0, 'true', 'false') AS is_network, IF(followed_cars.id > 0, 'true', 'false') AS is_follow, 
							(SELECT COUNT(*) FROM followed_cars F WHERE F.car_id = C1.id) AS view_count, 

							users.`name` AS dealer_name,
							users.email AS dealer_email,
							users.phone AS dealer_phone,
							CONCAT('/app/webroot/img/uploads/users_avatar/', users.avatar_file_name) AS dealer_avatar,
							users.company_name AS dealer_company,

							C1.* 

							FROM cars AS C1 ";
		$query_keyword_total = "SELECT COUNT(C1.id) FROM cars AS C1 ";
		$where_keyword = '';
		$alias = 'C1';
					
		if (isset($this->request->data['make']) && !empty($this->request->data['make'])){
			//$where['Car.make'] = $this->request->data['make'];
			$where_keyword = $where_keyword . $alias .'.make = \''.$this->request->data['make'].'\' AND ';
		}
		if (isset($this->request->data['series']) && !empty($this->request->data['series'])){
			//$where['Car.series'] =  $this->request->data['series'];
			$where_keyword = $where_keyword . $alias .'.series = \''.$this->request->data['series'].'\' AND ';
		}
		if (isset($this->request->data['model']) && !empty($this->request->data['model'])){
			//$where['Car.model'] =  $this->request->data['model'];
			$where_keyword = $where_keyword . $alias .'.model = \''.$this->request->data['model'].'\' AND ';
		}
		
		if (isset($this->request->data['tranmission']) && !empty($this->request->data['tranmission'])){
			//$where['Car.gearbox'] =  $this->request->data['tranmission'];
			$where_keyword = $where_keyword . $alias .'.tranmission = \''.$this->request->data['tranmission'].'\' AND ';
		}
		
		if (isset($this->request->data['body_colour']) && !empty($this->request->data['body_colour'])){
			//$where['Car.body_colour'] =  $this->request->data['body_colour'];
			$where_keyword = $where_keyword . $alias .'.body_colour = \''.$this->request->data['body_colour'].'\' AND ';
		}
		
		if (isset($this->request->data['body']) && !empty($this->request->data['body'])){
			//$where['Car.body'] =  $this->request->data['body'];
			$where_keyword = $where_keyword . $alias .'.body = \''.$this->request->data['body'].'\' AND ';
		}
		
		if (isset($this->request->data['location']) && empty($this->request->data['location'])){
			//$where['Car.location'] =  $this->request->data['location'];
			$where_keyword = $where_keyword . $alias .'.location = \''.$this->request->data['location'].'\' AND ';
		}
		
		if (isset($this->request->data['drive_type']) && !empty($this->request->data['drive_type'])){
			//$where['Car.drive_type'] =  $this->request->data['drive_type'];
			$where_keyword = $where_keyword . $alias .'.drive_type = \''.$this->request->data['drive_type'].'\' AND ';
		}
		if (isset($this->request->data['fuel_type']) && !empty($this->request->data['fuel_type'])){
			//$where['Car.fuel_type'] =  $this->request->data['fuel_type'];
			$where_keyword = $where_keyword . $alias .'.fuel_type = \''.$this->request->data['fuel_type'].'\' AND ';
		}
		if (isset($this->request->data['seats']) && !empty($this->request->data['seats'])){
			//$where['Car.seats'] =  $this->request->data['seats'];
			$where_keyword = $where_keyword . $alias .'.seats = \''.$this->request->data['seats'].'\' AND ';
		} 
		if (isset($this->request->data['price_from']) && isset($this->request->data['price_to'])  && !empty($this->request->data['price_from'])  && !empty($this->request->data['price_to'])){
			//$where[] = array('Car.price BETWEEN ? AND ?' => array($this->request->data['price_from'], $this->request->data['price_to']));
			$where_keyword = $where_keyword . $alias .'.price BETWEEN '.$this->request->data['price_from'].' AND '. $this->request->data['price_to'] .' AND ';
		}else if(isset($this->request->data['price_from']) && !empty($this->request->data['price_from'])){
			//$where[] = array('Car.price >='. $this->request->data['price_from']);
			$where_keyword = $where_keyword . $alias .'.price >= \''.$this->request->data['price_from'].'\' AND ';
		}else if(isset($this->request->data['price_to']) && !empty($this->request->data['price_to'])){
			//$where[] = array('Car.price <='. $this->request->data['price_to']);
			$where_keyword = $where_keyword . $alias .'.price <= \''.$this->request->data['price_to'].'\' AND ';
		} 
		
		if (isset($this->request->data['kilometer_from']) && isset($this->request->data['kilometer_to'])  && !empty($this->request->data['kilometer_from'])  && !empty($this->request->data['kilometer_to'])){
			//$where[] = array('Car.odometer BETWEEN ? AND ?' => array($this->request->data['kilometer_from'], $this->request->data['kilometer_to'])); 
			$where_keyword = $where_keyword . $alias .'.odometer BETWEEN '.$this->request->data['kilometer_from'].' AND '. $this->request->data['kilometer_to'] .' AND ';
		} else if(isset($this->request->data['kilometer_from']) && !empty($this->request->data['kilometer_from'])){
			//$where[] = array('Car.odometer >='. $this->request->data['kilometer_from']);
			$where_keyword = $where_keyword . $alias .'.odometer >= \''.$this->request->data['kilometer_from'].'\' AND ';
		}else if(isset($this->request->data['kilometer_to']) && !empty($this->request->data['kilometer_to'])){
			//$where[] = array('Car.odometer <='. $this->request->data['kilometer_to']);
			$where_keyword = $where_keyword . $alias .'.odometer <= \''.$this->request->data['kilometer_to'].'\' AND ';
		}
		
		if (isset($this->request->data['year_from']) && isset($this->request->data['year_to'])  && !empty($this->request->data['year_from'])  && !empty($this->request->data['year_to'])){
			$where_keyword = $where_keyword . $alias .'.manu_year BETWEEN '.$this->request->data['year_from'].' AND '. $this->request->data['year_to'] .' AND ';
			//$where[] = array('Car.manu_year BETWEEN ? AND ?' => array($this->request->data['year_from'], $this->request->data['year_to']));
		}else if(isset($this->request->data['year_from']) && !empty($this->request->data['year_from'])){
			//$where[] = array('Car.manu_year >='. $this->request->data['year_from']);
			$where_keyword = $where_keyword . $alias .'.manu_year >= \''.$this->request->data['year_from'].'\' AND ';
		}else if(isset($this->request->data['year_to']) && !empty($this->request->data['year_to'])){
			//$where[] = array('Car.manu_year <='. $this->request->data['year_to']);
			$where_keyword = $where_keyword . $alias .'.manu_year <= \''.$this->request->data['year_to'].'\' AND ';
		}
		
		if(strlen($where_keyword)){
			$where_keyword = substr($where_keyword, 0, strlen($where_keyword) - 4);
			$arr_where[] = $where_keyword;
		}
		
		if (isset($this->request->data['keyword']) && !empty($this->request->data['keyword'])){
			$keyword = $this->request->data['keyword'];
				if(sizeof($arr_where) > 0){
				}else{
					$query_keyword = '';
					$query_keyword_total = '';
				}
				
				$arr = array();
				$arr = explode(" ", $keyword);//Alfa Romeo 147 MY2002
				if(sizeof($arr) > 0 && strlen($arr[0]) > 0){ 
					if(sizeof($arr_where) > 0){
						
					}else{
						$query_keyword = "SELECT COUNT(images.id) AS image_count, images.is_server_sdc,
						IF(images.is_server_sdc = 1, '/app/webroot/datafeed/' + images.image_file_name, images.image_file_name) AS image_url, 
						IF(networks.id > 0, 'true', 'false') AS is_network, IF(followed_cars.id > 0, 'true', 'false') AS is_follow, 
						(SELECT COUNT(*) FROM followed_cars F WHERE F.car_id = C1.id) AS view_count, 
						users.`name` AS dealer_name,
						users.email AS dealer_email,
						users.phone AS dealer_phone,
						CONCAT('/app/webroot/img/uploads/users_avatar/', users.avatar_file_name) AS dealer_avatar,
						users.company_name AS dealer_company,
						C1.* 
						FROM cars AS C1 "; 
						
						$query_keyword_total = "SELECT COUNT(C1.id) FROM cars AS C1 ";
						
						$field1 = $arr[0];
						array_splice($arr, 0, 1);
						$where_keyword = '';
						$alias = 'C1';
						$where_keyword = $where_keyword . $alias .'.make like \''.'%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.series like \''.'%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.model like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.price like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.gearbox like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.body_colour like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.body like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.location like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.drive_type like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.fuel_type like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.seats like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.odometer like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.manu_year like \'' . '%'.$field1.'%\'';
						$arr_where[] = $where_keyword;
					}
					$i = 2;  
					foreach($arr as $a_arr){
						$where_keyword = '';
						$alias = 'C'.$i;
						$query_keyword = $query_keyword . "INNER JOIN cars " . $alias . " ON " . $alias . ".id = " . 'C'.($i-1) .".id ";
						$query_keyword_total = $query_keyword_total . "INNER JOIN cars " . $alias . " ON " . $alias . ".id = " . 'C'.($i-1) .".id ";
						 
						$where_keyword = $where_keyword . $alias .'.make like \''.'%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.series like \''.'%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.model like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.price like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.gearbox like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.body_colour like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.body like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.location like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.drive_type like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.fuel_type like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.seats like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.odometer like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.manu_year like \'' . '%'.$a_arr.'%\'';
						$arr_where[] = $where_keyword;
							 
						$i++;
					}
					
					
				}  
		}
		$query_keyword = $query_keyword . " LEFT JOIN images ON images.car_id = C1.id
							LEFT JOIN networks ON (networks.member_id = C1.client_no AND networks.user_id = ".$this->request->data['user_id'].") OR (networks.member_id = ".$this->request->data['user_id']." AND networks.user_id = C1.client_no)
							LEFT JOIN followed_cars ON followed_cars.car_id = C1.id AND followed_cars.user_id = C1.client_no
							LEFT JOIN users ON users.id = C1.client_no ";
		$query_keyword_total = $query_keyword_total . " LEFT JOIN images ON images.car_id = C1.id
							LEFT JOIN networks ON (networks.member_id = C1.client_no AND networks.user_id = ".$this->request->data['user_id'].") OR (networks.member_id = ".$this->request->data['user_id']." AND networks.user_id = C1.client_no)
							LEFT JOIN followed_cars ON followed_cars.car_id = C1.id AND followed_cars.user_id = C1.client_no
							LEFT JOIN users ON users.id = C1.client_no ";
		
		$query_keyword = $query_keyword . " WHERE ";
		$query_keyword_total = $query_keyword_total . " WHERE ";
		
		$count_where = sizeof($arr_where);
			$j = 0;
			foreach($arr_where as $a_arr_where){
				$query_keyword = $query_keyword . "(" . $a_arr_where . ")";
				$query_keyword_total = $query_keyword_total . "(" . $a_arr_where . ")";
					if($j < $count_where - 1){
						$query_keyword = $query_keyword . " AND ";
						$query_keyword_total = $query_keyword_total . " AND ";
					}
				$j++;
		}
		
		if(strlen($query_keyword) > 0){
			$query_keyword = $query_keyword . " GROUP BY C1.id".$order_by."LIMIT ". $this->request->data['start'] .", ".$this->request->data['limit'];
				$result = $this->Car->query($query_keyword);
				$date = new DateTime();
				$current_date = $date->format('d-M-Y');
				if($result){
					$i = 0;
					foreach($result as $a_car_keyword){
						//$a_car_keyword['current_date'] = $current_date;
						$result[$i]['current_date'] = $current_date;
						$i ++;
					}
				}
		}
		if($this->request->data['start'] == 0){
			if(strlen($query_keyword_total) > 0){
				$query_keyword_total = $query_keyword_total . " GROUP BY C1.id";
				$result_total = $this->Car->query($query_keyword_total);
				echo json_encode(array("cars" => $result, "total_car" =>sizeof($result_total)));
			}else{
				echo json_encode(array("cars" => $result, "total_car" => "0"));
			}
		}else{
			echo json_encode(array("cars" => $result));
		}
	}
	public function searchCar(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$where = array();
		$where_keyword = array();
		if($this->request->data['user_id'] == 154){
			$result_return['status'] = 'false';
			$result_return['cars'] = array();
			echo json_encode($result_return);
		}
		
		$result = array();
		$arr_where = array();
		$query_keyword = 'SELECT C1.* FROM cars C1 '; 
		$where_keyword = '';
		$alias = 'C1';
					
		if (isset($this->request->data['make']) && !empty($this->request->data['make'])){
			//$where['Car.make'] = $this->request->data['make'];
			$where_keyword = $where_keyword . $alias .'.make = \''.$this->request->data['make'].'\' AND ';
		}
		if (isset($this->request->data['series']) && !empty($this->request->data['series'])){
			//$where['Car.series'] =  $this->request->data['series'];
			$where_keyword = $where_keyword . $alias .'.series = \''.$this->request->data['series'].'\' AND ';
		}
		if (isset($this->request->data['model']) && !empty($this->request->data['model'])){
			//$where['Car.model'] =  $this->request->data['model'];
			$where_keyword = $where_keyword . $alias .'.model = \''.$this->request->data['model'].'\' AND ';
		}
		
		if (isset($this->request->data['tranmission']) && !empty($this->request->data['tranmission'])){
			//$where['Car.gearbox'] =  $this->request->data['tranmission'];
			$where_keyword = $where_keyword . $alias .'.tranmission = \''.$this->request->data['tranmission'].'\' AND ';
		}
		
		if (isset($this->request->data['body_colour']) && !empty($this->request->data['body_colour'])){
			//$where['Car.body_colour'] =  $this->request->data['body_colour'];
			$where_keyword = $where_keyword . $alias .'.body_colour = \''.$this->request->data['body_colour'].'\' AND ';
		}
		
		if (isset($this->request->data['body']) && !empty($this->request->data['body'])){
			//$where['Car.body'] =  $this->request->data['body'];
			$where_keyword = $where_keyword . $alias .'.body = \''.$this->request->data['body'].'\' AND ';
		}
		
		if (isset($this->request->data['location']) && empty($this->request->data['location'])){
			//$where['Car.location'] =  $this->request->data['location'];
			$where_keyword = $where_keyword . $alias .'.location = \''.$this->request->data['location'].'\' AND ';
		}
		
		if (isset($this->request->data['drive_type']) && !empty($this->request->data['drive_type'])){
			//$where['Car.drive_type'] =  $this->request->data['drive_type'];
			$where_keyword = $where_keyword . $alias .'.drive_type = \''.$this->request->data['drive_type'].'\' AND ';
		}
		if (isset($this->request->data['fuel_type']) && !empty($this->request->data['fuel_type'])){
			//$where['Car.fuel_type'] =  $this->request->data['fuel_type'];
			$where_keyword = $where_keyword . $alias .'.fuel_type = \''.$this->request->data['fuel_type'].'\' AND ';
		}
		if (isset($this->request->data['seats']) && !empty($this->request->data['seats'])){
			//$where['Car.seats'] =  $this->request->data['seats'];
			$where_keyword = $where_keyword . $alias .'.seats = \''.$this->request->data['seats'].'\' AND ';
		} 
		if (isset($this->request->data['price_from']) && isset($this->request->data['price_to'])  && !empty($this->request->data['price_from'])  && !empty($this->request->data['price_to'])){
			//$where[] = array('Car.price BETWEEN ? AND ?' => array($this->request->data['price_from'], $this->request->data['price_to']));
			$where_keyword = $where_keyword . $alias .'.price BETWEEN '.$this->request->data['price_from'].' AND '. $this->request->data['price_to'] .' AND ';
		}else if(isset($this->request->data['price_from']) && !empty($this->request->data['price_from'])){
			//$where[] = array('Car.price >='. $this->request->data['price_from']);
			$where_keyword = $where_keyword . $alias .'.price >= \''.$this->request->data['price_from'].'\' AND ';
		}else if(isset($this->request->data['price_to']) && !empty($this->request->data['price_to'])){
			//$where[] = array('Car.price <='. $this->request->data['price_to']);
			$where_keyword = $where_keyword . $alias .'.price <= \''.$this->request->data['price_to'].'\' AND ';
		} 
		
		if (isset($this->request->data['kilometer_from']) && isset($this->request->data['kilometer_to'])  && !empty($this->request->data['kilometer_from'])  && !empty($this->request->data['kilometer_to'])){
			//$where[] = array('Car.odometer BETWEEN ? AND ?' => array($this->request->data['kilometer_from'], $this->request->data['kilometer_to'])); 
			$where_keyword = $where_keyword . $alias .'.odometer BETWEEN '.$this->request->data['kilometer_from'].' AND '. $this->request->data['kilometer_to'] .' AND ';
		} else if(isset($this->request->data['kilometer_from']) && !empty($this->request->data['kilometer_from'])){
			//$where[] = array('Car.odometer >='. $this->request->data['kilometer_from']);
			$where_keyword = $where_keyword . $alias .'.odometer >= \''.$this->request->data['kilometer_from'].'\' AND ';
		}else if(isset($this->request->data['kilometer_to']) && !empty($this->request->data['kilometer_to'])){
			//$where[] = array('Car.odometer <='. $this->request->data['kilometer_to']);
			$where_keyword = $where_keyword . $alias .'.odometer <= \''.$this->request->data['kilometer_to'].'\' AND ';
		}
		
		if (isset($this->request->data['year_from']) && isset($this->request->data['year_to'])  && !empty($this->request->data['year_from'])  && !empty($this->request->data['year_to'])){
			$where_keyword = $where_keyword . $alias .'.manu_year BETWEEN '.$this->request->data['year_from'].' AND '. $this->request->data['year_to'] .' AND ';
			//$where[] = array('Car.manu_year BETWEEN ? AND ?' => array($this->request->data['year_from'], $this->request->data['year_to']));
		}else if(isset($this->request->data['year_from']) && !empty($this->request->data['year_from'])){
			//$where[] = array('Car.manu_year >='. $this->request->data['year_from']);
			$where_keyword = $where_keyword . $alias .'.manu_year >= \''.$this->request->data['year_from'].'\' AND ';
		}else if(isset($this->request->data['year_to']) && !empty($this->request->data['year_to'])){
			//$where[] = array('Car.manu_year <='. $this->request->data['year_to']);
			$where_keyword = $where_keyword . $alias .'.manu_year <= \''.$this->request->data['year_to'].'\' AND ';
		}
		
		if(strlen($where_keyword)){
			$where_keyword = substr($where_keyword, 0, strlen($where_keyword) - 4);
			$arr_where[] = $where_keyword;
		}
		
		if (isset($this->request->data['keyword']) && !empty($this->request->data['keyword'])){
			$keyword = $this->request->data['keyword'];
				if(sizeof($arr_where) > 0){
				}else{
					$query_keyword = '';
				}
				
				$arr = array();
				$arr = explode(" ", $keyword);//Alfa Romeo 147 MY2002
				if(sizeof($arr) > 0 && strlen($arr[0]) > 0){ 
					if(sizeof($arr_where) > 0){
						
					}else{
						$query_keyword = 'SELECT C1.* FROM cars C1 '; 
						$field1 = $arr[0];
						array_splice($arr, 0, 1);
						$where_keyword = '';
						$alias = 'C1';
						$where_keyword = $where_keyword . $alias .'.make like \''.'%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.series like \''.'%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.model like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.price like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.gearbox like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.body_colour like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.body like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.location like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.drive_type like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.fuel_type like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.seats like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.odometer like \'' . '%'.$field1.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.manu_year like \'' . '%'.$field1.'%\'';
						$arr_where[] = $where_keyword;
					}
					$i = 2;  
					foreach($arr as $a_arr){
						$where_keyword = '';
						$alias = 'C'.$i;
						$query_keyword = $query_keyword . "INNER JOIN cars " . $alias . " ON " . $alias . ".id = " . 'C'.($i-1) .".id ";
						
						$where_keyword = $where_keyword . $alias .'.make like \''.'%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.series like \''.'%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.model like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.price like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.gearbox like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.body_colour like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.body like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.location like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.drive_type like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.fuel_type like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.seats like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.odometer like \'' . '%'.$a_arr.'%\' OR ';
						$where_keyword = $where_keyword . $alias .'.manu_year like \'' . '%'.$a_arr.'%\'';
						$arr_where[] = $where_keyword;
							 
						$i++;
					}
					
					
				}  
			/*if(strlen($query_keyword) > 0){ 
				$car_keyword = $this->Car->query($query_keyword);
				if($car_keyword){
					foreach($car_keyword as $a_car_keyword){
						$result[]['Car'] = $a_car_keyword['C1'];
					}
				}
			}*/
		}
		$query_keyword = $query_keyword . " WHERE ";
					$count_where = sizeof($arr_where);
					$j = 0;
					foreach($arr_where as $a_arr_where){
						$query_keyword = $query_keyword . "(" . $a_arr_where . ")";
						if($j < $count_where - 1){
							$query_keyword = $query_keyword . " AND ";
						}
						$j++;
		}
		
		if(strlen($query_keyword) > 0){
				$car_keyword = $this->Car->query($query_keyword);
				if($car_keyword){
					foreach($car_keyword as $a_car_keyword){
						$result[]['Car'] = $a_car_keyword['C1'];
					}
				}
		}	
		$car = array();
		/*$result_query = array();
		if(sizeof($where) > 0){
			if(isset($this->request->data['type']) && $this->request->data['type'] == 0){
				//$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array(array('OR' => $where_keyword, $where), "Car.active = 0")));
				$result_query = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array($where, "Car.active = 0")));
			}else{ 
				//$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array(array('OR' => $where_keyword, $where), "Car.active <> 2")));
				$result_query = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array($where, "Car.active <> 2")));
			} 
		}
		if($result_query){
			foreach($result_query as $a_result_query){
				$result[] = $a_result_query;
			}
		}*/
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result){
			foreach ($result as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				}
				
				//Check buy-0/sell-1/pending-2
					if($car_result['Car']['transactor_id'] != -1){
						$car_result['Car']['transaction_status'] = 2;
					}else{
						if($car_result['Car']['client_no'] == $this->request->data['user_id']){
							$car_result['Car']['transaction_status'] = 1;
						}else{
							$car_result['Car']['transaction_status'] = 0;
						}
					}
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name']; 
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				
				$car[] = $car_result['Car'];
			}
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		}else{
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		} 
		echo json_encode($result_return);
	}
	
	public function getComment(){
		$this->autoRender = false;
		$this->loadModel('User');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		/*$arr_test = $this->Comment->User->bindModel(array(
					'belongsTo' => array(
						'Comment' => array('foreignKey' => false,
											'type'=>'RIGHT',
											'conditions' => array('Comment.car_id' => '543', 'Comment.user_id' =>'32')
										),
						'User' => array(
											'foreignKey' => false,
											'type'=>'RIGHT',
											'conditions' => array('Comment.user_id = User.user_id')
										)
									)
						),
					false
				);*/
		/*if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}*/
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		
		$arr_test = $this->Comment->find('all', array(
				   'fields' => array('Comment.id', 'Comment.comment', 'Comment.created_at','User.name', 'User.id', 'User.email', 'User.phone', 'User.company_name'),
				   'joins' => array(array('table' => 'users',
										   'alias' => 'User',
										   'type' => 'INNER',
										   'conditions' => array('User.id = Comment.user_id', 'Comment.car_id = '.$this->request->data['car_id'])
									 ))
					 )
			  ); 
		//, 'Comment.user_id = '.$this->request->data['user_id']
		//print_r($arr_test);
		if($arr_test){
			$result = array();
			foreach($arr_test as $a_test){
				//echo $a_test['Comment']['comment'] . json_encode($a_test['User']);
				$a_result['comment'] = $a_test['Comment'];
				$a_result['user'] = $a_test['User'];
				$result[] = $a_result;
			}
			
			return json_encode(array("status" => 'success', "result" => $result));
		}else{
			return json_encode(array("status" => 'success', "result" => array()));
		}	
	}
	
	public function getManageCurrent(){
		$this->autoRender = false;
		$this->loadModel('Setandforget');
		$this->loadModel('User');
		$this->loadModel('Customer');
		$this->loadModel('ShareSetandforget');
		$this->loadModel('Block');
		
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		//if($this->request->data['type'] == 1){
			$setforget = $this->Setandforget->find('all', array('recursive' => -1, 'fields' => array('DISTINCT Setandforget.customer_id'), 'conditions'=> array('Setandforget.user_id' => $this->request->data['user_id'])));
			$manage = array();
			foreach ($setforget as $a_result) {
				$customer = $this->Customer->find('first',array('recursive' => -1, 'conditions'=> array('Customer.id' => $a_result['Setandforget']['customer_id'])));
				if($customer){
					$a_result['Setandforget']['customer_infor'] = $customer['Customer'];
				}else{
					$a_result['Setandforget']['customer_infor'] = "";
				}
				$forget = $this->Setandforget->find('all',array('recursive' => -1, 'conditions'=> array('Setandforget.customer_id' => $a_result['Setandforget']['customer_id'])));
				$arr_forget = array();
				foreach ($forget as $a_forget) {
					$arr_share = $this->ShareSetandforget->find('all',array('recursive' => -1, 'conditions'=> array('ShareSetandforget.setandforget_id' => $a_forget['Setandforget']['id'])));
					$array_share_ids = array();
					foreach($arr_share as $a_arr_share){
						$array_share_ids[] =  $a_arr_share['ShareSetandforget']['user_id'];
					}
					$a_forget['Setandforget']['arr_share_dealer'] = $array_share_ids;
					$arr_forget[] = $a_forget['Setandforget'];
				}
				$a_result['Setandforget']['manage'] =  $arr_forget;
				$manage[] = $a_result['Setandforget'];
			}
			
			
		if($this->request->data['type'] == 0){
			$arr_share = $this->Setandforget->find('all', array(
				   'fields' => array('DISTINCT Setandforget.customer_id, Setandforget.user_id'),
				   'joins' => array(array('table' => 'share_setandforgets',
										   'alias' => 'ShareSetandforget',
										   'type' => 'INNER',
										   'fields' => array('ShareSetandforget.setforget_id'),
										   'conditions' => array('ShareSetandforget.setandforget_id = Setandforget.id', 'ShareSetandforget.user_id' => $this->request->data['user_id'])
									 ))
					 )
			  ); 
			foreach($arr_share as $a_share){
				$block_user = $this->Block->find('first', array('recursive' => -1, 'conditions'=>array('Block.user_id' => $this->request->data['user_id'], 'Block.blocker_id' => $a_share['Setandforget']['user_id'])));
				if(!$block_user){
					$user = $this->Customer->find('first', array('recursive' => -1, 'conditions'=> array('Customer.id' => $a_share['Setandforget']['customer_id'])));
							if($user){
								$a_result['Setandforget']['user_infor'] = $user['Customer'];
							}else{
								$a_result['Setandforget']['user_infor'] = "";
							}
					$forget = $this->Setandforget->find('all', array(
					   'fields' => array('Setandforget.*'),
					   'joins' => array(array('table' => 'share_setandforgets',
											   'alias' => 'ShareSetandforget',
											   'type' => 'INNER',
											   //'fields' => array('ShareSetandforget.setforget_id'),
											   'conditions' => array('ShareSetandforget.setandforget_id = Setandforget.id', 'ShareSetandforget.user_id' => $this->request->data['user_id'], 'Setandforget.customer_id' => $a_share['Setandforget']['customer_id'])
										 ))
						 )
					); 
					$arr_forget = array();
						foreach ($forget as $a_forget) {
							$arr_share = $this->ShareSetandforget->find('all',array('recursive' => -1, 'conditions'=> array('ShareSetandforget.setandforget_id' => $a_forget['Setandforget']['id'])));
							$array_share_ids = array();
							foreach($arr_share as $a_arr_share){
								$array_share_ids[] =  $a_arr_share['ShareSetandforget']['user_id'];
							}
							$a_forget['Setandforget']['arr_share_dealer'] = $array_share_ids;
							$arr_forget[] = $a_forget['Setandforget'];
						}
						$a_result['Setandforget']['manage'] =  $arr_forget;
						$manage[] = $a_result['Setandforget'];
				}
			}
		}
		return json_encode($manage);
	}
	
	public function setAndForget(){
		$this->autoRender = false;
		$this->loadModel('Setandforget');
		$this->loadModel('User');
		$this->loadModel('ShareSetandforget');
		if($this->request->data['user_id'] == 154){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['search_params'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post search params', 'code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['make'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post make','code' => '202')));
		}
		if (!isset($this->request->data['series']) && !isset($this->request->data['model'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post series and model','code' => '202')));
		}
		if (!isset($this->request->data['customer_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post customer_id','code' => '202')));
		}
		$user_id = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->request->data['user_id'])));
		if(!$user_id){
			die(json_encode(array('status' => 'Fail', 'response' => 'User_id not existed')));
		}
		
		$is_set_forget = $this->Setandforget->find('first', array('recursive' => -1, 'conditions' => array('Setandforget.user_id' => $this->request->data['user_id'], 'Setandforget.search_params' => $this->request->data['search_params'])));
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_add_setandforget['Setandforget']['search_params'] = $this->request->data['search_params'];
		$arr_add_setandforget['Setandforget']['customer_id'] = $this->request->data['customer_id'];
		$arr_add_setandforget['Setandforget']['user_id'] = $this->request->data['user_id'];
		$arr_add_setandforget['Setandforget']['updated_at'] = $current_time;
		
		if(!isset($this->request->data['model'])){
			$sURL = "http://ppsr.identicar.com.au/api/search/series/".$this->request->data['make']."/".$this->request->data['series'];
		}else{
			$sURL = "http://ppsr.identicar.com.au/api/search/model/".$this->request->data['make']."/".$this->request->data['model'];;
		}
		$aHTTP['http']['method']  = 'POST';
		$aHTTP['http']['header']  = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
		$aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
		$aHTTP['http']['header'] .= "User-Agent:MyAgent/1.0\r\n"; 
		$context = stream_context_create($aHTTP);
		$contents = file_get_contents($sURL, false, $context);
		$json = json_decode($contents, true);
		$arr_rs = array();
		if($json['success'] == true){
			foreach($json['results'] as $a){
				$arr_rs = array_merge($arr_rs, $a['other_vins']);	
			}
			$arr_add_setandforget['Setandforget']['vin_number'] = serialize($arr_rs);
		}

		//if($is_set_forget){
		//	$this->Setandforget->id = $is_set_forget['Setandforget']['id'];
		//}else{
			$arr_add_setandforget['Setandforget']['created_at'] = $current_time;
		//}
		if ($this->Setandforget->save($arr_add_setandforget)) {
				$setforget_id = $this->Setandforget->id;
				$arr = json_decode($this->request->data['arr_share_dealer']);
				foreach($arr as $a_user_id){
					$date = new DateTime();
					$current_time = $date->format('Y-m-d H:i:s') ;
					$arr_share['ShareSetandforget']['setandforget_id'] = $setforget_id;
					$arr_share['ShareSetandforget']['user_id'] = $a_user_id;
					$arr_share['ShareSetandforget']['created_at'] = $current_time;
					$arr_share['ShareSetandforget']['updated_at'] = $current_time;
					$this->ShareSetandforget->create();
					if ($this->ShareSetandforget->save($arr_share)) {
					}
				}
			 return json_encode(array("status" => 'success'));
		}else{
			return json_encode(array("status" => 'fail'));
		}
		
	}
	
	public function updateSetAndForget(){
		$this->autoRender = false;
		$this->loadModel('Setandforget');
		$this->loadModel('User');
		$this->loadModel('ShareSetandforget');
		
		if (!isset($this->request->data['search_params'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post search params', 'code' => '202')));
		}
		if (!isset($this->request->data['manage_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post manage id','code' => '202')));
		}
		if (!isset($this->request->data['make'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post make','code' => '202')));
		}
		if (!isset($this->request->data['series']) && !isset($this->request->data['model'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post series and model','code' => '202')));
		}
		if (!isset($this->request->data['customer_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post customer_id','code' => '202')));
		}
		$manage_id = $this->Setandforget->find('first', array('recursive' => -1, 'conditions' => array('Setandforget.id' => $this->request->data['manage_id'])));
		if(!$manage_id){
			die(json_encode(array('status' => 'Fail', 'response' => 'Manage_id not existed')));
		}
		
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_update['Setandforget']['updated_at'] = $current_time;
		$arr_update['Setandforget']['search_params'] = $this->request->data['search_params'];
		$arr_update['Setandforget']['customer_id'] = $this->request->data['customer_id'];
		$this->Setandforget->id = $this->request->data['manage_id'];
		if ($this->Setandforget->save($arr_update)) {
				//Delete all Dealer's shared
				$delete = $this->ShareSetandforget->query('Delete from share_setandforgets where share_setandforgets.setandforget_id ='.$this->request->data['manage_id']);
				//Add dealer's shared 
				if(!isset($this->request->data['model'])){
				$sURL = "http://ppsr.identicar.com.au/api/search/series/".$this->request->data['make']."/".$this->request->data['series'];
				}else{
					$sURL = "http://ppsr.identicar.com.au/api/search/model/".$this->request->data['make']."/".$this->request->data['model'];;
				}
				$aHTTP['http']['method']  = 'POST';
				$aHTTP['http']['header']  = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
				$aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
				$context = stream_context_create($aHTTP);
				$contents = file_get_contents($sURL, false, $context);
				$json = json_decode($contents, true);
				$arr_rs = array();
				if($json['success'] == true){
					foreach($json['results'] as $a){
						$arr_rs = array_merge($arr_rs, $a['other_vins']);	
					}
					$arr_add_setandforget['Setandforget']['vin_number'] = serialize($arr_rs);
				}

				
				$arr_add_setandforget['Setandforget']['created_at'] = $current_time;
				
				if ($this->Setandforget->save($arr_add_setandforget)) {
						$setforget_id = $this->Setandforget->id;
						$arr = json_decode($this->request->data['arr_share_dealer']);
						foreach($arr as $a_user_id){
							$date = new DateTime();
							$current_time = $date->format('Y-m-d H:i:s') ;
							$arr_share['ShareSetandforget']['setandforget_id'] = $setforget_id;
							$arr_share['ShareSetandforget']['user_id'] = $a_user_id;
							$arr_share['ShareSetandforget']['created_at'] = $current_time;
							$arr_share['ShareSetandforget']['updated_at'] = $current_time;
							$this->ShareSetandforget->create();
							if ($this->ShareSetandforget->save($arr_share)) {
							}
						}
				}
			 return json_encode(array("status" => 'success', 'updated_at' => $current_time));
		}else{
			return json_encode(array("status" => 'fail'));
		}
	}
	
	public function deleteSetandForget(){
		$this->autoRender = false;
		$this->loadModel('Setandforget');
		$this->loadModel('ShareSetandforget');
		if (!isset($this->request->data['manage_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post manage id','code' => '202')));
		}
		$manage_id = $this->Setandforget->find('first', array('recursive' => -1, 'conditions' => array('Setandforget.id' => $this->request->data['manage_id'])));
		if(!$manage_id){
			die(json_encode(array('status' => 'Fail', 'response' => 'Manage_id not existed')));
		}else{
			$this->Setandforget->id = $this->request->data['manage_id'];
			if ($this->Setandforget->delete()) {
					$delete = $this->ShareSetandforget->query('Delete from share_setandforgets where share_setandforgets.setandforget_id ='.$this->request->data['manage_id']);
					die(json_encode(array('status' => 'success')));
			} else {
				die(json_encode(array('status' => 'Fail', 'response' => 'Manage_id not existed')));
			}
		
		}
	}
	
	
	public function addCar(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Comment');
		
		if (isset($this->request->data['client_no']) && !empty($this->request->data['client_no'])){
			$arr_add['Car']['client_no'] = $this->request->data['client_no'];
		}
		if (isset($this->request->data['stock_no']) && !empty($this->request->data['stock_no'])){
			$arr_add['Car']['stock_no'] = $this->request->data['stock_no'];
		}
		if (isset($this->request->data['dealer_code']) && !empty($this->request->data['dealer_code'])){
			$arr_add['Car']['dealer_code'] = $this->request->data['dealer_code'];
		}
		if (isset($this->request->data['manu_year']) && !empty($this->request->data['manu_year'])){
			$arr_add['Car']['manu_year'] = $this->request->data['manu_year'];
		}
		if (isset($this->request->data['make']) && !empty($this->request->data['make'])){
			$arr_add['Car']['make'] = $this->request->data['make'];
		}
		if (isset($this->request->data['model']) && !empty($this->request->data['model'])){
			$arr_add['Car']['model'] = $this->request->data['model'];
		}
		if (isset($this->request->data['series']) && !empty($this->request->data['series'])){
			$arr_add['Car']['series'] = $this->request->data['series'];
		}
		if (isset($this->request->data['badge']) && !empty($this->request->data['badge'])){
			$arr_add['Car']['badge'] = $this->request->data['badge'];
		}
		if (isset($this->request->data['body']) && !empty($this->request->data['body'])){
			$arr_add['Car']['body'] = $this->request->data['body'];
		}
		if (isset($this->request->data['doors']) && !empty($this->request->data['doors'])){
			$arr_add['Car']['doors'] = $this->request->data['doors'];
		}
		if (isset($this->request->data['vin_number']) && !empty($this->request->data['vin_number'])){
			$arr_add['Car']['vin_number'] = $this->request->data['vin_number'];
		}
		if (isset($this->request->data['notes']) && !empty($this->request->data['notes'])){
			$arr_add['Car']['notes'] = $this->request->data['notes'];
		}
		if (isset($this->request->data['registration_date']) && !empty($this->request->data['registration_date'])){
			$arr_add['Car']['registration_date'] = $this->request->data['registration_date'];
		}
		if (isset($this->request->data['seats']) && !empty($this->request->data['seats'])){
			//$output = str_ireplace (array('\\r\\n'),array(""), $this->request->data['seats']);	
			$output = $this->request->data['seats'];
			$output = str_replace("\n", '', $output);
			$output = str_replace("\r", '', $output);
			$output = str_replace("\r\n", '', $output);
			$arr_add['Car']['seats'] = $output;
		}
		if (isset($this->request->data['body_colour']) && !empty($this->request->data['body_colour'])){
			$arr_add['Car']['body_colour'] = $this->request->data['body_colour'];
		}
		if (isset($this->request->data['trim_colour']) && !empty($this->request->data['trim_colour'])){
			$arr_add['Car']['trim_colour'] = $this->request->data['trim_colour'];
		}
		if (isset($this->request->data['gears']) && !empty($this->request->data['gears'])){
			$arr_add['Car']['gears'] = $this->request->data['gears'];
		}
		if (isset($this->request->data['fuel_type']) && !empty($this->request->data['fuel_type'])){
			$arr_add['Car']['fuel_type'] = $this->request->data['fuel_type'];
		}
		if (isset($this->request->data['retail']) && !empty($this->request->data['retail'])){
			$arr_add['Car']['retail'] = $this->request->data['retail'];
		}
		if (isset($this->request->data['price']) && !empty($this->request->data['price'])){
			$arr_add['Car']['price'] = $this->request->data['price'];
		}
		if (isset($this->request->data['rego']) && !empty($this->request->data['rego'])){
			$arr_add['Car']['rego'] = $this->request->data['rego'];
		}
		if (isset($this->request->data['odometer']) && !empty($this->request->data['odometer'])){
			$arr_add['Car']['odometer'] = $this->request->data['odometer'];
		}
		if (isset($this->request->data['cylinders']) && !empty($this->request->data['cylinders'])){
			$arr_add['Car']['cylinders'] = $this->request->data['cylinders'];
		}
		if (isset($this->request->data['engine_capacity']) && !empty($this->request->data['engine_capacity'])){
			$arr_add['Car']['engine_capacity'] = $this->request->data['engine_capacity'];
		}
		if (isset($this->request->data['vin_number']) && !empty($this->request->data['vin_number'])){
			$arr_add['Car']['vin_number'] = $this->request->data['vin_number'];
		}
		if (isset($this->request->data['manu_month']) && !empty($this->request->data['manu_month'])){
			$arr_add['Car']['manu_month'] = $this->request->data['manu_month'];
		}
		if (isset($this->request->data['options']) && !empty($this->request->data['options'])){
			$arr_add['Car']['options'] = $this->request->data['options'];
		}
		if (isset($this->request->data['comments']) && !empty($this->request->data['comments'])){
			$arr_add['Car']['comments'] = $this->request->data['comments'];
		}
		if (isset($this->request->data['nvic']) && !empty($this->request->data['nvic'])){
			$arr_add['Car']['nvic'] = $this->request->data['nvic'];
		}
		if (isset($this->request->data['redbookcode']) && !empty($this->request->data['redbookcode'])){
			$arr_add['Car']['redbookcode'] = $this->request->data['redbookcode'];
		}
		if (isset($this->request->data['location']) && !empty($this->request->data['location'])){
			$arr_add['Car']['location'] = $this->request->data['location'];
		}if (isset($this->request->data['gearbox']) && !empty($this->request->data['gearbox'])){
			$arr_add['Car']['gearbox'] = $this->request->data['gearbox'];
		}
		if (isset($this->request->data['engine_number']) && !empty($this->request->data['engine_number'])){
			$arr_add['Car']['engine_number'] = $this->request->data['engine_number'];
		}
		if (isset($this->request->data['status']) && !empty($this->request->data['status'])){
			$arr_add['Car']['status'] = $this->request->data['status'];
		}
		if (isset($this->request->data['sync']) && !empty($this->request->data['sync'])){
			$arr_add['Car']['sync'] = $this->request->data['sync'];
		}
		if (isset($this->request->data['inventory']) && !empty($this->request->data['inventory'])){
			$arr_add['Car']['inventory'] = $this->request->data['inventory'];
		}
		if (isset($this->request->data['egc']) && !empty($this->request->data['egc'])){
			$arr_add['Car']['egc'] = $this->request->data['egc'];
		}
		if (isset($this->request->data['drive_away_amount']) && !empty($this->request->data['drive_away_amount'])){
			$arr_add['Car']['drive_away_amount'] = $this->request->data['drive_away_amount'];
		}
		if (isset($this->request->data['is_drive_away']) && !empty($this->request->data['is_drive_away'])){
			$arr_add['Car']['is_drive_away'] = $this->request->data['is_drive_away'];
		}
		if (isset($this->request->data['drive_type']) && !empty($this->request->data['drive_type'])){
			$arr_add['Car']['drive_type'] = $this->request->data['drive_type'];
		}
		if (isset($this->request->data['price']) && !empty($this->request->data['price'])){
			$arr_add['Car']['price'] = $this->request->data['price'];
		}
		$check_vins = $this->Car->find('first', array('recursive' => -1, 'conditions'=>array('Car.vin_number'=>$this->request->data['vin_number'])));
		if($check_vins){
			die(json_encode(array('status' => 'fail', 'response'=>'VIN number already exists. Please try another one')));
		}
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_add['Car']['created_at'] = $current_time;
		$arr_add['Car']['updated_at'] = $current_time;
		$current_date = $date->format('d-M-Y');
		$arr_add['Car']['receiveddate'] = $current_date;
		
		if($this->Car->save($arr_add)) {
			//$arr_add['Car']['id'] = $this->Car->id;
			$car_id = $this->Car->id;
			//Add comment
			if (isset($this->request->data['comments']) && !empty($this->request->data['comments'])){
				$date = new DateTime();
				$current_time = $date->format('Y-m-d H:i:s') ;
				$arr_add_comment['Comment']['car_id'] = $car_id;
				$arr_add_comment['Comment']['user_id'] = $this->request->data['client_no'];
				$arr_add_comment['Comment']['comment'] = $this->request->data['comments'];
				$arr_add_comment['Comment']['updated_at'] = $current_time;
				$arr_add_comment['Comment']['created_at'] = $current_time;
				if ($this->Comment->save($arr_add_comment)) { 
				}else{
				}
			}
			$arr_add = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.id' => $car_id)));
			$arr_add['Car']['is_follow'] = false;
			$date = new DateTime();
			$current_date = $date->format('d-M-Y');
			$arr_add['Car']['current_date'] = $current_date;
			if($arr_add){
				if(!isset($_FILES['images'])){
					$car['Car']['images'] = array();
					die(json_encode(array('status' => 'success', 'car' => $arr_add['Car'])));
				}else{
					$this->uploadImagesCar($_FILES['images'], $arr_add['Car']['id'], $arr_add);
				}
			}else{
				die(json_encode(array('status' => 'fail')));
			}
			
		}else{
			die(json_encode(array('status' => 'fail')));
		}
	}
	public function uploadImagesCar($files, $id, $car){
		$this->autoRender = false;
		$this->loadModel('Image');
		$folder_url = WWW_ROOT . "datafeed/dealersolutions/images";
		if(!is_dir($folder_url)) {
			mkdir($folder_url, 0777, true);
		}
		if(isset($files)){
			$uploadfiles = $files['name'];
			$success = true;
			$arr_image = array();
			//echo count($uploadfiles);
			for ($i=0; $i<count($uploadfiles) && $success; $i++){	
					$milliseconds = round(microtime(true) * 1000);
					$file_name = $milliseconds.'_'.$files['name'][$i];
					$file_tmp = $files['tmp_name'][$i];
					$success = move_uploaded_file($files['tmp_name'][$i], $folder_url . DS . $file_name);
					if($success){
						$date = new DateTime();
						$current_time = $date->format('Y-m-d H:i:s') ;
						$arr_add['Image']['car_id'] = $id;
						$arr_add['Image']['image_file_name'] = Router::url('/', true).'/app/webroot/datafeed/dealersolutions/images/'.$file_name;
						$arr_add['Image']['updated_at'] = $current_time;
						$arr_add['Image']['updated_at'] = $current_time;
						$arr_add['Image']['is_server_sdc'] = 0;
						$arr_add['Image']['url'] = Router::url('/', true).'/app/webroot/datafeed/dealersolutions/images/' . $file_name;
						$this->Image->create();
						if($this->Image->save($arr_add)) {
							$tmp = $arr_add;
							$tmp['Image']['id'] = $this->Image->id;
							$tmp['Image']['is_server'] = 0;
							$arr_image[] = $tmp['Image'];
						}
					}
				}
				$car['Car']['images'] = $arr_image;
				die(json_encode(array('status' => 'success', 'car' => $car['Car'])));
				//http://198.38.86.211/app/webroot/img/uploads/users_avatar/Capture.PNG
		}else{
			$car['Car']['images'] = array();
			die(json_encode(array('status' => 'success', 'car' => $car['Car'])));
		}
	}
	
	public function uploadVideoCar($files, $id, $car){
		$this->autoRender = false;
		$this->loadModel('Image');
		$folder_url = WWW_ROOT . "img/uploads/car_images";
		if(!is_dir($folder_url)) {
			mkdir($folder_url, 0777, true);
		}
		if(isset($files)){
			$uploadfiles = $files['name'];
			$success = true;
			$arr_image = array();
			//echo count($uploadfiles);
			for ($i=0; $i<count($uploadfiles) && $success; $i++){	
					$milliseconds = round(microtime(true) * 1000);
					$file_name = $milliseconds.'_'.$files['name'][$i];
					$file_tmp = $files['tmp_name'][$i];
					$success = move_uploaded_file($files['tmp_name'][$i], $folder_url . DS . $file_name);
					if($success){
						$date = new DateTime();
						$current_time = $date->format('Y-m-d H:i:s') ;
						$arr_add['Image']['car_id'] = $id;
						$arr_add['Image']['image_file_name'] = $file_name;
						$arr_add['Image']['updated_at'] = $current_time;
						$arr_add['Image']['updated_at'] = $current_time;
						$arr_add['Image']['is_server_sdc'] = 1;
						$arr_add['Image']['url'] = '/app/webroot/datafeed/' . $file_name;
						if($this->Image->save($arr_add)) {
							$arr_add['Image']['id'] = $this->Image->id;
							$arr_add['Image']['is_server'] = 1;
							$arr_image[] = $arr_add['Image'];
						}
					}
				}
				$car['Car']['images'] = $arr_image;
				die(json_encode(array('status' => 'success', 'car' => $car['Car'])));
				//http://198.38.86.211/app/webroot/img/uploads/users_avatar/Capture.PNG
		}else{
			$car['Car']['images'] = array();
			die(json_encode(array('status' => 'success', 'car' => $car['Car'])));
		}
	}
	
	public function dataSearch(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('CarsMake');
		$this->loadModel('CarsModel');
		$this->loadModel('CarsSerie');
		$result = array();
		
		//Get Transmission
		$gearbox = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.gearbox', 'order' => array('Car.gearbox ASC')));
		$arr_gearbox = array();
		foreach ($gearbox as $a_data) {
			if($a_data['Car']['gearbox'] != null)$arr_gearbox[] = $a_data['Car']['gearbox'];
		}
		$obj_transmission['name'] = 'Transmission';
		$obj_transmission['field_name'] = 'gearbox';
		$obj_transmission['values'] = $arr_gearbox;
		$result[] = $obj_transmission;
		//Get colour
		$colour = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.body_colour', 'order' => array('Car.body_colour ASC')));
		$arr_colour = array();
		foreach ($colour as $a_data) {
			if($a_data['Car']['body_colour'] != null)$arr_colour[] = $a_data['Car']['body_colour'];
		}
		$obj_colour['name'] = 'Colour';
		$obj_colour['field_name'] = 'body_colour';
		$obj_colour['values'] = $arr_colour;
		$result[] = $obj_colour;
		//Get body
		$body = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.body', 'order' => array('Car.body ASC')));
		$arr_body = array();
		foreach ($body as $a_data) {
			if($a_data['Car']['body'] != null)$arr_body[] = $a_data['Car']['body'];
		}
		$obj_body['name'] = 'Body type';
		$obj_body['field_name'] = 'body';
		$obj_body['values'] = $arr_body;
		$result[] = $obj_body;
		
		//Get body
		$fuel_type = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.fuel_type', 'order' => array('Car.fuel_type ASC')));
		$arr_fuel_type = array();
		foreach ($fuel_type as $a_data) {
			if($a_data['Car']['fuel_type'] != null)$arr_fuel_type[] = $a_data['Car']['fuel_type'];
		}
		$obj_fuel['name'] = 'Fuel Type';
		$obj_fuel['field_name'] = 'fuel_type';
		$obj_fuel['values'] = $arr_fuel_type;
		$result[] = $obj_fuel;
		
		//Get Seats
		/*$seats = $this->Car->find('all', array('fields'=>'DISTINCT Car.seats'));
		$arr_seats = array();
		foreach ($seats as $a_data) {
			if($a_data['Car']['seats'] != null)$arr_seats[] = $a_data['Car']['seats'];
		}*/
		$obj_seat['name'] = 'Seats';
		$obj_seat['field_name'] = 'seats';
		$obj_seat['values'] = array("2","3","4","5","6","7","8","9","10","12","14","16","24");
		$result[] = $obj_seat;
		
		//Get Location
		$location = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.location', 'order' => array('Car.location ASC')));
		$arr_location = array();
		foreach ($location as $a_data) {
			if($a_data['Car']['location'] != null)$arr_location[] = $a_data['Car']['location'];
		}
		$obj_location['name'] = 'Location';
		$obj_location['field_name'] = 'location';
		$obj_location['values'] = $arr_location;
		$result[] = $obj_location;
		
		//Get Drive Type
		$drive_type = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.drive_type', 'order' => array('Car.drive_type ASC')));
		$arr_drive = array();
		foreach ($drive_type as $a_data) {
			if($a_data['Car']['drive_type'] != null)$arr_drive[] = $a_data['Car']['drive_type'];
		}
		$obj_drive['name'] = 'Drive type';
		$obj_drive['field_name'] = 'drive_type';
		$obj_drive['values'] = $arr_drive;
		$result[] = $obj_drive;
		
		//Get Year From & To
		/*$year_from = $this->Car->find('all', array('fields'=>'DISTINCT Car.manu_year'));
		$arr_year_from = array();
		foreach ($year_from as $a_data) {
			if($a_data['Car']['manu_year'] != null)$arr_year_from[] = $a_data['Car']['manu_year'];
		}*/
		$obj_year_from['name'] = 'year_from';
		$obj_year_from['field_name'] = 'manu_year_from';
		$obj_year_from['values'] = array("2015","2014","2013","2012","2011", "2010","2009","2008", "2007", "2006","2005","2004","2003","2002", "2001","2000","1999","1998");
		$result[] = $obj_year_from;
		
		$obj_year_to['name'] = 'year_to';
		$obj_year_to['field_name'] = 'manu_year_to';
		$obj_year_to['values'] = array("2015","2014","2013","2012","2011", "2010","2009","2008", "2007", "2006","2005","2004","2003","2002", "2001","2000","1999","1998");
		$result[] = $obj_year_to;
		
		$obj_price_from['name'] = 'price_from';
		$obj_price_from['field_name'] = 'price_from';
		$obj_price_from['values'] = array("0", "2500", "5000", "7500", "10000", "15000", "20000", "25000", "30000","35000","40000", "45000", "50000", "60000", "70000", "80000", "90000", "100000", "150000");
		$result[] = $obj_price_from;
		
		$obj_price_to['name'] = 'price_to';
		$obj_price_to['field_name'] = 'price_to';
		$obj_price_to['values'] = array("0", "2500", "5000", "7500", "10000", "15000", "20000", "25000", "30000","35000","40000", "45000", "50000", "60000", "70000", "80000", "90000", "100000", "150000");
		$result[] = $obj_price_to;
		
		$obj_kilometers_from['name'] = 'kilometers_from';
		$obj_kilometers_from['field_name'] = 'odometer_from';
		$obj_kilometers_from['values'] = array("0","5000","10000","20000", "30000","40000", "50000","60000","70000","80000","90000","100000","150000","200000","250000","300000");
		$result[] = $obj_kilometers_from;
		
		$obj_kilometers_to['name'] = 'kilometers_to';
		$obj_kilometers_to['field_name'] = 'odometer_to';
		$obj_kilometers_to['values'] = array("0","5000","10000","20000", "30000","40000", "50000","60000","70000","80000","90000","100000","150000","200000","250000","300000");
		$result[] = $obj_kilometers_to;
		
		$carsMake = $this->CarsMake->find('all', array('recursive' => -1, 'fields'=>'CarsMake.id, CarsMake.name'));
		$arr_make = array();
		foreach ($carsMake as $a_carsMake) {
			$carsSeries = $this->CarsSerie->find('all', array('recursive' => -1, 'fields'=>'CarsSerie.id, CarsSerie.name', 'conditions' => array('CarsSerie.make_id' => $a_carsMake['CarsMake']['id'])));
			$arr_series = array();
			foreach ($carsSeries as $a_carsSeries) {
				$carsModel = $this->CarsModel->find('all', array('recursive' => -1, 'fields'=>'CarsModel.id, CarsModel.name', 'conditions' => array('CarsModel.make_id' => $a_carsMake['CarsMake']['id'], 'CarsModel.series_id' => $a_carsSeries['CarsSerie']['id'])));
				$arr_model = array();
					foreach ($carsModel as $a_carsModel) {
						$arr_model[] = $a_carsModel['CarsModel'];
					}
				$a_carsSeries['CarsSerie']['models'] = $arr_model;
				$arr_series[] = $a_carsSeries['CarsSerie'];
			}
			$a_carsMake['CarsMake']['series'] = $arr_series;
			$arr_make[] = $a_carsMake['CarsMake'];
		}
		
		//Get Make 
		$query_make = $this->Car->find('all', array('recursive' => -1,
		'fields'=>'DISTINCT Car.make', 'order' => array('Car.make ASC')));
		$arr_make = array();
		foreach ($query_make as $a_data) {
			if($a_data['Car']['make'] != null)$arr_make[] = $a_data['Car']['make'];
		}
		$obj_make['name'] = 'make';
		$obj_make['field_name'] = 'make';
		$obj_make['values'] = $arr_make;
		$result[] = $obj_make;
		
		//Get Series
		$query_series = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.series', 'order' => array('Car.series ASC')));
		$arr_series = array();
		foreach ($query_series as $a_data) {
			if($a_data['Car']['series'] != null)$arr_series[] = $a_data['Car']['series'];
		}
		$obj_series['name'] = 'series';
		$obj_series['field_name'] = 'series';
		$obj_series['values'] = $arr_series;
		$result[] = $obj_series;
		
		//Get model
		$query_model = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.model', 'order' => array('Car.model ASC')));
		$arr_model = array();
		foreach ($query_model as $a_data) {
			if($a_data['Car']['model'] != null)$arr_model[] = $a_data['Car']['model'];
		}
		$obj_model['name'] = 'model';
		$obj_model['field_name'] = 'model';
		$obj_model['values'] = $arr_model;
		$result[] = $obj_model;
		
		//Get Year
		$query_year = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.manu_year', 'order' => array('Car.manu_year DESC')));
		$arr_year = array();
		foreach ($query_year as $a_data) {
			if($a_data['Car']['manu_year'] != null)$arr_year[] = $a_data['Car']['manu_year'];
		}
		$obj_year_sale_from['name'] = 'year_sale_from';
		$obj_year_sale_from['field_name'] = 'manu_year_sale_from';
		$obj_year_sale_from['values'] = $arr_year;
		$result[] = $obj_year_sale_from;
		
		$obj_year_sale_to['name'] = 'year_sale_to';
		$obj_year_sale_to['field_name'] = 'manu_year_sale_to';
		$obj_year_sale_to['values'] = $arr_year;
		$result[] = $obj_year_sale_to;
		
		//Price car for sale
		$price = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.price', 'order' => array('Car.price ASC')));
		$arr_price = array();
		foreach ($price as $a_data) {
			if($a_data['Car']['price'] != null)$arr_price[] = $a_data['Car']['price'];
		}
		$obj_price_sale_from['name'] = 'price_sale_from';
		$obj_price_sale_from['field_name'] = 'price_sale_from';
		$obj_price_sale_from['values'] = $arr_price;
		$result[] = $obj_price_sale_from;
		
		$obj_price_sale_to['name'] = 'price_sale_to';
		$obj_price_sale_to['field_name'] = 'price_sale_to';
		$obj_price_sale_to['values'] = $arr_price;
		$result[] = $obj_price_sale_to;
		
		//Kilo car for sale
		$kilo = $this->Car->find('all', array('recursive' => -1, 'fields'=>'DISTINCT Car.odometer', 'order' => array('Car.odometer ASC')));
		$arr_kilo = array();
		foreach ($kilo as $a_data) {
			if($a_data['Car']['odometer'] != null)$arr_kilo[] = $a_data['Car']['odometer'];
		}
		$obj_kilometers_sale_from['name'] = 'kilometers_sale_from';
		$obj_kilometers_sale_from['field_name'] = 'odometer_sale_from';
		$obj_kilometers_sale_from['values'] = $arr_kilo;
		$result[] = $obj_kilometers_sale_from;
		
		$obj_kilometers_sale_to['name'] = 'kilometers_sale_to';
		$obj_kilometers_sale_to['field_name'] = 'odometer_sale_to';
		$obj_kilometers_sale_to['values'] = $arr_kilo;
		$result[] = $obj_kilometers_sale_to;
		
		$message = array();
		$message[] = $result;
		$message[] = $arr_make;
		
		
		die(json_encode(array('status' => 'success', 'message' => $message)));
	}
	
	public function getMyStockNewVersion(){
		$this->autoRender = false;
		$this->loadModel('Car'); 
		$item_count = 20;
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id', 'code' => '202')));
		}
		if (!isset($this->request->data['start'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post start', 'code' => '202')));
		}
		if (!isset($this->request->data['limit'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post end', 'code' => '202')));
		}
		if (!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type', 'code' => '202')));
		}
		$order_by = ' ';
		if($this->request->data['type'] == 1){
			$order_by = ' ORDER BY cars.price ASC '; 
		}else if($this->request->data['type'] == 2){
			$order_by = ' ORDER BY cars.price DESC ';
		}
		else if($this->request->data['type'] == 3){
			$order_by = ' ORDER BY cars.odometer ASC ';
		}
		else if($this->request->data['type'] == 4){
			$order_by = ' ORDER BY cars.odometer DESC ';
		}
		else if($this->request->data['type'] == 5){
			$order_by = ' ORDER BY cars.manu_year ASC ';
		}else if($this->request->data['type'] == 6){
			$order_by = ' ORDER BY cars.manu_year DESC ';
		}
		else if($this->request->data['type'] == 7){
			 $order_by = ' ORDER BY cars.make DESC, cars.model DESC '; 
		}
		else if($this->request->data['type'] == 8){
			$order_by = ' ORDER BY cars.make ASC, cars.model ASC '; 
		}
		$arr_cars = $this->Car->query("SELECT COUNT(images.id) AS image_count, images.is_server_sdc AS is_server_sdc,
		IF(images.is_server_sdc = 1, '/app/webroot/datafeed/' + images.image_file_name, images.image_file_name) AS image_url, 
		IF(networks.id > 0, 'true', 'false') AS is_network, IF(followed_cars.id > 0, 'true', 'false') AS is_follow, 
		(SELECT COUNT(*) FROM followed_cars F WHERE F.car_id = cars.id) AS view_count, 

		users.`name` AS dealer_name,
		users.email AS dealer_email,
		users.phone AS dealer_phone,
		CONCAT('/app/webroot/img/uploads/users_avatar/', users.avatar_file_name) AS dealer_avatar,
		users.company_name AS dealer_company,

		cars.* 

		FROM cars
		LEFT JOIN images ON images.car_id = cars.id
		LEFT JOIN networks ON (networks.member_id = cars.client_no AND networks.user_id = ".$this->request->data['user_id'].") OR (networks.member_id = ".$this->request->data['user_id']." AND networks.user_id = cars.client_no)
		LEFT JOIN followed_cars ON followed_cars.car_id = cars.id AND followed_cars.user_id = cars.client_no
		LEFT JOIN users ON users.id = cars.client_no

		WHERE cars.client_no = ".$this->request->data['user_id']." GROUP BY cars.id" .$order_by. "LIMIT ". $this->request->data['start'] .", ".$this->request->data['limit']);
		//$arr_cars = $this->Car->getMyStocksPrd(); 
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($arr_cars){
			$i = 0;
			foreach($arr_cars as $a_car_keyword){
				//$a_car_keyword['current_date'] = $current_date;
				$arr_cars[$i]['current_date'] = $current_date;
				$i ++;
				}
			}
		
		if($this->request->data['start'] == 0){
			$result_total = $this->Car->query("SELECT COUNT(*) AS count_car FROM cars WHERE cars.client_no = " .$this->request->data['user_id']);
			echo json_encode(array("cars" => $arr_cars, "total_car" => $result_total[0][0]['count_car']));//, "total_car" =>$result_total['count_car']
		}else{
			echo json_encode(array("cars" => $arr_cars));
		}
	}
	
	public function getOtherInforFromCar(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('User');
		$this->loadModel('Image');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id', 'code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id', 'code' => '202')));
		}
		if (!isset($this->request->data['client_no'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id', 'code' => '202')));
		}
		if (!isset($this->request->data['transactor_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id', 'code' => '202')));
		}
		//Get dealer infor
		$transaction_id = '';
		if($this->request->data['user_id'] == $this->request->data['client_no']){
			$transaction_id = $this->request->data['transactor_id'];
		}else if($this->request->data['user_id'] == $this->request->data['transactor_id']){
			$transaction_id = $this->request->data['client_no'];
		}
		$arr_infor = array();
		$this->User->unbindModel(array('hasMany' => array('Appchat', 'Block', 'Comment', 'Customer', 'FollowedCar', 'Message', 'Network', 'NotificationSetting', 'PushNotificationRegistration', 'ReadMark', 'Setandforget', 'ShareSetandforget', 'Subscription'), 'belongsTo' =>array('Role')));
		if($transaction_id != ''){
				$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
				if($dealer_infor){
					$arr_infor['transaction_infor'] = $dealer_infor['User'];
				}else{
					$arr_infor['transaction_infor'] = '';
				}
		}else{
			$arr_infor['transaction_infor'] = '';
		}
		$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $this->request->data['car_id'])));
		$arr_image = array();
		foreach ($image as $a_image) {
			$is_server_sdc = $a_image['Image']['is_server_sdc'];
				if($is_server_sdc == 1){
					$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
				}else{
					$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
				}
					$arr_image[] = $a_image['Image']; 
		}
		$arr_infor['images'] = $arr_image;
		return json_encode($arr_infor);
	}
	public function getMyStock(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Network');
		$this->loadModel('User');
		$car = array();
		$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
		$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('client_no' => $this->request->data['user_id'])));
		//$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Transfer')));
		//$result = $this->Car->find('all',array('contain'=>array('Image'), 'conditions'=> array('client_no' => $this->request->data['user_id'])));
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result){
			foreach ($result as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				} 
				//Check buy-0/sell-1/pending-2
				if($car_result['Car']['transactor_id'] != -1){
					$car_result['Car']['transaction_status'] = 2;
				}else{
					if($car_result['Car']['client_no'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status'] = 1;
					}else{
						$car_result['Car']['transaction_status'] = 0;
					}
				}
				
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				$this->User->unbindModel(array('hasMany' => array('Appchat', 'Block', 'Comment', 'Customer', 'FollowedCar', 'Message', 'Network', 'NotificationSetting', 'PushNotificationRegistration', 'ReadMark', 'Setandforget', 'ShareSetandforget', 'Subscription'), 'belongsTo' =>array('Role')));
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car[] = $car_result['Car'];
			}
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		}else{
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		} 
		echo json_encode($result_return);
	}
	
	public function addComment(){
		$this->autoRender = false;
		$this->loadModel('Comment');
		$this->loadModel('User');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id', 'code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['comment'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post comment','code' => '202')));
		}
		$user_id = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->request->data['user_id'])));
		if(!$user_id){
			die(json_encode(array('status' => 'Fail', 'response' => 'User_id not existed')));
		}
		
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_add_comment['Comment']['car_id'] = $this->request->data['car_id'];
		$arr_add_comment['Comment']['user_id'] = $this->request->data['user_id'];
		$arr_add_comment['Comment']['comment'] = $this->request->data['comment'];
		$arr_add_comment['Comment']['updated_at'] = $current_time;
		$arr_add_comment['Comment']['created_at'] = $current_time;
		if ($this->Comment->save($arr_add_comment)) {
			 $result = array();
			 $comment = array();
			 $user = array();
			 $comment['id'] = $this->Comment->id;
			 $comment['created_at'] = $current_time;
			 $comment['comment'] = $this->request->data['comment'];
			 $a_user = $this->User->find('first',array('recursive' => -1, 'fields' => array('User.name', 'User.id', 'User.email', 'User.phone', 'User.company_name'), 'conditions'=> array('User.id' => $this->request->data['user_id'])));
			 if($a_user){
				$result['user'] = $a_user['User'];
			 }
			 $result['comment'] = $comment;
			 return json_encode(array("status" => 'success', "result" => $result));
		}else{
			return json_encode(array("status" => 'fail'));
		}
	}
	
	public function deleteMyStock(){
		$this->autoRender = false;
		$this->loadModel('Comment');
		$this->loadModel('Car');
		$this->loadModel('Image');
		
		$folder_url = WWW_ROOT . "img/uploads/car_images";
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		$this->Car->id = $this->request->data['car_id'];
		if ($this->Car->delete()) {
			//$this->Comment->car_id = $this->request->data['car_id'];
			$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $this->request->data['car_id'])));
				foreach ($image as $a_image) {
					$file = new File(WWW_ROOT . 'img/uploads/car_images/'.$a_image['Image']['image_file_name'], false, 0777);
						if($file->delete()) {
						   
						}
				}
			$delete = $this->Comment->query('Delete from comments where comments.car_id = '.$this->request->data['car_id']);
			if ($delete) {
			}
			die(json_encode(array('status' => 'success')));
		} else {
			die(json_encode(array('status' => 'Fail', 'response' => 'Manage_id not existed')));
		}
	}
	
	public function getOtherStockNewVersion(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		
		$this->autoRender = false;
		$this->loadModel('Car'); 
		$item_count = 20;
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id', 'code' => '202')));
		}
		if (!isset($this->request->data['client_no'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if (!isset($this->request->data['start'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post start', 'code' => '202')));
		}
		if (!isset($this->request->data['limit'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post end', 'code' => '202')));
		}
		if (!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type', 'code' => '202')));
		}
		$order_by = ' ';
		if($this->request->data['type'] == 1){
			$order_by = ' ORDER BY cars.price ASC '; 
		}else if($this->request->data['type'] == 2){
			$order_by = ' ORDER BY cars.price DESC ';
		}
		else if($this->request->data['type'] == 3){
			$order_by = ' ORDER BY cars.odometer ASC ';
		}
		else if($this->request->data['type'] == 4){
			$order_by = ' ORDER BY cars.odometer DESC ';
		}
		else if($this->request->data['type'] == 5){
			$order_by = ' ORDER BY cars.manu_year ASC ';
		}else if($this->request->data['type'] == 6){
			$order_by = ' ORDER BY cars.manu_year DESC ';
		}
		else if($this->request->data['type'] == 7){
			 $order_by = ' ORDER BY cars.make DESC, cars.model DESC '; 
		}
		else if($this->request->data['type'] == 8){
			$order_by = ' ORDER BY cars.make ASC, cars.model ASC '; 
		}
		$arr_cars = $this->Car->query("SELECT COUNT(images.id) AS image_count, images.is_server_sdc AS is_server_sdc,
		IF(images.is_server_sdc = 1, '/app/webroot/datafeed/' + images.image_file_name, images.image_file_name) AS image_url, 
		IF(networks.id > 0, 'true', 'false') AS is_network, IF(followed_cars.id > 0, 'true', 'false') AS is_follow, 
		(SELECT COUNT(*) FROM followed_cars F WHERE F.car_id = cars.id) AS view_count, 

		users.`name` AS dealer_name,
		users.email AS dealer_email,
		users.phone AS dealer_phone,
		CONCAT('/app/webroot/img/uploads/users_avatar/', users.avatar_file_name) AS dealer_avatar,
		users.company_name AS dealer_company,

		cars.* 

		FROM cars
		LEFT JOIN images ON images.car_id = cars.id
		LEFT JOIN networks ON (networks.member_id = cars.client_no AND networks.user_id = ".$this->request->data['user_id'].") OR (networks.member_id = ".$this->request->data['user_id']." AND networks.user_id = cars.client_no)
		LEFT JOIN followed_cars ON followed_cars.car_id = cars.id AND followed_cars.user_id = cars.client_no
		LEFT JOIN users ON users.id = cars.client_no

		WHERE cars.client_no = ".$this->request->data['client_no']." GROUP BY cars.id" .$order_by. "LIMIT ". $this->request->data['start'] .", ".$this->request->data['limit']);
		//$arr_cars = $this->Car->getMyStocksPrd(); 
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($arr_cars){
			$i = 0;
			foreach($arr_cars as $a_car_keyword){
				//$a_car_keyword['current_date'] = $current_date;
				$arr_cars[$i]['current_date'] = $current_date;
				$i ++;
				}
		}	
		
		if($this->request->data['start'] == 0){
			$result_total = $this->Car->query("SELECT COUNT(*) AS count_car FROM cars WHERE cars.client_no = " .$this->request->data['client_no']);
			echo json_encode(array("cars" => $arr_cars, "total_car" => $result_total[0][0]['count_car']));//, "total_car" =>$result_total['count_car']
		}else{
			echo json_encode(array("cars" => $arr_cars));
		}
	}
	
	public function getOtherStock(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['client_no'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		$car = array();
		$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.client_no' => $this->request->data['client_no'], 'Car.active <> 2')));
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result){
			foreach ($result as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true; 
				}else{
					$car_result['Car']['is_network'] = false;
				}
				
				//Check buy-0/sell-1/pending-2
				if($car_result['Car']['transactor_id'] != -1){
					$car_result['Car']['transaction_status'] = 2;
				}else{
					if($car_result['Car']['client_no'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status'] = 1;
					}else{
						$car_result['Car']['transaction_status'] = 0;
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				
				$car[] = $car_result['Car'];
			}
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		}else{
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		} 
		echo json_encode($result_return);
	}
	
	public function followCar(){
		$this->autoRender = false;
		$this->loadModel('FollowedCar');
		$this->loadModel('PushNotificationRegistration');
		$this->loadModel('User');
		$this->loadModel('Car');
		$this->loadModel('NotificationSetting');
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post member id','code' => '202')));
		}
		$result_car1 = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $this->request->data['car_id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
		if(!$result_car1){
			$date = new DateTime(); 
			$current_time = $date->format('Y-m-d H:i:s') ;
			$arr_add['FollowedCar']['user_id'] = $this->request->data['user_id'];
			$arr_add['FollowedCar']['car_id'] = $this->request->data['car_id'];
			$arr_add['FollowedCar']['created_at'] = $current_time;
			$arr_add['FollowedCar']['updated_at'] = $current_time;
			if ($this->FollowedCar->save($arr_add)) {
				$follower = $this->User->find('first',array('recursive' => -1, 'fields' => array('User.name'),'conditions'=> array('User.id' => $this->request->data['user_id'])));
				$carInfor = $this->Car->find('first',array('recursive' => -1, 'fields' => array('Car.client_no'),'conditions'=> array('Car.id' => $this->request->data['car_id'])));
				if($carInfor){
					$result_gcm = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $carInfor['Car']['client_no'])));
					$data = array();
					if($result_gcm){
						$arr_gcm_android = array();
						$arr_gcm_ios = array();
						foreach($result_gcm as $a_result_gcm){
							if($a_result_gcm['PushNotificationRegistration']['os']==0){
								$arr_gcm_android[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
							}else{
								$arr_gcm_ios[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
							}
						}
						$data['message']= $follower['User']['name'] . " is following your car";
						if(sizeof($arr_gcm_android) > 0){
							$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $carInfor['Car']['client_no'], 'NotificationSetting.notification_id' => '9')));
							if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
								$gcm = new GCM();
								$data['settings'] = $settings['NotificationSetting'];
								$push_result = $gcm->send_notification($arr_gcm_android, $data);					
								if($push_result== false) { 
								}
							}
						}
						if(sizeof($arr_gcm_ios) > 0){
								$HttpSocket = new HttpSocket();
								$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $this->request->data['dealer_name'] . " accepted invitation from you", 'dt' => $arr_gcm_ios));
						}
					}
				}
			}
		} 
		$result_car = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $this->request->data['car_id'])));
		$count = 0;
		if($result_car){
			$count = sizeof($result_car);
		}
		die(json_encode(array('status' => 'success', 'view_count' => $count)));
	}
	public function unfollowCar(){
		$this->autoRender = false;
		$this->loadModel('FollowedCar');
		
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post member id','code' => '202')));
		}
		$delete = $this->FollowedCar->query('Delete from followed_cars where followed_cars.user_id = ' .$this->request->data['user_id'] . ' AND followed_cars.car_id =' .$this->request->data['car_id']);
		if ($delete) {
		}
		$result_car = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $this->request->data['car_id'])));
		$count = 0;
		if($result_car){
			$count = sizeof($result_car);
		}
		die(json_encode(array('status' => 'success', 'view_count' => $count)));
	}
	
	public function addNetwork(){
		$this->autoRender = false;
		$this->loadModel('Network');
		$this->loadModel('PushNotificationRegistration');
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if (!isset($this->request->data['member_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post member id','code' => '202')));
		}
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_add['Network']['user_id'] = $this->request->data['user_id'];
		$arr_add['Network']['member_id'] = $this->request->data['member_id'];
		$arr_add['Network']['created_at'] = $current_time;
		$arr_add['Network']['updated_at'] = $current_time;
		if ($this->Network->save($arr_add)) {
			$result_gcm = $this->PushNotificationRegistration->find('first',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $this->request->data['user_id'])));
			$data = array();
			if($result_gcm){
			$arr_gcm = array();
			$arr_gcm[] = $result_gcm['PushNotificationRegistration']['gcm_reg'];
				$gcm = new GCM();
				$data['message']="push successfully";						
				$push_result = $gcm->send_notification($arr_gcm, $data);					
				if($push_result== false) {
					//$data['message']="Push failed.";
				}
			}
			die(json_encode(array('status' => 'success', "reponse" =>$data)));
		}else{
			die(json_encode(array('status' => 'success')));
		}
	}
	
	public function removeNetwork(){
		$this->autoRender = false;
		$this->loadModel('Network');
		
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if (!isset($this->request->data['member_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post member id','code' => '202')));
		}
		$delete = $this->Network->query('Delete from networks where (networks.user_id = ' .$this->request->data['user_id'] . ' AND networks.member_id =' .$this->request->data['member_id'].') OR ' . '(networks.user_id = ' .$this->request->data['member_id'] . ' AND networks.member_id =' .$this->request->data['user_id'].')');
		if ($delete) {
			die(json_encode(array('status' => 'success')));
		}else{
			die(json_encode(array('status' => 'success')));
		}
	}
	
	public function getFollowed(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		$result_return = array();
		$car = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		$result_followed = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.user_id' => $this->request->data['user_id'])));
		if($result_followed){
			foreach($result_followed as $a_result_followed){
				$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.id' => $a_result_followed['FollowedCar']['car_id'], 'Car.active <> 2')));
						if($result){
							foreach ($result as $car_result) {
								$arr_image = array();
								$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $a_result_followed['FollowedCar']['car_id'])));
								foreach ($image as $a_image) {
									$is_server_sdc = $a_image['Image']['is_server_sdc'];
									if($is_server_sdc == 1){
										$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
									}else{
										$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
									}
									$arr_image[] = $a_image['Image']; 
								}
								$car_result['Car']['images'] = $arr_image;
								
								$car_result['Car']['current_date'] = $current_date;
								//Check Follow
								$car_result['Car']['is_follow'] = true;
								
								//get view count
								$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
								$car_result['Car']['view_count'] = sizeof($view_count);
								
								//Check my network
								$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
								if($my_network){
									$car_result['Car']['is_network'] = true;
								}else{
									$car_result['Car']['is_network'] = false;
								}
								
								//Check buy-0/sell-1/pending-2
								if($car_result['Car']['transactor_id'] != -1){
									$car_result['Car']['transaction_status'] = 2;
								}else{
									if($car_result['Car']['client_no'] == $this->request->data['user_id']){
										$car_result['Car']['transaction_status'] = 1;
									}else{
										$car_result['Car']['transaction_status'] = 0;
									}
								}
								//Get dealer infor
								$transaction_id = '';
								if($this->request->data['user_id'] == $car_result['Car']['client_no']){
									$transaction_id = $car_result['Car']['transactor_id'];
								}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
									$transaction_id = $car_result['Car']['client_no'];
								}
								if($transaction_id != ''){
									$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
									if($dealer_infor){
											$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
									}else{
											$car_result['Car']['transaction_infor'] = '';
									}
								}
								//Get dealer name
									$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
									if($user){
										$car_result['Car']['dealer_name'] = $user['User']['name'];
										$car_result['Car']['dealer_email'] = $user['User']['email'];
										$car_result['Car']['dealer_phone'] = $user['User']['phone'];
										$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
										$car_result['Car']['dealer_company'] = $user['User']['company_name'];
									}else{
										$car_result['Car']['dealer_name'] = '';
										$car_result['Car']['dealer_email'] = '';
										$car_result['Car']['dealer_phone'] = '';
										$car_result['Car']['dealer_avatar'] = '';
										$car_result['Car']['dealer_company'] = '';
									}
								$car[] = $car_result['Car'];
							}
					}
			}
		}
		$result_return['status'] = 'success';
		$result_return['cars'] = $car;
		echo json_encode($result_return);
	}
	
	public function getMyNetwork(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$this->loadModel('Block');
		$this->loadModel('InviteNetwork');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['user_email'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user_email','code' => '202')));
		}
		$arr_network = $this->User->find('all', array(
				   'fields' => array('User.*'),
				   'joins' => array(array('table' => 'networks',
										   'alias' => 'Network',
										   'type' => 'INNER',
										   'conditions' => array('Network.member_id'=>$this->request->data['user_id'], 'User.id = Network.user_id')
									 ))
					)
			  );
		$arr_network_right = $this->User->find('all', array(
				   'fields' => array('User.*'),
				   'joins' => array(array('table' => 'networks',
										   'alias' => 'Network',
										   'type' => 'INNER',
										   'conditions' => array('Network.user_id'=>$this->request->data['user_id'], 'User.id = Network.member_id')))			 
					)
			  ); 
		
		foreach($arr_network_right as $a_arr_network_right){
			$arr_network[] = $a_arr_network_right;
		}
		$arr_result = array();
		foreach($arr_network as $a_arr_network){
			$result_car = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.client_no' => $a_arr_network['User']['id'])));
			$a_arr_network['User']['size_car'] = sizeof($result_car);
			$a_arr_network['User']['avatar'] = '/app/webroot/img/uploads/users_avatar/' . $a_arr_network['User']['avatar_file_name'];
			$request = $this->Block->find('first', array('recursive' => -1, 'conditions' => array('Block.user_id' =>$this->request->data['user_id'],'Block.blocker_id' =>$a_arr_network['User']['id'])));
			if($request){
				$a_arr_network['User']['is_block'] = true;
			}else{
				$a_arr_network['User']['is_block'] = false;
			}
			$arr_result[] = $a_arr_network['User'];
		} 
		$arr_invite_network = $this->InviteNetwork->find('all', array('recursive' => -1, 'conditions' => array('OR' => array(array('InviteNetwork.request_email' => $this->request->data['user_email']), array('InviteNetwork.sender_id' => $this->request->data['user_id'])))));
		echo json_encode(array('status' => 'success', 'networks' => $arr_result, 'count_invite' => sizeof($arr_invite_network)));
	}
	
	public function getStockNetwork(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		$arr = json_decode($this->request->data['network_ids']);
		$result_return = array();
		$car = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		foreach($arr as $user_id){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.client_no' => $user_id, 'Car.active <> 2')));
			if($result){
				foreach ($result as $car_result) {
					$arr_image = array();
					$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
					foreach ($image as $a_image) {
						$is_server_sdc = $a_image['Image']['is_server_sdc'];
						if($is_server_sdc == 1){
							$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
						}else{
							$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
						}
						$arr_image[] = $a_image['Image']; 
					}
					$car_result['Car']['images'] = $arr_image;
					
					$car_result['Car']['current_date'] = $current_date;
					//Check Follow
					
					$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
					if($followed){
						$car_result['Car']['is_follow'] = true;
					}else{
						$car_result['Car']['is_follow'] = false;
					}
					
					//get view count
					$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
					$car_result['Car']['view_count'] = sizeof($view_count);
					
					//Check my network
					$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
					if($my_network){
						$car_result['Car']['is_network'] = true;
					}else{
						$car_result['Car']['is_network'] = false;
					}
					
					//Check buy-0/sell-1/pending-2
					if($car_result['Car']['transactor_id'] != -1){
						$car_result['Car']['transaction_status'] = 2;
					}else{
						if($car_result['Car']['client_no'] == $this->request->data['user_id']){
							$car_result['Car']['transaction_status'] = 1;
						}else{
							$car_result['Car']['transaction_status'] = 0;
						}
					}
					//Get dealer infor
					$transaction_id = '';
					if($this->request->data['user_id'] == $car_result['Car']['client_no']){
						$transaction_id = $car_result['Car']['transactor_id'];
					}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
						$transaction_id = $car_result['Car']['client_no'];
					}
					if($transaction_id != ''){
						$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
						if($dealer_infor){
								$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
						}else{
								$car_result['Car']['transaction_infor'] = '';
						}
					}
					//Get dealer name
					$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
					if($user){
						$car_result['Car']['dealer_name'] = $user['User']['name'];
						$car_result['Car']['dealer_email'] = $user['User']['email'];
						$car_result['Car']['dealer_phone'] = $user['User']['phone'];
						$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
						$car_result['Car']['dealer_company'] = $user['User']['company_name'];
					}else{
						$car_result['Car']['dealer_name'] = '';
						$car_result['Car']['dealer_email'] = '';
						$car_result['Car']['dealer_phone'] = '';
						$car_result['Car']['dealer_avatar'] = '';
						$car_result['Car']['dealer_company'] = '';
					}
					$car[] = $car_result['Car'];
				}
			}
		}
		$result_return['status'] = 'success';
		$result_return['cars'] = $car;
		echo json_encode($result_return);
	}
	
	public function getWellcomeInfor(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$this->loadModel('Setandforget');
		$this->loadModel('Customer');
		if($this->request->data['user_id'] == 154){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if(!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type request','code' => '202')));
		}
		$result_return = array();
		//Car follow
		$result_followed = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.user_id' => $this->request->data['user_id'])));
		$result['cars_follow'] = sizeof($result_followed);
		//Car sold
		$result_sold = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.active' => '0')));
		$result['cars_sold'] = sizeof($result_sold);
		//set and forget
		$result_forget = $this->Setandforget->find('all',array('recursive' => -1, 'conditions'=> array('Setandforget.user_id' => $this->request->data['user_id'])));
		$result['cars_set_and_forget'] = sizeof($result_forget);
		// conversations
		$result['unread_conversations'] = 0;
		// Dealer count
		$arr_network = $this->Network->find('all',array('recursive' => -1, 'conditions'=>array('OR'=>array(array('Network.user_id'=>$this->request->data['user_id']), array('Network.member_id'=>$this->request->data['user_id']))))); 
		$result['dealers_count'] = sizeof($arr_network);
		//Cars of dealer
		$count_car = 0;
		$cars_network = array();
		$dealer_ids = array();
		/*foreach($arr_network as $a_arr_network){
			$result_car = $this->Car->find('all',array('conditions'=> array('Car.client_no' => $a_arr_network['User']['id'])));
			$count_car += sizeof($result_car);
			$dealer_ids[] = $a_arr_network['User']['id'];
		}*/
		$result_car = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.client_no' => $this->request->data['user_id'])));
		$count_car = sizeof($result_car);
		$cars_network['count'] =  $count_car;
		$cars_network['dealer_id']  = $dealer_ids;
		$result['network_cars'] = $cars_network;
		
		//Get customer
		$arr_customer = $this->Customer->find('all', array('recursive' => -1, 'conditions' => array('Customer.user_id = '.$this->request->data['user_id']))); 
		$result['customer_count'] = sizeof($arr_customer);
		//Count Transaction
		$result_selling = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.client_no' => $this->request->data['user_id'], 'Car.transactor_id<>-1')));
		$result_buying = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.transactor_id'=>$this->request->data['user_id'])));
		$result['transaction_count'] = sizeof($result_selling) + sizeof($result_buying);
		//Get Car Random
		$car = array();
		$is_next_page = true;
		if($this->request->data['type'] == 0){
			//$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => 'RAND()', 'limit' => '50'));
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'limit' => 20, 'offset'=>0));
			//$resultFlicar_next = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'limit' => 20, 'offset'=>1));
			//if($resultFlicar_next)$is_next_page = true; 
		}else if($this->request->data['type'] == 1){
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price DESC'), 'limit' => '50'));
		}else if($this->request->data['type'] == 2){
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price ASC'), 'limit' => '50'));
		}else if($this->request->data['type'] == 4){
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.created_at DESC'), 'limit' => '50'));
		}else{
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => 'RAND()', 'limit' => '50'));
		}
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($resultFlicar){
			foreach ($resultFlicar as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				}
				
				//Check buy-0/sell-1/pending-2
				if($car_result['Car']['transactor_id'] != -1){
					$car_result['Car']['transaction_status'] = 2;
				}else{
					if($car_result['Car']['client_no'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status'] = 1;
					}else{
						$car_result['Car']['transaction_status'] = 0;
					}
				}		
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car[] = $car_result['Car'];
			}
		}else{
		}
		return json_encode(array('status' => 'success', 'infor' => $result, 'flicarr' => $car, 'is_next_page' =>$is_next_page));
	}
	public function getWellcomeInforNewVersion(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$this->loadModel('Setandforget');
		$this->loadModel('Customer');
		if($this->request->data['user_id'] == 154){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if(!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type request','code' => '202')));
		}
		if (!isset($this->request->data['start'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post start','code' => '202')));
		}
		if (!isset($this->request->data['limit'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post limit','code' => '202')));
		}
		$result_return = array();
		//Car follow
		$result_followed = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.user_id' => $this->request->data['user_id'])));
		$result['cars_follow'] = sizeof($result_followed);
		//Car sold
		$result_sold = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.active' => '0')));
		$result['cars_sold'] = sizeof($result_sold);
		//set and forget
		$result_forget = $this->Setandforget->find('all',array('recursive' => -1, 'conditions'=> array('Setandforget.user_id' => $this->request->data['user_id'])));
		$result['cars_set_and_forget'] = sizeof($result_forget);
		// conversations
		$result['unread_conversations'] = 0;
		// Dealer count
		$arr_network = $this->Network->find('all',array('recursive' => -1, 'conditions'=>array('OR'=>array(array('Network.user_id'=>$this->request->data['user_id']), array('Network.member_id'=>$this->request->data['user_id']))))); 
		$result['dealers_count'] = sizeof($arr_network);
		//Cars of dealer
		$count_car = 0;
		$cars_network = array();
		$dealer_ids = array();
		/*foreach($arr_network as $a_arr_network){
			$result_car = $this->Car->find('all',array('conditions'=> array('Car.client_no' => $a_arr_network['User']['id'])));
			$count_car += sizeof($result_car);
			$dealer_ids[] = $a_arr_network['User']['id'];
		}*/
		$result_car = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.client_no' => $this->request->data['user_id'])));
		$count_car = sizeof($result_car);
		$cars_network['count'] =  $count_car;
		$cars_network['dealer_id']  = $dealer_ids;
		$result['network_cars'] = $cars_network;
		
		//Get customer
		$arr_customer = $this->Customer->find('all', array('recursive' => -1, 'conditions' => array('Customer.user_id = '.$this->request->data['user_id']))); 
		$result['customer_count'] = sizeof($arr_customer);
		//Count Transaction
		$result_selling = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.client_no' => $this->request->data['user_id'], 'Car.transactor_id<>-1')));
		$result_buying = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.transactor_id'=>$this->request->data['user_id'])));
		$result['transaction_count'] = sizeof($result_selling) + sizeof($result_buying);
		//Get Car Random
		$car = array();
		$is_next_page = true;
		if($this->request->data['type'] == 0){
			//$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => 'RAND()', 'limit' => '50'));
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'limit' => 20, 'offset'=>0));
			//$resultFlicar_next = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'limit' => 20, 'offset'=>1));
			//if($resultFlicar_next)$is_next_page = true; 
		}else if($this->request->data['type'] == 1){
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price DESC'), 'limit' => '50'));
		}else if($this->request->data['type'] == 2){
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price ASC'), 'limit' => '50'));
		}else if($this->request->data['type'] == 4){
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.created_at DESC'), 'limit' => '50'));
		}else{
			$resultFlicar = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => 'RAND()', 'limit' => '50'));
		}
		$result_return = array();
		/*$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($resultFlicar){
			foreach ($resultFlicar as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				}
				
				//Check buy-0/sell-1/pending-2
				if($car_result['Car']['transactor_id'] != -1){
					$car_result['Car']['transaction_status'] = 2;
				}else{
					if($car_result['Car']['client_no'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status'] = 1;
					}else{
						$car_result['Car']['transaction_status'] = 0;
					}
				}		
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car[] = $car_result['Car'];
			}
		}else{
		}*/
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		$arr_cars = $this->Car->query("SELECT COUNT(images.id) AS image_count, images.is_server_sdc AS is_server_sdc,
		IF(images.is_server_sdc = 1, '/app/webroot/datafeed/' + images.image_file_name, images.image_file_name) AS image_url, 
		IF(networks.id > 0, 'true', 'false') AS is_network, IF(followed_cars.id > 0, 'true', 'false') AS is_follow, 
		(SELECT COUNT(*) FROM followed_cars F WHERE F.car_id = cars.id) AS view_count, 
		DATE_FORMAT(NOW(),'%d-%M-%y') AS current_date,
		users.`name` AS dealer_name,
		users.email AS dealer_email,
		users.phone AS dealer_phone,
		CONCAT('/app/webroot/img/uploads/users_avatar/', users.avatar_file_name) AS dealer_avatar,
		users.company_name AS dealer_company,

		cars.* 

		FROM cars
		LEFT JOIN images ON images.car_id = cars.id
		LEFT JOIN networks ON (networks.member_id = cars.client_no AND networks.user_id = ".$this->request->data['user_id'].") OR (networks.member_id = ".$this->request->data['user_id']." AND networks.user_id = cars.client_no)
		LEFT JOIN followed_cars ON followed_cars.car_id = cars.id AND followed_cars.user_id = cars.client_no
		LEFT JOIN users ON users.id = cars.client_no

		 GROUP BY cars.id LIMIT ". $this->request->data['start'] .", ".$this->request->data['limit']);
		//$arr_cars = $this->Car->getMyStocksPrd(); 
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($arr_cars){
			$i = 0;
			foreach($arr_cars as $a_car_keyword){
				//$a_car_keyword['current_date'] = $current_date;
				$arr_cars[$i]['current_date'] = $current_date;
				$i ++;
				}
			}
		return json_encode(array('status' => 'success', 'infor' => $result, 'flicarr' => $arr_cars));
	}
	
	public function getCarByType(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Network');
		$this->loadModel('User');
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		$car = array();
		$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('client_no' => $this->request->data['user_id'], 'active' =>$this->request->data['type'])));
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result){
			foreach ($result as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				} 
				
				//Check buy-0/sell-1/pending-2
				if($car_result['Car']['transactor_id'] != -1){
					$car_result['Car']['transaction_status'] = 2;
				}else{
					if($car_result['Car']['client_no'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status'] = 1;
					}else{
						$car_result['Car']['transaction_status'] = 0;
					}
				}
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car[] = $car_result['Car'];
			}
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		}else{
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		} 
		echo json_encode($result_return);
	}
	
	public function updateCarType(){
		$this->autoRender = false;
		$this->loadModel('Car');
		
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id', 'code' => '202')));
		}
	
		$manage_id = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.id' => $this->request->data['car_id'])));
		if(!$manage_id){
			die(json_encode(array('status' => 'Fail', 'response' => 'Car_id not existed')));
		}
		
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_update['Car']['updated_at'] = $current_time;
		$arr_update['Car']['active'] = $this->request->data['type'];
		$this->Car->id = $this->request->data['car_id'];
		if ($this->Car->save($arr_update)) {
			 return json_encode(array("status" => 'success'));
		}else{
			return json_encode(array("status" => 'fail'));
		}
	}
	
	public function getFlicarrLoadMoreNewVersion(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Network');
		$this->loadModel('User');
		
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id', 'code' => '202')));
		}
		if (!isset($this->request->data['start'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post start', 'code' => '202')));
		}
		if (!isset($this->request->data['limit'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post end', 'code' => '202')));
		}
		if (!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type', 'code' => '202')));
		}
		
		$order_by = ' ';
		if($this->request->data['type'] == 1){
			$order_by = ' ORDER BY cars.price ASC '; 
		}else if($this->request->data['type'] == 2){
			$order_by = ' ORDER BY cars.price DESC ';
		}
		else if($this->request->data['type'] == 3){
			$order_by = ' ORDER BY cars.updated_at ASC ';
		}
		else if($this->request->data['type'] == 4){
			$order_by = ' ORDER BY cars.updated_at DESC ';
		}
		
		$arr_cars = $this->Car->query("SELECT COUNT(images.id) AS image_count, images.is_server_sdc AS is_server_sdc,
		IF(images.is_server_sdc = 1, '/app/webroot/datafeed/' + images.image_file_name, images.image_file_name) AS image_url, 
		IF(networks.id > 0, 'true', 'false') AS is_network, IF(followed_cars.id > 0, 'true', 'false') AS is_follow, 
		(SELECT COUNT(*) FROM followed_cars F WHERE F.car_id = cars.id) AS view_count, 

		users.`name` AS dealer_name,
		users.email AS dealer_email,
		users.phone AS dealer_phone,
		CONCAT('/app/webroot/img/uploads/users_avatar/', users.avatar_file_name) AS dealer_avatar,
		users.company_name AS dealer_company,

		cars.* 

		FROM cars
		LEFT JOIN images ON images.car_id = cars.id
		LEFT JOIN networks ON (networks.member_id = cars.client_no AND networks.user_id = ".$this->request->data['user_id'].") OR (networks.member_id = ".$this->request->data['user_id']." AND networks.user_id = cars.client_no)
		LEFT JOIN followed_cars ON followed_cars.car_id = cars.id AND followed_cars.user_id = cars.client_no
		LEFT JOIN users ON users.id = cars.client_no GROUP BY cars.id" .$order_by. "LIMIT ". $this->request->data['start'] .", ".$this->request->data['limit']);
		//$arr_cars = $this->Car->getMyStocksPrd(); 
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($arr_cars){
			$i = 0;
			foreach($arr_cars as $a_car_keyword){
				//$a_car_keyword['current_date'] = $current_date;
				$arr_cars[$i]['current_date'] = $current_date;
				$i ++;
				}
			}
		
		echo json_encode(array("cars" => $arr_cars));
	}
	
	public function getFlicarrLoadMore(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Network');
		$this->loadModel('User');
		$car = array();
		$num_item = 20;
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if(!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type request','code' => '202')));
		}
		if(!isset($this->request->data['page'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post page','code' => '202')));
		}
		$page = $this->request->data['page'];
		
		$is_next_page = false;
		if($this->request->data['type'] == 0){ 
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'limit' => $num_item, 'offset'=>$page*$num_item));
			$result_next = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'limit' => $num_item, 'offset'=>($page + 1)*$num_item));
			if($result_next){ $is_next_page = true; }
		}else if($this->request->data['type'] == 1){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price DESC'), 'limit' => $num_item, 'offset'=>$page*$num_item));
			$result_next = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price DESC'), 'limit' => $num_item, 'offset'=>($page+1)*$num_item));
			if($result_next){ $is_next_page = true; }
		}else if($this->request->data['type'] == 2){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price ASC'), 'limit' => $num_item, 'offset'=>$page*$num_item));
			$result_next = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price ASC'), 'limit' => $num_item, 'offset'=>($page+1)*$num_item));
			if($result_next){ $is_next_page = true; }
		}else if($this->request->data['type'] == 3){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.updated_at DESC'), 'limit' => $num_item, 'offset'=>$page*$num_item));
			$result_next = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.updated_at DESC'), 'limit' => $num_item, 'offset'=>($page+1)*$num_item));
			if($result_next){ $is_next_page = true; }
		}else if($this->request->data['type'] == 4){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.updated_at ASC'), 'limit' => $num_item, 'offset'=>$page*$num_item));
			$result_next = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.updated_at ASC'), 'limit' => $num_item, 'offset'=>($page+1)*$num_item));
			if($result_next){ $is_next_page = true; }
		}else {
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'limit' => $num_item, 'offset'=>$page*$num_item));
			$result_next = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'limit' => $num_item, 'offset'=>($page + 1)*$num_item));
			if($result_next){ $is_next_page = true; }
		}
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result){
			foreach ($result as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				} 
				//Check buy-0/sell-1/pending-2
				if($car_result['Car']['transactor_id'] != -1){
					$car_result['Car']['transaction_status'] = 2;
				}else{
					if($car_result['Car']['client_no'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status'] = 1;
					}else{
						$car_result['Car']['transaction_status'] = 0;
					}
				}
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
					
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car[] = $car_result['Car'];
			}
			$result_return['status'] = 'success';
			$result_return['is_next_page'] = $is_next_page;
			$result_return['cars'] = $car;
		}else{
			$result_return['status'] = 'success';
			$result_return['is_next_page'] = $is_next_page;
			$result_return['cars'] = $car;
		} 
		echo json_encode($result_return);
	}
	
	public function getFlicarr(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Network');
		$this->loadModel('User');
		if($this->request->data['user_id'] == 154){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		$car = array();
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if(!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type request','code' => '202')));
		}
		if($this->request->data['type'] == 0){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => 'RAND()', 'limit' => '50'));
		}else if($this->request->data['type'] == 1){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price DESC'), 'limit' => '50'));
		}else if($this->request->data['type'] == 2){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.price ASC'), 'limit' => '50'));
		}else if($this->request->data['type'] == 3){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.updated_at DESC'), 'limit' => '50'));
		}else if($this->request->data['type'] == 4){
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => array('Car.updated_at ASC'), 'limit' => '50'));
		}else {
			$result = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('active' =>0), 'order' => 'RAND()', 'limit' => '50'));
		}
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result){
			foreach ($result as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				} 
				//Check buy-0/sell-1/pending-2
				if($car_result['Car']['transactor_id'] != -1){
					$car_result['Car']['transaction_status'] = 2;
				}else{
					if($car_result['Car']['client_no'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status'] = 1;
					}else{
						$car_result['Car']['transaction_status'] = 0;
					}
				}
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
					
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car[] = $car_result['Car'];
			}
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		}else{
			$result_return['status'] = 'success';
			$result_return['cars'] = $car;
		} 
		echo json_encode($result_return);
	}
	
	public function getVins(){
		$this->autoRender = false;
		$sURL = "http://ppsr.identicar.com.au/api/search/series/BMW/Z4";
		$aHTTP['http']['method']  = 'POST';
		$aHTTP['http']['header']  = "Authorization: Basic bWVkaWF0YWc6ZVwickpwcUV6PkYrNSxEMg==\r\n";
		$aHTTP['http']['header'] .= "Content-Type: application/json\r\n";
		$context = stream_context_create($aHTTP);
		$contents = file_get_contents($sURL, false, $context);
		$json = json_decode($contents, true);
		if($json['success'] == true){
			//echo $json['results']['other_vins'];
			foreach($json['results'] as $a){
				//$array_data = implode("array_separator", $a);
				//echo json_encode($a['other_vins']);
				echo serialize($a['other_vins']);
			}
		}
	}
	
	public function addCustomer(){
		$this->autoRender = false;
		$this->loadModel('Customer');
		$this->loadModel('User');
		if (!isset($this->request->data['arr_customer'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post array customer', 'code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		
		$user_id = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->request->data['user_id'])));
		if(!$user_id){
			die(json_encode(array('status' => 'Fail', 'response' => 'User_id not existed')));
		}
		
		$json = json_decode($this->request->data['arr_customer'], true);
		$array_customer = array();
		foreach($json as $a){
			$date = new DateTime();
			$current_time = $date->format('Y-m-d H:i:s') ;
			$arr_customer['Customer']['user_id'] = $this->request->data['user_id'];
			$arr_customer['Customer']['full_name'] = $a['full_name'];
			$arr_customer['Customer']['phone'] = $a['phone'];
			$arr_customer['Customer']['email'] = $a['email'];
			$arr_customer['Customer']['created_at'] = $current_time;
			$arr_customer['Customer']['updated_at'] = $current_time;
			$array_customer[] = $arr_customer;
		}
		if ($this->Customer->saveAll($array_customer)) {
			 $post_ids = $this->Customer->inserted_ids;
				$i = 0;
				foreach($array_customer as $a_customer){
					$array_customer[$i]['Customer']['id'] = $post_ids[$i];
					$i++;
				}
				$arr_result = array();
				foreach($array_customer as $a_customer){
					$arr_result[] = $a_customer['Customer'];
				}
			 //return json_encode($post_ids);
			 return json_encode(array("status" => 'success', "customers" => $arr_result));
		}else{
			return json_encode(array("status" => 'fail'));
		}
	}
	public function updateCustomer(){
		$this->autoRender = false;
		$this->loadModel('Customer');
		if (!isset($this->request->data['customer_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post customer id','code' => '202')));
		}
		if (!isset($this->request->data['full_name'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post fullname','code' => '202')));
		}
		if (!isset($this->request->data['email'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post email','code' => '202')));
		}
		if (!isset($this->request->data['phone'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post phone','code' => '202')));
		}
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_customer['Customer']['full_name'] = $this->request->data['full_name'];
		$arr_customer['Customer']['phone'] = $this->request->data['phone'];
		$arr_customer['Customer']['email'] = $this->request->data['email'];
		$arr_customer['Customer']['updated_at'] = $current_time;
		$this->Customer->id = $this->request->data['customer_id'];
		if ($this->Customer->save($arr_customer)) {
			 return json_encode(array("status" => 'success', 'updated_at' => $current_time));
		}else{ 
			return json_encode(array("status" => 'fail'));
		}
	}
	public function getCustomer(){
		$this->autoRender = false;
		$this->loadModel('Customer');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		
		$arr_customer = $this->Customer->find('all', array('recursive' => -1, 'conditions' => array('Customer.user_id = '.$this->request->data['user_id']))); 	  
		$arr_result = array();
		foreach($arr_customer as $a_arr_customer){
			$arr_result[] = $a_arr_customer['Customer'];
		}
		echo json_encode(array('status' => 'success', 'customer' => $arr_result));
	}
	
	public function deleteCustomer(){
		$this->autoRender = false;
		$this->loadModel('Customer');
		$this->loadModel('Setandforget');
		$this->loadModel('ShareSetandforget');
		if (!isset($this->request->data['customer_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post customer id','code' => '202')));
		}
		$manage_id = $this->Customer->find('first', array('recursive' => -1, 'conditions' => array('Customer.id' => $this->request->data['customer_id'])));
		if(!$manage_id){
			die(json_encode(array('status' => 'Fail', 'response' => 'Manage_id not existed')));
		}else{
			$this->Customer->id = $this->request->data['customer_id'];
			if ($this->Customer->delete()) {
				//Delete setandforget and shared
				$setforget = $this->Setandforget->find('all', array('recursive' => -1, 'conditions'=> array('Setandforget.customer_id' => $this->request->data['customer_id'])));
				foreach($setforget as $a_setforget){
					$delete = $this->ShareSetandforget->query('Delete from share_setandforgets where share_setandforgets.setandforget_id ='.$a_setforget['Setandforget']['id']);
				}
				$delete = $this->Setandforget->query('Delete from setandforgets where setandforgets.customer_id ='.$this->request->data['customer_id']);
				die(json_encode(array('status' => 'success')));
			} else {
				die(json_encode(array('status' => 'Fail', 'response' => 'Manage_id not existed')));
			}
		
		}
	}
	
	public function createTransaction(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('User');
		$this->loadModel('PushNotificationRegistration');
		$this->loadModel('Notification');
		$this->loadModel('NotificationSetting');
		if($this->request->data['action_transactor_id'] == 154){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['transactor_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post transactor id','code' => '202')));
		}
		
		if (!isset($this->request->data['action_transactor_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post action_transactor id','code' => '202')));
		}
		
		$car_result = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('id' => $this->request->data['car_id'])));
		if($car_result){
			if(!($car_result['Car']['transactor_id'] == -1)){
				die(json_encode(array('status' => 'fail', 'response' => 'Sorry. This car is transacting','code' => '201')));
			}
		}
		
		$user_result = $this->User->find('first', array('recursive' => -1, 'conditions' => array('id' => $this->request->data['transactor_id'])));
		if(!$user_result){
			die(json_encode(array('status' => 'fail', 'response' => 'User not exist','code' => '202')));
		}
		
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		//$arr_update['Car']['updated_at'] = $current_time;
		$arr_update['Car']['transactor_id'] = $this->request->data['transactor_id'];
		$arr_update['Car']['action_transactor_id'] = $this->request->data['action_transactor_id'];
		$arr_update['Car']['transaction_date'] = $current_time;
		
		$this->Car->id = $this->request->data['car_id'];
		if ($this->Car->save($arr_update)) {
			$arr_gcm_android = array();
			$arr_gcm_ios = array();
			$message = '';
			$user_receive_notifi = '';
			$reciever_id = '';
			if($this->request->data['transactor_id'] == $this->request->data['action_transactor_id']){
				$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$car_result['Car']['client_no'])));
				$message = $user_result['User']['name'].' is buying a car from you';
				$reciever_id = $car_result['Car']['client_no'];
			}else{
				$user_infor = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$car_result['Car']['client_no'])));
				$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$this->request->data['transactor_id'])));
				$message = $user_infor['User']['name'].' is selling a car for you';
				$reciever_id = $this->request->data['transactor_id'];
			}
			foreach($user_receive_notifi as $a_item){
					if($a_item['PushNotificationRegistration']['os']==0){
						$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
					}else{
						$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
					}
			}
			if(sizeof($arr_gcm_android) > 0){
					$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $reciever_id, 'NotificationSetting.notification_id' => '7')));
					
					if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
						$data = array();
						$gcm = new GCM();
						$data['message']=$message;
						$data['settings'] = $settings['NotificationSetting'];
						$push_result = $gcm->send_notification($arr_gcm_android, $data);					
						if($push_result== false) { 
						}
					}
				}
				if(sizeof($arr_gcm_ios) > 0){
					$HttpSocket = new HttpSocket();
					$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $message, 'dt' => $arr_gcm_ios));
			}
			
			die(json_encode(array('status' => 'success','code' => '200')));
		}else{
			die(json_encode(array('status' => 'Fail','code' => '200')));
		}
	}
	
	public function cancelTransaction(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$this->loadModel('PushNotificationRegistration');
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		//$arr_update['Car']['updated_at'] = $current_time;
		$arr_update['Car']['transactor_id'] = -1;
		$arr_update['Car']['action_transactor_id'] = -1;
		$this->Car->id = $this->request->data['car_id'];
		if ($this->Car->save($arr_update)) {
			die(json_encode(array('status' => 'success')));
		}else{
			die(json_encode(array('status' => 'Fail')));
		}
	}
	public function acceptTransaction(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$this->loadModel('HistoryTransaction');
		$this->loadModel('PushNotificationRegistration');
		$this->loadModel('Transfer');
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		$result = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.id' => $this->request->data['car_id'])));
		if($result){
			//Delete cars in Transfer Car
			$delete = $this->Transfer->query('Delete from transfers where transfers.car_id = ' .$this->request->data['car_id']);
	
			$message = '';
			$user_receive_notifi = '';
			$arr_gcm_android = array();
			$arr_gcm_ios = array();
			if(!isset($this->request->data['user_id'])){
				if($result['Car']['transactor_id'] == $result['Car']['action_transactor_id']){
					$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$result['Car']['client_no'])));
					$user_infor = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$result['Car']['transactor_id'])));
					$message = $user_infor['User']['name'].' agreed to accept your transaction';
				}else{
					$user_infor = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$result['Car']['client_no'])));
					$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$result['Car']['transactor_id'])));
					$message = $user_infor['User']['name'].' agreed to accept your transaction';
				}
			}else{
				$other = $result['Car']['transactor_id'] != $this->request->data['user_id'] ? $result['Car']['transactor_id'] : $result['Car']['client_no'];
				if($this->request->data['user_id'] == $result['Car']['action_transactor_id']){
					$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$this->request->data['user_id'])));
					$user_infor = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$other)));
					$message = $user_infor['User']['name'].' agreed to accept your transaction';
				}else{
					$user_infor = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$this->request->data['user_id'])));
					$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$other)));
					$message = $user_infor['User']['name'].' agreed to accept your transaction';
				}
			}
			foreach($user_receive_notifi as $a_item){
					if($a_item['PushNotificationRegistration']['os']==0){
						$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
					}else{
						$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
					}
			}
			
			$seller_id = $result['Car']['client_no'];
			$buyer_id = $result['Car']['transactor_id'];
			$date = new DateTime();
			$current_time = $date->format('Y-m-d H:i:s') ;
			//$arr_update['Car']['updated_at'] = $current_time;
			$arr_update['Car']['transactor_id'] = -1;
			$arr_update['Car']['client_no'] = $result['Car']['transactor_id'];
			$arr_update['Car']['action_transactor_id'] = -1;
			$current_date = $date->format('d-M-Y');
			$arr_update['Car']['receiveddate'] = $current_date;
			$this->Car->id = $this->request->data['car_id'];
			if ($this->Car->save($arr_update)) {
				$arr_update_his['HistoryTransaction']['car_id'] = $this->request->data['car_id'];
				$arr_update_his['HistoryTransaction']['seller_id'] = $seller_id;
				$arr_update_his['HistoryTransaction']['buyer_id'] = $buyer_id;
				$arr_update_his['HistoryTransaction']['created_at'] = $current_time;
					if ($this->HistoryTransaction->save($arr_update_his)){
						if(sizeof($arr_gcm_android) > 0){
						$data = array();
						$gcm = new GCM();
						$data['message']=$message;						
						$push_result = $gcm->send_notification($arr_gcm_android, $data);					
						if($push_result== false) {
						}
					}
					if(sizeof($arr_gcm_ios) > 0){
						$HttpSocket = new HttpSocket(); 
						$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $message, 'dt' => $arr_gcm_ios));
					}
				}
				die(json_encode(array('status' => 'success')));
			}else{
				die(json_encode(array('status' => 'Fail')));
			}
		}else{
			die(json_encode(array('status' => 'Fail', 'response' => 'Car does not exist')));
		}
	}
	public function getTransaction(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$this->loadModel('HistoryTransaction');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['time_zones'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post time_zones','code' => '202')));
		}
		$arr_retult = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		// Get car's buying
		$result_buy = $this->Car->find('all', array('recursive' => -1, 'conditions' => array('transactor_id' => $this->request->data['user_id']), 'order' => array('transaction_date DESC')));
		if($result_buy){
			$cars = array();
			foreach ($result_buy as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				}
				
				//Check buy-0/sell-1/pending-2
					/*if($car_result['Car']['transactor_id'] != -1){
						$car_result['Car']['transaction_status'] = 2;
					}else{
						if($car_result['Car']['client_no'] == $this->request->data['user_id']){
							$car_result['Car']['transaction_status'] = 1;
						}else{
							$car_result['Car']['transaction_status'] = 0;
						}
					}*/
				//Get dealer infor
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
					if($dealer_infor){
						$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
						$car_result['Car']['transaction_infor'] = '';
					}
					
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car_result['Car']['transaction_date'] = $this->convertToTz($car_result['Car']['transaction_date'],$this->request->data['time_zones'],'UTC');
				$cars[] = $car_result['Car'];
			}
			$arr_retult['cars_buying'] = $cars;
		}else{
			$arr_retult['cars_buying'] = array();
		}
		// Get car's selling
		$result_sell = $this->Car->find('all', array('recursive' => -1, 'conditions' => array('transactor_id != -1', 'client_no' => $this->request->data['user_id']), 'order' => array('transaction_date DESC')));
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result_sell){
			$cars = array();
			foreach ($result_sell as $car_result) {
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				}
				
				//Check buy-0/sell-1/pending-2
				/*	if($car_result['Car']['transactor_id'] != -1){
						$car_result['Car']['transaction_status'] = 2;
					}else{
						if($car_result['Car']['client_no'] == $this->request->data['user_id']){
							$car_result['Car']['transaction_status'] = 1;
						}else{
							$car_result['Car']['transaction_status'] = 0;
						}
					}*/
				//  Get dealer infor
				$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['transactor_id'])));
					if($dealer_infor){
						$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
						$car_result['Car']['transaction_infor'] = '';
					}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car_result['Car']['transaction_date'] = $this->convertToTz($car_result['Car']['transaction_date'],$this->request->data['time_zones'],'UTC');
				$cars[] = $car_result['Car'];
			}
			$arr_retult['cars_selling'] = $cars;
		}else{
			$arr_retult['cars_selling'] = array();
		}
		//History created_at
		$history = $this->HistoryTransaction->find('all',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('HistoryTransaction.seller_id' => $this->request->data['user_id'], 'HistoryTransaction.deleter_id<>'.$this->request->data['user_id']), array('HistoryTransaction.buyer_id' => $this->request->data['user_id'], 'HistoryTransaction.deleter_id<>'.$this->request->data['user_id']))), 'order' => array('created_at DESC')));

		$arr_history = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($history){
			foreach($history as $a_history){
				$car_result = $this->Car->find('first', array('recursive' => -1, 'conditions'=>array('Car.id' => $a_history['HistoryTransaction']['car_id'])));
				if($car_result){
					$arr_image = array();
					$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
					foreach ($image as $a_image) {
						$is_server_sdc = $a_image['Image']['is_server_sdc'];
						if($is_server_sdc == 1){
							$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
						}else{
							$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
						}
						$arr_image[] = $a_image['Image']; 
					}
					$car_result['Car']['images'] = $arr_image;
					
					$car_result['Car']['current_date'] = $current_date;
					//Check Follow
					
					$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
					if($followed){
						$car_result['Car']['is_follow'] = true;
					}else{
						$car_result['Car']['is_follow'] = false;
					}
					
					//get view count
					$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
					$car_result['Car']['view_count'] = sizeof($view_count);
					
					//Check my network
					$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
					if($my_network){
						$car_result['Car']['is_network'] = true;
					}else{
						$car_result['Car']['is_network'] = false;
					}
					
					//Check buy-0/sell-1/pending-2
					/*	if($car_result['Car']['transactor_id'] != -1){
							$car_result['Car']['transaction_status'] = 2;
						}else{
							if($car_result['Car']['client_no'] == $this->request->data['user_id']){
								$car_result['Car']['transaction_status'] = 1;
							}else{
								$car_result['Car']['transaction_status'] = 0;
							}
						}*/
					//  Get dealer infor
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['transactor_id'])));
						if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
						}else{
							$car_result['Car']['transaction_infor'] = '';
						}
					//Get dealer name
					$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
					if($user){
						$car_result['Car']['dealer_name'] = $user['User']['name'];
						$car_result['Car']['dealer_email'] = $user['User']['email'];
						$car_result['Car']['dealer_phone'] = $user['User']['phone'];
						$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
						$car_result['Car']['dealer_company'] = $user['User']['company_name'];
					}else{
						$car_result['Car']['dealer_name'] = '';
						$car_result['Car']['dealer_email'] = '';
						$car_result['Car']['dealer_phone'] = '';
						$car_result['Car']['dealer_avatar'] = '';
						$car_result['Car']['dealer_company'] = '';
					}
					$car_result['Car']['transaction_date'] = $this->convertToTz($a_history['HistoryTransaction']['created_at'],$this->request->data['time_zones'],'UTC'); 
					//1 SOLD, 2 BOUGHT
					if($a_history['HistoryTransaction']['buyer_id'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status_code'] = '2';
					}else{
						$car_result['Car']['transaction_status_code'] = '1';
					}
					$car_result['Car']['history_id'] = $a_history['HistoryTransaction']['id'];
					$arr_history[] = $car_result['Car'];
				}
			}
		}
		$arr_retult['cars_history'] = $arr_history;
		
		return json_encode($arr_retult);
	}
	public function deleteHistory(){
		$this->autoRender = false;
		$this->loadModel('HistoryTransaction');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user_id','code' => '202')));
		}
		if (!isset($this->request->data['history_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post history_id','code' => '202')));
		}
		$history_result = $this->HistoryTransaction->find('first', array('recursive' => -1, 'conditions'=>array('HistoryTransaction.id'=>$this->request->data['history_id'])));
		if($history_result){
			if($history_result['HistoryTransaction']['deleter_id'] == -1){
				$arr_update['HistoryTransaction']['deleter_id'] = $this->request->data['user_id'];
				$this->HistoryTransaction->id = $this->request->data['history_id'];
				if ($this->HistoryTransaction->save($arr_update)) {
					return json_encode(array('status' => 'success'));
				}else{
					return json_encode(array('status' => 'fail'));
				}
			}else{
				$this->HistoryTransaction->id = $this->request->data['history_id'];
				if ($this->HistoryTransaction->delete()) {
					return json_encode(array('status' => 'success'));
				}else{
					return json_encode(array('status' => 'fail'));
				}
			}
		}else{
			return json_encode(array('status' => 'fail'));
		}
	}
	public function convertToTz($time="",$toTz='',$fromTz=''){	
		$this->autoRender = false;
		$date = DateTime::createFromFormat('Y-m-d H:i:s', $time);
		$date->setTimezone(new DateTimeZone($toTz));
		$time= $date->format('Y-m-d H:i');
		return $time;
	}
	public function copyCustomer(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		$this->loadModel('Customer');
		$result = $this->User->find('all');
		$array_customer = array();
		$date = new DateTime();
		foreach($result as $a_result){
			$current_time = $date->format('Y-m-d H:i:s') ;
			$arr_customer['Customer']['user_id'] = $a_result['User']['id'];
			$arr_customer['Customer']['full_name'] = 'Default Customer'.'('.$a_result['User']['name'].')';
			$arr_customer['Customer']['phone'] = $a_result['User']['phone'];
			$arr_customer['Customer']['email'] =$a_result['User']['email'];
			$arr_customer['Customer']['created_at'] = $current_time;
			$arr_customer['Customer']['updated_at'] = $current_time;
			$array_customer[] = $arr_customer;
		}
		if ($this->Customer->saveAll($array_customer)) {
			echo 'OK';
		}
	}
	
	public function getModelByMakeForCarSale(){
		$this->autoRender = false;
		$this->loadModel('Car');
		if (!isset($this->request->data['make'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post make','code' => '202')));
		}
		$series = $this->Car->find('all', array('recursive' => -1, 'fields' => array('DISTINCT Car.model'), 'conditions' => array('Car.make' => $this->request->data['make']), 'order' => array('Car.model ASC')));
		$arr_series = array();
		if($series){
			foreach($series as $a_series){
				$str_text = $a_series['Car']['model'];
				if($str_text != 'null' && $str_text != ''){
					$arr_series[] = $str_text;
					}
				}
		}
		return json_encode(array('status' => 'success', 'model' => $arr_series));
	}
	
	public function getSeriesByMakeModelForCarSale(){
		$this->autoRender = false;
		$this->loadModel('Car');
		if (!isset($this->request->data['make'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post make','code' => '202')));
		}
		if (!isset($this->request->data['model'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post series','code' => '202')));
		}
		$model = $this->Car->find('all', array('recursive' => -1, 'fields' => array('DISTINCT Car.series'), 'conditions' => array('Car.make' => $this->request->data['make'], 'Car.model' => $this->request->data['model'])));
		$arr_model = array();
		if($model){
			foreach($model as $a_model){
			$str_text = $a_model['Car']['series'];
				if($str_text != 'null' && $str_text != ''){
					$arr_model[] = $str_text;
				}
			}
		}
		return json_encode(array('status' => 'success', 'series' => $arr_model));
	}
	
	public function editNotes(){
	$this->autoRender = false;
	$this->loadModel('Car');
		if (!isset($this->request->data['notes'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post comments','code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		
		$my_car = $this->Car->find('first',array('recursive' => -1, 'conditions'=> array('Car.id' => $this->request->data['car_id'], 'Car.client_no' => $this->request->data['user_id'])));
		if($my_car){
			//$date = new DateTime();
			//$current_time = $date->format('Y-m-d H:i:s') ;
			//$arr_update['Car']['updated_at'] = $current_time;
			$arr_update['Car']['notes'] = $this->request->data['notes'];
			$this->Car->id = $this->request->data['car_id'];
			$this->Car->client_no = $this->request->data['user_id'];
			if ($this->Car->save($arr_update)) {
				die(json_encode(array('status' => 'success')));
			}else{
				die(json_encode(array('status' => 'fail', 'response' => 'This car is not belong to you')));
			}
		}else{
			die(json_encode(array('status' => 'fail', 'response' => 'This car is not belong to you')));
		}
		
	}
	
	public function addNotes(){
		$this->autoRender = false;
		$this->loadModel('Comment');
		if (!isset($this->request->data['notes'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post comments','code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		
		$my_car = $this->Comment->find('first',array('recursive' => -1, 'conditions'=> array('Comment.user_id' => $this->request->data['user_id'], 'Comment.car_id' => $this->request->data['car_id'])));
		if($my_car){
			$date = new DateTime();
			$current_time = $date->format('Y-m-d H:i:s') ;
			$arr_update['Comment']['updated_at'] = $current_time;
			$arr_update['Comment']['comment'] = $this->request->data['notes'];
			$this->Comment->id = $my_car['Comment']['id'];
			if ($this->Comment->save($arr_update)) {
				die(json_encode(array('status' => 'success','notes'=>$this->request->data['notes'])));
			}else{
				die(json_encode(array('status' => 'fail', 'response' => 'This car is not belong to you')));
			}
		}else{
			$date = new DateTime();
			$current_time = $date->format('Y-m-d H:i:s') ;
			$arr_update['Comment']['updated_at'] = $current_time;
			$arr_update['Comment']['created_at'] = $current_time;
			$arr_update['Comment']['comment'] = $this->request->data['notes'];
			$arr_update['Comment']['car_id'] = $this->request->data['car_id'];
			$arr_update['Comment']['user_id'] = $this->request->data['user_id'];
			if ($this->Comment->save($arr_update)) {
				die(json_encode(array('status' => 'success', 'notes'=>$this->request->data['notes'])));
			}else{
				die(json_encode(array('status' => 'fail', 'response' => 'This car is not belong to you')));
			}
		}
	}
	public function getNotes(){
		$this->autoRender = false;
		$this->loadModel('Comment');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		$notes = $this->Comment->find('first',array('recursive' => -1, 'conditions'=> array('Comment.user_id' => $this->request->data['user_id'], 'Comment.car_id' => $this->request->data['car_id'])));
		if($notes){
			die(json_encode(array('status' => 'success', 'notes'=>$notes['Comment']['comment'])));
		}else{
			die(json_encode(array('status' => 'success', 'notes'=>'')));
		}
		
	}
	public function getCarById(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Network');
		$this->loadModel('User');
		if (!isset($this->request->data['car_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		$car = array();
		$result = $this->Car->find('first',array('recursive' => -1, 'conditions'=> array('id' => $this->request->data['car_id'])));
		$result_return = array();
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result){
			//foreach ($result as $car_result) {
				$car_result = $result;
				$arr_image = array();
				$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
				foreach ($image as $a_image) {
					$is_server_sdc = $a_image['Image']['is_server_sdc'];
					if($is_server_sdc == 1){
						$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
					}else{
						$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
					}
					$arr_image[] = $a_image['Image']; 
				}
				$car_result['Car']['images'] = $arr_image;
				
				$car_result['Car']['current_date'] = $current_date;
				//Check Follow
				
				$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
				if($followed){
					$car_result['Car']['is_follow'] = true;
				}else{
					$car_result['Car']['is_follow'] = false;
				}
				
				//get view count
				$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
				$car_result['Car']['view_count'] = sizeof($view_count);
				
				//Check my network
				$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
				if($my_network){
					$car_result['Car']['is_network'] = true;
				}else{
					$car_result['Car']['is_network'] = false;
				} 
				
				//Check buy-0/sell-1/pending-2
				if($car_result['Car']['transactor_id'] != -1){
					$car_result['Car']['transaction_status'] = 2;
				}else{
					if($car_result['Car']['client_no'] == $this->request->data['user_id']){
						$car_result['Car']['transaction_status'] = 1;
					}else{
						$car_result['Car']['transaction_status'] = 0;
					}
				}
				//Get dealer infor
				$transaction_id = '';
				if($this->request->data['user_id'] == $car_result['Car']['client_no']){
					$transaction_id = $car_result['Car']['transactor_id'];
				}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
					$transaction_id = $car_result['Car']['client_no'];
				}
				if($transaction_id != ''){
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
					if($dealer_infor){
							$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
					}else{
							$car_result['Car']['transaction_infor'] = '';
					}
				}
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
				if($user){
					$car_result['Car']['dealer_name'] = $user['User']['name'];
					$car_result['Car']['dealer_email'] = $user['User']['email'];
					$car_result['Car']['dealer_phone'] = $user['User']['phone'];
					$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_result['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_result['Car']['dealer_name'] = '';
					$car_result['Car']['dealer_email'] = '';
					$car_result['Car']['dealer_phone'] = '';
					$car_result['Car']['dealer_avatar'] = '';
					$car_result['Car']['dealer_company'] = '';
				}
				$car[] = $car_result['Car'];
			//}
			$result_return['status'] = 'success';
			$result_return['cars'] = $car_result['Car'];
		}else{
			$result_return['status'] = 'success';
			$result_return['cars'] = '';
		} 
		echo json_encode($result_return);
	}
	
	public function addAppChat(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Appchat');
		$this->loadModel('User');
		if (!isset($this->request->data['car_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['client_no'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		$my_chat = $this->Appchat->find('first',array('recursive' => -1, 'conditions'=> array('OR'=>array(array('Appchat.car_id' => $this->request->data['car_id'], 'Appchat.client_no' => $this->request->data['client_no'], 'Appchat.user_id' => $this->request->data['user_id']), array('Appchat.car_id' => $this->request->data['car_id'], 'Appchat.user_id' => $this->request->data['client_no'], 'Appchat.client_no' => $this->request->data['user_id'])))));
		if(!$my_chat){
			$arr_update['Appchat']['car_id'] = $this->request->data['car_id'];
			$arr_update['Appchat']['client_no'] = $this->request->data['client_no'];
			$arr_update['Appchat']['user_id'] = $this->request->data['user_id'];
			if ($this->Appchat->save($arr_update)) {
				die(json_encode(array('status' => 'success')));
			}else{
				die(json_encode(array('status' => 'fail', 'response' => 'Fail')));
			}
		}else{
			//if($my_chat['Appchat']['deleter_id'] != -1 && $my_chat['Appchat']['deleter_id'] == $this->request->data['user_id']){
				//if deleter_id = yourself => set deleter_id = -1
				$owner_car = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.id' => $my_chat['Appchat']['car_id'], 'Car.client_no' => $my_chat['Appchat']['client_no'])));
				if(!$owner_car){
					$arr_update['Appchat']['client_no'] = $my_chat['Appchat']['user_id'];
					$arr_update['Appchat']['user_id'] = $my_chat['Appchat']['client_no'];
				}
				$arr_update['Appchat']['deleter_id'] = '-1';
				$this->Appchat->id = $my_chat['Appchat']['id'];
				if ($this->Appchat->save($arr_update)) {
			
				}else{
					die(json_encode(array('status' => 'fail')));
				}
			//}else{
				
			//}
			die(json_encode(array('status' => 'success')));
		}
	}
	
	public function removeAppChat(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Appchat');
		$this->loadModel('User');
		if (!isset($this->request->data['conversation_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		$my_chat = $this->Appchat->find('first',array('recursive' => -1, 'conditions'=> array('Appchat.id' => $this->request->data['conversation_id'])));
		
		if($my_chat){ 
			if($my_chat['Appchat']['deleter_id'] != -1 && $my_chat['Appchat']['deleter_id'] != $this->request->data['user_id']){
				//Remove record
				$this->Appchat->id = $this->request->data['conversation_id']; 
				if ($this->Appchat->delete()) {
					die(json_encode(array('status' => 'success')));
				}else{
					die(json_encode(array('status' => 'fail')));
				}
			}else{
				//Update deleter_id col = user
				$arr_update['Appchat']['deleter_id'] = $this->request->data['user_id'];
				$this->Appchat->id = $this->request->data['conversation_id'];
				if ($this->Appchat->save($arr_update)) {
					die(json_encode(array('status' => 'success')));
				}else{
					die(json_encode(array('status' => 'fail')));
				}
			}
		}else{
			die(json_encode(array('status' => 'success')));
		}
	}
	
	public function getAppChat(){
		$this->autoRender = false;
		$this->loadModel('Appchat');
		$this->loadModel('Car');
		$this->loadModel('Image');
		$this->loadModel('FollowedCar');
		$this->loadModel('Comment');
		$this->loadModel('Network');
		$this->loadModel('User');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		$arr_retult = array();
		// Get car's buying
		$result_buy = $this->Appchat->find('all', array('recursive' => -1, 'conditions' => array('Appchat.user_id' => $this->request->data['user_id'], 'Appchat.deleter_id <>'. $this->request->data['user_id'])));
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result_buy){
			$cars = array();
			foreach ($result_buy as $a_result_buy) {
				// get Car Infor
				$car_infor = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.id' => $a_result_buy['Appchat']['car_id'])));
				if($car_infor){
					$car_result = $car_infor;
					//Check owner car
					$owner_car = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.id' => $a_result_buy['Appchat']['car_id'], 'Car.client_no' => $a_result_buy['Appchat']['client_no'])));
					$car_result['Car']['is_owner'] = $owner_car ? true : false;
					$arr_image = array();
					$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
					foreach ($image as $a_image) {
						$is_server_sdc = $a_image['Image']['is_server_sdc'];
						if($is_server_sdc == 1){
							$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
						}else{
							$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
						}
						$arr_image[] = $a_image['Image']; 
					}
					$car_result['Car']['images'] = $arr_image;
					
					$car_result['Car']['current_date'] = $current_date;
					//Check Follow
					
					$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
					if($followed){
						$car_result['Car']['is_follow'] = true;
					}else{
						$car_result['Car']['is_follow'] = false;
					}
					
					//get view count
					$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
					$car_result['Car']['view_count'] = sizeof($view_count);
					
					//Check my network
					$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
					if($my_network){
						$car_result['Car']['is_network'] = true;
					}else{
						$car_result['Car']['is_network'] = false;
					}
					
					//Check buy-0/sell-1/pending-2
						/*if($car_result['Car']['transactor_id'] != -1){
							$car_result['Car']['transaction_status'] = 2;
						}else{
							if($car_result['Car']['client_no'] == $this->request->data['user_id']){
								$car_result['Car']['transaction_status'] = 1;
							}else{
								$car_result['Car']['transaction_status'] = 0;
							}
						}*/
					//Get dealer infor
						$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $a_result_buy['Appchat']['client_no'])));
						if($dealer_infor){
							$dealer_infor['User']['avatar'] = '/app/webroot/img/uploads/users_avatar/' . $dealer_infor['User']['avatar_file_name'];
							$car_result['Car']['messager'] = $dealer_infor['User'];
						}else{
							$car_result['Car']['messager'] = '';
						}
					//Get dealer infor
					$transaction_id = '';
					if($this->request->data['user_id'] == $car_result['Car']['client_no']){
						$transaction_id = $car_result['Car']['transactor_id'];
					}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
						$transaction_id = $car_result['Car']['client_no'];
					}
					if($transaction_id != ''){
						$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
						if($dealer_infor){
								$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
						}else{
								$car_result['Car']['transaction_infor'] = '';
						}
					}
					//Get dealer name
					$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
					if($user){
						$car_result['Car']['dealer_name'] = $user['User']['name'];
						$car_result['Car']['dealer_email'] = $user['User']['email'];
						$car_result['Car']['dealer_phone'] = $user['User']['phone'];
						$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
						$car_result['Car']['dealer_company'] = $user['User']['company_name'];
					}else{
						$car_result['Car']['dealer_name'] = '';
						$car_result['Car']['dealer_email'] = '';
						$car_result['Car']['dealer_phone'] = '';
						$car_result['Car']['dealer_avatar'] = ''; 
						$car_result['Car']['dealer_company'] = '';
					}
					$car_result['Car']['conversation_id'] = $a_result_buy['Appchat']['id'];
				$cars[] = $car_result['Car'];
				}
			}
			$arr_retult['cars_buying'] = $cars;
		}else{
			$arr_retult['cars_buying'] = array();
		}
		// Get car's selling
		$result_sell = $this->Appchat->find('all', array('recursive' => -1, 'conditions' => array('Appchat.client_no' => $this->request->data['user_id'], 'Appchat.deleter_id <>'. $this->request->data['user_id'])));
		$date = new DateTime();
		$current_date = $date->format('d-M-Y');
		if($result_sell){
			$cars = array();
			foreach ($result_sell as $a_result_sell) {
				// get Car Infor
				$car_infor = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.id' => $a_result_sell['Appchat']['car_id'])));
				if($car_infor){
					$car_result = $car_infor;
					//Check owner car
					$owner_car = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.id' => $a_result_sell['Appchat']['car_id'], 'Car.client_no' => $a_result_sell['Appchat']['client_no'])));
					
					if($owner_car){
						$car_result['Car']['is_owner'] = true;
					}else{
						$car_result['Car']['is_owner'] = false;
					}
					
					$arr_image = array();
					$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_result['Car']['id'])));
					foreach ($image as $a_image) {
						$is_server_sdc = $a_image['Image']['is_server_sdc'];
						if($is_server_sdc == 1){
							$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
						}else{
							$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
						}
						$arr_image[] = $a_image['Image']; 
					}
					$car_result['Car']['images'] = $arr_image;
					
					$car_result['Car']['current_date'] = $current_date;
					//Check Follow
					
					$followed = $this->FollowedCar->find('first',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'], 'FollowedCar.user_id' => $this->request->data['user_id'])));
					if($followed){
						$car_result['Car']['is_follow'] = true;
					}else{
						$car_result['Car']['is_follow'] = false;
					}
					
					//get view count
					$view_count = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $car_result['Car']['id'])));
					$car_result['Car']['view_count'] = sizeof($view_count);
					
					//Check my network
					$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $car_result['Car']['client_no'], 'Network.user_id' => $this->request->data['user_id']), array('Network.member_id' => $this->request->data['user_id'], 'Network.user_id' => $car_result['Car']['client_no'])))));
					if($my_network){
						$car_result['Car']['is_network'] = true;
					}else{
						$car_result['Car']['is_network'] = false;
					}
					
					//Check buy-0/sell-1/pending-2
					/*	if($car_result['Car']['transactor_id'] != -1){
							$car_result['Car']['transaction_status'] = 2;
						}else{
							if($car_result['Car']['client_no'] == $this->request->data['user_id']){
								$car_result['Car']['transaction_status'] = 1;
							}else{
								$car_result['Car']['transaction_status'] = 0;
							}
						}*/
					//  Get dealer infor
					$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $a_result_sell['Appchat']['user_id'])));
						if($dealer_infor){
							$dealer_infor['User']['avatar'] = '/app/webroot/img/uploads/users_avatar/' . $dealer_infor['User']['avatar_file_name'];
							$car_result['Car']['messager'] = $dealer_infor['User'];
						}else{
							$car_result['Car']['messager'] = '';
						}
					//Get dealer infor
					$transaction_id = '';
					if($this->request->data['user_id'] == $car_result['Car']['client_no']){
						$transaction_id = $car_result['Car']['transactor_id'];
					}else if($this->request->data['user_id'] == $car_result['Car']['transactor_id']){
						$transaction_id = $car_result['Car']['client_no'];
					}
					if($transaction_id != ''){
						$dealer_infor = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $transaction_id)));
						if($dealer_infor){
								$car_result['Car']['transaction_infor'] = $dealer_infor['User'];
						}else{
								$car_result['Car']['transaction_infor'] = '';
						}
					}
					//Get dealer name
					$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_result['Car']['client_no'])));
					if($user){
						$car_result['Car']['dealer_name'] = $user['User']['name'];
						$car_result['Car']['dealer_email'] = $user['User']['email'];
						$car_result['Car']['dealer_phone'] = $user['User']['phone'];
						$car_result['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
						$car_result['Car']['dealer_company'] = $user['User']['company_name'];
					}else{
						$car_result['Car']['dealer_name'] = '';
						$car_result['Car']['dealer_email'] = '';
						$car_result['Car']['dealer_phone'] = '';
						$car_result['Car']['dealer_avatar'] = '';
						$car_result['Car']['dealer_company'] = '';
					}
					$car_result['Car']['conversation_id'] = $a_result_sell['Appchat']['id'];
					$cars[] = $car_result['Car'];
				}
			}
			$arr_retult['cars_selling'] = $cars;
		}else{
			$arr_retult['cars_selling'] = array();
		}
		return json_encode($arr_retult);
	}
	
	public function RegisterPushNotification(){
		$this->autoRender = false;
		$this->loadModel('PushNotificationRegistration');
		if (!isset($this->request->data['gcm_reg'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post gcm reg', 'code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['os'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post OS','code' => '202')));
		}
		$reg_id = $this->PushNotificationRegistration->find('first', array('recursive' => -1, 'conditions' => array('PushNotificationRegistration.gcm_reg' => $this->request->data['gcm_reg'], 'PushNotificationRegistration.user_id' => $this->request->data['user_id'], 'PushNotificationRegistration.os' => $this->request->data['os'])));
		if($reg_id){
			die(json_encode(array('status' => 'success', 'response' => 'device not existed')));
		}
		
		$arr_customer['PushNotificationRegistration']['user_id'] = $this->request->data['user_id'];
		$arr_customer['PushNotificationRegistration']['gcm_reg'] = $this->request->data['gcm_reg'];
		$arr_customer['PushNotificationRegistration']['os'] = $this->request->data['os'];
		if ($this->PushNotificationRegistration->save($arr_customer)) {
			 return json_encode(array("status" => 'success'));
		}else{
			return json_encode(array("status" => 'fail'));
		}
	}
	public function pushNo(){
		$this->autoRender = false;
		$registration_ids = array();
		$data = array();
		$data['message'] = 'abcf'; 
		$registration_ids[] .= '08f1e3068dbdd087c0d6cd8fbcb6f19f85375796fa530ee9b9c32817e31ac476';
			$gcm= new push_ios();												
						$result = $gcm->send_notification($registration_ids, $data);
						if( $result== false) {
							$message="Push failed";
							echo 'Push failed';
						}
						else {	
							echo 'Push successfully';
						}
	}
	public function sendMailInvite(){
		$this->autoRender = false;
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$body = $_POST['body'];
		$this->sendMail($email, $subject, $body); 
	}
	public function sendMailToBcc(){
		$this->autoRender = false;
		//$email = $_POST['email'];
		//$subject = $_POST['subject'];
		//$body = $_POST['body'];
		$mail             = new PHPMailer(); 
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

		$mail->Username   = "noreply.carzapp@gmail.com";  // GMAIL username noreply.carzapp@gmail.com/Fr33M3N0w
		$mail->Password   = "Fr33M3N0w";            // GMAIL password

		$mail->From       = "noreply.carzapp@gmail.com";
		$mail->FromName   = "Administrator";

		$mail->Subject    = "Carzapp";

		$mail->WordWrap   = 50; // set word wrap

		$mail->MsgHTML("Invitation");
		$mail->SMTPDebug  = 1; 
		//foreach($email as $a_email){
			$mail->AddAddress("dcmen@sdc.ud.edu.vn");
		//}
		$mail->AddBCC("lvtri@sdc.ud.edu.vn");
		$mail->AddBCC("dcm.it.bkdn@gmail.com");
		
		$mail->IsHTML(true); // send as HTML

		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  //echo "Message sent!"; 
		}
	}
	public function sendMail($email, $subject, $body){
		$this->autoRender = false;
		//$email = $_POST['email'];
		//$subject = $_POST['subject'];
		//$body = $_POST['body'];
		$mail             = new PHPMailer(); 
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

		$mail->Username   = "noreply.carzapp@gmail.com";  // GMAIL username noreply.carzapp@gmail.com/Fr33M3N0w
		$mail->Password   = "Fr33M3N0w";            // GMAIL password

		$mail->From       = "noreply.carzapp@gmail.com";
		$mail->FromName   = "Administrator";

		$mail->Subject    = $subject;

		$mail->WordWrap   = 50; // set word wrap

		$mail->MsgHTML($body);
		$mail->SMTPDebug  = 1;
		foreach($email as $a_email){
			$mail->AddAddress($a_email);
		}
		$mail->IsHTML(true); // send as HTML

		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  //echo "Message sent!"; 
		}
	}
	
	public function InviteNetwork(){
		$this->autoRender = false;
		$this->loadModel('InviteNetwork');
		$this->loadModel('User');
		$this->loadModel('PushNotificationRegistration');
		if (!isset($this->request->data['sender_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post sender_id','code' => '202')));
		}
		if (!isset($this->request->data['sender_name'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post sender_name','code' => '202')));
		}
		if (!isset($this->request->data['arr_request_email'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post array request_email','code' => '202')));
		}

		$arr_gcm_android = array();
		$arr_gcm_ios = array();
		$arr_send_mail = array();
		$decode_request_email = json_decode($this->request->data['arr_request_email'], true);
		foreach($decode_request_email as $a_decode_request_email){
			$query_invite = $this->InviteNetwork->find('first', array('recursive' => -1, 'conditions' => array('InviteNetwork.sender_id' => $this->request->data['sender_id'], 'InviteNetwork.request_email' =>$a_decode_request_email['email'])));
			if(!$query_invite){
				$this->InviteNetwork->create();
				$arr_add['InviteNetwork']['request_email'] = $a_decode_request_email['email'];
				$arr_add['InviteNetwork']['sender_id'] = $this->request->data['sender_id'];
				if ($this->InviteNetwork->save($arr_add)) {
				}else{
					//die(json_encode(array('status' => 'fail')));
					continue;
				}
			}else{
				//Record existed in table. Send mail or Push
			}
			$message=$this->request->data['sender_name']." want to add your to his/her network";
			//Get GCM
			$query_user = $this->User->find("first", array('recursive' => -1, 'conditions' => array('User.email' => $a_decode_request_email['email'])));
				if($query_user){
					$result_gcm = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $query_user['User']['id'])));
					if($result_gcm){
						foreach($result_gcm as $a_item){
							if($a_item['PushNotificationRegistration']['os']==0){
								$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
							}else{
								$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
							}
						}
					}
				}else{
					$arr_send_mail[] = $a_decode_request_email['email'];
				}
		}
		if(sizeof($arr_gcm_android) > 0){
			$data = array();
				$gcm = new GCM();
				$data['message']=$message;						
				$push_result = $gcm->send_notification($arr_gcm_android, $data);					
				if($push_result== false) {
				}
		}
		if(sizeof($arr_gcm_ios) > 0){
			$HttpSocket = new HttpSocket();
			$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $message, 'dt' => $arr_gcm_ios));
		}
		//Send mail
		if(sizeof($arr_send_mail) > 0){
			//$body = 'CarZapp is the #1 app for car dealers. <br/>Please find your invitation to download CarZapp and join an extensive pool of thousands //of cars at wholesale prices, to trade. You will be able to share your car inventory, as well as view all other car inventory at wholesale //prices.<br/>By accepting this invitation, you will also be able to join my own network, which means you will be included in my communication //to a select group of dealers.<br/>Carzapp is by invitation only, so the network is kept private amongst the  dealer network. It is mandatory //for all users of Carzapp to have a current dealer license.<br/><br/>Sincerely,'.$this->request->data['sender_name'];
			  
			$body = 'You have been invited by '.$this->request->data['sender_name'].' to join the CarZapp dealer network.<br/>
			CarZapp is the No 1 App for Car Dealers with a fast growing dealer network with thousands of cars to buy and sell at wholesale prices.<br/>
			As a dealer on the CarZapp network, you will be able to grow your network enabling you to share your inventory with each other, as well as, buy, sell at wholesale prices.<br/>
			CarZapp is for licensed dealers only. By joining CarZapp, you will enjoy many features like real-time instant chat and Flicka, and be able to move cars fast.<br/>
			Please download the app by clicking on one of these links to proceed<br/>
			iOS - <a href="http://carzapp.com.au/">http://carzapp.com.au/</a><br/>
			Android - <a href="http://carzapp.com.au/">http://carzapp.com.au/</a><br/><br/>       
			Regards,<br/>
			'.$this->request->data['sender_name'];
			$subject = '[CARZAPP] Invitation from ['.$this->request->data['sender_name'].']'; 
			$this->sendMail($arr_send_mail, $subject, $body);
		}
		die(json_encode(array('status' => 'success')));
	}
	
	public function getInviteNetwork(){
		$this->autoRender = false;
		$this->loadModel('InviteNetwork');
		$this->loadModel('User');
		if (!isset($this->request->data['email_dealer'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post email_dealer','code' => '202')));
		}
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user_id','code' => '202')));
		}
		$query_invite_receiver = $this->InviteNetwork->find('all', array('recursive' => -1, 'conditions' => array('InviteNetwork.request_email' => $this->request->data['email_dealer'])));
		$result_receiver = array();
		if($query_invite_receiver){
			foreach($query_invite_receiver as $a_query_invite){
				$query_user = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $a_query_invite['InviteNetwork']['sender_id'])));
				if($query_user){
					$query_user['User']['invited_id'] = $a_query_invite['InviteNetwork']['id'];
					$result_receiver[] = $query_user['User']; 
				}
			}
		}
		$query_invite_sender = $this->InviteNetwork->find('all', array('recursive' => -1, 'conditions' => array('InviteNetwork.sender_id' => $this->request->data['user_id'])));
		$result_sender = array();
		if($query_invite_sender){
			foreach($query_invite_sender as $a_query_invite){
				$query_user = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.email' => $a_query_invite['InviteNetwork']['request_email'])));
				if($query_user){
					$query_user['User']['invited_id'] = $a_query_invite['InviteNetwork']['id'];
					$result_sender[] = $query_user['User']; 
				}
			} 
		}
		die(json_encode(array('status' => 'success', 'request_received' => $result_receiver, 'request_sender' => $result_sender)));
	}
	
	public function AcceptInviteNetwork(){
		$this->autoRender = false;
		$this->loadModel('InviteNetwork');
		$this->loadModel('Network');
		$this->loadModel('User');
		$this->loadModel('PushNotificationRegistration');
		$this->loadModel('NotificationSetting');
		//$result = $this->Car->find('all',array('conditions'=> array(array('OR' => $where_keyword, $where), "Car.active = 0")));
		//$delete = $this->FollowedCar->query('Delete from followed_cars where followed_cars.user_id = ' .$this->request->data['user_id'] . ' AND followed_cars.car_id =' .$this->request->data['car_id']);
		
		if (!isset($this->request->data['dealer_email'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post dealer_email','code' => '202')));
		}
		if (!isset($this->request->data['requester_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post email_request','code' => '202')));
		}
		if (!isset($this->request->data['requester_email'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post requester_name','code' => '202')));
		}
		if (!isset($this->request->data['dealer_name'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post dealer_name','code' => '202')));
		}
		if (!isset($this->request->data['dealer_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post dealer_id','code' => '202')));
		}
		if($this->request->data['dealer_id'] == $this->request->data['requester_id']){
			die(json_encode(array('status' => 'fail', 'response' => 'You cannot add yourself to your network','code' => '202')));
		}
		$query_invite_network = $this->InviteNetwork->find('first', array('recursive' => -1, 'conditions'=>array('InviteNetwork.sender_id' => $this->request->data['requester_id'], 'InviteNetwork.request_email' =>$this->request->data['dealer_email'])));
		if($query_invite_network){
			$date = new DateTime();
			$current_time = $date->format('Y-m-d H:i:s') ;
			$arr_add['Network']['user_id'] = $this->request->data['dealer_id'];
			$arr_add['Network']['member_id'] = $this->request->data['requester_id'];
			$arr_add['Network']['created_at'] = $current_time;
			$arr_add['Network']['updated_at'] = $current_time;
			$query_network = $this->Network->find('first', array('recursive' => -1, 'conditions' => array('OR'=>array(array('Network.user_id'=>$this->request->data['dealer_id'], 'Network.member_id' =>$this->request->data['requester_id']), array('Network.user_id'=>$this->request->data['requester_id'], 'Network.member_id' =>$this->request->data['dealer_id']))))); 
			if(!$query_network){
				if ($this->Network->save($arr_add)) {
				 
				}
			}
				$result_gcm = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $this->request->data['requester_id'])));
				$data = array();
				if($result_gcm){
					$arr_gcm_android = array();
					$arr_gcm_ios = array();
					foreach($result_gcm as $a_result_gcm){
						if($a_result_gcm['PushNotificationRegistration']['os']==0){
							$arr_gcm_android[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
						}else{
							$arr_gcm_ios[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
						}
					}
					$arr_infor = array();
					$arr_infor['sender_name'] = $this->request->data['dealer_name'];
					$data['message']= $this->request->data['dealer_name'] . " accepted invitation from you";
					if(sizeof($arr_gcm_android) > 0){
						$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $this->request->data['requester_id'], 'NotificationSetting.notification_id' => '4')));
						if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
							$gcm = new GCM();
							$data['settings'] = $settings['NotificationSetting'];
							$push_result = $gcm->send_notification($arr_gcm_android, $data);					
							if($push_result== false) { 
							}
						}
					}
					if(sizeof($arr_gcm_ios) > 0){
							$HttpSocket = new HttpSocket();
							$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $this->request->data['dealer_name'] . " accepted invitation from you", 'dt' => $arr_gcm_ios));
					}
				}
				//Delete from InviteNetwork
				$delete = $this->InviteNetwork->query('Delete from invite_networks where (invite_networks.request_email ='."\"" . $this->request->data['requester_email']. "\"" ." AND ".'invite_networks.sender_id = ' .$this->request->data['dealer_id'] . ') OR '. '(invite_networks.sender_id = ' .$this->request->data['requester_id'] . ' AND invite_networks.request_email ='. '\''.$this->request->data['dealer_email']. '\')');
				die(json_encode(array('status' => 'success')));
			
		}else{
			die(json_encode(array('status' => 'success')));
		}
	}

	public function CancelInviteNetwork(){
		$this->autoRender = false;
		$this->loadModel('InviteNetwork');
		$this->loadModel('User');
		$this->loadModel('PushNotificationRegistration');
		
		if (!isset($this->request->data['invite_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post invite_id','code' => '202')));
		}
		if (!isset($this->request->data['dealer_name'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post dealer_name','code' => '202')));
		}
				//Delete from InviteNetwork
				$this->InviteNetwork->id = $this->request->data['invite_id'];
				if ($this->InviteNetwork->delete()) {
					die(json_encode(array('status' => 'success')));
				}else{
					die(json_encode(array('status' => 'fail')));
				}
	}
	
	public function searchCarDealer(){
		$this->autoRender = false;
		$this->loadModel('User');
		$arr_result = array();
		if (!isset($this->request->data['key_search'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post key_search','code' => '202')));
		}
		$result = $this->User->find("all",array('recursive' => -1, 'conditions'=>array('OR' => array(array('User.name LIKE'=>"%".$this->request->data['key_search']."%"), array('User.email LIKE'=>"%".$this->request->data['key_search']."%")))));
		if($result){
			foreach($result as $a_result){ 
				$arr_result[] = $a_result['User'];
			}
		}
		die(json_encode(array('status' => 'success', 'dealers' => $arr_result))); 
	}
	
	public function blockNetwork(){
		$this->autoRender = false;
		$this->loadModel('Block');
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if (!isset($this->request->data['blocker_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post blocker_id','code' => '202')));
		}
		$query_blocker = $this->Block->find('first', array('recursive' => -1, 'conditions' =>array('Block.user_id'=>$this->request->data['user_id'], 'Block.blocker_id'=>$this->request->data['blocker_id'])));
		if(!$query_blocker){ 
			$arr_add['Block']['user_id'] = $this->request->data['user_id'];
			$arr_add['Block']['blocker_id'] = $this->request->data['blocker_id'];
			if ($this->Block->save($arr_add)) {
			}else{
			}
			die(json_encode(array('status' => 'success')));
		}else{
			die(json_encode(array('status' => 'success')));
		}
	}
	
	public function unLockNetwork(){
		$this->autoRender = false;
		$this->loadModel('Block');
		
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		if (!isset($this->request->data['blocker_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post blocker_id','code' => '202')));
		}
		
		$delete = $this->Block->query('Delete from blocks where blocks.user_id = ' .$this->request->data['user_id'] . ' AND blocks.blocker_id =' .$this->request->data['blocker_id']);
		if ($delete) {
			die(json_encode(array('status' => 'success')));
		}else{
			die(json_encode(array('status' => 'success'))); 
		}
	}
	
	public function getDealersSameCompany(){
		$this->autoRender = false;
		$this->loadModel('User');
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		
		$user_infor = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$this->request->data['user_id'])));
		if($user_infor){
			$user = $this->User->find('all', array('recursive' => -1, 'conditions'=>array('User.license_number' =>$user_infor['User']['license_number'], 'User.id<>' . $this->request->data['user_id'])));
			$result = array();
			if($user){
				foreach($user as $a_user){
					$a_user['User']['avatar'] = '/app/webroot/img/uploads/users_avatar/' . $a_user['User']['avatar_file_name'];
					$result[] = $a_user['User'];
				}
			}
			die(json_encode(array('status' => 'success', 'dealers'=>$result)));
		}else{
			die(json_encode(array('status' => 'success', 'dealers'=>array())));
		}
	}
	
	public function removeGCM(){
		$this->autoRender = false;
		$this->loadModel('PushNotificationRegistration');
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post client id','code' => '202')));
		}
		$delete = $this->PushNotificationRegistration->query('Delete from push_notification_registrations where push_notification_registrations.user_id ='.$this->request->data['user_id']);
		die(json_encode(array('status' => 'success')));
	}
	
	public function TransferCar(){
		$this->autoRender = false;
		$this->loadModel('Transfer');
		$this->loadModel('User');
		$this->loadModel('Car');
		$this->loadModel('PushNotificationRegistration');
		if($this->request->data['transfer_id'] == 154){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car id','code' => '202')));
		}
		if (!isset($this->request->data['car_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car_id','code' => '202')));
		}
		if (!isset($this->request->data['transfer_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post transfer_id','code' => '202')));
		}
		if (!isset($this->request->data['transfer_name'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post transfer_name','code' => '202')));
		}
		if (!isset($this->request->data['receiver_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post array receiver_id','code' => '202')));
		}
		//Check owner car
		$check_owner = $this->Car->find('first', array('recursive' => -1, 'conditions'=>array('Car.id'=>$this->request->data['car_id'], 'Car.client_no'=>$this->request->data['transfer_id'])));
		if(!$check_owner){
			die(json_encode(array('status' => 'fail', 'response'=>'This car is transfering to other dealer')));
		}
		$arr_gcm_android = array();
		$arr_gcm_ios = array();
		$arr_send_mail = array();
		
		//if($query_check_car){
			$query_transfer = $this->Transfer->find('first', array('recursive' => -1, 'conditions' => array('Transfer.car_id' => $this->request->data['car_id'], 'Transfer.transfer_id' =>$this->request->data['transfer_id'], 'Transfer.receiver_id'=>$this->request->data['receiver_id'])));
			if(!$query_transfer){
				//Check transfer to other dealer?
				$query_check_car = $this->Transfer->find('first', array('recursive' => -1, 'conditions' => array('Transfer.car_id' => $this->request->data['car_id'])));
				if($query_check_car){
					die(json_encode(array('status' => 'fail', 'response'=>'This car is transfering to other dealer')));
				}
				$this->Transfer->create();
				$arr_add['Transfer']['car_id'] = $this->request->data['car_id'];
				$arr_add['Transfer']['transfer_id'] = $this->request->data['transfer_id'];
				$arr_add['Transfer']['receiver_id'] = $this->request->data['receiver_id'];
				$date = new DateTime();
				$current_time = $date->format('Y-m-d H:i:s') ;
				$arr_add['Transfer']['created_at'] = $current_time;
				if ($this->Transfer->save($arr_add)) {
				
				}else{
						die(json_encode(array('status' => 'fail')));
					}
				}else{
					//Record existed in table. Send mail or Push
				}
				
				$message=$this->request->data['transfer_name']." want to transfer a car for you";
				//Get GCM
				$result_gcm = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $this->request->data['receiver_id'])));
				if($result_gcm){
					if($result_gcm){
							foreach($result_gcm as $a_item){
								if($a_item['PushNotificationRegistration']['os']==0){
									$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
								}else{
									$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
								}
							}
						}
					}
				if(sizeof($arr_gcm_android) > 0){
					$data = array();
						$gcm = new GCM();
						$data['message']=$message;						
						$push_result = $gcm->send_notification($arr_gcm_android, $data);					
						if($push_result== false) {
						}
				}
				if(sizeof($arr_gcm_ios) > 0){
					$HttpSocket = new HttpSocket();
					$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $message, 'dt' => $arr_gcm_ios));
				}
			die(json_encode(array('status' => 'success')));
		//}else{
		//	die(json_encode(array('status' => 'fail', 'response'=>'This car is transfering to other dealer')));
		//}
	}
	
	public function acceptTransferCar(){
		$this->autoRender = false;
		$this->loadModel('Transfer');
		$this->loadModel('User');
		$this->loadModel('Car');
		$this->loadModel('PushNotificationRegistration');
		if (!isset($this->request->data['transfer_car_id'])){  
			die(json_encode(array('status' => 'fail', 'response' => 'Not post transfer_car_id','code' => '202')));
		}
		$query_tranfer = $this->Transfer->find('first', array('recursive' => -1, 'conditions'=>array('Transfer.id'=>$this->request->data['transfer_car_id'])));
		if($query_tranfer){
			$query_car = $this->Car->find('first', array('recursive' => -1, 'conditions'=>array('Car.id'=>$query_tranfer['Transfer']['car_id'], 'Car.client_no'=>$query_tranfer['Transfer']['transfer_id'])));
			if($query_car){
				$arr_update['Car']['client_no'] = $query_tranfer['Transfer']['receiver_id'];
				$arr_update['Car']['transactor_id'] = '-1';
				$arr_update['Car']['action_transactor_id'] = '-1';
				$this->Car->id = $query_tranfer['Transfer']['car_id'];
				if ($this->Car->save($arr_update)) {
					$this->Transfer->id = $this->request->data['transfer_car_id'];
					if ($this->Transfer->delete()) {
						
					}
					$arr_gcm_android = array();
					$arr_gcm_ios = array();
					$message = '';
					$user_receive_notifi = '';
					$user_infor = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$query_tranfer['Transfer']['receiver_id'])));
					$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$query_tranfer['Transfer']['transfer_id'])));
					$message = 'A car is transfered to '.$user_infor['User']['name'];
					foreach($user_receive_notifi as $a_item){
							if($a_item['PushNotificationRegistration']['os']==0){
								$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
							}else{
								$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
							}
					}
					if(sizeof($arr_gcm_android) > 0){
							$data = array();
							$gcm = new GCM();
							$data['message']=$message;						
							$push_result = $gcm->send_notification($arr_gcm_android, $data);					
							if($push_result== false) {
							}
						}
						if(sizeof($arr_gcm_ios) > 0){
							$HttpSocket = new HttpSocket();
							$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $message, 'dt' => $arr_gcm_ios));
					}
					die(json_encode(array('status' => 'success')));
				}else{
					die(json_encode(array('status' => 'false')));
				}
			}else{
				die(json_encode(array('status' => 'false', 'response'=>"This car is not exist. It is transacted")));
			}
		}else{
			die(json_encode(array('status' => 'false', 'response'=>"Transfer is cancelled")));
		}
	}
	
	public function getTransfer(){
		$this->autoRender = false;
		$this->loadModel('Transfer');
		$this->loadModel('Car');
		$this->loadModel('User');
		$this->loadModel('Image');
		
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user_id','code' => '202')));
		}
		if (!isset($this->request->data['time_zones'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post time_zones','code' => '202')));
		}
		$transfering_result = array();
		$transfered_result = array();
		//Get car is transfering
		$car_transfering = $this->Transfer->find('all', array('recursive' => -1, 'conditions'=>array('Transfer.transfer_id'=>$this->request->data['user_id'])));
		foreach($car_transfering as $a_car_transfering){
			$car_info = $this->Car->find('first', array('recursive' => -1, 'conditions'=>array('Car.id'=>$a_car_transfering['Transfer']['car_id'])));
			if($car_info){
				$a_car_transfering['Transfer']['created_at'] = $this->convertToTz($a_car_transfering['Transfer']['created_at'],$this->request->data['time_zones'],'UTC');
				$user_info = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$a_car_transfering['Transfer']['receiver_id'])));
				$a_car_transfering['Transfer']['transfer_name'] = $user_info['User']['name'];
				
				$arr_image = array();
					$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_info['Car']['id'])));
					foreach ($image as $a_image) {
						$is_server_sdc = $a_image['Image']['is_server_sdc'];
						if($is_server_sdc == 1){ 
							$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
						}else{
							$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
						}
						$arr_image[] = $a_image['Image']; 
					}
				$car_info['Car']['images'] = $arr_image;
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_info['Car']['client_no'])));
				if($user){
					$car_info['Car']['dealer_name'] = $user['User']['name'];
					$car_info['Car']['dealer_email'] = $user['User']['email'];
					$car_info['Car']['dealer_phone'] = $user['User']['phone'];
					$car_info['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_info['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_info['Car']['dealer_name'] = '';
					$car_info['Car']['dealer_email'] = '';
					$car_info['Car']['dealer_phone'] = '';
					$car_info['Car']['dealer_avatar'] = '';
					$car_info['Car']['dealer_company'] = '';
				}
				$a_car_transfering['Transfer']['car'] = $car_info['Car'];
				$transfering_result[] = $a_car_transfering['Transfer'];
			}
		}
		//Get car is transfered
		$car_transfered = $this->Transfer->find('all', array('recursive' => -1, 'conditions'=>array('Transfer.receiver_id'=>$this->request->data['user_id'])));
		foreach($car_transfered as $a_car_transfered){
			$car_info = $this->Car->find('first', array('recursive' => -1, 'conditions'=>array('Car.id'=>$a_car_transfered['Transfer']['car_id'])));
			if($car_info){
				$a_car_transfered['Transfer']['created_at'] = $this->convertToTz($a_car_transfered['Transfer']['created_at'],$this->request->data['time_zones'],'UTC');
				$user_info = $this->User->find('first', array('recursive' => -1, 'conditions'=>array('User.id'=>$a_car_transfered['Transfer']['transfer_id'])));
				$a_car_transfered['Transfer']['transfer_name'] = $user_info['User']['name'];
				
				$arr_image = array();
					$image = $this->Image->find('all',array('recursive' => -1, 'conditions'=> array('Image.car_id' => $car_info['Car']['id'])));
					foreach ($image as $a_image) {
						$is_server_sdc = $a_image['Image']['is_server_sdc'];
						if($is_server_sdc == 1){
							$a_image['Image']['url'] = "/app/webroot/datafeed/".$a_image['Image']['image_file_name'];
						}else{
							$a_image['Image']['url'] = $a_image['Image']['image_file_name'];
						}
						$arr_image[] = $a_image['Image']; 
					}
				$car_info['Car']['images'] = $arr_image;
				//Get dealer name
				$user = $this->User->find('first',array('recursive' => -1, 'conditions'=> array('User.id' => $car_info['Car']['client_no'])));
				if($user){
					$car_info['Car']['dealer_name'] = $user['User']['name'];
					$car_info['Car']['dealer_email'] = $user['User']['email'];
					$car_info['Car']['dealer_phone'] = $user['User']['phone'];
					$car_info['Car']['dealer_avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user['User']['avatar_file_name'];
					$car_info['Car']['dealer_company'] = $user['User']['company_name'];
				}else{
					$car_info['Car']['dealer_name'] = '';
					$car_info['Car']['dealer_email'] = '';
					$car_info['Car']['dealer_phone'] = '';
					$car_info['Car']['dealer_avatar'] = '';
					$car_info['Car']['dealer_company'] = '';
				}
				$a_car_transfered['Transfer']['car'] = $car_info['Car'];
				$transfered_result[] = $a_car_transfered['Transfer'];
			}
		}
		
		$result = array();
		$result['transfering'] = $transfering_result;
		$result['transfered'] = $transfered_result;
		die(json_encode(array('status' => 'success', 'transfer'=>$result)));
	}
	
	public function cancelTransferCar(){
		$this->autoRender = false;
		$this->loadModel('Transfer');
		if (!isset($this->request->data['transfer_car_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post transfer_id','code' => '202')));
		}
		$this->Transfer->id = $this->request->data['transfer_car_id'];
		if ($this->Transfer->delete()) {
			die(json_encode(array('status' => 'success')));			
		}else{
			die(json_encode(array('status' => 'fail')));
		}
		
	}
	
	public function checkDeviceID(){
		$this->autoRender = false;
		$this->loadModel('Device');
		if (!isset($this->request->data['device_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post device_id','code' => '202')));
		}
		$check = $this->Device->find('first', array('recursive' => -1, 'conditions'=>array('Device.device_id'=>$this->request->data['device_id'])));
		if($check){
			die(json_encode(array('status' => 'success')));	
		}else{
			die(json_encode(array('status' => 'fail')));	
		}
	}
	
	public function addDeviceID(){
		$this->autoRender = false;
		$this->loadModel('Device');
		if (!isset($this->request->data['code'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post code','code' => '202')));
		}
		if (!isset($this->request->data['device_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post device_id','code' => '202')));
		}
		$check = $this->Device->find('first', array('recursive' => -1, 'conditions'=>array('Device.code'=>$this->request->data['code'])));
		if($check){
			if($check['Device']['device_id'] == ''){
				$arr_update['Device']['device_id'] = $this->request->data['device_id'];
				$this->Device->id = $check['Device']['id'];
				if($this->Device->save($arr_update)){
					die(json_encode(array('status' => 'success')));
				}else{
					//103: Error insert
					die(json_encode(array('status' => 'fail', 'code'=>'103')));
				}
			}else{
				//102: code already use.
				die(json_encode(array('status' => 'fail', 'code'=>'102')));
			}
		}else{
			//101: code incorrect
			die(json_encode(array('status' => 'fail', 'code'=>'101')));
		}
	}
	public function forgotPassword(){
		$this->autoRender = false;
		$this->loadModel('OfSecretstring');
		$this->loadModel('User');
		if (!isset($this->request->data['email'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post email','code' => '202')));
		}
		
			$serect = $this->OfSecretstring->find('first', array('recursive' => -1, 'conditions'=>array('OfSecretstring.email' => $this->request->data['email'])));
			$secret_key = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
			$data['OfSecretstring']['secretstring'] = $secret_key;
			$data['OfSecretstring']['email'] = $this->request->data['email'];
			if($serect){
				$data['OfSecretstring']['id'] = $serect['OfSecretstring']['id'];
			}
			if($this->OfSecretstring->save($data)){
				$link="http://carzapp.com.au/forgot_password?email=".$this->request->data['email']."&secretstring=".$data['OfSecretstring']['secretstring'];
				$arr_send_mail = array();
				$arr_send_mail[] = $this->request->data['email'];
				$subject = "[CarZapp] You have requested the password recovery";
				$body = "Hello! <br/><br/>You requested that your CarZapp password be reset.<br/>Please click on the link below to create your new password:<br/><a href = '$link'>$link</a><br/>If the link above does not work, please copy and paste it into your web browser. If you received this email in error, please disregard. Do not reply directly to this email.<br/><br/>Sincerely,<br/>CarZapp Team";
				$this->sendMail($arr_send_mail, $subject, $body);
				die(json_encode(array('status' => 'success')));
			}
			
		
		die(json_encode(array('status' => 'fail', 'response'=>'Fail')));
		
	}
	
	public function getMenuCountNumbers(){
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('InviteNetwork');
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user_id','code' => '202')));
		}
		if (!isset($this->request->data['user_email'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user_email','code' => '202')));
		}
		$result_selling = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.client_no' => $this->request->data['user_id'], 'Car.transactor_id<>-1'))); 
		$result_buying = $this->Car->find('all',array('recursive' => -1, 'conditions'=> array('Car.transactor_id'=>$this->request->data['user_id'])));
		//$arr_invite_network = $this->InviteNetwork->find('all', array('recursive' => -1, 'conditions' => array('InviteNetwork.request_email' => $this->request->data['user_email'])));
		$arr_invite_network = $this->InviteNetwork->find('all', array('recursive' => -1, 'conditions' => array('OR' => array(array('InviteNetwork.request_email' => $this->request->data['user_email']), array('InviteNetwork.sender_id' => $this->request->data['user_id'])))));
		die(json_encode(array('status' => 'success', 'count_transaction' => sizeof($result_selling) + sizeof($result_buying), 'count_invite' => sizeof($arr_invite_network))));
	}
	
	public function getViewCount(){ 
		$this->autoRender = false; 
		$this->loadModel('FollowedCar'); 
		if (!isset($this->request->data['car_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car_id','code' => '202')));
		}
		$result_car = $this->FollowedCar->find('all',array('recursive' => -1, 'conditions'=> array('FollowedCar.car_id' => $this->request->data['car_id'])));
		$count = 0;
		if($result_car){
			$count = sizeof($result_car);
		}
		die(json_encode(array('status' => 'success', 'view_count' => $count)));
	}
	public function addViewCount(){ 
		$this->autoRender = false;
		$this->loadModel('Car'); 
		if (!isset($this->request->data['car_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post car_id','code' => '202')));
		}
		$result_car = $this->Car->find('first',array('recursive' => -1, 'conditions'=> array('Car.id' => $this->request->data['car_id'])));
		if($result_car){
			$count = $result_car['Car']['view_count'] == '' ? 0 : $result_car['Car']['view_count'];
			$count = $count + 1;
			$arr_update['Car']['view_count'] = $count;
			$this->Car->id = $this->request->data['car_id'];
			if ($this->Car->save($arr_update)) {
				die(json_encode(array('status' => 'success', 'view_count' => $count)));
			}else{
				die(json_encode(array('status' => 'fail')));
			}
		}else{
			die(json_encode(array('status' => 'fail')));
		}
	}
	
	public function checkRegisterInfor(){
		$this->autoRender = false;
		$this->loadModel('User'); 
		$this->loadModel('DataSourceCar'); 
		if (!isset($this->request->data['email'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post email','code' => '202')));
		}
		if (!isset($this->request->data['first_name'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post first_name','code' => '203')));
		}
		$mail = $this->User->find('first', array('recursive' => -1, 'conditions'=> array('User.email' => $this->request->data['email'])));
		if($mail){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Email already exists', 'code' => '202')));
		}
		/*
		$name = $this->User->find('first', array('recursive' => -1, 'conditions'=> array('User.name' => $this->request->data['first_name'])));
		if($name){ 
			die(json_encode(array('status' => 'fail', 'response' => 'This Username is currently in use.', 'code' => '203')));
		}*/
		$data_source = $this->DataSourceCar->find('all', array('recursive' => -1)); 
		$arr_data_source = array();
		foreach($data_source as $a_data_source){
			$arr_data_source[] = $a_data_source['DataSourceCar'];
		}
		return json_encode(array('status' => 'success', 'response' => 'success', 'data_source' => $arr_data_source));
	}
	public function checkCarzappCode(){
		$this->autoRender = false;
		$this->loadModel('User'); 
		$this->loadModel('DataSourceCar');  
		if (!isset($this->request->data['carzapp_code'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post carzapp_code','code' => '202')));
		}
		$code = $this->request->data['carzapp_code'];
		if(strlen($code) < 2){
			die(json_encode(array('status' => 'fail', 'response' => 'Carzapp Code does not exists')));
		}
		$first = substr($code,0,1);
		$second = substr($code,1,strlen($code) - 1); 
		if($first == 'A' || $first == 'a'){
		
		}else{
			die(json_encode(array('status' => 'fail', 'response' => 'Carzapp Code does not exists')));
		}
		$carzapp_code = $this->User->find('first', array('recursive' => -1, 'conditions'=> array('User.carzapp_code' => $second, 'User.is_principle' => 1)));
		if(!$carzapp_code){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Carzapp Code does not exists')));
		}
		$arr_code = json_decode($carzapp_code['User']['data_source']); 
		$data_source = array();
		if(sizeof($arr_code)){
			foreach($arr_code as $a_arr_code){
				$data_source_request = $this->DataSourceCar->find('first', array('recursive' => -1, 'conditions' => array('DataSourceCar.id' => $a_arr_code)));
				if($data_source_request){ 
					$data_source[] = $data_source_request['DataSourceCar'];
				}
			}
		}
		return json_encode(array('status' => 'success', 'response' => 'success', 'data_source' => $data_source, 'company_name' => $carzapp_code['User']['company_name'], 'license_number' => $carzapp_code['User']['license_number'])); 
	}
	
	public function getProfile(){
		$this->autoRender = false;
		$this->loadModel('User'); 
		$this->loadModel('DataSourceCar');  
		if (!isset($this->request->data['user_id'])){ 
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		$user_infor = $this->User->find('first', array('recursive' => -1, 'conditions'=> array('User.id' => $this->request->data['user_id'])));
		if($user_infor){
		$data_source_request = $this->DataSourceCar->find('all', array('recursive' => -1));
		$data_source = array();
		foreach($data_source_request as $a_arr_code){
				$data_source[] = $a_arr_code['DataSourceCar'];
		}
		$user_infor['User']['data_feed'] = $data_source; 
		$user_infor['User']['avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user_infor['User']['avatar_file_name'];
		return json_encode(array("status" => 'success', 'info' => $user_infor['User']));
		}else{
			die(json_encode(array('status' => 'fail', 'response' => 'User does not exists')));
		}
	}
	
	public function editProfile(){
		$this->autoRender = false;
		$this->loadModel('User');
		$this->loadModel('DataSourceCar');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (isset($this->request->data['phone'])){
			$arr_register['User']['phone'] = $this->request->data['phone'];
		}
		if (isset($this->request->data['name'])){
			$arr_register['User']['name'] = $this->request->data['name'];
		}
		if (isset($this->request->data['last_name'])){
			$arr_register['User']['last_name'] = $this->request->data['last_name'];
		}
		/*if(isset($this->request->data['name'])){
			$name_existed = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.name' => $this->request->data['name'])));
			$check_name = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->request->data['user_id'])));
			if($check_name['User']['name'] != $this->request->data['name']){ 
				if($name_existed){
					die(json_encode(array('status' => 'Fail', 'response' => 'This Username is currently in use. ', 'code'=> '101')));
				}  
			}
		}*/
		
		$user_infor = $this->User->find("first", array('recursive' => -1, 'conditions' => array('User.id' => $this->request->data['user_id'])));
		//Change company infor
		$arr_company = array(); 
		if(isset($this->request->data['license_number'])){
			$arr_company['User']['license_number'] = $this->request->data['license_number'];
		}
		if(isset($this->request->data['data_source'])){
			$arr_company['User']['data_source'] = $this->request->data['data_source'];
		}
		if (isset($this->request->data['company_name'])){
			$arr_company['User']['company_name'] = $this->request->data['company_name'];
		}
		if (isset($this->request->data['company_phone'])){
			$arr_company['User']['company_phone'] = $this->request->data['company_phone'];
		}
		if (isset($this->request->data['company_email'])){
			$arr_company['User']['company_email'] = $this->request->data['company_email'];
		}
		if (isset($this->request->data['company_address'])){
			$arr_company['User']['company_address'] = $this->request->data['company_address'];
		}
		if (isset($this->request->data['latitude'])){
			$arr_company['User']['latitude'] = $this->request->data['latitude'];
		}
		if (isset($this->request->data['longitude'])){
			$arr_company['User']['longitude'] = $this->request->data['longitude'];
		}	
		if (isset($this->request->data['main_fax'])){
			$arr_company['User']['main_fax'] = $this->request->data['main_fax'];
		}
		if (isset($this->request->data['abn'])){
			$arr_company['User']['abn'] = $this->request->data['abn'];
		}
		if (isset($this->request->data['acn'])){
			$arr_company['User']['acn'] = $this->request->data['acn'];
		}
		if (isset($this->request->data['dun'])){
			$arr_company['User']['dun'] = $this->request->data['dun'];
		}
			
		if(sizeof($arr_company) > 0){
			/*if($user_infor['User']['is_principle'] != 1){
				die(json_encode(array('status' => 'Fail', 'response' => 'You have not permission to change company information.', 'code'=> '103')));
			}*/
			$arr_user = $this->User->find('all', array('conditions' =>array('User.license_number' => $user_infor['User']['license_number'])));
			foreach($arr_user as $a_arr_user){
				$this->User->create();
				$this->User->id = $a_arr_user['User']['id'];
				if ($this->User->save($arr_company)) {
					
				}
			}
		}else{
		}
		
		if (isset($this->request->data['image'])){
			$folder_url = WWW_ROOT . "img/uploads/users_avatar";
			if(!is_dir($folder_url)) {
				mkdir($folder_url, 0777, true);
			}
			$img = $this->request->data['image'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file_name = uniqid() . '.png';
			$file_avatar = $folder_url .'/'. $file_name;
			$success = file_put_contents($file_avatar, $data);
			$arr_register['User']['avatar_file_name'] = $file_name;
		}
		
		$date = new DateTime();
		$current_time = $date->format('Y-m-d H:i:s') ;
		$arr_register['User']['avatar_updated_at'] = $current_time;
		$arr_register['User']['invitation_created_at'] = $current_time;
		$arr_register['User']['current_sign_in_at'] = $current_time;
		$arr_register['User']['reset_password_sent_at'] = $current_time;
		$this->User->id = $this->request->data['user_id'];
		if ($this->User->save($arr_register)) {
		
		}
		//Get infor user
		$user_infor = $this->User->find("first", array('recursive' => -1, 'conditions' => array('User.id' => $this->request->data['user_id'])));
		$user_infor['User']['avatar'] = '/app/webroot/img/uploads/users_avatar/' . $user_infor['User']['avatar_file_name'];
		//get data source
		$arr_code = json_decode($user_infor['User']['data_source']); 
		$data_source = array();
		if(sizeof($arr_code)){
			foreach($arr_code as $a_arr_code){
				$data_source = $this->DataSourceCar->find('first', array('recursive' => -1, 'conditions' => array('DataSourceCar.id' => $a_arr_code)));
				if($data_source){
					$data_source[] = $data_source['DataSourceCar'];
				}
			}
		}
		$user_infor['User']['data_source'] = $data_source;
        return json_encode(array("status" => 'success', 'info' => $user_infor['User']));	
	}
	
	public function getListFollow(){
		$this->autoRender = false;
		$this->loadModel('User');
		$this->loadModel('FollowedCar');
		$this->User->unbindModel(array('hasMany' => array('Appchat', 'Block', 'Comment', 'Customer', 'FollowedCar', 'Message', 'Network', 'NotificationSetting', 'PushNotificationRegistration', 'ReadMark', 'Setandforget', 'ShareSetandforget', 'Subscription'), 'belongsTo' =>array('Role')));
		$arr_follower = $this->User->find('all', array('joins' => array(array('table' => 'followed_cars',
										   'alias' => 'FollowedCar',
										   'type' => 'INNER',
										   'conditions' => array('FollowedCar.user_id = User.id', 'FollowedCar.car_id = '.$this->request->data['car_id'])
									 ))
					 )
			  ); 
		$arrs_return = array();
		foreach($arr_follower as $a_arr_follower){
			$arrs_return[] = $a_arr_follower['User'];
		}
		return json_encode(array("status" => 'success', 'followers' => $arrs_return));
	}
	
	public function getNotificationSetting(){
		$this->autoRender = false;
		$this->loadModel('User');
		$this->loadModel('Notification');
		$this->loadModel('NotificationSetting');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		$notify = $this->Notification->find('all', array('recursive' => -1));
		$arr_notify = array();
		foreach($notify as $a_notify){
			$settings = $this->NotificationSetting->find('first', array('recursive' => -1, 'conditions' => array('NotificationSetting.user_id' => $this->request->data['user_id'], 'NotificationSetting.notification_id' => $a_notify['Notification']['id'])));
			if($settings){
				$a_notify['Notification']['settings'] = $settings['NotificationSetting'];
			}else{
				$a_notify['Notification']['settings'] = "";
			}
			$arr_notify[] = $a_notify['Notification'];
		}
		return json_encode(array("status" => 'success', 'notifications' => $arr_notify));
	}
	public function changeNotify(){
		$this->autoRender = false;
		$this->loadModel('User');
		$this->loadModel('Notification');
		$this->loadModel('NotificationSetting');
		if (!isset($this->request->data['user_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post user id','code' => '202')));
		}
		if (!isset($this->request->data['notification_id'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post notification id','code' => '202')));
		}
		if (!isset($this->request->data['type'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post type','code' => '202')));
		}
		if (!isset($this->request->data['value'])){
			die(json_encode(array('status' => 'fail', 'response' => 'Not post value','code' => '202')));
		}
		//check notification exist
		$arr_update = array();
		if($this->request->data['type'] == '0'){
			$arr_setting['NotificationSetting']['menu_indicator'] = $this->request->data['value'];
		}else if($this->request->data['type'] == '1'){
			$arr_setting['NotificationSetting']['pop_up'] = $this->request->data['value'];
		}else{
			$arr_setting['NotificationSetting']['notification'] = $this->request->data['value'];
		}
		$notify = $this->NotificationSetting->find('first', array('recursive' => -1, 'conditions' => array('NotificationSetting.user_id' => $this->request->data['user_id'], 'NotificationSetting.notification_id' => $this->request->data['notification_id'])));
		if($notify){
			$arr_setting['NotificationSetting']['id'] = $notify['NotificationSetting']['id'];
		}
		$arr_setting['NotificationSetting']['user_id'] = $this->request->data['user_id']; 
		$arr_setting['NotificationSetting']['notification_id'] = $this->request->data['notification_id'];
		if($this->NotificationSetting->save($arr_setting)){
			return json_encode(array("status" => 'success'));
		}else{ 
			return json_encode(array("status" => 'fail'));
		}
	}
	
}
?>