<?php

/**
 * Layout Helper
 *
 * PHP version 5
 *
 * @category Helper
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
App::uses('HtmlHelper', 'View/Helper');
class LayoutHelper extends AppHelper {

    /**
     * Other helpers used by this helper
     *
     * @var array
     * @access public
     */
    public $helpers = array(
        'Html',
        'Form',
        'Session',
        'Js',
    );
    function check_permission($permissions) {
        $lists = $this->Session->read('Auth.User.permission');
        //debug($lists); die();
        if (array_key_exists('System.admin', $lists))
            return true;

        if (is_array($permissions)) {
            //array_intersect_key => Trả về mảng có khóa trùng nhau
            //array_flip hoán đổi và lấy giá trị cuối nếu có nhiều phần tử cùng khoá
            $ret = array_intersect_key(array_flip($permissions), $lists);
            //pr($ret); die();
            if (empty($ret))
                return false;
            else
                return true;
        }
        else
        if (array_key_exists($permissions, $lists))
            return true;
        else
            return false;
    }

    public function check_group_permission($group) { // LIKE HeThong.*
        $ds = $this->Session->read('Auth.User.quyen');
        if (array_key_exists('HeThong.toanquyen', $ds))
            return true;

        foreach ($ds as $k => $v) {
            if (substr($k, 0, strpos('.', $k)) == $group)
                return true;
        }
        return false;
    }

    public function createLink($permission, $url, $title, $options) {
        if (!$this->check_permission($permission))
            return $this->Html->link($title, '/pages/denied', array('rel' => 'facebox_access_denied'));
        else
            return $this->Html->link($title, $url, $options);
    }
    function vnit_cut_string($value, $length){   
        if($value!=''){
        if(is_array($value)) list($string, $match_to) = $value;
        else { $string = $value; $match_to = $value{0}; }

        $match_start = stristr($string, $match_to);
        $match_compute = strlen($string) - strlen($match_start);

        if (strlen($string) > $length)
        {
            if ($match_compute < ($length - strlen($match_to)))
            {
                $pre_string = substr($string, 0, $length);
                $pos_end = strrpos($pre_string, " ");
                if($pos_end === false) $string = $pre_string."...";
                else $string = substr($pre_string, 0, $pos_end)."...";
            }
            else if ($match_compute > (strlen($string) - ($length - strlen($match_to))))
            {
                $pre_string = substr($string, (strlen($string) - ($length - strlen($match_to))));
                $pos_start = strpos($pre_string, " ");
                $string = "...".substr($pre_string, $pos_start);
                if($pos_start === false) $string = "...".$pre_string;
                else $string = "...".substr($pre_string, $pos_start);
            }
            else
            {       
                $pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
                $pos_start = strpos($pre_string, " "); $pos_end = strrpos($pre_string, " ");
                $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
                if($pos_start === false && $pos_end === false) $string = "...".$pre_string."...";
                else $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
            }

            $match_start = stristr($string, $match_to);
            $match_compute = strlen($string) - strlen($match_start);
        }
        
        return $string;
        }else{
            return $string ='';
        } 
    }
    
   
    
    function isNull($text){
        if ($text != '' && sizeof($text) > 0) {
                if ($text == 'null')
			return true;
		return false;
		}
	return true;
        }

}

?>
