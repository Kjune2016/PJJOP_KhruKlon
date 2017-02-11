<?php
//ini_set('error_reporting',E_STRICT);
//error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors',1); // ถ้าเปลี่ยน 1 เป็น 0 จะไม่แสดง error
require ("prepareInput.php");
  //$strNumWak = array();
  //$reStr = "";
  //$result2 = new CheckSyntaxAndMelody();
  // 1.1 ตรวจจำนวนวรรค
function checkWak($arrWak){
    // ตรวจสอบจากสถานะ แล้วบอกออกมาว่า ขาดวรรคไหน ในบทไหน พร้อมบอกจำนวนวรรคทั้งหมดที่มี
    $countOfWak = 0;
    // วนลูปเช็คว่ามีวรรคนั้นๆไหม ไม่มีเก็บสถานะไว้ว่า false มีเก็บสภานะไว้ว่า true พร้อมนับด้วยว่ามีกี่วรรค
    //print_r ($arrWak);
    //echo "<br>";
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
    for($i=0 ; $i<count($arrIndexOfWak) ; $i++){
      if($i>=0 && $i<4 && $arrIndexOfWak[$i]=="false"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
        $arrNumWak[$i]['str'] = " ขาดวรรคที่ ".($i+1)." ของบทที่ 1";
        $arrNumWak[$i]['status'] = "false";
      }
      else if ($i>=4 && $i<8 && $arrIndexOfWak[$i]=="false") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $arrNumWak[$i]['str'] = " ขาดวรรคที่ ".(round($i%4)+1)." ของบทที่ 2";
        $arrNumWak[$i]['status'] = "false";
      }
      else if($i>=0 && $i<4 && $arrIndexOfWak[$i]=="true"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
        $arrNumWak[$i]['str'] = " มีวรรคที่ ".($i+1)." ของบทที่ 1";
        $arrNumWak[$i]['status'] = "true";
      }
      else if ($i>=4 && $i<8 && $arrIndexOfWak[$i]=="true") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $arrNumWak[$i]['str'] = " มีวรรคที่ ".(round($i%4)+1)." ของบทที่ 2";
        $arrNumWak[$i]['status'] = "true";
      }
    }
    $arrNumWak['sum'] = "จำนวนวรรคทั้งหมดคือ ".($countOfWak)." วรรค";
    return ($arrNumWak);
    //print_r ($arrIndexOfWak);
    //print_r ($arrNumWak);
    //echo "<br>";
    //$resultNumOfWak->numOfWak = ($arrNumWak);
    //$jsonNumWak = json_encode($resultNumOfWak);
    //echo $jsonNumWak; // ส่วนที่เราคืนให้พาน
    //return ($jsonNumWak);
    //echo "<br>";
    //$deJsonNumWak = json_decode($jsonNumWak, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
    //print_r ($deJsonNumWak);
    //return ($deJsonNumWak);
    //echo "<br>.................................................<br>";
}
//$a = checkWak($arrWak);
//echo $a;
//print_r ($a);

// 1.2 ตรวจจำนวนพยางค์
function checkPayang($arrWak,$arrKlonPhonemes){
  // นับพยางค์แต่ละวรรค
  $strNumPayang = "";
  //print_r ($arrCountOfPayang);
  // ตรวจสอบว่าจำนวนพยางค์ในแต่่ละวรรคถูกไหม พร้อมเก็บสถานะ
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $totalPY = count($arrKlonPhonemes[$i]);
    //echo ($totalPY)." ";
    if(($totalPY-1)==8 || ($totalPY-1)==9){
      $arrStatusNumPayang[$i] = "trueGood";
    }
    else if(($totalPY-1)==7){
      $arrStatusNumPayang[$i] = "true";
    }
    else if(($totalPY-1)<8){
      $arrStatusNumPayang[$i] = "bad";
    }
    else if(($totalPY-1)>9){
      // เรียกฟังก์ชันตรวจคำอะกึ่งเสียง โดยส่งเลขวรรคที่มีพยางค์เกิน 9 ไป
      $arrStatusNumPayang[$i] = "bad";
    }
  }
  //print_r ($arrStatusNumPayang);
  // ตรวจสอบจากสถานะ แล้วบอกออกมาว่า จำนวนพยางค์ในแต่ละวรรค ของแต่ละบทถูกต้องไหม และแสดงผล
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "trueGood"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $arrNumPayang[$i]['str'] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง";
      $arrNumPayang[$i]['status'] = "trueGood";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "trueGood") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $arrNumPayang[$i]['str'] = "จำนวนพยางค์ในวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ถูกต้อง";
        $arrNumPayang[$i]['status'] = "trueGood";
    }
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "true"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
        $arrNumPayang[$i]['str'] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง";
        $arrNumPayang[$i]['status'] = "true";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "true") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $arrNumPayang[$i]['str'] = "จำนวนพยางค์ในวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ถูกต้อง";
        $arrNumPayang[$i]['status'] = "true";
    }
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "bad"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
        $arrNumPayang[$i]['str'] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 ไม่ถูกต้อง";
        $arrNumPayang[$i]['status'] = "false";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "bad") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $arrNumPayang[$i]['str'] = "จำนวนพยางค์ในวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ไม่ถูกต้อง";
        $arrNumPayang[$i]['status'] = "false";
    }
  }
  return ($arrNumPayang);
}
//$b = checkPayang($arrWak);
//print_r ($b);


// 1.3 เสียงท้ายพยางค์
function checkTone($arrWak,$arrKlonTone){
  //$strTone = "";
  //echo count($arrWak)."<br>";
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    //echo $i." ";
    $numPY = count($arrKlonTone[$i])-1;
    //echo $numPY."+"."<br>";
    $tone = $arrKlonTone[$i][$numPY];
    //echo $tone."<br>";
    // บทที่ 1
    // วรรคที่ 1
    if($i==0){
      if($numPY >= 7){
        if($tone==2){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงเอก";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==3){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงโท";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==4){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงตรี";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==5){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงจัตวา";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==1){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงสามัญ แต่ไม่นิยมลงเสียงนี้";
          $arrOfTone[$i]['status'] = "halfTrue";
        }
      }
      else {
        $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ";
        $arrOfTone[$i]['status'] = "false";
      }
    }
    // วรรคที่ 2
    else if($i==1){
      if($numPY >=7){
        if($tone==2){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ถูกต้อง คือเสียงเอก";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==3){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ถูกต้อง คือเสียงโท";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==5){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ถูกต้อง คือเสียงจัตวา และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
          $arrOfTone[$i]['status'] = "trueGood";
        }
        else {
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงเอก เสียงโท และที่นิยมคือเสียงจัตวา";
          $arrOfTone[$i]['status'] = "false";
        }
      }
      else {
        $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงเอก เสียงโท และที่นิยมคือเสียงจัตวา";
        $arrOfTone[$i]['status'] = "false";
      }

    }
    // วรรคที่ 3 และ 4
    else if($i==2){
      if($numPY >= 7){
        if($tone==1){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง คือเสียงสามัญ และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
          $arrOfTone[$i]['status'] = "trueGood";
        }
        else if($tone==4){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง คือเสียงตรี";
          $arrOfTone[$i]['status'] = "true";
        }
        else {
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงจัตวา และที่นิยมคือเสียงสามัญ";
          $arrOfTone[$i]['status'] = "false";
        }
      }
      else {
        $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงจัตวา และที่นิยมคือเสียงสามัญ";
        $arrOfTone[$i]['status'] = "false";
      }

    }
    else if($i==3){
      if($numPY >= 7){
        if($tone==1){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง คือเสียงสามัญ และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
          $arrOfTone[$i]['status'] = "trueGood";
        }
        else if($tone==4){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง คือเสียงตรี";
          $arrOfTone[$i]['status'] = "true";
        }
        else {
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงตรี และที่นิยมคือเสียงสามัญ";
          $arrOfTone[$i]['status'] = "false";
        }
      }
      else {
        $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงตรี และที่นิยมคือเสียงสามัญ";
        $arrOfTone[$i]['status'] = "false";
      }
    }
    // บทที่ 2
    // วรรคที่ 1
    else if($i==4){
      if($numPY >=7){
        if($tone==2){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ถูกต้อง คือเสียงเอก";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==3){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ถูกต้อง คือเสียงโท";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==4){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ถูกต้อง คือเสียงตรี";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==5){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ถูกต้อง คือเสียงจัตวา";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==1){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ถูกต้อง คือเสียงสามัญ แต่ไม่นิยมลงเสียงนี้ จึงขาดความไพเราะ";
          $arrOfTone[$i]['status'] = "halfTrue";
        }
      }
      else {
        $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".(round($i%4)+1)." ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ";
        $arrOfTone[$i]['status'] = "false";
      }

    }
    // วรรคที่ 2
    else if($i==5){
      if($numPY >=7){
        if($tone==2){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ถูกต้อง คือเสียงเอก";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==3){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ถูกต้อง คือเสียงโท";
          $arrOfTone[$i]['status'] = "true";
        }
        else if($tone==5){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ถูกต้อง คือเสียงจัตวา และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
          $arrOfTone[$i]['status'] = "trueGood";
        }
        else {
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงเอก เสียงโท และที่นิยมคือเสียงจัตวา";
          $arrOfTone[$i]['status'] = "false";
        }
      }
      else {
        $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงเอก เสียงโท และที่นิยมคือเสียงจัตวา";
        $arrOfTone[$i]['status'] = "false";
      }
    }
    // วรรคที่ 3 และ 4
    else if($i==6){
      if($numPY >= 7){
        if($tone==1){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ถูกต้อง คือเสียงสามัญ และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
          $arrOfTone[$i]['status'] = "trueGood";
        }
        else if($tone==4){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ถูกต้อง คือเสียงตรี";
          $arrOfTone[$i]['status'] = "true";
        }
        else {
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงตรี และที่นิยมคือเสียงสามัญ";
          $arrOfTone[$i]['status'] = "false";
        }
      }
      else {
        $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงตรี และที่นิยมคือเสียงสามัญ";
        $arrOfTone[$i]['status'] = "false";
      }
    }
    else if($i==7){
      if($numPY >=7){
        if($tone==1){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ถูกต้อง คือเสียงสามัญ และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
          $arrOfTone[$i]['status'] = "trueGood";
        }
        else if($tone==4){
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ถูกต้อง คือเสียงตรี";
          $arrOfTone[$i]['status'] = "true";
        }
        else {
          $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงตรี และที่นิยมคือเสียงสามัญ";
          $arrOfTone[$i]['status'] = "false";
        }
      }
      else {
        $arrOfTone[$i]['str'] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i-3)." ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงตรี และที่นิยมคือเสียงสามัญ";
        $arrOfTone[$i]['status'] = "false";
      }
    }
  }
  return ($arrOfTone);
  //print_r ($arrOfTone);
  //echo "<br>";
  //$resultTone->tone = ($arrOfTone);
  //$jsonTone = json_encode($resultTone);
  //echo ($jsonTone."<br>"); // ส่วนที่เราคืนให้พาน
  //$deJsonTone = json_decode($jsonTone, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  //print_r ($deJsonTone);
  //echo "<br>.................................................<br>";
}
//$c = checkTone($arrWak,$arrKlonTone);
//print_r ($c);


