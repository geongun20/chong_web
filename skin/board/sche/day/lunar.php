<?php // 음력 절기 파일, 기념일 추가시 else if 구문 복사해서 사용하세요. 한자리 날짜는 한자리로 써야 합니다. 
if ($myarray['month'].'/'.$myarray['day']=="1/15") {
	$annivmoonday="<font color=\"blue\">대보름</font>";
} elseif ($myarray['month'].'/'.$myarray['day']=="12/30") {
	$annivmoonday="<font color=\"red\">설연휴</font>";
	$daycolor="red";
} elseif ($myarray['month'].'/'.$myarray['day']=="1/1") {
	$annivmoonday="<img src=\"{$board_skin_url}/img/bull_26.gif\" align=\"absmiddle\"><font color=\"red\">설날</font>";
	$daycolor="red";
} elseif ($myarray['month'].'/'.$myarray['day']=="1/2") {
	$annivmoonday="<font color=\"red\">설연휴</font>";
	$daycolor="red";
} elseif ($myarray['month'].'/'.$myarray['day']=="4/8") {
	$annivmoonday="<font color=\"red\">석가탄신일</font>";
	$daycolor="red";
} elseif ($myarray['month'].'/'.$myarray['day']=="5/5")  {
	$annivmoonday="<font color=\"#0000ff\">단오</font>";
} elseif ($myarray['month'].'/'.$myarray['day']=="8/14") {
	$annivmoonday="<font color=\"red\">추석연휴</font>";
	$daycolor="red";
} elseif ($myarray['month'].'/'.$myarray['day']=="8/15") {
	$annivmoonday="<img src=\"{$board_skin_url}/img/bull_26.gif\" align=\"absmiddle\"><font color=\"red\">추석</font>";
	$daycolor="red";
} elseif ($myarray['month'].'/'.$myarray['day']=="8/16") {
	$annivmoonday="<font color=\"red\">추석연휴</font>";
	$daycolor="red";
} else { 
	$annivmoonday="" ;
}
?>