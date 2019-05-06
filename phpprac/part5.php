<?php
//foreachでたどれることだけが分かればいいときに使える疑似型のIterable型がある
class foo {
    function do_foo() {
        echo "foo を実行します。\n";
    }
}
$bar = new foo;
$bar ->do_foo();
//オブジェクト、読んだそのまま
$obj = (object) array('1' => 'foo');
var_dump(isset($obj->{'1'}));
var_dump(key($obj));
//string(1) "1"になる。資料が間違えてる?
$obj = (object) 'ciao';
echo $obj->scalar;
//scalarに格納
//リソース型はファイル、データベース接続などの特別なハンドルを保持するため変換不可
//データベース接続以外は参照されなくなると勝手にGCが削除してくれる
$var = NULL;
//NULL型、大文字小文字の区別なし(nullでも可)
//NULLへのキャストは非推奨


