<h1>自訂函式</h1>
<?php
// 自訂函式

$c=20;
function sum($a,$b){
	// 這個function “sum”本身也是也是一個變數 變數可以被指定值 變數就可以拿來用
	global $c;
	// 全域的變數c
	$sum=$a+$b+$c;
	// 這時才可以在function裡面執行
	echo "輸入:".$a. "、".$b;
	echo"<br>";
	return $sum;
}

$sum=sum(10,20);
echo "總和是:" .$sum;
echo "<hr>";
$sum=sum(17,22)+$c;
echo "總和是:" .$sum;
echo "<hr>";
// 已在程式外 就可以與全欲變數計算

$sum=sum(17,22,33);
echo "總和是:" .$sum;
echo "<hr>";
// 這邊是用一個$sum變數來echo

echo "總和是:" .sum(21,58);
// 自訂函數的name本身就是變數 可以直接取來用如上 不需在設定變數
// 在echo後 會先告知程式內echo "輸入：".21."、".58;後 在告知echo “總和是”.79

// 有發現因在自訂函式已加入全域變數c 所以後面在執行的都會把c也加進去
// 註解變數c 即使裡面有global宣告 也不影響程式執行
// 程式的執行是有順序及會承接執行下來 所以在寫程式時要注意順序邏輯

?>

<!-- 自訂函式只執行funcion{}裡面 全域的不管 -->
<h1>不定參數用法</h1>
<?php

function sum2(...$arg){
	// print_r($arg);
	// $arg是一個陣列
	// $arg真的可以自己取名
	// $arg一定要寫在最後
	$sum=0;
	// 要記得宣告變數
	foreach($arg as $num){
		// 使用foreach迴圈來取陣列
		if(is_numeric($num)){
			// 判斷$num這個變數(陣列)是否是數字 is_numeric：可是是數字或是數字的字串
			$sum +=$num;
			// 如果是數字的話加總起來, 如果不是就忽略(後面就無設條件)
		}
	}
	return $sum;
}

// ...$arg
// 放在程式外面的用法叫展開運算符
// 在funcion內使用是不定參數

echo sum2(1,2);
echo "<hr>";
echo sum2(5,10);
echo "<hr>";
echo sum2(1,3,5,'xhjijo',9,11);
// 如果裡面放字串要記得'  '
echo "<hr>";

// 思考使用者怎麼使用你的東西


// function sum2($a,$b,$c){

// 	$sum=$a+$b+$c;
// 	echo "輸入:".$a. "、".$b ."、";
// 	echo"<br>";
// 	return $sum;
// }

?>

<h1>自訂函式預設值</h1>
<?php

function sum3($a,$b,$c=3){
	// 對於$c(倍數是固定的)設定預設值, 所以在echo時 僅寫需要變動的$a, $b即可
	$sum=($a+$b)*$c;
	echo "$a 、 $b , 倍數 $c <br>";
	return $sum;

}

echo sum3(10,15);
echo "<hr>";
echo sum3(10,15,10);
// 這邊是將倍數定義 但不會再以原設定3再去計算 會以10倍計算
echo "<hr>";


?>