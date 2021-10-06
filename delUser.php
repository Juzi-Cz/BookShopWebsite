<?php 
	header("content-type:text/html; charset=utf-8");
	if(!isset($_REQUEST['optType']) || empty($_REQUEST['optType'])) die("参数错误");

	$host = "127.0.0.1";   
    $userName = "root";    
    $password = "root";     
    $dbName = "mydb";

    $conn = mysqli_connect($host, $userName, $password,$dbName) or die("连接数据库服务器失败！"); //
    mysqli_query($conn,"set names utf8"); 
    $user_id = $_REQUEST['user_id'] ;   
    $sql = " delete from user where user_id={$user_id}";
    $result = mysqli_query($conn,$sql);

    if($conn) mysqli_close($conn);

     echo "<script>
           window.location.href='admin.php';
           alert('删除成功');
            </script>";

 ?>