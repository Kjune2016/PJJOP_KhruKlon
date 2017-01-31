<?php
require ("EvaluationOfKlon-Supab.php");
require ("CNDB.php");
//require ("CNDBWord.php");
require ("wordCheck.php");
error_reporting(E_ALL & ~E_NOTICE);
function process($arrKlonWord,$arrKlonPayang,$arrKlonPhonemes,$arrKlonTone,$arrWak){
	//echo "Word"."<br>";
	//print_r($arrKlonWord);
	//echo "<br><br>"."Payang"."<br>";
	//print_r($arrKlonPayang);
	//echo "<br><br>"."Phonemes"."<br>";
	//print_r($arrKlonPhonemes);
	//echo "<br><br>"."Tone"."<br>";
	//print_r($arrKlonTone);
	//echo "<br><br>";
	$arrNumWak = checkWak($arrWak);
	$pan[0] = $arrNumWak;
	/*$strNumWak = "ผลการตรวจวรรค<br>";
	for($i=0 ; $i<count($arrNumWak)-1 ; $i++){
		$strNumWak = ($strNumWak).($arrNumWak[$i][str])." สถานะ ".($arrNumWak[$i][status])."<br>";
	}
	$strNumWak = ($strNumWak).($arrNumWak[sum]);
	echo $strNumWak;*/
	//print_r ($arrNumWak);
	//echo "<br><br>";
	$arrNumPayang = checkPayang($arrWak,$arrKlonPhonemes);
	$pan[1] = $arrNumPayang;
	/*$strNumPayang = "ผลการตรวจพยางค์<br>";
	for($i=0 ; $i<count($arrNumPayang) ; $i++){
		$strNumPayang = ($strNumPayang).($arrNumPayang[$i][str])." สถานะ ".($arrNumPayang[$i][status])."<br>";
	}
	echo $strNumPayang;*/
	//print_r ($arrNumPayang);
	//echo "<br><br>";
	$arrOfTone = checkTone($arrWak,$arrKlonTone);
	$pan[2] = $arrOfTone;
	/*$strOfTone = "ผลการตรวจเสียงวรรณยุกต์<br>";
	for($i=0 ; $i<count($arrOfTone) ; $i++){
		$strOfTone = ($strOfTone).($arrOfTone[$i][str])." สถานะ ".($arrOfTone[$i][status])."<br>";
	}
	echo $strOfTone;*/
	//print_r ($arrOfTone);
	//echo "<br><br>";
	$rhyme = preareInputRhyme($arrWak,$arrKlonPhonemes);
	$arrExternalRhyme = checkExRhyme($arrWak,$arrKlonPhonemes,$rhyme);
	$pan[3] = $arrExternalRhyme;
	/*$strExternalRhyme = "ผลการตรวจสัมผัสนอก<br>";
	for($i=0 ; $i<count($arrExternalRhyme) ; $i++){
		if($i!=3){
			$strExternalRhyme = ($strExternalRhyme).($arrExternalRhyme[$i][str])." สถานะ ".($arrExternalRhyme[$i][status])."<br>";
		}
	}
	$strExternalRhyme = ($strExternalRhyme).($arrExternalRhyme['connect']['str']);
	echo $strExternalRhyme;*/
	//print_r ($arrExternalRhyme);
	//echo "<br><br>";
	$arrDupRhyme = checkDupRhyme($arrWak,$arrKlonPhonemes,$arrKlonTone,$arrKlonPayang);
	$pan[4] = $arrDupRhyme;
	/*$strDupRhyme = "ผลการตรวจสัมผัสซ้ำ<br>";
	for($i=0 ; $i<count($arrDupRhyme) ; $i++){
		$strDupRhyme = ($strDupRhyme).($arrDupRhyme[$i][str])." สถานะ ".($arrDupRhyme[$i][status])."<br>";
	}
	echo $strDupRhyme;*/
	//print_r ($arrDupRhyme);
	//echo "<br><br>";
	$arrChingRhyme = checkChingRhyme($arrWak,$arrKlonPhonemes,$rhyme);
	$pan[5] = $arrChingRhyme;
	$strChingRhyme = "ผลการตรวจชิงสัมผัส<br>";
	for($i=2 ; $i<=count($arrChingRhyme)+1 ; $i++){
		$strChingRhyme = ($strChingRhyme).($arrChingRhyme[$i][str])." สถานะ ".($arrChingRhyme[$i][status])."<br>";
	}
	echo $strChingRhyme;
	//print_r ($arrChingRhyme);
	echo "<br><br>";
	$arrInternalRhyme = checkInRhyme($arrWak,$arrKlonPhonemes);
	$pan[6] = $arrInternalRhyme;
	/*$strInternalRhyme = "ผลการตรวจสัมผัสใน<br>";
	for($i=0 ; $i<count($arrInternalRhyme)-1 ; $i++){
		$strInternalRhyme = ($strInternalRhyme).($arrInternalRhyme[$i][str])." สถานะ ".($arrInternalRhyme[$i][status])."<br>";
	}
	$strInternalRhyme = ($strInternalRhyme)."รวมมีสัมผัสในทั้งหมด ".($arrInternalRhyme[count])." จุด";
	echo $strInternalRhyme;*/
	//print_r ($arrInternalRhyme);
	//echo "<br><br>";
	$arrVagueRhyme = checkVagueRhyme($arrWak,$arrKlonPhonemes,$rhyme);
	$pan[7] = $arrVagueRhyme;
	/*$strVagueRhyme = "ผลการตรวจสัมผัสเลือน<br>";
	for($i=1 ; $i<count($arrVagueRhyme)+4 ;){
		$strVagueRhyme = ($strVagueRhyme).($arrVagueRhyme[$i][str])." สถานะ ".($arrVagueRhyme[$i][status])."<br>";
		$i = $i+2;
	}
	echo $strVagueRhyme;*/
	//print_r ($arrVagueRhyme);
	//echo "<br><br>";
	//$connDBWord = cnDBWord();
	$conn = cnDB();
	$arrSlangWord = slangWord($arrKlonWord,$conn);
	$pan[8] = $arrSlangWord;
	/*$strSlangWord = "ผลการตรวจคำสแลง<br>";
	for($i=0 ; $i<count($arrSlangWord) ; $i++){
		$strSlangWord = ($strSlangWord).($arrSlangWord[$i][str])." สถานะ ".($arrSlangWord[$i][status])."<br>";
	}
	echo $strSlangWord;*/
	//print_r ($arrSlangWord);
	//echo "<br><br>";
	$arrBadWord = badWord($arrKlonWord, $conn);
	$pan[9] = $arrBadWord;
	/*$strBadWord = "ผลการตรวจคำหยาบคาย<br>";
	for($i=0 ; $i<count($arrBadWord) ; $i++){
		$strBadWord = ($strBadWord).($arrBadWord[$i][str])." สถานะ ".($arrBadWord[$i][status])."<br>";
	}
	echo $strBadWord;*/
	//echo count($arrBadWord);
	//print_r ($arrBadWord);
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
			for($c=0 ; $c<count($arrPhonemesAndTone) ; $c++){
		      $arrKlonPhonemesAndTone[$i][$c] = $arrPhonemesAndTone[$c];
		  }
			//print_r ($arrPhonemesAndTone);
			//echo "<br>...............................................<br>";
			//print_r ($arrTone);
			}
