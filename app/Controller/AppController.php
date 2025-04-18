<?php
App::uses('Controller', 'Controller');

/**
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array(
        'Layout','Html','Form'
    );
    public $base_url;  
  
    public function beforeRender() {
        if ($this->response->statusCode() == '404') {
           return $this->redirect("/");
        }
    }
    
    public $components = array(
        'Session',
        'Auth' => array(
            //'loginRedirect' => array('controller' => 'pages', 'action' => 'home'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'index'),
            'authError' => 'Trang này không tồn tại.',
        ),
        'Cookie'
    );
  
    public function beforeFilter() {
        $this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
        $this->Cookie->httpOnly = true;
        if (!$this->Auth->loggedIn() && $this->Cookie->read('email') && $this->Cookie->read('password')) {
            $email = $this->Cookie->read('email');
            $pass = $this->Cookie->read('password');
            $this->loadModel('User');
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.email' => $email,
                    'User.encrypted_password' => $pass
                )
            ));
            if ($user && !$this->Auth->login($user)) {
                return $this->redirect('/logout'); // destroy session & cookie
            }
        }
       $this->Auth->allow(array('index'));
   }


}
