<?php
//if文はc言語と同様の使い方
//else if(elseif)も同様
$a = 5;
if($a == 5):
    echo '5に等しい'.PHP_EOL;
else:
    echo '5に等しくない'.PHP_EOL;
    echo '$a is not 5'.PHP_EOL;
endif;
//：を使った構文はこう書く
//：を使ってif文を分割した場合else ifと書くとコンパイルエラーが起こるがそれ以外はelseifとelse ifは全く同等
//分岐内では何行にもできる
$i = 1;
while ($i <= 10){
    echo $i.PHP_EOL;
    $i++;
}
$i = 1;
while ($i <= 10):
    echo $i.PHP_EOL;
    $i++;
endwhile;
//上と下は同等である
//:を使うと{}を使ったように書ける(最後にend~;が必要になるが)
$i = 10;
do{
    echo $i;
} while($i < 10);
//do while文は論理式のチェックが最後に行われる（つまり最低1回は{}内の処理が実行される）
//for文もc++と同様、またfor():endfor;とも書ける
$arr = array(1,2,3,4,5);
foreach ($arr as $key => &$value){
    $value *= 2;
}
var_dump($arr);
//foreach内で要素を変更したい場合参照渡しにする
foreach ($arr as $key => $value){
    $value *= 2;
}
var_dump($arr);
//一回目のforeach後unset()で$valueの参照を解除しないと挙動がおかしくなる
//PHPでは関数未満の範囲のスコープはないため起こる
//foreachに@は使えない
$arr1 = [
    [1,2],
    [3,4]
];
foreach ($arr1 as list($a, $b)){
    echo "$a $b".PHP_EOL;
}
//このようにすることでネストされた配列の処理ができる
foreach ($arr1 as list($a)){
    echo "$a".PHP_EOL;
}
//変数を少なくすると足りない分は無視される。逆に多いとエラーが出る
for ($i = 1;$i < 10; $i++){
    for ($j = 1; $j < 10; $j++){
        echo $i * $j.' ';
        if($i * $j >= 49){
            echo 'over 49'.PHP_EOL;
            break 2;
        }
    }
}
//break 数値nでn重のネストから抜けられる
$i = 0;
while (++$i){
    switch ($i){
        case 5:
            echo '5'.PHP_EOL;
            break 1;
        case 10:
            echo '10'.PHP_EOL;
            break 2;
        default:
            break;
    }
}
//このようにも使える
//continueもbreakと同じような使い方ができる
//switch文内でcontinueを使うとbreakと同じ結果になる
if($i == 0){
    echo '0';
} elseif ($i == 1){
    echo '1';
} elseif ($i == 2){
    echo '2';
}
switch ($i){
    case 0:
        echo '0';
        break;
    case 1:
        echo '1';
        break;
    case 2:
        echo '2';
        break;
}
//等価
//breakを忘れると以降のcaseの分岐結果も行われてしまう(echo '0'の後にbreakがないとecho '1'も実行される)
//逆にこれを利用する方法もある
//case 文字列　も可能
//defaultはほかのcase文にマッチしないときに実行される
//caseの後ろは:ではなく;でも構わない
?>
<?php
declare(ticks=3);
function tick_handler(){
    echo 'x';
}
register_tick_function('tick_handler');
for ($i = 0; $i < 10; $i++){
    echo $i;
}
//tick=n個の文が実行されるごとにイベント(この場合関数が実行される)が起こる
//webの接続が切れたときに処理落としたりするのに使われるらしい?
//またdeclare(encoding='ISO-8859-1');でスクリプトのエンコーディングを指定できる

//returnはC++と同じ
unregister_tick_function('tick_handler');
?>
<?php
echo PHP_EOL.$fluts;
include 'vas.php';
echo $fluts;
//requireとincludeはどちらも別ファイルを読み込むが前者は致命的なエラーが出て実行が止まる場合があるが後者は止まらない
