<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$faq_skin_url.'/style.css">', 0);
?>

<!-- FAQ 시작 { -->
<?php
// 상단 HTML
echo '<div class="bo_top_img">'.conv_content($fm['fm_mobile_head_html'], 1).'</div>';
?>


<?php
if( count($faq_master_list) ){
?>

<!-- <nav id="bo_cate">
    <h2>자주하시는질문 분류</h2>
    <ul id="bo_cate_ul">
        <?php
        foreach( $faq_master_list as $v ){
            $category_msg = '';
            $category_option = '';
            if($v['fm_id'] == $fm_id){ // 현재 선택된 카테고리라면
                $category_option = ' id="bo_cate_on"';
                $category_msg = '<span class="sound_only">열린 분류 </span>';
            }
        ?>
        <li><a href="<?php echo $category_href;?>?fm_id=<?php echo $v['fm_id']?>" <?php echo $category_option;?> ><?php echo $category_msg.$v['fm_subject'];?></a></li>
        <?php
        }
        ?>
    </ul>
</nav> -->
<?php } ?>

<div id="faq_wrapper">

<div class="faq_tit">
<h1><?php echo $category_msg.$v['fm_subject'];?></h1>
<a href="<?php echo G5_BBS_URL ?>/qawrite.php" class="direct_btn">1:1 문의<img src="<?php echo G5_IMG_URL ?>/ico_direct_faq.svg"></a>
</div>


<div id="faq_wrap" class="faq_<?php echo $fm_id; ?>">
 
    <div id="faq_sch">
        <form name="faq_search_form" method="get">
        <input type="hidden" name="fm_id" value="<?php echo $fm_id;?>">
        <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <input type="text" name="stx" value="<?php echo $stx;?>" required id="stx" class="frm_input" size="15" maxlength="15" placeholder="궁금한 점을 입력하세요!">
        <button type="submit" value="검색" class="btn_submit"><img src="<?php echo G5_IMG_URL ?>/ico_search.svg"><span class="sound_only">검색</span></button>
        </form>
    </div>
   <?php // FAQ 내용
    if( count($faq_list) ){
    ?>
    <section id="faq_con">
        <h2><?php echo $g5['title']; ?> 목록</h2>
        <ol>
            <?php
            foreach($faq_list as $key=>$v){
                if(empty($v))
                    continue;
            ?>
            <li>
            <a href="#none" onclick="return faq_open(this);" class="on">
            <h3>Q. <?php echo conv_content($v['fa_subject'], 1); ?></h3>
                <img src="<?php echo G5_IMG_URL ?>/ico_faq_arrow.svg"></a>
                <div class="con_inner">
                    
                    <?php echo conv_content($v['fa_content'], 1); ?>
                    <!-- <div class="con_closer"><button type="button" class="closer_btn">닫기</button></div> -->
                </div>
            </li>
            <?php
            }
            ?>
        </ol>
    </section>
    <?php

    } else {
        if($stx){
            echo '<p class="empty_list">검색된 게시물이 없습니다.</p>';
        } else {
            echo '<div class="empty_table">등록된 FAQ가 없습니다.';
            if($is_admin)
                echo '<br><a href="'.G5_ADMIN_URL.'/faqmasterlist.php">FAQ를 새로 등록하시려면 FAQ관리</a> 메뉴를 이용하십시오.';
            echo '</div>';
        }
    }
    ?>
</div>

</div>

<?php echo get_paging($page_rows, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<?php
// 하단 HTML
echo '<div id="faq_thtml">'.conv_content($fm['fm_mobile_tail_html'], 1).'</div>';
?>


<!-- } FAQ 끝 -->

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script>
$(function() {
    $(".con_inner").hide();
    $(".closer_btn").on("click", function() {
        $(this).closest(".con_inner").slideToggle();
    });
});

function faq_open(el)
{
    var $con = $(el).closest("li").find(".con_inner");


    if($con.is(":visible")) {
        $con.slideUp();
        $(el).addClass("on");
        console.log(true)
    } else {
        console.log(false)
        $(el).removeClass("on");

        $("#faq_con .con_inner:visible").css("display", "none");

        $con.slideDown(
            function() {
                // 이미지 리사이즈
                $con.viewimageresize2();
            }
        );
    }

    return false;
}

        $("#faq_sch .btn_submit").on("click", (e)=>{
            if(window.innerWidth < 969){
                if(!$("#faq_sch").hasClass("on")){
                    e.preventDefault();
                    $("#faq_sch").addClass("on")
                    // $("#faq_con").css({marginTop:"91px"})
                }
            }
        })
        
        $("#faq_sch").on("click", (e)=>{
            if(window.innerWidth < 969){
            if(e.target.id === "faq_sch"){
                $("#faq_sch").removeClass("on");
                // $("#faq_con").css({marginTop:"64px"})
            }
        }
        })
</script>