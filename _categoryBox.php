<?php
$post_type  = "custompost";  // 投稿タイプ名を記入
$postTaxName01 = 'taxCategory01'; // その１のタクソノミースラッグ名を記入
$postTaxName02 = 'taxCategory02'; // その２の〜
$postTaxName03 = 'taxCategory03'; // その３の〜
// $postTaxName04 = 'taxCategory04';  // その４の〜
?>
<div class="new-serch">
    <?php
    /* -------------------------------------
        ▽▽▽ カテゴリー01　start ▽▽▽
    ------------------------------------- */
    ?>
    <div class="category-list">
        <h3>【 カテゴリ名01 】</h3>
        <?php
        $tax_name = $postTaxName01;  // タクソノミー名
        $tax_query = get_categories(array(
            'type'       => $post_type,
            'taxonomy'   => $tax_name,
            'parent'     => 0,
            'orderby'    => '',
            'order'      => 'ASC',
            'hide_empty' => false,
        ));
        foreach ((array)$tax_query as $tax) : if (!$tax->parent) : ?>

                <input type="checkbox" name="<?php echo $tax_name; ?>[]" id="checkbox_<?php echo urlencode($tax->term_id); ?>" value="<?php echo urlencode($tax->term_id); ?>" class="jscheckBox01"><label for="checkbox_<?php echo urlencode($tax->term_id); ?>"><?php echo $tax->name; ?></label><br>

                <?php //子カテゴリ用の処理（親のみの処理でいい場合は以下endifまで除去）
                $child_cat_num = count(get_term_children($tax->cat_ID, $tax_name));
                if ($child_cat_num > 0) :
                    $tax_children_args = array('parent' => $tax->cat_ID);
                    $tax_children = get_categories(array(
                        'taxonomy'   => $tax_name,
                        'parent'     => $tax->cat_ID,
                        'orderby'    => '',
                        'order'      => 'ASC',
                        'hide_empty' => false,
                    ));
                    foreach ((array)$tax_children as $child_val) : ?>

                        --<input type="checkbox" name="<?php echo $tax_name; ?>[]" id="checkbox_<?php echo urlencode($child_val->term_id); ?>" value="<?php echo urlencode($child_val->term_id); ?>" class="jscheckBox01">
                        <label for="checkbox_<?php echo urlencode($child_val->term_id); ?>"><?php echo $child_val->name; ?></label><br>

                    <?php endforeach;
                else : ?>
                    <!-- 子カテゴリなしの時の記述 -->
                <?php endif; ?>

        <?php endif;
        endforeach; ?>
    </div>
    <!-- ☆☆☆　カテゴリー01　end　☆☆☆ -->

    <?php
    /* -------------------------------------
        ▽▽▽ カテゴリー02　start ▽▽▽
    ------------------------------------- */
    ?>
    <div class="category-list">
        <h3>【 カテゴリ名02 】</h3>
        <?php
        $tax_name = $postTaxName02;  // タクソノミー名
        $tax_query = get_categories(array(
            'type'       => $post_type,
            'taxonomy'   => $tax_name,
            'parent'     => 0,
            'orderby'    => '',
            'order'      => 'ASC',
            'hide_empty' => false,
        ));
        foreach ((array)$tax_query as $tax) : if (!$tax->parent) : ?>

                <input type="checkbox" name="<?php echo $tax_name; ?>[]" id="checkbox_<?php echo urlencode($tax->term_id); ?>" value="<?php echo urlencode($tax->term_id); ?>" class="jscheckBox02"><label for="checkbox_<?php echo urlencode($tax->term_id); ?>"><?php echo $tax->name; ?></label><br>

                <?php //子カテゴリ用の処理（親のみの処理でいい場合は以下endifまで除去）
                $child_cat_num = count(get_term_children($tax->cat_ID, $tax_name));
                if ($child_cat_num > 0) :
                    $tax_children_args = array('parent' => $tax->cat_ID);
                    $tax_children = get_categories(array(
                        'taxonomy'   => $tax_name,
                        'parent'     => $tax->cat_ID,
                        'orderby'    => '',
                        'order'      => 'ASC',
                        'hide_empty' => false,
                    ));
                    foreach ((array)$tax_children as $child_val) : ?>

                        --<input type="checkbox" name="<?php echo $tax_name; ?>[]" id="checkbox_<?php echo urlencode($child_val->term_id); ?>" value="<?php echo urlencode($child_val->term_id); ?>" class="jscheckBox02">
                        <label for="checkbox_<?php echo urlencode($child_val->term_id); ?>"><?php echo $child_val->name; ?></label><br>

                    <?php endforeach;
                else : ?>
                    <!-- 子カテゴリなしの時の記述 -->
                <?php endif; ?>

        <?php endif;
        endforeach; ?>
    </div>
    <!-- ☆☆☆　カテゴリー02　end　☆☆☆ -->

    <?php
    /* -------------------------------------
        ▽▽▽ カテゴリー03　start ▽▽▽
    ------------------------------------- */
    ?>
    <div class="category-list">
        <h3>【 カテゴリ名03 】</h3>
        <?php
        $tax_name = $postTaxName03;  // タクソノミー名
        $tax_query = get_categories(array(
            'type'       => $post_type,
            'taxonomy'   => $tax_name,
            'parent'     => 0,
            'orderby'    => '',
            'order'      => 'ASC',
            'hide_empty' => false,
        ));
        foreach ((array)$tax_query as $tax) : if (!$tax->parent) : ?>

                <input type="checkbox" name="<?php echo $tax_name; ?>[]" id="checkbox_<?php echo urlencode($tax->term_id); ?>" value="<?php echo urlencode($tax->term_id); ?>" class="jscheckBox03"><label for="checkbox_<?php echo urlencode($tax->term_id); ?>"><?php echo $tax->name; ?></label><br>

                <?php //子カテゴリ用の処理（親のみの処理でいい場合は以下endifまで除去）
                $child_cat_num = count(get_term_children($tax->cat_ID, $tax_name));
                if ($child_cat_num > 0) :
                    $tax_children_args = array('parent' => $tax->cat_ID);
                    $tax_children = get_categories(array(
                        'taxonomy'   => $tax_name,
                        'parent'     => $tax->cat_ID,
                        'orderby'    => '',
                        'order'      => 'ASC',
                        'hide_empty' => false,
                    ));
                    foreach ((array)$tax_children as $child_val) : ?>

                        --<input type="checkbox" name="<?php echo $tax_name; ?>[]" id="checkbox_<?php echo urlencode($child_val->term_id); ?>" value="<?php echo urlencode($child_val->term_id); ?>" class="jscheckBox03">
                        <label for="checkbox_<?php echo urlencode($child_val->term_id); ?>"><?php echo $child_val->name; ?></label><br>

                    <?php endforeach;
                else : ?>
                    <!-- 子カテゴリなしの時の記述 -->
                <?php endif; ?>

        <?php endif;
        endforeach; ?>
    </div>
    <!-- ☆☆☆　カテゴリー03　end　☆☆☆ -->

    <?php
    /* -------------------------------------
        ▽▽▽ カテゴリー04　start ▽▽▽
    ------------------------------------- */
    ?>
    <?php /* ?>
    <div class="category-list">
        <h3>【 カテゴリー04 】</h3>
    <?php
    $tax_name = $postTaxName04;  // タクソノミー名
    $tax_query = get_categories(array(
        'type'       => $post_type,
        'taxonomy'   => $tax_name,
        'parent'     => 0,
        'orderby'    => '',
        'order'      => 'ASC',
        'hide_empty' => false,
    ));
    foreach ((array)$tax_query as $tax) : if (!$tax->parent) : ?>

        <input type="checkbox" name="<?php echo $tax_name; ?>[]" id="checkbox_<?php echo urlencode($tax->term_id); ?>" value="<?php echo urlencode($tax->term_id); ?>" class="jscheckBox04"><label for="checkbox_<?php echo urlencode($tax->term_id); ?>"><?php echo $tax->name; ?></label><br>

            <?php //子カテゴリ用の処理（親のみの処理でいい場合は以下endifまで除去）
            $child_cat_num = count(get_term_children($tax->cat_ID, $tax_name));
            if ($child_cat_num > 0) :
                $tax_children_args = array('parent' => $tax->cat_ID);
                $tax_children = get_categories(array(
                    'taxonomy'   => $tax_name,
                    'parent'     => $tax->cat_ID,
                    'orderby'    => '',
                    'order'      => 'ASC',
                    'hide_empty' => false,
                ));
                foreach ((array)$tax_children as $child_val) : ?>

                --<input type="checkbox" name="<?php echo $tax_name; ?>[]" id="checkbox_<?php echo urlencode($child_val->term_id); ?>" value="<?php echo urlencode($child_val->term_id); ?>" class="jscheckBox04">
                    <label for="checkbox_<?php echo urlencode($child_val->term_id); ?>"><?php echo $child_val->name; ?></label><br>

            <?php endforeach;
            else : ?>
                 子カテゴリなしの時の記述
            <?php endif; ?>

    <?php endif;
    endforeach; ?>
    </div>
    <?php */ ?>
    <!-- ☆☆☆　カテゴリー04　end　☆☆☆ -->
</div>