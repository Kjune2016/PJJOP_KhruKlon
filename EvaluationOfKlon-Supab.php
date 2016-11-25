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
  $strNumWak = "";
  //$result2 = new CheckSyntaxAndMelody();
  // 1.1 ตรวจจำนวนวรรค
  // ตรวจสอบจากสถานะ แล้วบอกออกมาว่า ขาดวรรคไหน ในบทไหน พร้อมบอกจำนวนวรรคทั้งหมดที่มี
  for($i=0 ; $i<count($arrIndexOfWak) ; $i++){
    if($i>=0 && $i<4 && $arrIndexOfWak[$i]=="false"){
      //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $strNumWak = ($strNumWak)." ขาดวรรคที่ ".($i+1)." ของบทที่ 1"."-false/";
    }
    else if ($i>=4 && $i<8 && $arrIndexOfWak[$i]=="false") {
      //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $strNumWak = ($strNumWak)." ขาดวรรคที่"." ".($i+1)." "."ของบทที่ 2"."-false/";
    }
  }
  //$result = ($strNumWak)." จำนวนวรรคทั้งหมดคือ ".($countOfWak)." วรรค";
  /*$resultNumOfWak->numOfWak = ($strNumWak)." จำนวนวรรคทั้งหมดคือ ".($countOfWak)." วรรค";
  $jsonNumWak = json_encode($resultNumOfWak);
  echo $jsonNumWak; // ส่วนที่เราคืนให้พาน
  //echo "<br>";
  $deJsonNumWak = json_decode($jsonNumWak, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  //print_r ($deJsonNumWak);
  echo "<br>.................................................<br>";*/

  // 1.2 ตรวจจำนวนพยางค์
  // นับพยางค์แต่ละวรรค
  $resultNumOfPayang = new CheckSyntaxAndMelody();
  $strNumPayang = "";
  //print_r ($arrCountOfPayang);
  // ตรวจสอบว่าจำนวนพยางค์ในแต่่ละวรรคถูกไหม พร้อมเก็บสถานะ
  for($i=0 ; $i<$countOfWak ; $i++){
    $totalPY = count($arrKlonPayang[$i]);
    //echo $totalPY;
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
  for($i=0 ; $i<count($arrStatusNumPayang) ; $i++){
    if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "trueGood"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $strNumPayang = ($strNumPayang)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 "."ถูกต้อง"."-true/";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "trueGood") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $strNumPayang = ($strNumPayang)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 "."ถูกต้อง"."-true/";
    }
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "true"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $strNumPayang = ($strNumPayang)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 "."ถูกต้อง แต่ขาดความไพเราะ"."-true/";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "true") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $strNumPayang = ($strNumPayang)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 "."ถูกต้อง แต่ขาดความไพเราะ"."-true/";
    }
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "bad"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $strNumPayang = ($strNumPayang)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 "."ไม่ถูกต้อง และขาดความไพเราะ"."-false/";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "bad") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $strNumPayang = ($strNumPayang)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 "."ไม่ถูกต้อง และขาดความไพเราะ"."-false/";
    }
    //*********************** ยังไม่ได้ตรวจคำอะกึ่งเสียง ************************************
    else if($i>=0 && $i<4 && $arrStatusNumPayang[$i] == "CheckWordPrawisrrchniis"){
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 1"."<br>";
      $strNumPayang = ($strNumPayang)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 1 "."ต้องไปตรวจอะกึ่งเสียง"."-true/";
    }
    else if ($i>=4 && $i<8 && $arrStatusNumPayang[$i] == "CheckWordPrawisrrchniis") {
        //print "ขาดวรรคที่"." ".($i+1)." "."ของบบที่ 2"."<br>";
      $strNumPayang = ($strNumPayang)."จำนวนพยางค์ในวรรคที่ ".($i+1)." ของบทที่ 2 "."ต้องไปตรวจอะกึ่งเสียง"."-true/";
    }
  }
  /*$resultNumOfPayang->numOfPayang = ($strNumPayang);
  $jsonNumPayang = json_encode($resultNumOfPayang);
  echo ($jsonNumPayang."<br>"); // ส่วนที่เราคืนให้พาน
  $deJsonNumPayang = json_decode($jsonNumPayang, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  //print_r ($deJsonNumPayang);
  echo "<br>.................................................<br>";*/

  // 1.3 ตรวจสัมผัสนอก
  // เก็บพยางค์ที่เป็นตำแหน่งรับ-ส่งสัมผัสกันเอาไว้ใน array ชื่อ rhyme ก่อน
  $py = [];
  $py2 = [];
  $rhyme = [];
  for($i=0 ; $i<$countOfWak ; $i++){
    $totalPY = count($arrKlonPhonemes[$i]);

        // บทที่ 1
        if($i==0 || $i<4){
          // กรณี 8 9 and 7 พยางค์
            // วรรคที่ 1 บทที่ 1
            if($i==0){
              if(($totalPY-2)==8 || ($totalPY-2)==9 || ($totalPY-2)==7){
                $py[$i][0] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else {
                $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
              }
            }
            // วรรคที่ 2
            else if($i==1){
              if(($totalPY-2)==8){
                $py[$i][0] =$arrKlonPhonemes[$i][3];
                $py[$i][1] =$arrKlonPhonemes[$i][5];
                $py[$i][2] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else if(($totalPY-2)==9){
                $py[$i][0] =$arrKlonPhonemes[$i][3];
                $py[$i][1] =$arrKlonPhonemes[$i][6];
                $py[$i][2] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else if(($totalPY-2)==7){
                $py[$i][0] =$arrKlonPhonemes[$i][2];
                $py[$i][1] =$arrKlonPhonemes[$i][3];
                $py[$i][2] =$arrKlonPhonemes[$i][4];
                $py[$i][3] =$arrKlonPhonemes[$i][5];
                $py[$i][4] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else {
                $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
              }
            }
            // วรรคที่ 3
            else if($i==2){
              if(($totalPY-2)==8){
                $py[$i][0] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else if(($totalPY-2)==9){
                $py[$i][0] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else if(($totalPY-2)==7){
                $py[$i][0] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else {
                $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
              }
            }
            // วรรคที่ 4
            else if($i==3){
              if(($totalPY-2)==8){
                $py[$i][0] =$arrKlonPhonemes[$i][3];
                $py[$i][1] =$arrKlonPhonemes[$i][5];
                $py[$i][2] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else if(($totalPY-2)==9){
                $py[$i][0] =$arrKlonPhonemes[$i][3];
                $py[$i][1] =$arrKlonPhonemes[$i][6];
                $py[$i][2] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else if(($totalPY-2)==7){
                $py[$i][0] =$arrKlonPhonemes[$i][2];
                $py[$i][1] =$arrKlonPhonemes[$i][3];
                $py[$i][2] =$arrKlonPhonemes[$i][4];
                $py[$i][3] =$arrKlonPhonemes[$i][5];
                $py[$i][4] =$arrKlonPhonemes[$i][$totalPY-2];
              }
              else {
                $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
              }
            }
          }
        }
      // บทที่ 2
      if($i>=4 || $i<8){
        // กรณี 8 9 and 7 พยางค์
          // วรรคที่ 1 บทที่ 2
          if($i==4){
            if(($totalPY-2)==8 || ($totalPY-2)==9 || ($totalPY-2)==7){
              $py[$i][0] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else {
              $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
            }
          }
          // วรรคที่ 2
          else if($i==5){
            if(($totalPY-2)==8){
              $py[$i][0] =$arrKlonPhonemes[$i][3];
              $py[$i][1] =$arrKlonPhonemes[$i][5];
              $py[$i][2] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else if(($totalPY-2)==9){
              $py[$i][0] =$arrKlonPhonemes[$i][3];
              $py[$i][1] =$arrKlonPhonemes[$i][6];
              $py[$i][2] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else if(($totalPY-2)==7){
              $py[$i][0] =$arrKlonPhonemes[$i][2];
              $py[$i][1] =$arrKlonPhonemes[$i][3];
              $py[$i][2] =$arrKlonPhonemes[$i][4];
              $py[$i][3] =$arrKlonPhonemes[$i][5];
              $py[$i][4] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else {
              $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
            }
          }
          // วรรคที่ 3
          else if($i==6){
            if(($totalPY-2)==8){
              $py[$i][0] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else if(($totalPY-2)==9){
              $py[$i][0] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else if(($totalPY-2)==7){
              $py[$i][0] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else {
              $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
            }
          }
          // วรรคที่ 4
          else if($i==7){
            if(($totalPY-2)==8){
              $py[$i][0] =$arrKlonPhonemes[$i][3];
              $py[$i][1] =$arrKlonPhonemes[$i][5];
              $py[$i][2] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else if(($totalPY-2)==9){
              $py[$i][0] =$arrKlonPhonemes[$i][3];
              $py[$i][1] =$arrKlonPhonemes[$i][6];
              $py[$i][2] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else if(($totalPY-2)==7){
              $py[$i][0] =$arrKlonPhonemes[$i][2];
              $py[$i][1] =$arrKlonPhonemes[$i][3];
              $py[$i][2] =$arrKlonPhonemes[$i][4];
              $py[$i][3] =$arrKlonPhonemes[$i][5];
              $py[$i][4] =$arrKlonPhonemes[$i][$totalPY-2];
            }
            else {
              $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
            }
          }
        }
  //print_r ($py);
  //$str3="";
  for($i=0 ; $i<count($py) ; $i++){
    $strExternalRhyme="";
    for($j=0 ; $j<count($py[$i]) ; $j++){
      if($py[$i][0] != "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก"){
        $strExternalRhyme = $strExternalRhyme."~".$py[$i][$j];
        //echo $str3;
        $py2[$i] = explode("~",$strExternalRhyme);
      }
      else {
        $py2[$i] = "จำนวนพยางค์ไม่เพียงพอในการตรวจสัมผัสนอก";
      }
    }
  }
  //echo "<br>";
  print_r ($py2);
  for($i=0 ; $i<count($py2) ; $i++){
    $index = 0;
    for($j=0 ; $j<count($py2[$i]) ; $j+=2){
        $rhyme[$i][$index] = $py2[$i][$j];
        $index = $index+1;
    }
  }
  echo "<br>";
  //print_r ($rhyme);
  // ตรวจสัมผัสตามกฏ
  // สัมผัสระหว่างวรรคที่ 1 กับ วรรคที่ 2
  $resultExternalRhyme = new CheckSyntaxAndMelody();
  $strExternalRhyme2 = "";
  for($i=0 ; $i<$countOfWak ; $i++){
    // บทที่ 1
    if($i==0 || $i<4){
      // สัมผัสระหว่างวรรคที่ 1 กับ วรรคที่ 2
      if($i==0){
        if($rhyme[$i][1]==$rhyme[1][1] || $rhyme[$i][1]==$rhyme[1][2]){
          $strExternalRhyme2 = ($strExternalRhyme2)."มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 1-true ";
        }
        else if($rhyme[$i][1]!=$rhyme[1][1] && $rhyme[$i][1]!=$rhyme[1][2]){
          $strExternalRhyme2 = ($strExternalRhyme2)."ไม่มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 1-false ";
        }
      }
      // สัมผัสระหว่างวรรคที่ 2 กับ วรรคที่ 3
      else if($i==1){
        if($rhyme[$i][3]==$rhyme[2][1]){
          $strExternalRhyme2 = ($strExternalRhyme2)."มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 1-true ";
        }
        else if($rhyme[$i][3]!=$rhyme[2][1]){
          $strExternalRhyme2 = ($strExternalRhyme2)."ไม่มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 1-false ";
        }
      }

      // สัมผัสระหว่างวรรคที่ 3 กับ วรรคที่ 4
      else if($i==2){
        if($rhyme[$i][1]==$rhyme[3][1] || $rhyme[$i][1]==$rhyme[3][2]){
          $strExternalRhyme2 = ($strExternalRhyme2)."มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 1-true ";
        }
        else if($rhyme[$i][1]!=$rhyme[3][1] && $rhyme[$i][1]!=$rhyme[3][2]){
          $strExternalRhyme2 = ($strExternalRhyme2)."ไม่มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 1-false ";
        }
      }
    }
    else if($i==4 || $i<8){
      // สัมผัสระหว่างวรรคที่ 1 กับ วรรคที่ 2
      if($i==4){
        if($rhyme[$i][1]==$rhyme[5][1] || $rhyme[$i][1]!=$rhyme[5][2]){
          $strExternalRhyme2 = ($strExternalRhyme2)."มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 2-true ";
        }
        else if($rhyme[$i][1]!=$rhyme[5][1] && $rhyme[$i][1]!=$rhyme[5][2]){
          $strExternalRhyme2 = ($strExternalRhyme2)."ไม่มีสัมผัสนอกระหว่างวรรคที่ 1 กับ วรรคที่ 2 ในบทที่ 2-false ";
        }
      }
      // สัมผัสระหว่างวรรคที่ 2 กับ วรรคที่ 3
      else if($i==5){
        if($rhyme[$i][3]==$rhyme[6][1]){
          $strExternalRhyme2 = ($strExternalRhyme2)."มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 2-true ";
        }
        else if($rhyme[$i][3]!=$rhyme[6][1]){
          $strExternalRhyme = ($strExternalRhyme)."ไม่มีสัมผัสนอกระหว่างวรรคที่ 2 กับ วรรคที่ 3 ในบทที่ 2-false ";
        }
      }
      // สัมผัสระหว่างวรรคที่ 3 กับ วรรคที่ 4 ********** ขาดสัมผัสระหว่างบทนะ
      else if($i==6){
        if($rhyme[$i][1]==$rhyme[7][1] || $rhyme[$i][1]==$rhyme[7][2]){
          $strExternalRhyme2 = ($strExternalRhyme2)."มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 2-true ";
        }
        else if($i==6 && $rhyme[$i][1]!=$rhyme[7][1] && $rhyme[$i][1]!=$rhyme[7][2]){
          $strExternalRhyme2 = ($strExternalRhyme2)."ไม่มีสัมผัสนอกระหว่างวรรคที่ 3 กับ วรรคที่ 4 ในบทที่ 2-false ";
        }
      }
    }
    // สัมผัสระหว่างบท
    if($countOfWak>4 && $countOfWak<8){
      if($rhyme[3][3]==$rhyme[5][3]){
        $strExternalRhyme2 = ($strExternalRhyme2)."มีสัมผัสนอกระหว่างบท-true ";
      }
      else if($rhyme[3][3]!=$rhyme[5][3]){
        $strExternalRhyme2 = ($strExternalRhyme2)."ไม่มีสัมผัสนอกระหว่างบท-false ";
      }
    }
  }
  $resultExternalRhyme->externalRhyme = ($strExternalRhyme2);
  $jsonExternalRhyme = json_encode($resultExternalRhyme);
  echo ($jsonExternalRhyme."<br>"); // ส่วนที่เราคืนให้พาน
  $deJsonExternalRhyme = json_decode($jsonExternalRhyme, true); // ส่วนของจูนไม่ต้องดีโค้ดก็ได้ แต่ดีไว้ดูความถูกต้องได้ ซึ่งเวลาส่งจริงอย่าลืมปิดละ
  print_r ($deJsonExternalRhyme);
  echo "<br>.................................................<br>";

?>
