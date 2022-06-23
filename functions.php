<?php
require_once('lib/const.php');               // 定数
require_once('lib/souce-del.php');           // 不要なソース(絵文字・ver情報など)の削除
require_once('lib/img.php');                 // 画像
require_once('lib/post-custom.php');         // 投稿改変
require_once('lib/func.php');                // 関数
require_once('lib/shortcode.php');           // ショートコード

/* ----------------------------------
    api 独自エンドポイント
-------------------------------------*/
require_once('lib/endpoint.php');
// 独自APIを[ root/wp-json/wp/v2/org_api?post=xxxx ]で作成します
// ( xxxx は投稿タイプ )

/* ----------------------------------
    カスタム投稿宣言
-------------------------------------*/
require_once('lib/add-custompost.php'); 
require_once('lib/rewrite.php');      
// コメントイン・アウトやファイル編集をしたらマメに管理画面「設定→パーマリンク→変更を保存」の更新をしてください。
