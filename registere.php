<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
<script type="text/javascript">
    var province=["北京","上海","广东","江苏","浙江","重庆","安徽","福建","甘肃","广西",
            "贵州","海南","河北","黑龙江","河南","湖北","湖南","江西","吉林","辽宁","内蒙古",
            "宁夏","青海","山东","山西","陕西","四川","天津","新疆","西藏","云南","中国香港",
            "中国澳门","中国台湾","海外"];
</script>
    <div id = "root">
        <div>
            <div class = "bg" style="background-image: url(./Images/re.jpg);">
                </div>
            <div id = "formdiv">
            <form id="form1" name="form1"  method="post" enctype="multipart/form-data">
            <div class="common">
                <p class="list" id = "pname" >姓名: </p>
                <input  type="text" name="name" id = "iname">
            </div>
            <div class="common">
                <p class="list" id="ppassword" >密码:</p>
                <input  type="password" name = "password" id = "ipassword" >
                <input type="password" onkeyup = "check()" name = "password1" id = "ipassword" >
            </div > 
            <div class="common" id="sexclass">
                <p class="list" id="psex">性别: </p>
                <!-- 单选按钮 -->
                <input type="radio" name="sex" value="南" class ="isex" ><span>男</span>
                <input type="radio" name = "sex" value="女" class = "isex"><span>女</span>
            </div>
            <div class="common">
                <p class="list" id="pbirth">出生年月: </p>
                <input type="data" name="birthday" id="ibirth" value="2000-01-01">
            </div>
            <div class="common">
                <p class="list" id = "pjiguan">籍贯:</p>
                <div id = "option">
                    <select name="birthplace" id="sjiguan">
                        <script type="text/javascript">
				            for (var i = 0; i < province.length; i++) {
					            document.write("<option value='"+province[i]+"'>"+province[i]+"</option>");
				                }
	                    </script>	
                    </select>
                </div>
            </div>
            <div class="common" id = "aihaodiv">
                <p class="list" id = "paihao">爱好:</p>
                <input class="iaihao" type="checkbox" name="interest[]" value="看电影" /><span class="pp">看电影</span>
	            <input class="iaihao" type="checkbox" name="interest[]" value="听音乐" /><span class="pp">听音乐</span>
	            <input class="iaihao" type="checkbox" name="interest[]" value="演奏乐器" /><span class="pp">演奏乐器</span>
	            <input class="iaihao" type="checkbox" name="interest[]" value="打篮球" /><span class="pp">打篮球</span>
	            <input class="iaihao" type="checkbox" name="interest[]" value="看书" checked/><span class="pp">看书</span>
	            <input class="iaihao" type="checkbox" name="interest[]" value="上网" /><span class="pp">上网</span>
            </div>
            <div class="common">
                <p id = "ipingjia">自我评价：</p>
                <textarea name="comment" id="comment" cols="50" rows="5"></textarea>
            </div>
            <div id="foot">
                <input id="submit" type="submit" name="submit" value="提交" />
      		    <input id="reset" type="reset" name="reset" value="重置" />
            </div>
            </form>  
        </div>

    </div>
<script>
    //验证密码是否匹配
    function check(){
        setTimeout(() => {
            var psw1 = document.getElementsByName("password").value;
            var psw2 = document.getElementsByName("password1").vlaue;
            if(psw1 != psw2){
                alert("密码不一致!")
                return false
            }
            return true
            
        }, 1500);
        
    }
    
</script>
<?php
    if(!isset($_REQUEST['submit']))  return ;
    $name = $_REQUEST['name'];
    $psw = $_REQUEST['password'];
    $psw1 = $_REQUEST['password1'];
    // if($psw != $psw1){
    //     echo "<script> 
    //             var submit = document.getElementById("submit");

                
    //             setTimeout(() => {
    //                 window.location.href='register.php';
    //             }, 1000); 
    //         </script> ";
        
    // };
    $sex = $_REQUEST['sex'];
    $birthday = $_REQUEST['birthday'];
    $birthplace = $_REQUEST['birthplace'];
    // $schoolYear = $_REQUEST['schoolYear'];
    $interest = $_REQUEST['interest'];
    $interest_str="";  
    foreach ($interest as $key => $value) {
        if($interest_str=="") 
          $interest_str=$value;
        else
           $interest_str=$interest_str."|".$value;
      }
      $comment = $_REQUEST['comment'];
    
      //尝试链接服数据库

    $host = "127.0.0.1";      //当前的HOST 服务地址
    $userName = "root";    
    $password = "root";     
    $dbName = "mydb";        //创建的数据库实例的名字
    $conn = mysqli_connect($host, $userName, $password,$dbName) or die("连接数据库服务器失败！"); //获取到数据库实例
    mysqli_query($conn,"set names utf8");      //设置字符集
    $sql = " insert into user(user_name,user_psw ,user_sex ,birthday,birthplace,interest ,comment )  value('$name','$psw','$sex','$birthday','$birthplace','$interest_str','$comment');";
    $result = mysqli_query($conn,$sql);    //执行数据库   创建注册用户的语句


    if($result){     //创建成功后即关闭数据库连接资源
        mysqli_close($conn);        //回到登录页面开始登录
        echo "<script>
             window.location.href='index.php';        
              alert('注册成功！');
              </script>";
    } 





?>
</body>
</html>