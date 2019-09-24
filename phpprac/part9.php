<?php
declare(strict_types=1);
$makefoo = true;
bar();
if($makefoo){
    function foo(){
        echo "It is foo.".PHP_EOL;
    }
}
if($makefoo)foo();
function bar(){
    echo "It is bar.".PHP_EOL;
}
//基本関数は定義された位置は関係なく参照できるが、条件式の中の場合は評価後にしか参照できない
function foo1(){
    function bar1(){
        echo "I don`t until exit foo1() is called.".PHP_EOL;
    }
}
//この時点ではbar1()はコールできない
foo1();
//foo1()の呼び出しによってbar1()がコールできるようになる
bar1();
BAR1();
//関数名は大文字小文字を区別しないがなるべく宣言した時と同じ名前でコールするべき

function recursion($a){
    if($a < 20){
        echo "$a ";
        recursion($a + 1);
    }
}
recursion(0);
echo PHP_EOL;
//再帰も使える
function takes_array($input){
    echo "$input[0] + $input[1] = ", $input[0] + $input[1].PHP_EOL;
}
$input = array(1,2);
takes_array($input);
//配列を引数に使える
function add_some_extra(&$string){
    $string .= 'and something extra.';
}
$string = 'This is a string,';
add_some_extra($string);
echo $string.PHP_EOL;
//渡す引数自体を変更したい場合は関数の宣言時に&を引数につける
function make_coffee($type = "cappuccino"){
    return "Making a cup of $type.\n";
}
echo make_coffee();
echo make_coffee(null);
echo make_coffee("espresso");
//引数がない場合デフォルト値が使われる。C++由来らしい
function make_coffee1($type = array("cappuccino"), $coffeeMaker = NULL){
    $device = is_null($coffeeMaker) ? "hands" : $coffeeMaker;
    return "Making a cup of".join(", ", $type)." with $device.\n";
}
echo make_coffee1();
echo make_coffee1(array("cappuccino", "lavazza"), "teapot");
//配列型のデフォルト値も使える
//デフォルト値を使用する場合はデフォルト値を設定しない引数の後ろにしないと予期しない動作が起こる
//(デフォルト値のあるなしに関係なく左から引数にするから?)
function sum(int $a, int $b){
    echo $a + $b.PHP_EOL;
}
sum(1, 2);
//Cやjavaのように関数の引数の型を指定できる
//booleanではなくboolなので注意
class C{};
class D extends C {};
class E{};
function f(C $c){
    echo get_class($c)."\n";
}
f(new C);
f(new D);
//f(new E);はエラー
interface I {public  function ff();}
class G implements I {public function ff() {}}
function ff(I $i){
    echo get_class($i)."\n";
}
ff(new G);
//ff(new E);はエラー
//クラスの継承していれば、また、インターフェースが実装されていればそれらを引数として使っている関数に引数として渡せる
function fff(C $c = null) {
    var_dump($c);
}
fff(new C);
fff(null);
//こうしないとnullを引数として使えない?
try{
    var_dump(sum(1, 2));
    var_dump(sum(1.5, 2.5));
} catch (TypeError $e){
    echo 'Error:'.$e->getMessage().PHP_EOL;
}
//基本的に引数として指定された型と違う場合無理やりその方として解釈されるが、declare(strict_types=1);を使うと不正な型が引数として使われた場合エラーを出せる
//declare(strict_types=1);はファイルの頭にしか変えない?
//try catchでTypeErrorを補足できる
function sumrange(...$numbers){
    $acc = 0;
    foreach ($numbers as $n){
        $acc += $n;
    }
    return $acc;
}
echo sumrange(1, 2, 3, 4).PHP_EOL;
//...を使うと可変長の引数にできる
sum(...[1, 2]);
$a = [1, 2];
sum(...$a);
//...を使えば複数の引数を一つの変数として渡せる
function total_intervals($unit, DateInterval ...$intervals){
    $time = 0;
    foreach ($intervals as $interval){
        $time += $interval->$unit;
    }
    return $time;
}
$a = new DateInterval('P1D');
$b = new DateInterval('P2D');
echo total_intervals('d', $a, $b).' days';
//型宣言を用いた可変長配列も使える。そのほか参照渡しも使える