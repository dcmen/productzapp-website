<?php
App::uses('Component', 'Controller');
class UtilComponent extends Component {
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
