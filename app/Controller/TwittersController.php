<?php

if (!session_id()) {
    session_start();
}
$url = 'http://localhost/cakephp/Carzapp';
require_once ROOT . './app/Plugin/twitter/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

App::uses('AppController', 'Controller');
Configure::load('twitter');

class TwittersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('logintw', 'twcallback'));
    }

    function logintw() {
        $this->autoRender = false;
        $TWITTER_CONSUMER_KEY = "3BxVLxrEn80AKpRQhHX0izirk";
        $TWITTER_CONSUMER_SECRET = 'VMvmuJnVlvHKokugVSOK3RXh07YphOyOiue9WK4MuRI6kWeogg';
        //$TWITTER_OAUTH_CALLBACK = Configure::read('Twitter.OAUTH_CALLBACK');
        $TWITTER_OAUTH_CALLBACK = 'http://'.$_SERVER['SERVER_NAME'].Router::url(array('controller' => 'twitters', 'action' => 'twcallback'), false);
        
        $connection = new TwitterOAuth($TWITTER_CONSUMER_KEY, $TWITTER_CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $TWITTER_OAUTH_CALLBACK));
        
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        
        $this->redirect($url);
    }

    function twcallback() {
        if (isset($_REQUEST['denied'])) {
            $this->Session->write('email_rg', '');
            $this->Session->write('first_name_rg', '');
            $this->Session->write('last_name_rg', '');
            $this->Session->write('phone_rg', '');
            $this->Session->write('fb_picture', '');
            
            return $this->redirect("/sign_up");
        }
        else {
            $TWITTER_CONSUMER_KEY = "3BxVLxrEn80AKpRQhHX0izirk";
            $TWITTER_CONSUMER_SECRET = 'VMvmuJnVlvHKokugVSOK3RXh07YphOyOiue9WK4MuRI6kWeogg';

            $request_token = [];
            $request_token['oauth_token'] = $_REQUEST['oauth_token'];
            $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

            if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
                $this->Session->setFlash('Cannot sign up by Twitter!', 'flash_custom', array('type'=>1));
                return $this->redirect("/sign_up");
            }

            $connection = new TwitterOAuth($TWITTER_CONSUMER_KEY, $TWITTER_CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

            $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);

            $connection = new TwitterOAuth($TWITTER_CONSUMER_KEY, $TWITTER_CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

            $user = $connection->get("account/verify_credentials");

            if ($user) {
                if (isset($user->email) && $user->email) {
                    $this->Session->write('email_rg', $user->email);
                }
                else {
                    $this->Session->write('email_rg', '');
                }
                $this->Session->write('first_name_rg', $user->name);
                $this->Session->write('last_name_rg', '');
                if (isset($user->phone) && $user->phone) {
                    $this->Session->write('phone_rg', $user->phone);
                }
                else {
                    $this->Session->write('phone_rg', '');
                }
                $this->Session->write('fb_picture', $user->profile_image_url);
            }
            else {
                $this->Session->setFlash('Cannot sign up by Twitter!', 'flash_custom', array('type'=>1));
            }

            return $this->redirect("/sign_up");
        }
    }

}
