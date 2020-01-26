<?php
//クラスとオブジェクト:オブジェクトの継承-

//継承を用いることで同じ機能を何度も実装しなくて済む
class  Foo{
    public  function printItem($string){
        echo 'Foo: ' . $string . PHP_EOL;
    }
    public function printPHP() {
        echo 'PHP is great.' . PHP_EOL;
    }
}
class Bar extends Foo{
    //オーバーライド
    public function printItem($string){
        echo 'Bar: ' . $string . PHP_EOL;
    }
}
$foo = new Foo();
$bar = new Bar();
$foo->printItem('baz');
$foo->printPHP();
$bar->printItem('baz');
$bar->printPHP();

//static を使った宣言をすることでインスタンス化の必要なしにプロパティ、メソッドにアクセスできる
//逆にインスタンスからstaticなプロパティはアクセスできない
//staticなメソッド内で$thisは使えない
class  Fooo{
    public static function aStaticMethod(){

    }
}
Fooo::aStaticMethod();
//staicプロパティは->アクセス出来ない