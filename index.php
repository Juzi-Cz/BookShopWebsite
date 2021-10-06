<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<?php
    $tip = "Weclcome！";
    if(isset($_REQUEST['tipType'])){
        $admin = base64_encode("管理员");
        echo $admin;
        $tipType = $_REQUEST['tipType'];
        switch ($tipType){
            case "1":
                $tip = "空账户Warnning!";
                break;
            case "2":
                $tip = "空密码Warnning!";
                break;
            case "3":
                $tip = "长度不合法Warnning!";
                break;
            case "4":
                $tip = "账户或密码错误Warnning!";
                break;
            case "5":
                $tip = "登录成功！";

                // 添加登录标志
				if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
                if(!isset($_SESSION['setlogin'])){
                    $setlogin = "登录";
                    $_SESSION['setlogin'] = $setlogin;
                    echo "登录了!";
                }
                echo "<script>window.location.href='products.php';</script>";
                break;
            case "30":
                echo "<script>alert('验证码。');</script>";
                break;
            case "$admin":
                $tip = "Administration!";
                //管理员登陆标志
                if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
                if(!isset($_SESSION['admin'])){
                    $setlogin = "管理员登录";
                    $_SESSION['admin'] = $admin;
                    echo "管理员登录了!";
                }
                echo "<script>window.location.href='admin.php';</script>";
                break;
            
           

                

        }
    };
?>
    <div id = "root">
        <div>
            <div class = "bg" style="background-image: url(./Images/login.jpg);">
            </div>
            <div class="login">
                <p id = "p1">陈焯的小破站</p>
                <div id = "content">
                    <form class = "form" action="login.php" method = "get">
                        <div id = "account">
                            <input type="text" id = "user"  name = "user" placeholder = "账户(6个字符以内）">
                        </div>
                        <div id = "password" >
                            <input type="password" type="text "  id = "psw" name = "psw" placeholder = "密码（6-16个字符组成，区分大小写）">
                        </div>

                        <!-- 验证码 -->
                        <input name="yanzheng" id="yanzheng" type="text" placeholder="验证码"  >
                        <img src="authcode.php" border='1' name="img" align="absmiddle" onclick="this.src='authcode.php?id='+Math.random()" style="cursor:pointer"/>


                        
                        <button id = "loginbutton" name = "submit" type = "submit">
                            登录
                        </button>       
                    </form>
                </div>
            </div>
            <div id = "tipimg">
                <img id = "imgtip" src="Images/home.png" alt="">                 
            </div>
        </div>
        <div id = "tipcontent">
            <p id = "tipdiv" style="color:white;font-size:15px;position:absolute;top:-2%;left:69%" class = "tipdiv"><?=$tip;?></p> 
        </div>
        
        <div id = "left">
            <p id = "p1" style="position:absolute;top:92%;left:37%;font-size:13px" ><a href="javascript:void">忘记密码?</a></p>
        </div>
        <div id = "right">
        
           <a id = "href" href="registere.php" style="text-decoration: none;position:absolute;top:95%;left:62.5%;font-size:13px;color:white;" >注册</a>
           <img src="Images/edit.png" alt="" style="width:17px;height:17px;position:absolute;top:94.5%;left:64%">
        </div>
    </div>

<script>
    function isShowError(){
        var imgsrc = ["Images/0.png","Images/kongpsw.png","Images/long.png","Images/err1.png","Images/admin.png"];
        var degree = 1;          //初始透明度
        var imgtip = document.getElementById("imgtip");   //获取到提示的图标   五秒后隐藏
        setInterval(function(){
            imgtip.style.opacity = degree;
            degree -= 0.08;
            if(degree < 0){                                 //有时间弄成变速动画
                clearInterval();
            }
            console.log("图标透明度--->" + degree)
           
        },1000);


        console.log("等待登录")   //测试

        var tipdiv = document.getElementById("tipdiv");    //获取到消息文字的div
        var pValue = tipdiv.innerHTML;
        if(pValue == "空账户Warnning!"){
            imgtip.src = imgsrc[0];
            console.log("换图片你")
        }
        else if(pValue == "空密码Warnning!" ){
            imgtip.src = imgsrc[1]
        }
        else if(pValue == "长度不合法Warnning!"){
            imgtip.src = imgsrc[2]
        }
        else if(pValue == "账户或密码错误Warnning!" ){
            imgtip.src = imgsrc[3]
        }
        
        console.log(pValue)
        if( pValue.length > 0){        //存在提示消息  即没有成国公登录
            imgtip.opacity = 1.0;
            imgtip.style.display = "block";   //显示图标
            
        }

    }
    isShowError()

    // 进入管理员界面
    function admin(){
        var p1 = document.getElementById("p1");  //点击管理
        p1.onclick = function(){
            console.log("管理")
            window.location.href="admin.php";
        }
    }










</script>

</body>
</html>