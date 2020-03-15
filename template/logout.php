<?php
//共通変数・関数ファイルを読込み
require('function.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ログアウトページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

debug('ログアウトします。');
// セッションを削除（ログアウトする）
session_destroy();
debug('トップページへ遷移します。');
// トップページへ
header("Location:index.php");