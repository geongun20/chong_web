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
					<div class="textbox__image"><a href="#"><img src="<?php echo G5_THEME_URL ?>/asset/images/main/4.jpg" alt=""/></a></div>
					<div class="textbox__body">
						<h2 class="textbox__title"><a href="#">그누 반응형 템플릿</a></h2>
						<div class="textbox__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut laoreet ut lacus a tincidunt. Quisque lu</div>
					</div>
				</div> <!-- End of textbox_body -->					
			</div>
			<div class="col-md-4 col-lg-4">					
				<!-- textbox -->
				<div class="textbox">
					<div class="textbox__image"><a href="#"><img src="<?php echo G5_THEME_URL ?>/asset/images/main/5.jpg" alt=""/></a></div>
					<div class="textbox__body">
						<h2 class="textbox__title"><a href="#">반응형 레이아웃</a></h2>
						<div class="textbox__description">Nam elit ligula, egestas et ornare non, viverra eu justo. Aliquam ornare lectus ut pharetra dictum. </div>
					</div>
				</div> <!-- End of textbox_body -->					
			</div>
			<div class="col-md-4 col-lg-4">									
				<div class="textbox"> <!-- textbox -->
					<div class="textbox__image"><a href="#"><img src="<?php echo G5_THEME_URL ?>/asset/images/main/6.jpg" alt=""/></a></div>
					<div class="textbox__body">
						<h2 class="textbox__title"><a href="#">SEO 최적화</a></h2>
						<div class="textbox__description">Mauris lacinia venenatis dolor sit amet viverra. Integer malesuada nulla neque. Sed rutrum ligula eu</div>
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
			<li class="nav-item">
				<a class="nav-link" href="#third" role="tab" id="third-tab" data-toggle="tab" aria-controls="third"><span class="text-black-50"><h4 class="bar"><span id="subject_3"><?php echo $subject_3 ?></span></h4></span></a>
			</li>
			<?php
			/* 탭 4를 추가하는 경우, 다음과 같이 추가하세요.
			<li class="nav-item">
				<a class="nav-link" href="#fourth" role="tab" id="fourth-tab" data-toggle="tab" aria-controls="fourth"><span class="text-black-50"><h4 class="bar"><span id="subject_4"><?php echo $subject_4 ?></span></h4></span></a>
			</li>
			*/
			?>
		</ul>
	
		<!-- Content Panel -->
		<div id="clothing-nav-content" class="tab-content">
			<div role="tabpanel" class="tab-pane fade show active py-3" id="first" aria-labelledby="first-tab">
					<!-- 탭 1의 최신글 지정: 스킨 , 게시판 아이디, 출력 라인,  글자 수(0: 자동 조절됨), 캐시 시간(1), 옵션(앞의 탭의 번호와 같은 값(1) 지정: 중요!) -->
					<?php echo latest('theme/tab_basic', 'list', 10, 0,1,1); ?>
			</div>
			<div role="tabpanel" class="tab-pane fade py-3" id="second" aria-labelledby="second-tab">
					<!-- 탭 2의 최신글 지정: 스킨 , 게시판 아이디, 출력 라인,  글자 수(0: 자동 조절됨), 캐시 시간(1), 옵션(앞의 탭의 번호와 같은 값(2) 지정: 중요!) -->
					<?php echo latest('theme/tab_basic', 'notice', 10, 0,1,2); ?>
			</div>
			<div role="tabpanel" class="tab-pane fade py-3" id="third" aria-labelledby="third-tab">
					<?php echo latest('theme/tab_basic', 'counsel', 10, 0,1,3); ?>
			</div>
			<?php
			/* 탭 4를 추가하는 경우, 주석을 풀어주세요.
			<div role="tabpanel" class="tab-pane fade py-3" id="fourth" aria-labelledby="fourth-tab">
					<?php echo latest('theme/tab_basic', 'community', 10, 0,1,4); ?>
			</div>
			*/
			?>
		</div>
	</div>
	<!-- End of Tab Latest -->

	<!-- Start of Latest: Owl Carousel(Gallery) -->
	<?php // 사용방법 : latest(스킨, 게시판 아이디, 출력 라인, 글자 수);
	echo latest('theme/pic_owl', 'gallery', 6, 0);
	?>
	<!-- End of Latest: Owl Carousel(Gallery) -->

	<!-- Start of Middle Parallax Section -->
	<?php
		$paral_pic = "paral_modern_2.jpg";
	?>

	<div class="parallax-modern-2 paral-mordern-2" data-parallax="scroll" data-image-src="<?php echo G5_THEME_URL ?>/img/paral/<?php echo $paral_pic ?>">
	</div>
	<!-- End of Middle Parallax Section -->

	<!-- Start of Latest: Owl Carousel(Webzine) -->
    <?php // 사용방법 : latest(스킨, 게시판 아이디, 출력 라인, 글자 수);
	echo latest('theme/webzine_owl', 'gallery', 6, 0);
	?>
	<!-- End of Latest: Owl Carousel(Webzine) -->

	<!-- Start of Latest Complex -->
	<div class="row mb-4">
		<div class="col-lg-6 mb-4">
			<!-- 갤러리 최신글 1 시작 { -->
			<?php
			// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
			// 사용방법 : latest(스킨, 게시판 아이디, 출력 라인, 글자 수);
			// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
			// echo latest('theme/basic', $row['bo_table'], 7, 24);
			// 글자수는 자동 제한이 되므로 0으로 지정
				echo latest('theme/pic_basic', 'gallery', 4, 0);
			?>
			<!-- } 갤러리 최신글 1 끝 -->
		</div>
	    <div class="col-lg-6 mb-4">
			<!--  웹진 최신글 2 시작 { -->
			<?php
			// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
			// 사용방법 : latest(스킨, 게시판 아이디, 출력 라인, 글자 수);
			// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
				echo latest('theme/webzine_basic', 'webzine', 2, 0);
			?>
			<!-- } 웹진 최신글 2 끝 -->
	    </div>
	</div> <!-- /.row -->
	<!-- End of Latest Complex -->

	<!-- Start of Latest Gallery -->
	<div class="row mb-4">
		<div class="col-lg-12 mb-4">
			<!-- 갤러리 최신글 2 시작 { -->
			<?php
			// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
			// 사용방법 : latest(스킨, 게시판 아이디, 출력 라인, 글자 수);
			// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
			// echo latest('theme/basic', $row['bo_table'], 7, 24);
			// 글자수는 자동 제한이 되므로 0으로 지정
				echo latest('theme/pic_basic_6', 'gallery', 6, 0);
			?>
			<!-- } 갤러리 최신글 2 끝 -->
		</div>
	</div> <!-- /.row -->
	<!-- End of Latest Gallery -->        
 
	<!-- Main Parallax Section -->
	<?php
		$paral_pic = "paral_main.jpg";
	?>

	<div class="parallax-window-main paral-main mb-4" data-parallax="scroll" data-image-src="<?php echo G5_THEME_URL ?>/img/paral/<?php echo $paral_pic ?>">
	    <h1 class="display-3">Here is a heading</h1>
		<p class="lead">Here is a short description</p>
		<p class="lead">
		<a class="btn btn-info btn-lg btn-md" href="#" role="button">Here is a button</a>
		</p>
	</div>

	<div class="row mb-4">
		<div class="col-sm-6 mt-4 mb-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Special title treatment</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					<a href="#" class="btn btn-outline-primary">Go somewhere</a>
				</div>
			</div>
		</div>
		<div class="col-sm-6 mt-4 mb-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Special title treatment</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					<a href="#" class="btn btn-outline-primary">Go somewhere</a>
				</div>
			</div>
		</div>
	</div>
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

