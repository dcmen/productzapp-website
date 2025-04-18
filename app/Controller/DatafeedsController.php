<?php
	App::uses('AppController', 'Controller', 'Lib', 'Html');
	Configure::load('api');

	class DatafeedsController extends AppController {
		public $components = array('Curl', 'Paginator', 'RequestHandler', 'CurlApi');
		public $helpers = array(
	        'Layout',
	        'Html'
	    );

	    public function connect_datafeed() {
        	$this->layout = 'admintrator';
        	$this->set('title_for_layout', 'Datafeed');
        	$title = 'Datafeed';

        	$sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 0;
        	$limit = (isset($this->params['url']['limit'])) ? $this->params['url']['limit'] : 20;
        	if($sort == 0){
	            $u_sort = 1;
	            $i_sort = 0;
	        }else if($sort == 1){
	            $u_sort = 0;
	            $i_sort = 1;
	        }else if($sort == 2){
	            $u_sort = 3;
	            $i_sort = 0;
	        }else if($sort == 3){
	            $u_sort = 2;
	            $i_sort = 1;
	        }else if($sort == 4){
	            $u_sort = 5;
	            $i_sort = 0;
	        }else if($sort == 5){
	            $u_sort = 4;
	            $i_sort = 1;
	        }else{
	            $i_sort = 0;
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

	        $url = Configure::read('api.api_url').'api/user/getalldatafeeds';
	        $header = array(
	            'sessionid:'.CakeSession::read('Auth.User.session_id')
	        );
	        $body = array(
	            "limit" => $limit,
	            "start" => $start,
	            "type" => $sort
	        );
	        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
	        if ($result->status == 'success') {
	        	if ($result->datafeed != null) {
		        	$list = $result->datafeed;
		        	$total = $result->total;
		        	$maxpages = $this->Page($total, $limit);
		        }else{
		        	$list = null;
	                $maxpages = 0;
	                $total = 0;
		        }
	        }else {
	            $list = null;
	            $maxpages = 0;
	            $total = 0;
	        }

        	$this->set(compact('title','stt','sort','u_sort','i_sort','list','total','maxpages','limit','s_page'));
        	$this->render('admin_connect_datafeed');

        }

        public function show() {
        	$this->layout = 'admintrator';
        	$this->set('title_for_layout', 'Datafeed Details');
        	$title = 'Datafeed Details';

                //get parameter
                $type = (isset($this->params['url']['type'])) ? $this->params['url']['type'] : "";
                $ip = (isset($this->params['url']['ip'])) ? $this->params['url']['ip'] : "";
                $username = (isset($this->params['url']['username'])) ? $this->params['url']['username'] : "";
                $password = (isset($this->params['url']['password'])) ? $this->params['url']['password'] : "";
                // search and sort
                $keyword = (isset($this->params['url']['key'])) ? $this->params['url']['key'] : "";
                $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
                $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
                // pagination
                $page = (isset($this->params['url']['page']) && $this->params['url']['page']) ? $this->params['url']['page'] : 1;
                $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 20;
                $start = $limit * ($page - 1);

                // call api
                $url = Configure::read('api.api_url') . 'api/user/infooffiledatafeed';
                $header = array(
                    'sessionid:' . $this->Session->read('Auth.User.session_id')
                );
                $body = array(
                    "type_file" => $type,
	            "ftp_ip_address" => $ip,
	            "ftp_username" => $username,
	            "ftp_password" => $password
                );
                $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
                if ($result && isset($result->datafeed_info) && $result->datafeed_info) {
                    $list = $result->datafeed_info;
                } else {
                    $list = null;
                }

                $this->set(compact('list', 'title', 'keyword', 'fieldsort', 'sort', 'type', 'ip', 'username', 'password'));

        	$this->render('admin_datafeed_details');
        	
        }

        public function download_ftp() {
            $this->layout = null;
            $this->autoRender = false;
            // get params
            $file_name = (isset($this->params['url']['file_name']) && $this->params['url']['file_name'] != '') ?$this->params['url']['file_name'] : '';
            $ftp_ip_address = (isset($this->params['url']['ip']) && $this->params['url']['ip'] != '') ?$this->params['url']['ip'] : '';
            $ftp_username = (isset($this->params['url']['username']) && $this->params['url']['username'] != '') ?$this->params['url']['username'] : '';
            $ftp_password = (isset($this->params['url']['password']) && $this->params['url']['password'] != '') ?$this->params['url']['password'] : '';
            
            $url = Configure::read('api.api_url').'api/user/downloadfileofftp';
            $header = array(
                'sessionid:'.$this->Session->read('Auth.User.session_id')
            );
            $body = array(
                "file_name" => $file_name,
                "ftp_ip_address" => $ftp_ip_address,
                "ftp_username" => $ftp_username,
                "ftp_password" => $ftp_password
            );
            $result = json_decode($this->CurlApi->to($url)->withData( json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if($result->status  == 'success'){
                $file = $result->link;
            }else{
                $file = '';
            }
            return $this->redirect($file);
        }
        
        public function delete() {
        	$id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
        	$page = (isset($this->params['url']['page'])) ? $this->params['url']['page'] : '1';
        	$url = Configure::read('api.api_url').'api/user/removedatafeed';
	        $header = array(
	            'sessionid:'.CakeSession::read('Auth.User.session_id')
	        );
	        $body = array(
	            "datafeed_id" => $id
	        );
	        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
	        if ($result->status == 'success') {
	            $this->Session->setFlash('Deleted successfully');
	        } else {
	            $this->Session->setFlash('Deleted not successfully');
	        }
        	return $this->redirect('/connect_datafeed?page=' . $page);
        }
        public function delete_details(){
        	$id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
        	$parent_id = (isset($this->params['url']['parent_id'])) ? $this->params['url']['parent_id'] : '';
        	$page = (isset($this->params['url']['page'])) ? $this->params['url']['page'] : '1';
        	$url = Configure::read('api.api_url').'api/user/removedatafeed';
	        $header = array(
	            'sessionid:'.CakeSession::read('Auth.User.session_id')
	        );
	        $body = array(
	            "datafeed_id" => $id
	        );
	        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
	        if ($result->status == 'success') {
	            $this->Session->setFlash('Deleted successfully');
	        } else {
	            $this->Session->setFlash('Deleted not successfully');
	        }
        	return $this->redirect('/admin_datafeed_detail?page=' . $page.'&id='.$parent_id);
        }
        public function add() {
        	$this->layout = 'admintrator';
        	$this->set('title_for_layout', 'Add Datafeed');
        	$title = 'Add Datafeed';
        	
	        $this->set(compact('title'));
        }
        public function add_details(){
        	$this->layout = 'admintrator';
        	$this->set('title_for_layout', 'Add Datafeed Details');
        	$title = 'Add Datafeed Details';
        	$id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';

	        $this->set(compact('title','id'));
	        $this->render('add_datafeed_details');
        }
        public function store() {
        	$name = $this->request->data['name'];
        	$connection = $this->request->data['connection'];
            $email = $this->request->data['email'];
        	$method = "";
        	$filetype = $this->request->data['filetype'];
        	$ip = $this->request->data['ip'];
        	$username = $this->request->data['username'];
        	$password = $this->request->data['password'];

        	$url = Configure::read('api.api_url').'api/user/addoreditdatafeed';
	        $header = array(
	            'sessionid:'.CakeSession::read('Auth.User.session_id')
	        );
	        if($connection=='0'){
	        	$other = $this->request->data['other'];
		    	$body = array(
		            "name" => $name,
		            "connection" => $other,
		            "method" => $method,
		            "filetype" => $filetype,
                            "email" => $email,
                            "fpt_ip_address" => $ip,
                            "fpt_username" => $username,
                            "fpt_password" => $password
		        );
		        
		    }else{
		    	$body = array(
		            "name" => $name,
		            "connection" => $connection,
		            "method" => $method,
		            "filetype" => $filetype,
                            "email" => $email,
		            "fpt_ip_address" => $ip,
                            "fpt_username" => $username,
                            "fpt_password" => $password
		        );
		    }
	        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
	        if ($result->status == 'success') {
	            $this->Session->setFlash('Added successfully');
	        } else {
	            $this->Session->setFlash('Added not successfully');
	        }
        	return $this->redirect('/connect_datafeed');
        }

        public function store_details() {
        	$name = $this->request->data['name'];
        	$ip = $this->request->data['ip'];
        	$username = $this->request->data['username'];
        	$password = $this->request->data['password'];
        	$parent_id = $this->request->data['parent_id'];

        	$url = Configure::read('api.api_url').'api/user/addoreditdatafeeddetail';
	        $header = array(
	            'sessionid:'.CakeSession::read('Auth.User.session_id')
	        );

	    	$body = array(
	    		"datafeed_id" => $parent_id,
	            "name" => $name,
	            "ftp_parameters" => $ip.' / '.$username.' / '.$password
	        );
		        
	        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
	        if ($result->status == 'success') {
	            $this->Session->setFlash('Added successfully');
	        } else {
	            $this->Session->setFlash('Added not successfully');
	        }
        	return $this->redirect('/admin_datafeed_detail?id='.$parent_id);
        }

        public function edit() {
        	$this->layout = 'admintrator';
        	$this->set('title_for_layout', 'Edit Datafeed');
        	$title = 'Edit Datafeed';
        	$id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
        	$url = Configure::read('api.api_url') . 'api/user/getdatafeeddetail?datafeed_id=' . $id;
	        $header = array(
	            'sessionid:' . $this->Session->read('Auth.User.session_id')
	        );       
	        $rs = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
	        if(strtoupper($rs->datafeed->connection)!='API'&&strtoupper($rs->datafeed->connection)!='FTP'){
	        	$other=$rs->datafeed->connection;
	        }
	        if($rs->status=='success'){
	        	$this->set(compact('rs','title','other'));
	        }
        }

        public function edit_details(){
        	$this->layout = 'admintrator';
        	$this->set('title_for_layout', 'Edit Datafeed Details');
        	$title = 'Edit Datafeed Details';
        	$id = (isset($this->params['url']['id'])) ? $this->params['url']['id'] : '';
        	$parent_id = (isset($this->params['url']['parent_id'])) ? $this->params['url']['parent_id'] : '';
        	$url = Configure::read('api.api_url') . 'api/user/getdatafeeddetail?datafeed_id=' . $id;
	        $header = array(
	            'sessionid:' . $this->Session->read('Auth.User.session_id')
	        );       
	        $rs = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
	        if($rs->status=='success'){
	        	$rs=$rs->datafeed;
	        	$this->set(compact('rs','title','parent_id','id'));

	        }
	        $this->render('edit_datafeed_details');
        }

        public function update() {
        	$id = $this->request->data['id'];
        	$name = $this->request->data['name'];
                $email = $this->request->data['email'];
        	$connection = $this->request->data['connection'];
        	$method = "";
        	$filetype = $this->request->data['filetype'];
        	$ip = $this->request->data['ip'];
        	$username = $this->request->data['username'];
        	$password = $this->request->data['password'];

        	$url = Configure::read('api.api_url').'api/user/addoreditdatafeed';
	        $header = array(
	            'sessionid:'.CakeSession::read('Auth.User.session_id')
	        );
	        if($connection=='0'){
	        	$other = $this->request->data['other'];
		    	$body = array(
		            "datafeed_id" => $id,
		            "name" => $name,
		            "connection" => $other,
		            "method" => $method,
		            "filetype" => $filetype,
                            "email" => $email,
		            "fpt_ip_address" => $ip,
                            "fpt_username" => $username,
                            "fpt_password" => $password
		        );
		        
		    }else{
		    	$body = array(
		            "datafeed_id" => $id,
		            "name" => $name,
		            "connection" => $connection,
		            "method" => $method,
		            "filetype" => $filetype,
                            "email" => $email,
		            "fpt_ip_address" => $ip,
                            "fpt_username" => $username,
                            "fpt_password" => $password
		        );
		    }
	        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
	        if ($result->status == 'success') {
	            $this->Session->setFlash('Updated successfully');
	        } else {
	            $this->Session->setFlash('Updated not successfully');
	        }
        	return $this->redirect('/connect_datafeed');
        }
        public function update_details() {
        	$name = $this->request->data['name'];
        	$ip = $this->request->data['ip'];
        	$username = $this->request->data['username'];
        	$password = $this->request->data['password'];
        	$parent_id = $this->request->data['parent_id'];
        	$id = $this->request->data['id'];

        	$url = Configure::read('api.api_url').'api/user/addoreditdatafeeddetail';
	        $header = array(
	            'sessionid:'.CakeSession::read('Auth.User.session_id')
	        );

	    	$body = array(
	    		"datafeed_detail_id" => $id,
	    		"datafeed_id" => $parent_id,
	            "name" => $name,
	            "ftp_parameters" => $ip.' / '.$username.' / '.$password
	        );
		        
	        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
	        if ($result->status == 'success') {
	            $this->Session->setFlash('Updated successfully');
	        } else {
	            $this->Session->setFlash('Updated not successfully');
	        }
        	return $this->redirect('/admin_datafeed_detail?id='.$parent_id);
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
	}
?>