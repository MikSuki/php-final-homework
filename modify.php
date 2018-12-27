<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
</head>

<body>
    <h2>資料管理系統 - 修改</h2>
    <hr>
    <?php

function modifyChk($mysqli)
{
    $arr = array("客戶代號", "姓名", "統一編碼", "地址", "電話號碼");
    $i = 0;
    session_start();
    $_SESSION['no'] = $_POST["no"];
    $no = stripslashes($_POST["no"]);
    // 執行SQL查詢
    $result = $mysqli->query("SELECT * FROM basic WHERE cust_no = '$no'");
    //  WHERE No = $no;
    if ($mysqli->errno != 0) {
        echo "錯誤代碼: " . $mysqli->errno . "<br/>";
        echo "錯誤訊息: " . $mysqli->error . "<br/>";
    } else {
        $rows = $result->fetch_array(MYSQLI_NUM);
        echo '<form method="post" action="result.php">';
        if ($rows == null) {
            echo ("編號  :  " . $no . "<br><br>");
            echo '<font color="RED">！資料不存在！</font><br><br>';
            echo '<input type="submit" name="return" value="回修改畫面"> 
                <input type="submit" name="Home" value="主畫面">';
        } else {
            
            while ($meta = $result->fetch_field()) {
                if ($i != 0) {
                    echo $arr[$i] . ':<input type="input" name="'.$meta->name.'" value="' . $rows[$i++] . '"><br/><br/>';
                } else {
                    echo $arr[$i] .':' .$rows[$i++] . '<br/><br/>';
                }
            }
            echo '<input type="submit" name="Query" value="修改">
                <input type="submit" name="return" value="回修改畫面"> 
                <input type="submit" name="Home" value="主畫面">';
            $result->close();
            
        }
        echo "</form>";
    }
}


if (isset($_POST["Home"])) {
    header("Location:Home.php");
}
// 是否是表單送回
if (isset($_POST["Query"])) {
    // 建立mysqli物件啟
    $mysqli = new mysqli("localhost", "root", "")
    or die("無法開啟MySQL資料庫連接!<br/>");
    $mysqli->select_db("customer"); // 選擇資料庫
    // 送出UTF8編碼的MySQL指令
    $mysqli->query('SET NAMES utf8');

    modifyChk($mysqli);
    $mysqli->close(); // 關閉資料庫連接
}

?>


    <hr>
</body>

</html>
