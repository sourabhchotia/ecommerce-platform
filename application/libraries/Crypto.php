<?php

	defined('BASEPATH') or exit('No Direct Script is allowed');
	error_reporting(0);
	/**
	 * 
	 */
	class Crypto
	{
		
		function __construct()
		{
			$this->_ci =& get_instance();
		}


		public function getChecksum($merchantID, $orderid, $amount, $redirectUrl, $workingKey){

			$str = $merchantID;
			$str .= "|". $orderid;
			$str .= "|". $amount;
			$str .= "|". $redirectUrl;
			$str .= "|". $workingKey;
			$adler = 1;
			$adler = $this->adler32($adler,$str);
			return $adler;
		}

		public function genChecksum($str){

			$adler = 1;
			$adler = $this->adler32($adler,$str);
			return $adler;

		}
		public function verifyChecksum($getCheck, $avnChecksum){

			$verify=false;
			if($getCheck==$avnChecksum) $verify=true;
			return $verify;

		}
		private function adler32($adler , $str){

			$BASE =  65521 ;
			$s1 = $adler & 0xffff ;
			$s2 = ($adler >> 16) & 0xffff;
			for($i = 0 ; $i < strlen($str) ; $i++){
				$s1 = ($s1 + Ord($str[$i])) % $BASE ;
				$s2 = ($s2 + $s1) % $BASE ;
			}
			return $this->leftshift($s2 , 16) + $s1;
		}
		private function leftshift($str , $num){

			$str = DecBin($str);
			for( $i = 0 ; $i < (64 - strlen($str)) ; $i++)
				$str = "0".$str ;
			for($i = 0 ; $i < $num ; $i++){
				$str = $str."0";
				$str = substr($str , 1 ) ;
			}
			return $this->cdec($str) ;
		}
		private function cdec($num){
			$dec=0;
			for ($n = 0 ; $n < strlen($num) ; $n++){
			   $temp = $num[$n] ;
			   $dec =  $dec + $temp*pow(2 , strlen($num) - $n - 1);
			}
			return $dec;
		}

		function encrypt($plainText,$key){
			$key = $this->hextobin(md5($key));
			$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
			$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
			$encryptedText = $this->hextobin($openMode);
			return $encryptedText;
		}


		function decrypt($encryptedText,$key){
			$key = $this->hextobin(md5($key));
			$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
			$encryptedText = $this->hextobin($encryptedText);
			$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
			return $decryptedText;
			
		}

		function hextobin($hexString) { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) {       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 

        	    if ($count==0){

					$binString=$packedString;

				}else{
					$binString.=$packedString;
		    	} 
		    	$count+=2; 
        	} 
  	        return $binString; 
    	}
	}