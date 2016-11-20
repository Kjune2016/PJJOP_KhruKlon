<?php
require ("DataConversion.php");
/*print_r ($arrKlonWord);
echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";
print_r ($arrKlonPayang);
echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";
print_r ($arrKlonPhonemes);
echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";
print_r ($arrKlonTone);
echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";*/
class  CheckSyntaxAndMelody {
    public $numOfWak = "";
    public $numOfPayang = "";
    public $externalRhyme = "";
    public $chingRhyme = "";
    public $duplicateRhyme = "";
    public $tone = "";
    public $internalRhyme = "";
    public $vagueRhyme = "";
}
  //print_r ($arrWak);
  //$klon = "/w/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
//$klon = $_POST['klon'];
//print_r (explode("/w", $klon));
$arrWak = (explode("/w", $klon));
$countOfWak = 0;
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

  $resultNumOfWak = new CheckSyntaxAndMelody();
  $str1 = "";
  //$result2 = new CheckSyntaxAndMelody();
  // 1.1 ตรวจจำนวนวรรค
  // ตรวจสอบจากสถานะ แล้วบอกออกมาว่า ขาดวรรคไหน ในบทไหน พร้อมบอกจำนวนวรรคทั้งหมดที่มี
  for($i=0 ; $i<count($arrIndexOfWak) ; $i++){
    if($i>=0 && $i<4 && $arrIndexOfWak[$i]=="false"){
      //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $str1 = ($str1)." ขาดวรรคที่ ".($i+1)." ของบทที่ 1"."-false/";
    }
    else if ($i>=4 && $i<8 && $arrIndexOfWak[$i]=="false") {
      //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $str1 = ($str1)." ขาดวรรคที่"." ".($i+1)." "."ของบทที่ 2"."-false/";
    }
  }
  $resultNumOfWak->numOfWak = ($str1)." จำนวนวรรคทั้งหมดคือ ".($countOfWak)." วรรค";
  $jsonNumWak = json_encode($resultNumOfWak);
  //echo $jsonNumWak;
  //echo "<br>";
  $deJsonNumWak = json_decode($jsonNumWak, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  print_r ($deJsonNumWak);
  echo "<br>.................................................<br>";

  // 1.2 ตรวจจำนวนพยางค์
  // นับพยางค์แต่ละวรรค
  $resultNumOfPayang = new CheckSyntaxAndMelody();
  $str2 = "";
  for($i=0 ; $i<$countOfWak ; $i++){
    for($j=0; $j<15 ; $j++){
      if($arrKlonPayang[$i][$j]!=null){
        $arrCountOfPayang[$i] = $arrCountOfPayang[$i] + 1;
      }
    }
  }
  //print_r ($arrCountOfPayang);
  // ตรวจสอบว่าจำนวนพยางค์ในแต่่ละวรรคถูกไหม พร้อมเก็บสถานะ
  for($i=0 ; $i<count($arrCountOfPayang) ; $i++){
    if($arrCountOfPayang[$i]==8 || $arrCountOfPayang[$i]==9){
      $arrStatusNumPayang[$i] = "trueGood";
    }
    else if($arrCountOfPayang[$i]==7){
      $arrStatusNumPayang[$i] = "true";
    }
    else if($arrCountOfPayang[$i]<8){
      $arrStatusNumPayang[$i] = "bad";
    }
    else if($arrCountOfPayang[$i]>9){
      $arrStatusNumPayang[$i] = "CheckWordPrawisrrchniis";
    }
  }
  //print_r ($arrStatusNumPayang);
  // ตรวจสอบจากสถานะ แล้วบอกออกมาว่า จำนวนพยางค์ในแต่ละวรรค ของแต่ละบทถูกต้องไหม และแสดงผล
  for($i=0 ; $i<count($arrStatusNumPayang) ; $i++){
    if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "trueGood"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $str2 = ($str2)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 "."ถูกต้อง"."-true/";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "trueGood") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $str2 = ($str2)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 "."ถูกต้อง"."-true/";
    }
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "true"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $str2 = ($str2)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 "."ถูกต้อง แต่ขาดความไพเราะ"."-true/";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "true") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $str2 = ($str2)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 "."ถูกต้อง แต่ขาดความไพเราะ"."-true/";
    }
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "bad"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $str2 = ($str2)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 "."ไม่ถูกต้อง และขาดความไพเราะ"."-false/";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "bad") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $str2 = ($str2)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 "."ไม่ถูกต้อง และขาดความไพเราะ"."-false/";
    }
    //*********************** ยังไม่ได้ตรวจคำอะกึ่งเสียง ************************************
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "CheckWordPrawisrrchniis"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $str2 = ($str2)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 "."ต้องไปตรวจอะกึ่งเสียง"."-true/";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "CheckWordPrawisrrchniis") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $str2 = ($str2)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 "."ต้องไปตรวจอะกึ่งเสียง"."-true/";
    }
  }
  $resultNumOfPayang->numOfPayang = ($str2);
  $jsonNumPayang = json_encode($resultNumOfPayang);
  //echo ($jsonNumPayang."<br>");
  $deJsonNumPayang = json_decode($jsonNumPayang, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  print_r ($deJsonNumPayang);
  echo "<br>.................................................<br>";
?>
