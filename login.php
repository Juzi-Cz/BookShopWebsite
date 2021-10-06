<?php 
	header("content-type:text/html; charset=utf-8");

	$isYanZheng = false;  //初始没有验证
	$yanzhengma = trim($_REQUEST['yanzheng']);  //输入的验证码
    if( isset($_REQUEST['submit'])){

		if(session_status() != PHP_SESSION_ACTIVE) session_start();   //开启session

		if(isset($_SESSION['authcode'])) $authcode = $_SESSION['authcode'];  //得到生成的验证码
		
		if($authcode == $yanzhengma ){  //验证成功
			$isYanZheng = true;
		}
		

		
		
        $user = trim($_REQUEST['user']);    //trim是去掉多余的空格
        $psw = trim($_REQUEST['psw']);
        $tipinfo = "";
        if($user ==""){
            $tipinfo = 1;   //空账户
        }
        else if($psw == ""){
            $tipinfo = 2;   //空密码
        }
        else if(strlen($user) > 6 || strlen($psw) < 6 || strlen($psw) > 16){
            $tipinfo = 3;    //长度不合法
		}
		else if(($user == "lemmon") && ($psw == "7654321") && $isYanZheng){           //管理员
			$tipinfo = "管理员";
			$tipinfo = base64_encode($tipinfo);

		}
		if(!$isYanZheng ){
			$tipinfo = 30;  //验证码相关
		}
		// 检测验证码是否输入
        else {
            $dbhost = "127.0.0.1";		
			$dbuserName = "root";			
			$dbpassword = "root";			
			$dbName = "mydb";           //创建的数据表
			
			$sql = "select * from user where user_name = '{$user}' and user_psw=MD5('{$psw}')";
			//1.建立与MySQL数据库服务器的连接，并选择 //目标数据库
			$conn = mysqli_connect($dbhost, $dbuserName, $dbpassword,$dbName) or die("连接数据库服务器失败！");
			mysqli_query($conn,"set names utf8");          //设置数据库编码格式utf8防止中文乱码

			$sql = "select * from user where user_name =? and user_psw=?";         //遍历所有的名字和密码的SQL语句
			$stmt = mysqli_prepare($conn,$sql);                    //返回存储的账户集合  预处理语句
			mysqli_stmt_bind_param($stmt,'ss',$user, $psw);     //绑定存储结果的变量
			mysqli_stmt_execute($stmt);   //成功时候返回True 失败时候返回false
			mysqli_stmt_store_result($stmt);     //存储数据到客户端
			
            

			if(mysqli_stmt_affected_rows($stmt)>0  && $isYanZheng ) {//获取查询的记录数量   匹配的话就是存在  

					// 验证码正确
				$tipinfo = 5;                         //登录成功进入商品页面
			}else{
				$tipinfo = 4;                 //"用户名或密码错误!"
			}
			// mysqli_stmt_close($stmt);
		    /*如果是要获取结果中的记录，按以下方式去获取*/
		    // mysqli_stmt_bind_result($stmt, $user, $psw);
		    // while (mysqli_stmt_fetch($stmt,$user, $psw)) {
			// 	printf("%s %s\n", $user, $psw);
			// 	return;
			// }
			mysqli_stmt_close($stmt);
		    //------------------------------------------
			 //做完所有的操作后，关闭数据库连接

			 
			if($conn){
				mysqli_close($conn);
			}
			
        }
    }
    $url="index.php?tipType={$tipinfo}";     //通过地址栏传送数据
    echo "<script>window.location.href='$url';</script>";

?>