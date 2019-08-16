<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');
if ($config['cf_1']) include_once(G5_THEME_PATH.'/aside.php');
?>

<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/asset/css/index_modern_2.css">

<!-- 3단 Taxt Box -->
<div class="textbox-group px-4<?php if ($config['cf_1']) echo " mt-3"; ?>">
	<div class="container">
		<div class="row mb-5">
			<div class="col-md-4 col-lg-4">
				<div class="textbox"> <!-- textbox -->
					<div class="textbox__image"><a href="./bbs/board.php?bo_table=plotter"><img src="<?php echo G5_THEME_URL ?>/img/plotter.png" alt=""/></a></div>
					<div class="textbox__body">
						<h2 class="textbox__title"><a href="./bbs/board.php?bo_table=plotter">플로터인쇄 신청</a></h2>
					</div>
				</div> <!-- End of textbox_body -->
			</div>
			<div class="col-md-4 col-lg-4">
				<!-- textbox -->
				<div class="textbox">
					<div class="textbox__image"><a href="http://bit.ly/201906snushuttle"><img src="<?php echo G5_THEME_URL ?>/img/shuttle.png" alt=""/></a></div>
					<div class="textbox__body">
						<h2 class="textbox__title"><a href="http://bit.ly/201906snushuttle">광역셔틀신청</a></h2>
					</div>
				</div> <!-- End of textbox_body -->
			</div>
			<div class="col-md-4 col-lg-4">
				<div class="textbox"> <!-- textbox -->
					<div class="textbox__image"><a href="./bbs/board.php?bo_table=petition"><img src="<?php echo G5_THEME_URL ?>/img/chungwon.png" alt=""/></a></div>
					<div class="textbox__body">
						<h2 class="textbox__title"><a href="./bbs/board.php?bo_table=petition">학생청원</a></h2>
					</div>
				</div> <!-- End of textbox -->
			</div> <!-- End of col -->
		</div> <!-- End of row -->
	</div> <!-- End of container -->
</div> <!-- End of textbox-group -->
<!-- End of Text Box -->

<div class="container">

	<!-- Tab latest -->
	<div class="tab_latest mb-5">
		<ul id="clothing-nav" class="nav nav-tabs nav-fill" role="tablist">
			<!-- 탭 1: span id=subject_1, 맨 뒤의 숫자(1)는 탭의 번호 -->
			<li class="nav-item">
				<a class="nav-link active" href="#first" id="first-tab" role="tab" data-toggle="tab" aria-controls="first" aria-expanded="true"><span class="text-black-50"><h4 class="bar"><span id="subject_1"></span></h4></span></a>
			</li>
			<!-- 탭 2: span id=subject_2, 맨 뒤의 숫자(2)는 탭의 번호 -->
			<li class="nav-item">
				<a class="nav-link" href="#second" role="tab" id="second-tab" data-toggle="tab" aria-controls="second"><span class="text-black-50"><h4 class="bar"><span id="subject_2"></span></h4></span></a>
			</li>
			<?php
			/* 탭 3을 추가하는 경우, 다음과 같이 추가하세요.
			<li class="nav-item">
				<a class="nav-link" href="#third" role="tab" id="third-tab" data-toggle="tab" aria-controls="third"><span class="text-black-50"><h4 class="bar"><span id="subject_3"><?php echo $subject_3 ?></span></h4></span></a>
			</li>
			*/
			?>
		</ul>

		<!-- Content Panel -->
		<div id="clothing-nav-content" class="tab-content">
			<div role="tabpanel" class="tab-pane fade show active py-3" id="first" aria-labelledby="first-tab">
					<!-- 탭 1의 최신글 지정: 스킨 , 게시판 아이디, 출력 라인,  글자 수(0: 자동 조절됨), 캐시 시간(1), 옵션(앞의 탭의 번호와 같은 값(1) 지정: 중요!) -->
					<?php echo latest('theme/tab_basic', 'chong_notice', 10, 0,1,1); ?>
			</div>
			<div role="tabpanel" class="tab-pane fade py-3" id="second" aria-labelledby="second-tab">
					<!-- 탭 2의 최신글 지정: 스킨 , 게시판 아이디, 출력 라인,  글자 수(0: 자동 조절됨), 캐시 시간(1), 옵션(앞의 탭의 번호와 같은 값(2) 지정: 중요!) -->
					<?php echo latest('theme/tab_basic', 'chong_sosick', 10, 0,1,2); ?>
			</div>
			<?php
			/* 탭 3을 추가하는 경우, 다음과 같이 추가하세요.
			<div role="tabpanel" class="tab-pane fade py-3" id="third" aria-labelledby="third-tab">
					<?php echo latest('theme/tab_basic', 'community', 10, 0,1,2); ?>
			</div>
			*/
			?>
		</div>
	</div>
	<!-- End of Tab Latest -->

<?php
/* 지운 부분 싹둑.txt에 있음 */
?>

</div> <!-- End of Container -->

<!--Owl Carousel Trigger(Latest Gallery) -->
<script>
$(document).ready(function() {
	$('#owl-pic').owlCarousel({

	  margin: 20,
	  nav: true,
	  navText: [
	    "<i class='fa fa-caret-left'></i>",
	    "<i class='fa fa-caret-right'></i>"
	  ],
	  autoplay: 3000,
	  autoplayHoverPause: true,
	  rewind: true,
	  responsive: {
	    0: {
	      items: 2
	    },
	    600: {
	      items: 3
	    },
	    1000: {
	      items: 5
	    }
	  }
	})
});
</script>

<!--Owl Carousel Trigger(Latest Webzine) -->
<script>
$(document).ready(function() {
	$('#owl-news').owlCarousel({
	  loop: true,
	  margin: 20,
	  nav: true,
	  navText: [
	    "<i class='fa fa-caret-left'></i>",
	    "<i class='fa fa-caret-right'></i>"
	  ],
	  autoplay: 3000,
	  autoplayHoverPause: true,
	  responsive: {
	    0: {
	      items: 1
	    },
	    600: {
	      items: 2
	    },
	    1000: {
	      items: 4
	    }
	  }
	})
});
</script>

<?php
$modern = "";
include_once(G5_THEME_PATH.'/tail.php');
?>
