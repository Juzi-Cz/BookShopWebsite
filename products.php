<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="products.css">
    <script src="jquery.min.js"></script>

</head>
<style type="text/css">







*{margin:0;padding:0;}
body{
     

  
}
.box{width: 100%;height: 170px;position: fixed;bottom: 0;left: 0;background: rgba(244, 67, 54,0.3);}
.box-inner{width:1000px;height:147px;margin:0 auto;position:relative;}
.box-inner .person{position: absolute;left:0;bottom:0;}
.box-inner .btn{position: absolute;left: 921px;top: -48px;cursor: pointer;}
.people{position: fixed;left:-130px;bottom: 0;cursor: pointer;}
</style>
<body>
<div id= "root">
    <div id = "main">
        <p id="tip">商品页面</p>
        <a id="tocar" href="car_mi.php">购物车</a>
        <span id="car"><img src="Images/shopcar.png" alt=""></span>
     <div id = "shouji">
           
       </div>
       <!-- 商品展示页面 -->
       <div class = "product">
           <div class = "pro1">

                <img src="Images/phone1.jpg" alt="">
                <h3 class="pro_h">小米10 至尊版</h3>
                <p class="pro_p1">144Hz[7档]变速高刷屏</p>
                <p class="pro_p2">2000</p>
                <a class="pro_a" href="javascript:void(0);" id = "aaa" >加入购物车</a>
           </div>

           <div class = "pro1">
                <img src="Images/phone3.jpg" width="250px" height="250px" alt="">
                <h3 class="pro_h">Redmi K30S 至尊纪念版</h3>
                <p class="pro_p1">天玑1000+旗舰处理器</p>
                <p class="pro_p2">2199</p>
                <a class="pro_a" href="javascript:void(0);" id = "aaa">加入购物车</a>
           </div>

           <div class = "pro1">
                <img src="Images/phone2.jpg" width="250px" height="250px" alt="">
                <h3 class="pro_h">Redmi K30 至尊版</h3>
                <p class="pro_p1">变焦/120W秒充/120Hz屏幕</p>
                <p class="pro_p2">2599</p>
                <a class="pro_a" href="javascript:void(0);" id = "aaa">加入购物车</a>
           </div>

           <div class = "pro1">
                <img src="Images/phone4.jpg" width="250px" height="250px" alt="">
                <h3 class="pro_h">腾讯黑鲨3S</h3>
                <p class="pro_p1">骁龙865处理器，120Hz刷新率</p>
                <p class="pro_p2">2999</p>
                <a class="pro_a" href="javascript:void(0);" id = "aaa">加入购物车</a>
           </div>

           <div class = "pro1">
                <img src="Images/phone5.jpg" width="250px" height="250px" alt="">
                <h3 class="pro_h">Redmi K30 Pro</h3>
                <p class="pro_p1">120W秒充/120Hz屏幕</p>
                <p class="pro_p2">3199</p>
                <a class="pro_a" href="javascript:void(0);" id = "aaa">加入购物车</a>
           </div>

           <div class = "pro1">
                <img src="Images/phone6.jpg" width="250px" height="250px" alt="">
                <h3 class="pro_h">小米10 青春版 5G</h3>
                <p class="pro_p1">双模5G，骁龙865，弹出全面屏</p>
                <p class="pro_p2">4299</p>
                <a class="pro_a" href="javascript:void(0);" id = "aaa">加入购物车</a>
           </div>
       </div>
       
    </div>
    <div id = "tv">  
     </div>


          <div class="box">
               <div class="box-inner">
                    <img class="person" src="images/ad1.png" height="220" width="1000" alt="" />
                    <img src="images/关闭.png" height="30" width="30" alt="" class="btn" />
               </div>	
          </div>
          <div class="people">
               <img class="goto" src="images/购物车.png" height="50" width="50" alt="" />
               
     </div>

        
</div>


<?php     
     if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
     $booksArr = [
          ["Images/phone1.jpg", "小米10 至尊版", "144Hz[7档]变速高刷屏", 2000,"a"],
          ["Images/phone3.jpg", "Redmi K30S 至尊纪念版", "120Hz全面屏，天玑1000+旗舰处理器", 2199,"b"],
          ["Images/phone2.jpg", "Redmi K30 至尊版", "120X 变焦/120W秒充/120Hz屏幕", 2599,"c"],
          ["Images/phone4.jpg", "腾讯黑鲨3S", "骁龙865处理器，120Hz刷新率", 2999,"d"],
          ["Images/phone5.jpg", "Redmi K30 Pro", "120X 变焦/120W秒充/120Hz屏幕", 3199,"e"],
          ["Images/phone6.jpg", "小米10 青春版 5G", "双模5G，骁龙865，弹出全面屏", 4299,"f"]
     ];
	$_SESSION['booksArr'] = $booksArr;
?>
<script>
     function addCart(id){ 
     var xmlhttp;  //创建 XMLHttpRequest 对象
     if (window.XMLHttpRequest){
               // IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
               xmlhttp=new XMLHttpRequest();
          }
          else{                   
               // IE6, IE5 浏览器执行代码
               xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
          //创建在服务器响应就绪时执行的函数
               xmlhttp.onreadystatechange=function(){
               if ( xmlhttp.readyState==4 && xmlhttp.status==200 ){
                    // obj[4] = xmlhttp.responseText;                  //计算数量
                    console.log("等待操作!")
               }
          }
          //向服务器上的文件发送请求
          console.log("发送之前")
          xmlhttp.open("GET","returnNum.php?bookid="+id,true);
          xmlhttp.send();

     }


     function ciick_a(){
          var clicka = document.getElementsByTagName('a');
          console.log("等待点击")
          for(i = 1;i < clicka.length; i ++){                //右上角的购物车是第零个a标签
               clicka[i].onclick = function(){         //为每一个 购买 注册点击事件
                    alert("添加购物车成功!")
                    var car_parent = this.parentNode;    //得到父元素
                    var car_src = car_parent.children[0].getAttribute("src")    //获取src
                    var car_model = car_parent.children[1].innerHTML;    //获取手机名字
                    var car_info = car_parent.children[2].innerHTML;      //手机介绍
                    var car_price = car_parent.children[3].innerHTML;    //价格
               
                    // var obj = [car_src, car_model, car_info, car_price] ;   
                    addCart(car_price)        //传入型号
                    console.log("当前选中的手机是:--------->  "  + car_model)
                   
                                      
               }
          }
     }
     ciick_a()

    
     
</script>

<script>
          var winWidth = $(window).width();
     $('.btn').click(function(event) {
          $('.box').animate({left:-winWidth,opacity: 0.1}, 500,function(){
                    $('.people').animate({left:0,top:"30%"}, 500);
          });
          $('.goto').click(function(e){
               window.location.href="car_mi.php";
          })

     });

</script>

<?php 
    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
	if(isset($_SESSION['setlogin'])){
        $setlogin = $_SESSION['setlogin'];  //创建{id: number}
     
        echo "登录了!";
    }
	else{
          echo "<script>alert('请先登录!');
               window.location.href='index.php';
               </script>";
          
    }
    
?>

</body>
</html>


                                    



                                                                        


                                    
                                    

                                    