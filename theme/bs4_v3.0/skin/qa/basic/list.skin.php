<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨

?>

<!-- 게시판 목록 시작 { -->
<div class="container pt-3">
	<div id="bo_list">
		
	<div class="section-header page">	
	<h3><?php echo $g5['title'] ?></h3>
	</div>
	
	     <!-- 게시판 페이지 정보 및 버튼 시작 { -->
	    <div id="bo_btn_top">
	        <div id="bo_list_total">
	            <span>Total <?php echo number_format($total_count) ?>건</span>
	            <?php echo $page ?> 페이지
	        </div>
	
	        <?php if ($admin_href || $write_href) { ?>
	        <ul class="btn_bo_user">
		        <li><button class="btn btn-raised btn-default btn-sm" data-toggle="modal" data-target="#cm_search_form" alt="검색"><i class="fa fa-search"></i></button></li>
	            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn btn-raised btn-info btn-sm">관리자</a></li><?php } ?>
	            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn btn-raised btn-primary btn-sm">문의등록</a></li><?php } ?>
	        </ul>
	        <?php } ?>
	    </div>
	    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
	
	    <?php if ($category_option) { ?>
	    <!-- 카테고리 시작 { -->
	    <nav id="bo_cate">
	        <h2><?php echo $qaconfig['qa_title'] ?> 카테고리</h2>
	        <ul id="bo_cate_ul">
	            <?php echo $category_option ?>
	        </ul>
	    </nav>
	    <!-- } 카테고리 끝 -->
	    <?php } ?>
	
	    <form name="fqalist" id="fqalist" action="./qadelete.php" onsubmit="return fqalist_submit(this);" method="post">
	    <input type="hidden" name="stx" value="<?php echo $stx; ?>">
	    <input type="hidden" name="sca" value="<?php echo $sca; ?>">
	    <input type="hidden" name="page" value="<?php echo $page; ?>">
	
	
	        <table class="table table-bordered table-sm th-cen">
	        <thead>
	        <tr>
	            <?php if ($is_checkbox) { ?>
	            <th scope="col">
	                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
	                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
	            </th>
	            <?php } ?>
	            <th scope="col" class="d-none d-sm-none d-md-table-cell">번호</th>
	            <th scope="col">제목</th>
	            <th scope="col" class="d-none d-sm-none d-md-table-cell">글쓴이</th>
	            <th scope="col" class="d-none d-sm-none d-md-table-cell">등록일</th>
	            <th scope="col">상태</th>
	        </tr>
	        </thead>
	        <tbody>
	        <?php
	        for ($i=0; $i<count($list); $i++) {
	        ?>
	        <tr>
	            <?php if ($is_checkbox) { ?>
	            <td class="cen">
	                <label for="chk_qa_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject']; ?></label>
	                <input type="checkbox" name="chk_qa_id[]" value="<?php echo $list[$i]['qa_id'] ?>" id="chk_qa_id_<?php echo $i ?>">
	            </td>
	            <?php } ?>
	            <td class="cen d-none d-sm-none d-md-table-cell"><?php echo $list[$i]['num']; ?></td>
	            <td class="qa_link">
	                <span><?php echo $list[$i]['category']; ?></span>
	                <a href="<?php echo $list[$i]['view_href']; ?>" class="bo_tit">
	                    <?php echo $list[$i]['subject']; ?>
	                    <?php if ($list[$i]['icon_file']) echo " <i class=\"fa fa-download\" aria-hidden=\"true\"></i>" ; ?>
	                </a>
	            </td>
	            <td class="cen d-none d-sm-none d-md-table-cell"><?php echo $list[$i]['name']; ?></td>
	            <td class="cen d-none d-sm-none d-md-table-cell"><?php echo $list[$i]['date']; ?></td>
	            <td class="cen"><span class=" <?php echo ($list[$i]['qa_status'] ? 'txt_done' : 'txt_rdy'); ?>"><?php echo ($list[$i]['qa_status'] ? '<i class="fa fa-check-circle" aria-hidden="true"></i> 답변완료' : '<i class="fa fa-times-circle" aria-hidden="true"></i> 답변대기'); ?></span></td>
	        </tr>
	        <?php
	        }
	        ?>
	
	        <?php if ($i == 0) { echo '<tr><td colspan="'.$colspan.'" class="text-center">게시물이 없습니다.</td></tr>'; } ?>
	        </tbody>
	        </table>
	
	
	    <div class="bo_fx">
	        <ul class="btn_bo_user">
	            <?php if ($is_checkbox) { ?>
	            <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-raised btn-secondary btn-sm">선택삭제</button></li>
	            <?php } ?>
	            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn btn-raised btn-secondary btn-sm">목록</a></li><?php } ?>
	            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn btn-raised btn-primary btn-sm">문의등록</a></li><?php } ?>
	        </ul>
	    </div>
	    <div style="clear: both"></div>
	    </form>
	</div>
	
	
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
	                    <input type="hidden" name="sca" value="<?php echo $sca ?>">
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
	                        <input type="hidden" name="sca" value="<?php echo $sca ?>">
	                        <div class="input-group">
	
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
</div>
<!-- } 게시판 검색 끝 -->

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $list_pages;  ?>


<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fqalist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]")
            f.elements[i].checked = sw;
    }
}

function fqalist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
            return false;
    }

    return true;
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

<!-- } 게시판 목록 끝 -->