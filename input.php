<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<?php

session_start();

if (isset($_POST["Home"])) 
    header("Location:Home.php");

 else if (isset($_POST["Query"])){
    $_SESSION['cmd'] = 0;
    $_SESSION['cmdChi'] = '查詢';
 }
 else if (isset($_POST["Add"])) {
    $_SESSION['cmd'] = 1;
    $_SESSION['cmdChi'] = '新增';
 }
    
 else if (isset($_POST["Modify"])) {
    $_SESSION['cmd'] = 2;
    $_SESSION['cmdChi'] = '修改';
 }
    
 else if (isset($_POST["Del"])) {
    $_SESSION['cmd'] = 3;
    $_SESSION['cmdChi'] = '刪除';
 }
    


?>
<style>
    form{
        font-size: 15px;
    }
</style>
</head>
<body>
    <h2>資料管理系統 -
        <?php
switch ($_SESSION['cmd']) {
    case 0:
        echo "查詢<br><hr>";
        echo '<form method="post" action="result.php">
            客戶代號:
            <input type="input" name="no">
            <br><br>
            <input type="submit" name="Query" value="查詢">
            <input type="reset" value="清除">
            <input type="submit" name="Home" value="回主畫面">
        </form>';
        break;
    case 1:
        echo "新增<br><hr>";
        echo '<form method="post" action="result.php">
            客戶代號:
            <input type="input" name="cust_no"><br><br>
            姓名:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="input" name="name"><br><br>
            統一編號:
            <input type="input" name="id"><br><br>
            地址:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="input" name="address"><br><br>
            電話號碼:
            <input type="input" name="tel_no"><br><br>
            <br>
            <input type="submit" name="Query" value="新增">
            <input type="reset" value="清除">
            <input type="submit" name="Home" value="回主畫面">
        </form>';
        break;
    case 2:
        echo "修改<br><hr>";
        echo '<form method="post" action="modify.php">
            客戶代號:
            <input type="input" name="no">
            <br><br>
            <input type="submit" name="Query" value="查詢">
            <input type="reset" value="清除">
            <input type="submit" name="Home" value="回主畫面">
        </form>';
        break;
    case 3:
        echo "刪除<br><hr>";
        echo '<form method="post" action="delete.php">
            客戶代號:
            <input type="input" name="no">
            <br><br>
            <input type="submit" name="Query" value="查詢">
            <input type="reset" value="清除">
            <input type="submit" name="Home" value="回主畫面">
        </form>';
        break;
}
?>
    </h2>
    <hr>
</body>

</html>