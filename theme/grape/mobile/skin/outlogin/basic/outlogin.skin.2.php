<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>
<div class="ol">
    <button type="button" class="prf_btn"><?php echo get_member_profile_img($member['mb_id']); ?></button>  
     <ul id="ol_after_private">
        <!-- <li>
            <a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" class="win_memo">쪽지
                <strong><?php echo $memo_not_read ?></strong>
            </a>
        </li>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/point.php" target="_blank"  class="win_point">포인트
                <strong><?php echo $point ?></strong>
            </a>
        </li>
        <li><a href="<?php echo G5_BBS_URL ?>/scrap.php" target="_blank"  class="win_scrap">스크랩</a> </li> -->
        <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" title="정보수정">정보수정</a></li>
        <!-- idea 투자리포트 -->
        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=my_investment" title="투자리포트">투자리포트</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a> </li>
        <li><?php if ($is_admin == 'super' || $is_auth) { ?><a href="<?php echo G5_ADMIN_URL ?>" class="admin">관리자</a><?php } ?></li>
    </ul>
</div>

<script>


$(".prf_btn").on("click", function() {
    $("#ol_after_private").toggle();
});

$(document).mouseup(function (e){
    var container = $("#ol_after_private");
    if( container.has(e.target).length === 0)
    container.hide();
});

</script>
