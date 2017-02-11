<?php
//require ("return2.php");
require ("return3.php");
//function scoreHard($arrWak,$arrOfTone,$arrNumPayang,$arrDupRhyme,$arrExternalRhyme){
$pan = array();
$strWak = "";
$check = 0;
$countWak = count($_SESSION['numWak'])-1;
for($i=0 ; $i<$countWak ; $i++){
  if($_SESSION['numWak'][$i]['status'] == "false"){
    $strWak = ($strWak)."/-".($_SESSION['numWak'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['prosody']['numWak']['str'] = $strWak;
  $pan['prosody']['numWak']['status'] = "false";
}
else {
  $pan['prosody']['numWak']['str'] = "/-จำนวนวรรคถูกต้อง";
  $pan['prosody']['numWak']['status'] = "true";
}


$strPayang = "";
$check = 0;
$countPayang = count($_SESSION['numPayang']);
for($i=0 ; $i<$countPayang ; $i++){
  if($_SESSION['numPayang'][$i]['status'] == "false"){
    $strPayang = ($strPayang)."/-".($_SESSION['numPayang'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['prosody']['numPayang']['str'] = $strPayang;
  $pan['prosody']['numPayang']['status'] = "false";
}
else {
  $pan['prosody']['numPayang']['str'] = "/-จำนวนพยางค์ถูกต้อง";
  $pan['prosody']['numPayang']['status'] = "true";
}


$strTone = "";
$check = 0;
$check2 = 0;
$countTone = count($_SESSION['tone']);
for($i=0 ; $i<$countTone ; $i++){
  if($_SESSION['tone'][$i]['status'] == "false"){
    $strTone = ($strTone)."/-".($_SESSION['tone'][$i]['str']);
    $check++;
  }
  else if($_SESSION['tone'][$i]['status'] == "halfTrue"){
    $strTone = ($strTone)."/-".($_SESSION['tone'][$i]['str']);
    $check2++;
  }
}
if($check2 != 0 && $check == 0){
  $pan['prosody']['tone']['str'] = $strTone;
  $pan['prosody']['tone']['status'] = "haftTrue";
}
else if($check != 0){
  $pan['prosody']['tone']['str'] = $strTone;
  $pan['prosody']['tone']['status'] = "false";
}
else if($check2 == 0 && $check == 0){
  $pan['prosody']['tone']['str'] = "/-เสียงพยางค์ท้ายวรรคถูกต้องทุกวรรค";
  $pan['prosody']['tone']['status'] = "true";
}


$strExternal = "";
$strExternal2 = "";
$countExternal = count($_SESSION['ExternalRhyme']);
for($i=0 ; $i<=8 ; $i++){
  if($_SESSION['ExternalRhyme'][$i]['status'] == "false"){
    $strExternal = ($strExternal)."/-".($_SESSION['ExternalRhyme'][$i]['str']);
  }
  else {
    $strExternal2 = "/-มีสัมผัสนอกครบ";
  }
}
if($strExternal != ""){
  $pan['prosody']['external']['str'] = $strExternal;
  $pan['prosody']['external']['status'] = "false";
}
else if($strExternal2 == ""){
  $pan['prosody']['external']['str'] = $strExternal;
  $pan['prosody']['external']['status'] = "false";
}
else if($strExternal == "" && $strExternal2 != ""){
  $pan['prosody']['external']['str'] = $strExternal2;
  $pan['prosody']['external']['status'] = "true";
}


$strDup = "";
$strDup2 = "";
$check = 0;
$countDup = count($_SESSION['DupRhyme']);
//echo $countDup."<br>";
for($i=0 ; $i<$countDup ; $i++){
  if($_SESSION['DupRhyme'][$i]['status'] == "false"){
    $strDup = ($strDup)."/-".($_SESSION['DupRhyme'][$i]['str']);
    $check++;
  }
  else if($_SESSION['DupRhyme'][$i]['status'] == "veryFalse"){
    $strDup2 = "-ไม่พบสัมซ้ำ";
  }
}
if($check != 0 && $strDup2 == ""){
  $pan['prosody']['dup']['str'] = $strDup;
  $pan['prosody']['dup']['status'] = "false";
}
else if($check == 0 && $strDup2 != ""){
  $pan['prosody']['dup']['str'] = $strDup2;
  $pan['prosody']['dup']['status'] = "false";
}
else if($check != 0 && $strDup2 != ""){
  $pan['prosody']['dup']['str'] = $strDup."-และมีบางวรรคที่มีจำนวนพยางค์ไม่ถูกต้อง";
  $pan['prosody']['dup']['status'] = "false";
}
else {
  $pan['prosody']['dup']['str'] = "/-ไม่พบสัมผัสซ้ำ";
  $pan['prosody']['dup']['status'] = "true";
}



/// ส่วนความไพเราะ
$strTone = "";
$countTone = count($_SESSION['tone']);
$check = 0;
for($i=0 ; $i<$countTone ; $i++){
  if($_SESSION['tone'][$i]['status'] == "trueGood"){
    $strTone = ($strTone)."/-".($_SESSION['tone'][$i]['str']);
    $check++;
  }
  else {
    $strTone2 = "ไม่มีความไพเราะในเรื่องเสียงพยางค์ท้ายวรรค";
  }
}
if(($check != 0)){
  $pan['melody']['toneMelody']['str'] = $strTone;
  $pan['melody']['toneMelody']['status'] = $check;
}
else if(($strTone2 != "ไม่มีความไพเราะในเรื่องเสียงพยางค์ท้ายวรรค") && ($check==0)){
  $pan['melody']['toneMelody']['str'] = "/-เสียงพยางค์ท้ายวรรคถูกต้องทุกวรรค แต่ยังไม่ใช่เสียงที่นิยมที่สุด";
  $pan['melody']['toneMelody']['status'] = 0;
}
else {
  $pan['melody']['toneMelody']['str'] = "/-ไม่มีความไพเราะในเรื่องเสียงพยางค์ท้ายวรรค";
  $pan['melody']['toneMelody']['status'] = 0;
}


$strChing = "";
$strChing2 = "";
$check = 0;
$countChing = count($_SESSION['ChingRhyme']);
for($i=0 ; $i<$countChing ; $i++){
  if($_SESSION['ChingRhyme'][$i]['status'] == "false"){
    $strChing = ($stChing)."/-".($_SESSION['ChingRhyme'][$i]['str']);
    $check++;
  }
  else if($_SESSION['ChingRhyme'][$i]['status'] == "veryFalse"){
    $strChing2 = "-ไม่พบชิงสัมผัส";
  }
}
if($check != 0 && $strChing2 == ""){
  $pan['prosody']['ching']['str'] = $strChing;
  $pan['prosody']['ching']['status'] = "false";
}
else if($check == 0 && $strChing2 != ""){
  $pan['prosody']['ching']['str'] = $strChing2;
  $pan['prosody']['ching']['status'] = "false";
}
else if($check != 0 && $strChing2 != ""){
  $pan['prosody']['ching']['str'] = $strChing."-และมีบางวรรคที่มีจำนวนพยางค์ไม่ถูกต้อง";
  $pan['prosody']['ching']['status'] = "false";
}
else {
  $pan['prosody']['ching']['str'] = "/-ไม่พบชิงสัมผัส";
  $pan['prosody']['ching']['status'] = "true";
}

$strInternal = "";
$check = 0;
$countInternal = count($_SESSION['InternalRhyme']);
for($i=0 ; $i<$countInternal ; $i++){
  if($_SESSION['InternalRhyme'][$i]['status'] == "true"){
    $strInternal = ($strInternal)."/-".($_SESSION['InternalRhyme'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $strInternal = $strInternal." /-พบสัมผัสในทั้งสิ้น ".$_SESSION['InternalRhyme']['count']." ตำแหน่ง";
  $pan['melody']['internal']['str'] = $strInternal;
  $pan['melody']['internal']['status'] = $_SESSION['InternalRhyme']['count'];
}
else {
  $pan['melody']['internal']['str'] = "/-ไม่พบตำแหน่งสัมผัสใน";
  $pan['melody']['internal']['status'] = 0;
}


//echo $strInternal;
$strVague = "";
$strVague2 = "";
$check = 0;
$countVague = count($_SESSION['VagueRhyme']);
for($i=1 ; $i<=7 ; $i++){
  if($_SESSION['VagueRhyme'][$i]['status'] == "false"){
    $strVague = ($strVague)."/-".($_SESSION['VagueRhyme'][$i]['str']);
    $check++;
  }
  else if($_SESSION['VagueRhyme'][$i]['status'] == "veryFalse"){
    $strVague2 = "ไม่พบสัมผัสเลือน";
  }
}
if($check != 0 && ($strVague2 == "")){
  $pan['melody']['vague']['str'] = $strVague;
  $pan['melody']['vague']['status'] = "false";
}
else if(($check == 0) && ($strVague2 != "")){
  $pan['melody']['vague']['str'] = "/-ไม่พบตำแหน่งสัมผัสเลือน";
  $pan['melody']['vague']['status'] = "false";
}
else {
  $pan['melody']['vague']['str'] = "/-ไม่พบสัมผัสเลือน";
  $pan['melody']['vague']['status'] = "true";
}


$strBadWord = "/-พบคำหยาบคายคำว่า";
$check = 0;
$check2 = 0;
$countBadWord = count($_SESSION['BadWord']);
//echo $countBadWord."<br>";
for($i=0 ; $i<$countBadWord ; $i++){
  if($_SESSION['BadWord'][$i]['status'] == "false"){
    $strBadWord = ($strBadWord).($_SESSION['BadWord'][$i]['str']);
    $check++;
  }
  else if($_SESSION['BadWord'][$i]['status'] == "veryFalse"){
    $check2++;
  }
}
if($check != 0 && $check2 == 0){
  $pan['melody']['badWord']['str'] = $strBadWord;
  $pan['melody']['badWord']['status'] = $_SESSION['BadWord']['count'];
}
else if($check == 0 && $check2 != 0){
  $pan['melody']['badWord']['str'] = "/-ไม่พบคำหยาบคาย";
  $pan['melody']['badWord']['status'] = -1;
}
else {
  $pan['melody']['badWord']['str'] = "/-ไม่พบคำหยาบคาย";
  $pan['melody']['badWord']['status'] = 0;
}


$strSlangWord = "/-พบคำสแลงคำว่า ";
$check = 0;
$check2 = 0;
$countSlangWord = count($_SESSION['SlangWord']);
for($i=0 ; $i<$countSlangWord ; $i++){
  if($_SESSION['SlangWord'][$i]['status'] == "false"){
    $strSlangWord = ($strSlangWord).($_SESSION['SlangWord'][$i]['str']);
    $check++;
  }
  else if($_SESSION['SlangWord'][$i]['status'] == "veryFalse"){
    $check2++;
  }
}
if($check != 0 && $check2 == 0){
  $pan['melody']['slangWord']['str'] = $strSlangWord;
  $pan['melody']['slangWord']['status'] = $_SESSION['SlangWord']['count'];
}
else if($check == 0 && $check2 != 0){
  $pan['melody']['slangWord']['str'] = "/-ไม่พบคำสแลง";
  $pan['melody']['slangWord']['status'] = -1;
}
else {
  $pan['melody']['slangWord']['str'] = "/-ไม่พบคำสแลง";
  $pan['melody']['slangWord']['status'] = 0;
}
//echo "<pre>";
//print_r ($pan);
//echo "<br><br>";
$panjson = json_encode($pan);
//$de = json_decode($panjson,true);
//print_r($de)
print_r($panjson);


?>
