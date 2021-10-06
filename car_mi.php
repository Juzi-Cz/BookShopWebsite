<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="car_mi.css">
    <script src="jquery.min.js"></script>
    
</head>
<body>

    <div id = "root">
        <div id="banner">

            <div class="topbox">
                <div class="container">
                    <div class="hezi">
                        <div id="mi">
                            <img id="carmi" src="Images/car_mi.png" alt="#">
                        </div>
                        <p id = "p1">我的购物车</p>
                        <p id="p2" >温馨提示：产品是否购买成功，以最终下单为准哦，请尽快结算</p>
                    </div>
                    
                </div>
                <div class="unlogin" style="margin-top: -51px;margin-left: 1620px;position:absolute">

                    <img class="t_img " src="Images/退出.png" style="width:32px;height:32px" alt="#">
                    <button id="un" class="t_button" style="cursor: pointer;border: 1px solid rgba(0,0,0,.2);;border-radius:6px;width:55px;height:35px;margin-left: 10px;position:relative;top:-8px " >退出</button>
                </div>
            
            </div>
            








        </div>
       
        <div id = "main">
            <div id="bar">

                <input type="checkbox" onclick="setAll()" id="allchecked" >
                <div id = "alls" >全选</div>
               
                <div class="t-shop">该款手机的描述</div>
                <div class="t-price">单价</div>
                <div class="t-quantity">数量</div>
                <div class="t-sum">小计</div>
                <div class="t-action">操作</div>
            </div>
            
            <?php 
                if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
                if(isset($_SESSION['cart']))
                    $cart = $_SESSION['cart'];
                else
                    $cart = [];
                // 当前购物车信息
                // $list =  json_encode($cart);
                // echo $list;
                if(isset($_SESSION['booksArr']))
                    $booksArr = $_SESSION['booksArr'];
                else
                    $booksArr = [];
                
                
                $sum_price = 0;

                foreach ($cart as $bookid => $booknum) { 
                    for($i=0;$i<count($booksArr);$i++)
                        if($booksArr[$i][3] == $bookid)
                        {
                            $onebook = $booksArr[$i];
                            break;
                        } 


            ?>
                <div class="item" id="002">
                    <div class="p-checkbox">
                        <input type="checkbox" name="p-radio" >
                    </div>

                    <div class="p-goods">
                        <div class="p-name"><?= $onebook[1]?></div><br>
                        <div class="p-img"><img src=<?= $onebook[0]?> width=80 height=40></div>
                        
                    </div>

                    <div class="p-shop"><?= $onebook[2]?></div>

                    <div class="p-price">￥<span class="onlyPrice"><?= $onebook[3]?></span></div>

                    <div class="p-quantity">
                        <input type="button" class="decrease" value="-"  >
                        <input type="text" class="quantity"  value="<?=$booknum?>"/>
                        <input type="button" class="increase" value="+">
                    </div>

                    <div class="p-sum">￥<span class="onlySum"><?php echo $temp=$onebook[3] * $booknum; $sum_price+=$temp;?></span></div>

                    <div class="p-action" >
                    <!-- <input type="button" class="deleteItem"     id="<?=$onebook[4]?>" value="删除"  /> -->
                    <p  class="deleteItem" style="color:red;cursor:pointer"  >删除</p>
                    </div>
                </div>

            <?php 

            }
            ?>
            <p id="total" class="jiesuan" style="font-size:30px;color:#d4237a;font:weight;margin-left:1350px;margin-top:50px" ><span style="color:red;font-size:20px;margin-right:30px">总计:</span><?= $sum_price;?>$   </p>

           
        </div>
        


        
    
    </div>



    <!-- 单个选择框 -->
<script>
        var inputTags = document.getElementsByTagName('input');
        var index = 0
        for(var i = 1; i < inputTags.length; i ++){
            inputTags[i].onclick = function(){
                console.log("你好啊啊啊")
                for(var j = 1; j < inputTags.length; j ++){
                    if( inputTags[j].checked == true){
                        index += 1
                    }
                }
                if(index == inputTags.length -1){
                    inputTags[0].checked = true
                }
                else if(index != inputTags.length -1){
                    inputTags[0].checked = false
                }
                index = 0    
            }
        }
</script>

   
     <!-- 全选框 -->
<script>
             function setAll(){
               var inputTag = document.getElementsByTagName('input');
                   for(var i = 1; i < inputTag.length; i ++){
                       inputTag[i].checked = inputTag[0].checked;
                   }      
           }
</script>



    <!-- 删除商品 -->
<script>
    function addCart(price){ 
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
                    console.log("无提示")
               }
          }
          //向服务器上的文件发送请求
          xmlhttp.open("GET","del.php?price="+price,true);
          xmlhttp.send();

     }
        var dels = document.getElementsByClassName("deleteItem");
        for(var i = 0; i < dels.length; i ++){
          
            dels[i].onclick = function(e){
               
                var delsp = this.parentNode.parentNode;   //item
                var delson = delsp.children[3]   // <div class="p-price">
             
                var price = delson.children[0].innerHTML
                console.log(price)
                addCart(price)   
                window.location.href="car_mi.php";
            
            }
        }
</script>




<!-- 减少 -->
<script>
         function decrease(decrease_price){ 
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
                    console.log("无提示")
               }
          }
          //向服务器上的文件发送请求
          xmlhttp.open("GET","decrease.php?decrease_price="+decrease_price,true);
          xmlhttp.send();

     }
        var dels = document.getElementsByClassName("decrease");
        for(var i = 0; i < dels.length; i ++){
          
            dels[i].onclick = function(e){
               
                var delsp = this.parentNode.parentNode;   //item
                var delson = delsp.children[3]   // <div class="p-price">
             
                var decrease_price = delson.children[0].innerHTML
                console.log("减少一个"+decrease_price)
                decrease(decrease_price)   
                window.location.href="car_mi.php";
            
            }
        }
</script>

<!-- 增加 -->
<script>
     function increase(increase_price){ 
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
                    console.log("无提示")
               }
          }
          //向服务器上的文件发送请求
          xmlhttp.open("GET","increase.php?increase_price="+increase_price,true);
          xmlhttp.send();

     }
     var dels = document.getElementsByClassName("increase");
        for(var i = 0; i < dels.length; i ++){
          
            dels[i].onclick = function(e){
               
                var delsp = this.parentNode.parentNode;   //item
                var delson = delsp.children[3]   // <div class="p-price">
             
                var increase_price = delson.children[0].innerHTML
                console.log("增加一个"+increase_price)
                increase(increase_price)   
                window.location.href="car_mi.php";
            
            }
        }
</script>

<!-- 退出 -->
<script>
    function unlogin(isdel){ 
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
          xmlhttp.open("GET","unlogin.php?isdel="+isdel,true);
          xmlhttp.send();

     }


    var unset = document.getElementsByClassName("t_button");
    unset[0].onclick = function(){
        unset[0].innerHTML = "已退出!"
        var isdel = "yes"
        unlogin(isdel)
        var t_img = document.getElementsByClassName("t_img");
        t_img[0].src = "Images/登录.png";
        
        // window.location.href="car_mi.php";
        console.log("退出登录!")
    }
       
</script>










</body>
</html>