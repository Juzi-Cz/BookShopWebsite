<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>我的购物车v1.0</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="car.css">
    </head>

<body>


<div class="w">
    <div class="headline"> 全部商品 </div>
</div>

<div class="bar">
    <div class="t-checkbox">
        <div class="cart-checkbox">
            <input type="checkbox" id="allchecked" onclick="setAll()">
            <label for></label>
        </div>全选</div>
        
    <div class="t-goods">商品</div>
    <div class="t-shop">商家</div>
    <div class="t-price">单价</div>
    <div class="t-quantity">数量</div>
    <div class="t-sum">小计</div>
    <div class="t-action">操作</div>
</div>

<div class="item-list" id="item-list">
<?php 
    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
    if(isset($_SESSION['cart']))
        $cart = $_SESSION['cart'];
    else
        $cart = [];


    if(isset($_SESSION['booksArr']))
        $booksArr = $_SESSION['booksArr'];
    else
        $booksArr = [];

    $sum_price = 0;

    foreach ($cart as $bookid => $booknum) { 
        for($i=0;$i<count($booksArr);$i++)
            if($booksArr[$i][1] == $bookid)
            {
                $onebook = $booksArr[$i];
                break;
            } 


?>
    <div class="item" id="002">
        <div class="p-checkbox">
            <input type="checkbox" name="p-radio" ><label for></label>
        </div>

        <div class="p-goods">
            <div class="p-img"><img src=<?= $onebook[0]?> width=80 height=40></div>
            <div class="p-name"><?= $onebook[1]?></div><br>

        </div>

        <div class="p-shop"><?= $onebook[2]?></div>

        <div class="p-price">￥<span class="onlyPrice"><?= $onebook[3]?></span></div>

        <div class="p-quantity">
            <input type="button" class="decrease" value="-">
           <input type="text" class="quantity" value="<?=$booknum?>"/>
           <input type="button" class="increase" value="+">
        </div>

        <div class="p-sum">￥<span class="onlySum"><?php echo $temp=$onebook[3] * $booknum; $sum_price+=$temp;?></span></div>

        <div class="p-action">
            <input type="button" class="deleteItem" value="删除"/>
        </div>
    </div>

<?php 

}
 ?>
</div>

<div class="settlement">
   <div class="ww">
        <div id="calculate">结算</div>
        <div class="price-sum">
            总价：￥<span class="sum-price"><?= $sum_price?></span>
        </div>
   </div>
    
    <div class="submit">
        <a href="javascript:void(0)" id="submit-order">提交订单</a>
    </div>
</div>

</body>
</html>