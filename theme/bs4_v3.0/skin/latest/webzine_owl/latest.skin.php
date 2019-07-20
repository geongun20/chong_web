<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$thumb_width = 210;
$thumb_height = 150;
?>

<div class="owl_zine_title text-center section-header pb-3">
	<h4 id="zine_title"><?php echo $bo_subject ?></h4>
</div>
	
<section id="latest-news" class="latest-news-section">
	<div class="carousel-wrap">
		<div id="owl-news" class="owl-carousel-webzine owl-carousel owl-theme latest-news">
				    
			<?php
			for ($i=0; $i<count($list); $i++) {
				$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);
				
				if($thumb['src']) {
				    $img = $thumb['src'];
				} else {
				    $img = G5_THEME_IMG_URL.'/no_image.png';
				    $thumb['alt'] = '이미지가 없습니다.';
				}
				$img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
				?>
				    	
				<div class="item latest-post">
					<?php echo $img_content; ?>
					<h4 class="lat_title"><?php  echo "<a href=\"".$list[$i]['href']."\"> "; ?><?php echo $list[$i]['subject'] ?></a></h4>
					<div class="post-details">
						<span class="date"><strong><?php echo date("d", strtotime($list[$i]['wr_datetime'])) ?></strong> <br><?php echo date("M, Y", strtotime($list[$i]['wr_datetime'])) ?></span>
					</div>
					<p style="height: 90px;"><?php echo cut_str(strip_tags($list[$i][wr_content]),70," . . . ") ?></p>
					<div class="dir">
						<a href="<?php echo $list[$i]['href'] ?>" class="btn btn-outline-primary">내용보기</a>
					</div>
				</div>
							
				<!-- <span class='lt_title'>
				<?php
				if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
				
				if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
				
				if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";
				
				
				echo "<a href=\"".$list[$i]['href']."\"> ";
				if ($list[$i]['is_notice'])
				    echo "<strong>".$list[$i]['subject']."</strong>";
				else
				    // echo $list[$i]['subject'];
				
				
				
				// if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
				// if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
				
				 //echo $list[$i]['icon_reply']." ";
				// if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
				//if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;
				
				if ($list[$i]['comment_cnt'])  echo "
				<span class=\"lt_cmt\">+ ".$list[$i]['wr_comment']."</span>"; ?>
				</span><br /> -->
			<?php }  ?>
			<?php if (count($list) == 0) { //게시물이 없을 때  ?>
				<div class="text-center">게시물이 없습니다.</div>
			<?php }  ?>

		</div>
	</div>
</section>