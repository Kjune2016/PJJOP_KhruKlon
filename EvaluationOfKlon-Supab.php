<?php
require ("prepareInput.php");
class  CheckSyntaxAndMelody {
    public $numOfWak = "";
    public $numOfPayang = "";
    public $tone = "";
    public $externalRhyme = "";
    public $duplicateRhyme = "";
    public $chingRhyme = "";
    public $internalRhyme = "";
    public $vagueRhyme = "";
}
$resultNumOfWak = new CheckSyntaxAndMelody();
  //$strNumWak = array();
  //$reStr = "";
  //$result2 = new CheckSyntaxAndMelody();
// 1.1 ตรวจจำนวนวรรค
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
      $arrNumWak[$i][str] = " ขาดวรรคที่ ".($i+1)." ของบทที่ 1";
      $arrNumWak[$i][status] = "false";
    }
    else if ($i>=4 && $i<8 && $arrIndexOfWak[$i]=="false") {
      //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $arrNumWak[$i][str] = " ขาดวรรคที่ ".($i+1)." ของบทที่ 2";
      $arrNumWak[$i][status] = "false";
    }
    else if($i>=0 && $i<4 && $arrIndexOfWak[$i]=="true"){
      //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $arrNumWak[$i][str] = " มีวรรคที่ ".($i+1)." ของบทที่ 1";
      $arrNumWak[$i][status] = "true";
    }
    else if ($i>=4 && $i<8 && $arrIndexOfWak[$i]=="true") {
      //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $arrNumWak[$i][str] = " มีวรรคที่ ".($i+1)." ของบทที่ 2";
      $arrNumWak[$i][status] = "true";
    }
  }
  $arrNumWak[sum] = "จำนวนวรรคทั้งหมดคือ ".($countOfWak)." วรรค";
  //print_r ($arrIndexOfWak);
  //print_r ($arrNumWak);
  //echo "<br>";
  $resultNumOfWak->numOfWak = ($arrNumWak);
  $jsonNumWak = json_encode($resultNumOfWak);
  //echo $jsonNumWak; // ส่วนที่เราคืนให้พาน
  //echo "<br>";
  $deJsonNumWak = json_decode($jsonNumWak, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  //print_r ($deJsonNumWak);
  //echo "<br>.................................................<br>";

// 1.2 ตรวจจำนวนพยางค์
  // นับพยางค์แต่ละวรรค
  $resultNumOfPayang = new CheckSyntaxAndMelody();
  $strNumPayang = "";
  //print_r ($arrCountOfPayang);
  // ตรวจสอบว่าจำนวนพยางค์ในแต่่ละวรรคถูกไหม พร้อมเก็บสถานะ
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $totalPY = count($arrKlonPayang[$i]);
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
      $arrStatusNumPayang[$i] = "CheckWordPrawisrrchniis";
    }
  }
  //print_r ($arrStatusNumPayang);
  // ตรวจสอบจากสถานะ แล้วบอกออกมาว่า จำนวนพยางค์ในแต่ละวรรค ของแต่ละบทถูกต้องไหม และแสดงผล
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "trueGood"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $arrNumPayang[$i][str] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง";
      $arrNumPayang[$i][status] = "trueGood";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "trueGood") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $arrNumPayang[$i][str] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 ถูกต้อง";
        $arrNumPayang[$i][status] = "trueGood";
    }
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "true"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
        $arrNumPayang[$i][str] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง";
        $arrNumPayang[$i][status] = "true";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "true") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $arrNumPayang[$i][str] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 ถูกต้อง";
        $arrNumPayang[$i][status] = "true";
    }
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "bad"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
        $arrNumPayang[$i][str] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง";
        $arrNumPayang[$i][status] = "false";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "bad") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $arrNumPayang[$i][str] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 ถูกต้อง";
        $arrNumPayang[$i][status] = "false";
    }
    //*********************** ยังไม่ได้ตรวจคำอะกึ่งเสียง ************************************
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "CheckWordPrawisrrchniis"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
        $strNumPayang[$i][str] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 ต้องไปตรวจอะกึ่งเสียง";
        $arrNumPayang[$i][status] = "true";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "CheckWordPrawisrrchniis") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
        $strNumPayang[$i][str] = "จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 ต้องไปตรวจอะกึ่งเสียง";
        $arrNumPayang[$i][status] = "true";
    }
  }
  $resultNumOfPayang->numOfPayang = ($arrNumPayang);
  $jsonNumPayang = json_encode($resultNumOfPayang);
  //echo ($jsonNumPayang."<br>"); // ส่วนที่เราคืนให้พาน
  $deJsonNumPayang = json_decode($jsonNumPayang, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  //print_r ($deJsonNumPayang);
  //echo "<br>.................................................<br>";

// 1.3 เสียงท้ายพยางค์
  $resultTone = new CheckSyntaxAndMelody();
  //$strTone = "";
  for($i=0 ; $i<count($arrWak)-1 ; $i++){
    $numPY = count($arrKlonTone[$i])-1;
    $tone = $arrKlonTone[$i][$numPY];
    // บทที่ 1
    if($i==0 || $i<4){
      // วรรคที่ 1
      if($i==0){
        if($tone==1 || $tone==2 || $tone==3 || $tone==4 || $tone==5){
          if($tone==2){
            //*** ถ้าสถานะเป็น true หมด พานจะรู้ไหมว่าอันไหนได้คะแนนไพเราะ อันไหนไม่ได้
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงเอก";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==3){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงโท";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==4){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงตรี";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==5){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงจัตวา";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==1){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 1 ถูกต้อง คือเสียงสามัญ แต่ไม่นิยมลงเสียงนี้ จึงขาดความไพเราะ";
            $arrOfTone[$i][status] = "true";
          }
        }
      }
      // วรรคที่ 2
      if($i==1){
        if($tone==2 || $tone==3 || $tone==5){
          if($tone==2){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ถูกต้อง คือเสียงเอก";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==3){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ถูกต้อง คือเสียงโท";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==5){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ถูกต้อง คือเสียงจัตวา และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
            $arrOfTone[$i][status] = "trueGood";
          }
        }
        else {
          $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงเอก เสียงโท และที่นิยมคือเสียงจัตวา";
          $arrOfTone[$i][status] = "false";
        }
      }
      // วรรคที่ 3 และ 4
      if($i==2 || $i==3){
        if($tone==1 || $tone==4){
          if($tone==1){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง คือเสียงสามัญ และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
            $arrOfTone[$i][status] = "trueGood";
          }
          else if($tone==4){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ถูกต้อง คือเสียงจัตวา และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
            $arrOfTone[$i][status] = "trueGood";
          }
        }
        else {
          $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".($i+1)." ของบทที่ 1 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงจัตวา และที่นิยมคือเสียงสามัญ";
          $arrOfTone[$i][status] = "false";
        }
      }
    }
    // บทที่ 2
    if($i==4 || $i<8){
      // วรรคที่ 1
      if($i==4){
        if($tone==1 || $tone==2 || $tone==3 || $tone==4 || $tone==5){
          if($tone==2){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 2 ถูกต้อง คือเสียงเอก";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==3){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 2 ถูกต้อง คือเสียงโท";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==4){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 2 ถูกต้อง คือเสียงตรี";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==5){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 2 ถูกต้อง คือเสียงจัตวา";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==1){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 1 ของบทที่ 2 ถูกต้อง คือเสียงสามัญ แต่ไม่นิยมลงเสียงนี้ จึงขาดความไพเราะ";
            $arrOfTone[$i][status] = "true";
          }
        }
      }
      // วรรคที่ 2
      if($i==5){
        if($tone==2 || $tone==3 || $tone==5){
          if($tone==2){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 2 ถูกต้อง คือเสียงเอก";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==3){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 2 ถูกต้อง คือเสียงโท";
            $arrOfTone[$i][status] = "true";
          }
          else if($tone==5){
            $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 2 ถูกต้อง คือเสียงจัตวา และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
            $arrOfTone[$i][status] = "trueGood";
          }
        }
        else {
          $arrOfTone[$i][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ 2 ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงเอก เสียงโท และที่นิยมคือเสียงจัตวา";
          $arrOfTone[$i][status] = "false";
        }
      }
      // วรรคที่ 3 และ 4
      if($i==6 || $i==7){
        if($tone==1 || $tone==4){
          if($tone==1){
            $arrOfTone[round($i/2)][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".round($i/2)." ของบทที่ 2 ถูกต้อง คือเสียงสามัญ และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
            $arrOfTone[round($i/2)][status] = "trueGood";
          }
          else if($tone==4){
            $arrOfTone[round($i/2)][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".round($i/2)." ของบทที่ 2 ถูกต้อง คือเสียงจัตวา และเป็นเสียงที่นิยมช่วยเพิ่มความไพเราะ";
            $arrOfTone[round($i/2)][status] = "trueGood";
          }
        }
        else {
            $arrOfTone[round($i/2)][str] = "ใช้เสียงวรรณยุกต์ท้ายวรรคที่ ".round($i/2)." ของบทที่ 2 ไม่ถูกต้อง จึงขาดความไพเราะ โดยเสียงที่ถูกต้องคือเสียงจัตวา และที่นิยมคือเสียงสามัญ";
            $arrOfTone[round($i/2)][status] = "false";
        }
      }
    }
  }
  $resultTone->tone = ($arrOfTone);
  $jsonTone = json_encode($resultTone);
  //echo ($jsonTone."<br>"); // ส่วนที่เราคืนให้พาน
  $deJsonTone = json_decode($jsonTone, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  //print_r ($deJsonTone);
  //echo "<br>.................................................<br>";


// 1.4 ตรวจสัมผัสนอก

  //echo "<br>////";
  //print_r ($rhyme);
  // ตรวจสัมผัสตามกฏ
  // สัมผัสระหว่างวรรคที่ 1 กับ วรรคที่ 2
  $resultExternalRhyme = new CheckSyntaxAndMelody();
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
            $arrExternalRhyme[$i][str] = "มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 1";
            $arrExternalRhyme[$i][status] = "true";
          }
          else if($rhyme[$i][1]!=$rhyme[1][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i][str] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 1";
            $arrExternalRhyme[$i][status] = "false";
          }
        }
        // สัมผัสระหว่างวรรคที่ 2 กับ วรรคที่ 3
        else if($i==1){
          if($rhyme[$i][3]==$rhyme[2][$j] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i][str] = "มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 1";
            $arrExternalRhyme[$i][status] = "true";
          }
          else if($rhyme[$i][3]!=$rhyme[2][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i][str] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 1";
            $arrExternalRhyme[$i][status] = "false";
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
            $arrExternalRhyme[$i][str] = "มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 1";
            $arrExternalRhyme[$i][status] = "true";
          }
          else if($rhyme[$i][1]!=$rhyme[3][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i][str] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 1";
            $arrExternalRhyme[$i][status] = "false";
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
            $arrExternalRhyme[$i][str] = "มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 2";
            $arrExternalRhyme[$i][status] = "true";
          }
          else if($rhyme[$i][1]!=$rhyme[5][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i][str] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 2";
            $arrExternalRhyme[$i][status] = "false";
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
            $arrExternalRhyme[$i][str] = "มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 2";
            $arrExternalRhyme[$i][status] = "true";
          }
          else if($rhyme[$i][3]!=$rhyme[6][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i][str] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 2";
            $arrExternalRhyme[$i][status] = "false";
          }
        }
        // สัมผัสระหว่างวรรคที่ 3 กับ วรรคที่ 4
        else if($i==6){
          if($rhyme[$i][1]==$rhyme[7][$j] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i][str] = "มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 2";
            $arrExternalRhyme[$i][status] = "true";
          }
          else if($rhyme[$i][1]!=$rhyme[7][$j] && $check==0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
            $check = 1;
            $arrExternalRhyme[$i][str] = "ไม่มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 2";
            $arrExternalRhyme[$i][status] = "false";
          }
        }
      }
    }
    // สัมผัสระหว่างบท   ปล. ยังไม่เคยสมมติตัวอย่าง
    if($countOfWak>4 && $countOfWak<8){
      if($rhyme[3][3]==$rhyme[5][3] && $rhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
        $check = 1;
        $arrExternalRhyme[connect][str] = "มีสัมผัสนอกระหว่างบท";
        $arrExternalRhyme[connect][status] = "true";
      }
      else if($rhyme[3][3]!=$rhyme[5][3] && $check!=0 || $rhyme[$i][0]=="จำนวนพยางค์ไม่ถูกต้อง"){
        $check = 1;
        $arrExternalRhyme[connect][str] = "ไม่มีสัมผัสนอกระหว่างบท";
        $arrExternalRhyme[connect][status] = "false";
      }
    }
  }

  $resultExternalRhyme->externalRhyme = ($arrExternalRhyme);
  $jsonExternalRhyme = json_encode($resultExternalRhyme);
  //echo ($jsonExternalRhyme."<br>"); // ส่วนที่เราคืนให้พาน
  $deJsonExternalRhyme = json_decode($jsonExternalRhyme, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  //print_r ($deJsonExternalRhyme);
  //echo "<br>.................................................<br>";
  //print_r ($indexOfRhyme)."<br>";

// 1.5 สัมผัสซ้ำ
  $resultDuplicateRhyme = new CheckSyntaxAndMelody();
  $arrDupPn = [];
  $arrStatusDup = [];
  $arrDupRhyme = [];
  $num = 0;
  print_r ($pn);
  for($i=0 ; $i<count($pn) ; $i++){
    for($j=0 ; $j<count($pn[$i]) ; $j++){
      $arrDupPn[$num] = $pn[$i][$j];
      $num++;
    }
  }
  echo "<br>";
  print_r ($arrDupPn);
  //echo count($arrDupPn);
  //$check = 0;
  for($i=0 ; $i<count($arrDupPn) ; $i++){
    $dupPn = $arrDupPn[$i];
    //echo "<br>".$dupPn."<br>";
    for($j=0 ; $j<count($pn) ; $j++){
      for($k=0 ; $k<count($pn[$j]) ; $k++){
        //echo "<br>".$pn[$j][$k]."1"."<br>";
        if($dupPn==$pn[$j][$k]){
          //echo "<br>".$pn[$j][$k]."2"."<br>";
          $arrStatusDup[$j][$k] = $arrStatusDup[$j][$k] + 1;

        }
        else {
          //echo "<br>".$pn[$j][$k]."3"."<br>";
          $arrStatusDup[$j][$k] = $arrStatusDup[$j][$k] + 0;
        }
      }
    }
    for($j=0 ; $j<count($pn) ; $j++){
      for($k=0 ; $k<count($pn[$j]) ; $k++){
        if($arrStatusDup[$j][$k] <=1){
          $arrStatusDupRhyme[$j][$k] = "true";
        }
        else {
          $arrStatusDupRhyme[$j][$k] = "false";
        }
      }
    }
}
  //echo "<br>";
  print_r ($arrStatusDup);
  echo "<br>";
  print_r ($arrStatusDupRhyme);
  for($j=0 ; $j<count($arrStatusDupRhyme) ; $j++){
    for($k=0 ; $k<count($arrStatusDupRhyme[$j]) ; $k++){
      if($j<4){
        if($arrStatusDupRhyme[$j][$k] == "false"){
          $arrDupRhyme[$j][str] = "มีสัมผัสซ้ำที่คำว่า ".($py[$j][$k])." ในบทที่ 1";
        }
        else {
          $arrDupRhyme[$j][str] = "ไม่มีสัมผัสซ้ำในบทที่ 2";
        }
      }
      else if($j==4 || $j<8){
        if($arrStatusDupRhyme[$j][$k] == "false"){
          $arrDupRhyme[$j][str] = "มีสัมผัสซ้ำที่คำว่า ".($py[$j][$k])." ในบทที่ 2";
        }
        else {
          $arrDupRhyme[$j][str] = "ไม่มีสัมผัสซ้ำในบทที่ 2";
        }
      }
    }
  }
  echo "<br>";
  print_r ($arrDupRhyme);
  // 1.6 ชิงสัมผัส
   //// ********* ยังไม่สามารถบอกได้ว่าชิงสัมผัสที่พยางค์ไหน
   /// เตรียม input สำหรับตรวจชิงสัมผัส
   $indexChing = [];
   //echo count($arrWak)-1;
     for($i=0 ; $i<count($arrWak)-1 ; $i++){
       $totalPN = count($arrKlonPhonemes[$i])-1;
       //echo "///////////".$totalPN;
       if($i==1){
         if($indexOfRhyme[0][0]=="payangAt5"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][4];
         }
         else if($indexOfRhyme[0][0]=="payangAt6"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][4];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][5];
         }
         else if($indexOfRhyme[0][0]=="payangAt2"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
         }
         else if($indexOfRhyme[0][0]=="payangAt3from7"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
         }
         else if($indexOfRhyme[0][0]=="payangAt4"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
         }
         else if($indexOfRhyme[0][0]=="payangAt5from7"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][4];
         }
         else if($indexOfRhyme[0][0]=="payangAt3"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
         }
         else {
           $indexChing[$i-1][0] = "จำนวนพยางค์ไม่ถูกต้อง";
         }
       }
       else if($i==3){
         if($indexOfRhyme[0][1]=="payangAt5"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][4];
         }
         else if($indexOfRhyme[0][1]=="payangAt6"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][4];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][5];
         }
         else if($indexOfRhyme[0][1]=="payangAt2"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
         }
         else if($indexOfRhyme[0][1]=="payangAt3from7"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
         }
         else if($indexOfRhyme[0][1]=="payangAt4"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
         }
         else if($indexOfRhyme[0][1]=="payangAt5from7"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][4];
         }
         else if($indexOfRhyme[0][1]=="payangAt3"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
         }
         else {
           $indexChing[$i-1][0] = "จำนวนพยางค์ไม่ถูกต้อง";
         }
       }
       else if($i==5){
         if($indexOfRhyme[0][2]=="payangAt5"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][4];
         }
         else if($indexOfRhyme[0][2]=="payangAt6"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][4];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][5];
         }
         else if($indexOfRhyme[0][2]=="payangAt2"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
         }
         else if($indexOfRhyme[0][2]=="payangAt3from7"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
         }
         else if($indexOfRhyme[0][2]=="payangAt4"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
         }
         else if($indexOfRhyme[0][2]=="payangAt5from7"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][4];
         }
         else if($indexOfRhyme[0][2]=="payangAt3"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
         }
         else {
           $indexChing[$i-1][0] = "จำนวนพยางค์ไม่ถูกต้อง";
         }
       }
       else if($i==7){
         if($indexOfRhyme[0][3]=="payangAt5"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][4];
         }
         else if($indexOfRhyme[0][3]=="payangAt6"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][4];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][5];
         }
         else if($indexOfRhyme[0][3]=="payangAt2"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
         }
         else if($indexOfRhyme[0][3]=="payangAt3from7"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
         }
         else if($indexOfRhyme[0][3]=="payangAt4"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
         }
         else if($indexOfRhyme[0][3]=="payangAt5from7"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][4];
         }
         else if($indexOfRhyme[0][3]=="payangAt3"){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
         }
         else {
           $indexChing[$i-1][0] = "จำนวนพยางค์ไม่ถูกต้อง";
         }
       }

       else if($i==2 || $i==6){
         //echo $totalPN;
         if($totalPN==8){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][4];
           $indexChing[$i-1][4] = $arrKlonPhonemes[$i][5];
           $indexChing[$i-1][5] = $arrKlonPhonemes[$i][6];
           $indexChing[$i-1][6] = $arrKlonPhonemes[$i][7];
         }
         else if($totalPN==9){  //ถ้ามากกว่า 9 พยางค์แล้วเป็นคำอะกึ่งเสียงจะรวบแล้วเป็น 9 พยางค์
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][4];
           $indexChing[$i-1][4] = $arrKlonPhonemes[$i][5];
           $indexChing[$i-1][5] = $arrKlonPhonemes[$i][6];
           $indexChing[$i-1][6] = $arrKlonPhonemes[$i][7];
           $indexChing[$i-1][7] = $arrKlonPhonemes[$i][8];
         }
         else if($totalPN==7){
           $indexChing[$i-1][0] = $arrKlonPhonemes[$i][1];
           $indexChing[$i-1][1] = $arrKlonPhonemes[$i][2];
           $indexChing[$i-1][2] = $arrKlonPhonemes[$i][3];
           $indexChing[$i-1][3] = $arrKlonPhonemes[$i][4];
           $indexChing[$i-1][4] = $arrKlonPhonemes[$i][5];
           $indexChing[$i-1][5] = $arrKlonPhonemes[$i][6];
         }
         else {
           $indexChing[$i-1][0] = "จำนวนพยางค์ไม่ถูกต้อง";
         }
       }

     }

   //print_r ($arrKlonPhonemes)."<br>";
   //print_r ($indexOfRhyme)."<br>";
   //print_r ($indexChing);
   $indexChing2 = [];
   $rhymeChing = [];
   //print count($indexChing);
   for($i=0 ; $i<count($indexChing) ; $i++){
     $strChingRhyme = "";
     for($j=0 ; $j<count($indexChing[$i]) ; $j++){
       if($indexChing[$i][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
         $strChingRhyme = ($strChingRhyme)."~".($indexChing[$i][$j]);
         //echo $strChingRhyme."<br>";
         $indexChing2[$i] = explode("~",$strChingRhyme);
       }
       else {
        $indexChing2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
       }
     }
   }
   //echo "<br>";
   //print_r ($indexChing2);
   for($i=0 ; $i<count($indexChing2) ; $i++){
     $index = 0;
     for($j=0 ; $j<count($indexChing2[$i]) ; $j+=2){
       if($indexChing2[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
         $rhymeChing[$i][$index] = $indexChing2[$i][$j];
         $index = $index+1;
       }
       else {
         $rhymeChing[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
       }
     }
   }

   $resultChingRhyme = new CheckSyntaxAndMelody();
   //print_r ($rhyme);
   //echo "<br>";
   //print_r ($rhymeChing);
   //echo "<br>";
   //print_r ($indexOfRhyme);
   $strCheckChing = "";
   $checkChing = 1;
   $arrStatusChing = [];
   $arrChingRhyme = [];
   for($i=1 ; $i<=count($arrWak)-1 ; $i++){
     for($j=1 ; $j<count($rhymeChing[$i-1]) ; $j++){
       // บทที่ 1
       if($i==1){
         // ตรวจชิงสัมผัสวรรค 2
         if($indexOfRhyme[0][0]=="payangAt3"){ // 8 9 พยางค์ สัมผัสที่พยางค์ที่ 3
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 8 พยางค์สัมผัสที่พยางค์ที่ 5 หรือ 9 พยางค์สัมผัสที่พยางค์ที่ 6
         else if($indexOfRhyme[0][0]=="payangAt5" || $indexOfRhyme[0][0]=="payangAt6"){
           $strCheckChing = $rhyme[$i][2];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 2
         else if($indexOfRhyme[0][0]=="payangAt2"){
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 3
         else if($indexOfRhyme[0][0]=="payangAt3from7"){
           $strCheckChing = $rhyme[$i][2];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 4
         else if($indexOfRhyme[0][0]=="payangAt4"){
           $strCheckChing = $rhyme[$i][3];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 5
         else if($indexOfRhyme[0][0]=="payangAt5from7"){
           $strCheckChing = $rhyme[$i][4];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
       }
       else if($i==2){
         // ตรวจชิงสัมผัสวรรค 3
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
       }
       else if($i==3){
         // ตรวจชิงสัมผัสวรรค 4
         if($indexOfRhyme[0][1]=="payangAt3"){ // 8 9 พยางค์ สัมผัสที่พยางค์ที่ 3
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 8 พยางค์สัมผัสที่พยางค์ที่ 5 หรือ 9 พยางค์สัมผัสที่พยางค์ที่ 6
         else if($indexOfRhyme[0][1]=="payangAt5" || $indexOfRhyme[0][1]=="payangAt6"){
           $strCheckChing = $rhyme[$i][2];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 2
         else if($indexOfRhyme[0][1]=="payangAt2"){
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 3
         else if($indexOfRhyme[0][1]=="payangAt3from7"){
           $strCheckChing = $rhyme[$i][2];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 4
         else if($indexOfRhyme[0][1]=="payangAt4"){
           $strCheckChing = $rhyme[$i][3];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 5
         else if($indexOfRhyme[0][1]=="payangAt5from7"){
           $strCheckChing = $rhyme[$i][4];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
       }
       // บทที่ 2
       else if($i==5){
         // ตรวจชิงสัมผัสวรรค 2
         if($indexOfRhyme[0][2]=="payangAt3"){ // 8 9 พยางค์ สัมผัสที่พยางค์ที่ 3
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 8 พยางค์สัมผัสที่พยางค์ที่ 5 หรือ 9 พยางค์สัมผัสที่พยางค์ที่ 6
         else if($indexOfRhyme[0][2]=="payangAt5" || $indexOfRhyme[0][2]=="payangAt6"){
           $strCheckChing = $rhyme[$i][2];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 2
         else if($indexOfRhyme[0][2]=="payangAt2"){
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 3
         else if($indexOfRhyme[0][2]=="payangAt3from7"){
           $strCheckChing = $rhyme[$i][2];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 4
         else if($indexOfRhyme[0][2]=="payangAt4"){
           $strCheckChing = $rhyme[$i][3];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 5
         else if($indexOfRhyme[0][2]=="payangAt5from7"){
           $strCheckChing = $rhyme[$i][4];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
       }
       else if($i==6){
         // ตรวจชิงสัมผัสวรรค 3
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
       }
       else if($i==7){
         // ตรวจชิงสัมผัสวรรค 4
         if($indexOfRhyme[0][3]=="payangAt3"){ // 8 9 พยางค์ สัมผัสที่พยางค์ที่ 3
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 8 พยางค์สัมผัสที่พยางค์ที่ 5 หรือ 9 พยางค์สัมผัสที่พยางค์ที่ 6
         else if($indexOfRhyme[0][3]=="payangAt5" || $indexOfRhyme[0][3]=="payangAt6"){
           $strCheckChing = $rhyme[$i][2];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 2
         else if($indexOfRhyme[0][3]=="payangAt2"){
           $strCheckChing = $rhyme[$i][1];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 3
         else if($indexOfRhyme[0][3]=="payangAt3from7"){
           $strCheckChing = $rhyme[$i][2];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 4
         else if($indexOfRhyme[0][3]=="payangAt4"){
           $strCheckChing = $rhyme[$i][3];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
         // 7 พยางค์สัมผัสที่พยางค์ที่ 5
         else if($indexOfRhyme[0][3]=="payangAt5from7"){
           $strCheckChing = $rhyme[$i][4];
           if($strCheckChing!=$rhymeChing[$i-1][$j]){
             $checkChing = 0;
           }
           else if($checkChing==1){
             $checkChing = 1;
           }
           else {
             $checkChing = 0;
           }
         }
       }
     }
     if($checkChing==0){
       $arrStatusChing[$i] = "true";
     }
     else {
       $arrStatusChing = "false";
     }
   }
   for($i=1 ; $i<count($arrWak)-1 ; $i++){
     if($i>0 || $i<4){
       if($arrStatusChing[$i]=="true"){
         $arrChingRhyme[$i][str] = "ไม่มีตำแหน่งชิงสัมผัสในวรรคที่ ".($i+1)." ของบทที่ 1";
         $arrChingRhyme[$i][status] = "true";
       }
       else if($arrStatusChing[$i]=="false"){
         $arrChingRhyme[$i][str] = "มีตำแหน่งชิงสัมผัสในวรรคที่ ".($i+1)." ของบทที่ 1";
         $arrChingRhyme[$i][status] = "false";
       }
     }
     else if($i>=5 || $i<8){
       if($arrStatusChing[$i]=="true"){
         $arrChingRhyme[$i][str] = "ไม่มีตำแหน่งชิงสัมผัสในวรรคที่ ".(round($i%5)+2)." ของบทที่ 2";
         $arrChingRhyme[$i][status] = "true";
       }
       else if($arrStatusChing[$i]=="false"){
         $arrChingRhyme[$i][str] = "มีตำแหน่งชิงสัมผัสในวรรคที่ ".(round($i%5)+2)." ของบทที่ 2";
         $arrChingRhyme[$i][status] = "false";
       }
     }
   }
   //print_r ($arrChingRhyme);
   $resultChingRhyme->chingRhyme = ($arrChingRhyme);
   $jsonChingRhyme = json_encode($resultChingRhyme);
   //echo ($jsonChingRhyme."<br>"); // ส่วนที่เราคืนให้พาน
   $deJsonChingRhyme = json_decode($jsonChingRhyme, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
   //print_r ($deJsonChingRhyme);
   //echo "<br>.................................................<br>";
   //print_r ($pn);//print_r ($pn);


//1.7 สัมผัสใน
//print_r ($arrKlonPhonemes);

//echo "<br>";
//print_r ($InternalRhyme);
$resultInternalRhyme = new CheckSyntaxAndMelody();
$countIndex = 0;
$arrIndexInRhyme = [];
for($i=0; $i<count($InternalRhyme) ; $i++){
  for($j=1 ; $j<=count($InternalRhyme[$i]) ; $j++){
    if($i==0 || $i==4){
      if($InternalRhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
        if($InternalRhyme[$i][1]==$InternalRhyme[$i][2]){
          $arrIndexInRhyme[$i][0] = "true";
        }
        else if($InternalRhyme[$i][1]!=$InternalRhyme[$i][2]){
          $arrIndexInRhyme[$i][0] = "false";
        }
        if($InternalRhyme[$i][1]==$InternalRhyme[$i][2] || $InternalRhyme[$i][1]==$InternalRhyme[$i][3]){
          $arrIndexInRhyme[$i][1] = "true";
        }
        else if($InternalRhyme[$i][1]!=$InternalRhyme[$i][2] && $InternalRhyme[$i][1]!=$InternalRhyme[$i][3]){
          $arrIndexInRhyme[$i][1] = "false";
        }
      }
      else {
        $arrIndexInRhyme[$i][0] = "false";
      }
    }
    else if($i==1 || $i==2 || $i==3 || $i==5 || $i==6 || $i==7){
      if($InternalRhyme[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
        if($InternalRhyme[$i][1]==$InternalRhyme[$i][2] || $InternalRhyme[$i][1]==$InternalRhyme[$i][3]){
          $arrIndexInRhyme[$i][0] = "true";
        }
        else if($InternalRhyme[$i][1]!=$InternalRhyme[$i][2] && $InternalRhyme[$i][1]!=$InternalRhyme[$i][3]){
          $arrIndexInRhyme[$i][0] = "false";
        }
      }
      else {
          $arrIndexInRhyme[$i][0] = "false";
      }
    }
  }
}
//echo "<br>";
//print_r ($arrIndexInRhyme);

$arrInternalRhyme = [];
for($i=0 ; $i<count($arrIndexInRhyme) ; $i++){
  if($i>=0 || $i<4){
    if($i==0){
      if($arrIndexInRhyme[$i][0]=="true" && $arrIndexInRhyme[$i][1]=="true"){
        $countIndex = $countIndex+2;
        $arrInternalRhyme[$i][str] = "มีสัมผัสใน 2 ตำแหน่งในวรรคที่ ".($i+1)." ของบทที่ 1";
      }
      else if($arrIndexInRhyme[$i][0]=="true" || $arrIndexInRhyme[$i][1]=="true"){
        $countIndex = $countIndex+1;
        $arrInternalRhyme[$i][str] = "มีสัมผัสใน 1 ตำแหน่งในวรรคที่ ".($i+1)." ของบทที่ 1";
      }
      else if($arrIndexInRhyme[$i][0]=="false" && $arrIndexInRhyme[$i][1]=="false"){
        $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 1";
      }
    }
    else {
      if($arrIndexInRhyme[$i][0]=="true"){
        $countIndex = $countIndex+1;
        $arrInternalRhyme[$i][str] = "มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 1";
      }
      else if($arrIndexInRhyme[$i][0]=="false"){
        $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 1";
      }
    }
  }
  else if($i>=4 || $i<8){
    if($i==4){
      if($arrIndexInRhyme[$i][0]=="true" && $arrIndexInRhyme[$i][1]=="true"){
        $countIndex = $countIndex+2;
        $arrInternalRhyme[$i][str] = "มีสัมผัสใน 2 ตำแหน่งในวรรคที่ ".($i+1)." ของบทที่ 2";
      }
      else if($arrIndexInRhyme[$i][0]=="true" || $arrIndexInRhyme[$i][1]=="true"){
        $countIndex = $countIndex+1;
        $arrInternalRhyme[$i][str] = "มีสัมผัสใน 1 ตำแหน่งในวรรคที่ ".($i+1)." ของบทที่ 2";
      }
      else if($arrIndexInRhyme[$i][0]=="false" && $arrIndexInRhyme[$i][1]=="false"){
        $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 2";
      }
    }
    else {
      if($arrIndexInRhyme[$i][0]=="true"){
        $countIndex = $countIndex+1;
        $arrInternalRhyme[$i][str] = "มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 2";
      }
      else if($arrIndexInRhyme[$i][0]=="false"){
        $arrInternalRhyme[$i][str] = "ไม่มีสัมผัสในของวรรคที่ ".($i+1)." ในบทที่ 2";
      }
    }
  }
}
$arrInternalRhyme[count] = $countIndex;
//echo "<br>";
//print_r ($arrInternalRhyme);
$resultInternalRhyme->internalRhyme = ($arrInternalRhyme);
$jsonInternalRhyme = json_encode($resultInternalRhyme);
//echo ($jsonInternalRhyme."<br>"); // ส่วนที่เราคืนให้พาน
$deJsonInternalRhyme = json_decode($jsonInternalRhyme, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
//print_r ($deJsonInternalRhyme);
//echo "<br>.................................................<br>";





//1.8 สัมผัสเลือน
//print_r ($pn);
//echo "<br>";
//print_r ($rhyme);
$resultVagueRhyme = new CheckSyntaxAndMelody();
$arrStatusVague = [];
for($i=1 ; $i<count($arrWak)-1 ; $i+=2){
  $totalPN = count($arrKlonPhonemes[$i])-1;
  //echo $totalPN;
  if($totalPN==8 || $totalPN==9){
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
//echo "<br>";
//print_r ($arrStatusVague);
for($i=1 ; $i<count($arrWak)-1 ; $i+=2){
  for($j=0 ; $j<count($arrStatusVague[$i]) ; $j++){
    if($i>0 || $i<4 && count($arrStatusVague[$i])==1){
      if($arrStatusVague[$i][$j]=="true"){
        $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือนในวรรคที่".($i+1)."ของบทที่ 1";
        $arrVagueRhyme[$i][status] = "true";
      }
      else {
        $arrVagueRhyme[$i][str] = "มีตำแหน่งสัมผัสเลือนในวรรคที่".($i+1)."ของบทที่ 1 คือ ".($pn[$i][$j]);
        $arrVagueRhyme[$i][status] = "false";
      }
    }
    else if($i>0 || $i<4 && count($arrStatusVague[$i])>1){
      if($arrStatusVague[$i][$j]=="true"){
        $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือนในวรรคที่".($i+1)."ของบทที่ 1";
        $arrVagueRhyme[$i][status] = "true";
      }
      else {
        $arrVagueRhyme[$i][str] = "มีตำแหน่งสัมผัสเลือนในวรรคที่".($i+1)."ของบทที่ 1 คือ ".($pn[$i][$j]);
        $arrVagueRhyme[$i][status] = "false";
      }
    }
    else if($i>4 || $i<8 && count($arrStatusVague[$i])==1){
      if($arrStatusVague[$i][$j]=="true"){
        $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือนในวรรคที่".(round($i%5)+2)."ของบทที่ 2";
        $arrVagueRhyme[$i][status] = "true";
      }
      else {
        $arrVagueRhyme[$i][str] = "มีตำแหน่งสัมผัสเลือนในวรรคที่".(round($i%5)+2)."ของบทที่ 2 คือ ".($pn[$i][$j]);
        $arrVagueRhyme[$i][status] = "false";
      }
    }
    else if($i>4 || $i<8 && count($arrStatusVague[$i])>1){
      if($arrStatusVague[$i][$j]=="true"){
        $arrVagueRhyme[$i][str] = "ไม่มีตำแหน่งสัมผัสเลือนในวรรคที่".(round($i%5)+2)."ของบทที่ 2";
        $arrVagueRhyme[$i][status] = "true";
      }
      else {
        $arrVagueRhyme[$i][str] = "มีตำแหน่งสัมผัสเลือนในวรรคที่".(round($i%5)+2)."ของบทที่ 2 คือ ".($pn[$i][$j]);
        $arrVagueRhyme[$i][status] = "false";
      }
    }
  }
}
//print_r ($arrVagueRhyme);
$resultVagueRhyme->vagueRhyme = ($arrVagueRhyme);
$jsonVagueRhyme = json_encode($resultVagueRhyme);
//echo ($jsonVagueRhyme."<br>"); // ส่วนที่เราคืนให้พาน
$deJsonVagueRhyme = json_decode($jsonVagueRhyme, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
//print_r ($deJsonVagueRhyme);
//echo "<br>.................................................<br>";



?>
