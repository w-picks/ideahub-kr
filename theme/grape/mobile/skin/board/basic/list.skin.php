<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 2;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<?php // 게시판 관리의 상단 내용
if (G5_IS_MOBILE) {
    echo '<div class="bo_top_img">';
    // 모바일의 경우 설정을 따르지 않는다.
    echo html_purifier(stripslashes($board['bo_mobile_content_head']));
    echo '</div>';

} 
?>

<style>
    #investment .sel.bo_chk.li_chk .chk_img{
        margin-top:4px;
        margin-right:4px;
    }
</style>

<?php if($board['bo_table'] == 'investment'){ ?>
    <div id="investment">
<?php } else if($board['bo_table'] == 'my_investment'){?>
    <div id="my_investment">
<?php } else if($board['bo_table'] == 'broadcast_eng' || $board['bo_table'] == 'events_notice'){ ?>
    <div id="board_eng">
<?php } else{ ?>
    <div id="notice_news">
<?php } ?>
<!-- <div id="nav">
    <div class="nav_wr"><a href="<?php echo G5_URL ?>"><i class="fa fa-home"></i> </a><span><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']); ?></span></div>
</div> -->
<h1><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']); ?></h1>
<?php if ($is_category) { ?>
<nav id="bo_cate">
    <h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
    <ul id="bo_cate_ul">
        <?php echo $category_option ?>
    </ul>
</nav>
<?php } ?>

<?php if($board['bo_table'] == 'investment') { 
    $tab_tag; // 0:전체,  1 : 오픈 예정, 2: 펀딩 중, 3: 종료
?>
    <div class="invest_tab_wrap">
        <ul class="invest_tab" >
            <li class="on" onclick="tabHandle(0, this)">전체</li>
            <li onclick="tabHandle(2, this)">펀딩 중 프로젝트</li>
            <li onclick="tabHandle(1, this)">오픈 예정 프로젝트</li>
            <li onclick="tabHandle(3, this)">종료된 프로젝트</li>
        </ul>
    </div>
<?php } ?>

<?php if($board['bo_table'] == "my_investment") {?>
    <div class="my_invest_tab_wrap">
        <ul class="my_invest_tab">
            <li class="on" onclick="myTabHandle(0, this)">투자한 프로젝트</li>
            <li onclick="myTabHandle(1, this)">공지</li>
        </ul>
    </div>
<?php } ?>



