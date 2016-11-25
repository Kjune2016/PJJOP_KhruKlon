<?php
class data{
  public $word = "";
  public $payang = "";
  public $phonemes = "";
}
error_reporting(E_ALL & ~E_NOTICE);
//$klon = "/w/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
//$klon = $_POST['klon'];
//print_r (explode("/w", $klon));
$arrWak = (explode("/w", $klon));
// วนลูปเช็คว่ามีวรรคนั้นๆไหม ไมีมีเก็บสถานะไว้ว่า false มีเก็บสภานะไว้ว่า true พร้อมนับด้วยว่ามีกี่วรรค
for($i=0 ; $i<count($arrWak) ; $i++){
  if($arrWak[$i]!=null && $arrWak[$i]!="/e"){
    $countOfWak = $countOfWak + 1;
    $arrIndexOfWak[$i] = "true";
  }
  else if($arrWak[$i]==null){
    $countOfWak = $countOfWak + 0;
    $arrIndexOfWak[$i] = "false";
  }
}
//print ($countOfWak);
// 1. เรียกใช้ api ah-klon ส่งจาก $arrWak ไปทีละวรรค ปล.เราต้องส่งอัตโนมัติ ทำไงแว้ ~~~
/*$url = "URL API ah-klon";
$word = $_GET["sentry"];
$call_url = $url.$word;
$klon = file_get_contents($call_url);
//print_r($myfile);
$arrWak = json_decode($myfile);*/
// ตั้งใจวนฟอ เก็บเจสันจากพี่โอหลังดีโค้ดแล้วลงอาเรย์ทีละวรรค

// สมมติข้อมูลที่จะได้มาจากพี่โอ และผ่านการ decode แล้ว ****วรรคเดียวเองนะ
$wak1 = array(
         "index1"=> array(
                   			"word"=>"แล้ว",
                   			"payang"=>"แล้ว",
                   			"phonemes"=>"l~x;+w^4"
                   		),
         "index2"=> array(
                   			"word"=>"สอน",
                   			"payang"=>"สอน",
                   			"phonemes"=>"s~@;+n^5"
                   		),
         "index3"=> array(
                   			"word"=>"ว่า",
                   			"payang"=>"ว่า",
                   			"phonemes"=>"w~a;^2"
                   		),
         "index4"=> array(
                     		"word"=>"อย่า",
                   			"payang"=>"อย่า",
                   			"phonemes"=>"j~a;^2"
                   		),
         "index5"=> array(
                   			"word"=>"ไว้ใจ",
                   			"payang"=>"ไว้-ใจ",
                   			"phonemes"=>"w~ai^4-ch~ai^1"
                   		),
          "index6"=> array(
                   			"word"=>"มนุษย์",
                   			"payang"=>"มะ-นุด",
                   			"phonemes"=>"m~a^4-n~u+d^4"
                   		)
                   );
$b1 = json_encode($wak1);
//echo $b1;
//echo "<br>===============<br>";
$jsonWak[0] = '{
         "index1":{"word":"\u0e41\u0e25\u0e49\u0e27",
                   "payang":"\u0e41\u0e25\u0e49\u0e27",
                   "phonemes":"l~x;+w^4"},
         "index2":{"word":"\u0e2a\u0e2d\u0e19",
                   "payang":"\u0e2a\u0e2d\u0e19",
                   "phonemes":"s~@;+n^5"},
         "index3":{"word":"\u0e27\u0e48\u0e32",
                   "payang":"\u0e27\u0e48\u0e32",
                   "phonemes":"w~a;^2"},
         "index4":{"word":"\u0e2d\u0e22\u0e48\u0e32",
                   "payang":"\u0e2d\u0e22\u0e48\u0e32",
                   "phonemes":"j~a;^2"},
         "index5":{"word":"\u0e44\u0e27\u0e49\u0e43\u0e08",
                   "payang":"\u0e44\u0e27\u0e49-\u0e43\u0e08",
                   "phonemes":"w~ai^4-ch~ai^1"},
         "index6":{"word":"\u0e21\u0e19\u0e38\u0e29\u0e22\u0e4c",
                   "payang":"\u0e21\u0e30-\u0e19\u0e38\u0e14",
                   "phonemes":"m~a^4-n~u+d^4"}}';
  //$deJsonWak1 = json_decode($jsonWak1, true);
  //print_r ($deJsonWak1);
  //echo "<br>===============<br>";
