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



<link rel="shortcut icon" href="./img/favicon.png">


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
    <img src="./img/snumark.png" alt="snumark" height="50">

		<a class="navbar-brand" href="<?php echo G5_URL ?>"><?php echo $config['cf_title']; ?></a>
		<button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
	    		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
	       <ul class="navbar-nav ml-auto navbar-right">
	            <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
					총학생회 소개
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=chong_intro"><span> 총학생회<내일> 소개</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=middle"><span> 중앙집행위원회</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=address_num"><span> 주소 및 연락처</span></a>

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
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
					총학생회 소식
					</a>
					<div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=chong_notice"><span> 총학생회 공지</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=chong_sosick"><span> 총학생회 소식</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=gong_list"><span> 공약 리스트</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=chong_before"><span> 과거 총학생회 자료</span></a>
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
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
          학생회칙/자료실
  				</a>
  				<div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=chong_rule"><span> 총학생회칙</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=detail_rule"><span> 세칙</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=recent_rule"><span> 역대회칙</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=conference_materials"><span> 회의자료</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=account"><span> 예결산보고</span></a>
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
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">

          산하기구
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=under_elec"><span> 선거관리위원회</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=under_munhwa"><span> 문화자치위원회</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=under_ja_an"><span> 자치언론기금</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=under_festival"><span> 축제하는사람들</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=under_lib"><span> 자치도서관</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=under_daejayeon"><span> 대학행정자치연구위원회</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=under_haksowi"><span> 학생·소수자인권위원회</span></a>
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
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">


          의견수렴
  				</a>
  				<div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=petition"><span> 학생청원</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=convergence"><span> 학생의견수렴</span></a>
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
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
          편의 정보
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=plotter"><span> 플로터인쇄</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=gwang_sheer"><span> 광역셔틀문의</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=a_jick"><span> 셔틀정보</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=a_jick"><span> 편의시설정보</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=a_jick"><span> 셔틀정보</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=a_jick"><span> 학내분실물</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=campus_map"><span> 캠퍼스맵</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=a_jick"><span> 학내주요연락처</span></a>
            <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/content.php?co_id=a_jick"><span> 사이트맵</span></a>
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

                  <?php if ($is_member) {?>



                    <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  회원 메뉴
                  </a>
                  <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" target="_self"><span> 정보수정</span></a>
                  <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/logout.php" target="_self"><span> 로그아웃</span></a>
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



<?php }else { ?>




  <li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
회원 메뉴
</a>
<div class="dropdown-menu dropdown-menu-right">
<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/register.php" target="_self"><span> 회원가입</span></a>
<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/login.php" target="_self"><span> 로그인</span></a>
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


<?php }  ?>

<?php if ($is_member) {
?>
  <?php if ($is_admin) { ?>

		        <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          관리자 메뉴
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
								<a class="dropdown-item" href="<?php echo G5_THEME_URL ?>/theme.php"><i class="fas fa-cogs"></i> 테마 설정</a>
								<a class="dropdown-item" href="<?php echo G5_ADMIN_URL ?>"><i class="fas fa-user-circle" aria-hidden="true"></i> 관리자</a>
					</div>
		        </li>
          <?php }  ?>
        <?php } ?>



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
				<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2000">
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox">
						<!-- Slide One - Set the background image for this slide in the line below -->
						<div class="carousel-item active" style="background-image: url('<?php echo G5_THEME_URL ?>/asset/images/slide/사당셔틀.png')">
							<div class="carousel-caption">
								<!--<h3>슬라이드 1의 헤드라인입니다.</h3>
								<p>We meticously build each site to get results</p>
								<span><a class="btn btn-info" href="#" role="button">Learn More</a></span>-->
							</div>
						</div>
						<!-- Slide Two - Set the background image for this slide in the line below -->
						<div class="carousel-item" style="background-image: url('<?php echo G5_THEME_URL ?>/asset/images/slide/jgjg.png')">
							<div class="carousel-caption">
								<!--<h3>슬라이드 2의 헤드라인입니다.</h3>
								<p>We work as an extension of your business to explore solutions</p>
								<span><a class="btn btn-info" href="#" role="button">Our Process</a></span>-->
							</div>
						</div>
						<!-- Slide Three - Set the background image for this slide in the line below -->
						<div class="carousel-item" style="background-image: url('<?php echo G5_THEME_URL ?>/asset/images/slide/총학로고2.jpg')">
							<div class="carousel-caption">
								<!--<h3>슬라이드 3의 헤드라인입니다.</h3>
								<p>We monitor and optimize your site's long-term performance</p>
								<span><a class="btn btn-info" href="#" role="button">Learn How</a></span>-->
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
	    $paral_pic = "총학로고.png";
	    $h1 = "Here is a heading 1";
	    $p = "Here is a short description 1";
    } else if ($co_id == "page1" || $co_id == "page2" || $co_id == "page_test") { // 페이지의 경우임
		$paral_pic = "총학로고.png";
		$h1 = "Here is a heading 2";
	    $p = "Here is a short description 2";
	} else if  ($co_id == "typo") {
		$paral_pic = "총학로고.png";
		$h1 = "Here is a heading 3";
	    $p = "Here is a short description 3";

	// Parallax 이미지 추가 시, 이곳에 추가

	} else { // 위의 경우를 제외한 모든 게시판이나 페이지에는 아래의 설정을 적용함
		$paral_pic = "총학로고.png";
//		$h1 = "Here is a heading 4";
//	    $p = "Here is a short description 4";
	} ?>


<!--	<div class="parallax-window-sub paral-sub" data-parallax="scroll" data-image-src="<?php echo G5_THEME_URL ?>/img/paral/<?php echo $paral_pic ?>">
		<h1 class="display-4"><?php echo $h1 ?></h1>
		<p class="lead"><?php echo $p ?></p>
	</div>-->
<?php } ?>
