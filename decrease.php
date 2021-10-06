<?php 
  header ( "Content-type: text/html; charset=utf-8" );

	$decrease_price = $_REQUEST['decrease_price'];

    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
	if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];  //创建{id: number}
    }
	else{
        $cart = [];
    }
    if(array_key_exists("$decrease_price",$cart)){   //减少
        $cart[$decrease_price] --;
        
        if($cart[$decrease_price] == 0){
            unset($cart[ $decrease_price ]);
        }
        
        
           
    }
		

	

	$_SESSION['cart'] = $cart;  //全局{id: number}变量

    
    
 ?>