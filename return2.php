<?php
require ("EvaluationOfKlon-Supab.php");
require ("CNDB.php");
//require ("CNDBWord.php");
require ("wordCheck.php");
error_reporting(E_ALL & ~E_NOTICE);
function process($arrKlonWord,$arrKlonPayang,$arrKlonPhonemes,$arrKlonTone,$arrWak){
	//$_SESSION['a'] = "aa";

	/*echo "Word"."<br>";
	print_r($arrKlonWord);
	echo "<br><br>"."Payang"."<br>";
	print_r($arrKlonPayang);
	echo "<br><br>"."Phonemes"."<br>";
	print_r($arrKlonPhonemes);
	echo "<br><br>"."Tone"."<br>";
	print_r($arrKlonTone);
	echo "<br><br>";*/
	$_SESSION['numWak'] = checkWak($arrWak);
	//echo json_encode($_SESSION['numWak'])."<br>";
	//$pan[0] = $arrNumWak;
	/*$strNumWak = "ผลการตรวจวรรค<br>";
	for($i=0 ; $i<count($arrNumWak)-1 ; $i++){
		$strNumWak = ($strNumWak).($arrNumWak[$i][str])." สถานะ ".($arrNumWak[$i][status])."<br>";
	}
	$strNumWak = ($strNumWak).($arrNumWak[sum]);
	echo $strNumWak;*/
	//print_r ($_SESSION['numWak']);
	//echo "<br><br>";
	$_SESSION['numPayang'] = checkPayang($arrWak,$arrKlonPhonemes);
	//$pan[1] = $arrNumPayang;
	/*$strNumPayang = "ผลการตรวจพยางค์<br>";
	for($i=0 ; $i<count($arrNumPayang) ; $i++){
		$strNumPayang = ($strNumPayang).($arrNumPayang[$i][str])." สถานะ ".($arrNumPayang[$i][status])."<br>";
	}
	echo $strNumPayang;*/
	//print_r ($_SESSION['numPayang']);
	//echo "<br><br>";
	$_SESSION['tone'] = checkTone($arrWak,$arrKlonTone);
	//$pan[2] = $arrOfTone;
	/*$strOfTone = "ผลการตรวจเสียงวรรณยุกต์<br>";
	for($i=0 ; $i<count($arrOfTone) ; $i++){
		$strOfTone = ($strOfTone).($arrOfTone[$i][str])." สถานะ ".($arrOfTone[$i][status])."<br>";
	}
	echo $strOfTone;*/
	//print_r ($_SESSION['tone']);
	//echo "<br><br>";
	$rhyme = preareInputRhyme($arrWak,$arrKlonPhonemes);
	$_SESSION['ExternalRhyme'] = checkExRhyme($arrWak,$arrKlonPhonemes,$rhyme);
	//$pan[3] = $arrExternalRhyme;
	/*$strExternalRhyme = "ผลการตรวจสัมผัสนอก<br>";
	for($i=0 ; $i<count($arrExternalRhyme) ; $i++){
		if($i!=3){
			$strExternalRhyme = ($strExternalRhyme).($arrExternalRhyme[$i][str])." สถานะ ".($arrExternalRhyme[$i][status])."<br>";
		}
	}
	$strExternalRhyme = ($strExternalRhyme).($arrExternalRhyme['connect']['str']);
	echo $strExternalRhyme;*/
	//print_r ($_SESSION['ExternalRhyme']);
	//echo "<br><br>";
	$_SESSION['DupRhyme'] = checkDupRhyme($arrWak,$arrKlonPayang);
	//$pan[4] = $arrDupRhyme;
	/*$strDupRhyme = "ผลการตรวจสัมผัสซ้ำ<br>";
	for($i=0 ; $i<count($arrDupRhyme) ; $i++){
		$strDupRhyme = ($strDupRhyme).($arrDupRhyme[$i][str])." สถานะ ".($arrDupRhyme[$i][status])."<br>";
	}
	echo $strDupRhyme;*/
	print_r ($_SESSION['DupRhyme']);
	echo "<br><br>";
	$_SESSION['ChingRhyme'] = checkChingRhyme($arrWak,$arrKlonPhonemes,$rhyme);
	//$pan[5] = $arrChingRhyme;
	/*$strChingRhyme = "ผลการตรวจชิงสัมผัส<br>";
	for($i=2 ; $i<=count($arrChingRhyme)+1 ; $i++){
		$strChingRhyme = ($strChingRhyme).($arrChingRhyme[$i][str])." สถานะ ".($arrChingRhyme[$i][status])."<br>";
	}
	echo $strChingRhyme;*/
	//print_r ($_SESSION['ChingRhyme']);
	//echo "<br><br>";
	$_SESSION['InternalRhyme'] = checkInRhyme($arrWak,$arrKlonPhonemes);
	//$pan[6] = $arrInternalRhyme;
	/*$strInternalRhyme = "ผลการตรวจสัมผัสใน<br>";
	for($i=0 ; $i<count($arrInternalRhyme)-1 ; $i++){
		$strInternalRhyme = ($strInternalRhyme).($arrInternalRhyme[$i][str])." สถานะ ".($arrInternalRhyme[$i][status])."<br>";
	}
	$strInternalRhyme = ($strInternalRhyme)."รวมมีสัมผัสในทั้งหมด ".($arrInternalRhyme[count])." จุด";
	echo $strInternalRhyme;*/
	//print_r ($_SESSION['InternalRhyme']);
	//echo "<br><br>";
	$_SESSION['VagueRhyme'] = checkVagueRhyme($arrWak,$arrKlonPhonemes,$rhyme);
	//$pan[7] = $arrVagueRhyme;
	/*$strVagueRhyme = "ผลการตรวจสัมผัสเลือน<br>";
	for($i=1 ; $i<count($arrVagueRhyme)+4 ;){
		$strVagueRhyme = ($strVagueRhyme).($arrVagueRhyme[$i][str])." สถานะ ".($arrVagueRhyme[$i][status])."<br>";
		$i = $i+2;
	}
	echo $strVagueRhyme;*/
	//print_r ($arrVagueRhyme);
	//print_r ($_SESSION['VagueRhyme']);
	//echo "<br><br>";
	//$connDBWord = cnDBWord();
	$conn = cnDB();
	$_SESSION['SlangWord'] = slangWord($arrKlonWord,$conn);
	//$pan[8] = $arrSlangWord;
	/*$strSlangWord = "ผลการตรวจคำสแลง<br>";
	for($i=0 ; $i<count($arrSlangWord) ; $i++){
		$strSlangWord = ($strSlangWord).($arrSlangWord[$i][str])." สถานะ ".($arrSlangWord[$i][status])."<br>";
	}
	echo $strSlangWord;*/
	//print_r ($_SESSION['SlangWord']);
	//echo "<br><br>";
	$_SESSION['BadWord'] = badWord($arrKlonWord, $conn);
	//$pan[9] = $arrBadWord;
	/*$strBadWord = "ผลการตรวจคำหยาบคาย<br>";
	for($i=0 ; $i<count($arrBadWord) ; $i++){
		$strBadWord = ($strBadWord).($arrBadWord[$i][str])." สถานะ ".($arrBadWord[$i][status])."<br>";
	}
	echo $strBadWord;*/
	//echo count($arrBadWord);
	print_r ($_SESSION['BadWord']);
	//echo "<br><br>";
	/*$arrUseWord = useWord($arrKlonWord, $conn, $connDBWord);
	$strBadWord = "ผลการตรวจคำหยาบคาย<br>";
	for($i=0 ; $i<count($arrBadWord) ; $i++){
		$strBadWord = ($strBadWord).($arrBadWord[$i][str])." สถานะ ".($arrBadWord[$i][status])."<br>";
	}
	//echo $strBadWord;
	print_r ($arrUseWord);
	//echo "<br><br>";*/
	//echo json_encode($pan);
	//print_r (json_decode(json_encode($pan,true)));
	//print_r ($de);
}


