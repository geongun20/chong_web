<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

include_once($board_skin_path."/moonday.php"); // 석봉운님의 음력날짜 함수

if(stristr($width, '%') === FALSE) {
	$col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
} else{
	$col_width = ($width/7)."%"; //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
}
//echo "col_width=".$col_width."<br>";

$col_height= 100;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록
$today = getdate(); 
$b_mon = $today['mon']; 
$b_day = $today['mday']; 
$b_year = $today['year']; 
if ($year < 1) { // 오늘의 달력 일때
  $month = $b_mon;
  $mday = $b_day;
  $year = $b_year;
}

if(!$year) 	$year = date("Y");
$file_index = $board_skin_path."/day"; ### 기념일 폴더 위치 지정

### 양력 기념일 파일 지정 : 해당년도 파일이 없으면 기본파일(solar.txt)을 불러온다
if(file_exists($file_index."/".$year.".txt")) {
	$dayfile = file($file_index."/".$year.".txt");
} else { 
	$dayfile = file($file_index."/solar.txt");
}

$lastday=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
if ($year%4 == 0) $lastday[2] = 29;
$dayoftheweek = date("w", mktime (0,0,0,$month,1,$year));
?>

<table width="<?php echo $width; ?>" border=0 cellpadding="0" cellspacing="0">
    <tr>
        <td width="20%">&nbsp;</td>
        <td width="60%" height="30" align="center">
            <table border="0" cellspacing="5" cellpadding="0">
                <tr>
                    <td>
                    	<a href="<?php 
							echo $_SERVER['PHP_SELF']."?bo_table={$bo_table}&";
							if ($month == 1) { 
								$year_pre=$year-1; 
								$month_pre=$month; 
							} else {
								$year_pre=$year-1; $month_pre=$month;
							} 
							echo "year={$year_pre}&month={$month_pre}&sc_no={$sc_no}";
						?>">&lt;&lt;</a>&nbsp;
                    </td>
                    <td>
                    	<a href="<?php 
							echo $_SERVER['PHP_SELF']."?bo_table={$bo_table}&";
							if ($month === 1) { 
								$year_pre  = $year-1; 
								$month_pre = 12; 
							} else {
								$year_pre  = $year; 
								$month_pre = $month-1;
							} 
							echo "year={$year_pre}&month={$month_pre}&sc_no={$sc_no}";
						?>">&lt;</a>&nbsp;
                    </td>
                    <td style="padding:0 10px;font-size:18px;font-weight:bold;">
                    	<a href="<?php 
							echo $_SERVER['PHP_SELF']."?bo_table=".$bo_table; 
						?>" title="오늘로" onfocus="this.blur()"><?php echo "{$year}년&nbsp;{$month}월"; ?></a></td>
                    <td>
                    	&nbsp;<a href="<?php 
							echo $_SERVER['PHP_SELF']."?bo_table={$bo_table}&";
							if ($month === 12) { 
								$year_pre  = $year+1; 
								$month_pre = 1; 
							} else {
								$year_pre  = $year; 
								$month_pre = $month+1;
							} 
							echo "year={$year_pre}&month={$month_pre}&sc_no={$sc_no}";
						?>">&gt;</a>
                    </td>
                    <td>
                    	&nbsp;<a href="<?php 
							echo $_SERVER['PHP_SELF']."?bo_table={$bo_table}&";
							if ($month === 12) { 
								$year_pre  = $year+1; 
								$month_pre = $month; 
							} else {
								$year_pre  = $year+1; 
								$month_pre = $month;
							} 
							echo "year={$year_pre}&month={$month_pre}&sc_no={$sc_no}";
						?>">&gt;&gt;</a>
                    </td>
                </tr>
            </table>			
        </td>
        <td width="20%" align="right">
            <?php if ($rss_href || $write_href) { ?>
            <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01 btn2">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn2"><font color="#ffffff">관리자</font></a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 btn2"><font>일정추가</font></a></li><?php } ?>
            </ul>
            <?php } ?>
        </td>
    </tr>
</table>

