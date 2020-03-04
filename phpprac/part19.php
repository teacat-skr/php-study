<?php
//定義済みの変数

//すべてのスコープで利用可能な組み込みの変数をスーパーグローバルという
function test(){
    $foo = "local";
    echo $GLOBALS["foo"].PHP_EOL;
    echo $foo.PHP_EOL;
}
$foo = "global";
test();
//スーパーグローバル$GLOBALはすべての変数の参照を持つ連想配列
//$_SERVERはサーバー情報及び実行時の環境情報を持つ配列でWEBサーバーが生成するが、絶対提供されるわけではない
//$_GETはURLパラメータで現在のスクリプトに渡された変数の連想配列
//$_POSTはHTTPリクエストのHTTP POSTメソッドから現在のスクリプトに渡された変数の連想配列
//$_FILESはHTTP POSTメソッドで現在のスクリプトにアップロードされた項目の連想配列
//$_REQUESTは$_GET,$_PST,$_COOKIEの内容をまとめた連想配列
//$_SESSIONはセッション変数を含む連想配列
//$_ENVはPHPパーサが実行されている環境から渡される環境変数の連想配列
//$_COOKIEはHTTPクッキーから渡された変数の連想配列
//$php_errormsgは直近のエラーメッセージのテキストを格納する変数だが非推奨。error_get_last()を使用推奨
//$http_response_headerはHTTPラッパー使用時にHTTPレスポンスヘッダが格納される配列
//$argcコマンドラインから実行したときにスクリプトに渡された引数の数を格納
//ex)php a.php abcd efg の場合3が格納
//$argvは$argcと同様な場合においてスクリプトに渡されたすべての引数の値を格納
//ex)a.php abcd efgが大きさ3の配列に格納

//Exceptionはすべてのユーザー例外の基底クラス
//Errorはすべての内部エラーの基底クラス
//ArgumentCountErrorはユーザー定義の関数またはメソッドに渡された引数が少ない場合に投げられる
//ArithmeticErrorは数学的な捜査でのエラー
//AssertionErrorはassert()が失敗したときのエラーでこの関数自体はデバック時に期待した変数の内容になっているか調べられる
//DivisionByZeroErrorはゼロ除算時のエラー
//CompileErrorはコンパイルエラー時のエラー
//ParseErrorはPHPコードのパースに失敗したとき呼ばれCompileErrorクラスを継承している
//TypeErrorは引数、返却値の型が宣言とあっていない場合、組み込みの関数に渡した引数の数が合わない場合に投げられる

//Traversableはforeachでたどれるか検出するインターフェイス
//Iteratorは外部のイテレータまたはオブジェクト自身から反復処理を行うためのインターフェイスであり、Traversableを継承している
//IteratorAggregateは外部イテレータを作成するインターフェイス
//Throwableはthrow文でスロー可能なあらゆるオブジェクトが実装しているクラスだが、これ自体を直接実装することは不可
//ArrayAccessは配列としてオブジェクトにアクセスするためのインターフェイス
//Serializableは独自のシリアライズ用のインターフェイス
//Closureは無名関数がつくられたときこのクラスとしてオブジェクトがつくられる
//Generatorはジェネレータが返すオブジェクト
//WeakReferenceはキャッシュのようなデータ構造の実装に役立つ

$ops = array(
    'socket' => array(
        'bindto' => '192.168.0.100:0',
    ),
);
//IPアドレス192.168.0.100でインターネットに接続
//IPv6の場合[]で囲む
//:0の部分でポート番号指定
$context = stream_context_create($ops);
//echo file_get_contents('http://www.example.com', false, $context);
//それを利用してデータを取得
