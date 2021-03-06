<?php
//定数-演算子
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
//C++で使える比較演算子は普通に使える
$a = 1;
$b = 1;
$c = ($a === $b);
echo $c.PHP_EOL;
//===は型が同じでかつ値も同じときtrueを返す
//!==も型まで判定
//!=と<>は同じ結果になる
$A = 1;
$B = 100;
echo($A <=> $B).PHP_EOL;
$B = 1;
echo($A <=> $B).PHP_EOL;
$A = 100;
echo($A <=> $B).PHP_EOL;
//宇宙船というらしい。$a<$bのとき負の値、$a==$bのとき0、$a>$bのとき正の値を返す
//C++20にはこの演算子が使えるらしい
var_dump(-10 < false);
//-10はbool型にキャストされるのでfalse
//bool型はnull<false<true
//三項演算子は可読性が下がるので入れ子になるべくしない
$action = $s ?? 1;
//??(null合体演算子)を使うと$sの部分がnullじゃないなら$sを、nullなら1を代入するような式をかける
$value = @$cache[$key];
//@(エラー制御演算子)は上記のように本来keyがなくてエラーが起こるような場合でも無視できる
//式なら動作する
$output = `ls -al`;
echo "<pre>$output</pre>";
//``(バッククォート)を用いるとその中身をシェルコマンドとして処理する
?>
<?php
//前置インクリメント/デクリメントは加算/減算処理してから値を返す、後置は逆
$s = 'W';
for ($i = 0; $i < 6; $i++){
    echo ++$s.PHP_EOL;
}
//文字コードが加算されず、カウント式に増えていく ex)Z -> AA -> AB
//アルファベット、数字以外の文字列や数値、文字列以外の型はインクリメント/デクリメントしても変化しない
//nullはデクリメントしても変化しないが、インクリメントすると1になる
//論理演算子はC++とほぼ同じだが、&&>andのように優先順位が変わる
$a = 'hello';
$a .= 'world';
echo $a.PHP_EOL;
//文字列結合、C++でいう+=
//配列どうしは+で結合できる。同じキーがある場合は左にオペランドの要素が優先される
//また、==で同等なこと、===で同一なこと、!=または<>で等しくないこと、!==で同一でないことが比較できる
//配列が等しいとは同じキーと値があること。同一とは型、並び順まで同じということ。
class MyClass {

}
class NotMyClass {

}
$a = new MyClass();
var_dump($a instanceof MyClass);
var_dump($a instanceof NotMyClass);
//instanceof クラス名でそのクラスのオブジェクトか判別できる
class ChildClass extends MyClass{

}
$b = new ChildClass();
var_dump($b instanceof ChildClass);
var_dump($b instanceof MyClass);
//継承したクラスのオブジェクトのインスタンスかの判断も可能
interface MyInterface {

}
class MyClassB implements MyInterface{

}
$c = new MyClassB();
var_dump($c instanceof MyInterface);
//インターフェースを実装したクラスのオブジェクトのインスタンスかも判断可
$d = 'MyClass';
var_dump($a instanceof $b);
var_dump($a instanceof $d);
//instanceofの後にはクラス名以外にも別なオブジェクトや文字列変数を使用可能
$num = 1;
var_dump($num instanceof MyClass);
//確かめる変数がオブジェクトでなくてもエラーにはならずfalseを返す
