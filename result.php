<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<?php
session_start();

function query($mysqli)
{
    $arr = array("客戶代號", "姓名", "統一編碼", "地址", "電話號碼");
    $i = 0;
    $no = stripslashes($_POST["no"]);
    // 執行SQL查詢
    $result = $mysqli->query("SELECT * FROM basic WHERE cust_no = '$no'");
    //  WHERE No = $no;
    if ($mysqli->errno != 0) {
        echo "錯誤代碼: " . $mysqli->errno . "<br/>";
        echo "錯誤訊息: " . $mysqli->error . "<br/>";
    } else {
        $rows = $result->fetch_array(MYSQLI_NUM);
        if ($rows == null) {
            echo ("編號  :  " . $no . "<br><br>");
            echo '<font color="RED">！資料不存在！</font>';
        } else {
            while ($meta = $result->fetch_field()) {
                echo $arr[$i] . "  :  " . $rows[$i++] . "<br/><br/>";
            }
            $result->close();
        }
        echo ("<br><br>");
    }
}

function add($mysqli)
{
    $sql = "INSERT INTO basic (cust_no, name, id, address, tel_no)
    VALUES ('" . $_POST["cust_no"] . "'
            ,'" . $_POST["name"] . "'
            ,'" . $_POST["id"] . "'
            ,'" . $_POST["address"] . "'
            ,'" . $_POST["tel_no"] . "')";

    if ($mysqli->query($sql) === true) {
        echo "<br>!資料新增成功!<br>";
    } else {
        echo '<br><font color="RED">！資料新增失敗！</font><br>';
    }
}

function modify($mysqli)
{
    $sql = "UPDATE basic SET
            name='" . $_POST["name"] . "'
            , id='" . $_POST["id"] . "'
            , address='" . $_POST["address"] . "'
            , tel_no='" . $_POST["tel_no"] . "'
            WHERE cust_no='" . $_SESSION["no"] . "'";

    // check the data is still exist
    $result = $mysqli->query("SELECT * FROM basic WHERE cust_no = '" . $_SESSION["no"] . "'");
    $rows = $result->fetch_array(MYSQLI_NUM);
    if ($rows == null) {
        echo '<br><font color="RED">!資料修改失敗!</font><br>';
    } else {
        if ($mysqli->query($sql) === true) {
            echo '<br>!資料修改成功!<br>';
        }
    }
}

function del($mysqli)
{
    if (isset($_POST["Yes"])) {
        $sql = "DELETE FROM basic WHERE cust_no = '" . $_SESSION["no"] . "'";
        // check the data is still exist
        $result = $mysqli->query("SELECT * FROM basic WHERE cust_no = '" . $_SESSION["no"] . "'");
        $rows = $result->fetch_array(MYSQLI_NUM);
        if ($rows == null) {
            echo '<br><font color="RED">!資料刪除失敗!</font><br>';
        } else {
            if ($mysqli->query($sql) === true) {
                echo '<br>!資料刪除成功!<br>';
            }
        }
    } else if (isset($_POST["No"])) {
        echo '<br>!資料沒有刪除!<br>';
    }
}

?>
</head>

<body>
    <h2>資料管理系統 - <?php echo $_SESSION['cmdChi'] ?>
    </h2>
    <hr>
    <?php

if (isset($_POST["Home"])) {
    header("Location:Home.php");
} else if (isset($_POST["return"])) {
    header("Location:input.php");
}

// 是否是表單送回
if (isset($_POST["Query"]) || isset($_POST["Yes"]) || isset($_POST["No"])) {
// 建立mysqli物件啟
    $mysqli = new mysqli("localhost", "root", "")
    or die("無法開啟MySQL資料庫連接!<br/>");
    $mysqli->select_db("customer"); // 選擇資料庫
    // 送出UTF8編碼的MySQL指令
    $mysqli->query('SET NAMES utf8');

    switch ($_SESSION['cmd']) {
        case 0:
            query($mysqli);
            break;
        case 1:
            add($mysqli);
            break;
        case 2:
            modify($mysqli);
            break;
        case 3:
            del($mysqli);
            break;
    }

    $mysqli->close(); // 關閉資料庫連接
} else {
    $no = "SELECT * FROM customer";
}
?>

<br>
<form method="post" action="input.php">
    <?php if ($_SESSION['cmd'] == 2) {
    echo '<input type="submit" value="修改">';
}

?>
    <input type="submit" value="回<?=$_SESSION['cmdChi']?>畫面">
    <input type="submit" name="Home" value="回主畫面">
</form>
<hr>

</body>
</html>