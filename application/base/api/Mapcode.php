<?php 
 
namespace app\base\api; 
 
class Mapcode { 
     
    public function qr($str,$size=5){ 
        $matrixPointSize = $size; 
        $errorCorrectionLevel = 'L'; 
        echo \lib\images\QRcode::png($str, false, $errorCorrectionLevel, $matrixPointSize, 2);
        die; 
    } 
     
    public function bar($code){ 
        $barcode = new \lib\images\BarCode128($code,$code,'A'); 
        $barcode->setUnitWidth(2); 
        $barcode->setFontType(10); 
        echo $barcode->createBarCode(); 
        die; 
    } 
} 
