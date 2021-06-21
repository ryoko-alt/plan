<?php
/*
40 じゃんけんを作成しよう！
下記の要件を満たす「じゃんけんプログラム」を開発してください。要件定義
・使用可能な手はグー、チョキ、パー
・勝ち負けは、通常のじゃんけん
・PHPファイルの実行はコマンドラインから。ご自身が自由に設計して、プログラムを書いてみましょう！
*/
//040_2.php
//じゃんけんの機能ごとに関数にしたい
//変数名は具体的にしましょう
//あいこのときは、再度、じゃんけんをするような処理にしてください
//040_3.php
//じゃんけんの手ですが、定数にしたい
//ロジックを使用すると、勝敗を0,1, 2で取得することができます
//janken関数を再起させるのであれば、janken関数内で再帰処理を書きましょう
//じゃんけんが終了したらじゃんけんを続けるかどうかも選択できるようにしてみてください
//040_4.php
//inputMyHand という関数名から推測するにこれは標準入力で手を入力するようにしたいです。もし不正な値が入力されましたら、再帰処理にしてください。
//if($result == 0){この0 も定数
//echo 'じゃんけんが終了しましたが、～せっかくなので、この処理は関数にしてみてください。
//if($stdin == 'Y'){このYも定数で表現してみましょう
const STONE = 0;
const SCISSORS = 1;
const PAPER = 2;
const HAND_TYPE = array(
    STONE => 'グー',
    SCISSORS => 'チョキ',
    PAPER => 'パー'
);

const WIN = 2;
const LOSE = 1;
const EVEN = 0;
const UNKNOWN = -1;
const RESULT = array(
    WIN => 'あなたの勝ちです',
    LOSE => 'あなたの負けです',
    EVEN => 'あいこです',
    UNKNOWN => '不明'
);

const PLAY_YES = 0;
const PLAY_NO = 1;
const PLAY = array(
    PLAY_YES => 'プレイします',
    PLAY_NO => 'プレイしません'
);

function getComHand(){
    $comhand = array_rand(HAND_TYPE,1);
    return $comhand;
}

function judge($myhand, $comhand){
    return ($myhand - $comhand + 3) % 3;
}

function show($result){
    echo RESULT[$result]."\n";;
}

function re_start(){
    echo 'じゃんけんが終了しましたが、続けますか？続けるなら0を、止めるなら1を押して下さい'; 
    $re_start = trim(fgets(STDIN));
        echo PLAY[$re_start]."\n";
    if($re_start == PLAY_YES){
        return start();
    }else{
        exit;
    }
}


function janken($myhand) {
    if(($myhand != STONE)&&($myhand != SCISSORS)&&($myhand != PAPER)){
        echo 'あなたの手はグーでもチョキでもパーでもありません'."\n";
        return start();
    }

    $comhand = getComHand();
    echo 'あなたは'.HAND_TYPE[$myhand].'を出しました'."\n";
    echo 'コンピュータは'.HAND_TYPE[$comhand].'を出しました'."\n";

    $result = judge($myhand, $comhand);
    show($result);
    
    if($result == EVEN){
        return start();
    }else{
        return re_start();
    }
}

function start(){
    echo 'グーなら0、チョキなら1、パーなら2を入力してください。';
    $myhand = trim(fgets(STDIN));
    janken($myhand);
}    

start();

?>