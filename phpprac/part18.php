<?php
//ジェネレータ-リファレンス

//ジェネレータはイテレータを簡単に実装する方法
//iteratorインターフェースの実装等が不要なため楽

function xrange($start, $limit, $step = 1){
    if($start <= $limit){
        if($step <= 0){
            throw new LogicException('Step must be positive');
        }
        for ($i = $start; $i <= $limit; $i += $step){
            yield $i;
        }
    } else{
        if($step >= 0){
            throw new LogicException('Step must be negative');
        }
        for ($i = $start; $i >= $limit; $i += $step){
            yield $i;
        }
    }
}
echo 'Single digit odd numbers from range(): ';
foreach (range(1, 9, 2) as $number){
    echo "$number ";
}
echo PHP_EOL;
echo 'Single digit odd numbers from xrange(): ';
foreach (xrange(1, 9, 2) as $number){
    echo "$number ";
}
echo PHP_EOL;
//同様の結果になるがrangeは実装上配列で返しているのでメモリの消費が大きいがxrangeは逐一yieldで返しているのでメモリ消費が小さくなる
//yield があればジェネレータ関数
function gen_one_to_three(){
    for ($i = 1; $i <= 3; $i++){
        yield $i;
    }
}
$generator = gen_one_to_three();
foreach ($generator as $value){
    echo "$value\n";
}
$input = <<<'EOF'
1;PHP;$が好き
2;Python;インデントが好き
3;Ruby;ブロックが好き
EOF;

function input_parser($input){
    foreach (explode("\n", $input) as $line){
        $fields = explode(';', $line);
        $id = array_shift($fields);
        yield $id => $fields;
    }
}
foreach (input_parser($input) as $id => $fields){
    echo "$id:\n";
    echo "    $fields[0]\n";
    echo "    $fields[1]\n";
}
//連想配列のようなものも返せる

//yieldでなにも返さないとNULLが返る
//関数名に&を付ければジェネレータ関数でも参照を返せる
function inner(){
    yield 1;
    yield 2;
    yield 3;
}
function gen(){
    yield 0;
    yield from inner();
    yield 4;
}
var_dump(iterator_to_array(gen()));
var_dump(iterator_to_array(gen(),false));
//falseにしないとiterator_to_array()はinnerが同じメモリの配列を書き換えて思ったように動かない
//yield fromでTraversableなものから順にyieldしてくれる
//ジェネレータ関数内でreturnも使える

//ジェネレータのメリットは簡潔に書けることだが、反復処理を戻すことはできず柔軟性がない


//PHPのリファレンスはCのポインタと違う
$a = &$b;
//同じ変数の内容に別な変数名でアクセスすることがPHPのリファレンス
//この場合$aと$bは同じ内容を指している
//new はリファレンスを返すので&は使わない(最新版だと使えない)

$var1 = "Example variable";
$var2 = "";
function global_references($use_globals){
    global $var1, $var2;
    if(!$use_globals){
        $var2 = &$var1;
        //関数の内部でのみ参照可
    } else {
        $GLOBALS["var2"] =& $var1;
    }
}
global_references(false);
echo "var2 = '$var2'\n";
global_references(true);
echo "var2 = '$var2'\n";
//$GLOBALSを使わないと関数の外で参照不可

$ref = 0;
$row =& $ref;
foreach (array(1, 2, 3) as $row){

}
echo $ref.PHP_EOL;
//$refは3になる
$arr = array(1);
$a =& $arr[0];
$arr2 = $arr;
$arr2[0]++;
//$arr2はリファレンスではないがリファレンスのように$aと$arr[0]は書き換わることに注意
function foo(&$var){
    $var++;
}
$a = 5;
foo($a);
//リファレンス渡しによりfoo内で書き換わり$a=6になる

function fooo(&$var){
    $var =& $GLOBALS["baz"];
}
fooo($bar);
//$barと$bazを結びつけることはできないと言いたい?
function bar(&$var){
    $var++;

}
$a = 5;
bar($a);
function &bar2(){
    $a = 5;
    return $a;
}
bar(bar2());
//6になる
//関数の呼び出し時に&はつけない
//変数及び関数から返されるリファレンス以外をリファレンスを引数に取る関数に入れるとエラーになる

class baz{
    public $value = 42;
    public function &getValue(){
        return $this->value;
    }
}
$obj = new baz();
$myValue = &$obj->getValue(); //&が必要
$obj->value = 2;
echo $myValue.PHP_EOL;
//2に書き換わる
$a = 1;
$b = &$a;
unset($a);
//$aのリファレンス解除

//globalを使った宣言はグローバル変数へのリファレンスを作成したことと同義
//$thisもリファレンス



