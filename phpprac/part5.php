<?php
//foreachでたどれることだけが分かればいいときに使える疑似型のIterable型がある
class foo {
    function do_foo() {
        echo "foo を実行します。\n";
    }
}
$bar = new foo;
$bar ->do_foo();
//オブジェクト、読んだそのまま
$obj = (object) array('1' => 'foo');
var_dump(isset($obj->{'1'}));
var_dump(key($obj));
//bool(true) string(1) "1"になる。資料が間違えてる?objectへのキャストをなくすと資料通りになる。
$obj = (object) 'ciao';
echo $obj->scalar.PHP_EOL;
//scalarに格納
//リソース型はファイル、データベース接続などの特別なハンドルを保持するため変換不可
//データベース接続以外は参照されなくなると勝手にGCが削除してくれる
$var = NULL;
//NULL型、大文字小文字の区別なし(nullでも可)
//NULLへのキャストは非推奨
?>
<?php
function my_call_function(){//コールバック関数
    echo 'hello world!'.PHP_EOL;
}

class MyClass{
    static function myCallbackMethod(){//コールバックメソッド
        echo 'Hello World!'.PHP_EOL;
    }
}
call_user_func('my_call_function');
//単純なコールバック
call_user_func(array('MyClass','myCallbackMethod'));
//静的クラスメソッドのコール1
$obj = new MyClass();
call_user_func(array($obj, 'myCallbackMethod'));
//オブジェクトメソッドのコール
call_user_func('MyClass::myCallbackMethod');
//静的クラスメソッドのコール2
class A {
    public static function who() {
        echo "A\n";
    }
}
class B extends A {
    public static function who() {
        echo "B\n";
    }
}
call_user_func(array('B', 'parent::who'));//A
//相対指定による静的クラスメソッドのコール
class C {
    public function __invoke ($name) {
        echo 'Hello ', $name, "\n";
    }
}
$c = new C();
call_user_func($c, 'PHP!');
//以上見た通りに使える

//クロージャ=無名関数
$double = function ($a) {
    return $a * 2;
};

$numbers = range(1, 5);
//pythonで見た,(x: 1<=x<=5)
$new_numbers = array_map($double, $numbers);
print implode(' ', $new_numbers);
//この関数C++に欲しい
?>
<?php
$foo = "1";//文字列
$foo *= 2;
$foo = $foo *1.3;//オペランド(数値)にfloatがあればすべてはfloatとして評価される
$foo = 5 * "10 apples";//前やった通り=50になる
var_dump($foo);
$exe = "あいうえお";
var_dump($exe);
$exe1 = (binary) $exe;
var_dump($exe1);//binaryへのキャストの説明がもっと欲しい
//stringへのキャスト=ダブルクォーテーションで囲むこと

