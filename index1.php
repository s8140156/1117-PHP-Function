<h1>自訂函式</h1>
<?php
// 自訂函式

$c=20;
function sum($a,$b){
	global $c;
	// 全域的變數c
	$sum=$a+$b+$c;
	// 這時才可以在function裡面執行
	echo "輸入:".$a. "、".$b;
	echo"<br>";
	return $sum;
}

// 自訂函式本身也是個變數

$sum=sum(10,20);
echo "總和是:" .$sum;
echo "<hr>";
$sum=sum(17,22);
echo "總和是:" .$sum;
echo "<hr>";

echo "總和是:" .sum(21,58);

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
	$sum=0;
	foreach($arg as $num){
		if(is_numeric($num)){
			$sum +=$num;
		}
	}
	return $sum;
}

echo sum2(1,2);
echo "<hr>";
echo sum2(5,10);
echo "<hr>";
echo sum2(1,3,5,'xhjijo',9,11);
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
	$sum=($a+$b)*$c;
	echo "$a 、 $b , 倍數 $c <br>";
	return $sum;

}

echo sum3(10,15);
echo "<hr>";
echo sum3(10,15,10);
echo "<hr>";


?>