<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php
	if (!$modern) {
	    if ( (defined('_INDEX_') && $config['cf_1']) || (!defined('_INDEX_') && $config['cf_2'])) { // aside를 사용하는 경우에만 실행 ?> 
					</div>
				</div>
			</div>
		<?php } ?>
<?php } ?>
<!-- } 콘텐츠 끝 -->

<!-- 하단 시작 { -->
<?php
if(defined('_INDEX_') && !$config['cf_1']) { // aside를 사용하지 않는 index에서만 실행
?>
	<!-- 접속자 통계 -->
	<div class="py-1 bg-light border-top">
	  <?php echo visit('theme/basic'); // 접속자집계, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
  	</div>
<?php } ?> 
		 
  <!-- Footer -->

	<footer id="footer" class="pt-4 bg-footer text-white">
		<div class="container pt-1">
			<div class="row px-3">
				<div class="col-md-3">
					<h4><span>회사소개</span></h4>
					<p class="text-muted">Libero adipiscing pellentesque. Eu nibh non. Rutrum suspendisse ad neque sollicitudin diam. Eu risus mauris. Mi elementum lectus. Et pretium urna venenatis a pellentesque.</p>
						<ul class="social-icons">
							<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
							<li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
							<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fab fa-instagram"></i></a></li>
						</ul>
				</div>
				<div class="col-md-2">
					<h4><span>바로가기</span></h4>
						<ul class="footer-links">
							<li><a href="#"><i class="fas fa-check"></i> Home</a></li>
							<li><a href="#"><i class="fas fa-check"></i> 커뮤니티</a></li>
							<li><a href="#"><i class="fas fa-check"></i> 페이지</a></li>
							<li><a href="#"><i class="fas fa-check"></i> 갤러리</a></li>
							<li><a href="#"><i class="fas fa-check"></i> 연락처</a></li>
							<li><a href="#"><i class="fas fa-check"></i> 개인정보보호</a></li>
						</ul>
				</div>
	
				<!-- Footer 최신글 -->
				<div class="col-md-4">
					<h4><span>최신글</span></h4>
					<?php
					//  사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수); 
					echo latest('theme/pic_footer', 'footer', 3, 40); 
					?>
				</div>


				<!-- 최신글 형태로 사용하고자 할 경우에는 이곳의 주석을 풀고, 위의 Footer 최신글 섹션을 주석 처리하세요. -->
				<!--
				<div class="col-md-4">
					<h4><span>사이트 소개</span></h4>
					<div class="pic">
						<a href="#" class="small-img" style="background-image: url(<?php echo G5_THEME_IMG_URL ?>/footer_pic_01.jpg);">
						</a>
						<div class="desc">
							<h2><a href="#">Lorem ipsum semper.</a></h2>
							<p class="admin"><span>28 April 2019</span></p>
						</div>
					</div>
					<div class="pic">
						<a href="#" class="small-img" style="background-image: url(<?php echo G5_THEME_IMG_URL ?>/footer_pic_02.jpg);">
						</a>
						<div class="desc">
							<h2><a href="#">Ut consequat pede.</a></h2>
							<p class="admin"><span>30 April 2019</span></p>
						</div>
					</div>
					<div class="pic">
						<a href="#" class="small-img" style="background-image: url(<?php echo G5_THEME_IMG_URL ?>/footer_pic_03.jpg);">
						</a>
						<div class="desc">
							<h2><a href="#">Dolor eros donec vel et placerat.</a></h2>
							<p class="admin"><span>04 May 2019</span></p>
						</div>
					</div>
				</div>
				-->
					
				<div class="col-md-3">
					<h4><span>연락처</span></h4>
					<ul class="footer-links">
						<li>서울시 OO구 OO로 OO 빌딩 OO층 OOO호</li>
						<li><a href="tel://1234567890"><i class="fas fa-phone"></i> + 1234 5678 90</a></li>
						<li><a href="mailto:info@gnu-bs4.com"><i class="far fa-envelope"></i> info@gnu-bs4.com</a></li>
						<li><a href="#"><i class="fas fa-map-marker-alt"></i> gnu-bs4.com</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="copy py-4 bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<p class="m-0 text-center text-white">Copyright &copy; <?php echo $config['cf_title']; ?> 2019. All rights reserved.</p>
					</div>
				</div>
			</div>
		</div> <!-- /.container -->
	</footer>

<!--    
<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { 
}
?>
-->

<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>
<!-- } 하단 끝 -->

<!-- Return to Top -->
<a href="javascript:void(0);" id="return-to-top"><i class="fas fa-chevron-up"></i></a>

<!-- 캘린터의 Tooltip에 필요, 반드시 부트스트랩 JS보다 먼저 로딩되도록 해야 함!!! -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!--Parallex -->
<script src="<?php echo G5_THEME_URL ?>/asset/js/parallax.js"></script>
<!--Offcanvas -->
<script src="<?php echo G5_THEME_URL ?>/asset/offcanvas/holder.min.js"></script>
<script src="<?php echo G5_THEME_URL ?>/asset/offcanvas/offcanvas.js"></script>
<!--Owl Carousel -->
<script src="<?php echo G5_THEME_URL ?>/asset/owlcarousel/owl.carousel.min.js"></script>
<!-- bxSlider -->
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<!-- nice-select -->
<script src="<?php echo G5_THEME_URL ?>/asset/nice-select/jquery.nice-select.js"></script>
<script src="<?php echo G5_THEME_URL ?>/asset/nice-select/fastclick.js"></script>
<script src="<?php echo G5_THEME_URL ?>/asset/nice-select/prism.js"></script>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<script>
// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>