/*$a2 = array(
           "index1"=> array(
                     			"word"=>"มัน",
                     			"payang"=>"มัน",
                     			"phonemes"=>"m~a+n^4"
                     		),
           "index2"=> array(
    							"word"=>"ลึกล้ำ",
                     			"payang"=>"ลึก-ล้ำ",
                     			"phonemes"=>"l~v+k^4-l~am^4"
                     		),
           "index3"=> array(
                     			"word"=>"เหลือ",
                     			"payang"=>"เหลือ",
                     			"phonemes"=>"l~v;a^4"
                     		),
            "index4"=> array(
                     			"word"=>"กำหนด",
                     			"payang"=>"กำ-หนด",
                     			"phonemes"=>"k~am^1-n~o+d^2"
                     		)
                     );
$b2 = json_encode($a2);*/
  //echo $b2;
  //echo "<br>===============<br>";
$jsonWak[1] = '';

  //$deJsonWak2 = json_decode($jsonWak2, true);
  //print_r ($deJsonWak2);
  //echo "<br>===============<br>";

$a3 = array(
           "index1"=> array(
                     			"word"=>"ถึง",
                     			"payang"=>"ถึง",
                     			"phonemes"=>"th~v+ng^5"
                     		),
           "index2"=> array(
                     			"word"=>"เถาวัลย์",
                     			"payang"=>"เถา-วัน",
                     			"phonemes"=>"th~aw^5-w~a+n^1"
                     		),
           "index3"=> array(
                     			"word"=>"พัน",
                     			"payang"=>"พัน",
                     			"phonemes"=>"p~a+n^1"
                     		),
           "index4"=> array(
    							"word"=>"เกี่ยว",
                     			"payang"=>"เกี่ยว",
                     			"phonemes"=>"k~i;a+w^2"
                     		),
           "index5"=> array(
                     			"word"=>"ที่",
                     			"payang"=>"ที่",
                     			"phonemes"=>"t~i^3"
                     		),
            "index6"=> array(
                     			"word"=>"เลี้ยว",
                     			"payang"=>"เลี้ยว",
                     			"phonemes"=>"l~i;a+w^4"
                     		),
    		    "index7"=> array(
                     			"word"=>"ลด",
                     			"payang"=>"ลด",
                     			"phonemes"=>"l~o+d^4"
                     		)
                     );
$b3 = json_encode($a3);
  //echo $b3;
  //echo "<br>===============<br>";
$jsonWak[2] = '{
  	"index1": {"word": "\u0e16\u0e36\u0e07",
  		         "payang": "\u0e16\u0e36\u0e07",
  		         "phonemes": "th~v+ng^5"},
  	"index2": {"word": "\u0e40\u0e16\u0e32\u0e27\u0e31\u0e25\u0e22\u0e4c",
  		         "payang": "\u0e40\u0e16\u0e32-\u0e27\u0e31\u0e19",
  		         "phonemes": "th~aw^5-w~a+n^1"},
  	"index3": {"word": "\u0e1e\u0e31\u0e19",
  		         "payang": "\u0e1e\u0e31\u0e19",
  		         "phonemes": "p~a+n^1"},
  	"index4": {"word": "\u0e40\u0e01\u0e35\u0e48\u0e22\u0e27",
  		         "payang": "\u0e40\u0e01\u0e35\u0e48\u0e22\u0e27",
  		         "phonemes": "k~i;a+w^2"},
  	"index5": {"word": "\u0e17\u0e35\u0e48",
  		         "payang": "\u0e17\u0e35\u0e48",
  		         "phonemes": "t~i^3"},
  	"index6": {"word": "\u0e40\u0e25\u0e35\u0e49\u0e22\u0e27",
  		         "payang": "\u0e40\u0e25\u0e35\u0e49\u0e22\u0e27",
  		         "phonemes": "l~i;a+w^4"},
  	"index7": {"word": "\u0e25\u0e14",
  		         "payang": "\u0e25\u0e14",
  		         "phonemes": "l~o+d^4"}}';

  //$deJsonWak3 = json_decode($jsonWak3, true);
  //print_r ($deJsonWak3);
  //echo "<br>===============<br>";

