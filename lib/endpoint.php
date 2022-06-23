<?php

/* ---------------------------------------------------
    独自APIを[ root/wp-json/wp/v2/org_api?post=xxxx ]で作成します
--------------------------------------------------- */
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/org_api', array(
        'methods' => 'GET',
        'callback' => 'org_api', // org_api()を呼び出します
    ));
});

/* ---------------------------------------------------
    org_api() START
--------------------------------------------------- */
function org_api()
{
    /* ----------------------------------------------
        ▽ 取得したクエリーを変数にセット ▽
    ---------------------------------------------- */
    $post_tag_category01 = $_GET['taxCategory01']; // カテゴリー01のURLクエリ
    $post_tag_category02 = $_GET['taxCategory02']; // カテゴリー02の~~~
    $post_tag_category03 = $_GET['taxCategory03']; // カテゴリー03の~~~
    // $post_tag_category03 = $_GET['taxCategory03']; // カテゴリー04の~~~
    // クエリ文字列にアンダバーやハイフン[ _ , - ]はバグの元なので注意

    if (isset($post_tag_category01)) { // カテゴリー01のクエリ情報があったら
        $taxquery_category01 = array(
            'taxonomy' => 'taxCategory01', // tax スラッグの指定
            'terms' => $post_tag_category01, // タームIDの指定
            'field' => 'term_id',
            // 'include_children' => false, // 子タームがあるのなら true
            // 'operator' => 'AND' // AND またわ OR の設定
        );
    }
    if (isset($post_tag_category02)) { // カテゴリー02のクエリ情報があったら
        $taxquery_category02 = array(
            'taxonomy' => 'taxCategory02',
            'terms' => $post_tag_category02,
            'field' => 'term_id',
            //
        );
    }
    if (isset($post_tag_category03)) { // カテゴリー03のクエリ情報があったら
        $taxquery_category03 = array(
            'taxonomy' => 'taxCategory03',
            'terms' => $post_tag_category03,
            'field' => 'term_id',
            //
        );
    }
    /*
    if (isset($post_tag_category04)) { // カテゴリー04のクエリ情報があったら
        $taxquery_category04 = array(
            'taxonomy' => 'taxCategory04',
            'terms' => $post_tag_category04,
            'field' => 'term_id',
            //
        );
    }
    */

    /* ----------------------------------------------
        ▽ セットしたもので記事を取得＆JSONレスポンス ▽
    ---------------------------------------------- */
    $contents = array(); //return用の配列
    $myQuery = new WP_Query(); //取得したいデータを設定
    $param = array(
        'post_type' => $_GET['post'],
        // 'paged' => get_query_var('paged'), //注意２：ページ送りを機能させる
        'posts_per_page'   => -1,
        'orderby'          => 'date',
        'order'            => 'ASC',
        'post_status'      => 'publish',
        'caller_get_posts' => 1,
        'tax_query'        => array('relation' => 'AND'), // AND またわ OR の設定
    );

    if ($post_tag_category01[0]) {
        array_push($param['tax_query'], array($taxquery_category01));
    } // tax_queryにカテゴリー01を指定
    if ($post_tag_category02[0]) {
        array_push($param['tax_query'], array($taxquery_category02));
    } // tax_queryにカテゴリー02を〜
    if ($post_tag_category03[0]) {
        array_push($param['tax_query'], array($taxquery_category03));
    } // tax_queryにカテゴリー03を〜
    /*
    if ($post_tag_category04[0]) {
        array_push($param['tax_query'], array($taxquery_category04));
    } // tax_queryにカテゴリー04を〜
    */

    $myQuery->query($param);
    if ($myQuery->have_posts()) :
        while ($myQuery->have_posts()) : $myQuery->the_post();

            /* ---------------------------------------
                ▽ api 取得項目 ▽
            --------------------------------------- */
            $id = get_the_ID(); // id
            $getPermalink = get_permalink(); // パーマリンク
            $getThePostThumbnailUrl = get_the_post_thumbnail_url($id, ''); // サムネイル画像
            $getTheTitle = get_the_title(); // タイトル
            $getTheContent = get_the_content(); // コンテンツ
            // $getField01 = get_field('xxxxxxx'); // カスタムフィールド
            // $getField02 = get_field('xxxxxxx'); // カスタムフィールド
            $getTaxCategory01 = get_the_terms($id, 'taxCategory01'); // tax[カテゴリー01]
            $getTaxCategory02 = get_the_terms($id, 'taxCategory02'); // tax[カテゴリー02]
            $getTaxCategory03 = get_the_terms($id, 'taxCategory03'); // tax[カテゴリー03]

            /* ---------------------------------------
                ▽ 取得項目を[$contents]に格納 ▽
            --------------------------------------- */
            array_push($contents, array(
                "id" => $id,
                "getPermalink" => $getPermalink,
                "getThePostThumbnailUrl" => $getThePostThumbnailUrl,
                "getTheTitle" => $getTheTitle,
                "getTheContent" => $getTheContent,
                // "getField01" => $getField01,
                // "getField02" => $getField02,
                "getTaxCategory01" => $getTaxCategory01,
                "getTaxCategory02" => $getTaxCategory02,
                "getTaxCategory03" => $getTaxCategory03,
            ));

        endwhile;
    endif;

    /* ---------------------------------------
        ▽ [$contents]内容をapiレスポンス ▽
    --------------------------------------- */
    return $contents; // json_encodeは必要ありません。

} // function org_api() END
