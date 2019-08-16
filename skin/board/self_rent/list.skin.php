<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 밑에 add_stylesheet 함수를 사용하지 않는이유은 가끔 홈페이지 개발시 오류로 add_stylesheet 함수가 먹지 않는 현상으로 인해 사용하지 않습니다. -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $board_skin_url;?>/wz.js/fullcalendar.css" />
<link rel="stylesheet" type="text/css" media="print" href="<?php echo $board_skin_url;?>/wz.js/fullcalendar.print.min.css" />
<script type="text/javascript" src="<?php echo $board_skin_url;?>/wz.js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo $board_skin_url;?>/wz.js/fullcalendar.js"></script>
<script type="text/javascript" src="<?php echo $board_skin_url;?>/wz.js/ko.js"></script>
<script type="text/javascript" src="<?php echo $board_skin_url;?>/wzappend.css"></script>
<style>

</style>
<script type="text/javascript">
<!--
$(document).ready(function() {

    var initialLocaleCode = 'ko';

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultDate: '<?php echo G5_TIME_YMD?>',
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        eventLimit: false, // allow "more" link when too many events
        height: 'auto',
        events: {
            url: '<?php echo $board_skin_url;?>/get-events.php?bo_table='+g5_bo_table,
            error: function() {
                $('#script-warning').show();
            }
        },
        loading: function(bool) {
            $('#loading').toggle(bool);
        }
    });

});
//-->
</script>

<div id="bo_list" style="width:<?php echo $width; ?>">

    <div id="bo_btn_top">
        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin btn"><i class="fa fa-user-circle" aria-hidden="true"></i> 관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02 btn"><i class="fa fa-pencil" aria-hidden="true"></i> 글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>

    <div id="calendar"></div>

</div>