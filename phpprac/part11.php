<?php
//クラスとオブジェクト:クラスの基礎-プロパティ-
class SimpleClass{
    //プロパティの宣言
    public $var = 'a default value';
    //メソッドの宣言
    public  function displayVar(){
        echo  $this->var.PHP_EOL;
    }
}
class A {
    function foo(){
        if(isset($this)){
            echo  '$this is defined(';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
}
class  B {
    function  bar(){
        A::foo();
    }
}
$a = new  A();
$a->foo();

A::foo();
$b = new  B();
$b->bar();

B::bar();
//PHP7では静的メソッドがオブジェクトの状態から呼び出されたとき以外は$thisは未定義となる

//クラスはオブジェクトを作る前に定義しなければならない(当たり前では?)
$instance = new SimpleClass();
//変数を使うことも可
$className = 'SimpleClass';
$instance = new $className;
//名前空間に属している場合完全修飾名で指定
//作成済みのインスタンスは変数への代入、関数へ渡す場合同じリンク先を渡すのでのでコピーしたい場合はクローンを使う

$assigned = $instance;
$reference =& $instance;
$instance->var = '$assigned will have this value';
$instance = null;
var_dump($instance);
var_dump($reference);
var_dump($assigned);
//リンク先を共有しているため$varを書き換えるとassigned含むすべての$varは書き換わる
//しかし参照で渡しているわけではないので$instanceにnullが代入されてもassignedはnullにならない?
class  Test{
    static public function  getNew(){
        return new static;
    }
}
class Child extends Test{

}
$obj1 = new Test();
$obj5 = new Test();
$obj2 = new $obj1;
var_dump($obj1);
var_dump($obj2);
var_dump($obj1 !== $obj2);
//===は同じクラスの同じインスタンスを使用する場合のみtrue
//インスタンスを使ってインスタンスを作ることでnewで新たなインスタンスを作ることと同様の効果がある?
$obj3 = Test::getNew();
var_dump($obj3 instanceof Test);
$obj4 = Child::getNew();
var_dump($obj4 instanceof Child);
echo (new DateTime())->format('Y').PHP_EOL;
//作成したオブジェクトをそのまま使用
class Foo{
    public  $bar = 'property';

    public  function bar() {
        return 'method';
    }
}
$obj = new Foo();
echo $obj->bar, PHP_EOL. $obj->bar(), PHP_EOL;
//プロパティ名とメソッド名は管理場所が別なので競合せず同じ名前を使える
class Hoge{
    public $bar;
    public function __construct(){
        $this->bar = function (){
            return 42;
        };
    }
}
$obj = new Hoge();
$func = $obj->bar;
echo $func(), PHP_EOL;
echo ($obj->bar)(), PHP_EOL;
//上と下は同じ
//プロパティに無名関数を代入した場合関数を直接呼べないための解決方法
class ExtendsClass extends SimpleClass{
    //親クラスのメソッドをオーバーライド
    function displayVar(){
        echo "Extending class\n";
        parent::displayVar();
        //オーバーライド元のメソッドにアクセス
    }
}
$extended = new ExtendsClass();
$extended->displayVar();
echo SimpleClass::class;
//クラスの完全修飾名を出力
//名前空間つきのクラスと合わせると便利

//クラスのメンバ変数をプロパティという
//静的でないプロパティへのアクセスは$this->property、静的なプロパティへのアクセスはself::$property
//プロパティの初期化は定数値でなくてはならず、変数等は代入できない
//ヒアドキュメント、配列などでの初期化は可
//PHP7.4ではcallable型以外の型宣言を含められる

