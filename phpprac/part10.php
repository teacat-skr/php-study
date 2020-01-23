<?php
//関数:無名関数
function A ($match){
    return strtoupper($match[1]);
}
echo preg_replace_callback('~-([a-z])~', 'A', 'hello-world'.PHP_EOL);
echo preg_replace_callback('~-([a-z])~', function ($match){
    return strtoupper($match[1]);
}, 'hello-world'.PHP_EOL);
//正規表現'~-([a-z])~'は-とa-zのどれか1文字を表していて検索された-wの2文字目をWにしてその文字だけ返却されている
//上の二つは同じ結果であるが、例えばAとして宣言されている関数がここでしか使わない場合関数名を付けて宣言することはコスパが悪い
//そこで無名関数(クロージャとも言う)を使うといちいち名前を付けることなく使えるので名前の被り名護を考慮しなくて済む

$greet = function ($name){
    printf("Hello %s\r\n", $name);
};
$greet('World');
$greet('PHP');
//変数に代入も可能
$message = 'hello';
$example = function (){
    var_dump($message);
};
$example();
$example = function () use ($message){
    var_dump($message);
};
$example();
//外のスコープの変数をuseを使えば使用できる
//関数が宣言された時点での変数の中身が渡される(呼び出された時点ではない)
$example = function () use (&$message){
    var_dump($message);
};
$example();
$message = 'world';
$example();
//useのときに参照渡しをすれば変数の変更が反映される
$example = function ($arg) use ($message){
    var_dump($arg . ' ' . $message);
};
$example('hello');
//普通の引数も使える

class Cart{
    const PRICE_BUTTER = 1.00;
    const PRICE_MILK = 3.00;
    const PRICE_EGGS = 6.95;

    protected $products = array();

    public  function add($product, $quantity){
        $this->products[$product] = $quantity;
    }
    //連想配列で商品の数を管理
    public function getQuantity($product){
        return isset($this->products[$product]) ? $this->products[$product] : FALSE;
    }
    //商品があれば数を、なければFALSEを返す関数
    public function getTotal($tax){
        $total = 0.00;
        $callback = function ($quantity, $product) use ($tax, &$total){
          $pricePerItem = constant(__CLASS__ . "::PRICE_" . strtoupper($product));
          $total += ($pricePerItem * $quantity) * ($tax + 1.0);
        };
        //商品名を適切な変数名に変換して値段にアクセスし商品数、量、税率から金額を算出し参照渡しであるtotalに足す無名関数の宣言
        array_walk($this->products, $callback);
        //無名関数を連想配列で管理されているすべてに適応
        return round($total, 2);
        //丸めて返却
    }
}
$my_cart = new Cart();

$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

print $my_cart->getTotal(0.05)."\n";
//無名関数を使ったクラスの例

class Test {
    public  function testing(){
        return function (){
            var_dump($this);
        };
    }
}
$object = new Test();
$function = $object ->testing();
$function();

class AA {
    public  function testing(){
        return function (){
            var_dump($this);
        };
    }
}
$object = new AA();
$function = $object ->testing();
$function();
//$thisはクラス名をバインドして関数内で使える(的な解釈?)
class Foo{
    function  __construct(){
        $func = static function(){
            var_dump($this);
        };
        $func();
    }
};
new Foo();
//静的無名関数を使うとクラス名がバウンドされない?
$func = static function(){

};
$func = $func->bindTo(new stdClass());
//静的無名関数へのオブジェクトのバインドはできない?
