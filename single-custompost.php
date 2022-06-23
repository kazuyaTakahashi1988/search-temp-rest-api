<?php
$postName = esc_html(get_post_type_object(get_post_type())->label); // カスタム投稿名
$args = [
    'pageTtl' => get_the_title() . '｜' . $postName . '｜' . SITE_NAME, // タイトル
    'pageDes' => wp_trim_words(get_the_content(), 135, ''), // ディスクリプション
    'pageKey' => get_the_title() . 'のキーワード', // キーワード
    'ogpImg' => get_the_post_thumbnail_url(), // OGP画像
    // 'pageCss' => 'xxxx.css', // cssファイル
    // 'pageJs' => 'xxxx.min.js', // jsファイル
    // 'queryParam' => $_GET['query'], // クエリーパラメーター
];
get_header(null, $args);
?>

<div class="contswrap">
    <?php
    /* --------------------------
        詳細 ▽ start ▽
    ----------------------------------- */
    while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="wysiwyg">
            <?php the_content(); ?>
        </div>

    <?php endwhile;
    /* --------------------------
        詳細 ▲ end ▲ 
    ----------------------------------- */ ?>

    <?php
    /* --------------------------
        ページャー ▽ start ▽
    ----------------------------------- */ ?>
    <ul>
        <li><?php previous_post_link('%link', '&lsaquo;', false, ''); ?></li>
        <li><?php next_post_link('%link', '&rsaquo;', false, ''); ?></li>
    </ul>
    <?php
    /* --------------------------
        ページャー ▲ end ▲ 
    ----------------------------------- */ ?>
</div>

<?php get_footer(null, $args); ?>