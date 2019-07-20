<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>

<style>
.box {text-align: center; font-size: .8rem; line-height: 1.4rem;}
.info-find {background-color:#e8e9ec; line-height: 2rem;}
.info-find a {color: #666; text-decoration: none;}
.member-regist {background-color: #6c757d; line-height: 2rem;}
.member-regist a {color: #fff; text-decoration: none;}

</style>

<!-- 로그인 전 아웃로그인 시작 { -->
<section id="ol_before" class="ol mt-4">
	<div class="container box">
    <h2>회원로그인</h2>
    <form name="foutlogin" action="<?php echo $outlogin_action_url ?>" onsubmit="return fhead_submit(this);" method="post" autocomplete="off">
	    <div class="top">
	        <input type="hidden" name="url" value="<?php echo $outlogin_url ?>">
	        
	        <!-- <div class="form-group ol"> -->
	        <div class="group-out form-signin-out short">
        			<input type="text" name="mb_id" id="inputEmail-out" required maxlength="20" placeholder="아이디">
        			<span class="highlight"></span>
				<span class="bar"></span>
				<!-- <label>아이디를 입력하세요.</label> -->
	        </div>
			<!-- </div> -->
	        <!-- <div class="form-group ol"> -->
	        <div class="group-out form-signin-out">
	        		<input type="password" name="mb_password" id="inputPassword-out" required maxlength="20" placeholder="비밀번호">
		        		<span class="highlight"></span>
				    <span class="bar"></span>
				    <!-- <label>비밀번호를 입력하세요.</label> -->
	        </div>
	        <!-- </div> -->
	        
	        <div class="form-group mt-4">     
				<input type="submit" value="로그인" class="btn btn-secondary">
	    	</div>
	
	        <div> 
	            <input type="checkbox" name="auto_login" value="1" id="auto_login">
	            <label for="auto_login" id="auto_login_label">자동로그인</label>
	        </div>
	    </div>

        <div class="row">
            <div class="col-6 text-center info-find">
            	<a href="<?php echo G5_BBS_URL ?>/password_lost.php" id="ol_password_lost">정보찾기</a>
            </div>
            <div class="col-6 text-center member-regist">
            	<a href="<?php echo G5_BBS_URL ?>/register.php"><b>회원가입</b></a>
            </div>
        </div>

        <?php
        // 소셜로그인 사용시 소셜로그인 버튼
        @include_once(get_social_skin_path().'/social_outlogin.skin.1.php');
        ?>
    </form>
	</div>
</section>

<script>
$omi = $('#ol_id');
$omp = $('#ol_pw');
$omi_label = $('#ol_idlabel');
$omi_label.addClass('ol_idlabel');
$omp_label = $('#ol_pwlabel');
$omp_label.addClass('ol_pwlabel');

$(function() {

    $("#auto_login").click(function(){
        if ($(this).is(":checked")) {
            if(!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                return false;
        }
    });
});

function fhead_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 전 아웃로그인 끝 -->
