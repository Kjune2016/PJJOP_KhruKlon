<?php
//require ("DataConversion4.php");
require_once ("CNDB.php");
//require_once ("CNDBWord.php");
//print_r ($arrKlonWord);
//echo "<br>";
/// ตรวจทุกคำกับพจนานุกรม หาคำอะกึ่งเสียง กรณีจำนวนพยางค์เกิน 9 พยางค์
/// ฉัน จะ ไป จ่าย ตะ หลาด ได้ ที่ ไหน บ้าง

// ตรวจคำสแลง
function slangWord($arrKlonWord,$conn){
  $arrSlang = array();
  $numSlang = 0;
  $count = 0;
  $check = 0;
  for($i=0 ; $i<count($arrKlonWord) ; $i++){
    //echo "<br>".(count($arrKlonWord[$i]));
    if(count($arrKlonWord[$i])>0){
      for($j=0 ; $j<count($arrKlonWord[$i]) ; $j++){
        $word = $arrKlonWord[$i][$j];
        // ตรวจคำสแลง
        $querySlang = "SELECT word FROM slang_word WHERE word = '$word'";
        $resultSlang = mysqli_query($conn, $querySlang);
        if (mysqli_num_rows($resultSlang) > 0) {
          if(in_array($word,$arrSlang)){
            $numSlang = $numSlang;
          }
          //$arrSlang[$numSlang] = $word;
          //$numSlang++;
        //}
          else {
            $arrSlang[$numSlang] = $word;
            $numSlang++;
          }
          $count++;
          $check = 1;
        }
        else {
          $check = 1;
        }
      }
    }
    else {
      $check = 0;
    }
  }
  //print_r ($arrSlang);
  //echo $count."<br>";
  // แสดงค่าคำสแลง
  if(count($arrSlang)>0 && $check != 0){
    for($i=0 ; $i<count($arrSlang) ; $i++){
      $arrSlangWord[$i][str] = "พบคำสแลงคำว่า ".($arrSlang[$i]);
      $arrSlangWord[$i][status] = "false";
    }
  }
  else if($check != 0){
    $arrSlangWord[0][str] = "ไม่พบคำสแลง";
    $arrSlangWord[0][status] = "true";
  }
  else if($check == 0){
    $arrSlangWord[0][str] = "ไม่พบคำสแลง";
    $arrSlangWord[0][status] = "veryFalse";
  }
  $arrSlangWord[count] = $count;
  return ($arrSlangWord);
}

// ตรวจคำหยาบคาย
function badWord($arrKlonWord, $conn){
  $arrBad = array();
  $numBad = 0;
  $count = 0;
  $check = 0;
  for($i=0 ; $i<count($arrKlonWord) ; $i++){
    if(count($arrKlonWord[$i])>0){
      for($j=0 ; $j<count($arrKlonWord[$i]) ; $j++){
        $word = $arrKlonWord[$i][$j];
        $queryBad = "SELECT word FROM bad_word WHERE word = '$word'";
        $resultBad = mysqli_query($conn, $queryBad);
        if (mysqli_num_rows($resultBad) > 0) {
          if(in_array($word,$arrBad)){
            $numBad = $numBad;
          }
          //$arrBad[$numBad] = $word;
          //$numBad++;
        //}
          else {
            $arrBad[$numBad] = $word;
            $numBad++;
          }
          $check = 1;
          $count++;
        }
        else {
          $check = 1;
        }
      }
    }
    else {
      $check = 0;
    }
  }
//echo $count;
  //print_r ($arrBad);
  //echo "<br>bad<br>";
    // แสดงค่าคำหยาบคาย
    if(count($arrBad)>0 && $check != 0){
      for($i=0 ; $i<count($arrBad) ; $i++){
        $arrBadWord[$i][str] = "พบคำหยาบคายคำว่า ".($arrBad[$i]);
        $arrBadWord[$i][status] = "false";
      }
    }
    else if($check != 0){
      $arrBadWord[0][str] = "ไม่พบคำหยาบคาย";
      $arrBadWord[0][status] = "true";
    }
    else if($check == 0){
      $arrBadWord[0][str] = "ไม่พบคำหยาบคาย";
      $arrBadWord[0][status] = "veryFalse";
    }
    $arrBadWord[count] = $count;
    return ($arrBadWord);
  }
  //print_r ($arrBadWord);
  //echo "<br>";
  //print_r ($arrKlonWord);
  //echo "<br>";
  // ตรวจการใช้คำ คำคู่ที่ถูกสลับ คำไม่มีความหมาย   ยังต้องแก้อีกอะ เศร้า

