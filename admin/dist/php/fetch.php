<?php

/* fetch.php

Arquivo responsavel por preencher a tabela de contatos
*/

$api_url = "http://localhost/teste-madeira/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output;

if(count($result) > 0)
{
    $i = -1;
    $ano2017 = 0;
    $ano2018 = 0;
    $ano2019 = 0;

	foreach($result as $row)
	{
        // incremento o indice em cada loop
        $i++;
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

        $ano = substr($row->date_insert,0,4); 
        

        if($ano == '2017') {
            $ano2017 +=  1;
        }

        else if($ano == '2018') {
            $ano2018 +=  1;
        }

        else if($ano == '2019') {
            $ano2019 +=  1;
        }
        
        $output[$i]["first_name"] = $row->first_name;
        $output[$i]["last_name"] = $row->last_name;
        $output[$i]["number"] = $telefone;
        $output[$i]["date_insert"] = $row->date_insert;
        $output[$i]["ano2017"] = $ano2017;
        $output[$i]["ano2018"] = $ano2018;
        $output[$i]["ano2019"] = $ano2019;
        $output[$i]["count_numbers"] = count($result);   

        }
        echo json_encode($output);
	
}
else
{
    $output = "0 registros encontrados";
    echo $output;
}



?>