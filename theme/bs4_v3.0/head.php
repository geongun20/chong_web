<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');


$menus = array();

$sql = " select * from {$g5['menu_table']} where me_use = '1' and length(me_code) = '2' order by me_order, me_id ";
$result = sql_query($sql, false);

$active_bo_table = isset($bo_table) ? $bo_table : '';
$active_co_id = isset($co_id) ? $co_id : '';
$active_gr_id = isset($gr_id) ? $gr_id : '';

$active_checks = array('bo_table'=>$active_bo_table, 'co_id'=>$active_co_id, 'gr_id'=>$active_gr_id);

function cm_menu_is_active($active_checks, $url)
{
    foreach($active_checks as $key=>$value) {
        if(!$value) continue;
        if(preg_match('/'.$key.'='.$value.'/', $url)) return true;
    }
    return false;
}

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $menu_item = array('url' => $row['me_link'], 'target' => $row['me_target'], 'name' => $row['me_name'], 'is_active'=>false, 'sub_menu' => array());
    if(cm_menu_is_active($active_checks, $row['me_link'])) {
        $menu_item['is_active'] = true;
    }
    $sql2 = " select * from {$g5['menu_table']} where me_use = '1' and length(me_code) = '4' and substring(me_code, 1, 2) = '{$row['me_code']}' order by me_order, me_id ";
    $result2 = sql_query($sql2);
    for ($k = 0; $row2 = sql_fetch_array($result2); $k++) {
        $sm = array('url' => $row2['me_link'], 'target' => $row2['me_target'], 'is_active'=>false, 'name' => $row2['me_name']);
        if(cm_menu_is_active($active_checks, $row2['me_link'])) {
            $menu_item['is_active'] = true;
            $sm['is_active'] = true;
        }
        array_push($menu_item['sub_menu'], $sm);
    }
    array_push($menus, $menu_item);
}
?>
    