//print_r ($arrKlonPhonemesAndTone);
//echo "<br>1<br>";
			return ($arrKlonPhonemesAndTone);
		}
	}

// กลอนแบบเสียงวรรณยุกต์ แยกกับ พยางค์แบบสัทอักษร
function addPhonemes($arrWak,$arrKlonPhonemesAndTone){

	//print_r ($arrKlonPhonemesAndTone);
	for($i=0 ; $i<count($arrWak)-1 ;$i++){
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

function getData(){
	$arrWord = [];
	$arrBePayang = [];
	$arrBePhonemes = [];
	//$klon = $_GET['klon'];
	//echo $klon;
	$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/wแล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
	$arrWak = splitWak($klon);
	for ($i=0; $i<count($arrWak)-1 ; $i++) {
		/*$url = "http://172.27.225.156:8080/getData/v1/";
		$a = "แล้วสอนว่าอย่าไว้ใจมนุษย์";
		//$word = $_POST["input"];
		$call_url = $url.$a;
		$jsonWak = file_get_contents($call_url);
		//print_r ($jsonWak);
		//print_r($myfile);
		$dejsonWak = json_decode($jsonWak);
		print_r($dejsonWak);*/
		$index = (string)$i;
		//$jsonWak[$i] = readTxt("wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า นิ่ง เป็นคำสแลง เป็นเพราะ DB ออกผลใกล้เคียงมาให้
		$jsonWak[$i] = readTxt("poem2wak".$index.".txt"); // ถูกหมด
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
		//$jsonWak[$i] = readTxt("poem20wak".$index.".txt"); // ผิดสัมผัสซ้ำ 1 ที่ โปรแกรมตรวจไม่เจอ
		//$jsonWak[$i] = readTxt("poem21wak".$index.".txt"); // ถูกทุกอย่างยกเว้น มันพบคำว่า ถอย เป็นคำหยาบคาย เป็นเพราะ DB ออกผลใกล้เคียงมาให้ เผลอ กับละเมอ แปลงเป็นโฟนีมผิดอยู่
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
