<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/asset/login/css/style.css">

<!-- 회원정보 찾기 시작 { -->
<div class="container">
	<div class="section-header page">	
		<h3><?php echo $g5['title'] ?></h3>
	</div>
	<div class="card card-container password-container">
		<i class="fa fa-lock fa-5x"></i>
    <p id="profile-name" class="profile-name-card"></p>
    
    <form name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
      <fieldset id="info_fs">
        <p>회원가입 시 등록하신 이메일 주소를 입력해 주세요.</p>
        <p>해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.</p>
        <label for="mb_email" class="sound_only">E-mail 주소<strong class="sound_only">필수</strong></label>
        <input type="text" name="mb_email" id="mb_email" required class="form-control required frm_input full_input email" size="30" placeholder="E-mail 주소">     
      </fieldset>
      
      <div class="text-center mt-4">
	      <div style="display:inline-block !important;">
	        <?php echo captcha_html();  ?>
	      </div>
      </div>
      
      <div class="text-center mt-4">
        <input type="submit" value="확인" class="btn btn-block btn-primary">
      </div>
 
			<div class="text-center mt-4">
				<button type="button" onclick="window.close();" class="btn btn-secondary btn-signin">창닫기</button>
			</div>
    </form>
	</div>
</div>

<script>
function fpasswordlost_submit(f)
{
    <?php echo chk_captcha_js();  ?>

    return true;
}

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>
<!-- } 회원정보 찾기 끝 -->