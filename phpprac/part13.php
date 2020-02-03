<?php
//クラスとオブジェクト:オブジェクトの継承-トレイト

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

abstract class AbstractClass{
    //拡張クラスに以下のメソッドのオーバーライドを強制
    abstract protected function getValue();
    abstract protected function prefixValue($prefix);

    //以下は強制ではない
    public function printOut(){
        print $this->getValue() . PHP_EOL;
    }
}
class ConcreteClass1 extends AbstractClass{
    protected function getValue(){
        return "ConcreteClass1";
    }
    //同等かより緩いアクセス権を付与しないといけない
    public function prefixValue($prefix){
        return "{$prefix}ConcreteClass1";
    }
}
class Concreteclass2 extends AbstractClass{
    public function getValue(){
        return "ConcreteClass2";
    }
    public function prefixValue($prefix){
        return "{$prefix}ConcreteClass2";
    }
}
$class1 = new ConcreteClass1();
$class1->printOut();
echo $class1->prefixValue('FOO_').PHP_EOL;
$class2 = new ConcreteClass2();
$class2->printOut();
echo $class2->prefixValue('FOO_').PHP_EOL;
//抽象クラスは多人数開発で実装時のルールとして使えるらしい?
//抽象クラスのメソッドの引数を増やすことはできるが減らすことはできない

interface iTemplate{
    public function serVariable($name, $var);
    public function getHtml($template);
}
//インターフェースの宣言
class Template implements iTemplate{
    private $vars = array();

    public  function serVariable($name, $var){
        $this->vars[$name] = $var;
    }
    public function getHtml($template){
        foreach ($this->vars as $name => $value){
            $template = str_replace('{' . $name . '}', $value, $template);
        }
        return $template;
    }
    //インターフェースのメソッドすべてを実装する必要がある
}
interface aa{
    public function foo();
}
interface bb{
    public function bar();
}
interface cc extends aa, bb{
    public function baz();
}
//複数のインターフェイスを継承
class dd implements cc{
    public function foo(){

    }
    public function bar(){

    }
    public function baz(){

    }
}
//実質a,b,cのインターフェイスが実装される
//インターフェイス内で定数は宣言できるがそれを実装したクラスでオーバーライドはできない

class Base {
    public function sayHello(){
        echo 'Hello ';
    }
}
trait SayWorld{
    public function sayHello(){
        parent::sayHello();
        echo 'World!'.PHP_EOL;
    }
}
class MyHelloWorld extends Base{
    use SayWorld;
}

$o = new MyHelloWorld();
$o->sayHello();

//継承したメンバよりもトレイトで追加されたメンバーが優先されるためトレイトのメソッドが実行されている
//また、トレイトのメンバーよりも現在のクラスのメンバーの方が優先順位が上
//複数のトレイトはカンマ区切りで追加できる

trait A{
    public function smallTalk(){
        echo 'a';
    }
    public function bigTalk(){
        echo 'A';
    }
}
trait B{
    public function smallTalk(){
        echo 'b';
    }
    public function bigTalk(){
        echo 'B';
    }
}
class Talker{
    use A, B{
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        //BのクラスのsmallTalkとAのクラスのbigTalkを使うよう定義して衝突を避ける
    }
}
class Aliased_Talker{
    use A, B{
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        B::bigTalk as Talk;
        //BのクラスのbigTalkをtalkというエイリアスを指定して使用
    }
}

trait HelloWorld{
    public function sayHello(){
        echo 'Hello World!';
    }
}
class MyClass1{
    use HelloWorld{sayHello as protected;}
    //アクセス権を変更
}
class MyClass2{
    use HelloWorld{sayHello as private myPrivateHello;}
    //アクセス権を変更したエイリアスメソッドを作成、sayHelloのアクセス権は変わらない
}

//トレイトからトレイトを使うこともできる

trait Hello{
    public function sayHelloWorld(){
        echo 'Hello'.$this->getWorld();
    }
    abstract public function getWorld();
}
//トレイト内でもabstractが使えるので要件を明示できる
class MyHelloWorld1{
    private $world;
    use Hello;
    public function getWorld(){
        return $this->world;
    }
    public function setWorld($val){
        $this->world = $val;
    }
}
trait Counter{
    public function inc(){
        static $c = 0;
        $c = $c + 1;
        echo "$c".PHP_EOL;
    }
}
class C1{
    use Counter;
}
class C2{
    use Counter;
}
$o = new C1();
$o->inc();
$p = new C2();
$p->inc();
//トレイト内で静的なメソッドや変数も定義できる
trait PropertiesTrait{
    public $same = true;
    public $different = false;
}
class PropertiesExample{
    use PropertiesTrait;
    public $same = true;
}
//トレイト内でプロパティも定義できるがそのトレイトを使うクラスでは同名のプロパティを初期値が同じではない場合定義出来ない