<!-- 상단 시작 { -->
<h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
<div id="skip_to_container"><a href="#container">본문 바로가기</a></div>
<?php
if(defined('_INDEX_')) { // index에서만 실행
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

<div id="hd_wrapper"></div>    

<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
	<div class="container">
		<a class="navbar-brand" href="<?php echo G5_URL ?>"><?php echo $config['cf_title']; ?></a>
		<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
	    		<span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
	       <ul class="navbar-nav ml-auto navbar-right">
	            <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
					메인 화면
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="<?php echo G5_URL ?>?go_url=index_classic_1"><span> Classic 1</span></a>
						<a class="dropdown-item" href="<?php echo G5_URL ?>?go_url=index_classic_2"><span> Classic 2</span></a>
						<a class="dropdown-item" href="<?php echo G5_URL ?>?go_url=index_modern_1"><span> Modern 1</span></a>
						<a class="dropdown-item" href="<?php echo G5_URL ?>?go_url=index_modern_2"><span> Modern 2</span></a>
					</div>
	            </li>            
	
	            <?php	
	            foreach($menus as $menu_item) {
	
	                $is_active_menu = ($menu_item['is_active'] ? 'active' : '');
	
	                if(empty($menu_item['sub_menu'])) {
	                       
	                    echo '<li class="nav-item"><a class="nav-link" href="'.$menu_item['url'].'" target="_'.$menu_item['target'].'">'.$menu_item['name'].'</a></li>'.PHP_EOL;
	                    } else {
							echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$menu_item['name'].'</a>'.PHP_EOL;
							echo '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">'.PHP_EOL;
	                        foreach($menu_item['sub_menu'] as $sub_menu) {
	                            echo '<a class="dropdown-item" href="'.$sub_menu['url'].'" target="_'.$sub_menu['target'].'">'.$sub_menu['name'].'</a>'.PHP_EOL;
	                        }
	                        echo '</div>'.PHP_EOL;
	                        echo '</li>'.PHP_EOL;
	                    }
	                }
	                ?>
	
		        <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					그누보드 메뉴
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
						<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/faq.php"><i class="fa fa-question" aria-hidden="true"></i><span> FAQ</span></a>
						<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/qalist.php"><i class="fa fa-comments" aria-hidden="true"></i><span> 1:1문의</span></a>
						<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/current_connect.php"><i class="fa fa-users" aria-hidden="true"></i><span> 접속자</span><strong class="visit-num"><?php echo connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></strong></a>
						<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/new.php"><i class="fa fa-history" aria-hidden="true"></i><span> 새글</span></a>
						<?php if ($is_member) {
							if (((!$config['cf_1']) && defined('_INDEX_')) || ((!$config['cf_2']) && (!defined('_INDEX_')))) { ?>					
								<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank"><i class="far fa-envelope" aria-hidden="true"></i><span> 쪽지</span></a>
								<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/point.php" target="_blank"><i class="fas fa-database" aria-hidden="true"></i><span> 포인트</span></a>
								<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/scrap.php" target="_blank"><i class="fas fa-thumbtack" aria-hidden="true"></i><span> 스크랩</span></a>
							<?php } ?>
						
							<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><i class="fa fa-cog" aria-hidden="true"></i> 정보수정</a>
							<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> 로그아웃</a>
							
							<?php if ($is_admin) { ?> 
								<a class="dropdown-item" href="<?php echo G5_THEME_URL ?>/theme.php"><i class="fas fa-cogs"></i> 테마 설정</a>        
								<a class="dropdown-item" href="<?php echo G5_ADMIN_URL ?>"><i class="fas fa-user-circle" aria-hidden="true"></i> 관리자</a>
							<?php }  ?>
						<?php } else {  ?>
							<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> 회원가입</a>
							<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/login.php"><b><i class="fas fa-sign-in-alt" aria-hidden="true"></i> 로그인</b></a>         
						<?php }  ?>
					</div>
		        </li>                            
	        	</ul>
	  	</div>
	</div>
</nav>
<!-- } 상단 끝 -->

<?php
if(defined('_INDEX_')) { // index에서만 실행

	switch($config['cf_4']) {
		    
		case "1" : ?>
	    
			<!-- CSS for Modern 1-->
			<link href="<?php echo G5_THEME_URL ?>/asset/css/index_modern_1.css" rel="stylesheet">

		    <header class="masthead" style="background-image:url('<?php echo G5_THEME_URL ?>/asset/images/index_modern_1/header-bg.jpg');">
		        <div class="container">
		            <div class="intro-text">
		                <div class="intro-lead-in">
			                <span>그누보드 반응형 BS4 테마의 웹 사이트입니다!!</span>
			            </div>
						<div class="intro-heading text-uppercase">
							<span>그누보드 5.3과 Bootstrap 4를 사용하여 제작했습니다.</span>
						</div>
						<a class="btn btn-secondary btn-xl text-uppercase js-scroll-trigger" role="button" href="#services">문의하기</a>
					</div>
		        </div>
		    </header>
		    
		    <?php break;
			    
		case "2" :

			$paral_pic = "paral_main_top.jpg";
			?>

            <div class="parallax-window-main-top paral-main-top" data-parallax="scroll" data-image-src="<?php echo G5_THEME_URL ?>/img/paral/<?php echo $paral_pic ?>">
			    <h1 class="display-3">Here is a heading</h1>
				<p class="lead">Here is a short description</p>
				<p class="lead">
				<a class="btn btn-info btn-lg btn-md" href="#" role="button">Here is a button</a>
				</p>
			</div>
	        
	        <?php break;
		        
		default : ?>      
		        
			<header>
				<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="6000">
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox">
						<!-- Slide One - Set the background image for this slide in the line below -->
						<div class="carousel-item active" style="background-image: url('<?php echo G5_THEME_URL ?>/asset/images/slide/jetty.png')">
							<div class="carousel-caption">
								<h3>슬라이드 1의 헤드라인입니다.</h3>
								<p>We meticously build each site to get results</p>
								<span><a class="btn btn-info" href="#" role="button">Learn More</a></span>
							</div>
						</div>
						<!-- Slide Two - Set the background image for this slide in the line below -->
						<div class="carousel-item" style="background-image: url('<?php echo G5_THEME_URL ?>/asset/images/slide/yellowstone-national-park.png')">
							<div class="carousel-caption">
								<h3>슬라이드 2의 헤드라인입니다.</h3>
								<p>We work as an extension of your business to explore solutions</p>
								<span><a class="btn btn-info" href="#" role="button">Our Process</a></span>
							</div>
						</div>
						<!-- Slide Three - Set the background image for this slide in the line below -->
						<div class="carousel-item" style="background-image: url('<?php echo G5_THEME_URL ?>/asset/images/slide/boats.png')">
							<div class="carousel-caption">
								<h3>슬라이드 3의 헤드라인입니다.</h3>
								<p>We monitor and optimize your site's long-term performance</p>
								<span><a class="btn btn-info" href="#" role="button">Learn How</a></span>
							</div>
						</div>
					</div>
				    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
				    </a>
				    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
				    </a>
			  	</div>
	    		</header>
	<?php } // End of switch
} ?>
	 
<!-- 콘텐트 시작 { -->
<!-- 게시판 또는 페이지 상단의 Parallex 이미지 지정을 함 -->
<?php
if (!defined('_INDEX_')) { // index가 아닌 경우에만 실행
    if ($bo_table == "basic" || $bo_table == "gallery" || $bo_table == "webzine") { // 게시판의 경우임
	    $paral_pic = "paral_01.jpg";
	    $h1 = "Here is a heading 1";
	    $p = "Here is a short description 1";	    
    } else if ($co_id == "page1" || $co_id == "page2" || $co_id == "page_test") { // 페이지의 경우임
		$paral_pic = "paral_02.jpg";
		$h1 = "Here is a heading 2";
	    $p = "Here is a short description 2";	
	} else if  ($co_id == "typo") {
		$paral_pic = "paral_03.jpg";
		$h1 = "Here is a heading 3";
	    $p = "Here is a short description 3";

	// Parallax 이미지 추가 시, 이곳에 추가					

	} else { // 위의 경우를 제외한 모든 게시판이나 페이지에는 아래의 설정을 적용함
		$paral_pic = "paral_04.jpg";
		$h1 = "Here is a heading 4";
	    $p = "Here is a short description 4";
	} ?>

	<div class="parallax-window-sub paral-sub" data-parallax="scroll" data-image-src="<?php echo G5_THEME_URL ?>/img/paral/<?php echo $paral_pic ?>">
		<h1 class="display-4"><?php echo $h1 ?></h1>
		<p class="lead"><?php echo $p ?></p>
	</div>
<?php } ?>

<?php
// board_new 게시판 최신글 및 최신 댓글 추출
function new_latest($skin_dir='', $rows=10, $subject_len=40, $is_comment=false, $cache_minute=5, $options='')
{
    global $g5;

    if (!$skin_dir) $skin_dir = 'basic';

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            if(!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
        }
    }

    $cache_fwrite = false;
    if(G5_USE_CACHE) {
        if($is_comment)
            $type = 'comment';
        else
            $type = 'write';

        $cache_file = G5_DATA_PATH."/cache/latest-boardnew-{$type}-{$skin_dir}-{$rows}-{$subject_len}.php";

        if(!file_exists($cache_file)) {
            $cache_fwrite = true;
        } else {
            if($cache_minute > 0) {
                $filetime = filemtime($cache_file);
                if($filetime && $filetime < (G5_SERVER_TIME - 60 * $cache_minute)) {
                    @unlink($cache_file);
                    $cache_fwrite = true;
                }
            }

            if(!$cache_fwrite)
                include($cache_file);
        }
    }

    if(!G5_USE_CACHE || $cache_fwrite) {
        $list = array();

        $sql_common = " from {$g5['board_new_table']} a, {$g5['board_table']} b where a.bo_table = b.bo_table and b.bo_use_search = 1 ";

        if($is_comment)
            $sql_common .= " and a.wr_id <> a.wr_parent ";
        else
            $sql_common .= " and a.wr_id = a.wr_parent ";

        $sql_order = " order by a.bn_id desc ";

        $sql = " select a.*, b.bo_subject {$sql_common} {$sql_order} limit {$rows} ";

        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $tmp_write_table = $g5['write_prefix'].$row['bo_table'];

            if ($row['wr_id'] == $row['wr_parent']) {

                // 원글
                $comment_link = "";
                $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
                $list[$i] = $row2;

                // 당일인 경우 시간으로 표시함
                $datetime = substr($row2['wr_datetime'],0,10);
                $datetime2 = $row2['wr_datetime'];
                if ($datetime == G5_TIME_YMD) {
                    $datetime2 = substr($datetime2,11,5);
                } else {
                    $datetime2 = substr($datetime2,5,5);
                }

                $list[$i]['comment_cnt'] = '';
                if ($row2['wr_comment'])
                    $list[$i]['comment_cnt'] = "<span class=\"cnt_cmt\">".$list[$i]['wr_comment']."</span>";
 
                $list[$i]['icon_new'] = '';
                if ($row2['wr_datetime'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - (24 * 3600)))
                    $list[$i]['icon_new'] = '<img src="'.$latest_skin_url.'/img/icon_new.gif" alt="새글">';

                $list[$i]['icon_secret'] = '';
                if (strstr($row2['wr_option'], 'secret'))
                    $list[$i]['icon_secret'] = '<img src="'.$latest_skin_url.'/img/icon_secret.gif" alt="비밀글">';

            } else {

                // 코멘트
                $comment_link = '#c_'.$row['wr_id'];
                $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_parent']}' ");
                $row3 = sql_fetch(" select wr_name, wr_datetime, wr_content, wr_option from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
                $row2['wr_subject'] = $row3['wr_content'];
                $list[$i] = $row2;
                $list[$i]['wr_id'] = $row['wr_id'];
                $list[$i]['wr_name'] = $row3['wr_name'];

                // 당일인 경우 시간으로 표시함
                $datetime = substr($row3['wr_datetime'],0,10);
                $datetime2 = $row3['wr_datetime'];
                if ($datetime == G5_TIME_YMD) {
                    $datetime2 = substr($datetime2,11,5);
                } else {
                    $datetime2 = substr($datetime2,5,5);
                }

                $list[$i]['icon_new'] = '';
                if ($row3['wr_datetime'] >= date("Y-m-d H:i:s", G5_SERVER_TIME - (24 * 3600)))
                    $list[$i]['icon_new'] = '<img src="'.$latest_skin_url.'/img/icon_new.gif" alt="새글">';

                $list[$i]['icon_secret'] = '';
                if (strstr($row2['wr_option'], 'secret') || strstr($row3['wr_option'], 'secret')) {
                    $row2['wr_subject'] = '비밀 댓글입니다.';
                    $list[$i]['icon_secret'] = '<img src="'.$latest_skin_url.'/img/icon_secret.gif" alt="비밀글">';
                }

            }

            $list[$i]['bo_table'] = $row['bo_table'];
            $list[$i]['href'] = G5_BBS_URL.'/board.php?bo_table='.$row['bo_table'].'&amp;wr_id='.$row2['wr_id'].$comment_link;
            $list[$i]['datetime'] = $datetime;
            $list[$i]['datetime2'] = $datetime2;
            $list[$i]['bo_subject'] = ((G5_IS_MOBILE && $row['bo_mobile_subject']) ? $row['bo_mobile_subject'] : $row['bo_subject']);
			$list[$i]['wr_subject'] = conv_subject($row2['wr_subject'], $subject_len, '…');
        }

        if($cache_fwrite) {
            $handle = fopen($cache_file, 'w');
            $cache_content = "<?php\nif (!defined('_GNUBOARD_')) exit;\n\$list=".var_export($list, true)."?>";
            fwrite($handle, $cache_content);
            fclose($handle);
        }
    }

    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>