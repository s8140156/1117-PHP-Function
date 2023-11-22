<?php

$rows=all('students');
// 因為$table是指定的資料表所以在指定參數時 使用是''來包資料表名稱
// $where是sql條件語句 where dept='1'是整句查詢條件 不需單引號 但 1是字串 所以用''來包
// 有測試過如果where整句不用""包,會出現語法錯誤訊息 所以要像student一樣用引號包住 這邊使用"" 因為裡面還有字串的緣故
// 在function裡的變數都有設定null或是空值是增加使用泛用性 條件寬鬆使用

dd($rows);


function all($table=null,$where=''){
    $dsn="mysql:host=localhost;charset=utf8;dbname=school";
    $pdo=new PDO($dsn,'root','');

    if(isset($table) && !empty($table)){

        if(is_array($where)){
            if(!empty($where)){
                // 先是判斷$where是不是空值
                foreach ($where as $col => $value){
                    // 如果有值,用foreach提出陣列
                    // 遍歷 $where 陣列，每一次迭代中 $col 為陣列的鍵（column），$value 為對應的值
                    // 將陣列轉換為 SQL 條件格式
                    $tmp[]="'$col'='$value'";
                    // $tmp陣列裡放入提出的$col, $value變成的字串
                    // 將每一組條件（'$col'='$value'）加入暫存陣列 $tmp 中
                }
                $sql="select * from `$table` where ".join(" && ",$tmp);
                // $tmp這些條件會使用 join 函式組合在一起，形成完整的 SQL 查詢條件
            }else{
                // $tmp=[];
                // 是空值 所以$tmp=[]會是空陣列
                $sql="select * from `$table`";
                // 因為沒有where的內容 所以sql也不需要執行where 在資料庫裡面會有執行錯誤問題, 所以就直接查詢整張資料表
            }
        }else{
        $sql="select * from `$table` $where";
        // 注意雖然放變數$table但寫法要與sql語法一樣 欄位要加``
        // 若 $where 不是陣列，"直接使用提供的查詢條件"
        }
    $rows=$pdo->query($sql)->fetchAll();
    return($rows);
    }else{
        echo "錯誤：沒有指定的資料表名稱";
        // 這是對判斷有沒有$table存在 若無 會顯示錯誤訊息(但還是可以執行) 如果不放 因爲$table＝null其實執行上會不給過
    }
}


function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>"; 
}

?>