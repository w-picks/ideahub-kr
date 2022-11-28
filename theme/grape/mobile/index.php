<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');

?>

<div id="main_wrapper">
    <section id="main_vid">
        <video muted autoplay loop>
            <source src="<?php echo G5_IMG_URL ?>/idh_main_vid.mp4" type="video/mp4"></source>
        </video>
        
        <article>
            <h2>세계 최초의<br>특허 투자 플랫폼</h2>
            <p>누구나 기술에 투자할 수 있는 기회,<br>아이디어허브를 통해 특허권에 투자하세요.</p>
        </article>
    </section>
    <section id="section1">
        <article>
            <h2 class="scroll-trans">아이디어허브는<br><span>IP 수익화 플랫폼</span><br>입니다.</h2>
            <p class="scroll-trans scroll-trans-delay-300">특허를 발굴하고 개인/기관 투자를 통해<br>특허에서 발생되는 수익을 공유하는 플랫폼.<br>아이디어허브를 통해 글로벌 수익화를 실현하세요.</p>
        </article>
    </section>

    <!-- 모집중인 프로젝트 -->
    
    <section id="section2">
        <div class="project_slide_content swiper">
            <div class="swiper-wrapper">
            <?php
            $sql = " select * from g5_write_investment where wr_is_comment = 0 order by wr_num desc limit 0, 3 ";        
            $result = sql_query($sql);
            for ($i=0; $row = sql_fetch_array($result); $i++) {
            ?>
                <div class="swiper-slide slide_<?php echo $i+1 ?>">
                    <p class="slide-name">모집중인 프로젝트</p>
                    <h3><?php echo $row['wr_subject'] ?></h3>
                    <p class="caption"><?php echo $row['wr_6'] ?></p>
                    <ul>
                        <li>
                            <p>예상수익률</p>
                            <div>연 <b><?php echo $row['wr_5'] ?></b>%</div>
                        </li>
                        <li>
                            <p>모집금액</p>
                            <div><b><?php echo ceil($row['wr_3']/100000000) ?></b>억원</div>
                        </li>
                        <li>
                            <p>모집기간</p>
                            <div><b><?php echo date('m.d', strtotime($row['wr_2'])) ?></b><br class="mo">까지</div>
                        </li>
                    </ul>
                    <button class="default_btn" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=investment&wr_id=<?php echo $row['wr_id'] ?>'"><div>투자하기<svg width="19" height="7" viewBox="0 0 19 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 6H17L12.678 1" stroke="white" stroke-width="1.5"/></svg></div>
                    <span></span>
                    </button>
                </div>
                <?php
                } 
                ?>

                
                <!-- <div class="swiper-slide slide_2">
                    <p class="slide-name">모집중인 프로젝트</p>
                    <h3>Streaming Project</h3>
                    <p class="caption">음성,영상,애니메이션 등을 실시간 재생하는 기술 관련 특허</p>
                    <ul>
                        <li>
                            <p>예상수익률</p>
                            <div><b>연 30%</b><br>이상</div>
                        </li>
                        <li>
                            <p>모집금액</p>
                            <div><b>3</b>억원</div>
                        </li>
                        <li>
                            <p>모집기간</p>
                            <div><b>12.31</b><br class="mo">까지</div>
                        </li>
                    </ul>
                    <button class="default_btn"><div>투자하기<svg width="19" height="7" viewBox="0 0 19 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 6H17L12.678 1" stroke="white" stroke-width="1.5"/></svg></div>
                    <span></span>
                    </button>
                </div> -->
            </div>
        </div>
        <div class="project_slide_bg swiper">
            <div class="swiper-wrapper">
                <?php $sql = " select * from g5_write_investment where wr_is_comment = 0 order by wr_num desc limit 0, 3 ";        
            $result = sql_query($sql);
            for ($i=0; $row = sql_fetch_array($result); $i++) {?>
                <div class="swiper-slide slide_<?php echo $i+1 ?>">
                    <div class="slide_content_bg"></div>
                </div>
                <?php } ?>

                
                <!-- <div class="swiper-slide slide_2">
                    <div class="slide_content_bg"></div>
                </div> -->
            </div>
            
            <div class="swiper-button-prev swiper-btn"></div>
            <div class="swiper-button-next swiper-btn"></div>
            <div class="swiper-pagination"></div>
           
        </div>
    </section>
    

    <section id="section3" class="invest_status">
        <article class="txt_box scroll-trans">
            <p>아이디어허브 투자자이신가요?</p>
            <h2>나의 투자 현황을<br>알아보세요!</h2> 
            <button class="default_btn blue" onclick="location.href='<?php echo G5_BBS_URL ?>/board.php?bo_table=my_investment>'"><div>나의 투자 레포트<svg width="19" height="7" viewBox="0 0 19 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 6H17L12.678 1" stroke="white" stroke-width="1.5"/></svg></div>
            <span></span>
            </button>
        </article>
        <article class="img_container scroll-trans scroll-trans-delay-300">
            <div class="left">
                <div class="img_box sm">
                    <img src="<?php echo G5_IMG_URL ?>/investment_status_1.png">
                </div>
                <div class="img_box lg">
                    <img src="<?php echo G5_IMG_URL ?>/investment_status_2.png">
                </div>
                <div class="img_box sm">
                    <img src="<?php echo G5_IMG_URL ?>/investment_status_3.png">
                </div>
                <!-- <div class="img_box lg">
                    <p class="project_name">프로젝트 이름</p>
                </div> -->
            </div>
            <div class="right">
                <div class="img_box lg">
                    <img src="<?php echo G5_IMG_URL ?>/investment_status_4.png">
                </div>
                <div class="img_box sm">
                    <img src="<?php echo G5_IMG_URL ?>/investment_status_5.png">
                </div>
                <div class="img_box lg">
                    <img src="<?php echo G5_IMG_URL ?>/investment_status_6.png">
                </div>
            </div>
        </article>
    </section>
    <section id="section4" class="invest_banner">
        <h2 class="scroll-trans">지식재산권의 시대,<br>IP를 활용하고 IP에 투자하세요</h2>
        <div class="img scroll-trans">
            <img src="<?php echo G5_IMG_URL ?>/invest_banner_in.png" class="pc">
            <img src="<?php echo G5_IMG_URL ?>/invest_banner_in_mo.png" class="mo">
        </div>
    </section>
    <section id="section5" class="funding_review">
        <div class="txt_animation">
            <div class="txt_ani_1"><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span></div>
            <div class="txt_ani_2"><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span></div>
        </div>
        <article>
            <span class="scroll-trans">IDEAHUB</span>
            <h2 class="scroll-trans">지금까지 펀딩에<br>성공한 프로젝트는?</h2>
            <ul>
                <li>
                    <em>프로젝트명</em>
                    <p><b>IoT IP</b></p>
                </li>
                <li>
                    <em>총 투자모집 금액</em>
                    <p>약<b>121</b>억</p>
                </li>
                <li>
                    <em>수익률</em>
                    <p><b>37</b>%</p>
                </li>
            </ul>
        </article>
    </section>