// ตรวจคำคู่่
function useWord($arrKlonWord, $conn, $connDBWord){
  // ลอง วิธีที่ 4
  //print_r($arrKlonWord);
    /*for($i=0 ; $i<count($arrKlonWord) ; $i++){
      for($j=0 ; $j<count($arrKlonWord[$i]) ; $j++){
        $word = $arrKlonWord[$i][$j];
        //echo $word." ";
        $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word'";
        $resultDict = mysqli_query($conn, $queryDict);
        //echo mysqli_num_rows($resultDict)."<br>";
        $queryDouble = "SELECT word FROM double_word WHERE word = '$word'";
        $resultDouble = mysqli_query($connDBWord, $queryDouble);
        //echo mysqli_num_rows($resultDouble)."<br>";
        if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
          //echo " ".$word." ";
          $value1 = $arrKlonWord[$i][$j-1];
          $value2 = $arrKlonWord[$i][$j+1];
          $word1 = $value1.$word.$value2;
          //echo $word1."<br>";
          $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word1'";
          $resultDict = mysqli_query($conn, $queryDict);
          $queryDouble = "SELECT word FROM double_word WHERE word = '$word1'";
          $resultDouble = mysqli_query($connDBWord, $queryDouble);
          if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
            $word2 = $word.$value2.$value1;
            //echo "<br>".$word2."1"."<br>";
            $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word2'";
            $resultDict = mysqli_query($conn, $queryDict);
            $queryDouble = "SELECT word FROM double_word WHERE word = '$word2'";
            $resultDouble = mysqli_query($connDBWord, $queryDouble);
            if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
              $word3 = $value2.$value1.$word;
              //echo "<br>".$word3."2"."<br>";
              $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word3'";
              $resultDict = mysqli_query($conn, $queryDict);
              $queryDouble = "SELECT word FROM double_word WHERE word = '$word3'";
              $resultDouble = mysqli_query($connDBWord, $queryDouble);
              if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
                $word1 = $value1.$word;
                //echo "<br>".$word1."<br>";
                $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word1'";
                $resultDict = mysqli_query($conn, $queryDict);
                $queryDouble = "SELECT word FROM double_word WHERE word = '$word1'";
                $resultDouble = mysqli_query($connDBWord, $queryDouble);
                if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
                  $word2 = $word.$value1;
                  //echo "<br>".$word2."1"."<br>";
                  $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word2'";
                  $resultDict = mysqli_query($conn, $queryDict);
                  $queryDouble = "SELECT word FROM double_word WHERE word = '$word2'";
                  $resultDouble = mysqli_query($connDBWord, $queryDouble);
                  if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
                    $word1 = $word.$value2;
                    //echo "<br>".$word1."<br>";
                    $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word1'";
                    $resultDict = mysqli_query($conn, $queryDict);
                    $queryDouble = "SELECT word FROM double_word WHERE word = '$word1'";
                    $resultDouble = mysqli_query($connDBWord, $queryDouble);
                    if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
                      $word2 = $value2.$word;
                      //echo "<br>".$word2."1"."<br>";
                      $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word2'";
                      $resultDict = mysqli_query($conn, $queryDict);
                      $queryDouble = "SELECT word FROM double_word WHERE word = '$word2'";
                      $resultDouble = mysqli_query($connDBWord, $queryDouble);
                      if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
                        $arrWordIncorrect[$i][$j] = $word2;
                      }
                      else {
                        //echo "string1"."<br>";
                        $arrWordInCorrect[$i][$j] = $word;
                      }
                    }
                    else {
                      //echo "string2"."<br>";
                      $arrWordInCorrect[$i][$j] = $word1;
                    }
                  }
                  else {
                    //echo "string3"."<br>";
                    //echo $word2."<br>";
                    $arrWordInCorrect[$i][$j] = $word2;
                  }
                }
                else {
                  //echo "string4"."<br>";
                  $arrWordInCorrect[$i][$j] = $word;
                }
              }
              else {
                //echo "string5"."<br>";
                $arrWordInCorrect[$i][$j] = $word;
              }
            }
            else {
              //echo "string6"."<br>";
              $arrWordInCorrect[$i][$j] = $word;
            }
          }
          else {
            //echo "string6"."<br>";
            $arrWordInCorrect[$i][$j] = $word;
          }
        }
        else if(mysqli_num_rows($resultDict) != 0 || mysqli_num_rows($resultDouble) != 0){
          //echo $word."<br>";
          $arrWordCorrect[$i][$j] = $word;
        }
      }
    }
    //print_r ($arrWordCorrect);
    if(count($arrWordInCorrect[$i])>=1){
      for($i=0 ; $i<count($arrWordInCorrect) ; $i++){
        for($j=1 ; $j<=count($arrWordInCorrect[$i]) ; $j++){
          $entry = $entry." คำว่า ".$arrWordInCorrect[$i][$j];
          $arrUseWord[str] = "มีคำที่ถูกใช้ผิดคือ ".($entry);
          $arrUseWord[status] = "false";
        }
      }
    }
    /*if(count($arrWordCorrect)>=1){
      for($i=0 ; $i<count($arrWordCorrect) ; $i++){
        for($j=1 ; $j<=count($arrWordCorrect[$i]) ; $j++){
          $entry = $entry." คำว่า ".$arrWordCorrect[$i][$j];
          $arrUseWord[str] = ($entry)."เป็นคำที่ใช้ถูกต้อง";
          $arrUseWord[status] = "true";
        }
      }
    }

    //print_r($arrUseWord);
    return ($arrUseWord);*/
    //print_r ($arrUseWord);
}



//$a = slangWord($arrKlonWord,$connDBWord);
//$b = badWord($arrKlonWord,$connDBWord);
//$c = useWord($arrKlonWord,$conn,$connDBWord);
//print_r ($a);
//echo "<br>";
//print_r ($b);
//echo "<br>";
//print_r ($c);

?>
