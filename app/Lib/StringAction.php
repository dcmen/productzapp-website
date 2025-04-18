<?php
class StringAction{
    public static function sayHello(){
        return "hahaha";
    }

    public static function create_barcode($code,$number, $length){
        $strlen = strlen($number);
        $arr    =    array();
        $diff    =    $length -  $strlen;
        // Push Leading Zeros
        while ( $diff>0 ){
            array_push( $arr,0 );
            $diff--;
        }
        // For PHP 4.x
        $arrNumber    =    array();
        for ($i = 0; $i < $strlen; $i++) {
            $arrNumber[] = substr($number,$i,1);
        }
        // For PHP 5.x: $arrNumber    =    str_split( $number );

        $arr        =    array_merge( $arr,$arrNumber );

        return $arr;
    }

    public static function barcode($code,$number, $length=8){
        // KH, KH00000, 8;
        $number = str_replace($code,'',$number);
        $arr =  self::create_barcode($code, $number, $length);
        $barcode =$code;
        foreach ($arr as $digit){
            $barcode .=$digit;
        };    
        return $barcode;
    }
    
    function find_barcode(){
        $barcode_temp = "0";
        $row = ClassRegistry::init('ClassToManager')->query("SELECT * FROM class_to_managers WHERE code = $barcode_temp");
        $barcode_old = ($row)?$row->barcode:$barcode_temp.'0';
        $barcode = vnit_barcode($barcode_temp,substr($barcode_old,6) + 1,4);
        return $barcode;
    }
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
    function doc2so($so){
        $somoi =explode('.',$so);
        if(count($somoi) == 2){
            $achu = array ( " không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín " );
            $aso = array ( "0","1","2","3","4","5","6","7","8","9" );
            $so1 = substr($somoi[1], 0,1); 
            $so2 = substr($somoi[1], 1,1); 
            if($so1 == 0 && $so2 == 0){
                return "";
            }else{
                if($so1 == 0){
                    $so11 = 'không';
                }else if($so1 == 1){
                    $so11 = 'mười';
                }else{
                    $so11 = str_replace($aso, $achu, $so1)." mươi";
                }
                $so22 = " ".str_replace($aso, $achu, $so2);
                return $somoi = " phảy ".$so11.$so22;
            }
        }else{
            return "";
        }
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
            $nganty=doc3so($mang[0]);
            $text=$nganty;
            $ty=doc3so($mang[1]);
            $trieu=doc3so($mang[2]);
            $ngan=doc3so($mang[3]);
            $tram=doc3so($mang[4]);
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
                $ty=doc3so($mang[0]);
                $text=$ty.$tiente['ty'];
                $trieu=doc3so($mang[1]);
                $ngan=doc3so($mang[2]);
                $tram=doc3so($mang[3]);
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
                $trieu=doc3so($mang[0]);
                $text=$trieu.$tiente['trieu'];
                $ngan=doc3so($mang[1]);
                $tram=doc3so($mang[2]);
                if((int)$mang[1]!=0)
                    $text.=$ngan.$tiente['ngan'];
                if((int)$mang[2]!=0)
                    $text.=$tram;
                    $text.=$donvi;
                return ucfirst($text.$somoi);
                break;
            case '2':
                $ngan=doc3so($mang[0]);
                $text=$ngan.$tiente['ngan'];
                $tram=doc3so($mang[1]);
                if((int)$mang[1]!=0)
                    $text.=$tram;
                    $text.=$donvi;
                return ucfirst($text.$somoi);

            break;
            case '1':
                $tram=doc3so($mang[0]);
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