</div>

<!-- 보도자료 -->
<?php
// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
echo latest('theme/review', 'broadcast', 5, 20);
?>

<section id="section7" class="direct_banner">
        <p>아이디어허브에 대해 궁금한 점이 있으신가요?</p>
        <button onclick="window.location.href='<?php echo G5_URL ?>/bbs/qawrite.php'">1:1문의<img src="<?php echo G5_IMG_URL ?>/ico_direct_faq.svg"></button>
</section>

<script>
    const swiperContent = new Swiper('.project_slide_content', {});
    const swiperBg = new Swiper('.project_slide_bg', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
        },
        effect : "fade"
    });

    swiperContent.controller.control = swiperBg
    swiperBg.controller.control = swiperContent;

    //button effect
    $('.default_btn').on('mouseover',function(e){
        var x = e.pageX;
        var y = e.pageY;
        var offX = $(this).offset().left;
        var offY = $(this).offset().top;
        
        $('.default_btn span').css({
            left:x-offX, top:y-offY,
        })
        
    })
    
    $('.default_btn').on('mouseout',function(e){
        
        var x = e.pageX;
        var y = e.pageY;
        var offX = $(this).offset().left;
        var offY = $(this).offset().top;
        
        $('.default_btn span').css({
            left:x-offX, top:y-offY,
        })
    })
                
    console.log($(".swiper-slide").length)

    if($(".swiper-slide").length == 0){
        // $(".project_slide_content .swiper-wrapper").html(`
        // <div class="swiper-slide no-project">
        //              <img src="<?php echo G5_IMG_URL ?>/no_project_txt.png" class="pc_img">
        //              <img src="<?php echo G5_IMG_URL ?>/no_project_txt_mo.png" class="mo_img">
        //              <p>프로젝트 오픈 예정입니다!</p>
        //          </div>`)
        $(".project_slide_bg .swiper-wrapper").html(`
        <div class="swiper-slide no-project">
        <p>현재 프로젝트를 준비중입니다.</p>
                     <div class="slide_content_bg"></div>
                 </div>`)

                 $(".swiper-btn").hide();
                 $(".swiper-pagination").hide();
                 $(".project_slide_content").addClass("no-project");
                 $(".project_slide_bg").addClass("no-project");
    }

    // <?php if(sql_fetch_array($result) == "Null"){ ?>
    //             <!-- <div>오픈예정</div> -->
    //             <div class="swiper-slide no-project">
    //                 <img src="<?php echo G5_IMG_URL ?>/no_project_txt.png">
    //                 <p>프로젝트 오픈 예정입니다!</p>
    //             </div>
    //             <?php } ?>

    // <?php if(sql_fetch_array($result) == null){ ?>
    //             <!-- <div>오픈예정</div> -->
    //             <div class="swiper-slide no-project">
    //                 <div class="slide_content_bg"></div>
    //             </div>
    //         <?php } ?>
    
</script>

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>

