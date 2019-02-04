<?php

/* fetch.php

Arquivo responsavel por preencher a tabela de contatos
*/

$api_url = "http://localhost/teste-madeira/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(count($result) > 0)
{
	foreach($result as $row)
	{
		// Quebro a variavel para pegar o DDD separado do numero e inserir a mascara
		$ddd = substr($row->number,0,2);
		
		$ddd = "(". $ddd .")";
		// Pego a primeira parte do telefone
		$telefone_parte1 = substr($row->number,2,4);
		// Pego a segunda parte do telefone
		$telefone_parte2 = substr($row->number,6,10);

		/* 	crio uma variavel concatenando o ddd e as duas partes do telefone
			inserindo o traço entre a primeira parte e a segunda parte do telefone. Ex: (11) 2233-4455 */
		$telefone = $ddd . " ". $telefone_parte1 . "-" . $telefone_parte2;

		$data = implode('/', array_reverse(explode('-', $row->date_insert)));

		$output .= '
		<tr>
			<td>'.$row->first_name.'</td>
			<td>'.$row->last_name.'</td>
			<td>'.$telefone.'</td>
			<td>'.$data.'</td>
			<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Editar</button></td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Deletar</button></td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="6" align="center">0 registros encontrados</td>
	</tr>
	';
}

echo $output;

?>