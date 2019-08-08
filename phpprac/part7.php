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
//echo "x - 1 =".$x - 1 . ", or so I hope\n";これだとおかしくなる
echo "x - 1 =".($x - 1) . ", or so I hope\n";
//+と=と.の優先順位は同じなので()を付けないと予期せぬ結果になる
$a = '-11workers';
echo $a.PHP_EOL;
echo +$a.PHP_EOL;
$a = (int)$a;
echo $a.PHP_EOL;
//単項演算子として+を使うとキャストした時と同様の結果になる?
//単項演算子として-を使った演算結果はC++と同様
//また二項演算子+=*/%も同様
$a = 2;
$a = $a ** 10;
echo $a.PHP_EOL;
//Pythonと同様に累乗が使える
//除算/は二つのオペランドが整数かつ割り切れる場合整数型を返し、それ以外は小数型を返す
//二つの整数型のオペランドの二項演算で整数の結果(JAVA、C++的な結果)を得たい場合はintdiv()を使う
//剰余%は端数切捨てで整数型どうしの演算として処理される。fmod()を使うと切り捨てが行われない
//また、結果は$a % $b の$aと同様の符号となる
$a = ($b = 4) + 5;
//$a = 9になる。
//代入演算子は左オペランドに右オペランドの式な値を設定することを意味する
$a = 3;
$b = &$a;
print "$a\n";
print "$b\n";
$a = 4;
print "$a  $b\n";
//参照による代入も可能
//new演算子はもともと参照を返すので&を使うとエラーが出る
//ビット演算子もC++と同様
//右シフト時は符号が保たれ左シフト時は0で埋められる