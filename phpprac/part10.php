<?php
echo preg_replace_callback('~-([a-z])~', function ($match){
    return strtoupper($match[1]);
}, 'hello-world');
//正規表現'~-([a-z])~'は-とa-zのどれか1文字を表していて検索された-wの2文字目をWにしてその文字だけ返却されている
//無名関数は名前を付けずに変数に代入して使える使えるため一度しか使わないような関数を手軽に作れる
