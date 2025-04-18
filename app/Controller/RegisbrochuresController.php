<?php
App::uses('AppController', 'Controller');
Configure::load('api');
class RegisbrochuresController extends AppController {
    public $components = array('Paginator','CurlApi');
    public function index() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout','Downloaded Brochure');
        $key = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : '';
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ? $this->params['url']['limit'] : 20;
        
        if($sort == 'desc'){
            $u_sort = 'asc';
        }else{
            $u_sort = 'desc';
        }
        if(empty($this->params['url']['ajax'])){
            $ajax = 1;
        }else{
            $ajax = 0;
        }
        if(isset($this->params['url']['page'])){
            $page = $this->params['url']['page'];
            $s_page = $this->params['url']['page'];
        }else{
            $page = 0;
            $s_page = 1;
        }
       
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);
        
        $url = Configure::read('api.api_url').'api/user/getregisbrochureadmin';
        $header = array(
            'sessionid:'.CakeSession::read('Auth.User.session_id')
        );

        $body = array(
            "user_id" => CakeSession::read('Auth.User._id'),
            "keyword" => $key,
            "start" => $start,
            "limit" => $limit,
            "fieldsort" => $fieldsort,
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
            }else{
                $list = '';
                $maxpages = 0;
            }
            
        }else{
            $list = '';
            $maxpages = 0;
            $total = 0;
        }
        $this->set(compact(array('list','maxpages','total','limit','key','start','s_page','fieldsort','u_sort','sort')));

    }

    public function result_search(){
        $this->layout = 'admintrator';
        $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ?$this->params['url']['key'] : '';
        $date_from = (isset($this->params['url']['date_from']) && $this->params['url']['date_from'] != '') ? date('Y-m-d H:i:s', strtotime($this->params['url']['date_from'])) : '';
        $date_to = (isset($this->params['url']['date_to']) && $this->params['url']['date_to'] != '') ? date('Y-m-d H:i:s', strtotime($this->params['url']['date_to'])) : '';
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit'] != '') ?$this->params['url']['limit'] : 20;
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
      
        if($sort == 'desc'){
            $u_sort = 'asc';
        }else{
            $u_sort = 'desc';
        }
        if(isset($this->params['url']['page'])){
            $page = $this->params['url']['page'];
            $s_page = $this->params['url']['page'];
        }else{
            $page = 0;
            $s_page = 1;
        }
        $start = ($page == '' || $page == 1) ? 0 : $limit * ($page - 1);  
        $url = Configure::read('api.api_url').'api/user/searchregisbrochureadmin';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "key" => $key,
            "date_from" => $date_from,
            "date_to" => $date_to,
            "start" => $start,
            "limit" => $limit,
            "fieldsort" => $fieldsort,
            "sort" => $sort
        );

        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($url); debug(json_encode($body)); debug($result); die();
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
        $this->set(compact('key','date_from','date_to','list','total','maxpages','s_page','limit','start','sort','u_sort','fieldsort'));

    }
    function export_brochures(){
        $this->autoRender = FALSE;
        $key = (isset($this->params['url']['key']) && $this->params['url']['key'] != '') ?$this->params['url']['key'] : '';
        $date_from = (isset($this->params['url']['date_from']) && $this->params['url']['date_from'] != '') ? date('Y-m-d H:i:s', strtotime($this->params['url']['date_from'])) : '';
        $date_to = (isset($this->params['url']['date_to']) && $this->params['url']['date_to'] != '') ? date('Y-m-d H:i:s', strtotime($this->params['url']['date_to'])) : '';
        $limit = 200;
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        $url = Configure::read('api.api_url').'api/user/exportregisbrochureadmin';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "key" => $key,
            "date_from" => $date_from,
            "date_to" => $date_to,
            "start" => 0,
            "limit" => $limit,
            "fieldsort" => $fieldsort,
            "sort" => $sort
        );
        $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if($result->status  == 'success'){
            $file = $result->url_excel;
        }else{
            $file = '';
        }
        return $this->redirect($file);
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
}
