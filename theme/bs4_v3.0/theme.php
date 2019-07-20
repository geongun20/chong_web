<?php
include_once('_common.php');

//if ($is_admin != 'super')
//    alert('최고관리자만 접근 가능합니다.');
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Bootstrap 4 Template with Gnuboard 3">
<meta name="author" content="No Hoon Park">

<?php
    echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">'.PHP_EOL;
?>

<link rel="stylesheet" href="css/default.css">

<!-- Bootstrap core CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">

<?php include_once(G5_THEME_PATH.'/head.php'); ?>
</head>

<body>
	
<?php
/*
$sql = " select cf_1_subj, cf_2_subj, cf_1, cf_2 from `{$g5['config_table']}` ";
//$sql = " select * from `{$g5['config_table']}` ";
$result = sql_query($sql);
$row = sql_fetch_array($result);
//echo $row['cf_new_skin'];
*/
$action = '';
if (isset($_POST['action']))$action = $_POST['action'];

// 폼이 입력되었을 때 처리부
if ($action == 'form_submit') {
	$cf_1_subj = "메인 사이드";
	$cf_2_subj = "게시판, 페이지 사이드";
	$cf_3_subj = "사이드 위치";
	$cf_4_subj = "초기 화면 상단";
	$sql = " update `{$g5['config_table']}`
				  set cf_1_subj = '$cf_1_subj',
						cf_2_subj = '$cf_2_subj',
						cf_3_subj = '$cf_3_subj',
						cf_4_subj = '$cf_4_subj',
						cf_1 = '$cf_1',
						cf_2 = '$cf_2',
						cf_3 = '$cf_3',
						cf_4 = '$cf_4' ";
						
	sql_query($sql);

goto_url(G5_URL);
exit(); 
}
?>

<div class="container pb-5">
	<div class="section-header page mt-4">	
	<h3><?php echo "테마 설정" ?></h3>
	</div>
	
	<form method="post"  action="<?=$_SERVER['PHP_SELF']?>">
		<input type="hidden" name="action" value="form_submit" />
		
		<div class="row mt-5 mb-4">
			<div class="col-6 font-weight-bold text-right">
				1. 메인 사이드 설정
			</div>
			<div class="col-6">
				<input type="radio" name="cf_1" id="cf_1" value="" <?php if( $config['cf_1'] == "")  echo "checked"; ?>> 없음</span>
				<span class="pl-2"><input type="radio" name="cf_1" value="1" <?php if( $config['cf_1'] == "1")  echo "checked"; ?> onclick="show()"> 있음</span>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-6 font-weight-bold text-right">
				2. 게시판, 페이지 사이드 설정
			</div>
			<div class="col-6">
				<input type="radio" name="cf_2" id="cf_2" value="" <?php if( $config['cf_2'] == "")  echo "checked" ?>> 없음</span>
				<span class="pl-2"><input type="radio" name="cf_2" value="1" <?php if( $config['cf_2'] == "1")  echo "checked"; ?> onclick="show()"> 있음</span>
			</div>
		</div>
				
		<div class="row mb-4" id="side-location">
			<div class="col-6 font-weight-bold text-right">
				3. 사이드 위치
			</div>
			<div class="col-6">
				<input type="radio" name="cf_3" value="" <?php if( $config['cf_3'] == "")  echo "checked"; ?>> 왼쪽
				<span class="pl-2"><input type="radio" name="cf_3" value="1" <?php if( $config['cf_3'] == "1")  echo "checked"; ?>> 오른쪽</span>
			</div>
		</div>
		
		<div class="row mb-4">
			<div class="col-6 font-weight-bold text-right">
				<span id="num"></span> . 메인 화면 상단 설정
			</div>
			<div class="col-6">
				<input type="radio" name="cf_4" value="" <?php if( $config['cf_4'] == "")  echo "checked"; ?>> 슬라이드
				<span class="pl-2"><input type="radio" name="cf_4" value="1" <?php if( $config['cf_4'] == "1")  echo "checked"; ?>> 와이드 이미지</span>
				<span class="pl-2"><input type="radio" name="cf_4" value="2" <?php if( $config['cf_4'] == "2")  echo "checked"; ?>> 패럴렉스 이미지</span>
			</div>
		</div>
				
		<div class="text-center mb-5 mt-5">
			<button type="submit" id="btn_submit" class="btn btn-raised btn-primary btn-sm"">작성완료</button>
			<div class="btn btn-raised btn-secondary btn-sm" onclick="history.go(-1)">취소</div>
		</div>
	</form>
</div>
		
<!-- Bootstrap core JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<?php
include_once(G5_THEME_PATH.'/tail.php');
?>

<script>	
$(function(){
	$('#cf_1').change(function(){
		if($("#cf_1").is(":checked") && $("#cf_2").is(":checked")){
		hide();
		}
	});
	$('#cf_2').change(function(){
		if($("#cf_1").is(":checked") && $("#cf_2").is(":checked")){
		hide();
		}
	});
});

function show() {
	$('#side-location').show();
	document.getElementById("num").innerHTML = "4";
}

function hide() {
	$('#side-location').hide();
	document.getElementById("num").innerHTML = "3";
}
</script>

<?php if( $config['cf_1'] == "" && $config['cf_2'] == "") {
	echo ("<script language='javascript'>hide();</script>");
} else {
	echo ("<script language='javascript'>show();</script>");
}
?>

</body>
</html>
