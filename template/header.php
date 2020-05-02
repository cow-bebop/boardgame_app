<header class="header js-float-menu">
  <h1 class="title"><a href="index.php"><img class="header-logo" src="common/img/logo.png" alt=""></a></h1>
  <div class="menu-trigger js-toggle-sp-menu">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <nav class="nav-menu js-toggle-sp-menu-target">
    <ul class="menu">
      <?php
        if(empty($_SESSION['user_id'])){
      ?>
      <li class="menu-item"><a class="menu-link" href="signup.php">ユーザー登録</a></li>
      <li class="menu-item"><a class="menu-link" href="login.php">ログイン</a></li>
      <?php
        }else{
      ?>
      <li class="menu-item"><a class="menu-link" href="mypage.php">マイページ</a></li>
      <li class="menu-item"><a class="menu-link" href="registProduct.php">商品を出品する</a></li>
      <li class="menu-item"><a class="menu-link" href="logout.php">ログアウト</a></li>
      <?php
        }
      ?>
    </ul>
  </nav>
</header>