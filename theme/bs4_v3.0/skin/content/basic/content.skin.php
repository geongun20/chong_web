<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
if ($config['cf_2']) include_once(G5_THEME_PATH.'/aside.php');
?>

	<div id="content">
		<div class="container">
			<!-- Page Content -->
		    <div class="section-header page">
		        <h3><?php echo $g5['title']; ?></h3>
		    </div>
		    
		    <div id="ctt_con">
				    <?php if ($is_admin) { ?>
					    <div class="text-right px-3">
							<a href="../adm/contentform.php?w=u&amp;co_id=<?php echo $co_id ?>" class="btn btn-secondary">내용 수정</a>
						</div>
				<?php } ?>
			        <?php echo $str; ?>
			</div>
		</div>
	</div>