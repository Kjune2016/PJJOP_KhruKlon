<?php
error_reporting(E_ALL & ~E_NOTICE);
function process($arrKlonWord,$arrKlonPayang,$arrKlonPhonemes,$arrKlonTone){
	print_r($arrKlonWord);
	echo "<br><br>";
	print_r($arrKlonPayang);
	echo "<br><br>";
	print_r($arrKlonPhonemes);
	echo "<br><br>";
	print_r($arrKlonTone);
	echo "<br>";
}

function splitWak($klon){
  $arrWak = (explode("/w", $klon));
  return ($arrWak);
}
//$a = splitWak($klon);
//print_r ($a);


/*function addValueToArray($json,$arr,$value){
	$data = json_decode($json,true);
	#$arr = array();
	#print_r($data);
	foreach ($data as $key => $val) {
		if(is_array($val)) {
			#print_r($val);
			#echo $val['word'];
			array_push($arr,$val[$value]);
    	}else {
    		echo "$key => $val\n";
    	}
    }
    #print_r($arr);
    return $arr;
}*/

function addValueToArray($arrWak,$jsonWak,$arr,$value){
	$arrKlonWord = [];
	$arrKlonPayang = [];
	$arrKlonPhonemes = [];
	if($value == 'word'){
		//echo count($arrWak)."<br>";
		for($i=0 ; $i<count($arrWak)-1 ; $i++){
			$arrWord = [];
			//echo "<br>".$jsonWak[$i]."<br>";
			$deJsonWak = json_decode($jsonWak[$i],true);
			//print_r ($deJsonWak);
			if(is_array($deJsonWak)){
				foreach($deJsonWak as $key=>$val) {
					array_push($arrWord,$val[$value]);
		    }
			}
	    for($c=0 ; $c<count($arrWord) ; $c++){
	        $arrKlonWord[$i][$c] = $arrWord[$c];
	    }
	  }
	  return ($arrKlonWord);
	}
	else if($value == 'payang'){
		for($i=0 ; $i<count($arrWak)-1 ;$i++){ // วนเท่ากับจำนวนวรรค
		  $arrBePayang = [];
		  $arrPayang = [];
		  $str = "";
		  $str2 = "";
		  $deJsonWak = (array)json_decode($jsonWak[$i], true); // ทำทีละวรรค
			if(is_array($deJsonWak)){
				foreach ($deJsonWak as $key=>$val) {
			    	array_push($arrBePayang,$val[$value]);
			  }
			  //echo "<br>===============<br>";
			  //print_r ($arrBePayang);
			  //echo "<br>==================================<br>";
			}
		  for($k=0 ; $k<count($arrBePayang) ; $k++){
		    $str = ($str)." ".($arrBePayang[$k]);
		    $str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
		    $arrPayang = (explode(" ",$str2));
		  }
		  for($c=0 ; $c<count($arrPayang) ; $c++){
		    $arrKlonPayang[$i][$c] = $arrPayang[$c];
		  }
		}
		return ($arrKlonPayang);
	}
	else if($value == 'phonemes'){
		for($i=0 ; $i<count($arrWak)-1 ;$i++){
			$arrBePhonemes = [];
			$arrPhonemes = [];
			$arrTone = [];
			$string = "";
			$string2 = "";
			$str = "";
			$str2 = "";
			$arrPhonemesAndTone = [];
			$deJsonWak = json_decode($jsonWak[$i], true); // ทำทีละวรรค
			//print_r ($deJsonWak);
			//echo "<br>";
			//echo "<br>==================================<br>";
			if(is_array($deJsonWak)){
				foreach ($deJsonWak as $key=>$val) {
					//echo $value['word']." ";
					$string = $val['payang'];
					//echo $str." "."<br>";
					$string2 = $val['word'];
					//echo $str2." ";
					if(stristr($string2,"ะ")){
						array_push($arrBePhonemes,$val['phonemes']);
					}
					else {
						if(stristr($string,"ะ-ห")){
							//echo "<br>".$str2."1"." ";
							$val['phonemes'] = substr($val['phonemes'],6);
							array_push($arrBePhonemes,$val['phonemes']);
							//echo $value['phonemes'];
						}
						else if(stristr($string,"ผะ-อ")){
							//echo "<br>".$str2."1"." ";
							$val['phonemes'] = substr($val['phonemes'],6);
							array_push($arrBePhonemes,$val['phonemes']);
							//echo $value['phonemes'];
						}
						else if(stristr($string,"สะ-บ")){
							//echo "<br>".$str2."1"." ";
							$val['phonemes'] = substr($val['phonemes'],6);
							array_push($arrBePhonemes,$val['phonemes']);
							//echo $value['phonemes'];
						}
						else{
							array_push($arrBePhonemes,$val['phonemes']);
						}
					}
				}
			}
			//print_r ($arrBePhonemes);
			for($k=0 ; $k<count($arrBePhonemes) ; $k++){
				$str = ($str)." ".($arrBePhonemes[$k]);
				$str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
				$arrPhonemesAndTone = (explode(" ",$str2));
			}
			//print_r ($arrBePhonemes);
			//echo "<br>...............................................<br>";
			for($c=0 ; $c<count($arrPhonemesAndTone) ; $c++){
		    $str3 = $arrPhonemesAndTone[$c];
		    $arrTone[$c] = (explode("^",$str3));
		  }
		}
			return ($arrTone);
	}
}

function addPhonemes($arrWak,$arrTone){
// กลอนแบบเสียงวรรณยุกต์ แยกกับ พยางค์แบบสัทอักษร
	for($i=0 ; $i<count($arrWak)-1 ;$i++){
		for($c=0 ; $c<count($arrTone) ; $c++){
			$arrKlonPhonemes[$i][$c] = $arrTone[$c][0];
		}
	}
	return ($arrKlonPhonemes);
}

function addTone($arrWak,$arrTone){
// กลอนแบบเสียงวรรณยุกต์ แยกกับ พยางค์แบบสัทอักษร
	for($i=0 ; $i<count($arrWak)-1 ;$i++){
		for($c=0 ; $c<count($arrTone) ; $c++){
			$arrKlonTone[$i][$c] = $arrTone[$c][1];
		}
	}
	return ($arrKlonTone);
}


function readTxt($txt){
	$myfile = fopen($txt, "r") or die("Unable to open file!");
	$str = fgets($myfile);
	fclose($myfile);
	return $str;
}

function getData(){
	$arrWord = [];
	$arrBePayang = [];
	$arrBePhonemes = [];
	$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/wแล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
	for ($i=0; $i <8; $i++) {
		$index = (string)$i;
		$jsonWak[$i] = readTxt("wak".$index.".txt");
		//echo $jsonWak;
		$arrWak = splitWak($klon);
		//print_r ($arrWak);
		$arrKlonWord = addValueToArray($arrWak,$jsonWak,$arrWord,'word');
		$arrKlonPayang = addValueToArray($arrWak,$jsonWak,$arrBePayang,'payang');
		//$arrKlonPhonemes = addValueToArray($arrWak,$jsonWak,$arrBePhonemes,'phonemes');
		$arrTone = addValueToArray($arrWak,$jsonWak,$arrBePhonemes,'phonemes');
		//print_r ($arrKlonPhonemesAndTone);
		$arrKlonPhonemes = addPhonemes($arrWak,$arrTone);
		$arrKlonTone = addTone($arrWak,$arrTone);
		#echo $data;
	}
	//print_r ($jsonWak);
	process($arrKlonWord,$arrKlonPayang,$arrKlonPhonemes,$arrKlonTone);
}

getData();

?>
