<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if ($config['cf_2']) include_once(G5_THEME_PATH.'/aside.php');
?>

<link href="<?php echo $board_skin_url ?>/style.css" rel="stylesheet">

<!-- Page Content -->
<div class="container py-3">
<div class="section-header page">	
<h3><?php echo $board['bo_subject'] ?></h3>
</div>	
<section id="bo_w">

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) {
        $option = '';
        
        if ($is_notice) {
            $option .= "\n".'<div class="form-check form-check-inline">'."\n".'<input type="checkbox" class="form-check-input" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label class="form-check-label" for="notice">공지</label>'."\n".'</div>';
        }

        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= "\n".'<div class="form-check form-check-inline">'."\n".'<input type="checkbox" class="form-check-input" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label class="form-check-label" for="html">html</label>'."\n".'</div>';
            }
        }

        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= "\n".'<div class="form-check form-check-inline">'."\n".'<input type="checkbox" class="form-check-input" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label class="form-check-label" for="secret">비밀글</label>'."\n".'</div>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }

        if ($is_mail) {
            $option .= "\n".'<div class="form-check form-check-inline">'."\n".'<input type="checkbox" class="form-check-input" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label class="form-check-label" for="mail">답변메일받기</label>'."\n".'</div>';
        }
    }

    echo $option_hidden;
    ?>
    
	<div class="row">
		<?php if ($is_name) { ?>
			<div class="form-group label-floating col-6">
			    <label class="control-label" for="wr_name">이름</label>
				<input type="text" class="form-control" id="wr_name" name="wr_name" value="<?php echo $name ?>" required>
			</div>
		<?php } ?>
		<?php if ($is_password) { ?>
			<div class="form-group label-floating col-6">
			    <label class="control-label" for="wr_password">비밀번호</label>
			    <input type="password" class="form-control" name="wr_password" id="wr_password" <?php echo $password_required ?>>
			</div>
		<?php } ?>
	</div>

<!--
	<?php if ($is_email) { ?>
		<div class="form-group label-floating">
		    <label class="control-label" for="wr_email">이메일</label>
			<input type="text" class="form-control" name="wr_email" id="wr_email" value="<?php echo $email ?>">
		</div>
	<?php } ?>

	<?php if ($is_homepage) { ?>
		<div class="form-group label-floating">
		    <label class="control-label" for="wr_homepage">홈페이지</label>
			<input type="text" class="form-control" id="wr_homepage" id="wr_homepage" value="<?php echo $homepage ?>">
		</div>
	<?php } ?>
-->

	<?php if ($option) { ?>
	<div class="form-group opt">
		<label class="sound_only">옵션: </label>
		<?php echo $option ?>
	</div>
	<?php } ?>
	
	<?php if ($is_category) { ?>
	<div class="form-row mt-3 mb-4">
		<select class="small"  name="ca_name" id="ca_name" required>
			<option data-display="분류" value="#">분류</option>
			<?php echo $category_option ?>
		</select>
	</div>
	<?php } ?>

	<div class="form-group label-floating">
	    <label class="control-label" for="wr_subject">제목</label>
		<input type="text" class="form-control" name="wr_subject" id="wr_subject" value="<?php echo $subject ?>">
		<div id="autosave_wrapper">
            <?php if ($is_member) { // 임시 저장된 글 기능 ?>
            <script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
            <?php if($editor_content_js) echo $editor_content_js; ?>
            <button type="button" id="btn_autosave" class="btn btn-raised btn-secondary btn_frmline btn_autosave">임시 저장된 글 (<span id="autosave_count"><?php echo $autosave_count; ?></span>)</button>
            <div id="autosave_pop">
                <strong>임시 저장된 글 목록</strong>
                <ul></ul>
                <div><button type="button" class="autosave_close"><img src="<?php echo $board_skin_url; ?>/img/btn_close.gif" alt="닫기"></button></div>
            </div>
            <?php } ?>
        </div>
	</div>
  
	<div class="form-group label-floating">
	    <label class="control-label" for="wr_content">내용</label>
                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                <?php } ?>
				<?php echo str_replace('class=""', 'class="form-control rounded-0" rows="10"', $editor_html); // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>

                <?php if($write_min || $write_max) { ?>
                <!-- 최소/최대 글자 수 사용 시 -->
                <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                <?php } ?>
	</div>

    <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
	<div class="form-group label-floating">
	    <label class="control-label" for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label>
		<input type="text" class="form-control" id="wr_link<?php echo $i ?>" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>">
	</div>
    <?php } ?>
  				
    <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
	<div class="form-group">
		<div class="input-group-prepend">
			<span class="input-group-text" id="inputGroupFileAddon01">파일 첨부</span>
		</div>
		<div class="custom-file">
		<!-- 업로드한 파일명이 보이지 않는 문제 수정 (18-12-22) -->
		<input type="file" class="custom-file-input" id="inputGroupFile<?php echo $i ?>" aria-describedby="inputGroupFileAddon01" name="bf_file[]">
	    <label class="custom-file-label" for="bf_file[]">파일 #<?php echo $i+1 ?></label>
		</div>
		<!-- 업로드한 파일명이 보이지 않는 문제 수정 (18-12-22) -->
    <script>
      $('#inputGroupFile<?php echo $i ?>').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
      })
    </script>
		
        <?php if ($is_file_content) { ?>
        <?php } ?>
        <?php if($w == 'u' && $file[$i]['file']) { ?>
        <div class="form-check form-check-inline">
	    <label class="form-check-label" for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
		<input type="checkbox" class="form-check-input" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1">
        </div>
        <?php } ?>
	</div>
	<?php } ?>

    <?php if ($is_guest) { //자동등록방지  ?>
	<div class="form-group" style="text-align: center;padding: 10px 0; ">
		<?php echo $captcha_html ?>
	</div>
    <?php } ?>
    
	<div class="text-center mb-4 mt-4">
		<button type="submit" id="btn_submit" accesskey="s" class="btn btn-raised btn-primary btn-sm">작성완료</button>
		<a class="btn btn-raised btn-secondary btn-sm" href="./board.php?bo_table=<?php echo $bo_table ?>">취소</a>
	</div>
    </form>
</section>
</div>

<script>
$(document).ready(function() {
$('select').niceSelect();      
FastClick.attach(document.body);
});  

<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});

<?php } ?>
function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f)
{
    <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

    <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>
<!-- } 게시물 작성/수정 끝 -->