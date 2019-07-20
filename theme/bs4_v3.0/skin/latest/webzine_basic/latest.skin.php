<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$thumb_width = 210;
$thumb_height = 150;
?>

<div class="pic_lt my_shadow h-100">
    <h4 class="lat_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject ?></a></h4>
    <ul class="row">
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
        <li class="col-12 mb-1">
		    <div class="row">
	        	<?php if ($config['cf_1']) { ?>
	        		<div class="col-3">
		        <?php } else { ?>
	        		<div class="col-3">
		        <?php } ?>     	
		            <a href="<?php echo $list[$i]['href'] ?>" class="lt_img"><?php echo $img_content; ?></a>
	        	</div>
	        	<?php if ($config['cf_1']) { ?>
	        		<div class="col-9">
		        <?php } else { ?>
	        		<div class="col-9">
		        <?php } ?>  
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
		            <span> <?php echo cut_str(strip_tags($list[$i][wr_content]),80," . . . ") ?></span>
		            <span class="lt_date"><i class="fa fa-clock"></i> <?php echo $list[$i]['datetime'] ?></span>
		         <?php echo "</div>";
            echo "</div>";
            ?>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="lt_more"><span class="sound_only"><?php echo $bo_subject ?></span><i class="fa fa-plus" aria-hidden="true"></i><span class="sound_only"> 더보기</span></a>

</div>
