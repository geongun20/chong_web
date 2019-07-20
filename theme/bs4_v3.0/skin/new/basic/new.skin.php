<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$new_skin_url.'/style.css">', 0);
?>

<div class="container pt-3">
<div class="section-header page">	
<h3><?php echo $g5['title'] ?></h3>
</div>

<!-- 전체게시물 검색 시작 { -->
<div id="new_sch">

	<form class="form-inline justify-content-center" name="fnew" id="fnew" method="get">
		
		<!-- <?php echo $group_select ?> -->
		<label for="gr_id" class="sound_only">그룹</label>
		<select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="gr_id" id="gr_id">
			<option value="">전체그룹
			<option value="board">보드
			<option value="page">페이지
		</select>
		
		<select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="view" id="view">
			<option value="">전체게시물</option>
			<option value="w">원글만</option>
			<option value="c">코멘트만</option>
  		</select>

  		<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="mb_id" value="<?php echo $mb_id ?>" id="mb_id" required>

  		<button type="submit" class="btn btn-primary">검색</button>

	</form>

	<p>회원 아이디만 검색 가능</p>
  
</div>

    <script>
    /* 셀렉트 박스에서 자동 이동 해제
    function select_change()
    {
        document.fnew.submit();
    }
    */
    document.getElementById("gr_id").value = "<?php echo $gr_id ?>";
    document.getElementById("view").value = "<?php echo $view ?>";
    </script>

<!-- } 전체게시물 검색 끝 -->

<!-- 전체게시물 목록 시작 { -->
<form name="fnewlist" id="fnewlist" method="post" action="#" onsubmit="return fnew_submit(this);">
<input type="hidden" name="sw"       value="move">
<input type="hidden" name="view"     value="<?php echo $view; ?>">
<input type="hidden" name="sfl"      value="<?php echo $sfl; ?>">
<input type="hidden" name="stx"      value="<?php echo $stx; ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
<input type="hidden" name="page"     value="<?php echo $page; ?>">
<input type="hidden" name="pressed"  value="">

<div class="row">
    <table class="table table-bordered table-striped">
    <thead>
    <tr>
        <?php if ($is_admin) { ?>
        <th>
            <label for="all_chk" class="sound_only">목록 전체</label>
            <input type="checkbox" id="all_chk">
        </th>
        <?php } ?>
        <th class="d-none d-sm-none d-md-table-cell">그룹</th>
        <th>게시판</th>
        <th>제목</th>
        <th class="d-none d-sm-none d-md-table-cell">이름</th>
        <th>일시</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i<count($list); $i++)
    {
        $num = $total_count - ($page - 1) * $config['cf_page_rows'] - $i;
        $gr_subject = cut_str($list[$i]['gr_subject'], 20);
        $bo_subject = cut_str($list[$i]['bo_subject'], 20);
        $wr_subject = get_text(cut_str($list[$i]['wr_subject'], 80));
    ?>
    <tr>
        <?php if ($is_admin) { ?>
        <td class="td_chk">
            <label for="chk_bn_id_<?php echo $i; ?>" class="sound_only"><?php echo $num?>번</label>
            <input type="checkbox" name="chk_bn_id[]" value="<?php echo $i; ?>" id="chk_bn_id_<?php echo $i; ?>">
            <input type="hidden" name="bo_table[<?php echo $i; ?>]" value="<?php echo $list[$i]['bo_table']; ?>">
            <input type="hidden" name="wr_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['wr_id']; ?>">
        </td>
        <?php } ?>
        <td class="td_group d-none d-sm-none d-md-table-cell"><a href="./new.php?gr_id=<?php echo $list[$i]['gr_id'] ?>"><?php echo $gr_subject ?></a></td>
        <td class="td_board"><a href="./board.php?bo_table=<?php echo $list[$i]['bo_table'] ?>"><?php echo $bo_subject ?></a></td>
        <td class="text-left"><a href="<?php echo $list[$i]['href'] ?>" class="new_tit"><?php echo $list[$i]['comment'] ?><?php echo $wr_subject ?></a></td>
        <td class="td_name d-none d-sm-none d-md-table-cell"><?php echo $list[$i]['name'] ?></td>
        <td class="td_date"><?php echo $list[$i]['datetime2'] ?></td>
    </tr>
    <?php }  ?>

    <?php if ($i == 0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

<?php if ($is_admin) { ?>
<div class="sir_bw02 sir_bw">
    <button type="submit" onclick="document.pressed=this.title" title="선택삭제" class="btn btn-raised btn-secondary"><i class="far fa-trash-alt" aria-hidden="true"></i><span class="sound_only">선택삭제</span></button>
</div>
<?php } ?>
</form>

<?php if ($is_admin) { ?>
<script>
$(function(){
    $('#all_chk').click(function(){
        $('[name="chk_bn_id[]"]').attr('checked', this.checked);
    });
});

function fnew_submit(f)
{
    f.pressed.value = document.pressed;

    var cnt = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_bn_id[]" && f.elements[i].checked)
            cnt++;
    }

    if (!cnt) {
        alert(document.pressed+"할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if (!confirm("선택한 게시물을 정말 "+document.pressed+" 하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다")) {
        return false;
    }

    f.action = "./new_delete.php";

    return true;
}
</script>
<?php } ?>

<!-- 페이지 -->
<div class="mb-4">
<?php echo cm_bootstrap_paging($write_pages);  ?>
</div>

</div>
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
<!-- } 전체게시물 목록 끝 -->