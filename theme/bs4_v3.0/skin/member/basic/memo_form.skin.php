<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div class="section-header page">	
<h3><?php echo $g5['title'] ?></h3>
</div>

<!-- 쪽지 보내기 시작 { -->
<div id="memo_write" class="new_win">
  <div class="row">
	  <div class="col-md-12 text-center mb-4">
      <a href="./memo.php?kind=recv">받은쪽지 /</a>
      <a href="./memo.php?kind=send">보낸쪽지 /</a>
      <span class="selected"><a href="./memo_form.php">쪽지쓰기</a></span>
    </div>
  </div>

        <form name="fmemoform" action="<?php echo $memo_action_url; ?>" onsubmit="return fmemoform_submit(this);" method="post" autocomplete="off">
        	<div class="form-group">
            <h2 class="sound_only">쪽지쓰기</h2>
            <label for="me_recv_mb_id" class="sound_only">받는 회원아이디<strong>필수</strong></label>
            <input type="text" class="form-control" name="me_recv_mb_id" value="<?php echo $me_recv_mb_id ?>" id="me_recv_mb_id" required class="frm_input full_input required" size="47" placeholder="받는 회원아이디">
            <soan class="form-text text-muted">여러 회원에게 보낼때는 컴마(,)로 구분하세요.</span>
            <?php if ($config['cf_memo_send_point']) { ?>
              <span class="form-text text-muted">쪽지 보낼때 회원당 <?php echo number_format($config['cf_memo_send_point']); ?>점의 포인트를 차감합니다.</span>
            <?php } ?>
        	</div>
        	
          <div class="form-group mt-4 mb-4">
            <label for="me_memo" class="sound_only">내용</label>
              <textarea name="me_memo" class="form-control" id="me_memo" required class="required"><?php echo $content ?></textarea>
          </div>
                    
          <div class="text-center">
            <span class="sound_only">자동등록방지</span>     
            <?php echo captcha_html(); ?>
          </div>
	
					<div class="text-center mb-4 mt-4">
          	<input type="submit" value="보내기" id="btn_submit" class="btn btn-raised btn-primary btn-sm">
						<button type="button" onclick="window.close();" class="btn btn-raised btn-secondary btn-sm">창닫기</button>
        	</div>
    		</form>
</div>

<script>
function fmemoform_submit(f)
{
    <?php echo chk_captcha_js();  ?>

    return true;
}
</script>
<!-- } 쪽지 보내기 끝 -->