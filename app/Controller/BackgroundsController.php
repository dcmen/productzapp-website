<?php
App::uses('AppController', 'Controller');
require '/GCM.php';
App::uses('File', 'Utility');
App::import('Core', 'HttpSocket'); // Cake 1.x
App::uses('HttpSocket', 'Network/Http'); // Cake 2.x
require_once('/mail.utils/class.phpmailer.php');
class BackgroundsController extends AppController {
	public $user_id = '';
	public $uses = array();
	public function beforeFilter() {
            parent::beforeFilter();
            $this->Auth->allow(array(
                'readXMLEasyCar',
                'addImagesForEasyCar',
                'readImageEasyCar',
                'run',
                'addImage',
                'listFolderFiles',
                'listFolderFilesAll',
                'addAllImage',
                'readImage',
                'copyImage',
                'copyFiles',
                'readXMLDealerSolution',
                'readXMLBetterCarTest',
                'test',
                'readCSVBidsOnline',
                'addAllImageBidsOnline',
                'readImageBidsOnline',
                'updateImageCSVBidsOnline',
                'readCSVCarNet',
                'addAllImageCarNet',
                'readImageCarNet',
                'updateImageCSVCarNet',
                'RandomCodeCar',
                'UpdateImage',
                'readXMLDealerSolutionUAA',
                'readCSVF3MotorAuctions',
                'addAllImageF3MotorAuctions',
                'readImageF3MotorAuctions',
                'updateImageCSVF3MotorAuctions'
            ));
      } 
	public function test(){
		$this->autoRender = false;
		//echo str_ireplace (array('"'),array('\"'), 'Hard to find in Black and with these extra\'s. Check out this top of the line ST-L Nissan Tiida. Automatic, power steer, tinted windows, weather shields, 17" CSA alloys & factory matts. The condition report is "Fantastic" and comes complete with log books<br><br>x'); 
		echo Router::url('/', true);
	}
	public function readXMLEasyCar(){  
		$this->autoRender = false;
		$this->loadModel("User");
		$this->loadModel("Car");
		$this->loadModel("Setandforget");
		$this->loadModel("Image");
		$this->loadModel('PushNotificationRegistration');
		$this->loadModel('NotificationSetting'); 
		$this->loadModel('Network'); 
		$this->loadModel('Block');
		$this->loadModel('FollowedCar');
		$this->loadModel('Set4getNotification');
		$this->loadModel('OtherNotification');
		$table_name = "cars";
		
		$dir = WWW_ROOT."datafeed/easycars/";
		$dh  = opendir($dir);
		$dealer_solution_number = '';
		while (false !== ($filename = readdir($dh))) {
			$dealer_solution_number = str_ireplace (array('.','xml'),array('',''), $filename); 
		if(strpos(strtolower($filename),'.xml')) {
		
		$xml = simplexml_load_file($dir . $filename);
		$values = "";
		foreach ($xml->children() as $child) {
			$end_item = false;
			foreach ($child->children() as $a_child) {
				if($a_child->getName() == 'StockNumber'){
					$data = array();
					$end_item = false;
					$data[0] = $a_child;
					$data[1] = $dealer_solution_number;
					$data[6] = '';//badge
					$data[9] = '';//Seats
					$data[17] = '';//rego
					$data[22] = '';//engine_number
					$data[23] = '';//manu_month
					$data[25] = '';//comments
					$data[27] = '';//redbookcode
					$data[28] = '';//inventory
					$data[29] = '';//egc
					$data[30] = '';//location
					$data[31] = '';//drive_away_amount
					$data[32] = '';//is_drive_away
					$data[33] = '';//drive_type
					$data[42] = '';//appraisalnotes
					$data[43] = '';//acquisition_date
					$data[44] = '';//receiveddate
					$data[21] = '';//vin number
					$make = ''; $model = ''; $series = ''; $stock_no = $a_child; $manu_year = '';
					$badge = ''; $body = ''; $doors = ''; $seats = ''; $body_colour  = ''; $trim_colour = '';
					$gears = ''; $gearbox = ''; $fuel_type = ''; $price = ''; $retail = ''; $rego = ''; $odometer = '';
					$cylinders = ''; $engine_capacity = ''; $vin_number = '';$engine_number = ''; $options = '';$nvic = '';
					$redbookcode = ''; $inventory = ''; $egc = ''; $location = ''; $drive_away_amount = '';
					$is_drive_away = ''; $drive_type = ''; $manu_month = ''; $comments = '';
					$model_variant = ''; $registration_number = ''; $registration_expiry = ''; $engine_type = '';$engine_size = ''; $drive_train = '';$standard_extras = ''; $video_url = '';
					$appraisalnotes = ''; $acquisition_date = ''; $receiveddate = '';
				}
				if($a_child->getName() == 'Make'){
					$data[3] = $a_child;
					$make = $a_child;
				}
				if($a_child->getName() == 'Model'){
					$data[4] = $a_child;
					$model = $a_child;
				}
				if($a_child->getName() == 'ModelSeries'){
					$data[5] = $a_child;
					$series = $a_child;
				}
				if($a_child->getName() == 'ModelYear'){
					$data[2] = $a_child;
					$manu_year = $a_child;
				}
				if($a_child->getName() == 'Body'){
					$data[7] = $a_child;
					$body = $a_child;
				}
				if($a_child->getName() == 'Doors'){
					$data[8] = $a_child;
					$doors = $a_child;
				}
				if($a_child->getName() == 'Colour'){
					$data[10] = $a_child;
					$body_colour = $a_child;
				}
				if($a_child->getName() == 'Trim'){
					$data[11] = $a_child;
					$trim_colour = $a_child;
				}
				if($a_child->getName() == 'Gears'){
					$data[12] = $a_child;
					$gears = $a_child;
				}
				if($a_child->getName() == 'Transmission'){
					$data[13] = $a_child;
					$gearbox = $a_child;
				}
				if($a_child->getName() == 'FuelType'){
					$data[14] = $a_child;
					$fuel_type = $a_child;
				}
				if($a_child->getName() == 'WholesaleSellingPrice'){
					$data[15] = $a_child;//price
					$price = $a_child;
				}
				
				if($a_child->getName() == 'SellingPrice'){
					$data[16] = $a_child;//retail
					$retail = $a_child;
				}
				if($a_child->getName() == 'Odometer'){
					$data[18] = $a_child;
					$odometer = $a_child;
				}
				
				if($a_child->getName() == 'Cylinders'){
					$data[19] = $a_child;
					$cylinders = $a_child;
				}
				
				if($a_child->getName() == 'EngineCapacity'){
					$data[20] = $a_child;
					$engine_capacity = $a_child;
				}
				
				if($a_child->getName() == 'VINChassisNumber'){
					$data[21] = $a_child;
					$vin_number = $a_child;
				}
				
				if($a_child->getName() == 'Description'){
					//$data[24] = $a_child;
					$data[24] = str_ireplace (array('"', "'"),array(" "," "), $a_child);
					//$options = $a_child;
					$options = str_ireplace (array('"', "'"),array(" "," "), $a_child);
				}
				if($a_child->getName() == 'NVIC'){
					$data[26] = $a_child;
					$nvic = $a_child;
					$end_item = true; 
				}
				
				if($a_child->getName() == 'ModelVariant'){
					$model_variant = $a_child;
					$data[34] = $a_child;
				}
				if($a_child->getName() == 'RegistrationNumber'){
					$registration_number = $a_child;
					$data[35] = $a_child;
				}
				if($a_child->getName() == 'RegistrationExpiry'){
					$registration_expiry = $a_child;
					$data[36] = $a_child;
				}
				if($a_child->getName() == 'EngineType'){
					$engine_type = $a_child;
					$data[37] = $a_child;
				}
				if($a_child->getName() == 'EngineSize'){
					$engine_size = $a_child;
					$data[38] = $a_child;
				}
				if($a_child->getName() == 'DriveTrain'){
					$drive_train = $a_child;
					$data[39] = $a_child;
				}
				if($a_child->getName() == 'StandardExtras'){
					$standard_extras = $a_child;
					$data[40] = $a_child;
				}
				if($a_child->getName() == 'VideoURL'){
					$video_url = $a_child;
					$data[41] = $a_child;
				}
				if($a_child->getName() == 'appraisalnotes'){
					$appraisalnotes = $a_child;
					$data[42] = $a_child;
				}
				if($a_child->getName() == 'AcquisitionDate'){
					$acquisition_date = $a_child;
					$data[43] = $a_child;
					//receiveddate
					if(strlen($a_child) > 0){
						$date = new DateTime($a_child);
						$current_date = $date->format('d-M-Y');
						$data[44] = $current_date;
					}
				}
				
				if($end_item){
					
					$vin = $data[21];
					//$res = $this->User->query("SELECT * FROM $table_name WHERE vin_number='$vin'");
					$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
					$res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $vin)));
					
					$resUser = $this->User->find('first', array('recursive' => -1, 'conditions' => array('User.dealer_solution_number' => $data[1])));
					$user_id = '';
					if($resUser){
						$user_id = $resUser['User']['id'];
					}
					
					if($res){
						//check update
						$is_updated = false;
						// existed car
						$data_set = '';
						//$result = $res[0]["$table_name"];
						$result = $res["Car"];
						$car_id = $result['id'];
						$client_no = ($result['client_no'] == "") ? $user_id : $result['client_no'];
						
						$stock_no= ($data[0] == "") ? $result['stock_no'] : $data[0];
						
						$dealer_code= ($data[1] == "") ? $result['dealer_code'] : $data[1];
						
						$manu_year= ($data[2] == "") ? $result['manu_year'] : $data[2];
						
						$make= ($data[3] == "") ? $result['make'] : $data[3];
						if($data[3] != "" && $data[3] != $result['make']) $is_updated = true;
						
						$model= ($data[4] == "") ? $result['model'] : $data[4];
						if($data[4] != "" && $data[4] != $result['model']) $is_updated = true;
						
						$series= ($data[5] == "") ? $result['series'] : $data[5];
						if($data[5] != "" && $data[5] != $result['series']) $is_updated = true;
						
						$badge= ($data[6] == "") ? $result['badge'] : $data[6];
						
						$body= ($data[7] == "") ? $result['body'] : $data[7];
						if($data[7] != "" && $data[7] != $result['body']) $is_updated = true;
						
						$doors= ($data[8] == "") ? $result['doors'] : $data[8];
						
						$seats= ($data[9] == "") ? $result['seats'] : $data[9];
						
						$body_colour= ($data[10] == "") ? $result['body_colour'] : $data[10];
						
						$trim_colour= ($data[11] == "") ? $result['trim_colour'] : $data[11];
						
						$gears= ($data[12] == "") ? $result['gears'] : $data[12];
						
						$gearbox= ($data[13] == "") ? $result['gearbox'] : $data[13];
						if($data[13] != "" && $data[13] != $result['gearbox']) $is_updated = true;
						
						$fuel_type= ($data[14] == "") ? $result['fuel_type'] : $data[14]; 
						if($data[14] != "" && $data[14] != $result['fuel_type']) $is_updated = true;
						
						//$price= ($data[15] == "") ? $result['price'] : $data[15];
						//$retail= ($data[16] == "") ? $result['retail'] : $data[16]; 
						$price= str_ireplace (array('$',','),array('',''), ($data[15] == "") ? $result['price'] : $data[15]);
						if($data[15] != "" && (str_ireplace (array('$',','),array('',''),$data[15]) != str_ireplace (array('$',','),array('',''),$result['price']))) $is_updated = true;
						//$price= str_ireplace (array('.'),array(','), $price);	
	  
						$retail= str_ireplace (array('$',','),array('',''), ($data[16] == "") ? $result['retail'] : $data[16]);
						//$retail= str_ireplace (array('.'),array(','), $retail);					
						
						$rego= ($data[17] == "") ? $result['rego'] : $data[17];
						
						$odometer= ($data[18] == "") ? $result['odometer'] : $data[18];
						if($data[18] != "" && $data[18] != $result['odometer']) $is_updated = true;
						
						$cylinders= ($data[19] == "") ? $result['cylinders'] : $data[19];
						
						$engine_capacity= ($data[20] == "") ? $result['engine_capacity'] : $data[20];
						
						$vin_number= ($data[21] == "") ? $result['vin_number'] : $data[21];
						
						$engine_number= ($data[22] == "") ? $result['engine_number'] : $data[22];
						
						$manu_month= ($data[23] == "") ? $result['manu_month'] : $data[23];
						
						//$options = ($data[24] == "") ? $result['options'] : $data[24]; 
						$options = str_ireplace (array('"', "'"),array(" "," "), (($data[24] == "") ? $result['options'] : $data[24]));
						
						$comments= ($data[25] == "") ? $result['comments'] : $data[25];
						
						$nvic= ($data[26] == "") ? $result['nvic'] : $data[26];
						
						$redbookcode= ($data[27] == "") ? $result['redbookcode'] : $data[27];
						
						$inventory= ($data[28] == "") ? $result['inventory'] : $data[28];
						
						$egc= ($data[29] == "") ? $result['egc'] : $data[29];
						
						$location= ($data[30] == "") ? $result['location'] : $data[30];
						
						$drive_away_amount= ($data[31] == "") ? $result['drive_away_amount'] : $data[31];
						
						$is_drive_away= ($data[32] == "") ? $result['is_drive_away'] : $data[32];
						
						$drive_type= ($data[33] == "") ? $result['drive_type'] : $data[33];
						
						$model_variant= ($data[34] == "") ? $result['model_variant'] : $data[34];
						$registration_number= ($data[35] == "") ? $result['registration_number'] : $data[35];
						$registration_expiry= ($data[36] == "") ? $result['registration_expiry'] : $data[36];
						$engine_type= ($data[37] == "") ? $result['engine_type'] : $data[37];
						$engine_size= ($data[38] == "") ? $result['engine_size'] : $data[38];
						$drive_train= ($data[39] == "") ? $result['drive_train'] : $data[39];
						$standard_extras= ($data[40] == "") ? $result['standard_extras'] : $data[40];
						$video_url= ($data[41] == "") ? $result['video_url'] : $data[41];
						$appraisalnotes= ($data[42] == "") ? $result['appraisalnotes'] : $data[42];
						$acquisition_date= ($data[43] == "") ? $result['acquisition_date'] : $data[43];
						$receiveddate= ($data[44] == "") ? $result['receiveddate'] : $data[44];
						
						
						$update_res = $this->User->query("UPDATE $table_name SET client_no = \"$client_no\", 
						stock_no = \"$stock_no\", dealer_code = \"$dealer_code\", manu_year = \"$manu_year\", make = \"$make\", model = \"$model\", series = \"$series\", badge = \"$badge\", body = \"$body\", doors = \"$doors\", seats = \"$seats\", body_colour = \"$body_colour\", trim_colour = \"$trim_colour\", gears = \"$gears\", gearbox = \"$gearbox\", fuel_type = \"$fuel_type\", price = \"$price\", retail = \"$retail\", rego = \"$rego\", odometer = \"$odometer\", cylinders = \"$cylinders\", engine_capacity = \"$engine_capacity\", vin_number = \"$vin_number\", engine_number = \"$engine_number\", manu_month = \"$manu_month\", options = \"$options\", comments = \"$comments\", nvic = \"$nvic\", redbookcode = \"$redbookcode\", inventory = \"$inventory\", egc = \"$egc\", location = \"$location\", drive_away_amount = \"$drive_away_amount\", is_drive_away = \"$is_drive_away\", drive_type = \"$drive_type\" , model_variant = \"$model_variant\" , registration_number = \"$registration_number\" , registration_expiry = \"$registration_expiry\" , engine_type = \"$engine_type\" , engine_size = \"$engine_size\" , drive_train = \"$drive_train\" , standard_extras = \"$standard_extras\" , video_url = \"$video_url\", appraisalnotes = \"$appraisalnotes\", acquisition_date =\"$acquisition_date\", receiveddate =\"$receiveddate\"
						WHERE id = $car_id
						");
						
						if($update_res){
							//Push update
							if($is_updated){
								$follower = $this->FollowedCar->find('all', array('recursive' => -1, 'conditions' =>array('FollowedCar.car_id' => $car_id)));
								foreach($follower as $a_follower){
									//Save notification
									if($client_no != ""){
										$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '8', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $a_follower['FollowedCar']['user_id'])));
										if(!$check_notify){
											$update_notify['OtherNotification']['notification_id'] = 8;
											$update_notify['OtherNotification']['user_id'] = $a_follower['FollowedCar']['user_id'];
											$update_notify['OtherNotification']['car_id'] = $car_id;
											$update_notify['OtherNotification']['is_read'] = 0;
											if($this->OtherNotification->save($update_notify)){
												
											}
										}
									}
									
									$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$a_follower['FollowedCar']['user_id'])));
									$arr_gcm_android = array();
									$arr_gcm_ios = array();
									foreach($user_receive_notifi as $a_item){
										if($a_item['PushNotificationRegistration']['os']==0){
											$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}else{
											$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}
									}
									$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_follower['FollowedCar']['user_id'], 'NotificationSetting.notification_id' => '8')));
									if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
										$data = array();
										$data['message']="The car which you followed has been updated by owner";
										$data['settings'] = $settings['NotificationSetting'];
										$data['car_id'] = $car_id;
										if(sizeof($arr_gcm_android) > 0){
											$gcm = new GCM();
											$push_result = $gcm->send_notification($arr_gcm_android, $data);					
											if($push_result== false) { 
											}
										}
										if(sizeof($arr_gcm_ios) > 0){
											$HttpSocket = new HttpSocket();
											$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
										}
									}
								}
							}
						}
					}else{
						// new car
						$value = "(";
						$value .= "\"".$user_id."\",";
						$i = 0;
						foreach($data as $x){
							$value .= "\"".$data[$i]."\",";
							$i ++;
						}
						$value = substr($value, 0, -1) . ")";
						if(strlen($value) > 0){  
							//$values = substr($value, 0, -2) . ")";
							$this->User->query("INSERT INTO $table_name (client_no,stock_no,dealer_code,manu_year,make,model,series,badge,body,doors,seats,body_colour,trim_colour,gears,gearbox,fuel_type,price,retail,rego,odometer,cylinders,engine_capacity,vin_number,engine_number,manu_month,options,comments,nvic,redbookcode,inventory,egc,location,drive_away_amount,is_drive_away,drive_type, model_variant, registration_number, registration_expiry, engine_type, engine_size, drive_train, standard_extras, video_url, appraisalnotes, acquisition_date, receiveddate)	
								VALUES ". $value);
							
							//push set_and_forget
							if(strlen($data[21]) == 17){
								$arr_forget  = $this->Setandforget->find('all', array('recursive' => -1, 'conditions' =>array('Setandforget.vin_number LIKE ' => "%".substr($data[21],0,10)."%"))); 
								
								//Check push set4get 2
								$is_push = false;
								$arr_gcm_android_owner = array();
								$arr_gcm_ios_owner = array();
								if($resUser && sizeof($arr_forget) > 0){
									$settings_owner = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $resUser['User']['id'], 'NotificationSetting.notification_id' => '2')));
										if($settings_owner && ($settings_owner['NotificationSetting']['menu_indicator'] == 1 || $settings_owner['NotificationSetting']['pop_up'] == 1 || $settings_owner['NotificationSetting']['notification'] == 1)){
											$owner_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$resUser['User']['id'])));
											foreach($owner_receive_notifi as $a_item){
												if($a_item['PushNotificationRegistration']['os']==0){
													$arr_gcm_android_owner[] = $a_item['PushNotificationRegistration']['gcm_reg'];
												}else{
													$arr_gcm_ios_owner[] = $a_item['PushNotificationRegistration']['gcm_reg'];
												}
											}
											$is_push = true;
										}
								}
								foreach($arr_forget as $a_arr_forget){
									$arr_gcm_android = array();
									$arr_gcm_ios = array();
									$data = array();
									$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$a_arr_forget['Setandforget']['user_id'])));
									foreach($user_receive_notifi as $a_item){
										if($a_item['PushNotificationRegistration']['os']==0){
											$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}else{
											$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}
									}
									//Save data set4get 1
									$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
									$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
									$car_id = $car_query['Car']['id'];
									
									$update_set4get_1['Set4getNotification']['user_id'] = $a_arr_forget['Setandforget']['user_id'];
									$update_set4get_1['Set4getNotification']['car_id'] = $car_id;
									$update_set4get_1['Set4getNotification']['set4get_id'] = $a_arr_forget['Setandforget']['id'];
									$update_set4get_1['Set4getNotification']['type'] = 1;
									$this->Set4getNotification->create();
									if($this->Set4getNotification->save($update_set4get_1)){
										
									}
									
									$data['message'] = "CarZapp has found a car which match with your SetnForget!";
									$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_arr_forget['Setandforget']['user_id'], 'NotificationSetting.notification_id' => '1')));
										if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
											$data['settings'] = $settings['NotificationSetting'];
											if(sizeof($arr_gcm_android) > 0){
												$gcm = new GCM();
												$push_result = $gcm->send_notification($arr_gcm_android, $data);					
												if($push_result== false) { 
												}
											}
											if(sizeof($arr_gcm_ios) > 0){  
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
											}
									}
									
									//Push set4get 2
									//$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $resUser['User']['id'], 'Network.user_id' => $a_arr_forget['Setandforget']['user_id']), array('Network.member_id' => $a_arr_forget['Setandforget']['user_id'], 'Network.user_id' => $resUser['User']['id'])))));
									if($is_push){
										$user_set4get = $this->User->find('first', array('recursive' => -1, 'conditions'=> array('User.id' => $a_arr_forget['Setandforget']['user_id'])));
										$data_owner = array();
										$data_owner['settings'] = $settings_owner['NotificationSetting'];
										$data_owner['message'] = $user_set4get['User']['name']." has found 1 set4get record which matches your car";
										if(sizeof($arr_gcm_android_owner) > 0){
												$gcm = new GCM(); 
												$push_result = $gcm->send_notification($arr_gcm_android_owner, $data_owner);					
												if($push_result== false) { 
												}
											}
										if(sizeof($arr_gcm_ios_owner) > 0){
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data_owner, 'msg_string' => $data_owner['message'], 'dt' => $arr_gcm_ios_owner));
										}
										
										//Save data set4get 2
										
										$update_set4get_2['Set4getNotification']['user_id'] = $resUser['User']['id'];
										$update_set4get_2['Set4getNotification']['car_id'] = $car_id;
										$update_set4get_2['Set4getNotification']['set4get_id'] = $a_arr_forget['Setandforget']['id'];
										$update_set4get_2['Set4getNotification']['type'] = 2;
										$this->Set4getNotification->create();
										if($this->Set4getNotification->save($update_set4get_2)){ 
											
										}
									}
								
								}
								
							}
							
							//Push Add New Car
							if($resUser){
								$result_gcm = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $resUser['User']['id'])));
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
									
									//Save notification
									if($user_id != ''){
										$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
										$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
										$car_id = $car_query['Car']['id'];
										$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '5', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $user_id)));
										if(!$check_notify){
											$update_notify['OtherNotification']['notification_id'] = 5;
											$update_notify['OtherNotification']['user_id'] = $user_id;
											$update_notify['OtherNotification']['car_id'] = $car_id;
											$update_notify['OtherNotification']['is_read'] = 0;
											if($this->OtherNotification->save($update_notify)){ 
												
											}
										}
									}
									$data['message']= "New car is added to your stock";
									$data['car_id'] = $car_id;
										$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $resUser['User']['id'], 'NotificationSetting.notification_id' => '5')));
										if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
											$data['settings'] = $settings['NotificationSetting'];
											if(sizeof($arr_gcm_android) > 0){
												$gcm = new GCM();
												$push_result = $gcm->send_notification($arr_gcm_android, $data);					
												if($push_result== false) { 
												}
											}
											if(sizeof($arr_gcm_ios) > 0){
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
											}
										}
								}
								
								//Push my network
								$arr_network = $this->User->find('all', array(
							   'fields' => array('User.*'),
							   'joins' => array(array('table' => 'networks',
													   'alias' => 'Network',
													   'type' => 'INNER',
													   'conditions' => array('Network.member_id'=>$resUser['User']['id'], 'User.id = Network.user_id')
												 ))
								)
								  );
								$arr_network_right = $this->User->find('all', array(
										   'fields' => array('User.*'),
										   'joins' => array(array('table' => 'networks',
																   'alias' => 'Network',
																   'type' => 'INNER',
																   'conditions' => array('Network.user_id'=>$resUser['User']['id'], 'User.id = Network.member_id')))			 
											)
									  );
								foreach($arr_network_right as $a_arr_network_right){
								$arr_network[] = $a_arr_network_right;
								}
								$arr_result = array();
								foreach($arr_network as $a_arr_network){
									$request = $this->Block->find('first', array('recursive' => -1, 'conditions' => array('Block.user_id' =>$resUser['User']['id'],'Block.blocker_id' =>$a_arr_network['User']['id'])));
									if(!$request){
										//Not Block
										$result_gcm_network = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $a_arr_network['User']['id'])));
										$data = array();
										if($result_gcm_network){
											$arr_gcm_android = array();
											$arr_gcm_ios = array();
											foreach($result_gcm_network as $a_result_gcm){
												if($a_result_gcm['PushNotificationRegistration']['os']==0){
													$arr_gcm_android[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
												}else{
													$arr_gcm_ios[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
												}
											}
											
											//Save notification
											if($user_id != ''){
												$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
												$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
												$car_id = $car_query['Car']['id'];
												$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '6', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $a_arr_network['User']['id'])));
												if(!$check_notify){
													$update_notify['OtherNotification']['notification_id'] = 6;
													$update_notify['OtherNotification']['user_id'] = $a_arr_network['User']['id'];
													$update_notify['OtherNotification']['car_id'] = $car_id;
													$update_notify['OtherNotification']['sender_id'] = $user_id;
													$update_notify['OtherNotification']['is_read'] = 0;
													if($this->OtherNotification->save($update_notify)){ 
														
													}
												}
											}
											$data['message']= "New car is added to Your Network's stock";
											$data['car_id'] = $car_id;
												$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_arr_network['User']['id'], 'NotificationSetting.notification_id' => '6')));
												if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
													
													$data['settings'] = $settings['NotificationSetting'];
													if(sizeof($arr_gcm_android) > 0){
														$gcm = new GCM(); 
														$push_result = $gcm->send_notification($arr_gcm_android, $data);					
														if($push_result== false) { 
														}
													}
													if(sizeof($arr_gcm_ios) > 0){
														$HttpSocket = new HttpSocket();
														$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
													}
												}
										}
									}
								} 
								
							}
						}
						//$values .= $value .",";
					}
				}
			}
		}
		}
	}
	}
	public function addImagesForEasyCar(){
	///app/webroot/img/uploads/car_images/
		$this->autoRender = false;
		$folder_url = WWW_ROOT . "datafeed/easycars";
		$this->readImageEasyCar($folder_url);
	}
	function readImageEasyCar($dir){
	$this->autoRender = false;
	$this->loadModel('Car');
	$this->loadModel('Image');
			$file = scandir($dir);
			$arr_file = array();
			foreach($file as $a_file){
				if($a_file != '.' && $a_file != '..'){
						if(!strpos(strtolower($a_file),'.xml')) {
						$arr_name = explode("_",$a_file);
						if(sizeof($arr_name) > 1){
							$dealer_code = $arr_name[0];
							$stock_no = $arr_name[1];
							$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
							$result = $this->Car->find('first', array('recursive' => -1, 'conditions' =>array('Car.dealer_code' => $dealer_code, 'Car.stock_no' => $stock_no)));
							$car_id = '';
							if($result){
								$car_id = $result['Car']['id'];
								$rs = $this->Image->find('first', array('recursive' => -1, 'conditions' =>array('Image.car_id' =>$car_id, 'Image.image_file_name' =>'easycars/'. $a_file)));  
								if(!$rs){
									$date = new DateTime();
									$current_time = $date->format('Y-m-d H:i:s') ;
									$arr_add['Image']['car_id'] = $car_id;
									$arr_add['Image']['image_file_name'] = Router::url('/', true).'/app/webroot/datafeed/easycars/'.$a_file;
									//$arr_add['Image']['image_file_name_mid'] = $mid;
									//$arr_add['Image']['image_file_name_small'] = $small;
									$arr_add['Image']['folder_name'] = '';
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['is_server_sdc'] = 0;
									$this->Image->create();
									if($this->Image->save($arr_add)) {
										 
									}else{ 
										echo "Error<br/>";
									}
								}
								
							}
						}
					}
				}
			
			}
	}
	 
        
        public function  UpdateImage()
        {
            $this->autoRender = false;
            $this->loadModel("Car");
            $res_cars = $this->Car->query("UPDATE cars SET cars.image_url = (SELECT images.image_file_name FROM images WHERE cars.id = images.car_id LIMIT 1), cars.image_count = (SELECT COUNT(*) FROM images WHERE cars.id = images.car_id)"); 
	
        }

        public function run(){
		$this->autoRender = false;
		$this->loadModel("User");
		$this->loadModel("Car");
		$table_name = "cars";
		//Easy Car SYNC
	$this->readXMLEasyCar();
	$this->addImagesForEasyCar();
		//DealerSolution SYNC
	$this->readXMLDealerSolution();
		//Delete these car not image
		//$res_image = $this->User->query("DELETE FROM cars WHERE id NOT IN (SELECT DISTINCT car_id FROM images)"); 
		//$res_cars = $this->User->query("UPDATE cars SET price = retail WHERE price = 0"); 
	$res_cars = $this->Car->query("UPDATE cars SET cars.image_url = (SELECT images.image_file_name FROM images WHERE cars.id = images.car_id LIMIT 1), cars.image_count = (SELECT COUNT(*) FROM images WHERE cars.id = images.car_id)"); 
	$update_random_code = $this->Car->query("UPDATE cars SET cars.random_code = FLOOR(0+RAND()*(10000-0))");
	/* 
		$dir = WWW_ROOT."datafeed/dealersolutions/file/";
		$dh  = opendir($dir);
		while (false !== ($filename = readdir($dh))) {
			if(strpos($filename,'.csv')) break;
		}
		
		if (($handle = fopen($dir . $filename, "r")) !== FALSE) {
			$values = "";
			$start = 0;
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				if($start == 0){
					$start++;
					continue;
				}
				$vin = $data[21];
				$res = $this->User->query("SELECT * FROM $table_name WHERE vin_number='$vin'");
				
				$resUser = $this->User->find('first', array('conditions' => array('User.dealer_solution_number' => $data[1])));
				$user_id = '';
				if($resUser){
					$user_id = $resUser['User']['id'];
				}
				if($res){	
					// existed car
					$data_set = '';
					$result = $res[0]["$table_name"];
					$car_id = $result['id'];
					$client_no = ($result['client_no'] == "") ? $user_id : $result['client_no'];
					
					$stock_no= ($data[0] == "") ? $result['stock_no'] : $data[0];
					
					$dealer_code= ($data[1] == "") ? $result['dealer_code'] : $data[1];
					
					$manu_year= ($data[2] == "") ? $result['manu_year'] : $data[2];
					
					$make= ($data[3] == "") ? $result['make'] : $data[3];
					
					$model= ($data[4] == "") ? $result['model'] : $data[4];
					
					$series= ($data[5] == "") ? $result['series'] : $data[5];
					
					$badge= ($data[6] == "") ? $result['badge'] : $data[6];
					
					$body= ($data[7] == "") ? $result['body'] : $data[7];
					
					$doors= ($data[8] == "") ? $result['doors'] : $data[8];
					
					$seats= ($data[9] == "") ? $result['seats'] : $data[9];
					
					$body_colour= ($data[10] == "") ? $result['body_colour'] : $data[10];
					
					$trim_colour= ($data[11] == "") ? $result['trim_colour'] : $data[11];
					
					$gears= ($data[12] == "") ? $result['gears'] : $data[12];
					
					$gearbox= ($data[13] == "") ? $result['gearbox'] : $data[13];
					
					$fuel_type= ($data[14] == "") ? $result['fuel_type'] : $data[14]; 
					
					//$price= ($data[15] == "") ? $result['price'] : $data[15];
					//$retail= ($data[16] == "") ? $result['retail'] : $data[16]; 
					$price= str_ireplace (array('$',','),array('',''), ($data[15] == "") ? $result['price'] : $data[15]);
					//$price= str_ireplace (array('.'),array(','), $price);	
  
					$retail= str_ireplace (array('$',','),array('',''), ($data[16] == "") ? $result['retail'] : $data[16]);
					//$retail= str_ireplace (array('.'),array(','), $retail);					
					
					$rego= ($data[17] == "") ? $result['rego'] : $data[17];
					
					$odometer= ($data[18] == "") ? $result['odometer'] : $data[18];
					
					$cylinders= ($data[19] == "") ? $result['cylinders'] : $data[19];
					
					$engine_capacity= ($data[20] == "") ? $result['engine_capacity'] : $data[20];
					
					$vin_number= ($data[21] == "") ? $result['vin_number'] : $data[21];
					
					$engine_number= ($data[22] == "") ? $result['engine_number'] : $data[22];
					
					$manu_month= ($data[23] == "") ? $result['manu_month'] : $data[23];
					
					$options= ($data[24] == "") ? $result['options'] : $data[24];
					
					$comments= ($data[25] == "") ? $result['comments'] : $data[25];
					
					$nvic= ($data[26] == "") ? $result['nvic'] : $data[26];
					
					$redbookcode= ($data[27] == "") ? $result['redbookcode'] : $data[27];
					
					$inventory= ($data[28] == "") ? $result['inventory'] : $data[28];
					
					$egc= ($data[29] == "") ? $result['egc'] : $data[29];
					
					$location= ($data[30] == "") ? $result['location'] : $data[30];
					
					$drive_away_amount= ($data[31] == "") ? $result['drive_away_amount'] : $data[31];
					
					$is_drive_away= ($data[32] == "") ? $result['is_drive_away'] : $data[32];
					
					$drive_type= ($data[33] == "") ? $result['drive_type'] : $data[33];
					
					$update_res = $this->User->query("UPDATE $table_name SET client_no = \"$client_no\", 
					stock_no = \"$stock_no\", dealer_code = \"$dealer_code\", manu_year = \"$manu_year\", make = \"$make\", model = \"$model\", series = \"$series\", badge = \"$badge\", body = \"$body\", doors = \"$doors\", seats = \"$seats\", body_colour = \"$body_colour\", trim_colour = \"$trim_colour\", gears = \"$gears\", gearbox = \"$gearbox\", fuel_type = \"$fuel_type\", price = \"$price\", retail = \"$retail\", rego = \"$rego\", odometer = \"$odometer\", cylinders = \"$cylinders\", engine_capacity = \"$engine_capacity\", vin_number = \"$vin_number\", engine_number = \"$engine_number\", manu_month = \"$manu_month\", options = \"$options\", comments = \"$comments\", nvic = \"$nvic\", redbookcode = \"$redbookcode\", inventory = \"$inventory\", egc = \"$egc\", location = \"$location\", drive_away_amount = \"$drive_away_amount\", is_drive_away = \"$is_drive_away\", drive_type = \"$drive_type\" 
					WHERE id = $car_id
					");
					
					if($update_res){
						echo "Updated id = ".$car_id."<br/>";
					}
				}else{
					// new car
					$value = "(";
					$value .= "\"".$user_id."\",";
					
					foreach($data as $x){
						$value .= "\"".$x."\",";
					}
					$value = substr($value, 0, -1) . ")";
					
					$values .= $value .",";
				}
			}
			if(strlen($values) > 0){
				$values = substr($values, 0, -2) . ")";
				$this->User->query("INSERT INTO $table_name (client_no,stock_no,dealer_code,manu_year,make,model,series,badge,body,doors,seats,body_colour,trim_colour,gears,gearbox,fuel_type,price,retail,rego,odometer,cylinders,engine_capacity,vin_number,engine_number,manu_month,options,comments,nvic,redbookcode,inventory,egc,location,drive_away_amount,is_drive_away,drive_type)	
					VALUES ". $values);
				
			}
			
			fclose($handle);
		}*/
		echo "Done";
	}
	
	public function addImage(){
	///app/webroot/img/uploads/car_images/
		$this->autoRender = false;
		$folder_url = WWW_ROOT . "img/uploads/car_images";
		$this->listFolderFiles($folder_url);
	}
	function listFolderFiles($dir){
	$this->autoRender = false;
	$this->loadModel('Car');
	$this->loadModel('Image');
		$ffs = scandir($dir);
		foreach($ffs as $ff){
			if($ff != '.' && $ff != '..'){
				if(is_dir($dir.'/'.$ff)) {
					$file = scandir($dir.'/'.$ff);
					$arr_file = array();
					foreach($file as $a_file){
						if($a_file != '.' && $a_file != '..'){
							$arr_file[] = $a_file ;
							//$arr = explode(" ",$a_file);
						}
					}
					if(sizeof($arr_file) > 0){
						$arr_name = explode("_",$arr_file[0]);
						$dealer_code = $arr_name[0];
						$stock_no = $arr_name[1];
						$result = $this->Car->find('first', array('conditions' =>array('Car.dealer_code' => $dealer_code, 'Car.stock_no' => $stock_no)));
						if($result){
							$small = '';
							$mid = '';
							$normal = '';
							foreach($arr_file as $a_sub_file){
								if(substr($a_sub_file,0,3) == 'mid'){
									$mid = $a_sub_file;
								}else if(substr($a_sub_file,0,5) == 'small'){
									$small = $a_sub_file;
								}else{
									$normal = $a_sub_file;
								}
							}
							$rs = $this->Image->find('first', array('conditions' =>array('Image.image_file_name' =>$normal, 'Image.image_file_name_mid' =>$mid, 'Image.image_file_name_small' =>$small)));
							if(!$rs){
								$date = new DateTime();
								$current_time = $date->format('Y-m-d H:i:s') ;
								$arr_add['Image']['car_id'] = $result['Car']['id'];
								$arr_add['Image']['image_file_name'] = $normal;
								$arr_add['Image']['image_file_name_mid'] = $mid;
								$arr_add['Image']['image_file_name_small'] = $small;
								$arr_add['Image']['folder_name'] = $ff;
								$arr_add['Image']['updated_at'] = $current_time;
								$arr_add['Image']['updated_at'] = $current_time;
								$arr_add['Image']['is_server_sdc'] = 1;
								//$arr_add['Image']['url'] = '/app/webroot/img/uploads/car_images/' . $file_name;
								$this->Image->create();
								if($this->Image->save($arr_add)) {
									
								}
							}
						}
					}
				}
			}
		}
	}
	
	
	function listFolderFilesAll($dir){
	$this->autoRender = false;
	$this->loadModel('Car');
	$this->loadModel('Image');
		$ffs = scandir($dir);
		foreach($ffs as $ff){
			if($ff != '.' && $ff != '..'){
				if(is_dir($dir.'/'.$ff)) {
					$file = scandir($dir.'/'.$ff);
					$arr_file = array();
					foreach($file as $a_file){
						if($a_file != '.' && $a_file != '..'){
							$arr_file[] = $a_file ;
							//$arr = explode(" ",$a_file);
						}
					}
					if(sizeof($arr_file) > 0){
						$arr_name = explode("_",$arr_file[0]);
						$dealer_code = $arr_name[0];
						$stock_no = $arr_name[1];
						$result = $this->Car->find('first', array('conditions' =>array('Car.dealer_code' => $dealer_code, 'Car.stock_no' => $stock_no)));
						$car_id = '';
						if($result){
							$car_id = $result['Car']['id'];
						}
							$small = '';
							$mid = '';
							$normal = '';
							foreach($arr_file as $a_sub_file){
								if(substr($a_sub_file,0,3) == 'mid'){
									$mid = $a_sub_file;
								}else if(substr($a_sub_file,0,5) == 'small'){
									$small = $a_sub_file;
								}else{
									$normal = $a_sub_file;
								}
							}
							//$rs = $this->Image->find('first', array('conditions' =>array('Image.image_file_name' =>$normal, 'Image.image_file_name_mid' =>$mid, 'Image.image_file_name_small' =>$small)));
							//if(!$rs){
								$date = new DateTime();
								$current_time = $date->format('Y-m-d H:i:s') ;
								$arr_add['Image']['car_id'] = $car_id;
								$arr_add['Image']['image_file_name'] = $normal;
								$arr_add['Image']['image_file_name_mid'] = $mid;
								$arr_add['Image']['image_file_name_small'] = $small;
								$arr_add['Image']['folder_name'] = $ff;
								$arr_add['Image']['updated_at'] = $current_time;
								$arr_add['Image']['updated_at'] = $current_time;
								$arr_add['Image']['is_server_sdc'] = 1;
								//$arr_add['Image']['url'] = '/app/webroot/img/uploads/car_images/' . $file_name;
								$this->Image->create();
								if($this->Image->save($arr_add)) {
									 
								}else{ 
									echo "Error<br/>";
								}
							//}
						
					}else{
						echo $ff."<br/>";
					}
				}
			}
		}
	}
	
	public function addAllImage(){
	///app/webroot/img/uploads/car_images/
		$this->autoRender = false;
		$folder_url = WWW_ROOT . "datafeed/dealersolutions/images";
		$this->readImage($folder_url);
	}
	function readImage($dir){
	$this->autoRender = false;
	$this->loadModel('Car');
	$this->loadModel('Image');
			$file = scandir($dir);
			$arr_file = array();
			foreach($file as $a_file){
				if($a_file != '.' && $a_file != '..'){
						$arr_name = explode("_",$a_file);
						$dealer_code = $arr_name[0];
						$stock_no = $arr_name[1];
						$result = $this->Car->find('first', array('conditions' =>array('Car.dealer_code' => $dealer_code, 'Car.stock_no' => $stock_no)));
						$car_id = '';
						if($result){
							$car_id = $result['Car']['id'];
							$rs = $this->Image->find('first', array('conditions' =>array('Image.car_id' =>$car_id, 'Image.image_file_name' =>$a_file)));
							if(!$rs){
								$date = new DateTime();
								$current_time = $date->format('Y-m-d H:i:s') ;
								$arr_add['Image']['car_id'] = $car_id;
								$arr_add['Image']['image_file_name'] = 'dealersolutions/images/'.$a_file;
								//$arr_add['Image']['image_file_name_mid'] = $mid;
								//$arr_add['Image']['image_file_name_small'] = $small;
								$arr_add['Image']['folder_name'] = '';
								$arr_add['Image']['updated_at'] = $current_time;
								$arr_add['Image']['updated_at'] = $current_time;
								$arr_add['Image']['is_server_sdc'] = 1;
								$this->Image->create();
								if($this->Image->save($arr_add)) {
									 
								}else{ 
									echo "Error<br/>";
								}
							}
							
					}
				}
			
			}
	}
	
	
	public function copyImage(){
	///app/webroot/img/uploads/car_images/
		$this->autoRender = false;
		$folder_url = WWW_ROOT . "img/uploads/";
		$this->copyFiles($folder_url);
	}
	function copyFiles($rootdir){
		$dir = $rootdir . "car_images";
		$desDir = $rootdir . "images";
		$this->autoRender = false;
		$this->loadModel('Car');
		$this->loadModel('Image');
		$ffs = scandir($dir);
		$i = 1;
		foreach($ffs as $ff){
			if($ff != '.' && $ff != '..'){
				if(is_dir($dir.'/'.$ff)) {
					$file = scandir($dir.'/'.$ff);
					$arr_file = array();
					foreach($file as $a_file){
						if($a_file != '.' && $a_file != '..'){
							$arr_file[] = $a_file ;
							//$arr = explode(" ",$a_file);
						}
					}
					if(sizeof($arr_file) > 0){
						$file = new File($desDir . "/". $arr_file[0]);
						if (!$file->exists()) {
							copy($dir . "/".$ff."/". $arr_file[0], $desDir . "/". $arr_file[0]);
							echo "Copied $arr_file[0] from /car_images to /images. \n";
						}else{
							echo "Rejected ".$i;
							$i++;
						}
					}
				}
			}
			
			
		}
	}
        
        public function readXMLDealerSolutionUAA(){
		$this->autoRender = false;
		$this->loadModel("User");
		$this->loadModel("Car");
		$this->loadModel("Image");
		$this->loadModel("Setandforget");
		$this->loadModel('PushNotificationRegistration');
		$this->loadModel('NotificationSetting'); 
		$this->loadModel('Network'); 
		$this->loadModel('Block');
		$this->loadModel('FollowedCar');
		$this->loadModel('Set4getNotification');
		$this->loadModel('OtherNotification');
		
		$table_name = "cars";
		
		$dir = WWW_ROOT."datafeed/dealersolutions/";
		$dh  = opendir($dir);
		$dealer_solution_number = '';
                $filename = '1457429450.XML';
		if(strpos(strtolower($filename),'.xml')) {
		
		$xml = simplexml_load_file($dir . $filename);
		$values = ""; 
		$arr_image = array();
		$data = array();
		foreach ($xml->children() as $child) {
			foreach ($child->children() as $a_child) { 
				if($a_child->getName() == 'Images'){
					foreach ($a_child->children() as $a_child_image) {
						$arr_image[] = $a_child_image->attributes()[0];
					}				
				}
				if($a_child->getName() == 'stockno'){
					$data = array();
					$arr_image = array();
					$data[0] = $a_child;
					//$data[6] = '';//badge
					//$data[9] = '';//Seats
					$data[1] = '';
					$data[2] = '';
					$data[3] = '';
					$data[4] = '';
					$data[5] = '';
					$data[6] = '';
					$data[7] = '';
					$data[8] = '';
					$data[9] = '';
					$data[10] = '';
					$data[11] = '';
					$data[12] = '';
					$data[13] = '';
					$data[14] = '';
					$data[15] = '';
					$data[16] = '';
					$data[18] = '';
					$data[19] = '';
					$data[20] = '';
					$data[21] = '';
					$data[23] = '';
					$data[24] = '';
					$data[25] = '';
					$data[26] = '';
					$data[27] = '';
					$data[29] = '';
					$data[30] = '';
					$data[31] = '';
					$data[32] = '';
					$data[37] = '';
					$data[17] = '';//rego
					$data[22] = '';//engine_number
					$data[28] = '';//inventory
					$data[33] = '';//drive_type
					$data[34] = '';//ModelVariant
					$data[35] = '';//RegistrationNumber
					$data[36] = '';//RegistrationExpiry
					$data[38] = '';//EngineSize
					$data[39] = '';//DriveTrain
					$data[40] = '';//StandardExtras
					$data[46] = '';//appraisalnotes 
					$data[47] = '';//acquisition_date
					$data[21] = '';//vin number
					
					$make = ''; $model = ''; $series = ''; $stock_no = $a_child; $manu_year = '';
					$badge = ''; $body = ''; $doors = ''; $seats = ''; $body_colour  = ''; $trim_colour = '';
					$gears = ''; $gearbox = ''; $fuel_type = ''; $price = ''; $retail = ''; $rego = ''; $odometer = '';
					$cylinders = ''; $engine_capacity = ''; $vin_number = '';$engine_number = ''; $options = '';$nvic = '';
					$redbookcode = ''; $inventory = ''; $egc = ''; $location = ''; $drive_away_amount = '';
					$is_drive_away = ''; $drive_type = ''; $manu_month = ''; $comments = '';
					$model_variant = ''; $registration_number = ''; $registration_expiry = ''; $engine_type = '';$engine_size = ''; $drive_train = '';$standard_extras = ''; $video_url = ''; $engineno = ''; $regovalid = ''; $receiveddate = ''; $status = '';
					$appraisalnotes = ''; $acquisition_date = '';
				}
				if($a_child->getName() == 'dealerId'){
					$data[1] = $a_child;
					$dealer_solution_number = $a_child;
				}
				if($a_child->getName() == 'manuyear'){
					$data[2] = $a_child;
					$manu_year = $a_child;
				}
				if($a_child->getName() == 'make'){
					$data[3] = $a_child;
					$make = $a_child;
				}
				if($a_child->getName() == 'model'){
					$data[4] = $a_child;
					$model = $a_child;
				}
				if($a_child->getName() == 'series'){
					$data[5] = $a_child;
					$series = $a_child;
				}
				if($a_child->getName() == 'badge'){
					$data[6] = $a_child;
					$badge = $a_child;
				}
				if($a_child->getName() == 'body'){
					$data[7] = $a_child;
					$body = $a_child;
				}
				if($a_child->getName() == 'doors'){
					$data[8] = $a_child;
					$doors = $a_child;
				}
				if($a_child->getName() == 'seats'){
					$data[9] = $a_child;
					$seats = $a_child;
				}
				if($a_child->getName() == 'colour'){
					$data[10] = $a_child;
					$body_colour = $a_child;
				}
				if($a_child->getName() == 'interior_colour'){//Trim
					$data[11] = $a_child;
					$trim_colour = $a_child;
				}
				if($a_child->getName() == 'gears'){
					$data[12] = $a_child;
					$gears = $a_child;
				}
				if($a_child->getName() == 'transmission'){
					$data[13] = $a_child;
					$gearbox = $a_child;
				}
				if($a_child->getName() == 'fueltype'){
					$data[14] = $a_child;
					$fuel_type = $a_child;
				}
				if($a_child->getName() == 'wholesale'){
					$data[15] = $a_child;//price
					$price = $a_child;
				}
				
				if($a_child->getName() == 'price'){
					$data[16] = $a_child;//retail
					$retail = $a_child;
				}
				if($a_child->getName() == 'rego'){
					$data[17] = $a_child;//rego
					$rego = $a_child;
				}
				if($a_child->getName() == 'odometer'){
					$data[18] = $a_child;
					$odometer = $a_child;
				}
				
				if($a_child->getName() == 'cylinders'){
					$data[19] = $a_child;
					$cylinders = $a_child;
				}
				
				if($a_child->getName() == 'capacity'){
					$data[20] = $a_child;
					$engine_capacity = $a_child;
				}
				
				if($a_child->getName() == 'vin'){
					$data[21] = $a_child;
					$vin_number = $a_child;
				}
				if($a_child->getName() == 'manumonth'){
					$data[23] = $a_child;//manu_month
					$manu_month = $a_child;
				}
				if($a_child->getName() == 'options'){
					$data[24] = str_ireplace (array('"', "'"),array(" "," "), $a_child);
					$options = $a_child;
				}
				if($a_child->getName() == 'comments'){
					$data[25] = $a_child;
					$comments = $a_child;
				}
				if($a_child->getName() == 'nvic'){
					$data[26] = $a_child;
					$nvic = $a_child; 
				}
				if($a_child->getName() == 'redbookcode'){
					$data[27] = $a_child;
					$redbookcode = $a_child;
				}
				if($a_child->getName() == 'egc'){
					$data[29] = $a_child;
					$egc = $a_child;
				}
				if($a_child->getName() == 'stock_location_code'){
					$data[30] = $a_child;
					$location = $a_child;
				}
				if($a_child->getName() == 'driveaway_amount'){
					$data[31] = $a_child;
					$drive_away_amount = $a_child;
				}
				if($a_child->getName() == 'isdriveaway'){
					$data[32] = $a_child;
					$is_drive_away = $a_child;
				}
				
				if($a_child->getName() == 'enginetype'){
					$engine_type = $a_child;
					$data[37] = $a_child;
				}
				if($a_child->getName() == 'videourl'){
					$video_url = $a_child;
					$data[41] = $a_child;
				}
				
				if($a_child->getName() == 'engineno'){
					$engineno = $a_child;
					$data[42] = $a_child;
				}
				if($a_child->getName() == 'regovalid'){
					$regovalid = $a_child;
					$data[43] = $a_child;
				}
				if($a_child->getName() == 'receiveddate'){
					$receiveddate = $a_child;
					$data[44] = $a_child;
				}
				if($a_child->getName() == 'status'){
					$status = $a_child;
					$data[45] = $a_child;
				} 
				if($a_child->getName() == 'appraisalnotes'){
					$appraisalnotes = $a_child;
					$data[46] = $a_child;
				}
				if($a_child->getName() == 'AcquisitionDate'){
					$acquisition_date = $a_child;
					$data[47] = $a_child;
				}
			}
			if(sizeof($data) > 0){
					$vin = $data[21];
					//$res = $this->User->query("SELECT * FROM $table_name WHERE vin_number='$vin'");
					$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
					$res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $vin)));
					$resUser = $this->User->find('first', array('conditions' => array('OR'=>array(array('User.dealer_solution_number' => $data[1]),array('User.carzapp_code' => $data[1])))));
					$user_id = '';
					if($resUser){
						$user_id = $resUser['User']['id'];
					}else
                                        {
                                            $user_id = 218;
                                        }
					if($res){
						//check update
						$is_updated_data = 0;						
						// existed car
						$data_set = '';
						//$result = $res[0]["$table_name"];
						$result =$res["Car"];
						$car_id = $result['id']; 
						$client_no = ($result['client_no'] == "") ? $user_id : $result['client_no'];
						
						$stock_no= ($data[0] == "") ? $result['stock_no'] : $data[0];
						
						$dealer_code= ($data[1] == "") ? $result['dealer_code'] : $data[1];
						
						$manu_year= ($data[2] == "") ? $result['manu_year'] : $data[2];
						
						$make= ($data[3] == "") ? $result['make'] : $data[3];
						if($data[3] != "" && $data[3] != $result['make']) $is_updated_data = 1;
						
						$model= ($data[4] == "") ? $result['model'] : $data[4];
						if($data[4] != "" && $data[4] != $result['model']) $is_updated_data = 1; 
						
						$series= ($data[5] == "") ? $result['series'] : $data[5];
						if($data[5] != "" && $data[5] != $result['series']) $is_updated_data = 1;
						
						$badge= ($data[6] == "") ? $result['badge'] : $data[6];
						
						$body= ($data[7] == "") ? $result['body'] : $data[7];
						if($data[7] != "" && $data[7] != $result['body']) $is_updated_data = 1;
						
						$doors= ($data[8] == "") ? $result['doors'] : $data[8];
						
						$seats= ($data[9] == "") ? $result['seats'] : $data[9];
						
						$body_colour= ($data[10] == "") ? $result['body_colour'] : $data[10];
						
						$trim_colour= ($data[11] == "") ? $result['trim_colour'] : $data[11];
						
						$gears= ($data[12] == "") ? $result['gears'] : $data[12];
						
						$gearbox= ($data[13] == "") ? $result['gearbox'] : $data[13];
						if($data[13] != "" && $data[13] != $result['gearbox']) $is_updated_data = 1;
						
						$fuel_type= ($data[14] == "") ? $result['fuel_type'] : $data[14]; 
						if($data[14] != "" && $data[14] != $result['fuel_type']) $is_updated_data = 1;
						
						//$price= ($data[15] == "") ? $result['price'] : $data[15];
						//$retail= ($data[16] == "") ? $result['retail'] : $data[16]; 
						$price= str_ireplace (array('$',','),array('',''), ($data[15] == "") ? $result['price'] : $data[15]);
						//$price= str_ireplace (array('.'),array(','), $price);	
	  
						$retail= str_ireplace (array('$',','),array('',''), ($data[16] == "") ? $result['retail'] : $data[16]);
						//$retail= str_ireplace (array('.'),array(','), $retail);					
						
						$rego= ($data[17] == "") ? $result['rego'] : $data[17];
						
						$odometer= ($data[18] == "") ? $result['odometer'] : $data[18];
						if($data[18] != "" && $data[18] != $result['odometer']) $is_updated_data = 1;
						
						$cylinders= ($data[19] == "") ? $result['cylinders'] : $data[19];
						
						$engine_capacity= ($data[20] == "") ? $result['engine_capacity'] : $data[20];
						
						$vin_number= ($data[21] == "") ? $result['vin_number'] : $data[21];
						
						$engine_number= ($data[22] == "") ? $result['engine_number'] : $data[22];
						
						$manu_month= ($data[23] == "") ? $result['manu_month'] : $data[23];
						
						$options=  str_ireplace (array('"', "'"),array(' ', ' '), ($data[24] == "") ? $result['options'] : $data[24]);
						
						$comments= ($data[25] == "") ? $result['comments'] : $data[25];
						
						$nvic= ($data[26] == "") ? $result['nvic'] : $data[26];
						
						$redbookcode= ($data[27] == "") ? $result['redbookcode'] : $data[27];
						
						$inventory= ($data[28] == "") ? $result['inventory'] : $data[28];
						
						$egc= ($data[29] == "") ? $result['egc'] : $data[29];
						
						$location= ($data[30] == "") ? $result['location'] : $data[30];
						
						$drive_away_amount= ($data[31] == "") ? $result['drive_away_amount'] : $data[31];
						
						$is_drive_away= ($data[32] == "") ? $result['is_drive_away'] : $data[32];
						
						$drive_type= ($data[33] == "") ? $result['drive_type'] : $data[33];
						
						$model_variant= ($data[34] == "") ? $result['model_variant'] : $data[34];
						$registration_number= ($data[35] == "") ? $result['registration_number'] : $data[35];
						$registration_expiry= ($data[36] == "") ? $result['registration_expiry'] : $data[36];
						$engine_type= ($data[37] == "") ? $result['engine_type'] : $data[37];
						$engine_size= ($data[38] == "") ? $result['engine_size'] : $data[38];
						$drive_train= ($data[39] == "") ? $result['drive_train'] : $data[39];
						$standard_extras= ($data[40] == "") ? $result['standard_extras'] : $data[40];
						$video_url= ($data[41] == "") ? $result['video_url'] : $data[41];
						$engineno= ($data[42] == "") ? $result['engineno'] : $data[42];
						$regovalid= ($data[43] == "") ? $result['regovalid'] : $data[43];
						//$receiveddate= ($data[44] == "") ? $result['receiveddate'] : $data[44];
						$receiveddate= ($result['receiveddate'] == "") ? $data[44] : $result['receiveddate'];
						$status= ($data[45] == "") ? $result['status'] : $data[45];
						$appraisalnotes= ($data[46] == "") ? $result['appraisalnotes'] : $data[46];
						$acquisition_date= ($data[47] == "") ? $result['acquisition_date'] : $data[47];
						
						$update_res = $this->Car->query("UPDATE $table_name SET client_no = \"$client_no\", 
						stock_no = \"$stock_no\", dealer_code = \"$dealer_code\", manu_year = \"$manu_year\", make = \"$make\", model = \"$model\", series = \"$series\", badge = \"$badge\", body = \"$body\", doors = \"$doors\", seats = \"$seats\", body_colour = \"$body_colour\", trim_colour = \"$trim_colour\", gears = \"$gears\", gearbox = \"$gearbox\", fuel_type = \"$fuel_type\", price = \"$price\", retail = \"$retail\", rego = \"$rego\", odometer = \"$odometer\", cylinders = \"$cylinders\", engine_capacity = \"$engine_capacity\", vin_number = \"$vin_number\", engine_number = \"$engine_number\", manu_month = \"$manu_month\", options = \"$options\", comments = \"$comments\", nvic = \"$nvic\", redbookcode = \"$redbookcode\", inventory = \"$inventory\", egc = \"$egc\", location = \"$location\", drive_away_amount = \"$drive_away_amount\", is_drive_away = \"$is_drive_away\", drive_type = \"$drive_type\" , model_variant = \"$model_variant\" , registration_number = \"$registration_number\" , registration_expiry = \"$registration_expiry\" , engine_type = \"$engine_type\" , engine_size = \"$engine_size\" , drive_train = \"$drive_train\" , standard_extras = \"$standard_extras\" , video_url = \"$video_url\", engineno = \"$engineno\", regovalid = \"$regovalid\", receiveddate = \"$receiveddate\", status = \"$status\", appraisalnotes = \"$appraisalnotes\", acquisition_date = \"$acquisition_date\" 
						WHERE id = $car_id
						"); 
						 						
						if($update_res){
							//Push update
							
							if($is_updated_data == 1){
								$follower = $this->FollowedCar->find('all', array('recursive' => -1, 'conditions' =>array('FollowedCar.car_id' => $car_id)));
								foreach($follower as $a_follower){
									//Save notification
									//if($a_follower['FollowedCar']['user_id'] != ""){
										$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '8', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $a_follower['FollowedCar']['user_id'])));
										if(!$check_notify){
											$update_notify['OtherNotification']['notification_id'] = 8;
											$update_notify['OtherNotification']['user_id'] = $a_follower['FollowedCar']['user_id'];
											$update_notify['OtherNotification']['car_id'] = $car_id;
											$update_notify['OtherNotification']['is_read'] = 0;
											if($this->OtherNotification->save($update_notify)){
												
											}
										}
									//}
									
									$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$a_follower['FollowedCar']['user_id'])));
									$arr_gcm_android = array();
									$arr_gcm_ios = array();
									foreach($user_receive_notifi as $a_item){
										if($a_item['PushNotificationRegistration']['os']==0){
											$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}else{
											$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}
									}
									$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_follower['FollowedCar']['user_id'], 'NotificationSetting.notification_id' => '8')));
									if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
										$data = array();
										$data['message']="The car which you followed has been updated by owner";
										$data['settings'] = $settings['NotificationSetting'];
										$data['car_id'] = $car_id; 
										
										if(sizeof($arr_gcm_android) > 0){
											$gcm = new GCM();
											$push_result = $gcm->send_notification($arr_gcm_android, $data);					
											if($push_result== false) { 
											}
										}
										if(sizeof($arr_gcm_ios) > 0){
											$HttpSocket = new HttpSocket();
											$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
										}
									}
								}
							}
							//add images
							foreach($arr_image as $a_arr_image){
								$rs = $this->Image->find('first', array('conditions' =>array('Image.car_id' =>$car_id, 'Image.image_file_name' =>$a_arr_image)));
								if(!$rs){
									$date = new DateTime();
									$current_time = $date->format('Y-m-d H:i:s') ;
									$arr_add['Image']['car_id'] = $car_id;
									$arr_add['Image']['image_file_name'] = $a_arr_image;
									//$arr_add['Image']['image_file_name_mid'] = $mid;
									//$arr_add['Image']['image_file_name_small'] = $small;
									$arr_add['Image']['folder_name'] = '';
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['is_server_sdc'] = 0;
									$this->Image->create();
									if($this->Image->save($arr_add)) {
										 
									}else{ 
										echo "Error<br/>";
									}
								}
							}
							if(sizeof($arr_image) > 0){
								$updateImage['Car']['image_count'] = sizeof($arr_image);
								$updateImage['Car']['image_url'] = $arr_image[0];
								$this->Car->id = $car_id;
								if($this->Car->save($updateImage)){
									
								}
							}
							
							//if($car_id == 7)die(); 
						}  
					}else{
						// new car
						$value = "(";
						$value .= "\"".$user_id."\",";
						$i = 0;
						foreach($data as $x){
							$value .= "\"".$data[$i]."\",";
							$i ++;
						}
						$value = substr($value, 0, -1) . ")";
						if(strlen($value) > 0){  
							//$values = substr($values, 0, -2) . ")";
							$car_ids = $this->User->query("INSERT INTO $table_name (client_no,stock_no,dealer_code,manu_year,make,model,series,badge,body,doors,seats,body_colour,trim_colour,gears,gearbox,fuel_type,price,retail,rego,odometer,cylinders,engine_capacity,vin_number,engine_number,manu_month,options,comments,nvic,redbookcode,inventory,egc,location,drive_away_amount,is_drive_away,drive_type, model_variant, registration_number, registration_expiry, engine_type, engine_size, drive_train, standard_extras, video_url, engineno, regovalid, receiveddate, status, appraisalnotes, acquisition_date)	
								VALUES ". $value);
								
							$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
							$car_id = $this->Car->find('first', array('order' => array('Car.id DESC')));
							$car_ids = $car_id['Car']['id'];
							foreach($arr_image as $a_arr_image){ 
								$rs = $this->Image->find('first', array('recursive' => -1, 'conditions' =>array('Image.car_id' =>$car_ids, 'Image.image_file_name' =>$a_arr_image)));
								if(!$rs){
									$date = new DateTime();
									$current_time = $date->format('Y-m-d H:i:s') ;
									$arr_add['Image']['car_id'] = $car_ids;
									$arr_add['Image']['image_file_name'] = $a_arr_image;
									//$arr_add['Image']['image_file_name_mid'] = $mid;
									//$arr_add['Image']['image_file_name_small'] = $small;
									$arr_add['Image']['folder_name'] = '';
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['is_server_sdc'] = 0;
									$this->Image->create();
									if($this->Image->save($arr_add)) {
										 
									}else{ 
										echo "Error<br/>"; 
									}
								}
							}
							if(sizeof($arr_image) > 0){ 
								$updateImage['Car']['image_count'] = sizeof($arr_image);
								$updateImage['Car']['image_url'] = $arr_image[0];
								$this->Car->id = $car_ids;
								if($this->Car->save($updateImage)){
									
								} 
							}
							
							//push set_and_forget
							if(strlen($data[21]) == 17){
								$arr_forget  = $this->Setandforget->find('all', array('recursive' => -1, 'conditions' =>array('Setandforget.vin_number LIKE ' => "%".substr($data[21],0,10)."%"))); 
								
								//Check push set4get 2
								$is_push = false;
								$arr_gcm_android_owner = array();
								$arr_gcm_ios_owner = array();
								if($resUser && sizeof($arr_forget) > 0){
									$settings_owner = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $resUser['User']['id'], 'NotificationSetting.notification_id' => '2')));
										if($settings_owner && ($settings_owner['NotificationSetting']['menu_indicator'] == 1 || $settings_owner['NotificationSetting']['pop_up'] == 1 || $settings_owner['NotificationSetting']['notification'] == 1)){
											$owner_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$resUser['User']['id'])));
											foreach($owner_receive_notifi as $a_item){
												if($a_item['PushNotificationRegistration']['os']==0){
													$arr_gcm_android_owner[] = $a_item['PushNotificationRegistration']['gcm_reg'];
												}else{
													$arr_gcm_ios_owner[] = $a_item['PushNotificationRegistration']['gcm_reg'];
												}
											}
											$is_push = true;
										}
								}
								foreach($arr_forget as $a_arr_forget){
									$arr_gcm_android = array();
									$arr_gcm_ios = array();
									$data = array();
									$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$a_arr_forget['Setandforget']['user_id'])));
									foreach($user_receive_notifi as $a_item){
										if($a_item['PushNotificationRegistration']['os']==0){
											$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}else{
											$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}
									}
									
									//Save data set4get 1
									$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
									$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
									$car_id = $car_query['Car']['id'];
									
									$update_set4get_1['Set4getNotification']['user_id'] = $a_arr_forget['Setandforget']['user_id'];
									$update_set4get_1['Set4getNotification']['car_id'] = $car_id;
									$update_set4get_1['Set4getNotification']['set4get_id'] = $a_arr_forget['Setandforget']['id'];
									$update_set4get_1['Set4getNotification']['type'] = 1;
									$this->Set4getNotification->create();
									if($this->Set4getNotification->save($update_set4get_1)){
										
									}
									$data['message'] = "CarZapp has found a car which match with your SetnForget!";
									$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_arr_forget['Setandforget']['user_id'], 'NotificationSetting.notification_id' => '1')));
										if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
											$data['settings'] = $settings['NotificationSetting'];
											if(sizeof($arr_gcm_android) > 0){
												$gcm = new GCM();
												$push_result = $gcm->send_notification($arr_gcm_android, $data);					
												if($push_result== false) { 
												}
											}
											if(sizeof($arr_gcm_ios) > 0){
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
											}
									}
									
									//Push set4get 2  
									//$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $resUser['User']['id'], 'Network.user_id' => $a_arr_forget['Setandforget']['user_id']), array('Network.member_id' => $a_arr_forget['Setandforget']['user_id'], 'Network.user_id' => $resUser['User']['id'])))));
									if($is_push){
										$user_set4get = $this->User->find('first', array('recursive' => -1, 'conditions'=> array('User.id' => $a_arr_forget['Setandforget']['user_id'])));
										$data_owner = array();
										$data_owner['settings'] = $settings_owner['NotificationSetting'];
										$data_owner['message'] = $user_set4get['User']['name']." has found 1 set4get record which matches your car";
										if(sizeof($arr_gcm_android_owner) > 0){
												$gcm = new GCM(); 
												$push_result = $gcm->send_notification($arr_gcm_android_owner, $data_owner);					
												if($push_result== false) { 
												}
											}
											if(sizeof($arr_gcm_ios_owner) > 0){
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data_owner, 'msg_string' => $data_owner['message'], 'dt' => $arr_gcm_ios_owner));
										}
										//Save data set4get 2
										
										$update_set4get_2['Set4getNotification']['user_id'] = $resUser['User']['id'];
										$update_set4get_2['Set4getNotification']['car_id'] = $car_id;
										$update_set4get_2['Set4getNotification']['set4get_id'] = $a_arr_forget['Setandforget']['id'];
										$update_set4get_2['Set4getNotification']['type'] = 2;
										$this->Set4getNotification->create();
										if($this->Set4getNotification->save($update_set4get_2)){ 
										
										}
									}
								}
								
							}
							
							//Push Add New Car
							if($resUser){
								$result_gcm = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $resUser['User']['id'])));
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
									
									//Save notification
									if($user_id != ''){
										$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
										$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
										$car_id = $car_query['Car']['id'];
										$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '5', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $user_id)));
										if(!$check_notify){
											$update_notify['OtherNotification']['notification_id'] = 5;
											$update_notify['OtherNotification']['user_id'] = $user_id;
											$update_notify['OtherNotification']['car_id'] = $car_id;
											$update_notify['OtherNotification']['is_read'] = 0;
											if($this->OtherNotification->save($update_notify)){ 
												
											}
										}
									}
									$data['message']= "New car is added to your stock";
									$data['car_id'] = $car_id;
										$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $resUser['User']['id'], 'NotificationSetting.notification_id' => '5')));
										if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
											$data['settings'] = $settings['NotificationSetting'];
											if(sizeof($arr_gcm_android) > 0){
												$gcm = new GCM();
												$push_result = $gcm->send_notification($arr_gcm_android, $data);					
												if($push_result== false) { 
												}
											}
											if(sizeof($arr_gcm_ios) > 0){
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
											}
										}
								}
								
								//Push my network
								$arr_network = $this->User->find('all', array(
							   'fields' => array('User.*'),
							   'joins' => array(array('table' => 'networks',
													   'alias' => 'Network',
													   'type' => 'INNER',
													   'conditions' => array('Network.member_id'=>$resUser['User']['id'], 'User.id = Network.user_id')
												 ))
								)
								  );
								$arr_network_right = $this->User->find('all', array(
										   'fields' => array('User.*'),
										   'joins' => array(array('table' => 'networks',
																   'alias' => 'Network',
																   'type' => 'INNER',
																   'conditions' => array('Network.user_id'=>$resUser['User']['id'], 'User.id = Network.member_id')))			 
											)
									  );
								foreach($arr_network_right as $a_arr_network_right){
								$arr_network[] = $a_arr_network_right;
								}
								$arr_result = array();
								foreach($arr_network as $a_arr_network){
									$request = $this->Block->find('first', array('recursive' => -1, 'conditions' => array('Block.user_id' =>$resUser['User']['id'],'Block.blocker_id' =>$a_arr_network['User']['id'])));
									if(!$request){
										//Not Block
										$result_gcm_network = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $a_arr_network['User']['id'])));
										$data = array();
										if($result_gcm_network){
											$arr_gcm_android = array();
											$arr_gcm_ios = array();
											foreach($result_gcm_network as $a_result_gcm){
												if($a_result_gcm['PushNotificationRegistration']['os']==0){
													$arr_gcm_android[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
												}else{
													$arr_gcm_ios[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
												}
											}
											
											//Save notification
											if($user_id != ''){
												$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
												$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
												$car_id = $car_query['Car']['id'];
												$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '6', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $a_arr_network['User']['id'])));
												if(!$check_notify){
													$update_notify['OtherNotification']['notification_id'] = 6;
													$update_notify['OtherNotification']['user_id'] = $a_arr_network['User']['id'];
													$update_notify['OtherNotification']['car_id'] = $car_id;
													$update_notify['OtherNotification']['sender_id'] = $user_id;
													$update_notify['OtherNotification']['is_read'] = 0;
													if($this->OtherNotification->save($update_notify)){ 
														
													}
												}
											}
											$data['message']= "New car is added to Your Networks stock";
											$data['car_id'] = $car_id;
												$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_arr_network['User']['id'], 'NotificationSetting.notification_id' => '6')));
												if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
													
													$data['settings'] = $settings['NotificationSetting'];
													if(sizeof($arr_gcm_android) > 0){
														$gcm = new GCM(); 
														$push_result = $gcm->send_notification($arr_gcm_android, $data);					
														if($push_result== false) { 
														}
													}
													if(sizeof($arr_gcm_ios) > 0){
														$HttpSocket = new HttpSocket();
														$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
													}
												}
										}
									}
								} 
								
							}
							
						} 
					}
						//$values .= $value .",";
				}
			}
		}
	}
        
	public function readXMLDealerSolution(){
		$this->autoRender = false;
		$this->loadModel("User");
		$this->loadModel("Car");
		$this->loadModel("Image");
		$this->loadModel("Setandforget");
		$this->loadModel('PushNotificationRegistration');
		$this->loadModel('NotificationSetting'); 
		$this->loadModel('Network'); 
		$this->loadModel('Block');
		$this->loadModel('FollowedCar');
		$this->loadModel('Set4getNotification');
		$this->loadModel('OtherNotification');
		
		$table_name = "cars";
		
		$dir = WWW_ROOT."datafeed/dealersolutions/";
		$dh  = opendir($dir);
		$dealer_solution_number = '';
		while (false !== ($filename = readdir($dh))) {
			//$dealer_solution_number = str_ireplace (array('.','xml'),array('',''), $filename); 
		if(strpos(strtolower($filename),'.xml')) {
		
		$xml = simplexml_load_file($dir . $filename);
		$values = ""; 
		$arr_image = array();
		$data = array();
		foreach ($xml->children() as $child) {
			foreach ($child->children() as $a_child) { 
				if($a_child->getName() == 'Images'){
					foreach ($a_child->children() as $a_child_image) {
						$arr_image[] = $a_child_image->attributes()[0];
					}				
				}
				if($a_child->getName() == 'stockno'){
					$data = array();
					$arr_image = array();
					$data[0] = $a_child;
					//$data[6] = '';//badge
					//$data[9] = '';//Seats
					$data[1] = '';
					$data[2] = '';
					$data[3] = '';
					$data[4] = '';
					$data[5] = '';
					$data[6] = '';
					$data[7] = '';
					$data[8] = '';
					$data[9] = '';
					$data[10] = '';
					$data[11] = '';
					$data[12] = '';
					$data[13] = '';
					$data[14] = '';
					$data[15] = '';
					$data[16] = '';
					$data[18] = '';
					$data[19] = '';
					$data[20] = '';
					$data[21] = '';
					$data[23] = '';
					$data[24] = '';
					$data[25] = '';
					$data[26] = '';
					$data[27] = '';
					$data[29] = '';
					$data[30] = '';
					$data[31] = '';
					$data[32] = '';
					$data[37] = '';
					$data[17] = '';//rego
					$data[22] = '';//engine_number
					$data[28] = '';//inventory
					$data[33] = '';//drive_type
					$data[34] = '';//ModelVariant
					$data[35] = '';//RegistrationNumber
					$data[36] = '';//RegistrationExpiry
					$data[38] = '';//EngineSize
					$data[39] = '';//DriveTrain
					$data[40] = '';//StandardExtras
					$data[46] = '';//appraisalnotes 
					$data[47] = '';//acquisition_date
					$data[21] = '';//vin number
					
					$make = ''; $model = ''; $series = ''; $stock_no = $a_child; $manu_year = '';
					$badge = ''; $body = ''; $doors = ''; $seats = ''; $body_colour  = ''; $trim_colour = '';
					$gears = ''; $gearbox = ''; $fuel_type = ''; $price = ''; $retail = ''; $rego = ''; $odometer = '';
					$cylinders = ''; $engine_capacity = ''; $vin_number = '';$engine_number = ''; $options = '';$nvic = '';
					$redbookcode = ''; $inventory = ''; $egc = ''; $location = ''; $drive_away_amount = '';
					$is_drive_away = ''; $drive_type = ''; $manu_month = ''; $comments = '';
					$model_variant = ''; $registration_number = ''; $registration_expiry = ''; $engine_type = '';$engine_size = ''; $drive_train = '';$standard_extras = ''; $video_url = ''; $engineno = ''; $regovalid = ''; $receiveddate = ''; $status = '';
					$appraisalnotes = ''; $acquisition_date = '';
				}
				if($a_child->getName() == 'dealerId'){
					$data[1] = $a_child;
					$dealer_solution_number = $a_child;
				}
				if($a_child->getName() == 'manuyear'){
					$data[2] = $a_child;
					$manu_year = $a_child;
				}
				if($a_child->getName() == 'make'){
					$data[3] = $a_child;
					$make = $a_child;
				}
				if($a_child->getName() == 'model'){
					$data[4] = $a_child;
					$model = $a_child;
				}
				if($a_child->getName() == 'series'){
					$data[5] = $a_child;
					$series = $a_child;
				}
				if($a_child->getName() == 'badge'){
					$data[6] = $a_child;
					$badge = $a_child;
				}
				if($a_child->getName() == 'body'){
					$data[7] = $a_child;
					$body = $a_child;
				}
				if($a_child->getName() == 'doors'){
					$data[8] = $a_child;
					$doors = $a_child;
				}
				if($a_child->getName() == 'seats'){
					$data[9] = $a_child;
					$seats = $a_child;
				}
				if($a_child->getName() == 'colour'){
					$data[10] = $a_child;
					$body_colour = $a_child;
				}
				if($a_child->getName() == 'interior_colour'){//Trim
					$data[11] = $a_child;
					$trim_colour = $a_child;
				}
				if($a_child->getName() == 'gears'){
					$data[12] = $a_child;
					$gears = $a_child;
				}
				if($a_child->getName() == 'transmission'){
					$data[13] = $a_child;
					$gearbox = $a_child;
				}
				if($a_child->getName() == 'fueltype'){
					$data[14] = $a_child;
					$fuel_type = $a_child;
				}
				if($a_child->getName() == 'wholesale'){
					$data[15] = $a_child;//price
					$price = $a_child;
				}
				
				if($a_child->getName() == 'price'){
					$data[16] = $a_child;//retail
					$retail = $a_child;
				}
				if($a_child->getName() == 'rego'){
					$data[17] = $a_child;//rego
					$rego = $a_child;
				}
				if($a_child->getName() == 'odometer'){
					$data[18] = $a_child;
					$odometer = $a_child;
				}
				
				if($a_child->getName() == 'cylinders'){
					$data[19] = $a_child;
					$cylinders = $a_child;
				}
				
				if($a_child->getName() == 'capacity'){
					$data[20] = $a_child;
					$engine_capacity = $a_child;
				}
				
				if($a_child->getName() == 'vin'){
					$data[21] = $a_child;
					$vin_number = $a_child;
				}
				if($a_child->getName() == 'manumonth'){
					$data[23] = $a_child;//manu_month
					$manu_month = $a_child;
				}
				if($a_child->getName() == 'options'){
					$data[24] = str_ireplace (array('"', "'"),array(" "," "), $a_child);
					$options = $a_child;
				}
				if($a_child->getName() == 'comments'){
					$data[25] = $a_child;
					$comments = $a_child;
				}
				if($a_child->getName() == 'nvic'){
					$data[26] = $a_child;
					$nvic = $a_child; 
				}
				if($a_child->getName() == 'redbookcode'){
					$data[27] = $a_child;
					$redbookcode = $a_child;
				}
				if($a_child->getName() == 'egc'){
					$data[29] = $a_child;
					$egc = $a_child;
				}
				if($a_child->getName() == 'stock_location_code'){
					$data[30] = $a_child;
					$location = $a_child;
				}
				if($a_child->getName() == 'driveaway_amount'){
					$data[31] = $a_child;
					$drive_away_amount = $a_child;
				}
				if($a_child->getName() == 'isdriveaway'){
					$data[32] = $a_child;
					$is_drive_away = $a_child;
				}
				
				if($a_child->getName() == 'enginetype'){
					$engine_type = $a_child;
					$data[37] = $a_child;
				}
				if($a_child->getName() == 'videourl'){
					$video_url = $a_child;
					$data[41] = $a_child;
				}
				
				if($a_child->getName() == 'engineno'){
					$engineno = $a_child;
					$data[42] = $a_child;
				}
				if($a_child->getName() == 'regovalid'){
					$regovalid = $a_child;
					$data[43] = $a_child;
				}
				if($a_child->getName() == 'receiveddate'){
					$receiveddate = $a_child;
					$data[44] = $a_child;
				}
				if($a_child->getName() == 'status'){
					$status = $a_child;
					$data[45] = $a_child;
				} 
				if($a_child->getName() == 'appraisalnotes'){
					$appraisalnotes = $a_child;
					$data[46] = $a_child;
				}
				if($a_child->getName() == 'AcquisitionDate'){
					$acquisition_date = $a_child;
					$data[47] = $a_child;
				}
			}
			if(sizeof($data) > 0){
					$vin = $data[21];
					//$res = $this->User->query("SELECT * FROM $table_name WHERE vin_number='$vin'");
					$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
					$res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $vin)));
					$resUser = $this->User->find('first', array('conditions' => array('User.dealer_solution_number' => $data[1])));
					$user_id = '';
					if($resUser){
						$user_id = $resUser['User']['id'];
					}
					if($res){
						//check update
						$is_updated_data = 0;						
						// existed car
						$data_set = '';
						//$result = $res[0]["$table_name"];
						$result =$res["Car"];
						$car_id = $result['id']; 
						$client_no = ($result['client_no'] == "") ? $user_id : $result['client_no'];
						
						$stock_no= ($data[0] == "") ? $result['stock_no'] : $data[0];
						
						$dealer_code= ($data[1] == "") ? $result['dealer_code'] : $data[1];
						
						$manu_year= ($data[2] == "") ? $result['manu_year'] : $data[2];
						
						$make= ($data[3] == "") ? $result['make'] : $data[3];
						if($data[3] != "" && $data[3] != $result['make']) $is_updated_data = 1;
						
						$model= ($data[4] == "") ? $result['model'] : $data[4];
						if($data[4] != "" && $data[4] != $result['model']) $is_updated_data = 1; 
						
						$series= ($data[5] == "") ? $result['series'] : $data[5];
						if($data[5] != "" && $data[5] != $result['series']) $is_updated_data = 1;
						
						$badge= ($data[6] == "") ? $result['badge'] : $data[6];
						
						$body= ($data[7] == "") ? $result['body'] : $data[7];
						if($data[7] != "" && $data[7] != $result['body']) $is_updated_data = 1;
						
						$doors= ($data[8] == "") ? $result['doors'] : $data[8];
						
						$seats= ($data[9] == "") ? $result['seats'] : $data[9];
						
						$body_colour= ($data[10] == "") ? $result['body_colour'] : $data[10];
						
						$trim_colour= ($data[11] == "") ? $result['trim_colour'] : $data[11];
						
						$gears= ($data[12] == "") ? $result['gears'] : $data[12];
						
						$gearbox= ($data[13] == "") ? $result['gearbox'] : $data[13];
						if($data[13] != "" && $data[13] != $result['gearbox']) $is_updated_data = 1;
						
						$fuel_type= ($data[14] == "") ? $result['fuel_type'] : $data[14]; 
						if($data[14] != "" && $data[14] != $result['fuel_type']) $is_updated_data = 1;
						
						//$price= ($data[15] == "") ? $result['price'] : $data[15];
						//$retail= ($data[16] == "") ? $result['retail'] : $data[16]; 
						$price= str_ireplace (array('$',','),array('',''), ($data[15] == "") ? $result['price'] : $data[15]);
						//$price= str_ireplace (array('.'),array(','), $price);	
	  
						$retail= str_ireplace (array('$',','),array('',''), ($data[16] == "") ? $result['retail'] : $data[16]);
						//$retail= str_ireplace (array('.'),array(','), $retail);					
						
						$rego= ($data[17] == "") ? $result['rego'] : $data[17];
						
						$odometer= ($data[18] == "") ? $result['odometer'] : $data[18];
						if($data[18] != "" && $data[18] != $result['odometer']) $is_updated_data = 1;
						
						$cylinders= ($data[19] == "") ? $result['cylinders'] : $data[19];
						
						$engine_capacity= ($data[20] == "") ? $result['engine_capacity'] : $data[20];
						
						$vin_number= ($data[21] == "") ? $result['vin_number'] : $data[21];
						
						$engine_number= ($data[22] == "") ? $result['engine_number'] : $data[22];
						
						$manu_month= ($data[23] == "") ? $result['manu_month'] : $data[23];
						
						$options=  str_ireplace (array('"', "'"),array(' ', ' '), ($data[24] == "") ? $result['options'] : $data[24]);
						
						$comments= ($data[25] == "") ? $result['comments'] : $data[25];
						
						$nvic= ($data[26] == "") ? $result['nvic'] : $data[26];
						
						$redbookcode= ($data[27] == "") ? $result['redbookcode'] : $data[27];
						
						$inventory= ($data[28] == "") ? $result['inventory'] : $data[28];
						
						$egc= ($data[29] == "") ? $result['egc'] : $data[29];
						
						$location= ($data[30] == "") ? $result['location'] : $data[30];
						
						$drive_away_amount= ($data[31] == "") ? $result['drive_away_amount'] : $data[31];
						
						$is_drive_away= ($data[32] == "") ? $result['is_drive_away'] : $data[32];
						
						$drive_type= ($data[33] == "") ? $result['drive_type'] : $data[33];
						
						$model_variant= ($data[34] == "") ? $result['model_variant'] : $data[34];
						$registration_number= ($data[35] == "") ? $result['registration_number'] : $data[35];
						$registration_expiry= ($data[36] == "") ? $result['registration_expiry'] : $data[36];
						$engine_type= ($data[37] == "") ? $result['engine_type'] : $data[37];
						$engine_size= ($data[38] == "") ? $result['engine_size'] : $data[38];
						$drive_train= ($data[39] == "") ? $result['drive_train'] : $data[39];
						$standard_extras= ($data[40] == "") ? $result['standard_extras'] : $data[40];
						$video_url= ($data[41] == "") ? $result['video_url'] : $data[41];
						$engineno= ($data[42] == "") ? $result['engineno'] : $data[42];
						$regovalid= ($data[43] == "") ? $result['regovalid'] : $data[43];
						//$receiveddate= ($data[44] == "") ? $result['receiveddate'] : $data[44];
						$receiveddate= ($result['receiveddate'] == "") ? $data[44] : $result['receiveddate'];
						$status= ($data[45] == "") ? $result['status'] : $data[45];
						$appraisalnotes= ($data[46] == "") ? $result['appraisalnotes'] : $data[46];
						$acquisition_date= ($data[47] == "") ? $result['acquisition_date'] : $data[47];
						
						$update_res = $this->Car->query("UPDATE $table_name SET client_no = \"$client_no\", 
						stock_no = \"$stock_no\", dealer_code = \"$dealer_code\", manu_year = \"$manu_year\", make = \"$make\", model = \"$model\", series = \"$series\", badge = \"$badge\", body = \"$body\", doors = \"$doors\", seats = \"$seats\", body_colour = \"$body_colour\", trim_colour = \"$trim_colour\", gears = \"$gears\", gearbox = \"$gearbox\", fuel_type = \"$fuel_type\", price = \"$price\", retail = \"$retail\", rego = \"$rego\", odometer = \"$odometer\", cylinders = \"$cylinders\", engine_capacity = \"$engine_capacity\", vin_number = \"$vin_number\", engine_number = \"$engine_number\", manu_month = \"$manu_month\", options = \"$options\", comments = \"$comments\", nvic = \"$nvic\", redbookcode = \"$redbookcode\", inventory = \"$inventory\", egc = \"$egc\", location = \"$location\", drive_away_amount = \"$drive_away_amount\", is_drive_away = \"$is_drive_away\", drive_type = \"$drive_type\" , model_variant = \"$model_variant\" , registration_number = \"$registration_number\" , registration_expiry = \"$registration_expiry\" , engine_type = \"$engine_type\" , engine_size = \"$engine_size\" , drive_train = \"$drive_train\" , standard_extras = \"$standard_extras\" , video_url = \"$video_url\", engineno = \"$engineno\", regovalid = \"$regovalid\", receiveddate = \"$receiveddate\", status = \"$status\", appraisalnotes = \"$appraisalnotes\", acquisition_date = \"$acquisition_date\" 
						WHERE id = $car_id
						"); 
						 						
						if($update_res){
							//Push update
							
							if($is_updated_data == 1){
								$follower = $this->FollowedCar->find('all', array('recursive' => -1, 'conditions' =>array('FollowedCar.car_id' => $car_id)));
								foreach($follower as $a_follower){
									//Save notification
									//if($a_follower['FollowedCar']['user_id'] != ""){
										$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '8', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $a_follower['FollowedCar']['user_id'])));
										if(!$check_notify){
											$update_notify['OtherNotification']['notification_id'] = 8;
											$update_notify['OtherNotification']['user_id'] = $a_follower['FollowedCar']['user_id'];
											$update_notify['OtherNotification']['car_id'] = $car_id;
											$update_notify['OtherNotification']['is_read'] = 0;
											if($this->OtherNotification->save($update_notify)){
												
											}
										}
									//}
									
									$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$a_follower['FollowedCar']['user_id'])));
									$arr_gcm_android = array();
									$arr_gcm_ios = array();
									foreach($user_receive_notifi as $a_item){
										if($a_item['PushNotificationRegistration']['os']==0){
											$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}else{
											$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}
									}
									$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_follower['FollowedCar']['user_id'], 'NotificationSetting.notification_id' => '8')));
									if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
										$data = array();
										$data['message']="The car which you followed has been updated by owner";
										$data['settings'] = $settings['NotificationSetting'];
										$data['car_id'] = $car_id; 
										
										if(sizeof($arr_gcm_android) > 0){
											$gcm = new GCM();
											$push_result = $gcm->send_notification($arr_gcm_android, $data);					
											if($push_result== false) { 
											}
										}
										if(sizeof($arr_gcm_ios) > 0){
											$HttpSocket = new HttpSocket();
											$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
										}
									}
								}
							}
							//add images
							foreach($arr_image as $a_arr_image){
								$rs = $this->Image->find('first', array('conditions' =>array('Image.car_id' =>$car_id, 'Image.image_file_name' =>$a_arr_image)));
								if(!$rs){
									$date = new DateTime();
									$current_time = $date->format('Y-m-d H:i:s') ;
									$arr_add['Image']['car_id'] = $car_id;
									$arr_add['Image']['image_file_name'] = $a_arr_image;
									//$arr_add['Image']['image_file_name_mid'] = $mid;
									//$arr_add['Image']['image_file_name_small'] = $small;
									$arr_add['Image']['folder_name'] = '';
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['is_server_sdc'] = 0;
									$this->Image->create();
									if($this->Image->save($arr_add)) {
										 
									}else{ 
										echo "Error<br/>";
									}
								}
							}
							if(sizeof($arr_image) > 0){
								$updateImage['Car']['image_count'] = sizeof($arr_image);
								$updateImage['Car']['image_url'] = $arr_image[0];
								$this->Car->id = $car_id;
								if($this->Car->save($updateImage)){
									
								}
							}
							
							//if($car_id == 7)die(); 
						}  
					}else{
						// new car
						$value = "(";
						$value .= "\"".$user_id."\",";
						$i = 0;
						foreach($data as $x){
							$value .= "\"".$data[$i]."\",";
							$i ++;
						}
						$value = substr($value, 0, -1) . ")";
						if(strlen($value) > 0){  
							//$values = substr($values, 0, -2) . ")";
							$car_ids = $this->User->query("INSERT INTO $table_name (client_no,stock_no,dealer_code,manu_year,make,model,series,badge,body,doors,seats,body_colour,trim_colour,gears,gearbox,fuel_type,price,retail,rego,odometer,cylinders,engine_capacity,vin_number,engine_number,manu_month,options,comments,nvic,redbookcode,inventory,egc,location,drive_away_amount,is_drive_away,drive_type, model_variant, registration_number, registration_expiry, engine_type, engine_size, drive_train, standard_extras, video_url, engineno, regovalid, receiveddate, status, appraisalnotes, acquisition_date)	
								VALUES ". $value);
								
							$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
							$car_id = $this->Car->find('first', array('order' => array('Car.id DESC')));
							$car_ids = $car_id['Car']['id'];
							foreach($arr_image as $a_arr_image){ 
								$rs = $this->Image->find('first', array('recursive' => -1, 'conditions' =>array('Image.car_id' =>$car_ids, 'Image.image_file_name' =>$a_arr_image)));
								if(!$rs){
									$date = new DateTime();
									$current_time = $date->format('Y-m-d H:i:s') ;
									$arr_add['Image']['car_id'] = $car_ids;
									$arr_add['Image']['image_file_name'] = $a_arr_image;
									//$arr_add['Image']['image_file_name_mid'] = $mid;
									//$arr_add['Image']['image_file_name_small'] = $small;
									$arr_add['Image']['folder_name'] = '';
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['is_server_sdc'] = 0;
									$this->Image->create();
									if($this->Image->save($arr_add)) {
										 
									}else{ 
										echo "Error<br/>"; 
									}
								}
							}
							if(sizeof($arr_image) > 0){ 
								$updateImage['Car']['image_count'] = sizeof($arr_image);
								$updateImage['Car']['image_url'] = $arr_image[0];
								$this->Car->id = $car_ids;
								if($this->Car->save($updateImage)){
									
								} 
							}
							
							//push set_and_forget
							if(strlen($data[21]) == 17){
								$arr_forget  = $this->Setandforget->find('all', array('recursive' => -1, 'conditions' =>array('Setandforget.vin_number LIKE ' => "%".substr($data[21],0,10)."%"))); 
								
								//Check push set4get 2
								$is_push = false;
								$arr_gcm_android_owner = array();
								$arr_gcm_ios_owner = array();
								if($resUser && sizeof($arr_forget) > 0){
									$settings_owner = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $resUser['User']['id'], 'NotificationSetting.notification_id' => '2')));
										if($settings_owner && ($settings_owner['NotificationSetting']['menu_indicator'] == 1 || $settings_owner['NotificationSetting']['pop_up'] == 1 || $settings_owner['NotificationSetting']['notification'] == 1)){
											$owner_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$resUser['User']['id'])));
											foreach($owner_receive_notifi as $a_item){
												if($a_item['PushNotificationRegistration']['os']==0){
													$arr_gcm_android_owner[] = $a_item['PushNotificationRegistration']['gcm_reg'];
												}else{
													$arr_gcm_ios_owner[] = $a_item['PushNotificationRegistration']['gcm_reg'];
												}
											}
											$is_push = true;
										}
								}
								foreach($arr_forget as $a_arr_forget){
									$arr_gcm_android = array();
									$arr_gcm_ios = array();
									$data = array();
									$user_receive_notifi = $this->PushNotificationRegistration->find('all', array('recursive' => -1, 'conditions'=>array('PushNotificationRegistration.user_id'=>$a_arr_forget['Setandforget']['user_id'])));
									foreach($user_receive_notifi as $a_item){
										if($a_item['PushNotificationRegistration']['os']==0){
											$arr_gcm_android[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}else{
											$arr_gcm_ios[] = $a_item['PushNotificationRegistration']['gcm_reg'];
										}
									}
									
									//Save data set4get 1
									$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
									$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
									$car_id = $car_query['Car']['id'];
									
									$update_set4get_1['Set4getNotification']['user_id'] = $a_arr_forget['Setandforget']['user_id'];
									$update_set4get_1['Set4getNotification']['car_id'] = $car_id;
									$update_set4get_1['Set4getNotification']['set4get_id'] = $a_arr_forget['Setandforget']['id'];
									$update_set4get_1['Set4getNotification']['type'] = 1;
									$this->Set4getNotification->create();
									if($this->Set4getNotification->save($update_set4get_1)){
										
									}
									$data['message'] = "CarZapp has found a car which match with your SetnForget!";
									$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_arr_forget['Setandforget']['user_id'], 'NotificationSetting.notification_id' => '1')));
										if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
											$data['settings'] = $settings['NotificationSetting'];
											if(sizeof($arr_gcm_android) > 0){
												$gcm = new GCM();
												$push_result = $gcm->send_notification($arr_gcm_android, $data);					
												if($push_result== false) { 
												}
											}
											if(sizeof($arr_gcm_ios) > 0){
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
											}
									}
									
									//Push set4get 2  
									//$my_network = $this->Network->find('first',array('recursive' => -1, 'conditions'=> array('OR' =>array(array('Network.member_id' => $resUser['User']['id'], 'Network.user_id' => $a_arr_forget['Setandforget']['user_id']), array('Network.member_id' => $a_arr_forget['Setandforget']['user_id'], 'Network.user_id' => $resUser['User']['id'])))));
									if($is_push){
										$user_set4get = $this->User->find('first', array('recursive' => -1, 'conditions'=> array('User.id' => $a_arr_forget['Setandforget']['user_id'])));
										$data_owner = array();
										$data_owner['settings'] = $settings_owner['NotificationSetting'];
										$data_owner['message'] = $user_set4get['User']['name']." has found 1 set4get record which matches your car";
										if(sizeof($arr_gcm_android_owner) > 0){
												$gcm = new GCM(); 
												$push_result = $gcm->send_notification($arr_gcm_android_owner, $data_owner);					
												if($push_result== false) { 
												}
											}
											if(sizeof($arr_gcm_ios_owner) > 0){
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data_owner, 'msg_string' => $data_owner['message'], 'dt' => $arr_gcm_ios_owner));
										}
										//Save data set4get 2
										
										$update_set4get_2['Set4getNotification']['user_id'] = $resUser['User']['id'];
										$update_set4get_2['Set4getNotification']['car_id'] = $car_id;
										$update_set4get_2['Set4getNotification']['set4get_id'] = $a_arr_forget['Setandforget']['id'];
										$update_set4get_2['Set4getNotification']['type'] = 2;
										$this->Set4getNotification->create();
										if($this->Set4getNotification->save($update_set4get_2)){ 
										
										}
									}
								}
								
							}
							
							//Push Add New Car
							if($resUser){
								$result_gcm = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $resUser['User']['id'])));
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
									
									//Save notification
									if($user_id != ''){
										$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
										$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
										$car_id = $car_query['Car']['id'];
										$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '5', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $user_id)));
										if(!$check_notify){
											$update_notify['OtherNotification']['notification_id'] = 5;
											$update_notify['OtherNotification']['user_id'] = $user_id;
											$update_notify['OtherNotification']['car_id'] = $car_id;
											$update_notify['OtherNotification']['is_read'] = 0;
											if($this->OtherNotification->save($update_notify)){ 
												
											}
										}
									}
									$data['message']= "New car is added to your stock";
									$data['car_id'] = $car_id;
										$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $resUser['User']['id'], 'NotificationSetting.notification_id' => '5')));
										if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
											$data['settings'] = $settings['NotificationSetting'];
											if(sizeof($arr_gcm_android) > 0){
												$gcm = new GCM();
												$push_result = $gcm->send_notification($arr_gcm_android, $data);					
												if($push_result== false) { 
												}
											}
											if(sizeof($arr_gcm_ios) > 0){
												$HttpSocket = new HttpSocket();
												$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
											}
										}
								}
								
								//Push my network
								$arr_network = $this->User->find('all', array(
							   'fields' => array('User.*'),
							   'joins' => array(array('table' => 'networks',
													   'alias' => 'Network',
													   'type' => 'INNER',
													   'conditions' => array('Network.member_id'=>$resUser['User']['id'], 'User.id = Network.user_id')
												 ))
								)
								  );
								$arr_network_right = $this->User->find('all', array(
										   'fields' => array('User.*'),
										   'joins' => array(array('table' => 'networks',
																   'alias' => 'Network',
																   'type' => 'INNER',
																   'conditions' => array('Network.user_id'=>$resUser['User']['id'], 'User.id = Network.member_id')))			 
											)
									  );
								foreach($arr_network_right as $a_arr_network_right){
								$arr_network[] = $a_arr_network_right;
								}
								$arr_result = array();
								foreach($arr_network as $a_arr_network){
									$request = $this->Block->find('first', array('recursive' => -1, 'conditions' => array('Block.user_id' =>$resUser['User']['id'],'Block.blocker_id' =>$a_arr_network['User']['id'])));
									if(!$request){
										//Not Block
										$result_gcm_network = $this->PushNotificationRegistration->find('all',array('recursive' => -1, 'conditions'=> array('PushNotificationRegistration.user_id' => $a_arr_network['User']['id'])));
										$data = array();
										if($result_gcm_network){
											$arr_gcm_android = array();
											$arr_gcm_ios = array();
											foreach($result_gcm_network as $a_result_gcm){
												if($a_result_gcm['PushNotificationRegistration']['os']==0){
													$arr_gcm_android[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
												}else{
													$arr_gcm_ios[] = $a_result_gcm['PushNotificationRegistration']['gcm_reg'];
												}
											}
											
											//Save notification
											if($user_id != ''){
												$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
												$car_query = $this->Car->find('first', array('order' => array('Car.id DESC')));
												$car_id = $car_query['Car']['id'];
												$check_notify = $this->OtherNotification->find('first',array('recursive' => -1,'conditions'=> array('OtherNotification.notification_id' => '6', 'OtherNotification.is_read' => '0', 'OtherNotification.car_id' =>$car_id, 'OtherNotification.user_id' => $a_arr_network['User']['id'])));
												if(!$check_notify){
													$update_notify['OtherNotification']['notification_id'] = 6;
													$update_notify['OtherNotification']['user_id'] = $a_arr_network['User']['id'];
													$update_notify['OtherNotification']['car_id'] = $car_id;
													$update_notify['OtherNotification']['sender_id'] = $user_id;
													$update_notify['OtherNotification']['is_read'] = 0;
													if($this->OtherNotification->save($update_notify)){ 
														
													}
												}
											}
											$data['message']= "New car is added to Your Networks stock";
											$data['car_id'] = $car_id;
												$settings = $this->NotificationSetting->find('first', array('conditions' => array('NotificationSetting.user_id' => $a_arr_network['User']['id'], 'NotificationSetting.notification_id' => '6')));
												if($settings && ($settings['NotificationSetting']['menu_indicator'] == 1 || $settings['NotificationSetting']['pop_up'] == 1 || $settings['NotificationSetting']['notification'] == 1)){
													
													$data['settings'] = $settings['NotificationSetting'];
													if(sizeof($arr_gcm_android) > 0){
														$gcm = new GCM(); 
														$push_result = $gcm->send_notification($arr_gcm_android, $data);					
														if($push_result== false) { 
														}
													}
													if(sizeof($arr_gcm_ios) > 0){
														$HttpSocket = new HttpSocket();
														$results = $HttpSocket->post('http://198.38.92.58/pushios/index.php', array('msg' => $data, 'msg_string' => $data['message'], 'dt' => $arr_gcm_ios));
													}
												}
										}
									}
								} 
								
							}
							
						} 
					}
						//$values .= $value .",";
				}
			}
		}
	}
	}
	public function updateImageCSVCarNet()
        {
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('User');
            $this->loadModel('Image');
            $this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
                
            $dir = WWW_ROOT."datafeed/carnetauctions/";
            $dh  = opendir($dir);
            $dealer_solution_number = '';
            $index = 1;
            $filename = 'CarNetSmithfield.csv';
            $results = array();
            $results = $this->parse_csv_file($dir . $filename);
//		while (false !== ($filename = readdir($dh))) {
//                    $results = $this->parse_csv_file($dir . $filename);
//                }
            foreach ($results as $car_item) {
                //print_r($car_item);
                $res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $car_item[21])));
                //print_r($res);
                if ($res) {
                    $images = $this->Image->find('all', array('recursive' => -1, 'conditions' => array('Image.car_id' => $res['Car']['id'])));
                    //print_r($image);
                    $countImage = count($images);
                    if ( $countImage > 0) {
                        $update = $this->User->query('UPDATE cars SET image_url = "'. $images[0]['Image']['image_file_name'] . '", image_count = "'.$countImage.'" WHERE cars.id = ' . $res['Car']['id'] );
                        print_r($update);
                    }
                }
            }
        //$this->addAllImageCarNet();
        //print_r($results);
        }
                    
        
         public function readCSVCarNet()
        {
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('User');
            $dir = WWW_ROOT."datafeed/carnetauctions/";
            $dh  = opendir($dir);
            $dealer_solution_number = '';
            $index = 1;
            $filename = 'CarNetSmithfield.csv';
            $results = array();
            $results = $this->parse_csv_file($dir . $filename);
//		while (false !== ($filename = readdir($dh))) {
//                    $results = $this->parse_csv_file($dir . $filename);
//                }
            foreach ($results as $car_item) {
                echo ($index . " \n");
                $this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
                $res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $car_item[19])));
                //User nvngoc@sdc.ud.edu.vn
                $resUser = $this->User->find('first', array('conditions' => array('User.dealer_solution_number' => 12)));
                $user_id = 154;
                $stock_id =(int)str_replace('CSS','', $car_item[0]);    
                if($res){	

                        $result =$res["Car"];
                        $car_id = $result['id']; 
                        $client_no = ($result['client_no'] == "") ? $user_id : $result['client_no'];

                        $stock_no= ($car_item[0] == "") ? $result['stock_no'] : $stock_id;

                        $dealer_code= ($car_item[1] == "") ? $result['dealer_code'] : $car_item[1];

                        $manu_year= ($car_item[2] == "") ? $result['manu_year'] : $car_item[2];

                        $make= ($car_item[3] == "") ? $result['make'] : $car_item[3];

                        $model= ($car_item[4] == "") ? $result['model'] : $car_item[4];

                        $series= ($car_item[5] == "") ? $result['series'] : $car_item[5];

                        $badge= ($car_item[6] == "") ? $result['badge'] : $car_item[6];

                        $body= ($car_item[7] == "") ? $result['body'] : $car_item[7];

                        $doors= ($car_item[8] == "") ? $result['doors'] : $car_item[8];

                        $seats= ($car_item[9] == "") ? $result['seats'] : $car_item[9];

                        $body_colour= ($car_item[10] == "") ? $result['body_colour'] : $car_item[10];

                        $trim_colour= ($car_item[11] == "") ? $result['trim_colour'] : $car_item[11];

                        $gears= ($car_item[12] == "") ? $result['gears'] : $car_item[12];

                        $gearbox= ($car_item[13] == "") ? $result['gearbox'] : $car_item[13];

                        $fuel_type= ($car_item[14] == "") ? $result['fuel_type'] : $car_item[14]; 

                        //$price= ($car_item[15] == "") ? $result['price'] : $car_item[15];
                        //$retail= ($car_item[16] == "") ? $result['retail'] : $car_item[16]; 
                        $price= str_ireplace (array('$',','),array('',''), ($car_item[15] == "") ? $result['price'] : $car_item[15]);
                        //$price= str_ireplace (array('.'),array(','), $price);	

                        $retail= str_ireplace (array('$',','),array('',''), ($car_item[16] == "") ? $result['retail'] : $car_item[16]);
                        //$retail= str_ireplace (array('.'),array(','), $retail);					

                        $rego= ($car_item[17] == "") ? $result['rego'] : $car_item[17];

                        $odometer= ($car_item[18] == "") ? $result['odometer'] : $car_item[18];

                        $cylinders= ($car_item[19] == "") ? $result['cylinders'] : $car_item[19];

                        $engine_capacity= ($car_item[20] == "") ? $result['engine_capacity'] : $car_item[20];

                        $vin_number= ($car_item[21] == "") ? $result['vin_number'] : $car_item[21];

                        $engine_number= ($car_item[22] == "") ? $result['engine_number'] : $car_item[22];

                        $manu_month= ($car_item[23] == "") ? $result['manu_month'] : $car_item[23];

                        $options=  str_ireplace (array('"', "'"),array(' ', ' '), ($car_item[24] == "") ? $result['options'] : $car_item[24]);

                        $comments= ($car_item[25] == "") ? $result['comments'] : $car_item[25];

                        $nvic= ($car_item[26] == "") ? $result['nvic'] : $car_item[26];

                        $redbookcode= ($car_item[27] == "") ? $result['redbookcode'] : $car_item[27];

                        $inventory= ($car_item[28] == "") ? $result['inventory'] : $car_item[28];

                        $egc= ($car_item[29] == "") ? $result['egc'] : $car_item[29];

                        $location= ($car_item[30] == "") ? $result['location'] : $car_item[30];

                        $drive_away_amount= ($car_item[31] == "") ? $result['drive_away_amount'] : $car_item[31];

                        $is_drive_away= ($car_item[32] == "") ? $result['is_drive_away'] : $car_item[32];

                        $drive_type= ($car_item[33] == "") ? $result['drive_type'] : $car_item[33];

                        $model_variant=  $result['model_variant'];
                        $registration_number= $result['registration_number'];
                        $registration_expiry=  $result['registration_expiry'];
                        $engine_type=  $result['engine_type'];
                        $engine_size= $result['engine_size'];
                        $drive_train=  $result['drive_train'];
                        $standard_extras=  $result['standard_extras'] ;
                        $video_url=  $result['video_url'] ;
                        $engineno=  $result['engineno'] ;
                        $regovalid=  $result['regovalid'] ;
                        //$receiveddate= ($data[44] == "") ? $result['receiveddate'] : $data[44];
                        $receiveddate= $result['receiveddate'];
                        $status= $result['status'];
                        $appraisalnotes= $result['appraisalnotes'] ;
                        $acquisition_date=  $result['acquisition_date'];


                        $update_res = $this->User->query("UPDATE cars SET client_no = \"$client_no\", 
                        stock_no = \"$stock_no\", dealer_code = \"$dealer_code\", manu_year = \"$manu_year\", make = \"$make\", model = \"$model\", series = \"$series\", badge = \"$badge\", body = \"$body\", doors = \"$doors\", seats = \"$seats\", body_colour = \"$body_colour\", trim_colour = \"$trim_colour\", gears = \"$gears\", gearbox = \"$gearbox\", fuel_type = \"$fuel_type\", price = \"$price\", retail = \"$retail\", rego = \"$rego\", odometer = \"$odometer\", cylinders = \"$cylinders\", engine_capacity = \"$engine_capacity\", vin_number = \"$vin_number\", engine_number = \"$engine_number\", manu_month = \"$manu_month\", options = \"$options\", comments = \"$comments\", nvic = \"$nvic\", redbookcode = \"$redbookcode\", inventory = \"$inventory\", egc = \"$egc\", location = \"$location\", drive_away_amount = \"$drive_away_amount\", is_drive_away = \"$is_drive_away\", drive_type = \"$drive_type\" , model_variant = \"$model_variant\" , registration_number = \"$registration_number\" , registration_expiry = \"$registration_expiry\" , engine_type = \"$engine_type\" , engine_size = \"$engine_size\" , drive_train = \"$drive_train\" , standard_extras = \"$standard_extras\" , video_url = \"$video_url\", engineno = \"$engineno\", regovalid = \"$regovalid\", receiveddate = \"$receiveddate\", status = \"$status\" 
                        WHERE id = $car_id
                        ");


                }else{

                    // new car
                    $value = "(";
                    $value .= "\"".$user_id."\",";
                    $i = 0;
                    foreach($car_item as $x){
                        if ($i != 1) {
                            if ($i == 0) {
                                $value .= ($stock_id . ",");
                            }else
                            {
                                $value .= "\"".$car_item[$i]."\",";
                            }

                        }else
                        {
                            $value .= '"",';
                        }
                            $i ++;
                    }
                    $value = substr($value, 0, -1) . ")";
                    if(strlen($value) > 0){
                            $car_ids = $this->User->query("INSERT INTO cars (client_no,stock_no,dealer_code,manu_year,make,model,series,badge,body,doors,seats,body_colour,trim_colour,gears,gearbox,fuel_type,price,retail,rego,odometer,cylinders,engine_capacity,vin_number,engine_number,manu_month,options,comments,nvic,redbookcode,inventory,egc,location,drive_away_amount,is_drive_away,drive_type) 	
                    VALUES ". $value);

                    }
                }
                $index++;
        }
        //$this->addAllImageCarNet();
        //print_r($results);
        }
        
        public function addAllImageCarNet(){
	///app/webroot/img/uploads/car_images/
		$this->autoRender = false;
		$folder_url = WWW_ROOT . "datafeed/carnetauctions";
		$this->readImageCarNet($folder_url);
	}
	function readImageCarNet($dir){
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('Image');
            $this->loadModel('User');
            $index = 1;
            $file = scandir($dir);
            $arr_file = array();
            foreach($file as $a_file){
                if($a_file != '.' && $a_file != '..'){
                                $arr_name = explode("_",$a_file);
                                $stock_no = (int)str_replace('CSS','', $arr_name[0]);
                                //$result = $this->Car->find('first', array('conditions' =>array('Car.stock_no' => $stock_no)));
                                $result = $this->User->query('SELECT id FROM cars WHERE stock_no = '. $stock_no . ' LIMIT 1');
                                $car_id = '';
                                $a_file = "http://198.38.92.58//app/webroot/datafeed/carnetauctions/" . $a_file;
                                //print_r($result);
                                if(count($result) > 0){
                                        $car_id = $result[0]['cars']['id'];
                                        print_r($car_id);
                                        $date = new DateTime();
                                        $current_time = $date->format('Y-m-d H:i:s') ;
                                        $this->User->query("INSERT INTO images (car_id,image_file_name,folder_name,updated_at,is_server_sdc) VALUES (". "\"" . $car_id . "\",\"".$a_file. "\",\"" . "\",\"" . $current_time . "\",0)");
                        }

                }
                $index ++;
            }
	}
        
        
        /////////////////////////////////
        public function updateImageCSVF3MotorAuctions()
        {
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('User');
            $this->loadModel('Image');
            $this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
                
            $dir = WWW_ROOT."datafeed/f3motorauctions/";
            $dh  = opendir($dir);
            $dealer_solution_number = '';
            $index = 1;
            $filename = 'F3MotorAuctions.csv';
            $results = array();
            $results = $this->parse_csv_file($dir . $filename);
//		while (false !== ($filename = readdir($dh))) {
//                    $results = $this->parse_csv_file($dir . $filename);
//                }
            foreach ($results as $car_item) {
                //print_r($car_item);
                $res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $car_item[21])));
                //print_r($res);
                if ($res) {
                    $images = $this->Image->find('all', array('recursive' => -1, 'conditions' => array('Image.car_id' => $res['Car']['id'])));
                    //print_r($image);
                    $countImage = count($images);
                    if ( $countImage > 0) {
                        $update = $this->User->query('UPDATE cars SET image_url = "'. $images[0]['Image']['image_file_name'] . '", image_count = "'.$countImage.'" WHERE cars.id = ' . $res['Car']['id'] );
                        print_r($update);
                    }
                }
            }
        //$this->addAllImageCarNet();
        //print_r($results);
        }
                    
        
         public function readCSVF3MotorAuctions()
        {
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('User');
            $dir = WWW_ROOT."datafeed/f3motorauctions/";
            $dh  = opendir($dir);
            $dealer_solution_number = '';
            $index = 1;
            $filename = 'F3MotorAuctions.csv';
            $results = array();
            $results = $this->parse_csv_file($dir . $filename);
//		while (false !== ($filename = readdir($dh))) {
//                    $results = $this->parse_csv_file($dir . $filename);
//                }
            foreach ($results as $car_item) {
                echo ($index . " \n");
                $this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
                $res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $car_item[19])));
                //User nvngoc@sdc.ud.edu.vn
                $resUser = $this->User->find('first', array('conditions' => array('User.dealer_solution_number' => 12)));
                $user_id = 347;
                $stock_id =(int)str_replace('F3A','', $car_item[0]);    
                if($res){	

                        $result =$res["Car"];
                        $car_id = $result['id']; 
                        $client_no = ($result['client_no'] == "") ? $user_id : $result['client_no'];

                        $stock_no= ($car_item[0] == "") ? $result['stock_no'] : $stock_id;

                        $dealer_code= ($car_item[1] == "") ? $result['dealer_code'] : $car_item[1];

                        $manu_year= ($car_item[2] == "") ? $result['manu_year'] : $car_item[2];

                        $make= ($car_item[3] == "") ? $result['make'] : $car_item[3];

                        $model= ($car_item[4] == "") ? $result['model'] : $car_item[4];

                        $series= ($car_item[5] == "") ? $result['series'] : $car_item[5];

                        $badge= ($car_item[6] == "") ? $result['badge'] : $car_item[6];

                        $body= ($car_item[7] == "") ? $result['body'] : $car_item[7];

                        $doors= ($car_item[8] == "") ? $result['doors'] : $car_item[8];

                        $seats= ($car_item[9] == "") ? $result['seats'] : $car_item[9];

                        $body_colour= ($car_item[10] == "") ? $result['body_colour'] : $car_item[10];

                        $trim_colour= ($car_item[11] == "") ? $result['trim_colour'] : $car_item[11];

                        $gears= ($car_item[12] == "") ? $result['gears'] : $car_item[12];

                        $gearbox= ($car_item[13] == "") ? $result['gearbox'] : $car_item[13];

                        $fuel_type= ($car_item[14] == "") ? $result['fuel_type'] : $car_item[14]; 

                        //$price= ($car_item[15] == "") ? $result['price'] : $car_item[15];
                        //$retail= ($car_item[16] == "") ? $result['retail'] : $car_item[16]; 
                        $price= str_ireplace (array('$',','),array('',''), ($car_item[15] == "") ? $result['price'] : $car_item[15]);
                        //$price= str_ireplace (array('.'),array(','), $price);	

                        $retail= str_ireplace (array('$',','),array('',''), ($car_item[16] == "") ? $result['retail'] : $car_item[16]);
                        //$retail= str_ireplace (array('.'),array(','), $retail);					

                        $rego= ($car_item[17] == "") ? $result['rego'] : $car_item[17];

                        $odometer= ($car_item[18] == "") ? $result['odometer'] : $car_item[18];

                        $cylinders= ($car_item[19] == "") ? $result['cylinders'] : $car_item[19];

                        $engine_capacity= ($car_item[20] == "") ? $result['engine_capacity'] : $car_item[20];

                        $vin_number= ($car_item[21] == "") ? $result['vin_number'] : $car_item[21];

                        $engine_number= ($car_item[22] == "") ? $result['engine_number'] : $car_item[22];

                        $manu_month= ($car_item[23] == "") ? $result['manu_month'] : $car_item[23];

                        $options=  str_ireplace (array('"', "'"),array(' ', ' '), ($car_item[24] == "") ? $result['options'] : $car_item[24]);

                        $comments= ($car_item[25] == "") ? $result['comments'] : $car_item[25];

                        $nvic= ($car_item[26] == "") ? $result['nvic'] : $car_item[26];

                        $redbookcode= ($car_item[27] == "") ? $result['redbookcode'] : $car_item[27];

                        $inventory= ($car_item[28] == "") ? $result['inventory'] : $car_item[28];

                        $egc= ($car_item[29] == "") ? $result['egc'] : $car_item[29];

                        $location= ($car_item[30] == "") ? $result['location'] : $car_item[30];

                        $drive_away_amount= ($car_item[31] == "") ? $result['drive_away_amount'] : $car_item[31];

                        $is_drive_away= ($car_item[32] == "") ? $result['is_drive_away'] : $car_item[32];

                        $drive_type= ($car_item[33] == "") ? $result['drive_type'] : $car_item[33];

                        $model_variant=  $result['model_variant'];
                        $registration_number= $result['registration_number'];
                        $registration_expiry=  $result['registration_expiry'];
                        $engine_type=  $result['engine_type'];
                        $engine_size= $result['engine_size'];
                        $drive_train=  $result['drive_train'];
                        $standard_extras=  $result['standard_extras'] ;
                        $video_url=  $result['video_url'] ;
                        $engineno=  $result['engineno'] ;
                        $regovalid=  $result['regovalid'] ;
                        //$receiveddate= ($data[44] == "") ? $result['receiveddate'] : $data[44];
                        $receiveddate= $result['receiveddate'];
                        $status= $result['status'];
                        $appraisalnotes= $result['appraisalnotes'] ;
                        $acquisition_date=  $result['acquisition_date'];


                        $update_res = $this->User->query("UPDATE cars SET client_no = \"$client_no\", 
                        stock_no = \"$stock_no\", dealer_code = \"$dealer_code\", manu_year = \"$manu_year\", make = \"$make\", model = \"$model\", series = \"$series\", badge = \"$badge\", body = \"$body\", doors = \"$doors\", seats = \"$seats\", body_colour = \"$body_colour\", trim_colour = \"$trim_colour\", gears = \"$gears\", gearbox = \"$gearbox\", fuel_type = \"$fuel_type\", price = \"$price\", retail = \"$retail\", rego = \"$rego\", odometer = \"$odometer\", cylinders = \"$cylinders\", engine_capacity = \"$engine_capacity\", vin_number = \"$vin_number\", engine_number = \"$engine_number\", manu_month = \"$manu_month\", options = \"$options\", comments = \"$comments\", nvic = \"$nvic\", redbookcode = \"$redbookcode\", inventory = \"$inventory\", egc = \"$egc\", location = \"$location\", drive_away_amount = \"$drive_away_amount\", is_drive_away = \"$is_drive_away\", drive_type = \"$drive_type\" , model_variant = \"$model_variant\" , registration_number = \"$registration_number\" , registration_expiry = \"$registration_expiry\" , engine_type = \"$engine_type\" , engine_size = \"$engine_size\" , drive_train = \"$drive_train\" , standard_extras = \"$standard_extras\" , video_url = \"$video_url\", engineno = \"$engineno\", regovalid = \"$regovalid\", receiveddate = \"$receiveddate\", status = \"$status\" 
                        WHERE id = $car_id
                        ");


                }else{

                    // new car
                    $value = "(";
                    $value .= "\"".$user_id."\",";
                    $i = 0;
                    foreach($car_item as $x){
                        if ($i != 1) {
                            if ($i == 0) {
                                $value .= ($stock_id . ",");
                            }else
                            {
                                $value .= "\"".$car_item[$i]."\",";
                            }

                        }else
                        {
                            $value .= '"",';
                        }
                            $i ++;
                    }
                    $value = substr($value, 0, -1) . ")";
                    if(strlen($value) > 0){
                            $car_ids = $this->User->query("INSERT INTO cars (client_no,stock_no,dealer_code,manu_year,make,model,series,badge,body,doors,seats,body_colour,trim_colour,gears,gearbox,fuel_type,price,retail,rego,odometer,cylinders,engine_capacity,vin_number,engine_number,manu_month,options,comments,nvic,redbookcode,inventory,egc,location,drive_away_amount,is_drive_away,drive_type) 	
                    VALUES ". $value);

                    }
                }
                $index++;
        }
        //$this->addAllImageCarNet();
        //print_r($results);
        }
        
        public function addAllImageF3MotorAuctions(){
	///app/webroot/img/uploads/car_images/
		$this->autoRender = false;
		$folder_url = WWW_ROOT . "datafeed/f3motorauctions";
		$this->readImageF3MotorAuctions($folder_url);
	}
	function readImageF3MotorAuctions($dir){
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('Image');
            $this->loadModel('User');
            $index = 1;
            $file = scandir($dir);
            $arr_file = array();
            foreach($file as $a_file){
                if($a_file != '.' && $a_file != '..'){
                                $arr_name = explode("_",$a_file);
                                $stock_no = (int)str_replace('F3A','', $arr_name[0]);
                                //$result = $this->Car->find('first', array('conditions' =>array('Car.stock_no' => $stock_no)));
                                $result = $this->User->query('SELECT id FROM cars WHERE stock_no = '. $stock_no . ' LIMIT 1');
                                $car_id = '';
                                $a_file = "http://198.38.92.58//app/webroot/datafeed/f3motorauctions/" . $a_file;
                                //print_r($result);
                                if(count($result) > 0){
                                        $car_id = $result[0]['cars']['id'];
                                        print_r($car_id);
                                        $date = new DateTime();
                                        $current_time = $date->format('Y-m-d H:i:s') ;
                                        $this->User->query("INSERT INTO images (car_id,image_file_name,folder_name,updated_at,is_server_sdc) VALUES (". "\"" . $car_id . "\",\"".$a_file. "\",\"" . "\",\"" . $current_time . "\",0)");
                        }

                }
                $index ++;
            }
	}
        
        
        /////////////////////////////////
        
        
        public function RandomCodeCar()
        {
            $this->autoRender = false;
            $this->loadModel('Car');
            $update_random_code = $this->Car->query("UPDATE cars SET cars.random_code = FLOOR(0+RAND()*(10000-0))");
        }

                //BidsOnline
        public function updateImageCSVBidsOnline()
        {
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('User');
            $this->loadModel('Image');
            $this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
                
            $dir = WWW_ROOT."datafeed/bidsonline/";
            $dh  = opendir($dir);
            $dealer_solution_number = '';
            $index = 1;
            $filename = 'BMA.csv';
            $results = array();
            $results = $this->parse_csv_file($dir . $filename);
//		while (false !== ($filename = readdir($dh))) {
//                    $results = $this->parse_csv_file($dir . $filename);
//                }
            foreach ($results as $car_item) {
                //print_r($car_item);
                $res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $car_item[21])));
                //print_r($res);
                if ($res) {
                    $images = $this->Image->find('all', array('recursive' => -1, 'conditions' => array('Image.car_id' => $res['Car']['id'])));
                    //print_r($image);
                    $countImage = count($images);
                    if ( $countImage > 0) {
                        $update = $this->User->query('UPDATE cars SET image_url = "'. $images[0]['Image']['image_file_name'] . '", image_count = "'.$countImage.'" WHERE cars.id = ' . $res['Car']['id'] );
                        print_r($update);
                    }
                }
            }
        //$this->addAllImageCarNet();
        //print_r($results);
        }
                    
        
         public function readCSVBidsOnline()
        {
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('User');
            $dir = WWW_ROOT."datafeed/bidsonline/";
            $dh  = opendir($dir);
            $dealer_solution_number = '';
            $index = 1;
            $filename = 'BMA.csv';
            $results = array();
            $results = $this->parse_csv_file($dir . $filename);
//		while (false !== ($filename = readdir($dh))) {
//                    $results = $this->parse_csv_file($dir . $filename);
//                }
            foreach ($results as $car_item) {
                echo ($index . " \n");
                $this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
                $res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $car_item[19])));
                //User nvngoc@sdc.ud.edu.vn
                $resUser = $this->User->find('first', array('conditions' => array('User.dealer_solution_number' => 12)));
                $user_id = 154;
                $stock_id =(int)str_replace('APE','', $car_item[0]);    
                if($res){	

                        $result =$res["Car"];
                        $car_id = $result['id']; 
                        $client_no = ($result['client_no'] == "") ? $user_id : $result['client_no'];

                        $stock_no= ($car_item[0] == "") ? $result['stock_no'] : $stock_id;

                        $dealer_code= ($car_item[1] == "") ? $result['dealer_code'] : $car_item[1];

                        $manu_year= ($car_item[2] == "") ? $result['manu_year'] : $car_item[2];

                        $make= ($car_item[3] == "") ? $result['make'] : $car_item[3];

                        $model= ($car_item[4] == "") ? $result['model'] : $car_item[4];

                        $series= ($car_item[5] == "") ? $result['series'] : $car_item[5];

                        $badge= ($car_item[6] == "") ? $result['badge'] : $car_item[6];

                        $body= ($car_item[7] == "") ? $result['body'] : $car_item[7];

                        $doors= ($car_item[8] == "") ? $result['doors'] : $car_item[8];

                        $seats= ($car_item[9] == "") ? $result['seats'] : $car_item[9];

                        $body_colour= ($car_item[10] == "") ? $result['body_colour'] : $car_item[10];

                        $trim_colour= ($car_item[11] == "") ? $result['trim_colour'] : $car_item[11];

                        $gears= ($car_item[12] == "") ? $result['gears'] : $car_item[12];

                        $gearbox= ($car_item[13] == "") ? $result['gearbox'] : $car_item[13];

                        $fuel_type= ($car_item[14] == "") ? $result['fuel_type'] : $car_item[14]; 

                        //$price= ($car_item[15] == "") ? $result['price'] : $car_item[15];
                        //$retail= ($car_item[16] == "") ? $result['retail'] : $car_item[16]; 
                        $price= str_ireplace (array('$',','),array('',''), ($car_item[15] == "") ? $result['price'] : $car_item[15]);
                        //$price= str_ireplace (array('.'),array(','), $price);	

                        $retail= str_ireplace (array('$',','),array('',''), ($car_item[16] == "") ? $result['retail'] : $car_item[16]);
                        //$retail= str_ireplace (array('.'),array(','), $retail);					

                        $rego= ($car_item[17] == "") ? $result['rego'] : $car_item[17];

                        $odometer= ($car_item[18] == "") ? $result['odometer'] : $car_item[18];

                        $cylinders= ($car_item[19] == "") ? $result['cylinders'] : $car_item[19];

                        $engine_capacity= ($car_item[20] == "") ? $result['engine_capacity'] : $car_item[20];

                        $vin_number= ($car_item[21] == "") ? $result['vin_number'] : $car_item[21];

                        $engine_number= ($car_item[22] == "") ? $result['engine_number'] : $car_item[22];

                        $manu_month= ($car_item[23] == "") ? $result['manu_month'] : $car_item[23];

                        $options=  str_ireplace (array('"', "'"),array(' ', ' '), ($car_item[24] == "") ? $result['options'] : $car_item[24]);

                        $comments= ($car_item[25] == "") ? $result['comments'] : $car_item[25];

                        $nvic= ($car_item[26] == "") ? $result['nvic'] : $car_item[26];

                        $redbookcode= ($car_item[27] == "") ? $result['redbookcode'] : $car_item[27];

                        $inventory= ($car_item[28] == "") ? $result['inventory'] : $car_item[28];

                        $egc= ($car_item[29] == "") ? $result['egc'] : $car_item[29];

                        $location= ($car_item[30] == "") ? $result['location'] : $car_item[30];

                        $drive_away_amount= ($car_item[31] == "") ? $result['drive_away_amount'] : $car_item[31];

                        $is_drive_away= ($car_item[32] == "") ? $result['is_drive_away'] : $car_item[32];

                        $drive_type= ($car_item[33] == "") ? $result['drive_type'] : $car_item[33];

                        $model_variant=  $result['model_variant'];
                        $registration_number= $result['registration_number'];
                        $registration_expiry=  $result['registration_expiry'];
                        $engine_type=  $result['engine_type'];
                        $engine_size= $result['engine_size'];
                        $drive_train=  $result['drive_train'];
                        $standard_extras=  $result['standard_extras'] ;
                        $video_url=  $result['video_url'] ;
                        $engineno=  $result['engineno'] ;
                        $regovalid=  $result['regovalid'] ;
                        //$receiveddate= ($data[44] == "") ? $result['receiveddate'] : $data[44];
                        $receiveddate= $result['receiveddate'];
                        $status= $result['status'];
                        $appraisalnotes= $result['appraisalnotes'] ;
                        $acquisition_date=  $result['acquisition_date'];


                        $update_res = $this->User->query("UPDATE cars SET client_no = \"$client_no\", 
                        stock_no = \"$stock_no\", dealer_code = \"$dealer_code\", manu_year = \"$manu_year\", make = \"$make\", model = \"$model\", series = \"$series\", badge = \"$badge\", body = \"$body\", doors = \"$doors\", seats = \"$seats\", body_colour = \"$body_colour\", trim_colour = \"$trim_colour\", gears = \"$gears\", gearbox = \"$gearbox\", fuel_type = \"$fuel_type\", price = \"$price\", retail = \"$retail\", rego = \"$rego\", odometer = \"$odometer\", cylinders = \"$cylinders\", engine_capacity = \"$engine_capacity\", vin_number = \"$vin_number\", engine_number = \"$engine_number\", manu_month = \"$manu_month\", options = \"$options\", comments = \"$comments\", nvic = \"$nvic\", redbookcode = \"$redbookcode\", inventory = \"$inventory\", egc = \"$egc\", location = \"$location\", drive_away_amount = \"$drive_away_amount\", is_drive_away = \"$is_drive_away\", drive_type = \"$drive_type\" , model_variant = \"$model_variant\" , registration_number = \"$registration_number\" , registration_expiry = \"$registration_expiry\" , engine_type = \"$engine_type\" , engine_size = \"$engine_size\" , drive_train = \"$drive_train\" , standard_extras = \"$standard_extras\" , video_url = \"$video_url\", engineno = \"$engineno\", regovalid = \"$regovalid\", receiveddate = \"$receiveddate\", status = \"$status\" 
                        WHERE id = $car_id
                        ");


                }else{

                    // new car
                    $value = "(";
                    $value .= "\"".$user_id."\",";
                    $i = 0;
                    foreach($car_item as $x){
                        if ($i != 1) {
                            if ($i == 0) {
                                $value .= ($stock_id . ",");
                            }else
                            {
                                $value .= "\"".$car_item[$i]."\",";
                            }

                        }else
                        {
                            $value .= '"",';
                        }
                            $i ++;
                    }
                    $value = substr($value, 0, -1) . ")";
                    if(strlen($value) > 0){
                            $car_ids = $this->User->query("INSERT INTO cars (client_no,stock_no,dealer_code,manu_year,make,model,series,badge,body,doors,seats,body_colour,trim_colour,gears,gearbox,fuel_type,price,retail,rego,odometer,cylinders,engine_capacity,vin_number,engine_number,manu_month,options,comments,nvic,redbookcode,inventory,egc,location,drive_away_amount,is_drive_away,drive_type) 	
                    VALUES ". $value);

                    }
                }
                $index++;
        }
        //$this->addAllImageCarNet();
        //print_r($results);
        }
        
        public function addAllImageBidsOnline(){
	///app/webroot/img/uploads/car_images/
		$this->autoRender = false;
		$folder_url = WWW_ROOT . "datafeed/bidsonline";
		$this->readImageBidsOnline($folder_url);
	}
	function readImageBidsOnline($dir){
            $this->autoRender = false;
            $this->loadModel('Car');
            $this->loadModel('Image');
            $this->loadModel('User');
            $index = 1;
            $file = scandir($dir);
            $arr_file = array();
            foreach($file as $a_file){
                if($a_file != '.' && $a_file != '..'){
                                $arr_name = explode("_",$a_file);
                                $stock_no = (int)str_replace('APE','', $arr_name[0]);
                                //$result = $this->Car->find('first', array('conditions' =>array('Car.stock_no' => $stock_no)));
                                $result = $this->User->query('SELECT id FROM cars WHERE stock_no = '. $stock_no . ' LIMIT 1');
                                $car_id = '';
                                $a_file = "http://198.38.92.58//app/webroot/datafeed/bidsonline/" . $a_file;
                                //print_r($result);
                                if(count($result) > 0){
                                        $car_id = $result[0]['cars']['id'];
                                        $date = new DateTime();
                                        $current_time = $date->format('Y-m-d H:i:s') ;
                                        $this->User->query("INSERT INTO images (car_id,image_file_name,folder_name,updated_at,is_server_sdc) VALUES (". "\"" . $car_id . "\",\"".$a_file. "\",\"" . "\",\"" . $current_time . "\",0)");
                        }

                }
                $index ++;
            }
            die(json_encode(array("success" => true)));
	}
	
        //End BidsOnline
        
	function parse_csv_file($csvfile) {
            $csv = Array();
            $rowcount = 0;
            if (($handle = fopen($csvfile, "r")) !== FALSE) {
                $max_line_length = defined('MAX_LINE_LENGTH') ? MAX_LINE_LENGTH : 1000000;
                //$header = fgetcsv($handle, $max_line_length);
                //$header_colcount = count($header);
                while (($row = fgetcsv($handle, $max_line_length)) !== FALSE) {
                    $csv[] = $row;
                    //$row_colcount = count($row);
//                    if ($row_colcount == $header_colcount) {
//                        $entry = array_combine($header, $row);
//                        $csv[] = $entry;
//                    }
//                    else {
//                        error_log("csvreader: Invalid number of columns at line " . ($rowcount + 2) . " (row " . ($rowcount + 1) . "). Expected=$header_colcount Got=$row_colcount");
//                        return null;
//                    }
                    $rowcount++;
                }
                //echo "Totally $rowcount rows found\n";
                fclose($handle);
            }
            else {
                error_log("csvreader: Could not read CSV \"$csvfile\"");
                return null;
            }
            return $csv;
        }
	public function readXMLBetterCarTest(){
		$this->autoRender = false;
		$this->loadModel("User");
		$this->loadModel("Car");
		$this->loadModel("Image");
		$this->loadModel('PushNotificationRegistration');
		$table_name = "cars";
		
		$dir = WWW_ROOT."datafeed/bettercarstest/";
		$dh  = opendir($dir);
		$dealer_solution_number = '';
		while (false !== ($filename = readdir($dh))) {
			//$dealer_solution_number = str_ireplace (array('.','xml'),array('',''), $filename); 
		if(strpos(strtolower($filename),'.xml')) {
		
		$xml = simplexml_load_file($dir . $filename);
		$values = ""; 
		$arr_image = array();
		$data = array();
		foreach ($xml->children() as $child) {
			foreach ($child->children() as $a_child) { 
				if($a_child->getName() == 'Images'){
					foreach ($a_child->children() as $a_child_image) {
						$arr_image[] = $a_child_image->attributes()[0];
					}				
				}
				if($a_child->getName() == 'stockno'){
					$data = array();
					$arr_image = array();
					$data[0] = $a_child;
					//$data[6] = '';//badge
					//$data[9] = '';//Seats
					$data[1] = '';
					$data[2] = '';
					$data[3] = '';
					$data[4] = '';
					$data[5] = '';
					$data[6] = '';
					$data[7] = '';
					$data[8] = '';
					$data[9] = '';
					$data[10] = '';
					$data[11] = '';
					$data[12] = '';
					$data[13] = '';
					$data[14] = '';
					$data[15] = '';
					$data[16] = '';
					$data[18] = '';
					$data[19] = '';
					$data[20] = '';
					$data[21] = '';
					$data[23] = '';
					$data[24] = '';
					$data[25] = '';
					$data[26] = '';
					$data[27] = '';
					$data[29] = '';
					$data[30] = '';
					$data[31] = '';
					$data[32] = '';
					$data[37] = '';
					$data[17] = '';//rego
					$data[22] = '';//engine_number
					$data[28] = '';//inventory
					$data[33] = '';//drive_type
					$data[34] = '';//ModelVariant
					$data[35] = '';//RegistrationNumber
					$data[36] = '';//RegistrationExpiry
					$data[38] = '';//EngineSize
					$data[39] = '';//DriveTrain
					$data[40] = '';//StandardExtras
					
					$make = ''; $model = ''; $series = ''; $stock_no = $a_child; $manu_year = '';
					$badge = ''; $body = ''; $doors = ''; $seats = ''; $body_colour  = ''; $trim_colour = '';
					$gears = ''; $gearbox = ''; $fuel_type = ''; $price = ''; $retail = ''; $rego = ''; $odometer = '';
					$cylinders = ''; $engine_capacity = ''; $vin_number = '';$engine_number = ''; $options = '';$nvic = '';
					$redbookcode = ''; $inventory = ''; $egc = ''; $location = ''; $drive_away_amount = '';
					$is_drive_away = ''; $drive_type = ''; $manu_month = ''; $comments = '';
					$model_variant = ''; $registration_number = ''; $registration_expiry = ''; $engine_type = '';$engine_size = ''; $drive_train = '';$standard_extras = ''; $video_url = ''; $engineno = ''; $regovalid = ''; $receiveddate = ''; $status = '';
				}
				if($a_child->getName() == 'dealerId'){
					$data[1] = $a_child;
					$dealer_solution_number = $a_child;
				}
				if($a_child->getName() == 'manuyear'){
					$data[2] = $a_child;
					$manu_year = $a_child;
				}
				if($a_child->getName() == 'make'){
					$data[3] = $a_child;
					$make = $a_child;
				}
				if($a_child->getName() == 'model'){
					$data[4] = $a_child;
					$model = $a_child;
				}
				if($a_child->getName() == 'series'){
					$data[5] = $a_child;
					$series = $a_child;
				}
				if($a_child->getName() == 'badge'){
					$data[6] = $a_child;
					$badge = $a_child;
				}
				if($a_child->getName() == 'body'){
					$data[7] = $a_child;
					$body = $a_child;
				}
				if($a_child->getName() == 'doors'){
					$data[8] = $a_child;
					$doors = $a_child;
				}
				if($a_child->getName() == 'seats'){
					$data[9] = $a_child;
					$seats = $a_child;
				}
				if($a_child->getName() == 'colour'){
					$data[10] = $a_child;
					$body_colour = $a_child;
				}
				if($a_child->getName() == 'interior_colour'){//Trim
					$data[11] = $a_child;
					$trim_colour = $a_child;
				}
				if($a_child->getName() == 'gears'){
					$data[12] = $a_child;
					$gears = $a_child;
				}
				if($a_child->getName() == 'transmission'){
					$data[13] = $a_child;
					$gearbox = $a_child;
				}
				if($a_child->getName() == 'fueltype'){
					$data[14] = $a_child;
					$fuel_type = $a_child;
				}
				if($a_child->getName() == 'wholesale'){
					$data[15] = $a_child;//price
					$price = $a_child;
				}
				
				if($a_child->getName() == 'price'){
					$data[16] = $a_child;//retail
					$retail = $a_child;
				}
				if($a_child->getName() == 'rego'){
					$data[17] = $a_child;//rego
					$rego = $a_child;
				}
				if($a_child->getName() == 'odometer'){
					$data[18] = $a_child;
					$odometer = $a_child;
				}
				
				if($a_child->getName() == 'cylinders'){
					$data[19] = $a_child;
					$cylinders = $a_child;
				}
				
				if($a_child->getName() == 'capacity'){
					$data[20] = $a_child;
					$engine_capacity = $a_child;
				}
				
				if($a_child->getName() == 'vin'){
					$data[21] = $a_child;
					$vin_number = $a_child;
				}
				if($a_child->getName() == 'manumonth'){
					$data[23] = $a_child;//manu_month
					$manu_month = $a_child;
				}
				if($a_child->getName() == 'options'){
					$data[24] = $a_child;
					$options = $a_child;
				}
				if($a_child->getName() == 'comments'){
					$data[25] = $a_child;
					$comments = $a_child;
				}
				if($a_child->getName() == 'nvic'){
					$data[26] = $a_child;
					$nvic = $a_child; 
				}
				if($a_child->getName() == 'redbookcode'){
					$data[27] = $a_child;
					$redbookcode = $a_child;
				}
				if($a_child->getName() == 'egc'){
					$data[29] = $a_child;
					$egc = $a_child;
				}
				if($a_child->getName() == 'stock_location_code'){
					$data[30] = $a_child;
					$location = $a_child;
				}
				if($a_child->getName() == 'driveaway_amount'){
					$data[31] = $a_child;
					$drive_away_amount = $a_child;
				}
				if($a_child->getName() == 'isdriveaway'){
					$data[32] = $a_child;
					$is_drive_away = $a_child;
				}
				
				if($a_child->getName() == 'enginetype'){
					$engine_type = $a_child;
					$data[37] = $a_child;
				}
				if($a_child->getName() == 'videourl'){
					$video_url = $a_child;
					$data[41] = $a_child;
				}
				
				if($a_child->getName() == 'engineno'){
					$engineno = $a_child;
					$data[42] = $a_child;
				}
				if($a_child->getName() == 'regovalid'){
					$regovalid = $a_child;
					$data[43] = $a_child;
				}
				if($a_child->getName() == 'receiveddate'){
					$receiveddate = $a_child;
					$data[44] = $a_child;
				}
				if($a_child->getName() == 'status'){
					$status = $a_child;
					$data[45] = $a_child;
				} 
			}
			if(sizeof($data) > 0){
					$vin = $data[21];
					//$res = $this->User->query("SELECT * FROM $table_name WHERE vin_number='$vin'");
					$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer')));
					$res = $this->Car->find('first', array('recursive' => -1, 'conditions' => array('Car.vin_number' => $vin)));
					$resUser = $this->User->find('first', array('conditions' => array('User.dealer_solution_number' => $data[1])));
					$user_id = '';
					//if($resUser){
					//	$user_id = $resUser['User']['id'];
					//}
					if($data[1] == 14666){
						$user_id = '3';
					}else if($data[1] == 14665){
						$user_id = '4';
					}else{
						$user_id = '153';
					}
					if($res){	
						// existed car
						$data_set = '';
						//$result = $res[0]["$table_name"];
						$result =$res["Car"];
						$car_id = $result['id']; 
						$client_no = ($result['client_no'] == "") ? $user_id : $result['client_no'];
						
						$stock_no= ($data[0] == "") ? $result['stock_no'] : $data[0];
						
						$dealer_code= ($data[1] == "") ? $result['dealer_code'] : $data[1];
						
						$manu_year= ($data[2] == "") ? $result['manu_year'] : $data[2];
						
						$make= ($data[3] == "") ? $result['make'] : $data[3];
						
						$model= ($data[4] == "") ? $result['model'] : $data[4];
						
						$series= ($data[5] == "") ? $result['series'] : $data[5];
						
						$badge= ($data[6] == "") ? $result['badge'] : $data[6];
						
						$body= ($data[7] == "") ? $result['body'] : $data[7];
						
						$doors= ($data[8] == "") ? $result['doors'] : $data[8];
						
						$seats= ($data[9] == "") ? $result['seats'] : $data[9];
						
						$body_colour= ($data[10] == "") ? $result['body_colour'] : $data[10];
						
						$trim_colour= ($data[11] == "") ? $result['trim_colour'] : $data[11];
						
						$gears= ($data[12] == "") ? $result['gears'] : $data[12];
						
						$gearbox= ($data[13] == "") ? $result['gearbox'] : $data[13];
						
						$fuel_type= ($data[14] == "") ? $result['fuel_type'] : $data[14]; 
						
						//$price= ($data[15] == "") ? $result['price'] : $data[15];
						//$retail= ($data[16] == "") ? $result['retail'] : $data[16]; 
						$price= str_ireplace (array('$',','),array('',''), ($data[15] == "") ? $result['price'] : $data[15]);
						//$price= str_ireplace (array('.'),array(','), $price);	
	  
						$retail= str_ireplace (array('$',','),array('',''), ($data[16] == "") ? $result['retail'] : $data[16]);
						//$retail= str_ireplace (array('.'),array(','), $retail);					
						
						$rego= ($data[17] == "") ? $result['rego'] : $data[17];
						
						$odometer= ($data[18] == "") ? $result['odometer'] : $data[18];
						
						$cylinders= ($data[19] == "") ? $result['cylinders'] : $data[19];
						
						$engine_capacity= ($data[20] == "") ? $result['engine_capacity'] : $data[20];
						
						$vin_number= ($data[21] == "") ? $result['vin_number'] : $data[21];
						
						$engine_number= ($data[22] == "") ? $result['engine_number'] : $data[22];
						
						$manu_month= ($data[23] == "") ? $result['manu_month'] : $data[23];
						$options= ($data[24] == "") ? $result['options'] : $data[24];
						
						$comments= ($data[25] == "") ? $result['comments'] : $data[25];
						
						$nvic= ($data[26] == "") ? $result['nvic'] : $data[26];
						
						$redbookcode= ($data[27] == "") ? $result['redbookcode'] : $data[27];
						
						$inventory= ($data[28] == "") ? $result['inventory'] : $data[28];
						
						$egc= ($data[29] == "") ? $result['egc'] : $data[29];
						
						$location= ($data[30] == "") ? $result['location'] : $data[30];
						
						$drive_away_amount= ($data[31] == "") ? $result['drive_away_amount'] : $data[31];
						
						$is_drive_away= ($data[32] == "") ? $result['is_drive_away'] : $data[32];
						
						$drive_type= ($data[33] == "") ? $result['drive_type'] : $data[33];
						
						$model_variant= ($data[34] == "") ? $result['model_variant'] : $data[34];
						$registration_number= ($data[35] == "") ? $result['registration_number'] : $data[35];
						$registration_expiry= ($data[36] == "") ? $result['registration_expiry'] : $data[36];
						$engine_type= ($data[37] == "") ? $result['engine_type'] : $data[37];
						$engine_size= ($data[38] == "") ? $result['engine_size'] : $data[38];
						$drive_train= ($data[39] == "") ? $result['drive_train'] : $data[39];
						$standard_extras= ($data[40] == "") ? $result['standard_extras'] : $data[40];
						$video_url= ($data[41] == "") ? $result['video_url'] : $data[41];
						$engineno= ($data[42] == "") ? $result['engineno'] : $data[42];
						$regovalid= ($data[43] == "") ? $result['regovalid'] : $data[43];
						//$receiveddate= ($data[44] == "") ? $result['receiveddate'] : $data[44];
						$receiveddate= ($result['receiveddate'] == "") ? $data[44] : $result['receiveddate'];
						$status= ($data[45] == "") ? $result['status'] : $data[45];
						
						$update_res = $this->User->query("UPDATE $table_name SET client_no = \"$client_no\", 
						stock_no = \"$stock_no\", dealer_code = \"$dealer_code\", manu_year = \"$manu_year\", make = \"$make\", model = \"$model\", series = \"$series\", badge = \"$badge\", body = \"$body\", doors = \"$doors\", seats = \"$seats\", body_colour = \"$body_colour\", trim_colour = \"$trim_colour\", gears = \"$gears\", gearbox = \"$gearbox\", fuel_type = \"$fuel_type\", price = \"$price\", retail = \"$retail\", rego = \"$rego\", odometer = \"$odometer\", cylinders = \"$cylinders\", engine_capacity = \"$engine_capacity\", vin_number = \"$vin_number\", engine_number = \"$engine_number\", manu_month = \"$manu_month\", options = \"$options\", comments = \"$comments\", nvic = \"$nvic\", redbookcode = \"$redbookcode\", inventory = \"$inventory\", egc = \"$egc\", location = \"$location\", drive_away_amount = \"$drive_away_amount\", is_drive_away = \"$is_drive_away\", drive_type = \"$drive_type\" , model_variant = \"$model_variant\" , registration_number = \"$registration_number\" , registration_expiry = \"$registration_expiry\" , engine_type = \"$engine_type\" , engine_size = \"$engine_size\" , drive_train = \"$drive_train\" , standard_extras = \"$standard_extras\" , video_url = \"$video_url\", engineno = \"$engineno\", regovalid = \"$regovalid\", receiveddate = \"$receiveddate\", status = \"$status\" 
						WHERE id = $car_id
						");
						
						if($update_res){ 
							 echo "update id:".$car_id; 
							foreach($arr_image as $a_arr_image){
								$rs = $this->Image->find('first', array('conditions' =>array('Image.car_id' =>$car_id, 'Image.image_file_name' =>$a_arr_image)));
								if(!$rs){
									$date = new DateTime();
									$current_time = $date->format('Y-m-d H:i:s') ;
									$arr_add['Image']['car_id'] = $car_id;
									$arr_add['Image']['image_file_name'] = $a_arr_image;
									//$arr_add['Image']['image_file_name_mid'] = $mid;
									//$arr_add['Image']['image_file_name_small'] = $small;
									$arr_add['Image']['folder_name'] = '';
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['is_server_sdc'] = 0;
									$this->Image->create();
									if($this->Image->save($arr_add)) {
										 
									}else{ 
										echo "Error<br/>";
									}
								}
							}
						}
					}else{
						// new car
						$value = "(";
						$value .= "\"".$user_id."\",";
						$i = 0;
						foreach($data as $x){
							$value .= "\"".$data[$i]."\",";
							$i ++;
						}
						$value = substr($value, 0, -1) . ")";
						if(strlen($value) > 0){  
							//$values = substr($values, 0, -2) . ")";
							$car_ids = $this->User->query("INSERT INTO $table_name (client_no,stock_no,dealer_code,manu_year,make,model,series,badge,body,doors,seats,body_colour,trim_colour,gears,gearbox,fuel_type,price,retail,rego,odometer,cylinders,engine_capacity,vin_number,engine_number,manu_month,options,comments,nvic,redbookcode,inventory,egc,location,drive_away_amount,is_drive_away,drive_type, model_variant, registration_number, registration_expiry, engine_type, engine_size, drive_train, standard_extras, video_url, engineno, regovalid, receiveddate, status)	
								VALUES ". $value);
								
							$this->Car->unbindModel(array('hasMany' => array('Appchat', 'Comment', 'Conversation', 'HistoryTransaction', 'Image', 'Transfer', '')));
							$car_id = $this->Car->find('first', array('order' => array('Car.id DESC')));
							$car_ids = $car_id['Car']['id'];
							foreach($arr_image as $a_arr_image){ 
								$rs = $this->Image->find('first', array('recursive' => -1, 'conditions' =>array('Image.car_id' =>$car_ids, 'Image.image_file_name' =>$a_arr_image)));
								if(!$rs){
									$date = new DateTime();
									$current_time = $date->format('Y-m-d H:i:s') ;
									$arr_add['Image']['car_id'] = $car_ids;
									$arr_add['Image']['image_file_name'] = $a_arr_image;
									//$arr_add['Image']['image_file_name_mid'] = $mid;
									//$arr_add['Image']['image_file_name_small'] = $small;
									$arr_add['Image']['folder_name'] = '';
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['updated_at'] = $current_time;
									$arr_add['Image']['is_server_sdc'] = 0;
									$this->Image->create();
									if($this->Image->save($arr_add)) {
										 
									}else{ 
										echo "Error<br/>";
									}
								}
							}
							
						} 
					}
						//$values .= $value .",";
				}
			}
		}
	}
	}
}
?>