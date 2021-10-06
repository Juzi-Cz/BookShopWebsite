<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- 检查管理员登陆状态 -->
<?php 
    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
	if(isset($_SESSION['admin'])){
        $admin = $_SESSION['admin'];  //创建{id: number}
        echo "登录了!";
    }
	else{
          echo "<script>alert('请先登录!');
               window.location.href='index.php';
               </script>";
    }
?>

<!-- 用户列表 -->
<style type="text/css">
	.STYLE1 {
		font-size: 25px;
		font-weight: bold;
	}
	.STYLE2 {font-size: 20px}
</style>
<?php 
	header("content-type:text/html; charset=utf-8");
	$dbhost = "127.0.0.1";		//MySQL服务器地址,'localhost:3306';  
	$dbuserName = "root";			//用户名
	$dbpassword = "root";			//密码
	$dbName = "mydb"; //目标数据库
	$sql = "select * from user order by user_id";
	$conn = mysqli_connect($dbhost, $dbuserName, $dbpassword,$dbName) or die("连接数据库服务器失败！"); //连接MySQL服务器，选择数据库
	mysqli_query($conn,"set names utf8");						//
	$result=mysqli_query($conn,$sql);
	if($result) {
 ?>
<table width="1000" border="1"  cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td align="center"><span class="STYLE1">序号</span></td>
        <td  align="center"><span class="STYLE1">用户名</span></td>
        <td align="center"><span class="STYLE1">性别</span></td>
        <td  align="center"><span class="STYLE1">出生年月</span></td>
        <td  align="center"><span class="STYLE1">籍贯</span></td>
         <!-- <td  align="center"><span class="STYLE1">入学年份</span></td> -->
         <td align="center"><span class="STYLE1">爱好</span></td>
         <!-- <td  align="center"><span class="STYLE1">自我评价</span></td> -->
         <!-- <td  align="center"><span class="STYLE1">头像</span></td> -->
        <td align="center"><span class="STYLE1">操&nbsp&nbsp作</span></td>
      </tr>
       <?php 
          $sql = "select count(*) from user";
          $result=mysqli_query($conn,$sql);
          $myrow=mysqli_fetch_array($result);

          $pagesize = 3;//每页显示数
          $page = 1;//设置默认为第一页
          $totalpage = ceil($myrow[0]/$pagesize);//取上整数，如3.4页，则为4
          if(isset($_REQUEST['page'])){
            $page = $_REQUEST['page'];
            if($page<=0)
               $page = 1;
            elseif($page>$totalpage) 
               $page = $totalpage; //如果超出最大页数，则显示最后一页
          }

          $startNo = ($page-1)*$pagesize;//当前页显示的第一条记录为数据库中的第几条
          $sql = "select * from user order by user_id limit $startNo,$pagesize";
          $result=mysqli_query($conn,$sql);

       	while($myrow=mysqli_fetch_array($result)){ 
	   ?>
  	   <tr>

        <td align="center"><span class="STYLE2"><?=$myrow[0]?></span></td>
        <td align="center"><span class="STYLE2"><?=$myrow[1]?></span></td>
        <td align="center"><span class="STYLE2"><?=$myrow[3]?></span></td>
        <td align="center"><span class="STYLE2"><?=$myrow[4]?></span></td>
        <td align="center"><span class="STYLE2"><?=$myrow[5]?></span></td>
        <td align="center"><span class="STYLE2"><?=$myrow[6]?></span></td>
        <!-- <td align="center"><span class="STYLE2"><?=$myrow[7]?></span></td> -->
        <!-- <td align="center"><span class="STYLE2"><?=$myrow[9]?></span></td> -->
        <!-- <td align="center"><span ><img src=<?=$myrow[8]?> width=90px height=90px></span></td> -->
        <td align="center"><span class="STYLE2"><a href='delUser.php?optType=1&user_id=<?=$myrow[0]?>'>删除</a></span></td>
      </tr>
      <?php } ?>
        <tr>
            <td height="40" colspan="10" align="center" bgcolor="#FFFF00">&nbsp;&nbsp;
              <?php
                  if($page!=1){//如果当前页不是1则输出有链接的首页和上一页
                      echo "<a href='?tipType=10&showType=1&page=1'>首页</a>&nbsp;";
                    echo "<a href='?tipType=10&showType=1&page=".($page-1)."'>上一页</a>&nbsp;&nbsp;";
                  }else{//否则输出没有链接的首页和上一页
                      echo "首页&nbsp;上一页&nbsp;&nbsp;";
                  }
                  if($page!=$totalpage){//如果当前页不是最后一页则输出有链接的下一页和尾页
                      echo "<a href='?tipType=10&showType=1&page=".($page+1)."'>下一页</a>&nbsp;";
                    echo "<a href='?tipType=10&showType=1&page=".$totalpage."'>尾页</a>&nbsp;&nbsp;";
                  }else{//否则输出没有链接的下一页和尾页
                      echo "下一页&nbsp;尾页&nbsp;&nbsp;";
                  }
                   echo "第".$page."页/共".$totalpage."页&nbsp;&nbsp;";
              ?>
              </td> 
        </tr>
</table>
<?php 
	} 

	if($conn){
				mysqli_close($conn);
	}
?>

</body>
</html>