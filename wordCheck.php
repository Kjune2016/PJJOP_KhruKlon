<?php
require ("DataConversion.php");
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
$a = slangWord($arrKlonWord,$connDBWord);
$b = badWord($arrKlonWord,$connDBWord);
print_r ($a);
echo "<br>";
print_r ($b);


?>
