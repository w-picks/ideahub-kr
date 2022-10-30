<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>
<div class="ol">
  <a href="<?php echo G5_BBS_URL ?>/login.php" class="btn_s" style="padding-right: 10px;">로그인</a>
  <a href="<?php echo G5_BBS_URL ?>/register.php" class="btn_s " style="padding-left: 10px;">회원가입</a>
  <a href="<?php echo G5_BBS_URL ?>/faq.php" class="btn_s contact_us" style="padding-left: 10px;">문의하기</a>
  <a href="<?php echo G5_URL ?>" style="border-right:1px solid #8496ba; height:10px; line-height:10px;">kr</a>
 <a href="<?php echo G5_URL ?>/eng" style="height:10px; line-height:10px;">en</a>
</div>
