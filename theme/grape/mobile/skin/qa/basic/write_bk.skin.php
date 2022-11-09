<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$qa_skin_url.'/style.css">', 0);
?>
<section id="bo_w" class="direct_inquiry">
    
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="qa_id" value="<?php echo $qa_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">
    <?php
    $option = '';
    $option_hidden = '';
    $option = '';

    if ($is_dhtml_editor) {
        $option_hidden .= '<input type="hidden" name="qa_html" value="1">';
    } else {
        $option .= "\n".'<input type="checkbox" id="qa_html" name="qa_html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="qa_html">html</label>';
    }

    echo $option_hidden;
    ?>
<h1>궁금한 점/의견을 남겨주시면<br>빠른 시일 내에 이메일로 답변 드리겠습니다.</h1>
    <div class="form_01">
        <ul>
            <!-- <?php if ($category_option) { ?>
            <li>
                <label for="qa_category" class="sound_only">분류<strong>필수</strong></label>
                <select name="qa_category" id="qa_category" required class="required" >
                    <option value="">선택하세요</option>
                    <?php echo $category_option ?>
                </select>
            </li>
            <?php } ?> -->

            <?php if ($option) { ?>
            <!-- <li>
                <span class="sound_only">옵션</span>
                <?php echo $option; ?>
            </li> -->
            <?php } ?>


            <!-- 
                ideahub 1:1문의하기
                필드 추가
             -->
             <li>
                <label for="qa_1" class="sound_only">이름</label>
                <input type="text" name="qa_1" value="<?php echo get_text($write['qa_1']); ?>" id="qa_1" required class="frm_input required" maxlength="100" placeholder="이름">
            </li>
            <?php if ($is_email) { ?>
            <li>
                <label for="qa_email" class="sound_only">이메일</label>
                <input type="email" name="qa_email" value="" id="qa_email" <?php echo $req_email; ?> class="<?php echo $req_email.' '; ?>frm_input full_input email required" maxlength="100" placeholder="이메일" required>
                <!-- <input type="checkbox" name="qa_email_recv" value="1" id="qa_email_recv" <?php if($write['qa_email_recv']) echo 'checked="checked"'; ?>> -->
                <!-- <label for="qa_email_recv">답변받기</label> -->
            </li>
            <?php } ?>

            <?php if ($is_hp) { ?>
            <li>
                <label for="qa_hp" class="sound_only">휴대폰</label>
                <input type="text" name="qa_hp" value="<?php echo get_text($write['qa_hp']); ?>" id="qa_hp" <?php echo $req_hp; ?> class="<?php echo $req_hp.' '; ?>frm_input full_input required" size="30" placeholder="휴대폰" required>
                <?php if($qaconfig['qa_use_sms']) { ?>
                <input type="checkbox" name="qa_sms_recv" value="1" <?php if($write['qa_sms_recv']) echo 'checked="checked"'; ?>> 답변등록 SMS알림 수신
                <?php } ?>
            </li>
            <?php } ?>

            <li>
                <label for="qa_subject" class="sound_only">제목</label>
                <input type="text" name="qa_subject" value="<?php echo get_text($write['qa_subject']); ?>" id="qa_subject" required class="frm_input required" maxlength="255" placeholder="제목">
            </li>

            <li>
               <label for="qa_content" class="sound_only">내용</label>
                <!-- <div class="wr_content">
                    <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                </div> -->
                <textarea placeholder="내용을 입력하세요. (최소 10자 이상)" required class="required"></textarea>
            </li>

            <li class="bo_w_flie">
                <label>파일 첨부하기(선택)(최대 10MB)</label>
                <div class="file_wr">
                    <input type="text" value="파일없음"  readonly/>
                    <!-- <span class="lb_icon"><i class="fa fa-download" aria-hidden="true"></i><span class="sound_only">파일 #1</span></span> -->
                    <label for="file_upload" class="file_btn">파일 업로드</label>
                    <input type="file" name="bf_file[1]" title="파일첨부 1 :  용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" class="frm_file" id="file_upload">
                    <?php if($w == 'u' && $write['qa_file1']) { ?>
                    <!-- <input type="checkbox" id="bf_file_del1" name="bf_file_del[1]" value="1"> <label for="bf_file_del1"><?php echo $write['qa_source1']; ?> 파일 삭제</label> -->
                    <?php } ?>
                </div>
            </li>

            <!-- <li class="bo_w_flie">
                <div class="file_wr">
                    <span class="lb_icon"><i class="fa fa-download" aria-hidden="true"></i><span class="sound_only">파일 #2</span></span>
                    <input type="file" name="bf_file[2]" title="파일첨부 2 :  용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" class="frm_file">
                    <?php if($w == 'u' && $write['qa_file2']) { ?>
                    <input type="checkbox" id="bf_file_del2" name="bf_file_del[2]" value="1"> <label for="bf_file_del2"><?php echo $write['qa_source2']; ?> 파일 삭제</label>
                    <?php } ?>
                </div>
            </li> -->
            <li class="all_chk_option">
                <input type="checkbox" id="all_chk"/>
                <label for="all_chk" class="all_chk_label">개인정보 수집 이용에 동의</label>
                <div>
                <span>목적 문의</span> : 답변<span>제공 항목</span> : 이름,이메일 및 휴대폰번호<span>보유기간</span> : 제출 후 30일
                </div>
            </li>

        </ul>
    </div>

    <div class="write_div">
        <!-- <a href="<?php echo $list_href; ?>" class="btn btn_b01">목록</a> -->
        <button type="submit" value="제출하기" id="btn_submit" accesskey="s" class="btn btn_submit">제출하기</button>
    </div>
    </form>

    <script>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "2";
            else
                obj.value = "1";
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
                "subject": f.qa_subject.value,
                "content": f.qa_content.value
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
            f.qa_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_qa_content) != "undefined")
                ed_qa_content.returnFalse();
            else
                f.qa_content.focus();
            return false;
        }

        <?php if ($is_hp) { ?>
        var hp = f.qa_hp.value.replace(/[0-9\-]/g, "");
        if(hp.length > 0) {
            alert("휴대폰번호는 숫자, - 으로만 입력해 주십시오.");
            return false;
        }
        <?php } ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

    //input filename custom
    $("#file_upload").on("change", ()=>{
        let fileval = $("#file_upload").val();
        $(".file_wr input[type='text']").val(fileval);
    })

    </script
</section>
<!-- } 게시물 작성/수정 끝 -->