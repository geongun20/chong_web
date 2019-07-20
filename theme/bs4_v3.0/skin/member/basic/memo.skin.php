<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지 목록 시작 { -->
<div class="section-header page">	
<h3><?php echo $g5['title'] ?></h3>
</div>

<div id="memo_list" class="new_win">
  <div class="row">
	  <div class="col-md-12 text-center mb-4">
      <span class="<?php if ($kind == 'recv') {  ?>selected<?php }  ?>"><a href="./memo.php?kind=recv">받은쪽지 /</a></span>
      <span  class="<?php if ($kind == 'send') {  ?>selected<?php }  ?>"><a href="./memo.php?kind=send">보낸쪽지 /</a></span >
      <span ><a href="./memo_form.php">쪽지쓰기</a></span >
	  </div>
  </div>
  <div class="win_total">
    <button class="btn btn-info">
      전체 <?php echo $kind_title ?>쪽지 <?php echo $total_count ?>통<br>
    </button>
  </div>

	<div class="memo_box">
    <?php for ($i=0; $i<count($list); $i++) {  ?>
      <div class="row">
	      <div class="col-md-12 memo_line">
          <span class="memo_name"><a href="<?php echo $list[$i]['view_href'] ?>"><?php echo $list[$i]['mb_nick'] ?></a></span>
          <span class="memo_datetime"><?php echo $list[$i]['send_datetime'] ?> - <?php echo $list[$i]['read_datetime'] ?> <a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;" class="memo_del"><i class="fa fa-times-circle" aria-hidden="true"></i> <span class="sound_only">삭제</span></a></span>
	     </div>
      </div>
    <?php }  ?>
            <?php if ($i==0) { echo '<span class="empty_table">자료가 없습니다.</span>'; }  ?>
	</div>

  <!-- 페이지 -->
  <?php echo $write_pages; ?>

  <p class="win_desc">
    <span class="form-text text-muted">쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del'] ?></strong>일 입니다.</span>
  </p>

  <div class="text-center mb-4 mt-4">
   <button type="button" onclick="window.close();" class="btn btn-raised btn-secondary btn-sm">창닫기</button>
  </div>

</div>
<!-- } 쪽지 목록 끝 -->