<?php if($board['bo_table']) { ?>
    <?php if($board['bo_table'] == "my_investment") {?>
        <div id="bo_list" style="display:none">
        <?php } else { ?>
            <div id="bo_list">
    <?php } ?>
    <?php if($board['bo_table'] != "my_investment") { ?>
    <article class="invest_article">
        <fieldset id="bo_sch">
            <legend>게시물 검색</legend>

            <form name="fsearch" method="get">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>
            <select name="sfl" id="sfl">
            <?php if($board['bo_table'] == 'broadcast_eng' || $board['bo_table'] == 'events_notice'){ ?>
                <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>title</option>
                <?php } else { ?>
                    <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
                    <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
                    <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
            <?php } ?>
                <!-- <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
                <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
                <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
                <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option> -->
            </select>
            <div class="input_wrap">
                <?php if($board['bo_table'] == 'broadcast_eng' || $board['bo_table'] == 'events_notice'){ ?>
                    <input name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="Please enter a search term." required id="stx" class="sch_input" size="15" maxlength="20">
                    <?php } else { ?>
                        <input name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어를 입력해주세요." required id="stx" class="sch_input" size="15" maxlength="20">
                        <?php } ?>
            <button type="submit" value="검색" class="sch_btn"><img src="<?php echo G5_IMG_URL ?>/ico_search.svg"></button>
            </div>
            </form>
        </fieldset>

        
        <div id="bo_list_total" class="pc_view">
            <span>총 <em><?php echo number_format($total_count) ?></em>
            <?php if($board['bo_table'] == 'investment') { ?>
                개의 프로젝트가 있습니다.
                <?php } else { ?>
                    건
                    <?php } ?>
            </span>
        </div>
    </article>
    <?php } ?>

    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <div class="board_list">
        <?php if ($is_checkbox) { ?>
        <div class="all_chk">
            <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            <label for="chkall"><span class="chk_img"></span> 전체선택</label>
        </div>
        <?php } ?>
        <ul class="project_list">
            <?php
            for ($i=0; $i<count($list); $i++) {
                // 투자하기 리스트 ideahub
                if($_GET['bo_table'] == 'investment') {
                    ?>
                    
                    <?php
                        $success_tag = $list[$i]['wr_3'] < $list[$i]['wr_4'];
                        $now = strtotime(date("Y-m-d"));
                        $target_start = strtotime(date('Y-m-d', strtotime($list[$i]['wr_1'])));
                        $target_end = strtotime(date('Y-m-d', strtotime($list[$i]['wr_2'])));
                        if($now < $target_start) {
                            $tab_tag = 1;
                        ?>
                        <?php     
                        } else if($now > $target_end) {
                            $tab_tag = 3;
                        ?>
                        <?php
                        } else if($success_tag == 1) {
                            $tab_tag = 2;
                        ?>
                        <?php
                        } else if($now > $target_start && $now < $target_end) {
                            $tab_tag = 2;
                        ?>
                        <?php
                        } 
                        ?>
                <li class="tabTag_<?php echo $tab_tag ?><?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>  <?php if ($is_category && $list[$i]['ca_name']) { ?>li_cate<?php } ?>">
                <div class="img_wrap">
                    <?php
                    $row = '';
                    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], "600", "226");
                    if($thumb['src']) {

                        $img_content = '<img src="'.$thumb['ori'].'" alt="'.$thumb['alt'].'" >';
                    } else {
                        $img_content = '<span>no image</span>';
                    }
                    echo $img_content;
                ?>   
                </div>
                <div class="project_content">
                    <?php
                    if ($is_category && $list[$i]['ca_name']) {
                    ?>
                    <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                    <?php } ?>
                    <div class="bo_subject">
                        <h2>
                        <?php if ($is_checkbox) { // 게시글별 체크박스 ?>
                        <span class="sel bo_chk li_chk">
                            <label for="chk_wr_id_<?php echo $i ?>"><span class="chk_img"></span> <span class="sound_only"><?php echo $list[$i]['subject'] ?></span></label>
                            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                        </span>
                        <?php } ?>
                        <?php 
                        
                        $success_tag = $list[$i]['wr_3'] < $list[$i]['wr_4'];
                        $now = strtotime(date("Y-m-d"));
                        $target_start = strtotime(date('Y-m-d', strtotime($list[$i]['wr_1'])));
                        $target_end = strtotime(date('Y-m-d', strtotime($list[$i]['wr_2'])));
                        if($now < $target_start) {
                            $tab_tag = 1;
                        ?>
                            <span class="funding_state disabled">펀딩예정</span>
                        <?php     
                        } else if($now > $target_end) {
                            $tab_tag = 3;
                        ?>
                            <span class="funding_state disabled">펀딩종료</span>
                        <?php
                        } else if($success_tag == 1) {
                            $tab_tag = 2;
                        ?>
                            <span class="funding_state success">펀딩성공</span>
                        <?php
                        } else if($now > $target_start && $now < $target_end) {
                            $tab_tag = 2;
                        ?>
                            <span class="funding_state ing">펀딩중</span>
                        <?php
                        } 
                        ?>
                        <a href="<?php echo $list[$i]['href'] ?>" class="bo_subject">
                            <?php echo $list[$i]['icon_reply']; ?>
                            <?php if ($list[$i]['is_notice']) { ?><strong class="notice_icon number"><img src="<?php echo G5_IMG_URL ?>/ico_announce.svg"></strong><?php } ?> 
                            <?php if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'] ?>
                            <?php echo $list[$i]['subject'] ?>
                            <?php
                            // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                            if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                            if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                            // if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                            if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];

                            ?>
                        </a>
                        </h2>

                        <ul class="tags">
                                    <li>#이자율 <?php echo $list[$i]['wr_5'] ?>%</li>

                                <?php 
                                if($list[$i]['wr_9']) {
                                    ?>
                                    <li>
                                    <?php 
                                        echo $list[$i]['wr_9']
                                    ?>
                                    </li>
                                    <?php 
                                }
                                if($list[$i]['wr_10']) {
                                    ?>
                                    <li>
                                    <?php 
                                        echo $list[$i]['wr_10']
                                    ?>
                                    </li>
                                    <?php 
                                }
                                ?>
                            </ul>

                        </div>
                            <div class="funding_content">
                                <div class="amount_wrap">
                                    <div class="amount">
                                        <span class="now_amount"><em><?php echo $list[$i]['wr_4'] ?></em>원</span>
                                        <span class="target_amount">/<em><?php echo $list[$i]['wr_3'] ?></em>원</span>
                                    </div>
                                    <div class="persent"><em>92</em>%</div>
                                </div>
                                <div class="funding_state_bar">
                                    <span class="gauge"></span>
                                </div>
                            </div>

                    <!-- <div class="bo_info">
                        <span class="sound_only">작성자</span><?php echo $list[$i]['name'] ?>
                        <span class="bo_date"> <i class="fa fa-clock-o"></i> <?php echo $list[$i]['datetime2'] ?></span>
                        <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span> <i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo $list[$i]['comment_cnt']; ?> <?php } ?>
                        <?php if ($list[$i]['wr_good']) { ?><i class="fa fa-thumbs-o-up"></i> <?php echo $list[$i]['wr_good'] ?> <?php } ?>
                        <?php if ($list[$i]['wr_nogood']) { ?><i class="fa fa-thumbs-o-down"></i> <?php echo $list[$i]['wr_nogood'] ?> <?php } ?>
                    
                    </div> -->
                </div>
            </li> 
            <!-- // 투자하기 리스트 ideahub end -->
            <?php } else { ?>
                    <li class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>  <?php if ($is_category && $list[$i]['ca_name']) { ?>li_cate<?php } ?>">
                
                    <?php
                    if ($is_category && $list[$i]['ca_name']) {
                    ?>
                    <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                    <?php } ?>
                    <div class="bo_subject">

                        <?php if ($is_checkbox) { // 게시글별 체크박스 ?>
                        <span class="sel bo_chk li_chk">
                            <label for="chk_wr_id_<?php echo $i ?>"><span class="chk_img"></span> <span class="sound_only"><?php echo $list[$i]['subject'] ?></span></label>
                            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
                        </span>
                        <?php } ?>

                        <a href="<?php echo $list[$i]['href'] ?>" class="bo_subject">
                            <?php echo $list[$i]['icon_reply']; ?>
                            <?php if ($list[$i]['is_notice']) { ?><strong class="notice_icon number"><img src="<?php echo G5_IMG_URL ?>/ico_announce.svg"></strong><?php }else{ ?>
                                <span class="number"><?php echo $list[$i]['num'] ?></span>
                                <?php }?> 
                                <p>
                            <?php if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'] ?>
                            <?php echo $list[$i]['subject'] ?>
                            <?php
                            // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                            if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                            if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                            if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                            if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];

                            ?>
                            </p>
                        </a>

                    </div>
                    <div class="bo_info">
                        <!-- <span class="sound_only">작성자</span><?php echo $list[$i]['name'] ?> -->
                        <span class="bo_date"><?php echo $list[$i]['datetime2'] ?></span>
                        <div class="views">
                        <img src="<?php echo G5_IMG_URL ?>/ico_view.svg">
                        <span><?php echo $list[$i]['wr_hit'] ?></span>
                        </div>
                        <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span> <i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo $list[$i]['comment_cnt']; ?> <?php } ?>
                        <?php if ($list[$i]['wr_good']) { ?><i class="fa fa-thumbs-o-up"></i> <?php echo $list[$i]['wr_good'] ?> <?php } ?>
                        <?php if ($list[$i]['wr_nogood']) { ?><i class="fa fa-thumbs-o-down"></i> <?php echo $list[$i]['wr_nogood'] ?> <?php } ?>
                    
                    </div>
                    
                </li>
            <?php }} ?>
            <?php if (count($list) == 0) { echo '<li class="empty_table" style="text-indent:10px;">게시물이 없습니다.</li>'; } ?>
        </ul>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <ul class="btn_bo_adm">
            <?php if ($list_href) { ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01 btn_m"> 목록</a></li>
            <?php } ?>
            <?php if ($is_checkbox) { ?>
            <li><button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn_m btn_b01">선택삭제</button></li>
            <!-- <li><button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value" class="btn_m btn_b01">선택복사</button></li> -->
            <!-- <li><button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value" class="btn_m btn_b01">선택이동</button></li> -->
            <?php } ?>
        </ul>
        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_wr">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_m btn_b01">RSS</a></li><?php } ?>
            <!-- <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin" target="_blank"><i class="fa fa-cog"></i><span class="sound_only">관리자</span></a></li><?php } ?> -->
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_m btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
    </div>
    

    <!-- 게시판 목록 시작 -->
    <?php if($board['bo_table'] == "my_investment") {?>

    <div id="invest_project">
        <ul>
            <li>
                <p class="invest_project_el">
                    2022년<img src="<?php echo G5_IMG_URL ?>/invest_project_arrow_ico.svg">
                </p>
                <ul class="quarter">
                    <li>
                        <p class="quarter_el">
                            <!-- <img src="<?php echo G5_IMG_URL ?>/quarter_ico_plust.svg"> -->
                            1분기
                        </p>
                        <ul class="invest_file">
                            <li>
                                <p class="invest_file_el">
                                    <img src="<?php echo G5_IMG_URL ?>/invest_file_ico.svg">
                                    <a href="/">HEVC - Disclosure of Royalty Information - IDEAHUB.pdf</a>
                                    <img src="<?php echo G5_IMG_URL ?>/invest_download_ico.svg">
                                </p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p class="quarter_el">
                            <!-- <img src="<?php echo G5_IMG_URL ?>/quarter_ico_plust.svg"> -->
                            2분기
                        </p>
                    </li>
                </ul>
            </li>
            <li>
                <p class="invest_project_el">
                    2021년<img src="<?php echo G5_IMG_URL ?>/invest_project_arrow_ico.svg">
                </p>
                <ul class="quarter">
                    <li>
                        <p class="quarter_el">
                            <!-- <img src="<?php echo G5_IMG_URL ?>/quarter_ico_plust.svg"> -->
                            1분기
                        </p>
                        <ul class="invest_file">
                            <li>
                                <p class="invest_file_el">
                                    <img src="<?php echo G5_IMG_URL ?>/invest_file_ico.svg">
                                    <a href="/">HEVC - Disclosure of Royalty Information - IDEAHUB.pdf</a>
                                    <img src="<?php echo G5_IMG_URL ?>/invest_download_ico.svg">
                                </p>
                            </li>
                            <li>
                                <p class="invest_file_el">
                                    <img src="<?php echo G5_IMG_URL ?>/invest_file_ico.svg">
                                    <a href="/">HEVC - Disclosure of Royalty Information - IDEAHUB.pdf</a>
                                    <img src="<?php echo G5_IMG_URL ?>/invest_download_ico.svg">
                                </p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p class="quarter_el">
                            <!-- <img src="<?php echo G5_IMG_URL ?>/quarter_ico_plust.svg"> -->
                            2분기
                        </p>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <?php } ?>
