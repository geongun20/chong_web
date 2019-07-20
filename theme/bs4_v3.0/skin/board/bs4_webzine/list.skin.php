<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_LIB_PATH.'/thumbnail.lib.php');
if ($config['cf_2']) include_once(G5_THEME_PATH.'/aside.php');
?>

<link href="<?php echo $board_skin_url ?>/style.css" rel="stylesheet">

<div class="container py-3">
<div class="section-header page">	
<h3><?php echo $board['bo_subject'] ?></h3>
</div>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <li><button class="btn btn-raised btn-default btn-sm" data-toggle="modal" data-target="#cm_search_form" alt="검색"><i class="fa fa-search"></i></button></li>
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn btn-raised btn-default btn-sm">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn btn-raised btn-info btn-sm"><span style="color: white; ">관리자</span></a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn btn-raised btn-primary btn-sm"><span style="color: white; ">글쓰기</span></a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>
    <?php } ?>

	<div class="container">
        <?php for ($i=0; $i<count($list); $i++) { ?>	
			<div class="row mb-4" style="border: 1px solid #d8d8d8;">
				<div class="col-md-3" style="padding-right: 0px;">
	                <div class="wrap">
						<a class="pull-left" href="<?php echo $list[$i]['href'] ?>">
	                    <?php
		                    
							$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height'], false, true); // 원본 이미지가 아닌 썸네일을 사용하도록 수정(18-12-22)
						
							
	                        if($thumb['src']) {
	                            $img_content = '<img style="width: 100%" src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" >'; // 원본 이미지가 아닌 썸네일을 사용하도록 수정(18-12-22)
	                        } else {
								$img_content = '<img src="'.$board_skin_url.'/img/no_image.png">';
	                        }
	
	                        echo $img_content;
	                     ?>
						</a>	
	                </div>
        			</div> <!-- End of col-md-3 -->
				<div class="col-md-9 wz_title">
					<h4><?php echo $list[$i]['subject'] ?>
					<?php if ($list[$i]['comment_cnt']) { ?><span class="cnt_cmt"> +<?php echo $list[$i]['comment_cnt'];?></span><?php } ?>
						<span class="fa-xs">
							<?php
		                    // if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
		                    // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
		
		                    if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
		                    if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
		                    if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
		                    if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
		                    if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];						
	                    ?>
						</span>
					</h4>
					<p>
						<span class="max-lines">
						<?php echo cut_str(strip_tags($list[$i][wr_content]),140," . . . ") ?>
						</span>
					</p>

					 <p class="by-author" style="padding-top: 10px; font-size: 0.9em; ">
						 <?php echo $list[$i]['name'] ?> / <?php echo $list[$i]['datetime2'] ?> / <?php echo $list[$i]['wr_hit'] ?>
						 <?php if ($is_good) { ?><span class="gall_subject">추천</span><strong><?php echo $list[$i]['wr_good'] ?></strong><br /><?php } ?>
						 <?php if ($is_nogood) { ?><span class="gall_subject">비추천</span><strong><?php echo $list[$i]['wr_nogood'] ?></strong><?php } ?>
						 <?php
						 // echo $list[$i]['icon_reply']; 갤러리는 reply 를 사용 안 할 것 같습니다. - 지운아빠 2013-03-04
						 if ($is_category && $list[$i]['ca_name']) {
	                			?>
							<?php echo $list[$i]['ca_name'] ?>
						<?php } ?>
						<br />
						<?php if ($is_checkbox) { ?>
							<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
							<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
						<?php } ?>
					</p>
		  		</div> <!-- End of col-md-9 -->
      		</div><!-- End of row -->	
        <?php } ?>
       <?php if (count($list) == 0) { echo "<div class=\"text-center\">게시물이 없습니다.</div>"; } ?>
	</div><!-- End of container -->

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm mb-4">
            <li><button type="submit" name="btn_submit" value="선택삭제" class="btn btn-raised btn-secondary btn-sm" onclick="document.pressed=this.value">선택삭제</button></li>
            <li><button type="submit" name="btn_submit" value="선택복사" class="btn btn-raised btn-secondary btn-sm" onclick="document.pressed=this.value">선택복사</button></li>
            <li><button type="submit" name="btn_submit" value="선택이동" class="btn btn-raised btn-secondary btn-sm" onclick="document.pressed=this.value">선택이동</button></li>
        </ul>
        <?php } ?>

        <ul class="btn_bo_user mb-4">
	        <li><button type="button" class="btn btn-raised btn-default btn-sm" data-toggle="modal" data-target="#cm_search_form" alt="검색"><i class="fa fa-search"></i></button></li>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn btn-raised btn-info btn-sm">관리자</a></li><?php } ?>
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn btn-raised btn-secondary btn-sm">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn btn-raised btn-primary btn-sm">글쓰기</a></li><?php } ?>
        </ul>
    </div>
    <?php } ?>
    </form>


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 게시판 검색 시작 { -->
<!-- 페이지 -->
<div class="mb-4">
<?php echo cm_bootstrap_paging($write_pages);  ?>
</div>

<!-- Modal -->
<div class="modal fade" id="cm_search_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo $board['bo_subject']; ?> 검색
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">


                <form name="fsearch" method="get">

                    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                    <input type="hidden" name="sca" value="<?php echo $sca ?>">
                    <input type="hidden" name="sop" value="and">

                    <div class="form-group">
                        <label for="sfl" class="sound_only1">검색대상</label>

                        <select name="sfl" id="sfl" class="form-control input-sm">
                            <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
                            <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
                            <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
                            <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
                            <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
                            <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
                            <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="stx" class="sound_only1">검색어<strong class="sound_only"> 필수</strong></label>
                        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="form-control input-sm" maxlength="20">
                    </div>

                    <button class="btn btn-raised btn-danger" type="submit">
                        검색
                    </button>

                </form>

                <?php if(0) { ?>
                    <form name="fsearch" method="get">

                        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                        <input type="hidden" name="sca" value="<?php echo $sca ?>">
                        <input type="hidden" name="sop" value="and">

                        <div class="input-group">

                            <label for="sfl" class="sound_only">검색대상</label>

                            <select name="sfl" id="sfl" class="input-sm">
                                <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
                                <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
                                <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
                                <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
                                <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
                                <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
                                <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
                            </select>

                            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                            <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="form-control input-sm" maxlength="20">
                            <button class="btn btn-danger" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>

                        </div>
                    </form>
                <?php } ?>
            </div>

        </div>
    </div>
</div>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>

<?php
function cm_bootstrap_paging($pagelist)
{
    $pagelist = str_replace('<nav class="pg_wrap"><span class="pg">', '<div class="text-center"><ul class="pagination justify-content-center">', $pagelist);
    $pagelist = str_replace('</span></nav>', '</ul></div>', $pagelist);
    $pagelist = str_replace('<a', '<li class="page-item"><a class="page-link"', $pagelist);
    $pagelist = str_replace('</a>', '</a></li>', $pagelist);
    $pagelist = str_replace(' class="pg_page"', '', $pagelist);
    $pagelist = preg_replace('/(<span[^\>]*>(.*?)<\/span>)/', '', $pagelist);
    $pagelist = preg_replace('/( class="pg_page [^"]+")/', '', $pagelist);
    $pagelist = preg_replace('/(<strong[^\>]*>(.*?)<\/strong>)/', '<li class="page-item active"><a class="page-link">\2</a></li>', $pagelist);
    return $pagelist;
}
?>

</div>
</div>
<!-- } 게시판 목록 끝 -->
