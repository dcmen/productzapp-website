<?php

App::uses('AppController', 'Controller', 'Lib','Html');
Configure::load('api');
class EmailContentsController extends AppController {

    public $components = array('Curl', 'RequestHandler','CurlApi');
    public $helpers = array(
        'Layout',
        'Html'
    );
    
    public function list_email() {
        $this->layout = 'admintrator';
        $this->set('title_for_layout', 'Manage Email Content');
        //$title = 'Manage Email Content';
        // get params
        $keyword = (isset($this->params['url']['key']) && $this->params['url']['key']) ? $this->params['url']['key'] : '';
        $keyword=trim($keyword);
        $fieldsort = (isset($this->params['url']['fieldsort']) && $this->params['url']['fieldsort'] != '') ? $this->params['url']['fieldsort'] : '';
        $sort = (isset($this->params['url']['sort']) && $this->params['url']['sort'] != '') ? $this->params['url']['sort'] : 'desc';
        // pagination
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 10;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $start = $limit * ($page - 1);
        // call api
        $url = Configure::read('api.api_url').'api/user/getlistemailcontent';
        $header = array(
            'sessionid:'.$this->Session->read('Auth.User.session_id')
        );
        $body = array(
            "limit" => $limit,
            "start" => $start,
            "keyword" => $keyword
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($header); debug($result); die();
        if ($result != null && isset($result->list_email_content) && $result->list_email_content != null) {
            $list = $result->list_email_content;
            $total = $result->total;
            $maxpages = $this->Page($total, $limit);
        } else {
            $list = null;
            $total = 0;
            $maxpages = 0;
        }

        $this->set(compact('list', 'total', 'maxpages', 'limit', 'page', 'keyword', 'fieldsort', 'sort'));
    }
    
    public function add_email() {
        if($this->request->data){
            // call api
            $url = Configure::read('api.api_url').'api/user/addoreditemailcontent';
            $header = array(
                'sessionid:' . $this->Session->read('Auth.User.session_id')
            );
            $body = array(
                'key' => $this->request->data['key'],
                'name' => $this->request->data['name'],
                'subject' => $this->request->data['subject'],
                'content' => $this->request->data['content']
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result && isset($result->status) && $result->status == 'success') {
                $this->Session->setFlash('Added successfully');
            } else {
                $this->Session->setFlash('Failure' , 'default', ['class' => 'error']);
            }
            
            return $this->redirect('/emailcontents/list_email');
        }
        else {
            $this->layout = 'admintrator';
            $this->autoRender = FALSE;
            $this->set('title_for_layout', 'Add Email');
            
            $rs = null;
            $this->set(compact('rs'));
            
            $this->render('add_edit_email');
        }
    }
    
    public function edit_email($id) {
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        
        if($this->request->data){
            // call api
            $url = Configure::read('api.api_url').'api/user/addoreditemailcontent';
            $body = array(
                'email_content_id' => $this->request->data['id'],
                'key' => $this->request->data['key'],
                'name' => $this->request->data['name'],
                'subject' => $this->request->data['subject'],
                'content' => $this->request->data['content']
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
            if ($result && isset($result->status) && $result->status == 'success') {
                $this->Session->setFlash('Updated successfully');
            } else {
                $this->Session->setFlash('Failure');
            }
        }
        
        $this->layout = 'admintrator';
        $this->autoRender = FALSE;
        $this->set('title_for_layout', 'Edit Email');

        // call api
        $url = Configure::read('api.api_url').'api/user/getemailcontent';
        $body = array(
            "id" => $id
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        //debug($result); die();
        if ($result != null && isset($result->email_content) && $result->email_content != null) {
            $rs = $result->email_content;
        } else {
            $rs = null;
        }
        $this->set(compact('rs'));

        $this->render('add_edit_email');
    }
    
    public function delete_email() {
        // get parameter
        $keyword = (isset($this->params['url']['keyword']) && $this->params['url']['keyword']) ? $this->params['url']['keyword'] : '';
        $limit = (isset($this->params['url']['limit']) && $this->params['url']['limit']) ? $this->params['url']['limit'] : 10;
        $page = (isset($this->params['url']['page']) && $this->params['url']['page'])? $this->params['url']['page'] : 1;
        $id = (isset($this->params['url']['id']) && $this->params['url']['id'])? $this->params['url']['id'] : '';
        
        // call api
        $url = Configure::read('api.api_url').'api/user/deleteemailcontent';
        $header = array(
            'sessionid:' . $this->Session->read('Auth.User.session_id')
        );
        $body = array(
            'email_content_id' => $id
        );
        $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER', $header)->post());
        if ($result && isset($result->status) && $result->status == 'success') {
            $this->Session->setFlash('Deleted successfully');
        } else {
            $this->Session->setFlash('Failure');
        }

        return $this->redirect('/emailcontents/list_email?page='.$page.'&limit='.$limit.'&keyword='.$keyword);
    }
    //setting email send for tender
    public function email_send_tender() {
        $this->layout = 'cz_home';
        $this->set('title_for_layout', 'Email send tender');
        //call api
        $url = Configure::read('api.api_url').'api/user/getcontentemailoftender?company_id='.CakeSession::read('Auth.User.company_id');
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );
        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if($result->status == 'success'){
            $list = $result->list_content_mail;
        }
        $this->set(compact(array('list')));
        $this->render('email_send_tender');

    }
    public function edit_email_send_tender($id){
        $this->layout = 'cz_home';
        //call api
        $url = Configure::read('api.api_url').'api/user/getcontentemailoftenderdetail?id='.$id;
        $header = array(
            'sessionid:' . CakeSession::read('Auth.User.session_id')
        );

        $result = json_decode($this->CurlApi->to($url)->withOption('HTTPHEADER', $header)->get());
        if ($result != null && isset($result->content_mail) && $result->content_mail != null) {
            $rs = $result->content_mail;
            $this->set('title_for_layout', $rs->name);
        } else {
            $rs = null;
            $this->set('title_for_layout','Email send tender');
        }
        $this->set(compact('rs'));
        $this->render('edit_email_send_tender');
    }
    public function save_email_send_tender(){
        $this->layout = null;
        $this->autoRender = FALSE;
        if($this->request->data){
            //get params
            $key = isset($this->request->data['key']) && $this->request->data['key'] ? $this->request->data['key'] : '';
            $subject = isset($this->request->data['subject']) && $this->request->data['subject'] ? $this->request->data['subject'] : '';
            $content = isset($this->request->data['content']) && $this->request->data['content'] ? $this->request->data['content'] : '';
            //call api update email content
            $url =Configure::read('api.api_url').'api/user/settingcontentmailoftender';
            $header = array(
                'sessionid:' .CakeSession::read('Auth.User.session_id'),
            );
            $body = array(
                'company_id' => CakeSession::read('Auth.User.company_id'),
                'key' => $key,
                'content' => $content,
                'subject' => $subject
            );
            $result = json_decode($this->CurlApi->to($url)->withData(json_encode($body))->withOption('HTTPHEADER',$header)->post());
            if($result->status == 'success'){
                if ($result->status == "success") {
                    $data['error'] = 0;
                    debug($data);die(json_encode($data));die();

                } else {
                    $data['error'] = 1;
                }
            } else {
                $data['error'] = 1;
            }
            return json_encode($data);
        }
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

