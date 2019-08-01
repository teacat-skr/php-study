<?php
//変数名は$のあと英大文字小文字区別ありでつけることができる
$foo = 'bob';
$bar = &$foo;
//参照、C言語等と同様
//右辺値は参照できない
//変数を初期化することは良いこと
$unset_obj -> foo = 'bar';
var_dump($unset_obj);
//objectの初期化はwarningが出る?
//初期化されていない値を使用するのはincludeしたほかのファイルで同盟の変数が使用されていると問題が起こる
//PHPには定義済みの多くの変数がある
?>
<?php
$a = 1;
//include 'b.inc';
//上の場合$aはb.inc内でも利用可能
$b = 2;
function test () {
    echo $b;
}
test();
//不意の書き換えを行わないために関数内にスコープは及ばない
//この場合は関数内の$b = nullなため何も表示されない
function sum () {
    global $a, $b;
    $b = $a + $b;
}
sum();
echo $b;
//globalを使用することでグローバル変数を参照できる
$a = 1;
$b = 2;
function sum2 () {
    $GLOBALS['b'] = $GLOBALS['a'] + $GLOBALS['b'];
}
sum2();
echo $b;
//同じ結果になる
//$GLOBALSは連想配列でありグローバル変数名がキー、内容が配列要素の値となっている

?>


