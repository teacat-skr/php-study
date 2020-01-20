<?php
//型:配列
$array = array(
    "foo" => "bar",
    "bar" => "foo",
);
//array()を[]としても可能
//keyはintとして妥当だとキャストされる、nullは""にキャストされる
var_dump($array);
?>
<?php
$array = array(
    1 => "a",
    "1" => "b",
    1.5 => "c",
    true => "d",
);
var_dump($array);
//array(1) {
//  [1]=>
//  string(1) "d"
//}
//すべてkyeが１にキャストされ、かきかえられて"d"だけになる
//C++のarrayとmapと同等
$array2 = array(
    "foo",
    "few",
    "fow",
);
var_dump($array2);
//keyを省略すると今まで使われた最大値+1のkeyが使われる
//最後の要素の後に,はいらないが要素が加えやすいのであってもいい
?>
<?php
$array = array(
    "foo" => "bar",
    42 => 24,
    "multi" => array(
        "dimensional" => array(
            "array" => "foo",
        )
    )
);
var_dump($array{"foo"});
var_dump($array[42]);
var_dump($array["multi"]["dimensional"]["array"]);
//このようにアクセスできる
//[]を{}としても良い
function getArray(){
    return array(1, 2, 3);
}
$secondElements = getArray()[1];
//配列のデリファレンス、昔はできなかった;
$array["foo"] = "bow";
var_dump($array["foo"]);
//多言語と同様に書き換えできる
//変数がない（$arrayが以前には宣言されていない）場合は作成されるがあまり使うべきではない
?>
<?php
$arr = array(5 => 1, 12 => 2);
$arr[] = 56; // = ($arr[13] = 56)　要素の追加
unset($arr[5]);
//要素削除
unset($arr);
//配列削除
$array = array(1, 2, 3, 4, 5);
print_r($array);
foreach ($array as $item => $value) {
    unset($array[$item]);
}
print_r($array);
//配列の全要素のみ削除、配列自体は生存
$array[] = 6;
//keyは0ではなく5となる
$array = array_values($array);
//添え字の振り直し
$array[] = 7;//keyは1
print_r($array);
//未定義の定数をkeyとして扱った場合クオートされて文字列とし扱われるがエラーも出る
//定数は文字列の中では解釈されない
//{}でくくると解釈させられる
class A {
    private $A;//'\0A\0A'
}
class B extends A{
    private $A;//'\0B\0A'
    public $AA;//'AA'
}
var_dump((array) new B());
//objectの配列を作ると一見同じkeyに見えるがprivate,protectedはクラス名がナル文字\0で挟まれている
//array(3) {
//  [" B A"]=>
//  NULL
//  ["AA"]=>
//  NULL
//  [" A A"(//'\0A\0A')]=>
//  NULL
//}
$count = count($array);
echo $count;
//count関数で要素数を数えられる
//配列の代入は基本コピーされる
