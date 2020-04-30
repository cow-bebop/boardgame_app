<?php

//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　トップページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();
?>

<?php
$siteTitle = 'トップページ';
require('head.php');
?>

  <body class="">

    <!-- ヘッダー -->
    <?php
      require('header.php'); 
    ?>

    <!-- メインコンテンツ -->
    <div id="contents" class="site-width">

      <!-- Main -->
      <section id="main " >
        <div class="">
          <img src="common/img/top.jpg" alt="">
        </div>
        <h2 class="top-msg">
        ぼどげみゅはボードゲームの<br>
        フリーマーケットサービスです。<br>
        カテゴリ別、値段順などで検索をすることで、<br>
        お目当の商品を探すことができます。
        </h2>
      </section>
    </div>

    <!-- footer -->
    <?php
    require('footer.php');
    ?>
