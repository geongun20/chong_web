<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/asset/login/css/style.css">

<!-- 회원 비밀번호 확인 시작 { -->
<div class="container">
	<div class="section-header page">	
		<h3><?php echo $g5['title'] ?></h3>
	</div>
	<div class="card card-container">
		<i class="fa fa-lock fa-5x"></i>
    <p id="profile-name" class="profile-name-card"></p>
    <p>
        <strong>비밀번호를 한번 더 입력해주세요.</strong>
        <?php if ($url == 'member_leave.php') { ?>
        <p>비밀번호를 입력하시면 회원탈퇴가 완료됩니다.</p>
        <?php }else{ ?>
        <p>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.</p>
        <?php }  ?>
    </p>

    <form name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post" class="form-signin">
    	<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
			<input type="hidden" name="w" value="u">

			<fieldset>
        <p><span class="confirm_id">회원아이디:</span>
        <span id="mb_confirm_id"> <?php echo $member['mb_id'] ?></span></p>
        <label for="confirm_mb_password" class="sound_only">비밀번호<strong>필수</strong></label>
        <input type="password" name="mb_password" id="confirm_mb_password" required class="form-control required frm_input mb-4" size="15" maxLength="20" placeholder="비밀번호">
        <input type="submit" value="확인" id="btn_submit" class="btn btn-lg btn-primary btn-block btn-signin">
    	</fieldset>

    </form>
	</div>
</div>

<script>
function fmemberconfirm_submit(f)
{
  document.getElementById("btn_submit").disabled = true;

  return true;
}
</script>
<!-- } 회원 비밀번호 확인 끝 -->