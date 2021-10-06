<?php 
  header ( "Content-type: text/html; charset=utf-8" );

	$bookid = $_REQUEST['bookid'];
    $price =  $_REQUEST['price'];
    // $decrease_price = $_REQUEST['decrease_price'];
    // $increase_price = $_REQUEST['increase_price'];
    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
	if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];  //创建{id: number}
    }
	else{
        $cart = [];
    }
    if(array_key_exists("$bookid",$cart)){   //点击购买
        $cart[$bookid] ++;
        
    }
    else {
        $cart[$bookid] = 1;
    }
	if(array_key_exists("$price",$cart)){   //删除
        $cart[$price]-=1;
        
        if($cart[$price] == 0){
            unset($cart[ $price ]);
        }         
    }

	
   
    

    
    // if(array_key_exists("$decrease_price",$cart)){   //减少
    //     $cart[$decrease_price]--;
    //     if($cart[$decrease_price] == 0){
    //         unset($cart[ $price ]);
    //     }
        
           
    // }
    // if(array_key_exists("$increase_price",$cart)){   //增加
    //     $cart[$increase_price]++;
     
           
    // }
  
    

    $_SESSION['cart'] = $cart;  //全局{id: number}变量
    







    
    
 ?>