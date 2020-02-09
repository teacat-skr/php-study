<?php
//クラスとオブジェクト:マジックメソッド-

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
