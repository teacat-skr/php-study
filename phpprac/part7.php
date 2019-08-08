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
//演算子とはいくつかの値から別な値を生み出すもの
//演算子には優先順位と結合度合いがある
//実際には必要ない場合でも()を使って演算の順番を明確にしたほうが可読性が上がるため良い
$a = 3 * 3 % 5;//= 4
$a = true ? 0 : true ? 1 : 2;//(true ? 0 : true) ? 1 : 2
$a = 1;
$b = 2;
$a = $b += 3;//$a = 5 $b = 5
//式の評価順は決まっていないので動作が担保されない場合がある
$a = 1;
echo $a + $a++;
//2または3が出力されるが不定
$i = 1;
$array[$i] = $i++;
var_dump($array);
//添え字1にセットされるか添え字2にセットされるかは不定
//特定の順序で評価されることを期待した上記のようなコードは書いてはいけない
$x = 4;
echo "x - 1 =".$x - 1 . ", or so I hope\n";
echo "x - 1 =".($x - 1) . ", or so I hope\n";
//+と=と.の優先順位は同じなので()を付けないと予期せぬ結果になる
