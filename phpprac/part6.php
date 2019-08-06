<?php
//変数名は$のあと英大文字小文字区別ありでつけることができる
$foo = 'bob';
$bar = &$foo;
//参照、C言語等と同様
//右辺値は参照できない
//変数を初期化することは良いことである
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
echo $b,PHP_EOL;
//同じ結果になる
//$GLOBALSは連想配列でありグローバル変数名がキー、内容が配列要素の値となっている
?>
<?php
function test1 () {
    $a = 0;
    echo $a;
    $a++;
}
//この場合関数が呼び出されるごとに$aが宣言され解体されるため$a++は無駄である
function test2 () {
    static $a = 0;
    echo $a;
    $a++;
}
//staticで静的な宣言すると一度目だけ初期化され、以降解体されずインクリメントされ続けられる
//静的な宣言は関数を用いた宣言はできない ex)static $int = sqrt(121)
//リファレンスは静的に保存できない
?>
<?php
$a = 'hello';
$$a = 'world';
//変数を可変にすることができる
echo "$a ${$a}",PHP_EOL;
echo "$a $hello",PHP_EOL;
//同じ結果になる
//$$a[1]とかくと${$a[1]}なのか${$a}[1]なのかを区別して解釈させなければならない
//クラスのプロパティ名も同様に可変プロパティ名でアクセスできる
class foo{
    var $bar = 'I am bar';
}
$foo = new foo();
$start = 'b';
$end = 'ar';
echo $foo ->{$start. $end};
//プロパティ名をこのようにも記述できる
//echo $_POST['username'];
//echo $_REQUEST['username'];
//HTMLホームからデータにアクセスする方法は上位の二つのみ
//PHP5.4.0以前のバージョンではほかにもあった

//PHPは送られた変数名にピリオド(.)があった場合アンダースコア(_)に自動で変換する