// 1.4 ตรวจสัมผัสนอก
function checkExRhyme($arrWak,$arrKlonPhonemes,$rhyme){
  //echo "<br>////";
  //print_r ($rhyme);
  //echo "<br><br>";
  // ตรวจสัมผัสตามกฏ
  $indexOfRhyme = [];
  $arrExternalRhyme = [];
  //$strExternalRhyme2 = "";
  //echo count($arrWak);
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $totalPN = count($arrKlonPhonemes[$i])-1;
    //echo $totalPN;
    $check = 0;
    for($j=1 ; $j<=count($rhyme[$i]) ; $j++){
      // บทที่ 1
      if($i==0 || $i<4){

        // สัมผัสระหว่างวรรคที่ 1 กับ วรรคที่ 2
        if($i==0){
          if($rhyme[$i][1]==$rhyme[1][$j] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            if($totalPN==8 && $rhyme[$i][1]==$rhyme[1][2]){
              $indexOfRhyme[0][0] = "payangAt5";
            }
            else if($totalPN==9 && $rhyme[$i][1]==$rhyme[1][2]){
              $indexOfRhyme[0][0] = "payangAt6";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[1][1]){
              $indexOfRhyme[0][0] = "payangAt2";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[1][2]){
              $indexOfRhyme[0][0] = "payangAt3from7";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[1][3]){
              $indexOfRhyme[0][0] = "payangAt4";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[1][4]){
              $indexOfRhyme[0][0] = "payangAt5from7";
            }
            else if($totalPN==8 || $totalPN==9 && $rhyme[$i][1]==$rhyme[1][1]){
              $indexOfRhyme[0][0] = "payangAt3";
            }
            $arrExternalRhyme[$i]['str'] = "มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 1";
            $arrExternalRhyme[$i]['status'] = "true";
          }
          else if($rhyme[$i][1]!=$rhyme[1][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i]['str'] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 1";
            $arrExternalRhyme[$i]['status'] = "false";
          }
        }
        // สัมผัสระหว่างวรรคที่ 2 กับ วรรคที่ 3
        else if($i==1){
          if($rhyme[$i][3]==$rhyme[2][$j] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i]['str'] = "มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 1";
            $arrExternalRhyme[$i]['status'] = "true";
          }
          else if($rhyme[$i][3]!=$rhyme[2][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i]['str'] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 1";
            $arrExternalRhyme[$i]['status'] = "false";
          }
        }
        // สัมผัสระหว่างวรรคที่ 3 กับ วรรคที่ 4
        else if($i==2){
          if($rhyme[$i][1]==$rhyme[3][$j] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            if($totalPN==8 && $rhyme[$i][1]==$rhyme[3][2]){
              $indexOfRhyme[0][1] = "payangAt5";
            }
            else if($totalPN==9 && $rhyme[$i][1]==$rhyme[3][2]){
              $indexOfRhyme[0][1] = "payangAt6";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[3][2]){
              $indexOfRhyme[0][1] = "payangAt2";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[3][2]){
              $indexOfRhyme[0][1] = "payangAt3";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[3][3]){
              $indexOfRhyme[0][1] = "payangAt4";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[3][4]){
              $indexOfRhyme[0][1] = "payangAt5";
            }
            else if($totalPN==8 || $totalPN==9 && $rhyme[$i][1]==$rhyme[3][1]){
              $indexOfRhyme[0][1] = "payangAt3";
            }
            $arrExternalRhyme[$i]['str'] = "มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 1";
            $arrExternalRhyme[$i]['status'] = "true";
          }
          else if($rhyme[$i][1]!=$rhyme[3][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i]['str'] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 1";
            $arrExternalRhyme[$i]['status'] = "false";
          }
        }
      }
      // บทที่ 2  ปล. ยังไม่เคยสมมติตัวอย่าง
      else if($i==4 || $i<8){
        // สัมผัสระหว่างวรรคที่ 1 กับ วรรคที่ 2
        if($i==4){
          if($rhyme[$i][1]==$rhyme[5][$j] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            if($totalPN==8 && $rhyme[$i][1]==$rhyme[5][2]){
              $indexOfRhyme[0][2] = "payangAt5";
            }
            else if($totalPN==9 && $rhyme[$i][1]==$rhyme[5][2]){
              $indexOfRhyme[0][2] = "payangAt6";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[5][1]){
              $indexOfRhyme[0][2] = "payangAt2";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[5][2]){
              $indexOfRhyme[0][2] = "payangAt3";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[5][3]){
              $indexOfRhyme[0][2] = "payangAt4";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[5][4]){
              $indexOfRhyme[0][2] = "payangAt5";
            }
            else if($totalPN==8 || $totalPN==9 && $rhyme[$i][1]==$rhyme[1][1]){
              $indexOfRhyme[0][0] = "payangAt3";
            }
            $arrExternalRhyme[$i]['str'] = "มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 2";
            $arrExternalRhyme[$i]['status'] = "true";
          }
          else if($rhyme[$i][1]!=$rhyme[5][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i]['str'] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 2";
            $arrExternalRhyme[$i]['status'] = "false";
          }
        }
        // สัมผัสระหว่างวรรคที่ 2 กับ วรรคที่ 3
        else if($i==5){
          if($rhyme[$i][3]==$rhyme[6][$j] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            if($totalPN==8 && $rhyme[$i][1]==$rhyme[6][2]){
              $indexOfRhyme[0][3] = "payangAt5";
            }
            else if($totalPN==9 && $rhyme[$i][1]==$rhyme[6][2]){
              $indexOfRhyme[0][3] = "payangAt6";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[6][1]){
              $indexOfRhyme[0][3] = "payangAt2";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[6][2]){
              $indexOfRhyme[0][3] = "payangAt3";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[6][3]){
              $indexOfRhyme[0][3] = "payangAt4";
            }
            else if($totalPN==7 && $rhyme[$i][1]==$rhyme[6][4]){
              $indexOfRhyme[0][3] = "payangAt5";
            }
            else if($totalPN==8 || $totalPN==9 && $rhyme[$i][1]==$rhyme[1][1]){
              $indexOfRhyme[0][0] = "payangAt3";
            }
            $arrExternalRhyme[$i]['str'] = "มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 2";
            $arrExternalRhyme[$i]['status'] = "true";
          }
          else if($rhyme[$i][3]!=$rhyme[6][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i]['str'] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 2";
            $arrExternalRhyme[$i]['status'] = "false";
          }
        }
        // สัมผัสระหว่างวรรคที่ 3 กับ วรรคที่ 4
        else if($i==6){
          if($rhyme[$i][1]==$rhyme[7][$j] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i]['str'] = "มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 2";
            $arrExternalRhyme[$i]['status'] = "true";
          }
          else if($rhyme[$i][1]!=$rhyme[7][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i]['str'] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 2";
            $arrExternalRhyme[$i]['status'] = "false";
          }
        }
      }
    }
    // สัมผัสระหว่างบท   ปล. ยังไม่เคยสมมติตัวอย่าง
  }
  if((count($arrWak)-1)>4 || (count($arrWak)-1)<8){
    if($rhyme[3][3]==$rhyme[5][3] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
      $check = 1;
      $arrExternalRhyme['connect']['str'] = "มีสัมผัสนอกระหว่างบท";
      $arrExternalRhyme['connect']['status'] = "true";
    }
    else if($rhyme[3][3]!=$rhyme[5][3] && $check!=0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
      $check = 1;
      $arrExternalRhyme['connect']['str'] = "ไม่มีสัมผัสนอกระหว่างบท";
      $arrExternalRhyme['connect']['status'] = "false";
    }
  }
  //print_r ($indexOfRhyme);
  return ($arrExternalRhyme);
}
//$d = checkExRhyme($arrWak,$arrKlonPhonemes,$rhyme);
//print_r ($d);