$a4 = array(
           "index1"=> array(
                     			"word"=>"ก็",
                     			"payang"=>"ก็",
                     			"phonemes"=>"k~@;^3"
                     		),
           "index2"=> array(
                     			"word"=>"ไม่",
                     			"payang"=>"ไม่",
                     			"phonemes"=>"m~ai^2"
                     		),
           "index3"=> array(
                     			"word"=>"คด",
                     			"payang"=>"คด",
                     			"phonemes"=>"kh~o+d^4"
                     		),
           "index4"=> array(
                       		"word"=>"เหมือน",
                     			"payang"=>"เหมือน",
                     			"phonemes"=>"m~v;a+n^5"
                     		),
           "index5"=> array(
                     			"word"=>"หนึ่ง",
                     			"payang"=>"หนึ่ง",
                     			"phonemes"=>"n~v+ng^2"
                     		),
            "index6"=> array(
                     			"word"=>"ใน",
                     			"payang"=>"ใน",
                     			"phonemes"=>"n~ai^1"
                     		),
    		    "index7"=> array(
                     			"word"=>"น้ำใจ",
                     			"payang"=>"น้ำ-ใจ",
                     			"phonemes"=>"n~am+^4-ch~ai^1"
                     		),
            "index8"=> array(
                     			"word"=>"คน",
                     			"payang"=>"คน",
                     			"phonemes"=>"kh~o+n^1"
                     		)
                     );
$b4 = json_encode($a4);
  //echo $b4;
  //echo "<br>===============<br>";
$jsonWak[3] = '{
  	"index1": {"word": "\u0e01\u0e47",
  		         "payang": "\u0e01\u0e47",
  		         "phonemes": "k~@;^3"},
  	"index2": {"word": "\u0e44\u0e21\u0e48",
  		         "payang": "\u0e44\u0e21\u0e48",
  		         "phonemes": "m~ai^2"},
    "index3": {"word": "\u0e04\u0e14",
  		           "payang": "\u0e04\u0e14",
  		           "phonemes": "kh~o+d^4"},
  	"index4": {"word": "\u0e40\u0e2b\u0e21\u0e37\u0e2d\u0e19",
  		         "payang": "\u0e40\u0e2b\u0e21\u0e37\u0e2d\u0e19",
  		         "phonemes": "m~v;a+n^5"},
  	"index5": {"word": "\u0e2b\u0e19\u0e36\u0e48\u0e07",
  		         "payang": "\u0e2b\u0e19\u0e36\u0e48\u0e07",
  		         "phonemes": "n~v+ng^2"},
  	"index6": {"word": "\u0e43\u0e19",
  		         "payang": "\u0e43\u0e19",
  		         "phonemes": "n~ai^1"},
  	"index7": {"word": "\u0e19\u0e49\u0e33\u0e43\u0e08",
  		         "payang": "\u0e19\u0e49\u0e33-\u0e43\u0e08",
  		         "phonemes": "n~am+^4-ch~ai^1"},
  	"index8": {"word": "\u0e04\u0e19",
  		         "payang": "\u0e04\u0e19",
  		         "phonemes": "kh~o+n^1"}}';

  //$deJsonWak4 = json_decode($jsonWak4, true);
  //print_r ($deJsonWak4);
  //echo "<br>===============<br>";

// 2. ตัดข้อมูลที่ได้มาลง array 4 ตัวที่ต้องการ คือ arrWord, arrPayang, arrPhonemes, arrTone

