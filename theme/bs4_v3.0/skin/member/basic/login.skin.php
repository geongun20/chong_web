<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/asset/login/css/style.css">

    <div class="container">
	    <div class="section-header page">	
				<h3><?php echo $g5['title'] ?></h3>
			</div>
      <div class="card card-container">
      <img class="profile-img-card mb-4" src="<?php echo G5_THEME_URL ?>/img/login_circle.png" alt="" />
        <i class="fa fa-lock fa-5x"></i>
        <p id="profile-name" class="profile-name-card"></p>
				<form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post" class="form-signin">
					<input type="hidden" name="url" value="<?php echo $login_url ?>">
					
          <span id="reauth-email" class="reauth-email"></span>
          <!-- <input type="text" name="mb_id" id="inputEmail" class="form-control" placeholder="회원 ID" required autofocus> -->
          <div class="group long">
			    <input type="text" name="mb_id" id="inputEmail" placeholder="회원 ID" required>
			    <span class="highlight"></span>
			    <span class="bar"></span>
			   <!-- <label>회원 ID를 입력하세요.</label> -->
			</div>
			<div class="group long">
			    <input type="password" name="mb_password" id="inputPassword" placeholder="비밀번호" required>
			    <span class="highlight"></span>
			    <span class="bar"></span>
			    <!-- <label>비밀번호를 입력하세요.</label> -->
			</div>
          <!-- <input type="password" name="mb_password" id="inputPassword" class="form-control" placeholder="비밀번호" required> -->
          <div id="remember" class="checkbox">
            <label>
            	<input type="checkbox" name="auto_login"  id="login_auto_login" value="자동 로그인"> 자동 로그인
            </label>
          </div>
          <button class="btn btn-lg btn-secondary btn-block btn-signin" type="submit">로그인</button>

				<?php
				// 소셜로그인 사용시 소셜로그인 버튼
				@include_once(get_social_skin_path().'/social_login.skin.php');
    			?>
    			<div class="info">
						<a href="<?php echo G5_BBS_URL ?>/password_lost.php" target="_blank" class="forgot-password">
              아이디 비밀번호 찾기
            </a>
            <span> / </span>
						<a href="./register.php" target="_blank" class="forgot-password">
               회원 가입
            </a>
    			</div>
        </form><!-- /form -->
      </div><!-- /card-container -->
    </div><!-- /container -->
        
		<script>
			$(function(){
				$("#login_auto_login").click(function(){
        	if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        	}
    		});
			});

			function flogin_submit(f)
				{
				return true;
				}
		</script>
		<!-- } 로그인 끝 -->

		<script src="<?php echo G5_THEME_URL ?>/assets/login/js/scripts.js"></script>