<?php
//型:文字列
echo "あかさたな";
//string型の最大長は2GB
echo 'You deleted C:\*.*?\n ';
echo '\\ \'';
//シングルクオートの場合'及び\以外はエスケープシーケンスを書いても展開されない
echo "You deleted C:\*.*?<br>\n";

echo "\\ \" \n<br>";
?>
<?php
//ヒアドキュメント(初見)
$a = <<<EOD
あいうえおかきくけこさしすせそたちつてと
EOD;
//識別子はEODじゃなくても任意に付けられる。また識別子の前はインデントしてはいけない
$exe = "あいうえお";
$b = <<<ABC
"$exe"
ABC;
echo "$a".PHP_EOL;
echo "$b".PHP_EOL;
var_dump(array(<<<EOD
foobar!
EOD
));
//ヒアドキュメントを使えば引数にデータを渡せる
//シングルクオートの文字列として扱われるNowdocもあるが識別子を'EOD'にする以外はほぼ同じ
echo '\n';
?>
<?php
$fruit = "apple";
//echo "I have some $fruits".PHP_EOL;
echo "I have some ${fruit}s".PHP_EOL;
//パーサは最長の変数名を取得するため下のようにしないと思い通りにパース(置き換え)られない
//ブラウザでは<br>で改行、普通に実行すると\n,PHP_EOL等で改行
?>
<?php
//echo "This is wrong: {$arr[foo][3]}";
//定数fooを検索し結果未定義の動作をする
//文字列fooをkyeにしたいならシングルクオートで囲まなければならない'foo'
$fruit = 'apple';
$apple = 'りんご';
echo "私は${$fruit}が好き\n";
//これも可能
class foo {
    var $bar = 'I am bar.';
}
$foo = new foo();
$bar = 'bar';
$baz = array('foo', 'bar', 'baz', 'quux');
echo "{$foo->$bar}\n";
echo "{$foo->{$baz[1]}}\n";
//"{$foo->${$baz[1]}}\n"じゃないのがもやもやする,これに換えても実行可
?>
<?php
class beers{
   const softdrink = 'rootbeer';
   public static  $ale = 'ipa';
}
$rootbeer = 'A & W';
$ipa = 'Alexander Keith\'s';
echo "I'd like an {${beers::softdrink}}\n";
echo "I'd like an {${beers::$ale}}\n";
//C++の名前空間に似ている
$str = 'abcde';
echo $str[0];
echo $str[-1];
//0からN-1または-Nから-1の添え字で文字にアクセスできる
$a = 10 + "100";
echo "\n$a";
//このようにint型と整数ととれる文字列型は演算できる
//文字コードを意識して関数を使わないといけない