// 1.5 สัมผัสซ้ำ
function checkDupRhyme($arrWak,$arrKlonPhonemesAndTone,$arrKlonPayang){
  $PY = [];
  $PY2 = [];
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $totalPY = count($arrKlonPhonemesAndTone[$i]);
    //echo ($totalPN)." ";
      // บทที่ 1
    if($i==0 || $i<4){
    // กรณี 8 9 and 7 พยางค์
    // วรรคที่ 1 บทที่ 1
      if($i==0){
        if($totalPY>=7){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if($totalPY<7){
          $PY[$i][0] ="จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 2
      else if($i==1){
        if(($totalPY-1)==8){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][5];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)>=9){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][6];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)==7){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][2];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][4];
          $PY[$i][3] =$arrKlonPhonemesAndTone[$i][5];
          $PY[$i][4] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)<7){
          $PY[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 3
      else if($i==2){
        if(($totalPY-1)>=7){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)<7){
          $PY[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 4
      else if($i==3){
        if(($totalPY-1)==8){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][5];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)>=9){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][6];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)==7){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][2];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][4];
          $PY[$i][3] =$arrKlonPhonemesAndTone[$i][5];
          $PY[$i][4] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)<7){
          $PY[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
    }
    // บทที่ 2
    if($i>=4 || $i<8){
      // กรณี 8 9 and 7 พยางค์
      // วรรคที่ 1 บทที่ 2
      if($i==4){
        if(($totalPY-1)>=7){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)<7){
          $PY[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 2
      else if($i==5){
        if(($totalPY-1)==8){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][5];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)>=9){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][6];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)==7){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][2];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][4];
          $PY[$i][3] =$arrKlonPhonemesAndTone[$i][5];
          $PY[$i][4] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)<7){
          $PY[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 3
      else if($i==6){
        if(($totalPY-1)>=7){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)<7){
          $PY[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 4
      else if($i==7){
        if(($totalPY-1)==8){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][5];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)>=9){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][6];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else if(($totalPY-1)==7){
          $PY[$i][0] =$arrKlonPhonemesAndTone[$i][2];
          $PY[$i][1] =$arrKlonPhonemesAndTone[$i][3];
          $PY[$i][2] =$arrKlonPhonemesAndTone[$i][4];
          $PY[$i][3] =$arrKlonPhonemesAndTone[$i][5];
          $PY[$i][4] =$arrKlonPhonemesAndTone[$i][$totalPY-1];
        }
        else {
          $PY[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
    }
  }
  //print_r($PY);
  //echo "<br>============================<br>";
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $totalPY2 = count($arrKlonPayang[$i]);
    //echo ($totalPY2)." ";
    // บทที่ 1
    if($i==0 || $i<4){
      // กรณี 8 9 and 7 พยางค์
      // วรรคที่ 1 บทที่ 1
      if($i==0){
        if(($totalPY2-1)>=7){
          $PY2[$i][0] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)<7){
          $PY2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 2
      else if($i==1){
        if(($totalPY2-1)==8){
          $PY2[$i][0] =$arrKlonPayang[$i][3];
          $PY2[$i][1] =$arrKlonPayang[$i][5];
          $PY2[$i][2] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)>=9){
          $PY2[$i][0] =$arrKlonPayang[$i][3];
          $PY2[$i][1] =$arrKlonPayang[$i][6];
          $PY2[$i][2] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)==7){
          $PY2[$i][0] =$arrKlonPayang[$i][2];
          $PY2[$i][1] =$arrKlonPayang[$i][3];
          $PY2[$i][2] =$arrKlonPayang[$i][4];
          $PY2[$i][3] =$arrKlonPayang[$i][5];
          $PY2[$i][4] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else {
          $PY2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 3
      else if($i==2){
        if(($totalPY2-1)>=7){
          $PY2[$i][0] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)<7){
          $PY2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 4
      else if($i==3){
        if(($totalPY2-1)==8){
          $PY2[$i][0] =$arrKlonPayang[$i][3];
          $PY2[$i][1] =$arrKlonPayang[$i][5];
          $PY2[$i][2] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)>=9){
          $PY2[$i][0] =$arrKlonPayang[$i][3];
          $PY2[$i][1] =$arrKlonPayang[$i][6];
          $PY2[$i][2] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)==7){
          $PY2[$i][0] =$arrKlonPayang[$i][2];
          $PY2[$i][1] =$arrKlonPayang[$i][3];
          $PY2[$i][2] =$arrKlonPayang[$i][4];
          $PY2[$i][3] =$arrKlonPayang[$i][5];
          $PY2[$i][4] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else {
          $PY2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
    }
    // บทที่ 2
    if($i>=4 || $i<8){
      // กรณี 8 9 and 7 พยางค์
      // วรรคที่ 1 บทที่ 2
      if($i==4){
        if(($totalPY2-1)>=7){
          $PY2[$i][0] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)<7){
          $PY2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 2
      else if($i==5){
        if(($totalPY2-1)==8){
          $PY2[$i][0] =$arrKlonPayang[$i][3];
          $PY2[$i][1] =$arrKlonPayang[$i][5];
          $PY2[$i][2] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)>=9){
          $PY2[$i][0] =$arrKlonPayang[$i][3];
          $PY2[$i][1] =$arrKlonPayang[$i][6];
          $PY2[$i][2] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)==7){
          $PY2[$i][0] =$arrKlonPayang[$i][2];
          $PY2[$i][1] =$arrKlonPayang[$i][3];
          $PY2[$i][2] =$arrKlonPayang[$i][4];
          $PY2[$i][3] =$arrKlonPayang[$i][5];
          $PY2[$i][4] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else {
          $PY2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 3
      else if($i==6){
        if(($totalPY2-1)>=7){
          $PY2[$i][0] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)<7){
          $PY2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
      // วรรคที่ 4
      else if($i==7){
        if(($totalPY2-1)==8){
          $PY2[$i][0] =$arrKlonPayang[$i][3];
          $PY2[$i][1] =$arrKlonPayang[$i][5];
          $PY2[$i][2] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)>=9){
          $PY2[$i][0] =$arrKlonPayang[$i][3];
          $PY2[$i][1] =$arrKlonPayang[$i][6];
          $PY2[$i][2] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else if(($totalPY2-1)==7){
          $PY2[$i][0] =$arrKlonPayang[$i][2];
          $PY2[$i][1] =$arrKlonPayang[$i][3];
          $PY2[$i][2] =$arrKlonPayang[$i][4];
          $PY2[$i][3] =$arrKlonPayang[$i][5];
          $PY2[$i][4] =$arrKlonPayang[$i][$totalPY2-1];
        }
        else {
          $PY2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
        }
      }
    }
  }
  //print_r ($PY2);
  //echo "<br>222222<br>";
  //print_r ($PY2);
  //print_r($tone);
  //echo "<br><br><br>";
  //$arrDupPn = [];
  //$arrStatusDup = [];
  $arrDupRhyme = [];
  //for($i=0 ; $i<count($arrWak)-1 ; $i++){
  //$totalPY = count($arrKlonPayang[$i])-1;
  //echo $totalPY;
  if((count($arrWak)-1)<=4){
    if(($PY[0][0]!="จำนวนพยางค์ไม่ถูกต้อง") && ($PY[1][0]!="จำนวนพยางค์ไม่ถูกต้อง") && ($PY[2][0]!="จำนวนพยางค์ไม่ถูกต้อง")
      && ($PY[3][0]!="จำนวนพยางค์ไม่ถูกต้อง")){
      if(($PY[0][0]==$PY[1][0]) || ($PY[0][0]==$PY[1][1])){
        $arrDupRhyme[0]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[0][0]);
        $arrDupRhyme[0]['status'] = "false";
      }
      else if(($PY[0][0]!=$PY[1][0]) && ($PY[0][0]!=$PY[1][1])){
        $arrDupRhyme[0]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[0]['status'] = "true";
      }
      if(($PY[1][0]==$PY[1][1])){
        $arrDupRhyme[1]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[1][0]);
        $arrDupRhyme[1]['status'] = "false";
      }
      else if($PY[1][0]!=$PY[1][1]){
        $arrDupRhyme[1]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[1]['status'] = "true";
      }
      if(($PY[1][2]==$PY[2][0]) || ($PY[1][2]==$PY[3][0]) || ($PY[1][2]==$PY[3][1])){
        $arrDupRhyme[2]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[1][2]);
        $arrDupRhyme[2]['status'] = "false";
      }
      else if(($PY[1][2]!=$PY[2][0]) && ($PY[1][2]!=$PY[3][0]) && ($PY[1][2]!=$PY[3][1])){
        $arrDupRhyme[2]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[2]['status'] = "true";
      }
      if(($PY[2][0]==$PY[3][0]) || ($PY[2][0]==$PY[3][1])){
        $arrDupRhyme[3]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[2][0]);
        $arrDupRhyme[3]['status'] = "false";
      }
      else if(($PY[2][0]!=$PY[3][0]) && ($PY[2][0]!=$PY[3][1])){
        $arrDupRhyme[3]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[3]['status'] = "truee";
      }
      if(($PY[3][0]==$PY[3][1])){
        $arrDupRhyme[4]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[3][0]);
        $arrDupRhyme[4]['status'] = "false";
      }
      else if($PY[3][0]!=$PY[3][1]){
        $arrDupRhyme[4]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[4]['status'] = "true";
      }
    }
    else if(($PY[0][0]=="จำนวนพยางค์ไม่ถูกต้อง") || ($PY[1][0]=="จำนวนพยางค์ไม่ถูกต้อง") || ($PY[2][0]=="จำนวนพยางค์ไม่ถูกต้อง")
          || ($PY[3][0]=="จำนวนพยางค์ไม่ถูกต้อง")){
      $arrDupRhyme[0]['str'] = "ไม่มีสัมผัสซ้ำ";
      $arrDupRhyme[0]['status'] = "veryFalse";
    }
  }
  else if((count($arrWak)-1)>4){
    if(($PY[0][0]!="จำนวนพยางค์ไม่ถูกต้อง") && ($PY[1][0]!="จำนวนพยางค์ไม่ถูกต้อง") && ($PY[2][0]!="จำนวนพยางค์ไม่ถูกต้อง")
          && ($PY[3][0]!="จำนวนพยางค์ไม่ถูกต้อง")&& ($PY[4][0]!="จำนวนพยางค์ไม่ถูกต้อง") && ($PY[5][0]!="จำนวนพยางค์ไม่ถูกต้อง")
            && ($PY[6][0]!="จำนวนพยางค์ไม่ถูกต้อง") && ($PY[7][0]!="จำนวนพยางค์ไม่ถูกต้อง")){
      if(($PY[0][0]==$PY[1][0]) || ($PY[0][0]==$PY[1][1])){
        $arrDupRhyme[0]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[0][0]);
        $arrDupRhyme[0]['status'] = "false";
      }
      else if(($PY[0][0]!=$PY[1][0]) && ($PY[0][0]!=$PY[1][1])){
        $arrDupRhyme[0]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[0]['status'] = "true";
      }
      if(($PY[1][0]==$PY[1][1])){
        $arrDupRhyme[1]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[1][0]);
        $arrDupRhyme[1]['status'] = "false";
      }
      else if($PY[1][0]!=$PY[1][1]){
        $arrDupRhyme[1]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[1]['status'] = "true";
      }
      if(($PY[1][2]==$PY[2][0]) || ($PY[1][2]==$PY[3][0]) || ($PY[1][2]==$PY[3][1])){
        $arrDupRhyme[2]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[1][2]);
        $arrDupRhyme[2]['status'] = "false";
      }
      else if(($PY[1][2]!=$PY[2][0]) && ($PY[1][2]!=$PY[3][0]) && ($PY[1][2]!=$PY[3][1])){
        $arrDupRhyme[2]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[2]['status'] = "true";
      }
      if(($PY[2][0]==$PY[3][0]) || ($PY[2][0]==$PY[3][1])){
        $arrDupRhyme[3]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[2][0]);
        $arrDupRhyme[3]['status'] = "false";
      }
      else if(($PY[2][0]!=$PY[3][0]) && ($PY[2][0]!=$PY[3][1])){
        $arrDupRhyme[3]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[3]['status'] = "truee";
      }
      if(($PY[3][0]==$PY[3][1])){
        $arrDupRhyme[4]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[3][0]);
        $arrDupRhyme[4]['status'] = "false";
      }
      else if($PY[3][0]!=$PY[3][1]){
        $arrDupRhyme[4]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[4]['status'] = "true";
      }
      if(($PY[3][2]==$PY[5][2]) || ($PY[3][2]==$PY[6][0]) || ($PY[3][2]==$PY[7][0]) || ($PY[3][2]==$PY[7][1])){
        $arrDupRhyme[5]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[3][2]);
        $arrDupRhyme[5]['status'] = "false";
      }
      else if(($PY[3][2]!=$PY[5][2]) && ($PY[3][2]!=$PY[6][0]) && ($PY[3][2]!=$PY[7][0]) && ($PY[3][2]!=$PY[7][1])){
        $arrDupRhyme[5]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[5]['status'] = "true";
      }
      if(($PY[4][0]==$PY[5][0]) || ($PY[4][0]==$PY[5][1])){
        $arrDupRhyme[6]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[4][0]);
        $arrDupRhyme[6]['status'] = "false";
      }
      else if(($PY[4][0]!=$PY[5][0]) && ($PY[4][0]!=$PY[5][1])){
        $arrDupRhyme[6]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[6]['status'] = "true";
      }
      if(($PY[5][0]==$PY[5][1])){
        $arrDupRhyme[7]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[5][0]);
        $arrDupRhyme[7]['status'] = "false";
      }
      else if(($PY[5][0]!=$PY[5][1])){
        $arrDupRhyme[7]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[7]['status'] = "true";
      }
      if(($PY[5][2]==$PY[6][0]) || ($PY[5][2]==$PY[7][0]) || ($PY[5][2]==$PY[7][1])){
        $arrDupRhyme[8]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[5][2]);
        $arrDupRhyme[8]['status'] = "false";
      }
      else if(($PY[5][2]!=$PY[6][0]) && ($PY[5][2]!=$PY[7][0]) && ($PY[5][2]!=$PY[7][1])){
        $arrDupRhyme[8]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[8]['status'] = "true";
      }
      if(($PY[6][0]==$PY[7][0]) || ($PY[6][0]==$PY[7][1])){
        $arrDupRhyme[9]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[6][0]);
        $arrDupRhyme[9]['status'] = "false";
      }
      else if(($PY[6][0]!=$PY[7][0]) && ($PY[6][0]!=$PY[7][1])){
        $arrDupRhyme[9]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[9]['status'] = "true";
      }
      if(($PY[7][0]==$PY[7][1])){
        $arrDupRhyme[10]['str'] = "มีสัมผัสซ้ำที่คำว่า ".($PY2[7][0]);
        $arrDupRhyme[10]['status'] = "false";
      }
      else if(($PY[7][0]!=$PY[7][1])){
        $arrDupRhyme[10]['str'] = "ไม่มีสัมผัสซ้ำ";
        $arrDupRhyme[10]['status'] = "true";
      }
    }
    else if(($PY[0][0]=="จำนวนพยางค์ไม่ถูกต้อง") || ($PY[1][0]=="จำนวนพยางค์ไม่ถูกต้อง") || ($PY[2][0]=="จำนวนพยางค์ไม่ถูกต้อง")
          || ($PY[3][0]=="จำนวนพยางค์ไม่ถูกต้อง") || ($PY[4][0]=="จำนวนพยางค์ไม่ถูกต้อง") || ($PY[5][0]=="จำนวนพยางค์ไม่ถูกต้อง")
          || ($PY[6][0]=="จำนวนพยางค์ไม่ถูกต้อง") || ($PY[7][0]=="จำนวนพยางค์ไม่ถูกต้อง")){
      $arrDupRhyme[0]['str'] = "ไม่มีสัมผัสซ้ำ";
      $arrDupRhyme[0]['status'] = "veryFalse";
    }
  }
  
      //}
      //print_r($arrDupRhyme);
      //echo "<br><br>";
      //echo "<br>".$PY[6][0]."<br>".$PY[7][0]."<br>";
  return ($arrDupRhyme);
  //print_r ($arrDupRhyme);
}
//$e = checkDupRhyme($PY);
//print_r ($e);


