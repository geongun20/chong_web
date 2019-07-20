<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<link rel="stylesheet" href="<?php echo $content_skin_url ?>/style.css">
<link rel="stylesheet" href="<?php echo G5_URL ?>/assets/login/css/regist-form.css">

<!-- 회원가입약관 동의 시작 { -->
<div class="container py-3 mb-4">
	<div class="regist-form">
	<div class="section-header page">
        <h3>회원 가입</h3>
    </div>
    
    <?php
    // 소셜로그인 사용시 소셜로그인 버튼
    @include_once(get_social_skin_path().'/social_register.skin.php');
    ?>

    <form  name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">

    <p><i class="fa fa-exclamation-circle" aria-hidden="true"></i> 회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.</p>

		<div class="form-check">
			<input type="checkbox" class="form-check-input" name="chk_all" value="1" id="chk_all">
			<label for="chk_all">전체 선택</label>
		</div>
    <section id="fregister_term">
        <p class="regist-title"><i class="fa fa-check-square-o" aria-hidden="true"></i> 회원가입약관</p>
		<div class="form-group">
			<textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo get_text($config['cf_stipulation']) ?></textarea>
		</div>
		<div class="form-check">
			<input type="checkbox" class="form-check-input" name="agree" value="1" id="exampleCheck1">
			<label for="exampleCheck1">회원가입약관의 내용에 동의합니다.</label>
		</div>
    </section>

    <section id="fregister_private">
        <p class="regist-title"><i class="fa fa-check-square-o" aria-hidden="true"></i> 개인정보처리방침안내</p>
        <div>
            <table class="table table-bordered">
                <caption>개인정보처리방침안내</caption>
                <thead>
                <tr>
                    <th scope="col">목적</th>
                    <th scope="col">항목</th>
                    <th scope="col">보유기간</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>이용자 식별 및 본인여부 확인</td>
                    <td>아이디, 이름, 비밀번호</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
                <tr>
                    <td>고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별</td>
                    <td>연락처 (이메일, 휴대전화번호)</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
                </tbody>
            </table>
        </div>

		<div class="form-check">
			<input type="checkbox" class="form-check-input" name="agree2" value="1" id="agree21">
			<label for="agree21">개인정보처리방침안내의 내용에 동의합니다.</label>
		</div>
    </section>

    <div class="btn_confirm btn_box">
        <input type="submit" class="btn btn-secondary" value="회원가입">
    </div>

    </form>

    <script>
    function fregister_submit(f)
    {
        if (!f.agree.checked) {
            alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree.focus();
            return false;
        }

        if (!f.agree2.checked) {
            alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
            f.agree2.focus();
            return false;
        }

        return true;
    }
    
    jQuery(function($){
        // 모두선택
        $("input[name=chk_all]").click(function() {
            if ($(this).prop('checked')) {
                $("input[name^=agree]").prop('checked', true);
            } else {
                $("input[name^=agree]").prop("checked", false);
            }
        });
    });

    </script>
	</div>
</div>
<!-- } 회원가입 약관 동의 끝 -->
