<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $is_admin;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$visit_skin_url.'/style.css">', 0);
?>

<?php
if ( defined('_INDEX_') && !$config['cf_1'] ) { // side를 사용하지 않는 index에서만 실행
?>
	<!-- 접속자집계 시작 { -->
	<div class="py-1 text-center visit_none">
	  <i class="fa fa-users" aria-hidden="true"></i><span>접속자집계</span>
	  <span>오늘: <?php echo number_format($visit[1]) ?></span>
	  <span>어제: <?php echo number_format($visit[2]) ?></span>
	  <span>최대: <?php echo number_format($visit[3]) ?></span>
	  <span>전체: <?php echo number_format($visit[4]) ?></span>
	  <?php if ($is_admin == "super") {  ?>
	   	<a href="<?php echo G5_ADMIN_URL ?>/visit_list.php" class="btn btn-secondary btn-sm"><span class="text-white">상세보기</span></a>
	  <?php } ?>
	</div>
<!-- } 접속자집계 끝 -->

<?php } else { ?>

<!-- 접속자집계 시작 { -->
	<section id="visit">
	    <h2><i class="fa fa-users" aria-hidden="true"></i>  접속자집계</h2>
	    <dl>
	        <dt>오늘</dt>
	        <dd><?php echo number_format($visit[1]) ?></dd>
	        <dt>어제</dt>
	        <dd><?php echo number_format($visit[2]) ?></dd>
	        <dt>최대</dt>
	        <dd><?php echo number_format($visit[3]) ?></dd>
	        <dt>전체</dt>
	        <dd><?php echo number_format($visit[4]) ?></dd>
	    </dl>
	    <?php if ($is_admin == "super") {  ?><a href="<?php echo G5_ADMIN_URL ?>/visit_list.php" class="btn_admin">상세보기</a><?php } ?>
	</section>
	<!-- } 접속자집계 끝 -->
<?php } ?>