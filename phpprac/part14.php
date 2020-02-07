<?php
//クラスとオブジェクト:無名クラス-オブジェクトの反復処理

//new class で無名のクラスを作れる?
//正確な宣言の仕方がマニュアルだと不確か
class SomeClass{}
interface SomeInterface{}
trait SomeTrait{}
var_dump(new class(10) extends SomeClass implements SomeInterface{
    private $num;

    public function __construct($num){
        $this->num = $num;
    }
});
//普通のクラスと同様のことが可能

class Outer{
    private $prop = 1;
    protected $prop2 = 2;

    protected function func1(){
        return 3;
    }
    public function func2(){
        return new class($this->prop) extends Outer{
            private $prop3;

            public function __construct($prop){
                $this->prop3 = $prop;
            }
            public function func3(){
                return$this->prop2 + $this->prop3 + $this->func1();
            }
        };
    }
}
//無名クラスをクラス内で使う場合外側のprotectedプロパティはクラスを継承させないと使えない
//privateプロパティはコンストラクタでそれを渡さないと使えない
echo (new Outer())->func2()->func3().PHP_EOL;

function anonymous_class(){
    return new class{};
}
if(get_class(anonymous_class()) == get_class(anonymous_class())){
    echo "same".PHP_EOL;
} else {
    echo  "different".PHP_EOL;
}
//同じ無名クラス宣言から作ったすべてのオブジェクトは同じクラスのインスタンスになる

//PHPでのオーバーロードと他言語のオーバーロードは全く違う機能なので注意
//PHPでは宣言されていない、またはアクセス不能なプロパティを操作するときに起動する機能?
class PropertyTest{
    private $data = array();
    //オーバーロードされるデータの場所
    public $declared = 1;
    private $hidden = 2;
    //外部からアクセスされた場合オーバーロードされる

    public function __set($name, $value){
        echo "Setting '$name' to '$value'".PHP_EOL;
        $this->data[$name] = $value;
    }
    public function __get($name){
        echo "Getting '$name'".PHP_EOL;
        if(array_key_exists($name, $this->data)){
            return $this->data[$name];
        }
        $trase = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): '. $name .
            ' in ' . $trase[0]['file'].
            ' on line ' . $trase[0]['file'],
            E_USER_ERROR);
        return null;
    }
    public function __isset($name){
        echo "Is '$name' set?".PHP_EOL;
        return isset($this->data[$name]);
    }
    public function __unset($name){
        echo "Unsetting '$name'".PHP_EOL;
        unset($this->data[$name]);
    }
    public function getHidden(){
        return $this->hidden;
    }
}
echo "<pre>".PHP_EOL;
$obj = new PropertyTest();
$obj->a = 1;
echo $obj->a."\n\n";
var_dump(isset($obj->a));
unset($obj->a);
var_dump(isset($obj->a));
echo PHP_EOL;
echo $obj->declared. "\n\n";
echo "Let's experiment with the private property named 'hidden':".PHP_EOL;
echo "Privates are visible inside the class, so __get() not used...\n";
echo $obj->getHidden() . PHP_EOL;
echo "Privates not visible outside of class, so __get() is used...\n";
//echo $obj->hidden;
//エラー
//__get, __setが起動していることがわかる

class MethodTest{
    public function __call($name, $arguments){
        //$nameは大文字小文字を区別
        echo "Calling object method '$name' ". implode(',',  $arguments).PHP_EOL;
    }
    public static function __callStatic($name, $arguments){
        //$nameは大文字小文字を区別
        echo "Calling static method '$name' ". implode(', ', $arguments).PHP_EOL;
    }
}
$obj = new MethodTest;
$obj->runTest('in object context');

MethodTest::runTest('in static context');
//メソッドのオーバーロード

class MyClass{
    public $var1 = 'value 1';
    public $var2 = 'value 2';
    public $var3 = 'value 3';

    protected $protected = 'protected var';
    private $private = 'private var';

    function iterateVisible(){
        echo "MyClass::iterateVisible\n";
        foreach ($this as $key => $value){
            print "$key => $value\n";
        }
    }
}
$class = new MyClass();
foreach ($class as $key => $value){
    print "$key => $value\n";
}
echo PHP_EOL;
$class->iterateVisible();
//foreach等でアクセス権のあるプロパティの範囲で反復処理ができる

class MyIterator implements Iterator{
    private $var = array();
    public function __construct($array){
        if(is_array($array)){
            $this->var = $array;
        }
    }
    public function rewind(){
        echo "rewinding\n";
        reset($this->var);
    }
    public function current(){
        $var = current($this->var);
        echo "current: $var\n";
        return $var;
    }
    public function key(){
        $var = key($this->var);
        echo "key: $var\n";
        return $var;
    }
    public function next(){
        $var = next($this->var);
        echo "next: $var\n";
        return $var;
    }
    public function valid(){
        $key = key($this->var);
        $var = ($key !== NULL && $key !== FALSE);
        echo "valid: $var\n";
        return $var;
    }
}
$values = array(1, 2, 3);
$it = new MyIterator($values);
foreach ($it as $a => $b){
    print "$a: $b\n";
}
//イテレータを実装するオブジェクトの反復処理

class MyCollection implements IteratorAggregate{
    private $items = array();
    private $count = 0;
    public function getIterator(){
        return new MyIterator($this->items);
    }
    public function add($value){
        $this->items[$this->count++] = $value;
    }
}
$coll = new MyCollection();
$coll->add('value 1');
$coll->add('value 2');
$coll->add('value 3');
foreach ($coll as $key => $val){
    echo "key/value: [$key -> $val]\n\n";
}
//IteratorAggregateインターフェースを使う方法
//なぜか挙動がマニュアルと合わない
//iteratorインターフェースを実装する代わり代わりにIteratorAggregateを実装する方法もあるとなっているが、IteratorAggregateを実装したクラス内でIteratorを実装したクラスを使っているので二度手間では?

