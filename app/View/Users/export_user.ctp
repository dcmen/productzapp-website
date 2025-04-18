<?php 
/*
require_once '../Vendor/PHPExcel.php';
$objPHPExcel = new PHPExcel();
  $stylea1 = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 14,
        'name'  => 'Tahoma',
        'text-transform'  => 'uppercase',
    ),
    'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
);
$stylehead = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 10,
        'name'  => 'Tahoma',
        'border'  => '1px solid #ccc',
        'background' => array('rgb' => 'ebebeb')
    ),
    'fill'  => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('argb' =>'ededed')
    ),
    'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
         )
    ) 
);
$stylebody = array(
    'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
         )
    ) 
);
$style_center = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    )
);
$style_left = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
    )
);
$style_font_12 = array(
     'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 12,
        'name'  => 'Tahoma',
        'text-transform'  => 'uppercase',
    ),
);
$objPHPExcel = PHPExcel_IOFactory::load("../webroot/exports/mau/export_user.xlsx");
    
$i = 5;
$stt = 1;
foreach($list as $rs):
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $rs->carzapp_code)
                ->setCellValue('B'.$i, $rs->name)
                ->setCellValue('C'.$i, $rs->email)
                ->setCellValue('D'.$i, $rs->company_name)
                ->setCellValue('E'.$i, $rs->time_login)
                ->setCellValue('F'.$i, $rs->time_logout)
                ->setCellValue('G'.$i, $rs->created_at)
                ->setCellValue('H'.$i, ($rs->is_admin == 1)?1:'');


    $objPHPExcel->getActiveSheet(0)->getStyle('A'.$i.':H'.$i)->applyFromArray($stylebody);

$stt++;
$i++;

endforeach;
                                                           
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('../webroot/exports/export_user_'.time().'.xlsx');
$file = '../webroot/exports/export_user_'.time().'.xlsx';

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
    
ob_clean();
flush();
readfile($file);

exit;
 * 
 */
?>