</div>
<?php } else { ?>
    <!-- 투자하기 게시판 -->
    
    

<?php } ?>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages; ?>


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
        f.action = g5_bbs_url+"/board_list_update.php";
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
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}
</script>
<?php } ?>
<script>
    const boardMo = () => {
        $("#bo_sch .sch_btn").on("click", (e)=>{
            if(!$("#bo_sch").hasClass("on")){
                e.preventDefault();
                $("#bo_sch").addClass("on")
            }
        })

        $("#bo_sch").on("click", (e)=>{
            if(e.target.id === "bo_sch"){
                $("#bo_sch").removeClass("on");
            }

        })
    }

    if(window.innerWidth < 969){
        boardMo()
    }

    $(window).resize(()=>{
        boardMo()
    })

    const invest = document.querySelector("#investment");
    //투자하기 페이지만
    // if(invest){
        //펀딩금액, 퍼센트 설정
        const fundingContent = document.querySelector(".funding_content")
        const projectListLi = $(".project_list > li");
        if(fundingContent){
            for(let i = 0; i<projectListLi.length; i++){
                let nowAmount = document.querySelectorAll(".now_amount em");
                let fundingAmount = document.querySelectorAll(".target_amount em");
                let fundingPersentResult = (Number(nowAmount[i].innerText) / Number(fundingAmount[i].innerText)) * 100;
                projectListLi.eq(i).find(".funding_content .persent em").html(fundingPersentResult);
                projectListLi.eq(i).find(".funding_state_bar .gauge").css({width : `${fundingPersentResult}%`})

                nowAmount[i].innerHTML = Number(nowAmount[i].innerText).toLocaleString('ko-KR')
                fundingAmount[i].innerHTML = Number(fundingAmount[i].innerText).toLocaleString('ko-KR')
            }
        }
        
        const investTabLi = document.querySelectorAll(".invest_tab li");
        const projectList = document.querySelector(".project_list");
        const projectListList = document.querySelectorAll(".project_list > li");
        const tabHandle = (num, el) => {
            let eleLength = 0;
            let listTotal = document.querySelector("#bo_list_total em");
            projectListList.forEach((item, i, ele) => {
                item.style.display = "flex"
                if(num === 0){
                    item.style.display = "flex"
                    listTotal.innerHTML = projectListList.length;
                }else if(!item.classList.contains(`tabTag_${num}`)){
                    item.style.display = "none"
                    listTotal.innerHTML = eleLength;
                }
                if(item.classList.contains(`tabTag_${num}`)){
                    eleLength++;
                    listTotal.innerHTML = eleLength;
                }
            })

            investTabLi.forEach(item=>{
                { item == el ? item.classList.add("on") : item.classList.remove("on") }
            })
            
        }

        // $("#bo_list").hide();
        const myTabHandle = (num, el) => {
            $(".my_invest_tab li").removeClass("on");
            el.classList.add("on")

            if(num == 0){
                $("#bo_list").hide();
                $("#invest_project").show();
            }else{
                $("#bo_list").show();
                $("#invest_project").hide();

            }
        }

    const investProject = document.querySelector("#invest_project");
    if(investProject){
        // $("#invest_project > ul > li").on("click", function(){
        //     $(this).addClass("on").find(".quarter").slideDown();
        //     $(this).siblings().removeClass("on").find(".quarter").slideUp();
        // })

        // $(".quarter > li").on("click", function(){
        //     $(this).find(".quarter_el").toggleClass("on")
        //     $(this).find(".invest_file").slideToggle();
        // })
        $("#invest_project > ul > li > p").on("click",function(){
            $(this).toggleClass("on").siblings(".quarter").slideToggle();
        })

        $(".quarter_el").on("click",function(){
            $(this).toggleClass("on").siblings(".invest_file").slideToggle();
        })
    }

    
</script>

<!-- 게시판 목록 끝 -->
