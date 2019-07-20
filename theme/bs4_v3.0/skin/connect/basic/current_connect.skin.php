<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/asset/login/css/style.css">

<!-- 현재접속자 목록 시작 { -->
<div class="container pt-3 mb-4">
<div class="section-header page">	
<h3><?php echo $g5['title'] ?></h3>
</div>

    <?php
    for ($i=0; $i<count($list); $i++) {
        //$location = conv_content($list[$i]['lo_location'], 0);
        $location = $list[$i]['lo_location'];
        // 최고관리자에게만 허용
        // 이 조건문은 가능한 변경하지 마십시오.
        if ($list[$i]['lo_url'] && $is_admin == 'super') $display_location = "<a href=\"".$list[$i]['lo_url']."\">".$location."</a>";
        else $display_location = $location;

        $classes = array();

    ?>

            <div class="row connect">
	            <div class="col-1">
                <?php echo $list[$i]['num'] ?>
	            </div>
	            <div class="col-1 crt_name">
                <?php echo get_member_profile_img($list[$i]['mb_id']); ?>
	            </div>
	            <div class="col-2">	            
                <?php echo $list[$i]['name'] ?>
              </div>
	            <div class="col-8 ri">
                <?php echo $display_location ?>
              </div>
            </div>

    <?php
    }
    if ($i == 0)
        echo "<span class=\"empty_li\">현재 접속자가 없습니다.</span>";
    ?>


</div>
<!-- } 현재접속자 목록 끝 -->