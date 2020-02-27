<?php
//エラー

//エラーハンドラの設定(エラーの報告レベルの設定)は実行時にerror_reporting()を使ってもできるが、基本php.iniで変更するべきである
//開発中はE_ALLレベルにしておく、運用時は下げてもよいが、E_ALLがベスト
//php.iniのdisplay_errorsはエラー内容を出力するか決められる。運用時はパスワード流出防止のためオフにする。開発時はオンが便利
//log_errorsはエラーをログに記録するか決められる
//ユーザー定義のエラーハンドラをset_error_handler()で設定できる
//PHP7からエラーの型が変わった?ので気を付ける
function inverse($x){
    if(!$x){
        throw new Exception('ゼロによる除算');
        //自作例外の作成
    }
    return 1/$x;
}

try {
    echo inverse(5).PHP_EOL;
    echo inverse(0).PHP_EOL;
} catch (Exception $e){
    echo '補足した例外:',$e->getMessage(),PHP_EOL;
}
echo "Hello World\n";
//実行は継続される
function test(){
    try {
        throw new Exception('foo');
    } catch (Exception $e){
        return 'catch';
    } finally {
        return 'finally';
    }
}
echo test().PHP_EOL;
//finallyの部分は絶対に実行されるため返却値はfinallyの部分になる
class MyException extends Exception{}
class Test{
    public function testing(){
        try {
            try {
                throw new MyException('foo!');
            } catch (MyException $e){
                throw $e;
            }
        } catch (Exception $e){
            var_dump($e->getMessage());
        }
    }
}
$foo = new Test();
$foo->testing();
//try-catchをネスト
class MyOtherException extends Exception{}
class Test2{
    public function testing(){
        try {
            throw new MyException();
        } catch (MyException | MyOtherException $e){
            //例外ハンドリングの複数指定
            var_dump(get_class($e));
        }
    }
}

$foo = new Test2();
$foo->testing();

//例外の複製(clone)はできない
class MyException2 extends Exception{
    //メッセージをオプションじゃなくする
    public function __construct($message, $code = 0, Throwable $previous = null){
        //親のメソッドを使いすべてのデータが代入されることを保証
        parent::__construct($message, $code, $previous);
    }
    public function __toString(){
        return __CLASS__.": [{$this->code}]: {$this->message}".PHP_EOL;
    }
    public function customFunction(){
        echo "A Custom function for this type of exception".PHP_EOL;
    }

}
//テスト用のクラス
class TestException{
    public $var;
    const THROW_NONE    = 0;
    const THROW_CUSTOM  = 1;
    const THROW_DEFAULT = 2;
    function __construct($avalue = self::THROW_NONE){
        switch ($avalue){
            case self::THROW_CUSTOM:
                throw new MyException2('1 is an invalid parameter', 5);
                break;
            case self::THROW_DEFAULT:
                throw new MyException2('2 is not allowed as a parameter', 6);
                break;
            default:
                $this->var = $avalue;
                break;
        }
    }
}

try {
    $o = new TestException(TestException::THROW_CUSTOM);
} catch (MyException2 $e){
    echo "Caught my exception\n",$e;
    $e->customFunction();
    //以下のcatchは実行されない
} catch (Exception $e){
    echo "Caught Default Exception\n", $e;
}
var_dump($o);
echo "\n\n";
try {
    $o = new TestException(TestException::THROW_DEFAULT);
} catch (MyException2 $e){
    echo "Caught my exception\n", $e;
    $e->customFunction();
} catch (Exception $e){
    echo "Caught Default Exception\n",$e;
    //こっちでキャッチ
}
var_dump($o);
echo "\n\n";
try{
    $o = new TestException(TestException::THROW_CUSTOM);
} catch (Exception $e){
    echo "Default Exception caught\n",$e;
} catch (MyException2 $e){
    echo "a";
}
//先に型に適合するcatchにキャッチされる?
var_dump($o);
echo "\n\n";
try {
    $o = new TestException();
    //例外は投げられないためcatchは実行されない
} catch (Exception $e){
    echo "Default Exception caught\n" ,$e;
}
var_dump($o);
echo "\n\n";