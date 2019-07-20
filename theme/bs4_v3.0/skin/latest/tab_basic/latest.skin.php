<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

<!-- 최신글 함수의 $options(옵션) 값에 해당하는 span id에 제목을 자동 입력 -->
<script>
	$("#subject_<?php echo $options ?>").html("<?php echo $bo_subject ?>");
</script>

<div class="tab_lat">   
	<?php for ($i=0; $i<count($list); $i++) {  ?>
	    <div class="row">
	        <div class="col-md-6 col-xs-12"> <!-- 왼쪽 표시 -->
		        <ul>
		        		<li>
		            <?php
				        echo "<a href=\"".$list[$i]['href']."\"> ";
				        echo "<span class='lt_title'>";
			            if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
			
			            if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
			
			            if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";
						
						/*
						// 최신글 출력 시 코멘트 수가 있는 경우 줄이 바껴서 출력되는 현상을 막기 위해 제목과 코멘트 수를 하나의 문자열로 묶음
						if ($list[$i]['comment_cnt']) $list[$i]['subject'] = $list[$i]['subject']."<span class=\"lt_cmt\">+ ".$list[$i]['comment_cnt']."</span>";	
			            */
			            
			            if ($list[$i]['is_notice'])
			                echo "<strong>".$list[$i]['subject']."</strong>";
			            else
			                echo $list[$i]['subject'];
		                	echo "</span>";
			            echo "</a>";
			
			            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
			            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
			
			            //echo $list[$i]['icon_reply']." ";
						// if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
			            //if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;
			
						// 위에서 코멘트 수를 제목과 합쳐 하나의 문자열로 만들었기에 출력을 중복해서 하지 않도록 주석 처리함
			            // if ($list[$i]['comment_cnt'])  echo "
			            // <span class=\"lt_cmt\">+ ".$list[$i]['comment_cnt']."</span>";
			            ?>
			            <span class="lt_date"><span class="lt_cmt"><?php echo $list[$i]['comment_cnt'] ?></span><i class="fa fa-clock"></i> <?php echo $list[$i]['datetime2'] ?></span>
		        		</li>
		        </ul>
	        </div> <!-- End of col-6 -->
	        
	        <?php $i++?>
	        
			<div class="col-md-6 col-xs-12"> <!-- 오른쪽 표시 -->
				<ul>
					<li>
				        <?php
				        echo "<a href=\"".$list[$i]['href']."\"> ";
				        echo "<span class='lt_title'>";
			            if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
			
			            if ($list[$i]['icon_new']) echo "<span class=\"new_icon\">N<span class=\"sound_only\">새글</span></span>";
			
			            if ($list[$i]['icon_hot']) echo "<span class=\"hot_icon\">H<span class=\"sound_only\">인기글</span></span>";
						
						/*
						// 최신글 출력 시 코멘트 수가 있는 경우 줄이 바껴서 출력되는 현상을 막기 위해 제목과 코멘트 수를 하나의 문자열로 묶음
						if ($list[$i]['comment_cnt']) $list[$i]['subject'] = $list[$i]['subject']."<span class=\"lt_cmt\">+ ".$list[$i]['comment_cnt']."</span>";	
			            */
			            
			            if ($list[$i]['is_notice'])
			                echo "<strong>".$list[$i]['subject']."</strong>";
			            else
			                echo $list[$i]['subject'];
		             	echo "</span>";
			            echo "</a>";
			
			            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
			            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }
			
			            //echo $list[$i]['icon_reply']." ";
						// if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ;
			            //if ($list[$i]['icon_link']) echo " <i class=\"fa fa-link\" aria-hidden=\"true\"></i>" ;
			
						// 위에서 코멘트 수를 제목과 합쳐 하나의 문자열로 만들었기에 출력을 중복해서 하지 않도록 주석 처리함
			            // if ($list[$i]['comment_cnt'])  echo "
			            // <span class=\"lt_cmt\">+ ".$list[$i]['comment_cnt']."</span>";
			            ?>
						<span class="lt_date"><span class="lt_cmt"><?php echo $list[$i]['comment_cnt'] ?></span><i class="fa fa-clock"></i> <?php echo $list[$i]['datetime2'] ?></span>
		            </li>
				</ul>
	        </div> <!-- End of col-6 -->
	    </div> <!-- End of row -->
	<?php }  ?>
	<?php if (count($list) == 0) { //게시물이 없을 때  ?>
			<div class="text-center">게시물이 없습니다.</div>
	<?php }  ?>
</div>
