<?php
//クラスとオブジェクト:オブジェクト定数

//定数なのでもちろん定数表現である必要がある
class  MyClass{
    const CONSTANT = 'constant value'.PHP_EOL;

    function showConstant(){
        echo self::CONSTANT;
        //self::でアクセスされるのは静的なプロパティの扱いだから?
    }
}
echo MyClass::CONSTANT;
$classname = "MyClass";
echo $classname::CONSTANT;
$class = new MyClass();
$class->showConstant();

echo $class::CONSTANT;
//すべて結果は同じ
//また、::classは完全修飾名を得られる定数である

const ONE = 1;
class foo{
    const TWO = ONE * 2;
    const THREE = ONE + self::TWO;
    const SENTENCE = 'The value of THREE is'.self::THREE;
}
//定数を使った初期化はできる
//クラス定数も修飾子でアクセス範囲を指定できる

/*spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});*/
//見つからないクラスを自動的に名前解決してincludeしてくれる?

/*spl_autoload_register(function ($name){
    var_dump($name);
});
class bar implements ITest{

}*/
//インターフェースも同様
spl_autoload_register(function ($name){
    echo "Want to load $name".PHP_EOL;
    throw new Exception("Unable to load $name.".PHP_EOL);
});
try {
    $obj = new NonLoadbleClass();
} catch (Exception $e){
    echo $e->getMessage();
}
//見つからない場合に例外処理

class BaseClass {
    function __construct(){
        print "In BaseClass constructor".PHP_EOL;
    }
}
class SubClass extends BaseClass {
    function __construct(){
        //オーバーライド
        parent::__construct();
        //オーバーライドされている場合parent::__constructor()で実行しない限りは親クラスのコンストラクタは実行されない
        print "In SubClass constructor".PHP_EOL;
    }
}
class OtherSubClass extends BaseClass{
//親クラスのコンストラクタが実行される
}
$obj = new BaseClass();
$obj = new SubClass();
$obj = new OtherSubClass();
//PHPの古いバージョンではJavaのようなクラスと同名のメソッドによるコンストラクタを使っていたが現在非推奨

class MyDestructibleClass {
    function __construct(){
        print "In constructor".PHP_EOL;
    }
    function __destruct(){
        print "Destroying ". __CLASS__ .PHP_EOL;
    }
}
$obj = new MyDestructibleClass();
//デストラクタもコンストラクタとオーバーライド等の扱いは同じだが、例外をスローさせると致命的なエラーが起こる

//アクセス権は一般的な言語と同じようにpublic,protected,privateで指定できる
//varはprivateと同じ扱い
//プロパティはアクセス権を指定する必要があるが、メソッドは指定しなくてもよい(publicになる)
//定数のアクセス権もメソッドと同じように指定できる
class Test {
    private $foo;
    public function __construct($foo){
        $this->foo = $foo;
    }
    private function bar(){
        echo 'Accessed the private method.'.PHP_EOL;
    }
    public function baz(Test $other){
        //他のインスタンスのprivateプロパティを変更できる
        $other->foo = 'hello';
        var_dump($other->foo);
        //privateメソッドを呼ぶこともできる
        $other->bar();
    }
}
$test = new Test('test');
$test->baz(new Test('other'));
//たがいにアクセスできる理由はオブジェクトの内部ではオブジェクトの実装の詳細が既知であるため
