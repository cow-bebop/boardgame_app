<?php
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　マイページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//================================
// 画面処理
//================================
//ログイン認証
require('auth.php');

// 画面表示用データ取得
//================================
$u_id = $_SESSION['user_id'];

// DBからユーザーデータを取得
$userData = getUser($u_id);
debug('取得したユーザー情報：'.print_r($userData,true));

// DBから商品データを取得
$productData = getMyProducts($u_id);
// DBから連絡掲示板データを取得
$bordData = getMyMsgsAndBord($u_id);
// DBからお気に入りデータを取得
$likeData = getMyLike($u_id);

// DBからきちんとデータがすべて取れているかのチェックは行わず、取れなければ何も表示しないこととする

debug('取得した商品データ：'.print_r($productData,true));
debug('取得した掲示板データ：'.print_r($bordData,true));
debug('取得したお気に入りデータ：'.print_r($likeData,true));

debug('画面表示処理終了 <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
$siteTitle = 'マイページ';
require('head.php'); 
?>


  <body class="page-logined">
    <style>
      #main{
        border: none !important;
      }
    </style>
    
    <!-- メニュー -->
    <header class="header js-float-menu">
  <h1 class="title"><a href="index.php"><img class="header-logo" src="common/img/logo.png" alt=""></a></h1>
  <nav class="mypage-nav-menu js-toggle-sp-menu-target">
    <ul class="mypage-menu">
      <li class="mypage-menu-item"><a class="menu-link" href="mypage.php">マイページ</a></li>
      <li class="mypage-menu-item"><a class="menu-link" href="registProduct.php">商品を出品する</a></li>
      <li class="mypage-menu-item"><a class="menu-link" href="profEdit.php">プロフィール編集</a></li>
      <li class="mypage-menu-item"><a class="menu-link" href="passEdit.php">パスワード変更</a></li>
      <li class="mypage-menu-item"><a class="menu-link" href="withdraw.php">退会</a></li>
      <li class="mypage-menu-item"><a class="menu-link" href="logout.php">ログアウト</a></li>
    </ul>
  </nav>
  <div class="mypage-setting js-toggle-mypage-menu">
    <div class="mypage-setting-img">
      <img src="<?php echo $userData['pic']? $userData['pic']: 'common/img/chara01.jpg'; ?>" alt="マイプロフィール画像">
    </div>
    <p>ナビメニュー</p>
  </div>
</header>
    
    <p id="js-show-msg" style="display:none;" class="msg-slide">
      <?php echo getSessionFlash('msg_success'); ?>
    </p>

    <!-- メインコンテンツ -->
    <div id="contents" class="site-width">
      
      <h1 class="page-title">MYPAGE</h1>

      <!-- Main -->
      <section id="main">
         <section class="list panel-list u-mb2em">
           <h2 class="title" style="margin-bottom:15px;">
            登録商品一覧
           </h2>
           <?php
             if(!empty($productData)):
              foreach($productData as $key => $val):
            ?>
              <a href="registProduct.php<?php echo (!empty(appendGetParam())) ? appendGetParam().'&p_id='.$val['id'] : '?p_id='.$val['id']; ?>" class="panel">
                <div class="panel-head">
                  <img src="<?php echo showImg(sanitize($val['pic1'])); ?>" alt="<?php echo sanitize($val['name']); ?>">
                </div>
                <div class="panel-body">
                  <p class="panel-title"><?php echo sanitize($val['name']); ?> <span class="price">¥<?php echo sanitize(number_format($val['price'])); ?></span></p>
                </div>
              </a>
            <?php
              endforeach;
             endif;
            ?>
         </section>
         
        <section class="list list-table mt-2em">
          <h2 class="title">
            連絡掲示板一覧
          </h2>
          <table class="table">
            <thead>
              <tr>
                <th>最新送信日時</th>
                <th>取引相手</th>
                <th>メッセージ</th>
              </tr>
            </thead>
            <tbody>
             <?php
              if(!empty($bordData)){
                foreach($bordData as $key => $val){
                  if(!empty($val['msg'])){
                    $msg = array_shift($val['msg']);
             ?>
                 <tr>
                    <td><?php echo sanitize(date('Y.m.d H:i',strtotime($msg['send_date']))); ?></td>
                    <td><?php echo sanitize(getUser($val['buy_user'])['username']); ?></td>
                    <td><a href="msg.php?m_id=<?php echo sanitize($val['id']); ?>"><?php echo mb_substr(sanitize($msg['msg']),0,40); ?>...</a></td>
                </tr>
             <?php
                  }else{
             ?>
                 <tr>
                    <td>--</td>
                    <td>◯◯ ◯◯</td>
                    <td><a href="msg.php?m_id=<?php echo sanitize($val['id']); ?>">まだメッセージはありません</a></td>
                </tr>
              <?php
                  }
                }
              }
            ?>
            </tbody>
          </table>
        </section>
        
        <section class="list panel-list mt-2em">
          <h2 class="title" style="margin-bottom:15px;">
            お気に入り一覧
          </h2>
          <?php
             if(!empty($likeData)):
              foreach($likeData as $key => $val):
            ?>
              <a href="productDetail.php<?php echo (!empty(appendGetParam())) ? appendGetParam().'&p_id='.$val['id'] : '?p_id='.$val['id']; ?>" class="panel">
                <div class="panel-head">
                  <img src="<?php echo showImg(sanitize($val['pic1'])); ?>" alt="<?php echo sanitize($val['name']); ?>">
                </div>
                <div class="panel-body">
                  <p class="panel-title"><?php echo sanitize($val['name']); ?> <span class="price">¥<?php echo sanitize(number_format($val['price'])); ?></span></p>
                </div>
              </a>
          <?php
            endforeach;
           endif;
          ?>
        </section>
      </section>
      </div>

    <!-- footer -->
    <?php
      require('footer.php'); 
    ?>