//print_r($arrWak);
//echo "<br>";
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
			//$deJsonWak = $deJsonWak['message'];
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
			$string = "";
			$string2 = "";
		  $str = "";
		  $str2 = "";
		  $deJsonWak = (array)json_decode($jsonWak[$i], true); // ทำทีละวรรค
			//$deJsonWak = $deJsonWak['message'];
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
			if((count($arrKlonPayang[$i])-1)>9){
				$arrBePayang = [];
				$arrKlonPayang[$i] = [];
				$arrPayang = [];
				$string = "";
				$string2 = "";
				$str = "";
				$str2 = "";
				foreach ($deJsonWak as $key=>$val) {
				  //echo $value['word']." ";
				  $string = $val['payang'];
				  //echo $string." "."<br>";
				  $string2 = $val['word'];
				  //echo $string2." "."<br>";
				  if(stristr($string2,"ะ")){
						//echo $string2." "."<br>";
				    array_push($arrBePayang,$val['payang']);
				  }
				  else {
				    if(stristr($string,"ะ-ห")){
				      //echo "<br>".$string."1"." ";
							//echo $val['payang']."<br>";
				      $val['payang'] = substr($val['payang'],7);
				      array_push($arrBePayang,$val['payang']);
				      //echo $val['payang'];
				    }
				    else if(stristr($string,"ผะ-อ")){
				      //echo "<br>".$str2."1"." ";
				      $val['payang'] = substr($val['payang'],7);
				      array_push($arrBePayang,$val['payang']);
				      //echo $value['payang'];
				    }
						/*else if(stristr($string,"พะ-ย")){
				      //echo "<br>".$str2."1"." ";
				      $val['payang'] = substr($val['payang'],7);
				      array_push($arrBePayang,$val['payang']);
				      //echo $value['payang'];
				    }*/
						else if(stristr($string,"ธะ-น")){
				      //echo "<br>".$str2."1"." ";
				      $val['payang'] = substr($val['payang'],7);
				      array_push($arrBePayang,$val['payang']);
				      //echo $value['payang'];
				    }
				    else if(stristr($string,"สะ-บ")){
				      //echo "<br>".$str2."1"." ";
				      $val['payang'] = substr($val['payang'],7);
				      array_push($arrBePayang,$val['payang']);
				      //echo $value['payang'];
				    }
				    else{
				      array_push($arrBePayang,$val['payang']);
				    }
				  }
				}
				//print_r($arrBePayang);
				//echo "<br>1<br>";

			for($k=0 ; $k<count($arrBePayang) ; $k++){
		    $str = ($str)." ".($arrBePayang[$k]);
		    $str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
		    $arrPayang = (explode(" ",$str2));
		  }
		  for($c=0 ; $c<count($arrPayang) ; $c++){
		    $arrKlonPayang[$i][$c] = $arrPayang[$c];
		  }
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
			//$deJsonWak = $deJsonWak['message'];
			//print_r ($deJsonWak);
			//echo "<br>";
			//echo "<br>==================================<br>";
			if(is_array($deJsonWak)){
				foreach ($deJsonWak as $key=>$val) {
			    	array_push($arrBePhonemes,$val[$value]);
			  }
			}
			//print_r ($arrBePhonemes);
			//echo "<br>".count($arrBePhonemes);
			for($k=0 ; $k<count($arrBePhonemes) ; $k++){
				$str = ($str)." ".($arrBePhonemes[$k]);
				$str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
				$arrPhonemesAndTone = (explode(" ",$str2));
			}
			for($c=0 ; $c<count($arrPhonemesAndTone) ; $c++){
		      $arrKlonPhonemesAndTone[$i][$c] = $arrPhonemesAndTone[$c];
		  }
			//print_r ($arrPhonemesAndTone);
			//echo "<br>...............................................<br>";
			//echo "<br>".(count($arrKlonPhonemesAndTone[$i]))."<br>";
			//print_r ($arrTone);
			if((count($arrKlonPhonemesAndTone[$i])-1)>9){
				$arrBePhonemes = [];
				$arrKlonPhonemesAndTone[$i] = [];
				$arrPhonemesAndTone = [];
				$string = "";
				$string2 = "";
				$str = "";
				$str2 = "";
				foreach ($deJsonWak as $key=>$val) {
				  //echo $value['word']." ";
				  $string = $val['payang'];
				  //echo $string." "."<br>";
				  $string2 = $val['word'];
				  //echo $string2." "."<br>";
				  if(stristr($string2,"ะ")){
						//echo $string2." "."<br>";
				    array_push($arrBePhonemes,$val['phonemes']);
				  }
				  else {
				    if(stristr($string,"ะ-ห")){
				      //echo "<br>".$string."1"." ";
							//echo $val['phonemes']."<br>";
				      $val['phonemes'] = substr($val['phonemes'],6);
				      array_push($arrBePhonemes,$val['phonemes']);
				      //echo $val['phonemes'];
				    }
				    else if(stristr($string,"ผะ-อ")){
				      //echo "<br>".$str2."1"." ";
				      $val['phonemes'] = substr($val['phonemes'],6);
				      array_push($arrBePhonemes,$val['phonemes']);
				      //echo $value['phonemes'];
				    }
						/*else if(stristr($string,"พะ-ย")){
				      //echo "<br>".$str2."1"." ";
				      $val['phonemes'] = substr($val['phonemes'],6);
				      array_push($arrBePhonemes,$val['phonemes']);
				      //echo $value['phonemes'];
				    }*/
						else if(stristr($string,"ธะ-น")){
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
				//print_r($arrBePhonemes);
				//echo "<br><br>";
				for($k=0 ; $k<count($arrBePhonemes) ; $k++){
					$str = ($str)." ".($arrBePhonemes[$k]);
					//echo $str."<br>";
					$str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
					//echo "<br>".$str2."<br>";
					$arrPhonemesAndTone = (explode(" ",$str2));
				}
				//print_r($arrPhonemesAndTone);
				//echo "<br><br>";
				//echo count($arrPhonemesAndTone)."<br>";
				for($c=0 ; $c<(count($arrPhonemesAndTone)) ; $c++){
					//echo "<br>".($arrPhonemesAndTone[$c])."<br>";
			    $arrKlonPhonemesAndTone[$i][$c] = $arrPhonemesAndTone[$c];
			  }
				//echo "<br>".($arrKlonPhonemesAndTone[$i][8])."<br>";
				//print_r ($arrKlonPhonemesAndTone);
				//echo "<br>";
			}
		}
		//print_r ($arrKlonPhonemesAndTone);
		//echo "<br><br>";
		return ($arrKlonPhonemesAndTone);
	}
}

// กลอนแบบเสียงวรรณยุกต์ แยกกับ พยางค์แบบสัทอักษร
function addPhonemes($arrWak,$arrKlonPhonemesAndTone){

	//print_r ($arrKlonPhonemesAndTone);
	for($i=0 ; $i<count($arrWak)-1 ;$i++){
		//echo (count($arrKlonPhonemesAndTone[$i])-1)."<br>";
		$str3 = "";
		for($c=0 ; $c<count($arrKlonPhonemesAndTone[$i]) ; $c++){
			$str3 = $arrKlonPhonemesAndTone[$i][$c];
			//echo $str3." ";
			$arrTone[$c] = (explode("^",$str3));
			$arrKlonPhonemes[$i][$c] = $arrTone[$c][0];
		}
	}
	//print_r ($arrTone);
	//echo "<br>";
	//print_r ($arrKlonPhonemes);
	//echo "<br>";
	return ($arrKlonPhonemes);
}

// กลอนแบบเสียงวรรณยุกต์ แยกกับ พยางค์แบบสัทอักษร
function addTone($arrWak,$arrKlonPhonemesAndTone){

	for($i=0 ; $i<count($arrWak)-1 ;$i++){
		//$str3 = "";
		for($c=0 ; $c<count($arrKlonPhonemesAndTone[$i]) ; $c++){
			$str3 = $arrKlonPhonemesAndTone[$i][$c];
			$arrTone[$c] = (explode("^",$str3));
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


function splitWak($klon){
  $arrWak = (explode("/w", $klon));
  return ($arrWak);
}


function getData(){
	$arrWord = [];
	$arrBePayang = [];
	$arrBePhonemes = [];
	//$klon = $_GET['klon'];
	//echo $klon;
	//$klon = "/w/w/w/w";
	$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/wแล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
	//$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
	$arrWak = splitWak($klon);
	//print_r($arrWak);
	//echo (count($arrWak)-1);
	for ($i=0; $i<count($arrWak)-1 ; $i++) {
		/*$url = "http://172.27.225.156:8080/getData/v1/";
		//$a = "แล้วสอนว่าอย่าไว้ใจมนุษย์";
		$wak = $arrWak[$i];
		if($wak != ""){
			$txt = urlencode($wak);
			//$wak = $_POST["input"];
			$call_url = $url.$txt;
			$jsonWak[$i] = file_get_contents($call_url);
			$i++;
		}
		else if($wak == "" && $i<(count($arrWak)-1)){
			$i++;
		}*/
		//print_r($myfile);
		//$jsonWak[$i] = json_decode($myfile);
		$index = (string)$i;
		//$jsonWak[$i] = readTxt("wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า นิ่ง เป็นคำสแลง เป็นเพราะ DB ออกผลใกล้เคียงมาให้
		//$jsonWak[$i] = readTxt("poem2wak".$index.".txt"); // ถูกหมด
		//$jsonWak[$i] = readTxt("poem3wak".$index.".txt"); // มีเจสันวรรคที่ i = 5 แต่ไม่มีข้อมูลตอนดีโค้ด ทำให้ผลการตรวจเพี้ยนหมด
		//echo $jsonWak[$i]."<br>==============<br>".($i)."<br>";
		//$jsonWak[$i] = readTxt("poem4wak".$index.".txt"); // ผิดสัมผัสซ้ำ 2 ที่ แล้วคำว่า กลอน กับ ก้อน สัมผัสกันไหมอะ
		//$jsonWak[$i] = readTxt("poem5wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า นิ่ง เป็นคำสแลง เป็นเพราะ DB ออกผลใกล้เคียงมาให้ และใน DB คำหยาบคายมีคำว่า โง่
		//$jsonWak[$i] = readTxt("poem6wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า กี่ เป็นคำสแลง เป็นเพราะ DB ออกผลใกล้เคียงมาให้ ชิงสัมผัสผิด 1 ที่
		//$jsonWak[$i] = readTxt("poem7wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า เก่า เป็นคำสแลง เป็นเพราะ DB ออกผลใกล้เคียงมาให้
		//$jsonWak[$i] = readTxt("poem8wak".$index.".txt"); // ถูกหมด
		//$jsonWak[$i] = readTxt("poem9wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า ร้าน เป็นคำหยาบคาย เป็นเพราะ DB ออกผลใกล้เคียงมาให้
		//$jsonWak[$i] = readTxt("poem10wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า จู่ เป็นคำหยาบคาย เป็นเพราะ DB ออกผลใกล้เคียงมาให้
		//$jsonWak[$i] = readTxt("poem11wak".$index.".txt"); // ถูกหมด แต่คำว่าดอกพบในคลังคำหยาบคาย แต่ในที่นี้ ดอกคือคอกไม้ ก็เราตรวจความหมายไม่ได้นิน่าา
		//$jsonWak[$i] = readTxt("poem12wak".$index.".txt"); // ถูกหมด
		//$jsonWak[$i] = readTxt("poem13wak".$index.".txt"); // ถูกหมด
		//$jsonWak[$i] = readTxt("poem14wak".$index.".txt"); // ไม่เอาอันนี้ เอาอันที่ 22 แทน
		//$jsonWak[$i] = readTxt("poem15wak".$index.".txt"); // ตัดคำผิด เอา 21 แทน
		//$jsonWak[$i] = readTxt("poem16wak".$index.".txt"); // ถูกหมด
		//$jsonWak[$i] = readTxt("poem17wak".$index.".txt"); // ถูกหมด
		//$jsonWak[$i] = readTxt("poem18wak".$index.".txt"); // ถูกหมด
		//$jsonWak[$i] = readTxt("poem19wak".$index.".txt"); // สัมผัสในโปรแกรมตรวจผิด 1 จุด
		//$jsonWak[$i] = readTxt("poem20wak".$index.".txt");
		$jsonWak[$i] = readTxt("poem21wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า ถอย เป็นคำหยาบคาย เป็นเพราะ DB ออกผลใกล้เคียงมาให้ เผลอ กับละเมอ แปลงเป็นโฟนีมผิดอยู่
		//$jsonWak[$i] = readTxt("poem22wak".$index.".txt"); // ผิดสัมผัสซ้ำ 1 ที่ มี 1 สัมผัสเลือน ถูก
		//$jsonWak[$i] = readTxt("poem27wak".$index.".txt"); // กลอนที่ 20 ที่ใช้ทดลองนะ มีตัดพยางค์ผิด แต่อาจารย์ให้มองผ่านไปก่อน
		//$jsonWak[$i] = readTxt("poemPlak1wak".$index.".txt");
		//$jsonWak[$i] = readTxt("poemPlak2wak".$index.".txt");
		//$jsonWak[$i] = readTxt("poemPlak3wak".$index.".txt");
		//$jsonWak[$i] = readTxt("poemPlak4wak".$index.".txt");
		//$jsonWak[$i] = readTxt("poemPlak5wak".$index.".txt");
		//$jsonWak[0] = readTxt("poemPlak6wak0.txt");
		//echo $jsonWak;
		#echo $data;
	}
	//print_r ($jsonWak);
	//$enCode = json_encode($arrWak);
	//echo $enCode;
	//print_r ($arrWak);
	$arrKlonWord = addValueToArray($arrWak,$jsonWak,$arrWord,'word');
	$arrKlonPayang = addValueToArray($arrWak,$jsonWak,$arrBePayang,'payang');
	//$arrKlonPhonemes = addValueToArray($arrWak,$jsonWak,$arrBePhonemes,'phonemes');
	$arrPhonemesAndTone = addValueToArray($arrWak,$jsonWak,$arrBePhonemes,'phonemes');
	//print_r ($arrKlonPhonemesAndTone);
	$arrKlonPhonemes = addPhonemes($arrWak,$arrPhonemesAndTone);
	$arrKlonTone = addTone($arrWak,$arrPhonemesAndTone);
	//print_r ($jsonWak);
	process($arrKlonWord,$arrKlonPayang,$arrKlonPhonemes,$arrKlonTone,$arrWak);
}

getData();

?>