// กลอนแบบเป็นคำ
for($i=0 ; $i<$countOfWak ;$i++){ // วนเท่ากับจำนวนวรรค
  $arrWord = [];
  $deJsonWak = (array)json_decode($jsonWak[$i], true); // ทำทีละวรรค
  //print_r ($deJsonWak);
  //echo "<br>==================================<br>";
  foreach ($deJsonWak as $key=>$value) {
      array_push($arrWord,$value['word']);
  }
  //$deJsonWak = null;
  //print_r ($arrWord);
  for($c=0 ; $c<count($arrWord) ; $c++){
      $arrKlonWord[$i][$c] = $arrWord[$c];
  }
}
//echo "<br><br>WORD<br>";
//print_r ($arrKlonWord);
//echo "<br>+++++++++++++++++++++++++++++++++++<br>";

// กลอนแบบเป็นพยางค์ไทย

for($i=0 ; $i<$countOfWak ;$i++){ // วนเท่ากับจำนวนวรรค
  $arrBePayang = [];
  $arrPayang = [];
  $str = "";
  $str2 = "";
  $deJsonWak = (array)json_decode($jsonWak[$i], true); // ทำทีละวรรค
  //print_r ($deJsonWak);
  //echo "<br>";
  //echo "<br>==================================<br>";
  foreach ($deJsonWak as $key=>$value) {
  	//echo $value['word']." ";
    array_push($arrBePayang,$value['payang']);
  }
  //echo "<br>===============<br>";
  //print_r ($arrBePayang);
  ///echo "<br>==================================<br>";

  for($k=0 ; $k<count($arrBePayang) ; $k++){
    $str = ($str)." ".($arrBePayang[$k]);
    $str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
    $arrPayang = (explode(" ",$str2));
  }
  for($c=0 ; $c<count($arrPayang) ; $c++){
      $arrKlonPayang[$i][$c] = $arrPayang[$c];
  }
}
//echo "<br><br>PAYANG<br>";
//print_r ($arrKlonPayang);

// กลอนแบบเป็นสัทอักษร

for($i=0 ; $i<$countOfWak ;$i++){ // วนเท่ากับจำนวนวรรค
  $arrBePhonemes = [];
  $arrBePhonemes2 = [];
  $arrPhonemes = [];
  $str = "";
  $str2 = "";
  $str3 = "";
  $deJsonWak = (array)json_decode($jsonWak[$i], true); // ทำทีละวรรค
  //print_r ($deJsonWak);
  //echo "<br>";
  //echo "<br>==================================<br>";
  foreach ($deJsonWak as $key=>$value) {
  	//echo $value['word']." ";
    array_push($arrBePhonemes,$value['phonemes']);
  }
  //echo "<br>===============<br>";
  //print_r ($arrBePhonemes);
  //echo "<br>==================================<br>";

  for($k=0 ; $k<count($arrBePhonemes) ; $k++){
    $str = ($str)." ".($arrBePhonemes[$k]);
    $str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
    $arrBePhonemes2 = (explode(" ",$str2));
  }
  //print_r ($arrBePhonemes2);
  //echo "<br>........<br>";
  for($c=0 ; $c<=count($arrBePhonemes2) ; $c++){
      //$arrKlonPhonemes[$i][$c] = $arrPhonemes[$c];
      // กลอนแบบเสียงวรรณยุกต์
        //$str3 = $arrBePhonemes2[$c];
        $arrTone[$c] = (explode("^",$arrBePhonemes2[$c]));
}
//print_r ($arrTone);
  // กลอนแบบเสียงวรรณยุกต์ 2
  for($c=0 ; $c<count($arrTone) ; $c++){
    $arrKlonPhonemes[$i][$c] = $arrTone[$c][0];
    $arrKlonTone[$i][$c] = $arrTone[$c][1];
  }
  //print_r ($arrTone);
}

//echo "<br><br>PHONEMES<br>";
//print_r ($arrKlonPhonemes);
//echo "<br><br>Tone<br>";
//print_r ($arrKlonTone);



?>
