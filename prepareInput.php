<?php
require ("DataConversion.php");
//require ("DataConversion2.php");
//require ("DataConversion3.php");
/*print_r ($arrKlonWord);
echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";
print_r ($arrKlonPayang);
echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";
print_r ($arrKlonPhonemes);
echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";
print_r ($arrKlonTone);
echo "<br>!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!<br>";*/
//print_r ($arrWak);
//$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/w/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";
$klon = "แล้วสอนว่าอย่าไว้ใจมนุษย์/wมันแสนสุดลึกล้ำเหลือกำหนด/wถึงเถาวัลย์พันเกี้ยวที่เลี้ยวลด/wก็ไม่คดเหมือนหนึ่งในน้ำใจคน/w/e";

/// เตรียม input สำหรับตรวจจำนวนวรรค
//$klon = $_POST['klon'];
//print_r (explode("/w", $klon));
$arrWak = (explode("/w", $klon));



//print ($countOfWak);

/// เตรียม input สำหรับตรวจสัมผัสนอก
// เก็บพยางค์ที่เป็นตำแหน่งรับ-ส่งสัมผัสกันเอาไว้ใน array ชื่อ rhyme ก่อน
$pn = [];
$pn2 = [];
$rhyme = [];
for($i=0 ; $i<count($arrWak)-1 ; $i++){
  $totalPN = count($arrKlonPhonemes[$i]);
  //echo ($totalPN)." ";
      // บทที่ 1
      if($i==0 || $i<4){
        // กรณี 8 9 and 7 พยางค์
          // วรรคที่ 1 บทที่ 1
          if($i==0){
            $pn[$i][0] =$arrKlonPhonemes[$i][$totalPN-1];
          }
          // วรรคที่ 2
          else if($i==1){
            if(($totalPN-1)==8){
              $pn[$i][0] =$arrKlonPhonemes[$i][3];
              $pn[$i][1] =$arrKlonPhonemes[$i][5];
              $pn[$i][2] =$arrKlonPhonemes[$i][$totalPN-1];
            }
            else if(($totalPN-1)>=9){
              $pn[$i][0] =$arrKlonPhonemes[$i][3];
              $pn[$i][1] =$arrKlonPhonemes[$i][6];
              $pn[$i][2] =$arrKlonPhonemes[$i][$totalPN-1];
            }
            else if(($totalPN-1)==7){
              $pn[$i][0] =$arrKlonPhonemes[$i][2];
              $pn[$i][1] =$arrKlonPhonemes[$i][3];
              $pn[$i][2] =$arrKlonPhonemes[$i][4];
              $pn[$i][3] =$arrKlonPhonemes[$i][5];
              $pn[$i][4] =$arrKlonPhonemes[$i][$totalPN-1];
            }
            else if(($totalPN-1)<8){
              $pn[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
            }
          }
          // วรรคที่ 3
          else if($i==2){
            $pn[$i][0] =$arrKlonPhonemes[$i][$totalPN-1];
          }
          // วรรคที่ 4
          else if($i==3){
            if(($totalPN-1)==8){
              $pn[$i][0] =$arrKlonPhonemes[$i][3];
              $pn[$i][1] =$arrKlonPhonemes[$i][5];
              $pn[$i][2] =$arrKlonPhonemes[$i][$totalPN-1];
            }
            else if(($totalPN-1)>=9){
              $pn[$i][0] =$arrKlonPhonemes[$i][3];
              $pn[$i][1] =$arrKlonPhonemes[$i][6];
              $pn[$i][2] =$arrKlonPhonemes[$i][$totalPN-1];
            }
            else if(($totalPN-1)==7){
              $pn[$i][0] =$arrKlonPhonemes[$i][2];
              $pn[$i][1] =$arrKlonPhonemes[$i][3];
              $pn[$i][2] =$arrKlonPhonemes[$i][4];
              $pn[$i][3] =$arrKlonPhonemes[$i][5];
              $pn[$i][4] =$arrKlonPhonemes[$i][$totalPN-1];
            }
            else if(($totalPN-1)<8){
              $pn[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
            }
          }
        }
    // บทที่ 2
    if($i>=4 || $i<8){
      // กรณี 8 9 and 7 พยางค์
        // วรรคที่ 1 บทที่ 2
        if($i==4){
          $pn[$i][0] =$arrKlonPhonemes[$i][$totalPN-1];
        }
        // วรรคที่ 2
        else if($i==5){
          if(($totalPN-1)==8){
            $pn[$i][0] =$arrKlonPhonemes[$i][3];
            $pn[$i][1] =$arrKlonPhonemes[$i][5];
            $pn[$i][2] =$arrKlonPhonemes[$i][$totalPN-1];
          }
          else if(($totalPN-1)==9){
            $pn[$i][0] =$arrKlonPhonemes[$i][3];
            $pn[$i][1] =$arrKlonPhonemes[$i][6];
            $pn[$i][2] =$arrKlonPhonemes[$i][$totalPN-1];
          }
          else if(($totalPY-1)==7){
            $pn[$i][0] =$arrKlonPhonemes[$i][2];
            $pn[$i][1] =$arrKlonPhonemes[$i][3];
            $pn[$i][2] =$arrKlonPhonemes[$i][4];
            $pn[$i][3] =$arrKlonPhonemes[$i][5];
            $pn[$i][4] =$arrKlonPhonemes[$i][$totalPN-1];
          }
          else if(($totalPN-1)<8){
            $pn[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
          }
        }
        // วรรคที่ 3
        else if($i==6){
          $pn[$i][0] =$arrKlonPhonemes[$i][$totalPN-1];
        }
        // วรรคที่ 4
        else if($i==7){
          if(($totalPN-1)==8){
            $pn[$i][0] =$arrKlonPhonemes[$i][3];
            $pn[$i][1] =$arrKlonPhonemes[$i][5];
            $pn[$i][2] =$arrKlonPhonemes[$i][$totalPN-1];
          }
          else if(($totalPN-1)==9){
            $pn[$i][0] =$arrKlonPhonemes[$i][3];
            $pn[$i][1] =$arrKlonPhonemes[$i][6];
            $pn[$i][2] =$arrKlonPhonemes[$i][$totalPN-1];
          }
          else if(($totalPN-1)==7){
            $pn[$i][0] =$arrKlonPhonemes[$i][2];
            $pn[$i][1] =$arrKlonPhonemes[$i][3];
            $pn[$i][2] =$arrKlonPhonemes[$i][4];
            $pn[$i][3] =$arrKlonPhonemes[$i][5];
            $pn[$i][4] =$arrKlonPhonemes[$i][$totalPN-1];
          }
          else if(($totalPN-1)<8){
            $pn[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
          }
        }
      }
    }
//print_r ($pn);
//echo "<br>";
//$str3="";
for($i=0 ; $i<count($pn) ; $i++){
  $strExternalRhyme="";
  for($j=0 ; $j<count($pn[$i]) ; $j++){
    if($pn[$i][0] != "จำนวนพยางค์ไม่ถูกต้อง"){
      $strExternalRhyme = $strExternalRhyme."~".$pn[$i][$j];
      //echo $str3;
      $pn2[$i] = explode("~",$strExternalRhyme);
    }
    else {
      $pn2[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
    }
  }
}
//echo "<br>";
//print_r ($pn2);
for($i=0 ; $i<count($pn2) ; $i++){
  $index = 0;
  for($j=0 ; $j<count($pn2[$i]) ; $j+=2){
    if($pn2[$i][0]!="จำนวนพยางค์ไม่ถูกต้อง"){
      $rhyme[$i][$index] = $pn2[$i][$j];
      $index = $index+1;
    }
    else {
      $rhyme[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
    }
  }
}



/// เตรียม input เพื่อตรวจสัมผัสซ้ำ
$py = [];
for($i=0 ; $i<count($arrWak)-1 ; $i++){
  $totalPY = count($arrKlonPayang[$i]);
  //echo ($totalPN)." ";
      // บทที่ 1
      if($i==0 || $i<4){
        // กรณี 8 9 and 7 พยางค์
          // วรรคที่ 1 บทที่ 1
          if($i==0){
            $py[$i][0] =$arrKlonPayang[$i][$totalPY-1];
          }
          // วรรคที่ 2
          else if($i==1){
            if(($totalPY-1)==8){
              $py[$i][0] =$arrKlonPayang[$i][3];
              $py[$i][1] =$arrKlonPayang[$i][5];
              $py[$i][2] =$arrKlonPayang[$i][$totalPY-1];
            }
            else if(($totalPY-1)>=9){
              $py[$i][0] =$arrKlonPayang[$i][3];
              $py[$i][1] =$arrKlonPayang[$i][6];
              $py[$i][2] =$arrKlonPayang[$i][$totalPY-1];
            }
            else if(($totalPY-1)==7){
              $py[$i][0] =$arrKlonPayang[$i][2];
              $py[$i][1] =$arrKlonPayang[$i][3];
              $py[$i][2] =$arrKlonPayang[$i][4];
              $py[$i][3] =$arrKlonPayang[$i][5];
              $py[$i][4] =$arrKlonPayang[$i][$totalPY-1];
            }
            else if(($totalPY-1)<8){
              $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอ";
            }
          }
          // วรรคที่ 3
          else if($i==2){
            $py[$i][0] =$arrKlonPayang[$i][$totalPY-1];
          }
          // วรรคที่ 4
          else if($i==3){
            if(($totalPY-1)==8){
              $py[$i][0] =$arrKlonPayang[$i][3];
              $py[$i][1] =$arrKlonPayang[$i][5];
              $py[$i][2] =$arrKlonPayang[$i][$totalPY-1];
            }
            else if(($totalPY-1)>=9){
              $py[$i][0] =$arrKlonPayang[$i][3];
              $py[$i][1] =$arrKlonPayang[$i][6];
              $py[$i][2] =$arrKlonPayang[$i][$totalPY-1];
            }
            else if(($totalPY-1)==7){
              $py[$i][0] =$arrKlonPayang[$i][2];
              $py[$i][1] =$arrKlonPayang[$i][3];
              $py[$i][2] =$arrKlonPayang[$i][4];
              $py[$i][3] =$arrKlonPayang[$i][5];
              $py[$i][4] =$arrKlonPayang[$i][$totalPY-1];
            }
            else if(($totalPY-1)<8){
              $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอ";
            }
          }
        }
    // บทที่ 2
    if($i>=4 || $i<8){
      // กรณี 8 9 and 7 พยางค์
        // วรรคที่ 1 บทที่ 2
        if($i==4){
          $py[$i][0] =$arrKlonPayang[$i][$totalPY-1];
        }
        // วรรคที่ 2
        else if($i==5){
          if(($totalPY-1)==8){
            $py[$i][0] =$arrKlonPayang[$i][3];
            $py[$i][1] =$arrKlonPayang[$i][5];
            $py[$i][2] =$arrKlonPayang[$i][$totalPY-1];
          }
          else if(($totalPY-1)==9){
            $py[$i][0] =$arrKlonPayang[$i][3];
            $py[$i][1] =$arrKlonPayang[$i][6];
            $py[$i][2] =$arrKlonPayang[$i][$totalPY-1];
          }
          else if(($totalPY-1)==7){
            $py[$i][0] =$arrKlonPayang[$i][2];
            $py[$i][1] =$arrKlonPayang[$i][3];
            $py[$i][2] =$arrKlonPayang[$i][4];
            $py[$i][3] =$arrKlonPayang[$i][5];
            $py[$i][4] =$arrKlonPayang[$i][$totalPY-1];
          }
          else if(($totalPY-1)<8){
            $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอ";
          }
        }
        // วรรคที่ 3
        else if($i==6){
          $py[$i][0] =$arrKlonPayang[$i][$totalPY-1];
        }
        // วรรคที่ 4
        else if($i==7){
          if(($totalPY-1)==8){
            $py[$i][0] =$arrKlonPayang[$i][3];
            $py[$i][1] =$arrKlonPayang[$i][5];
            $py[$i][2] =$arrKlonPayang[$i][$totalPY-1];
          }
          else if(($totalPY-1)==9){
            $py[$i][0] =$arrKlonPayang[$i][3];
            $py[$i][1] =$arrKlonPayang[$i][6];
            $py[$i][2] =$arrKlonPayang[$i][$totalPY-1];
          }
          else if(($totalPY-1)==7){
            $py[$i][0] =$arrKlonPayang[$i][2];
            $py[$i][1] =$arrKlonPayang[$i][3];
            $py[$i][2] =$arrKlonPayang[$i][4];
            $py[$i][3] =$arrKlonPayang[$i][5];
            $py[$i][4] =$arrKlonPayang[$i][$totalPY-1];
          }
          else if(($totalPY-1)<8){
            $py[$i][0] = "จำนวนพยางค์ไม่เพียงพอ";
          }
        }
      }
    }
  //print_r ($py);

/// เตรียม input สำหรับตรวจชิงสัมผัส
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
        }
      }
    }
  }
}
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

/// เตรียม input สำหรับตรวจสัมผสใน
$pnInRhyme = [];
for($i=0 ; $i<count($arrWak)-1 ; $i++){
  $totalPN = count($arrKlonPhonemes[$i])-1;
  if($totalPN==8 && $i==0 || $i==4){
      $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][3];
      $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][4];
      $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][5];
      $pnInRhyme[$i][3] = $arrKlonPhonemes[$i][6];
      $pnInRhyme[$i][4] = $arrKlonPhonemes[$i][7];
  }
  else if($totalPN==8 && $i==1 || $i==2 || $i==3 || $i==5 || $i==6 || $i==7){
      $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][5];
      $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][6];
      $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][7];
  }
  else if($totalPN>=9 && $i==0 || $i==4){
      $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][3];
      $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][4];
      $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][6];
      $pnInRhyme[$i][3] = $arrKlonPhonemes[$i][7];
      $pnInRhyme[$i][4] = $arrKlonPhonemes[$i][8];
  }
  else if($totalPN>=9 && $i==1 || $i==2 || $i==3 || $i==5 || $i==6 || $i==7){
      $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][6];
      $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][7];
      $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][8];
  }
  else if($totalPN==7 && $i==0 || $i==4){
      $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][2];
      $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][3];
      $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][4];
      $pnInRhyme[$i][3] = $arrKlonPhonemes[$i][5];
      $pnInRhyme[$i][4] = $arrKlonPhonemes[$i][6];
  }
  else if($totalPN==7 && $i==1 || $i==2 || $i==3 || $i==5 || $i==6 || $i==7){
      $pnInRhyme[$i][0] = $arrKlonPhonemes[$i][4];
      $pnInRhyme[$i][1] = $arrKlonPhonemes[$i][5];
      $pnInRhyme[$i][2] = $arrKlonPhonemes[$i][6];
  }
  else {
      $pnInRhyme[$i][0] = "จำนวนพยางค์ไม่ถูกต้อง";
  }
}
//echo "<br>///////////////////////////////////<br>";
//print_r ($pnInRhyme);
$pnInRhyme2 = [];
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
$InternalRhyme = [];
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
?>
