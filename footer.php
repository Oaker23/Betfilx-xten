  <?php 
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
preg_match('/(?<=\/\/).(.*?)(?=\/)/', $actual_link, $output_array);
  ?>
  <footer class="text-muted">
    <div class="container text-center">
      <p>CopyRight &copy; 2019, <?php echo $output_array[0]; ?></p>
    </div>
  </footer>
  <div class="loader-wrapper">
  <span class="loader"><span class="loader-inner"></span></span>
  </div>
<div class="fix-nav-bottom">
    <div class="fix-nav-bottom" v-cloak>
      <div class="scroll-text">
        <marquee
        scrolldelay="100"
        onmouseover="this.stop();"
        onmouseout="this.start();"
        behavior=""
        direction=""
        >
        <a
        >เกมส์สล๊อตออนไลน์ เกมส์ออนไลน์ ได้เงินจริงได้เงินไว
        เกมส์สล๊อตออนไลน์ที่ดีที่สุดตอนนี้ <?php echo $output_array[0]; ?>
        ภาพเกมส์แบบใหม่ที่ภาพกราฟฟิคสวยงามสมจริง
        สามารถเล่นผ่านเว็บบราวเซอร์</a
        >
      </marquee>
    </div>

    <div class="container pr-0 pl-0">
      <ul>
        <li>
          <a href="dashboard" class="hvr-buzz-out"
          ><i class="fal fa-user-secret"></i>
          <p>ข้อมูลสมาชิก</p></a
          >
        </li>
        <li>
          <a href="deposit" class="hvr-buzz-out"
          ><i class="fal fa-wallet"></i>
          <p>ฝากเงิน</p></a
          >
        </li>
        <li>
          <a href="withdraw" class="hvr-buzz-out"
          ><i class="fal fa-hand-holding-usd"></i>
          <p>ถอนเงิน</p></a
          >
        </li>


        <li class="fix-nav-bottom-active">
          <a href="login_game.php?username_game=<?php echo $row["username_game"]; ?>" target="_blank" class="hvr-buzz-out"
          ><i class="fal fa-play"></i>
          <p>เข้าเล่นเกมส์</p></a
          >
        </li>
      </ul>
    </div>
  </div>
</div>   

<input type="hidden" id="credit_check" value="<?php echo $row["credit"]; ?>">


