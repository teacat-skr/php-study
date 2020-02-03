<?php
//クラスとオブジェクト:無名クラス-

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

