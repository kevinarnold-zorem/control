<?php 
	
	 spl_autoload_register(function ($class){
             include"model/Message/$class.class.php";
     });

     $message=isset($_POST['message']) && isset($_POST['type']) ? MessageFactory::createMessage($_POST['type']) : false;
	$message_out=$message ? $message->getMessage($_POST['message']) : '';


echo $message_out;

 ?>