<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$thumb_width = 210;
$thumb_height = 150;
?>

<div class="bxslider">

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
		    	
		<div>
			<?php echo $img_content; ?>
			<div class="box border border-top-0 px-2 pt-3 text-left">	
				<h4 class="lat_title"><?php  echo "<a href=\"".$list[$i]['href']."\"> "; ?><?php echo $list[$i]['subject'] ?></a></h4>
				<p class="pt-2 pb-1"><?php echo cut_str(strip_tags($list[$i][wr_content]),80," . . . ") ?></p>
			</div>
		</div>
	<?php }  ?>
	<?php if (count($list) == 0) { //게시물이 없을 때  ?>
		<div class="text-center">게시물이 없습니다.</div>
	<?php }  ?>
	
</div>
<script>
	
$(function(){
	$('.bxslider').bxSlider({
		mode: 'fade',
		controls: false,
		slides: 1,
	});
});
</script>