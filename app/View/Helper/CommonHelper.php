<?php

class CommonHelper extends AppHelper {
    
    public function getUrlWithoutParams() {
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        return 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
    }
    
    public function createLink($parameters, $linkBase) {
        $str = '';
        foreach ($parameters as $key => $value) {
            $str .= $key . '=' . $value . '&';
        }
        $str = trim($str, '&');
        
        return trim($linkBase, '?') . '?' . $str;
    }


    public function paging($totalpages, $curpage, $params = array(), $reparams = array()) {
        $url = $this->getUrlWithoutParams();

        $strQuery = '';
        // get current parameters
        foreach($_GET as $key => $value){
            if ($key != 'page' && $key != 'totalpage' && !in_array($key, $reparams)) {
                $strQuery .= '&' . $key . '=' . $value;
            }
        }
        // add more parameters 
        foreach($params as $key => $value){
            $strQuery .= '&' . $key . '=' . $value;
        }
        
        $url .= '?a=0' . $strQuery;

        if ($totalpages <= 1) {
            return '';
        }

        $paging = '<div class=kb-pagination><ul class="pagination">';
        if ($totalpages > 5) {
            if ($curpage != 1) {
                $paging .= '<li><a href="' . $url . '&totalpage=' . $totalpages . '&page=' . 1 . '">&laquo;</a></li>';
            } else {
                $paging .= '<li><a>&laquo;</a></li>';
            }
        }
        $pagesstart = ceil($curpage - 2);
        $pagesend = ceil($curpage + 2);
        if ($pagesstart <= 0) {
            $pagesend += - $pagesstart + 1;
        } else if ($pagesend > $totalpages) {
            $pagesstart += - $pagesend + $totalpages;
        }
        for ($i = 1; $i <= $totalpages; $i++) {
            if ($pagesstart <= $i && $pagesend >= $i) {
                if ($i == $curpage) {
                    $paging .= '<li class="active"><a>' . $i . '</a></li>';
                } else {
                    $paging .= '<li><a href="' . $url . '&totalpage=' . $totalpages . '&page=' . $i . '">' . $i . '</a></li>';
                }
            }
        }
        if ($totalpages > 5) {
            if ($curpage != $totalpages) {
                $paging .= '<li><a href="' . $url . '&totalpage=' . $totalpages . '&page=' . $totalpages . '" title="Last">&raquo;</a></li>';
            } else {
                $paging .= '<li><a>&raquo;</a></li>';
            }
        }
        $paging .= '</ul></div>';

        return $paging;
    }

}

?>