<div id="bo_list">
<table style="margin: 0 auto; max-width: 900px;" width="<?php echo $width?>" bgcolor="#cfcfcf" border="0" cellspacing="1" cellpadding="5">
    <thead>
        <tr bgcolor="#fdfac2" align="center">     
            <th style="color:#ff0000; width: 14%;">일</th>
            <th style="width: 14%;">월</th>
            <th style="width: 14%;">화</th>
            <th style="width: 14%;">수</th>
            <th style="width: 14%;">목</th>
            <th style="width: 14%;">금</th>
            <th style="color:#ff0000; width: 14%;">토</th>
        </tr>
    </thead>
    
    <tbody>
    <?php
    $cday = 1;
    $sel_mon = sprintf("%02d",$month);
        
    $query = "select * from {$write_table} WHERE left(wr_1,6) <= '{$year}{$sel_mon}' and left(wr_2,6) >= '{$year}{$sel_mon}' ORDER BY wr_id asc";
    $result = sql_query($query);
    $j=0; // layer id
    // 내용을 보여주는 부분
    while ($row = sql_fetch_array($result)) {  // 제목글 뽑아서 링크 문자열 만들기..
        if( substr($row['wr_1'],0,6) <  $year.$sel_mon ) {
            $start_day =1; 
            $start_day= (int)$start_day;
        } else {
            $start_day = substr($row['wr_1'],6,2);
            $start_day= (int)$start_day;
        }
    
        if( substr($row['wr_2'],0,6) >  $year.$sel_mon ) {
            $end_day = $lastday[$month];
            $end_day= (int)$end_day;
        } else {
            $end_day = substr($row['wr_2'],6,2);
            $end_day= (int)$end_day;
        }
    
        // 아이디에 따라 다른 아이콘이미지 출력 하고 싶을때 ///주석을 해제
        $imgown = 'icon';
        
        for ($i = $start_day ; $i <= $end_day;  $i++) {
            if (strlen($row['wr_3']) > 0) {  // 입력된 아이콘 값이 있을 때
                $imgown = $row['wr_3'] ;
            }
    
			$j++; // layer ID
			
			$list['comment_cnt'] = " ".$row['wr_comment']; // row에 대하여 코멘트 카운터 정의
			if($row['wr_comment'] == 0) {
				$list['comment_cnt'] = null ;
			} else {
				if($list['comment_cnt']!=null) $list['comment_cnt'] = "<b><font color=\"#ff6600\">{$list['comment_cnt']}</font></b>"; 
			}
			
			$row['wr_subject'] = cut_str(get_text($row['wr_subject']),$board['bo_subject_len'],"…"); // subject length cut
			
			$list['icon_new'] = '';
			if ($row['wr_datetime'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - ($board['bo_new'] * 3600)))
				$list['icon_new'] = " <img src=\"{$board_skin_url}/img/icon_new.gif\" align=\"absmiddle\" alt=\"새글\">";
			
			if ($member['mb_level'] < $board['bo_read_level']) {
				$showLayer="" ;
			} else { 
				$showLayer=" onmouseover=\"PopupShow('{$j}')\" onmouseout=\"PopupHide('{$j}')\" ";
			}
			$html_day[$i].= "<br /><a href=\"".G5_BBS_URL."/board.php?bo_table={$bo_table}&year={$year}&month={$month}&wr_id={$row['wr_id']}&sc_no={$sc_no}\" id=\"subject_{$j}\" {$showLayer}>{$row['wr_subject']}</a>".$list['icon_new'].$list['comment_cnt'];
			?>
			<!-- 뷰 팝업레이어 -->
			<div id="popup_<?php echo $j?>" class="popup_layer"> 
				<?php
				$html = 0;
				if (strstr($row['wr_option'], "html1"))
					$html = 1;
				else if (strstr($row['wr_option'], "html2"))
					$html = 2;
				
				$viewlist = cut_str(conv_content($row['wr_content'], $html),200,"…");
				echo $viewlist;
				?>
			</div>
			<?php
				//오늘 스케줄 구하기
				if ($row['wr_id'] != $sc_id && date('Ymd', strtotime($row['wr_1'])) <= date('Ymd') && date('Ymd', strtotime($row['wr_2'])) >= date('Ymd')) {
					$today_schedule .= "<p>";
					$today_schedule .= " <a href=\"".G5_BBS_URL."/board.php?bo_table={$bo_table}&year={$year}&month={$month}&wr_id={$row['wr_id']}&sc_no={$sc_no}\"><b>{$row['wr_subject']}</b></a>";
					$today_schedule .= " (".substr($row['wr_1'],4,2)."/".substr($row['wr_1'],6,2)." ~ ".substr($row['wr_2'],4,2)."/".substr($row['wr_2'],6,2).")<br />";
					$today_schedule .= $viewlist."</p>";
				}		
				$sc_id = $row['wr_id'];
			}
		}
    
		// 달력의 틀을 보여주는 부분
		$temp = 7- (($lastday[$month]+$dayoftheweek)%7);
		
		if ($temp == 7) $temp = 0;
			$lastcount = $lastday[$month]+$dayoftheweek + $temp;
    
		for ($iz = 1; $iz <= $lastcount; $iz++) { // 42번을 칠하게 된다.
			$bgcolor = "#ffffff";  // 쭉 흰색으로 칠하고
			if ($b_year==$year && $b_mon==$month && $b_day==$cday) $bgcolor = "#DEFADE";      //  "#DFFDDF"; // 오늘날짜 연두색으로 표기
			if (($iz%7) == 1) echo ("        <tr>\n"); // 주당 7개씩 한쎌씩을 쌓는다.
			if ($dayoftheweek < $iz  &&  $iz <= $lastday[$month]+$dayoftheweek)	{
			
			// 전체 루프안에서 숫자가 들어가는 셀들만 해당됨
			// 즉 11월 달에서 1일부터 30 일까지만 해당
			$daytext = $cday;   // $cday 는 숫자 예> 11월달은 1~ 30일 까지
			//$daytext 은 셀에 써질 날짜 숫자 넣을 공간
			$daycontcolor = "" ; 
			$daycolor = ""; 
			if ($iz%7 == 1) $daycolor = "#ff0000"; // 일요일
			if ($iz%7 == 0) $daycolor = "#0000ff"; // 토요일
			
			// 여기까지 숫자와 들어갈 내용에 대한 변수들의 세팅이 끝나고 
			// 이제 여기 부터 직접 셀이 그려지면서 그 안에 내용이 들어 간다.
			echo ("            <td height=\"{$col_height}\" bgcolor=\"{$bgcolor}\" valign=\"top\">");
			
			$f_date = $year.sprintf("%02d",$month).sprintf("%02d",$cday);
			
			// 기념일 파일 내용 비교위한 변수 선언, 월과 일을 두자리 포맷으로 고정
			if (strlen($month) == 1) { 
				$monthp = "0".$month ;
			} else {
				$monthp = $month ; 
			}
			
			if (strlen($cday) == 1) {
				$cdayp = "0".$cday ;
			} else { 
				$cdayp = $cday ; 
			}
			
			$memday = $year.$monthp.$cdayp;
			$daycont = "" ;
			
			// 기념일(양력) 표시
			for($i=0 ; $i < sizeof($dayfile) ; $i++) {  // 파일 첫 행부터 끝행까지 루프
				$arrDay = explode("|", $dayfile[$i]);
				if($memday == $year.$arrDay[0]) {
					$daycont = $arrDay[1]; 
					$daycontcolor = $arrDay[2];
					if(substr($arrDay[2],0,3)=="red") $daycolor = "#ff0000"; // 공휴일은 날짜를 빨간색으로 표시
					if(substr($arrDay[2],0,3)=="#ff0000") $daycolor = "#ff0000"; // 공휴일은 날짜를 빨간색으로 표시
				}
			}
    
			// 석봉운님의 음력날짜 변수선언
			$myarray = soltolun($year,$month,$cday);
			
			include($file_index."/lunar.php"); ### 음력 기념일 파일 지정
			
			if ($annivmoonday&&$daycont) $blank="<br />"; // 음력절기와 양력기념일이 동시에 있으면 한칸 띔
			else $blank="";
			
			if ($write_href) { 
				// $write_href (글쓰기 권한)이 있으면
				// 날짜를 클릭하면 글씨쓰기가 가능한 링크를 넣어서 출력하기
				echo "<a href=\"{$write_href}&f_date={$f_date}\"><font color=\"{$daycolor}\" title=\"일정추가\">{$daytext}</font></a> <font color=\"{$daycontcolor}\">{$daycont}</font>{$blank} {$annivmoonday}";
			} else { // 글쓰기 권한이 없으면 글쓰기 링크는 넣지 않고 그냥 숫자와 기념일 내용만 출력하기  
				echo "<font color=\"{$daycolor}\">{$daytext}</font> <font color=\"{$daycontcolor}\">{$daycont}</font>{$blank} {$annivmoonday}";
			}
			
			echo $html_day[$cday];
			echo ("</td>\n");  // 한칸을 마무리
			$cday++; // 날짜를 카운팅
		} 
		
		// 유효날짜가 아니면 그냥 회색을 칠한다.
		else { echo ("            <td width=\"{$col_width}\" height=\"{$col_height}\" bgcolor=\"#f9fafe\" valign=\"top\">&nbsp;</td>\n"); }
		if (($iz%7) == 0) echo ("        </tr>\n");
       
    } // 반복구문이 끝남
    ?>
    </tbody>
</table>
</div>

<section id="today_schedule">
    <h3>오늘 일정</h3>
    <div><?php echo $today_schedule; ?></div>
</section>

<script language="JavaScript">
<!--
// 미리보기 팝업 보이기
function PopupShow(n) {
	var position = $("#subject_"+n).position(); 
	$("#popup_"+n).animate({left:position.left-10+"px", top:position.top+30+"px"},0);
	$("#popup_"+n).show();
}

// 미리보기 팝업 숨기기
function PopupHide(n) {
	$("#popup_"+n).hide();
}
//-->
</script>
