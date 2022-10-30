<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php include 'inc/header.php' ?>

<div id="main_wrap">
  <section class="main_visual">
    <article>
    <h2>“IDEA” Hub to Global</h2>
    <p>Solution For The innovation Economy<br>
      Experts In Developing and Executing Worldwide IP Strategies</p>
    <button class="default_btn">LEARN MORE</button>
    </article>
  </section>
  <section class="company_profile">
    <article>
      <div class="cp_blue_box">
        <h2>Company<br>Profile</h2>
        <p>IDEAHUB’s services range from leading<br>traditional IP monetization<br>
        campaigns to rethinking how companies can IP<br>to attain corporate success</p>
      </div>
      <ul>
        <li>
          <b>20+</b>
          <p>Licensing<br>
          Professionals</p>
        </li>
        <li>
          <b>25+<br>
          YEARS</b>
          <p>Licensing<br>
          Experience</p>
        </li>
        <li>
          <b>1000+</b>
          <p>License Agreements<br>
          Executed</p>
        </li>
        <li>
          <b>4</b>
          <p>Global Open<br>
          Licensing<br>
          Program</p>
        </li>
      </ul>
    </article>
  </section>
  <section class="getting">
    <article>
      <h2>Getting Started</h2>
      <ul>
        <li>
          <div class="img">
            <img src="images/main_getting_ico_1_idh_eng.png">
          </div>
          <p>Operation Company will not find right value on good IP until spin off from the company assets.</p>
        </li>
        <li>
          <div class="img">
          <img src="images/main_getting_ico_2_idh_eng.png">
          </div>
          <p>Ideahub provides solutions.</p>
        </li>
        <li>
          <div class="img">
          <img src="images/main_getting_ico_3_idh_eng.png">
          </div>
          <p>Ideahub owns global professional networks and knowhow to find right value for strong IPs.</p>
        </li>
      </ul>
      <button class="default_btn wt">SUBMIT PARTNERS</button>
    </article>
  </section>
  <section class="contact">
    <h2>Contact</h2>
    <p>For general questions, please contact us.</p>
    <button class="default_btn wt">CONTACT US</button>
  </section>
  <section class="news">
  <h2>IDEAHUB News</h2>
  <ul>
  <?php
    $mysql_HOST = '127.0.0.1';
    $mysql_DATABASE = 'bblog';
    $mysql_USERNAME = 'root';
    $mysql_PASSWORD = '11111111';

    $connect = new mysqli($mysql_HOST, $mysql_USERNAME, $mysql_PASSWORD, $mysql_DATABASE);
    $sql = " select * from g5_write_broadcast_eng where wr_is_comment = 0 order by wr_num desc limit 0, 3 ";   
    $connect->set_charset("utf8mb4");
    $result = mysqli_query($connect, $sql);
    for ($i=0; $row = mysqli_fetch_array($result); $i++) {
        // echo $row['wr_subject']; // 제목
        // echo $row['wr_content']; // 내용
        // echo $row['wr_1']; // 신문사 tag
        // echo $row['wr_2']; // 신문사 url
        // var_dump($row)
        ?>
        
        
          <li>
            <a href="<?php echo $row['wr_2'] ?>">
              <span class="news_tag"><?php echo $row['wr_1'] ?></span>
              <div>
              <p><?php echo $row['wr_subject'] ?></p>
              <div class="date"><?php echo $row['wr_datetime'] ?></div>
              </div>
            </a>
          </li>
          <?php
    }
    ?>
    </ul>
  <div class="txt_animation">
            <div class="txt_ani_1"><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span></div>
            <div class="txt_ani_2"><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span><span>IDEAHUB</span></div>
        </div>
  </section>
</div>

<!-- 보도자료, 뉴스() -->


<?php include 'inc/footer.php' ?>
</body>
</html>