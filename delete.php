<?php

 
 include("include/db.php");
 
 if(isset($_GET['id'])){

    //Delete records
    try{

    	$sql="DELETE FROM products WHERE id=:id Limit 1";
    	 $stmt=$conn->prepare($sql);
    	 $stmt->bindParam(":id",$_GET['id'],PDO::PARAM_INT);
    	 $stmt->execute();
      if($stmt->rowCount()){
      	   header('Location:index.php?status=deleted');
      	    exit();
      }	 
      header('Location:index.php?status=fail_delete');
       exit();
    }catch(Exception $e){

     echo "Error ".$e->getMessage();
    }

 }else{

 	header("Location:index.php?status=fail_delete");
 	exit();
 }


 if(empty($_SESSION['email']));
   header('Location: LoginPage.php');
?>