// 1.6 ชิงสัมผัส  พังค่ะ
function checkChingRhyme($arrWak,$arrKlonPhonemes,$rhyme){
  echo "<pre>";
  //print_r($rhyme);
  //echo "<br>ข้างบน rhyme<br>";
  //echo "<br>".(count($arrWak)-1)."<br>";
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $totalPN = count($arrKlonPhonemes[$i])-1;
    //echo $totalPN;
    $check = 0;
    //for($j=1 ; $j<=count($rhyme[$i]) ; $j++){
      // บทที่ 1
      if(($i==0 || $i<4) && ($rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง")){
        // สัมผัสระหว่างวรรคที่ 1 กับ วรรคที่ 2
        if($i==0){
          if($totalPN==8 && $rhyme[$i][1]==$rhyme[1][2]){
            $indexOfRhyme[0][0] = "payangAt5";
          }
          else if($totalPN>=9 && $rhyme[$i][1]==$rhyme[1][2]){
            $indexOfRhyme[0][0] = "payangAt6";
          }
          else if($totalPN==7 && $rhyme[$i][1]==$rhyme[1][1]){
            $indexOfRhyme[0][0] = "payangAt2";
          }
          else if($totalPN==7 && $rhyme[$i][1]==$rhyme[1][2]){
            $indexOfRhyme[0][0] = "payangAt3from7";
          }
          else if($totalPN==7 && $rhyme[$i][1]==$rhyme[1][3]){
            $indexOfRhyme[0][0] = "payangAt4";
          }
          else if($totalPN==7 && $rhyme[$i][1]==$rhyme[1][4]){
            $indexOfRhyme[0][0] = "payangAt5from7";
          }
          else if($totalPN==8 || $totalPN>=9 && $rhyme[$i][1]==$rhyme[1][1]){
            $indexOfRhyme[0][0] = "payangAt3";
          }
          else {
            $indexOfRhyme[0][0] = "ไม่มีสัมผัสระหว่างวรรค";
          }
        }
        else if($i==2){
          if($totalPN==8 && $rhyme[$i][1]==$rhyme[3][2]){
            $indexOfRhyme[0][1] = "payangAt5";
          }
          else if($totalPN>=9 && $rhyme[$i][1]==$rhyme[3][2]){
            $indexOfRhyme[0][1] = "payangAt6";
          }
          else if($totalPN==7 && $rhyme[$i][1]==$rhyme[3][2]){
            $indexOfRhyme[0][1] = "payangAt2";
          }
          else if($totalPN==7 && $rhyme[$i][1]==$rhyme[3][2]){
            $indexOfRhyme[0][1] = "payangAt3";
          }
          else if($totalPN==7 && $rhyme[$i][1]==$rhyme[3][3]){
            $indexOfRhyme[0][1] = "payangAt4";
          }
          else if($totalPN==7 && $rhyme[$i][1]==$rhyme[3][4]){
            $indexOfRhyme[0][1] = "payangAt5";
          }
          else if($totalPN==8 || $totalPN>=9 && $rhyme[$i][1]==$rhyme[3][1]){
            $indexOfRhyme[0][1] = "payangAt3";
          }
          else {
            $indexOfRhyme[0][1] = "ไม่มีสัมผัสระหว่างวรรค";
          }
        }
      }
      // บทที่ 2  ปล. ยังไม่เคยสมมติตัวอย่าง
     else if(($i>=4 || $i<8) && ($rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง")){
       // สัมผัสระหว่างวรรคที่ 1 กับ วรรคที่ 2
       if($i==4){
         if($totalPN==8 && $rhyme[$i][1]==$rhyme[5][2]){
           $indexOfRhyme[0][2] = "payangAt5";
         }
         else if($totalPN>=9 && $rhyme[$i][1]==$rhyme[5][2]){
           $indexOfRhyme[0][2] = "payangAt6";
         }
         else if($totalPN==7 && $rhyme[$i][1]==$rhyme[5][1]){
           $indexOfRhyme[0][2] = "payangAt2";
         }
         else if($totalPN==7 && $rhyme[$i][1]==$rhyme[5][2]){
           $indexOfRhyme[0][2] = "payangAt3";
         }
         else if($totalPN==7 && $rhyme[$i][1]==$rhyme[5][3]){
           $indexOfRhyme[0][2] = "payangAt4";
         }
         else if($totalPN==7 && $rhyme[$i][1]==$rhyme[5][4]){
           $indexOfRhyme[0][2] = "payangAt5";
         }
         else if($totalPN==8 || $totalPN>=9 && $rhyme[$i][1]==$rhyme[1][1]){
           $indexOfRhyme[0][2] = "payangAt3";
         }
         else {
           $indexOfRhyme[0][2] = "ไม่มีสัมผัสระหว่างวรรค";
         }
       }
       // สัมผัสระหว่างวรรคที่ 2 กับ วรรคที่ 3
       else if($i==6){
         if($totalPN==8 && $rhyme[$i][1]==$rhyme[6][2]){
           $indexOfRhyme[0][3] = "payangAt5";
         }
         else if($totalPN>=9 && $rhyme[$i][1]==$rhyme[6][2]){
           $indexOfRhyme[0][3] = "payangAt6";
         }
         else if($totalPN==7 && $rhyme[$i][1]==$rhyme[6][1]){
           $indexOfRhyme[0][3] = "payangAt2";
         }
         else if($totalPN==7 && $rhyme[$i][1]==$rhyme[6][2]){
           $indexOfRhyme[0][3] = "payangAt3";
         }
         else if($totalPN==7 && $rhyme[$i][1]==$rhyme[6][3]){
           $indexOfRhyme[0][3] = "payangAt4";
         }
         else if($totalPN==7 && $rhyme[$i][1]==$rhyme[6][4]){
           $indexOfRhyme[0][3] = "payangAt5";
         }
         else if($totalPN==8 || $totalPN>=9 && $rhyme[$i][1]==$rhyme[1][1]){
           $indexOfRhyme[0][3] = "payangAt3";
         }
         else {
           $indexOfRhyme[0][3] = "ไม่มีสัมผัสระหว่างวรรค";
         }
       }
     }
     else if(($rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง")){
       $indexOfRhyme[$i][0] = "ไม่มีสัมผัสระหว่างวรรค";
     }
    //}
  }
  //print_r($indexOfRhyme);
  //echo "<br><br>";
  $indexChing = [];
  //echo count($arrWak)-1;
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $totalPN = count($arrKlonPhonemes[$i])-1;
    //echo "///////////".$totalPN;
    if($totalPN>=7){
      if($i==1 || $i==3 || $i==5 || $i==7){
        if($i==1){
          if($indexOfRhyme[0][0]=="payangAt5"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][4];
          }
          else if($indexOfRhyme[0][0]=="payangAt6"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][5];
          }
          else if($indexOfRhyme[0][0]=="payangAt2"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
          }
          else if($indexOfRhyme[0][0]=="payangAt3from7"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
          }
          else if($indexOfRhyme[0][0]=="payangAt4"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
          }
          else if($indexOfRhyme[0][0]=="payangAt5from7"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
          }
          else if($indexOfRhyme[0][0]=="payangAt3"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
          }
          else if($indexOfRhyme[0][0] == "ไม่มีสัมผัสระหว่างวรรค"){
            $indexChing[$i][0] = "ไม่มีสัมผัสระหว่างวรรค";
          }
        }
        else if($i==3){
          if($indexOfRhyme[0][1]=="payangAt5"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][4];
          }
          else if($indexOfRhyme[0][1]=="payangAt6"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][5];
          }
          else if($indexOfRhyme[0][1]=="payangAt2"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
          }
          else if($indexOfRhyme[0][1]=="payangAt3from7"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
          }
          else if($indexOfRhyme[0][1]=="payangAt4"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
          } 
          else if($indexOfRhyme[0][1]=="payangAt5from7"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
          }
          else if($indexOfRhyme[0][1]=="payangAt3"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
          }
          else if($indexOfRhyme[0][1] == "ไม่มีสัมผัสระหว่างวรรค"){
            $indexChing[$i][0] = "ไม่มีสัมผัสระหว่างวรรค";
          }
        }
        else if($i==5){
          if($indexOfRhyme[0][2]=="payangAt5"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][4];
          }
          else if($indexOfRhyme[0][2]=="payangAt6"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][5];
          }
          else if($indexOfRhyme[0][2]=="payangAt2"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
          }
          else if($indexOfRhyme[0][2]=="payangAt3from7"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
          }
          else if($indexOfRhyme[0][2]=="payangAt4"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
          }
          else if($indexOfRhyme[0][2]=="payangAt5from7"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
          }
          else if($indexOfRhyme[0][2]=="payangAt3"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
          }
          else if($indexOfRhyme[0][2] == "ไม่มีสัมผัสระหว่างวรรค"){
            $indexChing[$i][0] = "ไม่มีสัมผัสระหว่างวรรค";
          }
        }
        else if($i==7){
          if($indexOfRhyme[0][3]=="payangAt5"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][4];
          }
          else if($indexOfRhyme[0][3]=="payangAt6"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][5];
          }
          else if($indexOfRhyme[0][3]=="payangAt2"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
          }
          else if($indexOfRhyme[0][3]=="payangAt3from7"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
          }
          else if($indexOfRhyme[0][3]=="payangAt4"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
          }
          else if($indexOfRhyme[0][3]=="payangAt5from7"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
          }
          else if($indexOfRhyme[0][3]=="payangAt3"){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
          }
          else if($indexOfRhyme[0][3] == "ไม่มีสัมผัสระหว่างวรรค"){
            $indexChing[$i][0] = "ไม่มีสัมผัสระหว่างวรรค";
          }
        }
      }
      else if($i==2 || $i==6){
        //echo $totalPN;
        if($i==2){
          if($totalPN==8){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][4] = $arrKlonPhonemes[$i][5];
            $indexChing[$i][5] = $arrKlonPhonemes[$i][6];
            $indexChing[$i][6] = $arrKlonPhonemes[$i][7];
          }
          else if($totalPN==9){  //ถ้ามากกว่า 9 พยางค์แล้วเป็นคำอะกึ่งเสียงจะรวบแล้วเป็น 9 พยางค์
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][4] = $arrKlonPhonemes[$i][5];
            $indexChing[$i][5] = $arrKlonPhonemes[$i][6];
            $indexChing[$i][6] = $arrKlonPhonemes[$i][7];
            $indexChing[$i][7] = $arrKlonPhonemes[$i][8];
          }
          else if($totalPN==7){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][4] = $arrKlonPhonemes[$i][5];
            $indexChing[$i][5] = $arrKlonPhonemes[$i][6];
          }
          else if($totalPN>9){  //ถ้ามากกว่า 9 พยางค์แล้วเป็นคำอะกึ่งเสียงจะรวบแล้วเป็น 9 พยางค์
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][4] = $arrKlonPhonemes[$i][5];
            $indexChing[$i][5] = $arrKlonPhonemes[$i][6];
            $indexChing[$i][6] = $arrKlonPhonemes[$i][7];
            $indexChing[$i][7] = $arrKlonPhonemes[$i][$totalPN];
          }
        }
        else if($i==6){
          if($totalPN==8){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][4] = $arrKlonPhonemes[$i][5];
            $indexChing[$i][5] = $arrKlonPhonemes[$i][6];
            $indexChing[$i][6] = $arrKlonPhonemes[$i][7];
          }
          else if($totalPN==9){  //ถ้ามากกว่า 9 พยางค์แล้วเป็นคำอะกึ่งเสียงจะรวบแล้วเป็น 9 พยางค์
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][4] = $arrKlonPhonemes[$i][5];
            $indexChing[$i][5] = $arrKlonPhonemes[$i][6];
            $indexChing[$i][6] = $arrKlonPhonemes[$i][7];
            $indexChing[$i][7] = $arrKlonPhonemes[$i][8];
          }
          else if($totalPN==7){
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][4] = $arrKlonPhonemes[$i][5];
            $indexChing[$i][5] = $arrKlonPhonemes[$i][6];
          }
          else if($totalPN>9){  //ถ้ามากกว่า 9 พยางค์แล้วเป็นคำอะกึ่งเสียงจะรวบแล้วเป็น 9 พยางค์
            $indexChing[$i][0] = $arrKlonPhonemes[$i][1];
            $indexChing[$i][1] = $arrKlonPhonemes[$i][2];
            $indexChing[$i][2] = $arrKlonPhonemes[$i][3];
            $indexChing[$i][3] = $arrKlonPhonemes[$i][4];
            $indexChing[$i][4] = $arrKlonPhonemes[$i][5];
            $indexChing[$i][5] = $arrKlonPhonemes[$i][6];
            $indexChing[$i][6] = $arrKlonPhonemes[$i][7];
            $indexChing[$i][7] = $arrKlonPhonemes[$i][$totalPN];
          }
        }
      }
    }
    else {
      $indexChing[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
    }
  }
  //print_r($indexChing);
  //echo "<br>===================<br>";
  for($i=1 ; $i<=count($indexChing)+1 ; $i++){
    $strChingRhyme = "";
    if($indexChing[$i][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
      for($j=0 ; $j<count($indexChing[$i]) ; $j++){
        if($i!=4){
          $strChingRhyme = ($strChingRhyme)."~".($indexChing[$i][$j]);
          //echo $strChingRhyme."<br>";
          $indexChing2[$i] = explode("~",$strChingRhyme);
        }
      }
    }
    else {
      $indexChing2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
    }
  }
  //print_r ($indexChing2);
  //echo "<br>11111111111111<br>";
  for($i=1 ; $i<=count($indexChing2)+1 ; $i++){
    $index = 0;
    for($j=0 ; $j<count($indexChing2[$i]) ; $j+=2){
      if($indexChing2[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง" && $i!=4){
        $rhymeChing[$i][$index] = $indexChing2[$i][$j];
        $index = $index+1;
      }
      else {
        $rhymeChing[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
      }
    }
  }
  //print_r($rhymeChing);
  //echo "<br>ข้างบน rhymeChing<br>";
  $strCheckChing = "";
  $checkChing = [];
  $arrStatusChing = [];
  $arrChingRhyme = [];
  for($i=1 ; $i<=(count($arrWak)-1) ; $i++){
    for($j=0 ;$j<=count($rhymeChing[$i]) ; $j++){
      //echo (count($rhymeChing[$i]))."<br>";
      //if($rhymeChing[$i][0] != "จำนวนพยางคไม่ถูกต้อง"){
        if($i==1 || $i==3 || $i==5 || $i==7){
          if($i==1){
            if($rhymeChing[1][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
              if(count($rhymeChing[$i])<=3){
                if($rhymeChing[$i][$j]==$rhyme[$i][1]){
                  $checkChing[$i+1] = "false";
                  //echo "errrrrr";
                }
                else if($checkChing[$i+1] != "false"){
                  $checkChing[$i+1] = "true";
                }
                else {
                  $checkChing[$i+1] = "false";
                }
              }
              else {
                if($rhymeChing[$i][$j]==$rhyme[$i][2]){
                  $checkChing[$i+1] = "false";
                }
                else if($checkChing[$i+1] != "false"){
                  $checkChing[$i+1] = "true";
                }
                else {
                  $checkChing[$i+1] = "false";
                }
              }
            }
            else if($rhymeChing[1][0] == "จำนวนพยางค์ไม่ถูกต้อง"){
              $checkChing[$i+1] = "veryFalse";
            }
          }
          else if($i==3){
            if($rhymeChing[3][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
              if(count($rhymeChing[$i])<=3){
                if($rhymeChing[$i][$j]==$rhyme[$i][1]){
                  $checkChing[$i+1] = "false";
                }
                else if($checkChing[$i+1] != "false"){
                  $checkChing[$i+1] = "true";
                }
                else {
                  $checkChing[$i+1] = "false";
                }
              }
              else {
                if($rhymeChing[$i][$j]==$rhyme[$i][2]){
                  $checkChing[$i+1] = "false";
                }
                else if($checkChing[$i+1] != "false"){
                  $checkChing[$i+1] = "true";
                }
                else {
                  $checkChing[$i+1] = "false";
                }
              }
            }
            else if($rhymeChing[3][0] == "จำนวนพยางค์ไม่ถูกต้อง"){
              $checkChing[$i+1] = "veryFalse";
            }
          }
          else if($i==5){
            if($rhymeChing[5][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
              if(count($rhymeChing[$i])<=3){
                if($rhymeChing[$i][$j]==$rhyme[$i][1]){
                  $checkChing[$i+1] = "false";
                }
                else if($checkChing[$i+1] != "false"){
                  $checkChing[$i+1] = "true";
                }
                else {
                  $checkChing[$i+1] = "false";
                }
              }
              else {
                if($rhymeChing[$i][$j]==$rhyme[$i][2]){
                  $checkChing[$i+1] = "false";
                }
                else if($checkChing[$i+1] != "false"){
                  $checkChing[$i+1] = "true";
                }
                else {
                  $checkChing[$i+1] = "false";
                }
              }
            }
            else if($rhymeChing[5][0] == "จำนวนพยางค์ไม่ถูกต้อง"){
              $checkChing[$i+1] = "veryFalse";
            }
          }
          else if($i==7){
            if($rhymeChing[7][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
              if(count($rhymeChing[$i])<=3){
                if($rhymeChing[$i][$j]==$rhyme[$i][1]){
                  $checkChing[$i+1] = "false";
                }
                else if($checkChing[$i+1] != "false"){
                  $checkChing[$i+1] = "true";
                }
                else {
                  $checkChing[$i+1] = "false";
                }
              }
              else {
                if($rhymeChing[$i][$j]==$rhyme[$i][2]){
                  $checkChing[$i+1] = "false";
                }
                else if($checkChing[$i+1] != "false"){
                  $checkChing[$i+1] = "true";
                }
                else {
                  $checkChing[$i+1] = "false";
                }
              }
            }
            else if($rhymeChing[7][0] == "จำนวนพยางค์ไม่ถูกต้อง"){
              $checkChing[$i+1] = "veryFalse";
            }
          }
        }
        else if($i==2 || $i==6){
          if($i==2){
            if($rhymeChing[2][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
              if($rhymeChing[$i][$j]==$rhyme[$i][1]){
                $checkChing[$i+1] = "false";
              }
              else if($checkChing[$i+1] != "false"){
                $checkChing[$i+1] = "true";
              } 
              else {
                $checkChing[$i+1] = "false";
              }
            }
            else if($rhymeChing[2][0] == "จำนวนพยางค์ไม่ถูกต้อง"){
              $checkChing[$i+1] = "veryFalse";
            }
          }
          else if($i==6){
            if($rhymeChing[6][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
              if($rhymeChing[$i][$j]==$rhyme[$i][1]){
                $checkChing[$i+1] = "false";
              }
              else if($checkChing[$i+1] != "false"){
                $checkChing[$i+1] = "true";
              }
              else {
                $checkChing[$i+1] = "false";
              }
            }
            else if($rhymeChing[6][0] == "จำนวนพยางค์ไม่ถูกต้อง"){
              $checkChing[$i+1] = "veryFalse";
            }
          } 
        }
      //}
      //else {
        //$checkChing[0] = "veryFalse";
      //}
    }
  }
  //print_r($indexOfRhyme);
  //echo "<br>1<br>";
  print_r($checkChing);
  echo "<br>===========<br>";
  //print_r($rhymeChing);
  //echo "<br>======".($rhymeChing[4][0]);
  //echo "<br>3<br>";
  for($i=2 ; $i<=count($arrWak)-1 ; $i++){
    if($checkChing[$i] != "veryFalse"){
      if($i==2 || $i==3 || $i==4){
        if($checkChing[$i]=="true"){
          $arrChingRhyme[$i]['str'] = "ไม่มีตำแหน่งชิงสัมผัสในวรรคที่ ".($i)." ของบทที่ 1";
          $arrChingRhyme[$i]['status'] = "true";
        }
        else if($checkChing[$i]=="false"){
          $arrChingRhyme[$i]['str'] = "มีตำแหน่งชิงสัมผัสในวรรคที่ ".($i)." ของบทที่ 1";
          $arrChingRhyme[$i]['status'] = "false";
        }
      }
      else if($i==6 || $i==7 || $i==8){
        if($checkChing[$i]=="true"){
          $arrChingRhyme[$i]['str'] = "ไม่มีตำแหน่งชิงสัมผัสในวรรคที่ ".(round($i%6)+2)." ของบทที่ 2";
          //echo "<br>".($i)." ".(round($i%5)+2)."<br>";
          $arrChingRhyme[$i]['status'] = "true";
        }
        else if($checkChing[$i]=="false"){
          $arrChingRhyme[$i]['str'] = "มีตำแหน่งชิงสัมผัสในวรรคที่ ".(round($i%6)+2)." ของบทที่ 2";
          //echo "<br>".($i)." ".(round($i%5)+2)."<br>";
          $arrChingRhyme[$i]['status'] = "false";
        }
      }
    }
    else {
      if($i==2 || $i==3 || $i==4){
        $arrChingRhyme[$i]['str'] = "ไม่มีตำแหน่งชิงสัมผัสในวรรคที่ ".($i)." ของบทที่ 1";
        $arrChingRhyme[$i]['status'] = "veryFalse";
      }
      else if($i==6 || $i==7 || $i==8){
        $arrChingRhyme[$i]['str'] = "ไม่มีตำแหน่งชิงสัมผัสในวรรคที่ ".(round($i%6)+2)." ของบทที่ 2";
        $arrChingRhyme[$i]['status'] = "veryFalse";
      }
    }
  }
  return ($arrChingRhyme);
}
  //$f = checkChingRhyme($arrWak,$arrKlonPhonemes,$indexOfRhyme,$indexChing);
  //print_r ($f);


//1.7 สัมผัสใน
function checkInRhyme($arrWak,$arrKlonPhonemes){
  //print_r ($arrKlonPhonemes);
  /// เตรียม input สำหรับตรวจสัมผสใน
  $pnInRhyme = []; // เก็บพยางค์ที่จะใช้ตรวจ
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $totalPN = count($arrKlonPhonemes[$i])-1;
    //echo (count($arrKlonPhonemes[3])-1)."<br>";
    if(($totalPN==8) && ($i==0 || $i==1 || $i==4 || $i==6)){
        $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][3];
        $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][4];
        $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][5];
        $pnInRhyme[$i][3] = $arrKlonPhonemes[$i][6];
        $pnInRhyme[$i][4] = $arrKlonPhonemes[$i][7];
    }
    else if(($totalPN==8) && ($i==2 || $i==3 || $i==5 || $i==7)){
        $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][5];
        $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][6];
        $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][7];
    }
    else if(($totalPN >=9) && ($i==0 || $i==1 || $i==4 || $i==6)){
        $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][3];
        $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][4];
        $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][6];
        $pnInRhyme[$i][3] = $arrKlonPhonemes[$i][7];
        $pnInRhyme[$i][4] = $arrKlonPhonemes[$i][8];
    }
    else if(($totalPN >=9) && ($i==2 || $i==3 || $i==5 || $i==7)){
        $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][6];
        $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][7];
        $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][8];
    }
    else if(($totalPN==7) && ($i==0 || $i==1 || $i==4 || $i==6)){
        $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][2];
        $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][3];
        $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][4];
        $pnInRhyme[$i][3] = $arrKlonPhonemes[$i][5];
        $pnInRhyme[$i][4] = $arrKlonPhonemes[$i][6];
    }
    else if(($totalPN==7) && ($i==2 || $i==3 || $i==5 || $i==7)){
        $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][4];
        $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][5];
        $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][6];
    }
    else if(($totalPN<7)){
        $pnInRhyme[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
    }
  }
  //echo "<br>///////////////////////////////////<br>";
  //print_r ($pnInRhyme);
  //echo "<br>";
  //$pnInRhyme2 = []; // เก็บสระ กับตัวสะกด แยกกับพยัญชนะของแต่ละพยางค์
  for($i=0 ; $i<count($pnInRhyme) ; $i++){
    $strInternalRhyme="";
    for($j=0 ; $j<count($pnInRhyme[$i]) ; $j++){
      if($pnInRhyme[$i][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
        $strInternalRhyme = $strInternalRhyme."~".$pnInRhyme[$i][$j];
        //echo $str3;
        $pnInRhyme2[$i] = explode("~",$strInternalRhyme);
      }
      else {
        $pnInRhyme2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
      }
    }
  }
  //echo "<br>";
  //print_r ($pnInRhyme2);
  //echo "<br>";
  $InternalRhyme = []; // เก็บเฉพาะสระ และตัวสะกด
  for($i=0 ; $i<count($pnInRhyme2) ; $i++){
    $index = 0;
    for($j=0 ; $j<count($pnInRhyme2[$i]) ; $j+=2){
      if($pnInRhyme2[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
        $InternalRhyme[$i][$index] = $pnInRhyme2[$i][$j];
        $index = $index+1;
      }
      else {
        $InternalRhyme[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
      }
    }
  }
  //echo "<br>";
  //print_r ($InternalRhyme);
  //echo "<br><br>";
  $countIndex = 0;
  $arrIndexInRhyme = [];
  for($i=0; $i<count($InternalRhyme) ; $i++){
    if(($i==0 || $i==1 || $i==4 || $i==6)){
      if($InternalRhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
        if($InternalRhyme[$i][1]==$InternalRhyme[$i][2]){
          $arrIndexInRhyme[$i][0] = "true";
        }
        else if($InternalRhyme[$i][1]!=$InternalRhyme[$i][2]){
          $arrIndexInRhyme[$i][0] = "false";
        }
        if($InternalRhyme[$i][3]==$InternalRhyme[$i][4] || $InternalRhyme[$i][3]==$InternalRhyme[$i][5]){
          $arrIndexInRhyme[$i][1] = "true";
        }
        else if($InternalRhyme[$i][3]!=$InternalRhyme[$i][4] && $InternalRhyme[$i][3]!=$InternalRhyme[$i][5]){
          $arrIndexInRhyme[$i][1] = "false";
        }
      }
      else {
        $arrIndexInRhyme[$i][0] = "false";
      }
    }
    else if($i==2 || $i==3 || $i==5 || $i==7){
      if($InternalRhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
        if($InternalRhyme[$i][1]==$InternalRhyme[$i][2]){
          $arrIndexInRhyme[$i][0] = "true";
        }
        else if($InternalRhyme[$i][1]==$InternalRhyme[$i][3]){
          $arrIndexInRhyme[$i][0] = "true";
        }
        else {
          $arrIndexInRhyme[$i][0] = "false";
        }
      }
      else {
          $arrIndexInRhyme[$i][0] = "false";
      }
    }
  }
  //echo "<br>";
  //print_r ($arrIndexInRhyme);
  //echo "<br>";
  $arrInternalRhyme = [];
  $countIndex = 0 ;
  for($i=0 ; $i<count($arrIndexInRhyme) ; $i++){
    if($i==0 || $i<4){
      if($i==0){
        if($arrIndexInRhyme[$i][0]=="true" && $arrIndexInRhyme[$i][1]=="true"){
          $countIndex = $countIndex+2;
          $arrInternalRhyme[$i][str] = "มีสัมผัสใน 2 ตำแหน่งในวรรคที่ ".($i+1)." ของบทที่ 1";
          $arrInternalRhyme[$i][status] = "true";
        }
        else if($arrIndexInRhyme[$i][0]=="true" || $arrIndexInRhyme[$i][1]=="true"){
          $countIndex = $countIndex+1;
          $arrInternalRhyme[$i][str] = "มีสัมผัสใน 1 ตำแหน่งในวรรคที่ ".($i+1)." ของบทที่ 1";
          $arrInternalRhyme[$i][status] = "true";
        }
        else if($arrIndexInRhyme[$i][0]=="false" && $arrIndexInRhyme[$i][1]=="false"){
          $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 1";
          $arrInternalRhyme[$i][status] = "false";
        }
        else {
          $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 1";
          $arrInternalRhyme[$i][status] = "false";
        }
      }
      else {
        if($arrIndexInRhyme[$i][0]=="true"){
          $countIndex = $countIndex+1;
          $arrInternalRhyme[$i][str] = "มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 1";
          $arrInternalRhyme[$i][status] = "true";
        }
        else if($arrIndexInRhyme[$i][0]=="false"){
          $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 1";
          $arrInternalRhyme[$i][status] = "false";
        }
      }
    }
    else if($i>=4 || $i<8){
      if($i==4){
        if($arrIndexInRhyme[$i][0]=="true" && $arrIndexInRhyme[$i][1]=="true"){
          $countIndex = $countIndex+2;
          $arrInternalRhyme[$i][str] = "มีสัมผัสใน 2 ตำแหน่งในวรรคที่ ".(round($i%4)+1)." ของบทที่ 2";
          $arrInternalRhyme[$i][status] = "true";
        }
        else if($arrIndexInRhyme[$i][0]=="true" || $arrIndexInRhyme[$i][1]=="true"){
          $countIndex = $countIndex+1;
          $arrInternalRhyme[$i][str] = "มีสัมผัสใน 1 ตำแหน่งในวรรคที่ ".(round($i%4)+1)." ของบทที่ 2";
          $arrInternalRhyme[$i][status] = "true";
        }
        else if($arrIndexInRhyme[$i][0]=="false" && $arrIndexInRhyme[$i][1]=="false"){
          $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".(round($i%4)+1)." ในบทที่ 2";
          $arrInternalRhyme[$i][status] = "false";
        }
        else {
          $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".(round($i%4)+1)." ในบทที่ 2";
          $arrInternalRhyme[$i][status] = "false";
        }
      }
      else {
        if($arrIndexInRhyme[$i][0]=="true"){
          $countIndex = $countIndex+1;
          $arrInternalRhyme[$i][str] = "มีสัมผัสในของวรรคที่ ".(round($i%4)+1)." ในบทที่ 2";
          $arrInternalRhyme[$i][status] = "true";
        }
        else if($arrIndexInRhyme[$i][0]=="false"){
          $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".(round($i%4)+1)." ในบทที่ 2";
          $arrInternalRhyme[$i][status] = "false";
        }
      }
    }
  }
  $arrInternalRhyme[count] = $countIndex;
  return ($arrInternalRhyme);
  //echo "<br>";
  //print_r ($arrInternalRhyme);
}
//$g = checkInRhyme($InternalRhyme);
//print_r ($g);



//1.8 สัมผัสเลือน
function checkVagueRhyme($arrWak,$arrKlonPhonemes,$rhyme){
  //print_r ($pn);
  //echo "<br>";
  //print_r ($rhyme);
  $arrStatusVague = [];
  for($i=1 ; $i<count($arrWak)-1 ; $i+=2){
    $totalPN = count($arrKlonPhonemes[$i])-1;
    //echo $totalPN;
    if($rhyme[$i][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
      if($totalPN==8 || $totalPN>=9){
        if($rhyme[$i][1]!=$rhyme[$i][2]){
          $arrStatusVague[$i][0] = "true";
        }
        else {
          $arrStatusVague[$i][0] = "false";
        }
      }
      else if($totalPN==7){
        if($rhyme[$i][1]!=$rhyme[$i][2]){
          $arrStatusVague[$i][0] = "true";
        }
        else if($rhyme[$i][1]!=$rhyme[$i][3]){
          $arrStatusVague[$i][1] = "true";
        }
        else if($rhyme[$i][1]!=$rhyme[$i][4]){
          $arrStatusVague[$i][2] = "true";
        }
        else if($rhyme[$i][2]!=$rhyme[$i][3]){
          $arrStatusVague[$i][3] = "true";
        }
        else if($rhyme[$i][2]!=$rhyme[$i][4]){
          $arrStatusVague[$i][4] = "true";
        }
        else if($rhyme[$i][3]!=$rhyme[$i][4]){
          $arrStatusVague[$i][5] = "true";
        }
        else {
          $arrStatusVague[$i][0] = "false";
        }
      }
    }
    else {
      $arrStatusVague[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
    }
  }
  //echo "<br>";
  //print_r ($arrStatusVague);
  for($i=1 ; $i<count($arrWak)-1 ; $i+=2){
    if($arrStatusVague[$i][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
      for($j=0 ; $j<count($arrStatusVague[$i]) ; $j++){
        if($i==0 || $i<4 && count($arrStatusVague[$i])==1){
          if($arrStatusVague[$i][$j]=="true"){
            $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือนในวรรคที่ ".($i+1)." ของบทที่ 1";
            $arrVagueRhyme[$i][status] = "true";
          }
          else {
            $arrVagueRhyme[$i][str] = "มีตำแหน่งสัมผัสเลือนในวรรคที่ ".($i+1)." ของบทที่ 1 คือ ".($pn[$i][$j]);
            $arrVagueRhyme[$i][status] = "false";
          }
        }
        else if($i==0 || $i<4 && count($arrStatusVague[$i])>1){
          if($arrStatusVague[$i][$j]=="true"){
            $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือนในวรรคที่ ".($i+1)." ของบทที่ 1";
            $arrVagueRhyme[$i][status] = "true";
          }
          else {
            $arrVagueRhyme[$i][str] = "มีตำแหน่งสัมผัสเลือนในวรรคที่ ".($i+1)." ของบทที่ 1 คือ ".($pn[$i][$j]);
            $arrVagueRhyme[$i][status] = "false";
          }
        }
        else if($i>=4 || $i<8 && count($arrStatusVague[$i])==1){
          if($arrStatusVague[$i][$j]=="true"){
            $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือนในวรรคที่ ".(round($i%5)+2)." ของบทที่ 2";
            $arrVagueRhyme[$i][status] = "true";
          }
          else {
            $arrVagueRhyme[$i][str] = "มีตำแหน่งสัมผัสเลือนในวรรคที่ ".(round($i%5)+2)." ของบทที่ 2 คือ ".($pn[$i][$j]);
            $arrVagueRhyme[$i][status] = "false";
          }
        }
        else if($i>=4 || $i<8 && count($arrStatusVague[$i])>1){
          if($arrStatusVague[$i][$j]=="true"){
            $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือนในวรรคที่ ".(round($i%5)+2)." ของบทที่ 2";
            $arrVagueRhyme[$i][status] = "true";
          }
          else {
            $arrVagueRhyme[$i][str] = "มีตำแหน่งสัมผัสเลือนในวรรคที่ ".(round($i%5)+2)." ของบทที่ 2 คือ ".($pn[$i][$j]);
            $arrVagueRhyme[$i][status] = "false";
          }
        }
      }
    }
    else {
      $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือน";
      $arrVagueRhyme[$i][status] = "veryFalse";
    }
  }
  return ($arrVagueRhyme);
  //print_r ($arrVagueRhyme);
}
//$h = checkVagueRhyme($arrWak,$arrKlonPhonemes,$rhyme);
//print_r ($h);



?>
