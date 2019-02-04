<?php

//action.php

if(isset($_POST["action"]))
{
	// Se a ação for inserir
	if($_POST["action"] == 'insert')
	{
		// Aqui faço removo os caracteres especiais para inserir no banco somente números
		$phone = preg_replace('/\D+/', '', $_POST['number']);
		// Pego a data atual do servidor
		$date = date('Y-m-d H:i:s');
		$form_data = array(
			'first_name'	=>	$_POST['first_name'],
			'last_name'		=>	$_POST['last_name'],
			'number'		=>	$phone,
			'date_insert'	=>	$date,
		);

		print_r($form_data);
		$api_url = "http://localhost/teste-madeira/api/test_api.php?action=insert";  
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'insert';
			}
			else
			{
				echo 'error';
			}
		}
	}
	// Se a ação trazer todos os dados do cliente buscando pelo id
	if($_POST["action"] == 'fetch_single')
	{
		$id = $_POST["id"];
		$api_url = "http://localhost/teste-madeira/api/test_api.php?action=fetch_single&id=".$id."";  
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
	// Se a ação for atualizar
	if($_POST["action"] == 'update')
	{

		// Aqui faço removo os caracteres especiais para inserir no banco somente números
		$phoneUpdate = preg_replace('/\D+/', '', $_POST['number']);
		
		$form_data = array(
			'first_name'	=>	$_POST['first_name'],
			'last_name'		=>	$_POST['last_name'],
			'number'		=>	$phoneUpdate,
			'id'			=>	$_POST['hidden_id']
		);
		$api_url = "http://localhost/teste-madeira/api/test_api.php?action=update";  
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_POST, true);
		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		curl_close($client);
		$result = json_decode($response, true);
		foreach($result as $keys => $values)
		{
			if($result[$keys]['success'] == '1')
			{
				echo 'update';
			}
			else
			{
				echo 'error';
			}
		}
	}

	// Se a ação for deletar
	if($_POST["action"] == 'delete')
	{
		$id = $_POST['id'];
		$api_url = "http://localhost/teste-madeira/api/test_api.php?action=delete&id=".$id.""; 
		$client = curl_init($api_url);
		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($client);
		echo $response;
	}
}


?>