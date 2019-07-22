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
if(false){
//if(defined('_INDEX_') && !$config['cf_1']) { // aside를 사용하지 않는 index에서만 실행
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

				<!--<div class="col-md-3">-->
					<ul class="footer-links" ">
						<li>서울특별시 관악구 관악로 1 서울대학교 학생회관 총학생회실 (63동 426호), 08826</li>
						<li><a href="mailto:we.snu.ac.kr@gmail.com"><i class="far fa-envelope"></i> we.snu.ac.kr@gmail.com</a></li>
						<li><a href="https://www.facebook.com/pg/snuchong/"><i class="fab fa-facebook-square"></i> Facebook</a></li>
						<li style="margin-bottom: 25px;"><a href="https://www.instagram.com/tomorrow_of_snu/"><i class="fab fa-instagram"></i> Instagram</a></li>
					</ul>
				<!--</div>-->
			</div>
		</div>
		<div class="copy py-4 bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<p class="m-0 text-center text-white">Copyright &copy; <?php echo $config['cf_title']; ?> 2019. All rights reserved.&nbsp;&nbsp;|&nbsp;&nbsp;제작: 제61대 서울대학교 총학생회 &lt;내일&gt;&nbsp;&nbsp;|&nbsp;&nbsp;기획: 도정근, 이동현, 이승건, 임승연, 정덕인</p>
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

<!-- propeller -->
<!-- <script src="<?php echo G5_THEME_URL ?>/asset/propeller/propeller.js"></script>	 -->

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
