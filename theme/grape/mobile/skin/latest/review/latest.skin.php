<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
// $thumb_width = 880;
// $thumb_height = 600;
// // ?>

<div class="lt_review">
    <!-- <h2><a href="<?php echo get_pretty_url($bo_table); ?>"><?php echo $bo_subject ?></a></h2> -->
    <article>
    <div class="title_wrap">
    <h2>아이디어허브<br>언론기사</h2>
    <button class="default_btn blue" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=broadcast'"><div>더보기<svg width="19" height="7" viewBox="0 0 19 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 6H17L12.678 1" stroke="white" stroke-width="1.5"/></svg></div>
            <span></span>
            </button>
    </div>
    <div class="lt_rv_wr">
    <ul>
    <?php
    for ($i=0; $i<count($list); $i++) {

    ?>
        <li>
            <div class="lt_wr">
                <span class="tag"><?php echo $list[$i]['wr_1']; ?></span>
                <!-- <span class="lt_img"><?php echo get_member_profile_img($list[$i]['mb_id']); ?></span> -->
                <div class="content">
                    <div class="content_tit">
                        <div>
                    <span class="lt_date mo"><?php echo explode(' ', $list[$i]['wr_datetime'])[0]; ?></span>
                <?php
                echo "<strong>";
                if ($list[$i]['icon_secret']) echo "<i class=\"fa fa-lock\" aria-hidden=\"true\"></i><span class=\"sound_only\">비밀글</span> ";
                if ($list[$i]['is_notice'])
                    echo "<strong>".$list[$i]['wr_subject']."</strong>";
                else
                    echo $list[$i]['wr_subject'];

                echo "</strong>";

                ?>
                </div>
                <button>+</button>
                </div>
                <div class="lt_detail"><p> <?php echo get_text(cut_str(strip_tags($list[$i]['wr_content']), 100), 1); ?>
                </p><a href="<?php echo $list[$i]['wr_2'] ?>" class="more_mo mo">전문보기</a>
    </div>
                </div>
                <!-- <span class="lt_date"><?php echo $list[$i]['datetime2']; ?>  / <?php echo $list[$i]['name'] ?></span> -->
                <span class="lt_date pc"><?php echo explode(' ', $list[$i]['wr_datetime'])[0]; ?></span>
                <a href="<?php echo $list[$i]['wr_2'] ?>" class="more">전문보기<svg width="19" height="7" viewBox="0 0 19 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 6H17L12.678 1" stroke="white" stroke-width="1.5"/></svg></a>
            </div>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    </div>
    </article>
</div>

<script>

    const listWrap = document.querySelectorAll(".lt_rv_wr li");

    const resizePc = () => {
        listWrap.forEach(item => {
            item.querySelector(".content button").addEventListener("click", () => {
                item.classList.toggle("on");
            })
            item.querySelector(".content button").addEventListener("mouseenter", (e) => {
                e.target.innerHTML = "-"
            });
            item.querySelector(".content button").addEventListener("mouseleave", (e) => {
                if(item.classList.contains("on")){
                    e.target.innerHTML = "-"
                }else{
                    e.target.innerHTML = "+"
                }
            });
        })
    }

    const resizeMo = () => {
        listWrap.forEach(item => {
            item.querySelector(".content_tit").addEventListener("click", (e) => {
                item.classList.toggle("on");
                if(item.classList.contains("on")){
                    item.querySelector(".content button").innerHTML = "-"
                }else{
                    item.querySelector(".content button").innerHTML = "+"
                }
            })
            let detailEle = item.querySelector(".lt_detail p").innerHTML;
            item.querySelector(".lt_detail p").innerHTML = `${detailEle.substr(0, 35)}... `
        })
    }

    if(window.innerWidth < 969){
        //mo
        resizeMo();
    }else{
        //pc
        resizePc();
    }

    window.addEventListener("resize", () => {
        if(window.innerWidth < 969){
            //mo
            resizeMo();
        }else{
            //pc
            resizePc();
        }   
    })
    
</script>
