<?php
$exe = 1;
//phpの変数は頭文字に$をつける
$a_bool = true;
$a_str = "foo";
$a_str2 = 'foo';
$an_int = 12;
//pythonのように勝手に型推定してくれる。
echo gettype($a_str);
//gettype関数を使えば型名を取得できる
if(is_int($an_int)){
    $an_int += 4;
}
//is_XX関数(XXは型名)でその型かどうかの真偽値を返す
//boll型は一般的な言語と同様