<?php 
	
	if (isset($_GET['action']) && $_GET['action']!="" && isset($_GET['type']) && $_GET['type']!="") {
			$file="action/".$_GET['action']."/".$_GET['type'].".php";

			if (file_exists($file)) {
				session_start();
			    spl_autoload_register(function ($class){
			        require_once "model/$class/$class.class.php";
			    });

				include $file;

			}
			else
			{
				echo "<b>$file</b> No Existe";
			}
	}
	elseif (isset($_GET['action']) && $_GET['action']!="") {
		$file="action/".$_GET['action']."/".$_GET['action'].".php";

			if (file_exists($file)) {
				session_start();
			    spl_autoload_register(function ($class){
			        require_once "model/$class/$class.class.php";
			    });

				include $file;

			}
			else
			{
				echo "<b>$file</b> No Existe";
			}
	}

	


 ?>