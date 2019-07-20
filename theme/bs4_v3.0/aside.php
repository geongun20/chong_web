<!-- Aside 시작-->
<script>
function display_submenu(num) {
	document.getElementById("mysub"+num).style.display="block";
	}
</script>

<script>
$(document).ready(function() {
    $("#mysubmenu a").on("click", function(e){ //링크 클릭시
        var $data_midtxt = $(this).attr("data-midtxt");
        if( $data_midtxt ){
            $.cookie('sub_midtxt', $data_midtxt, { path: '/' });
        } else {
            $.cookie('sub_midtxt', null, { path: '/' });
        }
    });
});
</script>

<div class="container">
 
	<!-- Content Row -->
	<div class="row">
		
		<!-- Aside Column -->
		<?php if ($config['cf_3'] == "1") {$side_location = " order-last";} // aside가 오른쪽 일 때 순서 변경 ?>
		<div class="col-lg-3 d-none d-lg-block  pt-3<?php  echo $side_location ?>">
					  
			<!-- Index일 때의 aside -->
			<?php if (defined("_INDEX_")) { ?>
				<div id="index_menu">
					<ul id="mysub">
						<?php
					    //공지사항
					    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
					    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
					    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
					    ?>
					    <li class=""><?php echo latest('theme/notice', 'basic', 4, 13); ?></li>
					    <!-- 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 -->
					    <li class=""><?php echo outlogin('theme/basic'); ?></li>
			    
						<!--
						<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/faq.php"><i class="fa fa-question" aria-hidden="true"></i><span> FAQ</span></a></li>
						<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/qalist.php"><i class="fa fa-comments" aria-hidden="true"></i><span> 1:1문의</span></a></li>
						<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/current_connect.php"><i class="fa fa-users" aria-hidden="true"></i><span> 접속자</span><strong class="visit-num"><?php echo connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></strong></a></li>
						<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/new.php"><i class="fa fa-history" aria-hidden="true"></i><span> 새글</span></a></li>
						<?php if ($is_member) { ?>
							<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><i class="fa fa-cog" aria-hidden="true"></i> 정보수정</a></li>
							<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> 로그아웃</a></li>            
							<?php if ($is_admin) { ?>            
								<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_ADMIN_URL ?>"><b><i class="fas fa-user-circle" aria-hidden="true"></i> 관리자</b></a></li>
							<?php }  ?>
							<?php } else {  ?>
							<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> 회원가입</a></li>
							<li class="menu_item"><a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/login.php"><b><i class="fas fa-sign-in-alt" aria-hidden="true"></i> 로그인</b></a></li>       
						<?php }  ?>
						-->
						
				  	</ul>
				</div>
				
				<!-- Tab New latest -->
				<div class="tab_latest mt-4">
					<ul id="clothing-nav border-left-0" class="nav nav-tabs nav-fill" role="tablist">
						<!-- 탭 1: span id=subject_1, 맨 뒤의 숫자(1)는 탭의 번호 -->
						<li class="nav-item">
							<a class="nav-link active" href="#aside_first" id="aside_first-tab" role="tab" data-toggle="tab" aria-controls="aside_first" aria-expanded="true"><span class="text-black-50 aside_title"><h4 class="bar">최신글</h4></span></a>
						</li>
						<!-- 탭 2: span id=subject_2, 맨 뒤의 숫자(2)는 탭의 번호 -->
						<li class="nav-item">
							<a class="nav-link" href="#aside_second" role="tab" id="aside_second-tab" data-toggle="tab" aria-controls="aside_second"><span class="text-black-50 aside_title"><h4 class="bar">최신댓글</h4></span></a>
						</li>
						<?php
						?>
					</ul>
				
					<!-- Content Panel -->
					<div id="clothing-nav-content" class="tab-content border-left border-right">
						<div role="tabpanel" class="tab-pane fade show active py-3" id="aside_first" aria-labelledby="aside_first-tab">
								<!-- 탭 1의 최신글 지정: 스킨 , 게시판 아이디, 출력 라인,  글자 수(0: 자동 조절됨), 캐시 시간(1), 옵션(앞의 탭의 번호와 같은 값(1) 지정: 중요!) -->
								<?php
									// new_latest('스킨', '출력라인', '글자수', 'is_comment', cache_minute)
									echo new_latest("theme/tab_aside", 6, 13,false,5);
								?>
						</div>
						<div role="tabpanel" class="tab-pane fade py-3" id="aside_second" aria-labelledby="aside_second-tab">
								<!-- 탭 2의 최신글 지정: 스킨 , 게시판 아이디, 출력 라인,  글자 수(0: 자동 조절됨), 캐시 시간(1), 옵션(앞의 탭의 번호와 같은 값(2) 지정: 중요!) -->
								<?php
								// new_latest('스킨', '출력라인', '글자수', 'is_comment', cache_minute)
								echo new_latest('theme/tab_aside', 6, 15,true,5);
								?>
						</div>
					</div>
				</div>
				<!-- End of Tab New Latest -->
				
				<!-- bxSlider -->
				<?php echo latest('theme/webzine_bxslider', 'gallery', 3, 0); ?>
				<!-- End of bxSlider -->
				
			<?php } else { ?>
			<!-- Index가 아닐 때의 aside -->
				<div id="mysubmenu">
					<div class="text-center">
						<img class="img-fluid" src="<?php echo G5_THEME_IMG_URL ?>/aside_top.png">
					</div>
					
					<!-- 
					<ul id="mysub" class="mb-1">
						<?php
				        //공지사항
				        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
				        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
				        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
				        ?>
						<li class=""><?php echo latest('theme/notice', 'basic', 4, 13); ?></li>
			  		</ul>
			  		-->
			
					<?php
					$sql = " select *  from ".$g5['menu_table']."
						where me_use = '1'
						and length(me_code) = '2'
						order by me_order, me_id ";
					$result = sql_query($sql, false);
					$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
			
					for ($i=0; $row=sql_fetch_array($result); $i++) {
			  		?>
					    <ul id="mysub<?php echo $i ?>" style="display:none;">
							<!--
							<li class="leftmenu_b"> <a class="dropdown-item" href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name']; ?></a></li>
								-->
							<li class="leftmenu_b"> <a class="dropdown-item" href="#"><?php echo $row['me_name']; ?></a></li>
							<?php
							$sql2 = " select * from ".$g5['menu_table']."
							where me_use = '1'
							and length(me_code) = '4'
							and substring(me_code, 1, 2) = '".$row['me_code']."'
							order by me_order, me_id ";
							$result2 = sql_query($sql2);
							
							//좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌
							if ( ($row['me_name']==$board['bo_subject'])||($row['me_name']==$g5['title']) ) {
								//if(strpos($row['me_link'], $_GET['bo_table']) !== false) {
								echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> ");
							}
					       
							for ($k=0; $row2=sql_fetch_array($result2); $k++) {
								if($k == 0) {
								  echo '<ul>'.PHP_EOL;
								}
								?>
								<li class="leftmenu_s"
								<?php
								if ($row2['me_link']) {
									$me_link0 = explode("=",$row2['me_link']);
									if ( ($me_link0[1]==$board['bo_table'])||($me_link0[1]==$co_id) ) {
										//if(strpos($row2['me_link'], $_GET['bo_table']) !== false) {
										echo " style='background-color:#eff3ff;'";
									}
								} else {   
									if ( ($row2['me_name']==$board['bo_subject'])||($row2['me_name']==$g5['title']) ) {
										//if ( strpos($row2['me_link'], $_GET['bo_table']) !== false ) {
										echo " style='background-color:#eff3ff;'";
									}
								}
								?>>
								<a class="dropdown-item" href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name']; ?></a>
								</li>
								
								<?php
								//좌측 서브메뉴 전체 리스트에서 현재 페이지에 해당하는 대메뉴 리스트만 보여줌
								if ($row2['me_link']) {
									$me_link0 = explode("=",$row2['me_link']);
									if ( ($me_link0[1]==$board['bo_table'])||($me_link0[1]==$co_id) ) {
										//if(strpos($row2['me_link'], $_GET['bo_table']) !== false) {
										echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> ");
									}
								} else {   
									if ( ($row2['me_name']==$board['bo_subject'])||($row2['me_name']==$g5['title']) ) {
										//if(strpos($row2['me_link'], $_GET['bo_table']) !== false) {
										echo ("<script language='javascript'> display_submenu(" .$i. " ); </script> ");
									}
								}
							} // End of for
					       
							if($k > 0) {
								echo '</ul>'.PHP_EOL;
							}
							?>
					    </ul>
					<?php
					}
					?>
				</div>
			<?php } ?>
			
			<!-- aside에 배너를 추가하는 경우
			<div class="row banner">
				<img src="<?php echo G5_THEME_URL ?>/asset/images/main/banner_01.png" alt="Banner">
			</div>
			-->
			
			<div class="mt-4 gap">
				<?php echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
			</div>
			<div class="mt-4 mb-2 pb-3 gap">
				<?php echo visit('theme/basic'); // 접속자집계, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
			</div>
		</div> <!-- End of Aside Column -->
		    
		<!-- Content Column -->
		<div class="col-lg-9">
