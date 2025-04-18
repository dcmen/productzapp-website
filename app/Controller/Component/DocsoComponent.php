<?php
App::uses('Component', 'Controller');
class DocsoComponent extends Component {
    function doc3so($so){
        $achu = array ( " không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín " );
        $aso = array ( "0","1","2","3","4","5","6","7","8","9" );
        $kq = "";
        $tram = floor($so/100); // Hàng trăm
        $chuc = floor(($so/10)%10); // Hàng chục
        $donvi = floor(($so%10)); // Hàng đơn vị
        if($tram==0 && $chuc==0 && $donvi==0) $kq = "";
        if($tram!=0){
            $kq .= $achu[$tram] . " trăm ";
            if (($chuc == 0) && ($donvi != 0)) $kq .= " lẻ ";
        }
        if (($chuc != 0) && ($chuc != 1)){
            $kq .= $achu[$chuc] . " mươi";
            if (($chuc == 0) && ($donvi != 0)) $kq .= " linh ";
        }
        if ($chuc == 1) $kq .= " mười ";
        switch ($donvi){
            case 1:
            if (($chuc != 0) && ($chuc != 1)){
                $kq .= " mốt ";
            }else{
                $kq .= $achu[$donvi];
            }
            break;
            case 5:
            if ($chuc == 0){
                $kq .= $achu[$donvi];
            }else{
                $kq .= " lăm ";
            }
            break;
            default:
            if ($donvi != 0){
                $kq .= $achu[$donvi];
            }break;
        }
        if($kq=="")
        $kq=0;
        return $kq;
    }
    function chuyenso($number){
    $somoi = " Đồng chẵn";
    $donvi="";
    $tiente=array("nganty" => " nghìn tỷ ","ty" => " tỷ ","trieu" => " triệu ","ngan" =>" nghìn ","tram" => " trăm ");
    $num_f=$nombre_format_francais = number_format($number, 2, ',', ' ');
    $vitri=strpos($num_f,',');
    $num_cut=substr($num_f,0,$vitri);
    $mang=explode(" ",$num_cut);
    $sophantu=count($mang);
    switch($sophantu){
        case '5':
        $nganty=$this->doc3so($mang[0]);
        $text=$nganty;
        $ty=$this->doc3so($mang[1]);
        $trieu=$this->doc3so($mang[2]);
        $ngan=$this->doc3so($mang[3]);
        $tram=$this->doc3so($mang[4]);
        if((int)$mang[1]!=0){
            $text.=$tiente['ngan'];
            $text.=$ty.$tiente['ty'];
        }else{
            $text.=$tiente['nganty'];
        }
        if((int)$mang[2]!=0)
            $text.=$trieu.$tiente['trieu'];
        if((int)$mang[3]!=0)
            $text.=$ngan.$tiente['ngan'];
        if((int)$mang[4]!=0)
            $text.=$tram;
            $text.=$donvi;
        return ucfirst($text.$somoi);


        break;
        case '4':
            $ty= $this->doc3so($mang[0]);
            $text=$ty.$tiente['ty'];
            $trieu=$this->doc3so($mang[1]);
            $ngan=$this->doc3so($mang[2]);
            $tram=$this->doc3so($mang[3]);
            if((int)$mang[1]!=0)
                $text.=$trieu.$tiente['trieu'];
            if((int)$mang[2]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[3]!=0)
                $text.=$tram;
                $text.=$donvi;
            return ucfirst($text.$somoi);


        break;
        case '3':
            $trieu=$this->doc3so($mang[0]);
            $text=$trieu.$tiente['trieu'];
            $ngan=$this->doc3so($mang[1]);
            $tram=$this->doc3so($mang[2]);
            if((int)$mang[1]!=0)
                $text.=$ngan.$tiente['ngan'];
            if((int)$mang[2]!=0)
                $text.=$tram;
                $text.=$donvi;
            return ucfirst($text.$somoi);
            break;
        case '2':
            $ngan=$this->doc3so($mang[0]);
            $text=$ngan.$tiente['ngan'];
            $tram=$this->doc3so($mang[1]);
            if((int)$mang[1]!=0)
                $text.=$tram;
                $text.=$donvi;
            return ucfirst($text.$somoi);

        break;
        case '1':
            $tram=$this->doc3so($mang[0]);
            $text=$tram.$donvi;
            return ucfirst($text.$somoi);
            break;
        default:
            return "Xin lỗi số quá lớn không thể đổi được";
        break;
    }  
}
}
?>
