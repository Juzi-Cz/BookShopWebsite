<?php 
  header ( "Content-type: text/html; charset=utf-8" );

	$increase_price = $_REQUEST['increase_price'];

    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
	if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];  //创建{id: number}
    }
	else{
        $cart = [];
    }
    if(array_key_exists("$increase_price",$cart)){   //增加
        $cart[$increase_price] ++;
        
  
    }
		

	

	$_SESSION['cart'] = $cart;  //全局{id: number}变量

    
    
 ?>