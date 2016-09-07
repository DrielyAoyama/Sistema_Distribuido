<?php
	require __DIR__.'/mqtt.php';

	define('HOST', "HTTPS://EXEMPLO.COM");
	define('PORTA', 587);
	define('USUARIO',"DRIELY");
	define('CLIENTE_ID', "CLIENTE_1");
	define('SENHA', "123456789");
		



	function publish($mensagem="")
	{
	 	$host = HOST; 
	  	$porta = PORTA;
	 	$usuario = USUARIO; 
	 	$senha = SENHA; 
	 	$id_cliente = CLIENTE_ID;
	  	$mqtt = new phpMQTT($host, $porta, CLIENTE_ID); 

		if ($mqtt->connect(true,NULL,$usuario,$senha)) 
		{
		   $mqtt->publish("topic",$mensagem, 0);
		   $mqtt->close();
		}
		else
		{
		    echo "Falha ou tempo limite expirou<br />";
		}
	}

	function subscribe($mensagem="")
	{
	  	$host = HOST; 
	  	$porta = PORTA;
	 	$usuario = USUARIO; 
	 	$senha = SENHA; 
	 	$id_cliente = CLIENTE_ID;
	  	$mqtt = new phpMQTT($host, $porta, CLIENTE_ID); 

		if(!$mqtt->connect(true,NULL,$usuario,$senha))
		  exit(1);

		$topicos['topic'] = array("qos"=>0, "function"=>"procmsg");
		$mqtt->subscribe($topicos,0);

		while($mqtt->proc()){}

		$mqtt->close();		
	}

	function procmsg($topic,$msg)
	{
	  	echo "Mensagem: $msg";
	}