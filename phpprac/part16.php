<?php
namespace {
//クラスとオブジェクト:オブジェクトのシリアライズ-名前空間
    include("classa.inc");
    $s = file_get_contents('store');
    $a = unserialize($s);
    $a->show_one();
}
//シリアライズしたものの復元には同じクラスの定義がスコープ内に必要

//名前空間は自作クラスとそのほかの衝突を簡単に避けるために使われる
//名前空間は大文字小文字の区別なし
//名前空間の宣言の前にはdeclare以外のいかなるもの(html等でも)も記述不可
//namespace MyProject\sub\Level;のように階層構造を指定できる
//namespaceの後になにも記述しなければグローバルコードとして扱える
//波カッコでくくることで複数の名前空間を一つのファイルに記述できる
//\subnamespace\foo等とした場合ファイルシステムの絶対参照のようになる
namespace namespacename{
    class classname{
        function __construct(){
            echo __METHOD__,"\n";
        }
    }
    function funcname(){
        echo __FUNCTION__,"\n";
    }
    const constname = "namespaced";

    $a = '\namespacename\classname';
    $obj = new $a;
    $b = 'namespacename\funcname';
    $b();
    echo constant('\namespacename\constname'),"\n";
    //文字列によって名前空間内で関数やメソッドを呼び出す場合、完全修飾名にしなければならない
    //シングルクオートを使う(\のエスケープが起こらないように)
}
namespace MyProject{
    function get($classname){
        $a = __NAMESPACE__.'\\'.$classname;
        echo $a;
        return new $a;
    }
    //__NAMESPACE__によって現在の名前空間の名前が得られる
    //この関数の場合動的に名前が得られ、オブジェクトを作成できる
    function A(){
        echo "foo".PHP_EOL;
    }
    namespace\A();
    //namespaceでも名前空間の要素を明示的に指定できる
}
namespace My\Full{}
namespace foo{
    use My\Full\Classname as Another;
    use My\Full\NSname;
    //as　NSnameとして使える
    use ArrayObject;
    //グローバルクラスをインポート
    use function My\Full\functionName;
    //関数をインポート、as(エイリアス)も定義できる
    use const My\Full\CONSTANT;

    //インポートする名前は完全修飾名でなければならないため先頭にバックスラッシュは非推奨（必要ない）
    use Our\Full\Classname as Someone, Our\Full\Aname;
    //複数個を一行にも書ける
    //インポートはコンパイル時に行われるので動的なクラス名等には影響しない
    //先頭にバックスラッシュを付けると名前解決されない?
    //use \AnotherはAnotherとして解釈、use AnotherはMy\Full\Classnameとして解釈
    //インポートはコンパイル時に行われるため一番外側のスコープで行分ければならない
    use some\nameapace\{ClassA, ClassB, ClassC as C};
    //同じ名前空間から複数の関数等をインポートする場合まとめられる
}
namespace A\B\C{
    function fopen(){
        $f = \fopen();
        //グローバルなfopenをコール
        return $f;
    }
    //名前空間にないクラスをコールするとエラーになるが、関数や定数はない場合グローバル空間から探し出す
    const E_ERROR = 45;
    function strlen($str){
        return\strlen($str) - 1;
    }
    echo E_ERROR.PHP_EOL;
    echo INI_ALL.PHP_EOL;
    //グローバルのINI_ALLに移行
    echo strlen('hi').PHP_EOL;
    if(is_array('hi')){
        echo "is array\n";
    } else {
        echo "is not array\n";
    }
    //namespaceは現在の名前空間を置き換えたものに解決される

    //バックスラッシュを含む未定義な定数を参照するとエラーが起こる
    //特別な定数の書き換えは不可
}
