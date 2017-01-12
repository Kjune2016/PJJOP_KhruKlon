<?php
class data{
  public $word = "";
  public $payang = "";
  public $phonemes = "";
}
error_reporting(E_ALL & ~E_NOTICE);
//$klon = "/w/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
//$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
$klon = $_POST['klon'];
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
// 1. เรียกใช้ api ah-klon ส่งจาก $arrWak ไปทีละวรรค ปล.เราต้องส่งอัตโนมัติ ส่งที่ละช่องอาเรย์ที่แบ่งวรรคแล้ว
/*$url = "URL API ah-klon";
$word = $_GET["sentry"];
$call_url = $url.$word;
$klon = file_get_contents($call_url);
//print_r($myfile);
$arrWak = json_decode($myfile);*/

// ส่วนที่เรียกจากโอ แต่ยังไม่เป็น api
function process($data){
// วนฟอ เก็บเจสันจากพี่โอลงอาเรย์ทีละวรรค
  for($i=0 ; $i<8 ; $i++){
    $jsonWak[$i] = $data;
  }
  //print_r ($jsonWak);
  return ($jsonWak);
}
function writeTxt($txt){
  $myfile = fopen($txt,"r") or die("Unable to open file");
  $data = fgets($myfile);
  fclose($myfile);
  return $data;
}

function getData(){
  for($i=1 ; $i<=8 ; $i++){
    $index = (string)($i);
    $data = writeTxt("wak".$index.".txt");
    process($data);
  }
}
getData();

// 2. ตัดข้อมูลที่ได้มาลง array 4 ตัวที่ต้องการ คือ arrWord, arrPayang, arrPhonemes, arrTone
// กลอนแบบเป็นคำ
for($i=0 ; $i<$countOfWak ;$i++){ // วนเท่ากับจำนวนวรรค
  $arrWord = [];
  $deJsonWak = json_decode($jsonWak[$i], true); // ทำทีละวรรค
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

//echo "<br>+++++++++++++++++++++++++++++++++++<br>";


  for($k=0 ; $k<count($arrBePayang) ; $k++){
    $str = ($str)." ".($arrBePayang[$k]);
    $str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
    $arrPayang = (explode(" ",$str2));
  }
  for($c=0 ; $c<count($arrPayang) ; $c++){
      $arrKlonPayang[$i][$c] = $arrPayang[$c];
  }

//echo "<br><br>PAYANG<br>";
//print_r ($arrKlonPayang);


// กลอนแบบเป็นพยางค์ไทย

for($i=0 ; $i<count($arrWak)-1 ;$i++){ // วนเท่ากับจำนวนวรรค
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
  //echo "<br>==================================<br>";

  for($k=0 ; $k<count($arrBePayang) ; $k++){
    $str = ($str)." ".($arrBePayang[$k]);
    $str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
    $arrPayang = (explode(" ",$str2));
  }
  for($c=0 ; $c<count($arrPayang) ; $c++){
      $arrKlonPayang[$i][$c] = $arrPayang[$c];
  }
}

// กลอนแบบเป็นสัทอักษร

for($i=0 ; $i<count($arrWak)-1 ;$i++){ // วนเท่ากับจำนวนวรรค
  $arrBePhonemes = [];
  $arrPhonemesAndTone = [];
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
    $string = $value['payang'];
    //echo $str." "."<br>";
    $string2 = $value['word'];
    //echo $str2." ";
    if(stristr($string2,"ะ")){
      array_push($arrBePhonemes,$value['phonemes']);
    }
    else {
      if(stristr($string,"ะ-ห")){
        //echo "<br>".$str2."1"." ";
        $value['phonemes'] = substr($value['phonemes'],6);
        array_push($arrBePhonemes,$value['phonemes']);
        //echo $value['phonemes'];
      }
      else if(stristr($string,"ผะ-อ")){
        //echo "<br>".$str2."1"." ";
        $value['phonemes'] = substr($value['phonemes'],6);
        array_push($arrBePhonemes,$value['phonemes']);
        //echo $value['phonemes'];
      }
      else if(stristr($string,"สะ-บ")){
        //echo "<br>".$str2."1"." ";
        $value['phonemes'] = substr($value['phonemes'],6);
        array_push($arrBePhonemes,$value['phonemes']);
        //echo $value['phonemes'];
      }
    }
  }
  //echo "<br>--------------------------------------------<br>";
  //print_r ($arrBePhonemes);
  //echo "<br>==================================<br>";

  for($k=0 ; $k<count($arrBePhonemes) ; $k++){
    $str = ($str)." ".($arrBePhonemes[$k]);
    $str2 = str_replace("-"," ",$str); // แทนที่ "-" ด้วย " "
    $arrPhonemesAndTone = (explode(" ",$str2));
  }
  //print_r ($arrBePhonemes);
  //echo "<br>...............................................<br>";
  for($c=0 ; $c<count($arrPhonemesAndTone) ; $c++){
      $arrKlonPhonemesAndTone[$i][$c] = $arrPhonemesAndTone[$c];
  }
//print_r ($arrTone);
//echo "<br>";
  // กลอนแบบเสียงวรรณยุกต์ แยกกับ พยางค์แบบสัทอักษร
  for($c=0 ; $c<count($arrPhonemesAndTone) ; $c++){
    $str3 = $arrPhonemesAndTone[$c];
    $arrTone[$c] = (explode("^",$str3));
    $arrKlonPhonemes[$i][$c] = $arrTone[$c][0];
    $arrKlonTone[$i][$c] = $arrTone[$c][1];
  }

  //print_r ($arrKlonTone);
}
echo "<br><br>WORD<br>";
print_r ($arrKlonWord);
echo "<br><br>PAYANG<br>";
print_r ($arrKlonPayang);

//echo "<br><br>PHONEMESANDTONE<br>";
//print_r ($arrKlonPhonemesAndTone);
echo "<br><br>PHONEMES<br>";
print_r ($arrKlonPhonemes);
echo "<br><br>Tone<br>";
print_r ($arrKlonTone);
//echo "<br>";




?>
