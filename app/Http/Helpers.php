<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Adiciona uma mascára a qualquer campo informado.
 * @param string $val Valor que irá receber a mascara.
 * @param string $mask Descrição da mascára a ser adicionada, o campo aceita
 * apenas o número '9' como exemplo de mascára ex. 99/99/9999.
 * @return string Retorna a string formatada de acordo com o informado na
 * variável $mask.
 * @static.
 */
function mask($val, $mask)
{
	$maskared = '';
	
	if(!($val == '' || empty($val)))
	{
		$k = 0;
		
		for($i = 0; $i<=strlen($mask)-1; $i++)
		{
			if($mask[$i] == '9')
			{
				if(isset($val[$k]))
					$maskared .= $val[$k++];
			}
			else
			{
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}
	}
	
	return $maskared;
}

/**
 * @param $str
 * @return mixed|string
 */
function humanize($str)
{
	$str = trim(mb_strtolower($str));
	$str = str_replace(['-', '_'], ' ', $str);
	$partesNome = explode(" ", $str);
	$exclude = array('da', 'das', 'de', 'do', 'dos', 'e', 'o', 'a', 'para', 'no', 'na', 'ou', 'as', 'os');
	$nomeCapitalizado = '';
	
	foreach($partesNome as $parte)
	{
		if(in_array(strtolower($parte), $exclude))
			$parte = strtolower($parte);
		else
			$parte = ucfirst($parte);
		
		$nomeCapitalizado .= $parte . " ";
	}
	
	return trim($nomeCapitalizado);
}

/**
 * @param      $string
 * @param bool $float
 * @return false|int|null|string|string[]
 */
function getOnlyNumbers($string, $float = false)
{
	if($float)
		$result = preg_match_all('!\d+\.*\d*!', $string);
	else
		$result = preg_replace('/\D/', '', $string);
	
	return $result;
}

/**
 * @param $data StdClass
 * @return bool|mixed
 */
function sendMail($data)
{
	try
	{
		$mail = Mail::to($data->receiver_mail)->send( new \App\Mail\SendMail($data) );
		Log::info("Um email foi enviado para {$data->receiver_mail} com sucesso!");
		return true;
	}
	catch(\Exception $error)
	{
		Log::info("Tentativa de enviar um email para {$data->receiver_mail} falhou!");
		Log::debug($error);
		return false;
	}
}

/**
 * Remove all duplicated arrays
 * @param $src
 * @return array
 */
function multi_unique($src)
{
	$output = array_map("unserialize",
	array_unique(array_map("serialize", $src)));
	
	return $output;
}

/**
 * @param $object
 * @return array
 */
function objToArray($object)
{
	if(is_array($object) || is_object($object))
	{
		$result = array();
		
		foreach($object as $key => $value)
			$result[$key] = objToArray($value);
		
		$object = $result;
	}
	
	return $object;
}

/**
 * @param $value
 * @return array|string
 */
function strip_tags_deep($value)
{
	return is_array($value) || is_object($value) ?
		array_map('strip_tags_deep', $value) :
		strip_tags($value);
}

//array_reduce($productVarId, 'array_merge', array());