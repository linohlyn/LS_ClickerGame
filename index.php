<?php
require_once 'include/header.php' ?>
<main>
<?php if ($model->isLoggedIn()): ?>
<?php require_once 'include/navbar.php'; ?>
<div class="section">
  <div class="row">
      <div class="col s8 center-align">
          <button id="click" class="waves-effect waves-light red lighten-3" onclick="iterate()"><img class="responsive-img" src="assets/Clicker.png" style="width: 50%;"></button>
          <h3 class="center-align">$ <span id="money" name="money"><?=$model->getHighscore();?></span></h3>
          <h4 class="center-align">$ <span id="mps" name="mps"><?=$model->getMPS();?></span> every 5 seconds</h4>
      </div>
      <div class="col s4 center-align pink lighten-4 z-depth-3">
          <div class="row"><h3 class="center">Upgrades</h3></div>
          <div class="row"><button class="waves-effect waves-light btn red lighten-3" id="upgrade1" onclick="Upgrade1()">Upgrade 1 $10</button>  <span id="up1" name="upgrade1"><?=$model->getUpgrade1();?></span></div>
          <div class="row"><button class="waves-effect waves-light btn red lighten-3" id="upgrade2" onclick="Upgrade2()">Upgrade 2 $20</button>  <span id="up2" name="upgrade2"><?=$model->getUpgrade2();?></span></div>
          <div class="row"><button class="waves-effect waves-light btn red lighten-3" id="upgrade3" onclick="Upgrade3()">Upgrade 3 $30</button>  <span id="up3" name="upgrade3"><?=$model->getUpgrade3();?></span></div>
      </div>
    </div>
  </div>
</div>

<script>
var money = document.getElementById('money').innerHTML;
var up1 = document.getElementById('up1').innerHTML;
var up2 = document.getElementById('up2').innerHTML;
var up3 = document.getElementById('up3').innerHTML;
var mps = document.getElementById('mps').innerHTML;

function iterate(){
  ++money;
  document.getElementById('money').innerHTML = money;
};

function Upgrade1() {
  if (money >= 10) {
    ++up1;
    money = money - 10;
    mps = (5 * up1) + (10 * up2) + (15 * up3);
    document.getElementById('mps').innerHTML = mps;
    document.getElementById('up1').innerHTML = up1;
    document.getElementById('money').innerHTML = money;
  } else {
    return;
  }
}

function Upgrade2() {
  if (money >= 20) {
    up2++;
    document.getElementById('up2').innerHTML = up2;
    money = money - 20;
    document.getElementById('money').innerHTML = money;
    mps = (5 * up1) + (10 * up2) + (15 * up3);
    document.getElementById('mps').innerHTML = mps;
  } else {
    return;
  }
}

function Upgrade3() {
  if (money >= 30) {
    up3++;
    document.getElementById('up3').innerHTML = up3;
    money = money - 30;
    document.getElementById('money').innerHTML = money;
    mps = (5 * up1) + (10 * up2) + (15 * up3);
    document.getElementById('mps').innerHTML = mps;
  } else {
    return;
  }
}

$(document).ready(function() {
  setInterval(increaseMoney, 5000);
  function increaseMoney(){
    mps = (5 * up1) + (10 * up2) + (15 * up3);
    if (mps > 0) {
      money = Number(money) + mps;
    }
    $.ajax({
      url: 'sendscore.php',
      type: 'post',
      data: {money: money},
      success: function(response){
        $("#money").html(response);
      }
    });
    $.ajax({
      url: 'sendupgrades.php',
      type: 'post',
      data: {
        up1: up1,
        up2: up2,
        up3: up3,
        mps: mps
      },
      success: function(response){
        var data = JSON.parse(response)
        $("#up1").html(data[0]);
        $("#up2").html(data[1]);
        $("#up3").html(data[2]);
        $("#mps").html(data[3]);
      }
    });
}
});


</script>
<?php else: ?>
<div class="valign-wrapper my-wrapper row">
  <div class="col s12 center-align">
    <h2>Welcome to Macaron Clicker!</h2><br>
    <a href="register.php" class="waves-effect waves-light btn valign deep-purple lighten-4">Register</a>
    <a href="login.php" class="waves-effect waves-light btn valign deep-purple lighten-4">Login</a>
  </div>
</div>

<?php endif; ?>
</main>
<?php require_once 'include/footer.php' ?>
