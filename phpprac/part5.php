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
//上記以外の場合scalarに格納
