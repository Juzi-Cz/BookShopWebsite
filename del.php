<?php 
  header ( "Content-type: text/html; charset=utf-8" );

	$price = $_REQUEST['price'];

    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
	if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];  //创建{id: number}
    }
	else{
        $cart = [];
    }
    if(array_key_exists("$price",$cart)){   //删除
        $cart[$price] --;
        
        if($cart[$price] == 0){
            unset($cart[ $price ]);
        }
    }
		
	$_SESSION['cart'] = $cart;  //全局{id: number}变量

    
    
 ?>
 