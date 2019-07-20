<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$delete_str = "";
if ($w == 'x') $delete_str = "댓";
if ($w == 'u') $g5['title'] = $delete_str."글 수정";
else if ($w == 'd' || $w == 'x') $g5['title'] = $delete_str."글 삭제";
else $g5['title'] = $g5['title'];
?>

<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/asset/login/css/style.css">

<!-- 비밀번호 확인 시작 { -->
<div class="container">
	<div class="section-header page">	
		<h3><?php echo $g5['title'] ?></h3>
	</div>
  <div class="card card-container">
		<i class="fa fa-lock fa-5x"></i>
		<p id="profile-name" class="profile-name-card"></p>	        

    <?php if ($w == 'u') { ?>
    	<p><strong>작성자만 글을 수정할 수 있습니다.</strong></p>
      <p>작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 수정할 수 있습니다.</p>
      <?php } else if ($w == 'd' || $w == 'x') {  ?>
				<p><strong>작성자만 글을 삭제할 수 있습니다.</strong></p>
        <p>작성자 본인이라면, 글 작성시 입력한 비밀번호를 입력하여 글을 삭제할 수 있습니다.</p>
      <?php } else {  ?>
				<p><strong>비밀글 기능으로 보호된 글입니다.</strong>
        <p>작성자와 관리자만 열람하실 수 있습니다.<br> 본인이라면 비밀번호를 입력하세요.</p>
      <?php }  ?>

    <form name="fboardpassword" action="<?php echo $action;  ?>" method="post" class="form-signin">
    	<input type="hidden" name="w" value="<?php echo $w ?>">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
			<input type="hidden" name="comment_id" value="<?php echo $comment_id ?>">
			<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
			<input type="hidden" name="stx" value="<?php echo $stx ?>">
			<input type="hidden" name="page" value="<?php echo $page ?>">

			<fieldset>
        <label for="pw_wr_password" class="sound_only">비밀번호<strong>필수</strong></label>
        <input type="password" name="wr_password" id="password_wr_password" required class="form-control frm_input required" size="15" maxLength="20" placeholder="비밀번호">
        <input type="submit" value="확인" id="btn_submit" class="btn btn-lg btn-primary btn-block btn-signin">
			</fieldset>
    </form>

	</div>
</div>
<!-- } 비밀번호 확인 끝 -->