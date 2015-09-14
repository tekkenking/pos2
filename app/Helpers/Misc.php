<?php

/*
 * --------------------------------------------------------------------
 * Used for outputing 
 * --------------------------------------------------------------------
 *This function displays structured information about one or more expressions that includes its type and value. Arrays and objects are explored recursively with values indented to show structure
 */
if( ! function_exists('tt')){
	function tt($array, $noexit=FALSE, $name='')
	{
		echo "<pre class='alert alert-info'>  {$name} ";
		var_dump($array);
		echo "</pre>";
			if($noexit === FALSE){ exit;}
	}
}

/*
 * --------------------------------------------------------------------
 * Used for outputing 
 * --------------------------------------------------------------------
 *This function displays structured information about one or more expressions that includes its type and value. Arrays and objects are explored recursively with values indented to show structure
 */
if( ! function_exists('copyright')){
	function copyright(){
		return "<strong>Copyright</strong> ". systema('name.full'). " © " . date('Y');
	}
}

/*
* Generate the current Date in sql formatted Datetime function
*/ 
//use Carbon\Carbon;
if(! function_exists('sqldate') ){
	function sqldate($time='now', $format=null){
		if( $format == null ){
			$format = 'Y-m-d H:i:s';
		}

		$timedate = \Carbon::parse($time);

		if( $format === '' ){
			$timedate->format($format);
		}

		return $timedate;

		//return date( $format, strtotime($time) );
	}
}

// Helpers for Laravel 4 Language translate
if( ! function_exists ('itrans') ){
	function itrans($filekey, Array $rep=null, $case="ucfirst"){
		$case = ($case == '') ? 'ucfirst' : $case;
		
		return $case( ($rep != null) ? trans($filekey, $rep) :  trans($filekey));
	}
}

if(! function_exists('format_num')){
	function format_num($num, $dec_places=2, $dec_symbol='.', $thousand_group=''){
		return number_format((float)$num, $dec_places, $dec_symbol, $thousand_group);
	}
}

if(! function_exists('systema') ){
	function systema($value){
		return config('pos.'. strtolower($value));
	}
}

if(! function_exists('currency')){
	function currency(){
		return systema('currency');
	}
}

//This would format the currency to money format
if(! function_exists('money')){
	function money($num){
		$money =  format_num( unformat_money($num), 2, '.', ',');
		return currency() . $money . 'k';
	}
}

//This would refine the currency figure to 2 decimal figure
if(! function_exists('unformat_money') ){
	function unformat_money($money=0.00){
		//tt($money);
		return format_num(extract_char($money, array('unformat_money')));
	}
}

//return Today or date - range [From: 1st Jan 2014 - To: 1 Feb 2014]
if( ! function_exists('display_date_range') ){
	function display_date_range($from, $to, $force = false, $today = 'Today'){

		$from = format_date2($from);
		$to = format_date2($to);
		$now = format_date2( sqldate() );

		if( $from === $now && $force === false ){
			return $today;
		}elseif( $to === $from){
 			return 'Sales On the: ' . $to;
		}
			
		return "Sales From: ".$from." - To: ".$to;
	}
}

//Changes array value case
if( ! function_exists('change_array_case') ){
	function change_array_case($array, $case = 'lowercase'){
		$case = strtolower($case);
		$case = ($case === 'uppercase') ? CASE_UPPER : CASE_LOWER;

		return array_flip(array_change_key_case(array_flip($array), $case));
	}
}

if( ! function_exists('clean_string') ){
	function clean_string($string)
	{
		return trim(extract_char($string, ['text', 'int']));
	}
}

//Function for setting empty barcode. If empty returned from DB
if( ! function_exists('barcodeID') ){
	function barcodeID($code, $defaultStr='******'){
		return ($code === '') ? $defaultStr : $code;
	}
}

/*
 * --------------------------------------------------------------------
 * Used to extract character type specified from a string
 * --------------------------------------------------------------------
 * Accepts three parameters.
 * First two a required. Third is optional
 * First [string]: the string of characters to extract from
 * Second [array]: Array of Extraction type
 * Third [string]: The string to replace the match
 * Forth [bool]: Wether to extract all matched or first matched 
 * E.g 
	Text: extract_char('dhfgd83ks0&9%*^', array('text'), TRUE);
 * 
 */
 
if( ! function_exists('extract_char')){
	//Please do not parse in float and INT as you'd get unexpected result
	function extract_char($string='', Array $type=null, $rep='', $single=false)
	{
		
		if( $string === ''){
			trigger_error(__FUNCTION__ . ' Requires 1 string parameter', E_USER_WARNING);
				return;
		}

		$allowedTypes = array(	'float'		=>	'([\d]+\.[\d]+)|', 
								'int'		=>	'([\d]+)|', 
								'text'		=>	'([a-zA-Z \s]+)|', 
								'symbol'	=> 	'([^\s\t0-9a-zA-Z])|',
								'symbol2'	=>	'([\_\-\@])',
								'html_tag'	=> 	'(<[^<>]+>)|',
								'unformat_money' => '([0-9\.-]+)'
							 );
		$allowedkey = $type == null ? array('text') : $type;
		
		$types = '';
		foreach( $allowedkey as $key ){
			$key = strtolower($key);
			if( isset($allowedTypes[$key]) ){
				$types .= $allowedTypes[$key];
			}else{
				trigger_error($type . ': [' . $key . '] is not allowed. text is assumed', E_USER_NOTICE);
				$types .= $allowedTypes['text'];
			}
		}
		
		if( $rep != '' ){
				$result = preg_replace("/$types/", $rep, $string);
		}else{
			if( $single == true ){
				preg_match("/$types/", $string, $match);
			}else{
				preg_match_all("/$types/", $string, $match);
			}

			$result = implode('', $match[0]);
		}

		return $result;
	
	}
}