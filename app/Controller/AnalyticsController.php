<?php

Configure::load('api');
require_once(ROOT.DS.'app'.DS.'Vendor'.DS.'Spout'.DS.'Autoloader'.DS.'autoload.php'); 
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
class AnalyticsController extends AppController {
    public $components = array('Paginator','Curl','CurlApi');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('test','ajaxlogin', 'admin_login','activate_device_code'));
    }
    //Analytics
    public function analytic() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Analytic');
        $title = 'Analytic';
        //call api getallanalyticscarzapp
        $url1 = Configure::read('api.api_url') . 'api/user/getallanalyticscarzapp';
        $header1 = array(
            'sessionid:' .$this->Session->read('Auth.User.session_id')
        );
        $result1 = json_decode($this->CurlApi->to($url1)->withOption('HTTPHEADER', $header1)->get());
       //call api getanalyticscarzapp
        $url = Configure::read('api.api_url') . 'api/user/getanalyticscarzapp';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $date1 = new DateTime();
        $current_time = $date1->format('Y-m-d');

        $strtime = strtotime($current_time)-(86400*15);
        $date_sup_of_current = date('Y-m-d',$strtime);
        $body = array(
            'platform' => 'all',
            'version' => 'all',
            'day_from' => $date_sup_of_current,
            'day_to' => $current_time,
            'time_zones' => CakeSession::read('time_zones'),
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($body);debug($result);die();
        if ($result->status == 'success') {
            $data['newuser_count'] = $result->newuser_count;
            $data['session_count'] = $result->session_count;
            $data['screent_div_session_count'] = $result->screent_div_session_count;
            $data['analytics_screent_view'] = $result->analytics_screent_view;
            $data['analytics_screent_view_first'] = $result->analytics_screent_view[0];
            $date1 = $result->day_from;

        }
        //debug( $data['analytics_screent_view']); die();

        $this->set(compact('newuser_count', 'result1','data','date1'));

    }

    public function getallanalytic(){
        $this->autoRender = false;
        $this->layout = null;
        if($this->request->data) {
            $platform = isset($this->request->data['platform']) && $this->request->data['platform'] ? $this->request->data['platform'] : '';
            $version = isset($this->request->data['version']) && $this->request->data['version'] ? $this->request->data['version'] : '';
            $day_from = isset($this->request->data['day_from']) && $this->request->data['day_from'] ? $this->request->data['day_from'] : '';
            $day_to = isset($this->request->data['day_to']) && $this->request->data['day_to'] ? $this->request->data['day_to'] : '';
            // call api get analytics carzapp
            $url = Configure::read('api.api_url') . 'api/user/getanalyticscarzapp';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'platform' => $platform,
                'version' => $version,
                'day_from' => $day_from,
                'day_to' => $day_to,
                'time_zones' => CakeSession::read('time_zones'),
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            //debug($body);debug($result);die();
            if ($result->status == 'success') {
                $data['newuser_count'] = $result->newuser_count;
                $data['session_count'] = $result->session_count;
                $data['screent_div_session_count'] = $result->screent_div_session_count;
                $data['analytics_screent_view'] = $result->analytics_screent_view;
                $data['analytics_screent_view_first'] = $result->analytics_screent_view[0];
                $data['error'] = 0;
               //debug($data['session_count']);die();
                //debug($data['screent_div_session_count']);die();

            } else {
                $data['error'] = 1;
            }
            return json_encode($data);
        }
    }
    function createanalyticssession(){
        $this->autoRender = false;
        $this->layout = null;
        $data['error'] = 1;
        if($this->request->data) {
            $browsername = isset($this->request->data['browsername']) && $this->request->data['browsername'] ? $this->request->data['browsername'] : '';
            $client_ip = isset($this->request->data['client_ip']) && $this->request->data['client_ip'] ? $this->request->data['client_ip'] : '';
            $url_3 = Configure::read('api.api_url') . 'api/user/createanalyticssession';
            $header_3 = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body_3 = array(
                'new_session' => array(
                    "device_id" => "",
                    "user_id" => $this->Session->read('Auth.User._id'),
                    "os_type" => 3,
                    "version" => "1.2.2.0",
                    "browser_name"=>$browsername,
                    "client_ip"=>$client_ip
                ),
                'update_session' => ''
            );
            $result_analytic = json_decode($this->CurlApi->to($url_3)->withData(json_encode($body_3))->withOption('HTTPHEADER', $header_3)->post());
            //  debug($body_3); debug($url_3); debug($result_analytic);die();
            if ($result_analytic->status == 'success') {
                $this->Session->write('new_analytics_session_id', $result_analytic->new_analytics_session_id);
                $data['new_analytics_session_id'] = $result_analytic->new_analytics_session_id;
                $data['error'] = 0;

            } else {
                $data['error'] = 1;
            }
        }
        return json_encode($data);
    }
    function autoupdateanalyticsession(){
        $this->autoRender = false;
        $this->layout = null;
        $data['error'] = 1;
        if($this->request->data) {
            $analytics_session_id = isset($this->request->data['analytics_session_id']) && $this->request->data['analytics_session_id'] ? $this->request->data['analytics_session_id'] : '';
            $url_3 = Configure::read('api.api_url') . 'api/user/updateautoanalyticstimeclosesession';
            $header_3 = array(
                'userid:' . $this->Session->read('Auth.User._id'),
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body_3 = array(
                'analytics_session_id' => $analytics_session_id
            );
            $result_analytic = json_decode($this->CurlApi->to($url_3)->withData(json_encode($body_3))->withOption('HTTPHEADER', $header_3)->post());
            //debug($body_3); debug($url_3); debug($result_analytic);die();
            if ($result_analytic->status == 'success') {
                $data['error'] = 0;

            } else {
                $data['error'] = 1;
            }
        }
        return json_encode($data);
    }

}
