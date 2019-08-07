<?php
//定数名は変数名と同様の規則
//定数は慣習的に大文字で表記される
//定数にスコープはない
//定数は宣言後変更または未定義にすることが出来ない
define("CONSTANT", "Hello world.");
echo CONSTANT;
//Constantにするとエラー
const Constant = 'Hello world';
echo Constant.PHP_EOL;
const ANOTHER_Constant = Constant.';Goodbye World';
echo ANOTHER_Constant.PHP_EOL;
//以上のように定義できる
define('ANIMALS',array(
    'dog',
    'cat',
    'bird'
));
const FISH = array(
    'tuna',
    'octopus'
);
//配列も定数にできる
//自動的に定義される定数が複数ある
?>
<?php
//PHPは式志向の言語でありほとんどすべてが式である
//式は右から左に実行される
$a = 0;
echo ++$a;
echo $a++;
//上は加算してから表示(1になった後1を表示)、下は表示してから加算(1表示後2になる)
$a += 3;
//これも可、C++と同じ
$b = '';
$a != 0 ? $b = 'YES' : $b = 'NO';
echo $b.PHP_EOL;
//C++のように三項演算子も使える
?>
<?php

