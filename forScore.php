<?php
require ("return2.php");
//function scoreHard($arrWak,$arrOfTone,$arrNumPayang,$arrDupRhyme,$arrExternalRhyme){
$pan = array();
$strWak = "";
$check = 0;
$countWak = count($_SESSION['numWak'])-1;
for($i=0 ; $i<$countWak ; $i++){
  if($_SESSION['numWak'][$i]['status'] == "false"){
    $strWak = ($strWak)."/".($_SESSION['numWak'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['prosody']['numWak']['str'] = $strWak;
  $pan['prosody']['numWak']['status'] = "false";
}
else {
  $pan['prosody']['numWak']['str'] = "จำนวนวรรคถูกต้อง";
  $pan['prosody']['numWak']['status'] = "true";
}
$strPayang = "";
$check = 0;
$countPayang = count($_SESSION['numPayang']);
for($i=0 ; $i<$countPayang ; $i++){
  if($_SESSION['numPayang'][$i]['status'] == "false"){
    $strPayang = ($strPayang)."/".($_SESSION['numPayang'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['prosody']['numPayang']['str'] = $strPayang;
  $pan['prosody']['numPayang']['status'] = "false";
}
else {
  $pan['prosody']['numPayang']['str'] = "จำนวนพยางค์ถูกต้อง";
  $pan['prosody']['numPayang']['status'] = "true";
}
$strTone = "";
$countTone = count($_SESSION['tone']);
for($i=0 ; $i<$countTone ; $i++){
  if($_SESSION['tone'][$i]['status'] == "false"){
    $strTone = ($strTone)."/".($_SESSION['tone'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['prosody']['tone']['str'] = $strTone;
  $pan['prosody']['tone']['status'] = "false";
}
else {
  $pan['prosody']['tone']['str'] = "เสียงพยางค์ท้ายวรรคถูกต้องทุกวรรค";
  $pan['prosody']['tone']['status'] = "true";
}
$strExternal = "";
$check = 0;
$countExternal = count($_SESSION['ExternalRhyme']);
for($i=0 ; $i<$countExternal ; $i++){
  if($_SESSION['ExternalRhyme'][$i]['status'] == "false"){
    $strExternal = ($strExternal)."/".($_SESSION['ExternalRhyme'][$i]['str']);
    $check++;
  }
  else{
    $check = 0;
  }
}
if($check != 0){
  $pan['prosody']['external']['str'] = $strExternal;
  $pan['prosody']['external']['status'] = "false";
}
else {
  $pan['prosody']['external']['str'] = "มีสัมผัสนอกครบ";
  $pan['prosody']['external']['status'] = "true";
}
$strDup = "";
$check = 0;
$countDup = count($_SESSION['DupRhyme']);
for($i=0 ; $i<$countDup ; $i++){
  if($_SESSION['DupRhyme'][$i]['status'] == "false"){
    $strDup = ($strDup)."/".($_SESSION['DupRhyme'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['prosody']['dup']['str'] = $strDup;
  $pan['prosody']['dup']['status'] = "false";
}
else {
  $pan['prosody']['dup']['str'] = "ไม่พบสัมผัสซ้ำ";
  $pan['prosody']['dup']['status'] = "true";
}
/// ส่วนความไพเราะ
$strChing = "";
$check = 0;
$countChing = count($_SESSION['ChingRhyme']);
for($i=0 ; $i<$countChing ; $i++){
  if($_SESSION['ChingRhyme'][$i]['status'] == "false"){
    $strChing = ($stChing)."/".($_SESSION['ChingRhyme'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['melody']['ching']['str'] = $strChing;
  $pan['melody']['ching']['status'] = "false";
}
else {
  $pan['melody']['ching']['str'] = "ไม่พบชิงสัมผัส";
  $pan['melody']['ching']['status'] = "true";
}
$strInternal = "";
$check = 0;
$countInternal = count($_SESSION['InternalRhyme']);
for($i=0 ; $i<$countInternal ; $i++){
  if($_SESSION['InternalRhyme'][$i]['status'] == "true"){
    $strInternal = ($strInternal)."/".($_SESSION['InternalRhyme'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $strInternal = $strInternal." พบสัมผัสในทั้งสิ้น /".$_SESSION['InternalRhyme']['count']." ตำแหน่ง";
  $pan['melody']['internal']['str'] = $strInternal;
  $pan['melody']['internal']['status'] = $_SESSION['InternalRhyme']['count'];
}
else {
  $pan['melody']['internal']['str'] = "ไม่พบตำแหน่งสัมผัสใน";
  $pan['melody']['internal']['status'] = $_SESSION['InternalRhyme']['count'];
}
//echo $strInternal;
$strVague = "";
$check = 0;
$countVague = count($_SESSION['VagueRhyme']);
for($i=0 ; $i<$countVague ; $i++){
  if($_SESSION['VagueRhyme'][$i]['status'] == "false"){
    $strVague = ($strVague)."/".($_SESSION['VagueRhyme'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['melody']['vague']['str'] = $strVague;
  $pan['melody']['vague']['status'] = "false";
}
else {
  $pan['melody']['vague']['str'] = "ไม่พบตำแหน่งสัมผัสเลือน";
  $pan['melody']['vague']['status'] = "true";
}
$strBadWord = "";
$check = 0;
$countBadWord = count($_SESSION['BadWord']);
for($i=0 ; $i<$countBadWord ; $i++){
  if($_SESSION['BadWord'][$i]['status'] == "false"){
    $strBadWord = ($strBadWord)."/".($_SESSION['BadWord'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['melody']['badWord']['str'] = $strBadWord;
  $pan['melody']['badWord']['status'] = $_SESSION['badWord']['count'];
}
else {
  $pan['melody']['badWord']['str'] = "ไม่พบคำหยาบคาย";
  $pan['melody']['badWord']['status'] = "true";
}
$strSlangWord = "";
$check = 0;
$countSlangWord = count($_SESSION['SlangWord']);
for($i=0 ; $i<$countSlangWord ; $i++){
  if($_SESSION['SlangWord'][$i]['status'] == "false"){
    $strSlangWord = ($strSlangWord)."/".($_SESSION['SlangWord'][$i]['str']);
    $check++;
  }
}
if($check != 0){
  $pan['melody']['slangWord']['str'] = $strSlangWord;
  $pan['melody']['slangWord']['status'] = $_SESSION['slangWord']['count'];
}
else {
  $pan['melody']['slangWord']['str'] = "ไม่พบคำสแลง";
  $pan['melody']['slangWord']['status'] = "true";
}
//print_r ($pan);
//echo "<br><br>";
$panjson = json_encode($pan);
print_r($panjson);


?>
