<?php
App::uses('AppModel', 'Model');
/**
 * OtherNotification Model
 *
 * @property Notification $Notification
 * @property User $User
 * @property Car $Car
 * @property Sender $Sender
 */
class OtherNotification extends AppModel {

	var $name = 'OtherNotification';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'notification_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Car' => array(
			'className' => 'Car',
			'foreignKey' => 'car_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

	);
        
        public function GetCountNotification($user_id, $notification_id) {
            $count = $this->find('count', array('conditions' => array(
                    'OtherNotification.user_id' => $user_id,
                    'OtherNotification.notification_id' => $notification_id,
                    'OtherNotification.is_read' => 0,
            )));
            return $count;
        } 
        function GetCountNotificationsenderid($user_id, $notification_id) {
            $count = $this->find('count', array('conditions' => array(
                    'OtherNotification.sender_id' => $user_id,
                    'OtherNotification.notification_id' => $notification_id,
                    'OtherNotification.is_read' => 0,
            )));
            return $count;
        }
}
