<?php
require ("DataConversion4.php");
require ("CNDB.php");
require ("CNDBWord.php");
//print_r ($arrKlonWord);
//echo "<br>";
/// ตรวจทุกคำกับพจนานุกรม หาคำอะกึ่งเสียง กรณีจำนวนพยางค์เกิน 9 พยางค์
/// ฉัน จะ ไป จ่าย ตะ หลาด ได้ ที่ ไหน บ้าง
function slangWord($arrKlonWord,$connDBWord){
  $numSlang = 0;
  for($i=0 ; $i<count($arrKlonWord) ; $i++){
    for($j=0 ; $j<count($arrKlonWord[$i]) ; $j++){
      $word = $arrKlonWord[$i][$j];
      // ตรวจคำสแลง
      $querySlang = "SELECT word FROM slang_word WHERE word = '$word'";
      $resultSlang = mysqli_query($connDBWord, $querySlang);
      if (mysqli_num_rows($resultSlang) > 0) {
        $arrSlang[$numSlang] = $word;
        $numSlang++;
      }
    }
  }
  //print_r ($arrSlang);
  // แสดงค่าคำสแลง
  if(count($arrSlang)>0){
    for($i=0 ; $i<count($arrSlang) ; $i++){
      $arrSlangWord[$i][str] = "พบคำสแลงคำว่า ".($arrSlang[$i]);
      $arrSlangWord[$i][status] = "false";
    }
  }
  else{
    $arrSlangWord[str] = "ไม่พบคำสแลง";
    $arrSlangWord[status] = "true";
  }
  return ($arrSlangWord);
}

// ตรวจคำหยาบคาย
function badWord($arrKlonWord, $connDBWord){
  $numBad = 0;
  for($i=0 ; $i<count($arrKlonWord) ; $i++){
    for($j=0 ; $j<count($arrKlonWord[$i]) ; $j++){
      $word = $arrKlonWord[$i][$j];
      $queryBad = "SELECT word FROM bad_word WHERE word = '$word'";
      $resultBad = mysqli_query($connDBWord, $queryBad);
      if (mysqli_num_rows($resultBad) > 0) {
        $arrBad[$numBad] = $word;
        $numBad++;
    }
  }
  // แสดงค่าคำหยาบคาย
  if(count($arrBad)>0){
    for($i=0 ; $i<count($arrBad) ; $i++){
      $arrBadWord[$i][str] = "พบคำหยาบคายคำว่า ".($arrBad[$i]);
      $arrBadWord[$i][status] = "false";
    }
  }
  else{
    $arrBadWord[str] = "ไม่พบคำหยาบคาย";
    $arrBadWord[status] = "true";
  }
  return ($arrBadWord);
}
}
//print_r ($arrKlonWord);
//echo "<br>";
// ตรวจการใช้คำ คำคู่ที่ถูกสลับ คำไม่มีความหมาย
function useWord($arrKlonWord, $conn, $connDBWord){
  // ลอง วิธีที่ 4
    for($i=0 ; $i<count($arrKlonWord) ; $i++){
      for($j=0 ; $j<count($arrKlonWord[$i]) ; $j++){
        $word = $arrKlonWord[$i][$j];
        $queryDict = "SELECT sentry FROM dictdb_th_en WHERE sentry = '$word'";
        $resultDict = mysqli_query($conn, $queryDict);
        $queryDouble = "SELECT word FROM double_word WHERE word = '$word'";
        $resultDouble = mysqli_query($connDBWord, $queryDouble);
        if(mysqli_num_rows($resultDict) == 0 && mysqli_num_rows($resultDouble) == 0){
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
                        $arrWordIncorrect[$i][$j] = $word;
                      }
                      else {
                        //echo "string1"."<br>";
                        $arrWordIncorrect[$i][$j] = $word;
                      }
                    }
                    else {
                      //echo "string2"."<br>";
                      $arrWordIncorrect[$i][$j] = $word;
                    }
                  }
                  else {
                    //echo "string3"."<br>";
                    $arrWordIncorrect[$i][$j] = $word;
                  }
                }
                else {
                  //echo "string4"."<br>";
                  $arrWordIncorrect[$i][$j] = $word;
                }
              }
              else {
                //echo "string5"."<br>";
                $arrWordIncorrect[$i][$j] = $word;
              }
            }
            else {
              //echo "string6"."<br>";
              $arrWordIncorrect[$i][$j] = $word;
            }
          }
        }
      }
    }
    //print_r ($arrWordIncorrect);
    for($i=0 ; $i<count($arrWordIncorrect) ; $i++){
      for($j=1 ; $j<=count($arrWordIncorrect[$i]) ; $j++){
        if(count($arrWordIncorrect[$i])>1){
          $entry = $entry." คำว่า ".$arrWordIncorrect[$i][$j];
          $arrUseWord[str] = "มีคำที่ถูกใช้ผิดคือ ".($entry);
          $arrUseWord[status] = "false";
        }
        else if(count($arrWordIncorrect[$i]) == 1){
          $arrUseWord[str] = "มีคำที่ถูกใช้ผิดคือคำว่า ".($entry);
          $arrUseWord[status] = "false";
        }
        else {
          $arrUseWord[str] = "ไม่มีคำที่ถูกใช้ผิด";
          $arrUseWord[status] = "true";
        }
      }
    }
    return ($arrUseWord);
    //print_r ($arrUseWord);
}

// ตรวจคำอะกึ่งเสียง
//function aKuengSiangWord($wakNo,$connDBWord){
    $deJsonWak = json_decode($jsonWak[1],true); // เลข 1 เปลี่ยนไปตาม $wakNo
    //print_r ($deJsonWak);
    foreach ($deJsonWak as $key=>$value) {
      $str = $value['payang'];
      //echo $str." "."<br>";
      $str2 = $value['word'];
      //echo $str2." ";
      if(stristr($str,"-")){
        if(stristr($str2,"ะ")){
          //echo "<br>".$str2."1"." ";
          //array_push($arrBePhonemes,$value['phonemes']);
          $value['phonemes'] = substr($value['phonemes'],6);
          //echo $value['phonemes'];
        }
        else {

        }
      }
    }
    echo "<br>";
    //print_r ($deJsonWak);
    //print_r ($arrBePayang);
    print_r ($arrKlonPhonemes);
//}
$a = slangWord($arrKlonWord,$connDBWord);
$b = badWord($arrKlonWord,$connDBWord);
$c = useWord($arrKlonWord,$conn,$connDBWord);
//print_r ($a);
//echo "<br>";
//print_r ($b);
//echo "<br>";
//print_r ($c);

?>
