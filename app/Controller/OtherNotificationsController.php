<?php

App::uses('AppController', 'Controller');
Configure::load('api');

class OtherNotificationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('CurlApi');

    public function ResultGetNotification($notification_id) {
        $url = Configure::read('api.api_url') . 'api/user/getcarsofothernotification';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "notification_id" => $notification_id,
            "time_zones" => CakeSession::read('time_zones'),
            "start" => 0,
            "limit" => 20
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function ajaxgetcountcarsnotify() {
        $this->autoRender = FALSE;
        //========
        $url = Configure::read('api.api_url') . 'api/user/getcarsofothernotification';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "notification_id" => "56d8e1c115e994a4b3ef948e",
            "time_zones" => CakeSession::read('time_zones'),
            "start" => 0,
            "limit" => 20
        );

        //========
        $result1 = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if (isset($result1)) {
            $data['result1'] = sizeof($result1->cars);
        } else {
            $data['result1'] = 0;
        }

        //========
        $body["notification_id"] = "56d8e1c115e994a4b3ef948f";

        $result2 = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if (isset($result2)) {
            $data['result2'] = sizeof($result2->cars);
        } else {
            $data['result2'] = 0;
        }

        echo json_encode($data);
    }

    public function ajaxgetcountothernotify() {
        $this->autoRender = FALSE;
        $url = Configure::read('api.api_url') . 'api/user/getothernotificationcount?user_id=' . CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );

        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        $data['count_dealer_network'] = $result->count_dealer_network;
        $data['count_car_add_stock'] = $result->count_car_add_stock;
        $data['count_car_add_network_stock'] = $result->count_car_add_network_stock;
        $data['count_car_updated'] = $result->count_car_updated;
        $data['count_car_following'] = $result->count_car_following;
        $data['count_pulse'] = $result->count_pulse;
        $data['count_invite'] = $result->count_invite;
        $data['count_tender'] = $result->count_tender;
        $data['count_offer'] = $result->count_offer;
        $data['count_requestoffer'] = $result->count_requestoffer;
        echo json_encode($data);
    }

    public function CountGetNotification($notification_id) {
        $url = Configure::read('api.api_url') . 'api/user/getcarsofothernotification';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "notification_id" => $notification_id,
            "time_zones" => CakeSession::read('time_zones'),
            "start" => 0,
            "limit" => 20
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if (isset($result)) {
            return count($result->cars);
        } else {
            return 0;
        }
    }

    public function ResultGetusersofothernotification($notification_id) {
        $url = Configure::read('api.api_url') . 'api/user/getusersofothernotification';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "notification_id" => $notification_id,
            "time_zones" => CakeSession::read('time_zones'),
            "start" => 0,
            "limit" => 20
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result);die();
        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function Getothernotificationcountweb() {

        $url = Configure::read('api.api_url') . 'api/user/getothernotificationcountweb?user_id=' . CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );

        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());

        return $result;
    }

    public function index() {

        $this->set('title_for_layout', 'Notifications');
        $this->layout = 'cz_home';

        $notification_id = $this->params['url']['status'];
        if ($notification_id == '56d8e1c115e994a4b3ef9491' || $notification_id == '56d8e1c115e994a4b3ef9496' || $notification_id == '57771aa0901a7602c86df93d' || $notification_id == '577db05a901a7602c86df93e' || $notification_id == '578060db901a7602c86df942' || $notification_id == '577f85da901a7602c86df941' || $notification_id == '56d8e1c115e994a4b3ef9492' || $notification_id == '56d8e1c115e994a4b3ef9493' || $notification_id == '56d8e1c115e994a4b3ef9495') {
           if(!$notification_id){
               $this->redirect('/notifications');
           }else{

               $result = $this->ResultGetusersofothernotification($notification_id);
               $list = ($result) ? $result->users : null;
           }

        } else if ($notification_id == '573189e9a677439ab683b679') {// pulse
            $url = Configure::read('api.api_url') . 'api/user/getnotifycationofuser';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );

            $body = array(
                "user_id" => CakeSession::read('Auth.User._id'),
                "notification_id" => "573189e9a677439ab683b679",
                "limit" => 100,
                "start" => 0,
                "time_zones" => CakeSession::read('time_zones')
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result->status == 'success') {
                if ($result->pulse_notifcation != '') {
                    $list = $result->pulse_notifcation;
                } else {
                    $list = '';
                }
            } else {
                $list = '';
            }
        } else {
            $result = $this->ResultGetNotification($notification_id);
            $list = ($result) ? $result->cars : null;
        }
        $this->set(compact('notification_id', 'list', 'cars_buying', 'cars_selling'));
    }

    public function index_notification() {
        $this->set('title_for_layout', 'Notifications');
        $this->layout = 'cz_home';
        $this->set(compact(''));
        //call api count num notification
        $url = Configure::read('api.api_url') . 'api/user/getothernotificationcountweb?user_id=' . CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        //debug($result);die();
        $this->set(compact('result'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->OtherNotification->exists($id)) {
            throw new NotFoundException(__('Invalid other notification'));
        }
        $options = array('conditions' => array('OtherNotification.' . $this->OtherNotification->primaryKey => $id));
        $this->set('otherNotification', $this->OtherNotification->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->OtherNotification->create();
            if ($this->OtherNotification->save($this->request->data)) {
                $this->Session->setFlash(__('The other notification has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The other notification could not be saved. Please, try again.'));
            }
        }
        $notifications = $this->OtherNotification->Notification->find('list');
        $users = $this->OtherNotification->User->find('list');
        $cars = $this->OtherNotification->Car->find('list');
        $senders = $this->OtherNotification->Sender->find('list');
        $this->set(compact('notifications', 'users', 'cars', 'senders'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->OtherNotification->exists($id)) {
            throw new NotFoundException(__('Invalid other notification'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->OtherNotification->save($this->request->data)) {
                $this->Session->setFlash(__('The other notification has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The other notification could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('OtherNotification.' . $this->OtherNotification->primaryKey => $id));
            $this->request->data = $this->OtherNotification->find('first', $options);
        }
        $notifications = $this->OtherNotification->Notification->find('list');
        $users = $this->OtherNotification->User->find('list');
        $cars = $this->OtherNotification->Car->find('list');
        $senders = $this->OtherNotification->Sender->find('list');
        $this->set(compact('notifications', 'users', 'cars', 'senders'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete() {
        $this->autoRender = false;
        if ($this->request->data) {
            $id = $this->request->data['id'];

            $url = Configure::read('api.api_url') . 'api/user/deleteothernotificationbyid';
            $header = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "arr_other_notification_id" => [$id]
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

    public function change_notify() {
        $this->autoRender = false;
        $this->layout = null;

        // call api
        $url = Configure::read('api.api_url') . 'api/user/changenotify';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'user_id' => $this->Session->read('Auth.User._id'),
            'value' => isset($this->request->data['value']) ? $this->request->data['value'] : '',
            'type' => isset($this->request->data['type']) ? $this->request->data['type'] : '',
            'notification_id' => isset($this->request->data['notification_id']) ? $this->request->data['notification_id'] : ''
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());

        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        } else {
            $data['error'] = 1;
        }

        return json_encode($data);
    }

    public function notification_setting() {
        $this->set('title_for_layout', 'Notifications');
        $this->layout = 'cz_home';

        // call api
        $url = Configure::read('api.api_url') . 'api/user/getnotificationsetting?user_id=' . $this->Session->read('Auth.User._id');
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());

        if ($result && isset($result->status) && $result->status == 'success') {
            $list = $result->notifications;
        } else {
            $list = null;
        }

        $this->set(compact(array('list')));
    }
    public function get_new_notify_ajax() {
        $this->autoRender = FALSE;
        $this->layout = null;
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getallnotifiofuser?user_id=' . CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:'. $this->Session->read('Auth.User.session_id'),
        );
        $body = array(
            'user_id' =>  CakeSession::read('Auth.User._id'),
            'time_zones' => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['list_notification'] = $result->list_notification;
            $data['count_notification'] = $result->count_notification;
        }
        else {
            $data['error'] = 1;
        }
        echo json_encode($data);
    }
    public function get_new_notify_ajax1() {
        $this->autoRender = FALSE;
        $this->layout = null;
        // call api
        $url = Configure::read('api.api_url') . 'api/user/getallnotifiofuser?user_id=' . CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:'. $this->Session->read('Auth.User.session_id'),
        );
        $body = array(
            'is_read' => 1,
            'user_id' =>  CakeSession::read('Auth.User._id'),
            'time_zones' => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
            $data['list_notification'] = $result->list_notification;
            $data['count_notification'] = $result->count_notification;
        }
        else {
            $data['error'] = 1;
        }
        echo json_encode($data);
    }
    public function readallnotification() {
        $this->autoRender = FALSE;
        $this->layout = null;
        // call api
        $url = Configure::read('api.api_url') . 'api/user/readallnotification?user_id=' . CakeSession::read('Auth.User._id');
        $header = array(
            'sessionid:'. $this->Session->read('Auth.User.session_id'),
        );
        $body = array(
            'user_id' =>  CakeSession::read('Auth.User._id'),
            'time_zones' => CakeSession::read('time_zones')
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }
        echo json_encode($data);
    }
    public function ajaxreadtypenotification(){
        $this->autoRender = FALSE;
        $this->layout = null;
        $is_read_notify = isset($this->request->data['is_read_notify']) && $this->request->data['is_read_notify'] ? $this->request->data['is_read_notify'] : '';
        //call api
        $url = Configure::read('api.api_url') . 'api/user/readtypenotification';
        $header = array(
            'userid:' . $this->Session->read('Auth.User._id'),
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "notification_id" => $is_read_notify
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $data['error'] = 0;
        }
        else {
            $data['error'] = 1;
        }

        echo json_encode($data);
    }
}
