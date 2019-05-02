<?php
$exe = 1;
//phpの変数は頭文字に$をつける
$a_bool = true;
$a_str = "foo";
$a_str2 = 'foo';
$an_int = 12;
//pythonのように勝手に型推定してくれる。
echo gettype($a_str);
//gettype関数を使えば型名を取得できる
if(is_int($an_int)){
    $an_int += 4;
}
//is_XX関数(XXは型名)でその型かどうかの真偽値を返す
//boll型は一般的な言語と同様
//int型も同様だがunsignedはない
echo PHP_INT_MAX;
echo PHP_INT_MIN;
//最大値最小値が取得できる
var_dump($an_int);
//変数の型と値がvar_dump()で出力できる
$an_int = PHP_INT_MAX * 2;
var_dump($an_int);
//int型でオーバーフローすると勝手にfloatにキャストされる
$sub = 25 / 7;
var_dump($sub);
var_dump((int)$sub);
var_dump(round($sub));
//キャストで0方向に丸め、roundで四捨五入
//小数の気を付けるべきところはC++と同じ
//C++のように整数の割り算はない(1 / 2 = 0とならず0.5となる)
