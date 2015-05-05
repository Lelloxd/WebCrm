<?php
   function decryptRJ256($key,$iv,$string_to_decrypt)
{
    $string_to_decrypt = base64_decode($string_to_decrypt);
    $rtn = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $string_to_decrypt, MCRYPT_MODE_CBC, $iv);
    //$rtn = rtrim($rtn, "\0\4");
    $rtn = unpad($rtn);
    return($rtn);
}

function unpad($value)
{
    $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
    //apply pkcs7 padding removal
    $packing = ord($value[strlen($value) - 1]);
    if($packing && $packing < $blockSize){
        for($P = strlen($value) - 1; $P >= strlen($value) - $packing; $P--){
            if(ord($value{$P}) != $packing){
                $packing = 0;
            }//end if
        }//end for
    }//end if 

    return substr($value, 0, strlen($value) - $packing); 
}

$ky = 'lkirwf897+22#bbtrm8814z5qq=498j5'; // 32 * 8 = 256 bit key
$iv = '741952hheeyy66#cs!9hjv887mxx7@8y'; // 32 * 8 = 256 bit iv

$enc = "43ufJxM5z/dtORppoEoPJA==";

$dtext = decryptRJ256($ky, $iv, $enc);
var_dump($dtext);
	?>