<?php
//クラスとオブジェクト:マジックメソッド-オブジェクトのシリアライズ

//マジックメソッドは特殊な動作をするメソッドであり__construct等が含まれる
//いくつかのメソッド名はマジックメソッドとして予約されているので気を付ける

//__sleep()と__wakeup()はシリアル化の際に使う
//__toString()はクラスが文字列に変換される際に使われる
class CallableClass{
    public function __invoke($x){
        var_dump($x);
    }
}
$obj = new CallableClass();
$obj(5);
var_dump(is_callable($obj));
//__invoke()はスクリプトがオブジェクトを関数として使ったときに使われる

//__set_state()はエクスポートされたクラスのプロパティを保存するために使われる
class C{
    private $prop;
    public function __construct($val){
        $this->prop = $val;
    }
    public function __debugInfo(){
        return[
            'propSquared' => $this->prop ** 2,
        ];
    }
}
var_dump(new C(42));
//__debugInfo()はvar_dump()がオブジェクトに対して使われた場合に呼ばれふるまいを定義できる。このメソッドを持たない場合すべてのプロパティを表示する

class BaseClass{
    public function test(){
        echo "BaseClass::test() called\n";
    }
    final public function moreTesting(){
        echo "BaseClass::moreTesting() called\n";
    }
    //finalキーワードの付いたメソッドはオーバーライドできない
}
//クラス自体にfinalキーワードが付いていた場合そのクラスは継承できない

class SubObject{
    static $instances = 0;
    public $instance;
    public function __construct(){
        $this->instance = ++self::$instances;
    }
    public function __clone(){
        $this->instance = ++self::$instances;
    }
}
class MyCloneable{
    public $object1;
    public $object2;

    function __clone(){
        $this->object1 = clone $this->object1;
        //ディープコピー
        //デフォルトだとプロパティはコピー時にシャロ―コピーされるのでclone時に呼ばれるマジックメソッド__clone()で動作を変更
    }
}
$obj = new MyCloneable();
$obj->object1 = new SubObject();
$obj->object2 = new SubObject();
$obj2 = clone $obj;
print_r($obj);
print_r($obj2);
//Object1はcloneされたときにクローンをするので実質ディープコピーだが、Object2は何もしていないのでシャローコピーになっている

//オブジェクトどうしの場合===は同じインスタンスかまで比較
//==の場合型と値だけ比較

class A {
    public static function who(){
        echo __CLASS__.PHP_EOL;
    }
    public static function test(){
        self::who();
    }
}
class B extends A{
    public static function who(){
        echo __CLASS__.PHP_EOL;
    }
}

B::test();
B::who();
//selfおよび__CLASS__はそのメソッドが定義されているクラスによって解決される
class AA{
    public static function who(){
        echo __CLASS__.PHP_EOL;
    }
    public static function test(){
        static::who();
    }
}
class BB extends AA{
    public static function who(){
        echo __CLASS__.PHP_EOL;
    }
}
BB::test();
//staticを使うことで最初に呼ばれたクラス名が使われる
//継承したクラスのメソッドを上書きした場合、static::が使われているとスコープが変わりおかしくなる
class some{
    public $foo = 1;
}
$a = new some;
$b = $a;
$b->foo = 2;
var_dump($a);
var_dump($b);
$c = new some;
$d = &$c;
$d->foo = 2;
var_dump($c);
var_dump($d);
$e = new some;
var_dump($e);
function foo($obj){
    $obj->foo = 2;
    var_dump($obj);
}
foo($e);
var_dump($e);
//PHPのオブジェクトはIDを持っていて複数の変数が同じインスタンスを参照していることを言いたい?

include ("classa.inc");
$a = new A1();
$a->one = 1;
$s = serialize($a);
file_put_contents('store', $s);
//シリアライズすると保存可能なバイトストリームの文字列にできる