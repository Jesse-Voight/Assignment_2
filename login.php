<?php
session_start();
if(isset($_GET['p'])){
    $passworde = $_GET['p'];
    if($passworde = "p"){
        $_SESSION['password']=true;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

