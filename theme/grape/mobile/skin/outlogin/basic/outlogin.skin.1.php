<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>
<div class="ol">
  <a href="<?php echo G5_BBS_URL ?>/login.php" class="btn_s" style="padding-right: 10px;">Login</a>
  <span>|</span>
  <a href="<?php echo G5_BBS_URL ?>/register.php" class="btn_s " style="padding-left: 10px;">Join</a>
</div>
