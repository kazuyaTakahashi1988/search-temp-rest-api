<ul id="domList">
    <li>
        <a href="#">
            <div class="postId">ID：xxxx</div>
            <div class="title">TITLE：xxxxxxxx</div>
            <div class="content">CONTENT：xxxxxxxx</div>
        </a>
    </li>
</ul>

<?php
/* -----------------------------------------------------
	JSの処理は以下のものが全てです
    他「 _categoryBox.php 」「 lib/endpoint.php 」ファイル
    との連携で検索システムの実装をしています。
------------------------------------------------------ */
?>
<script>
    const WP_HOST = "<?php echo HOME_URL; ?>";
    const POST_TYPE = "<?php echo $post_type; ?>";
</script>

<!-- 以下から外部ファイル化してOK -->
<script>
    const xhr = new XMLHttpRequest();
    const apiURL = WP_HOST + '/wp-json/wp/v2/org_api?post=' + POST_TYPE;
    let apiParam = '';

    /* ----------------------------------------------------------
        ★01 項目のクリックイベント発火処理
    ---------------------------------------------------------- */
    const checkBox01 = document.getElementsByClassName('jscheckBox01'); // カテゴリー01のチェックボックス
    const checkBox02 = document.getElementsByClassName('jscheckBox02'); // カテゴリー02 〜
    const checkBox03 = document.getElementsByClassName('jscheckBox03'); // カテゴリー03 〜
    apiChecked(checkBox01, '&taxCategory01[]=');
    apiChecked(checkBox02, '&taxCategory02[]=');
    apiChecked(checkBox03, '&taxCategory03[]=');

    function apiChecked(checkClass, format) {
        for (let i = 0; i < checkClass.length; i++) {
            checkClass[i].addEventListener(
                'change',
                function() {
                    const apiNam = format + this.getAttribute('value');
                    if (this.checked === true) {
                        apiParam += apiNam;
                        apiEvent(apiParam); // ★02 の処理へ
                    } else {
                        apiParam = apiParam.replace(apiNam, '');
                        apiEvent(apiParam); // ★02 の処理へ
                    }
                },
                false,
            );
        }
    }

    /* ----------------------------------------------------------
        ★02 非同期通信 apiEvent() の処理
    ---------------------------------------------------------- */
    function apiEvent(param) {
        xhr.open('GET', apiURL + param);
        xhr.send();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const jsonDate = JSON.parse(xhr.responseText);
                // console.log(jsonDate);
                const domList = document.getElementById('domList');
                DomSet(domList, jsonDate); // ★03 の処理へ
            }
        };
    }

    /* ----------------------------------------------------------
        ★03 DOMの生成と当て込み DomSet() の処理
    ---------------------------------------------------------- */
    function DomSet(domListArg, jsonDateArg) {
        let htmlDocument = '';
        for (let index = 0; index < jsonDateArg.length; index++) {
            const element = jsonDateArg[index];

            htmlDocument += '<li>';
            htmlDocument += '<a href="' + element.getPermalink + '">';
            htmlDocument +=
                '<div class="title">TITLE：' + element.getTheTitle + '</div>';
            htmlDocument += '<div class="postId">ID：' + element.id + '</div>';
            htmlDocument += '<div class="content">' + element.getTheContent + '</div>';
            for (let index = 0; index < element.getTaxCategory01.length; index++) {
                htmlDocument +=
                    '<span class="taxCat">・' +
                    element.getTaxCategory01[index].name +
                    '</span>';
            }
            for (let index = 0; index < element.getTaxCategory02.length; index++) {
                htmlDocument +=
                    '<span class="taxCat">・' +
                    element.getTaxCategory02[index].name +
                    '</span>';
            }
            for (let index = 0; index < element.getTaxCategory03.length; index++) {
                htmlDocument +=
                    '<span class="taxCat">・' +
                    element.getTaxCategory03[index].name +
                    '</span>';
            }
            htmlDocument += '</a>';
            htmlDocument += '</li>';
        }
        if (jsonDateArg.length > 0) {
            domListArg.innerHTML = htmlDocument;
        } else {
            domListArg.innerHTML = '該当の記事はありません。';
        }
    }
</script>