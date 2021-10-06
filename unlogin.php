<?php
    header ( "Content-type: text/html; charset=utf-8" );
    $isdel = $_REQUEST['isdel'];
    if(session_status() != PHP_SESSION_ACTIVE) session_start(); 
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];  //创建{id: number}
    }
    if( $isdel == "yes"){
        unset($_SESSION['cart']);


        //删除登录标志
        unset($_SESSION['setlogin']);
   


         // // 初始化session.
        // session_start();
        // /*** 删除所有的session变量..也可用unset($_SESSION[xxx])逐个删除。****/
        // $_SESSION = array();
        // /***删除sessin id.由于session默认是基于cookie的，所以使用setcookie删除包含session id的cookie.***/
        if (isset($_COOKIE[session_name()])) {
           setcookie(session_name(), '', time()-42000, '/');
        }
        // 最后彻底销毁session.
        session_destroy();
    }
    

   
?>