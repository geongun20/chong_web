<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
$nick = get_sideview($mb['mb_id'], $mb['mb_nick'], $mb['mb_email'], $mb['mb_homepage']);
if($kind == "recv") {
    $kind_str = "보낸";
    $kind_date = "받은";
}
else {
    $kind_str = "받는";
    $kind_date = "보낸";
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지보기 시작 { -->
<div class="section-header page">	
<h3><?php echo $g5['title'] ?></h3>
</div>

<div id="memo_view" class="new_win">
	<!-- 쪽지함 선택 시작 { -->
  <div class="row">
	  <div class="col-md-12 text-center mb-4">
      <span class="<?php if ($kind == 'recv') {  ?>selected<?php }  ?> mono"><a href="./memo.php?kind=recv">받은쪽지 /</a></span>
      <span class="<?php if ($kind == 'send') {  ?>selected<?php }  ?> mono"><a href="./memo.php?kind=send">보낸쪽지 /</a></span>
      <span class="mono"><a href="./memo_form.php">쪽지쓰기</a></span>
	  </div>
  </div>
  <!-- } 쪽지함 선택 끝 -->

  <article id="memo_view_contents">
    <header>
      <h2>쪽지 내용</h2>
    </header>
    <ul id="memo_view_ul">
      <li class="memo_view_li memo_view_name">
        <span class="memo_view_subj"><?php echo $kind_str ?>사람</span>
        <strong><?php echo $nick ?></strong>
      </li>
      <li class="memo_view_li memo_view_date">
        <span class="sound_only"><?php echo $kind_date ?>시간</span>
        <strong><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $memo['me_send_datetime'] ?></strong>
      </li>
    </ul>
    <p>
      <?php echo conv_content($memo['me_memo'], 0) ?>
    </p>
  </article>

  <div class="win_btn">
    <?php if($prev_link) {  ?>
      <a href="<?php echo $prev_link ?>" class="btn btn-raised btn-dark btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i> 이전쪽지</a>
    <?php }  ?>
    <?php if($next_link) {  ?>
      <a href="<?php echo $next_link ?>" class="btn btn-raised btn-dark btn-sm">다음쪽지 <i class="fa fa-angle-right" aria-hidden="true"></i></a>
    <?php }  ?>

    <div class="text-center mb-4 mt-4">
      <a href="<?php echo $list_link ?>" class="btn btn-raised btn-secondary btn-sm">목록</a>
      <button type="button" onclick="window.close();" class="btn btn-raised btn-secondary btn-sm">창닫기</button>
       <?php if ($kind == 'recv') {  ?><a href="./memo_form.php?me_recv_mb_id=<?php echo $mb['mb_id'] ?>&amp;me_id=<?php echo $memo['me_id'] ?>" class="btn btn-raised btn-primary btn-sm">답장</a><?php }  ?>
    </div>
        

  </div>
</div>

<!-- } 쪽지보기 끝 -->