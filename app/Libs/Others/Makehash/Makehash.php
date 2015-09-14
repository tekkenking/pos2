<?php namespace App\Libs\Others\Makehash;

class Makehash{
	/**
	* This will hold a unique Salt for the hash generator
	*/
	public static $unique_salt = 'uh09e98yu08NJHYt78A89GHt6B87t76p';

    //Encrypts a string
    public function encrypt($text) {
        $data = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, static::$unique_salt, $text, MCRYPT_MODE_ECB, 'keee');
        return base64_encode($data);
    }

    //Decrypts a string
    public function decrypt($data) {
        $text = base64_decode($data);
        $vl = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, static::$unique_salt, $text, MCRYPT_MODE_ECB, 'keee');
		return extract_char($vl, ['text', 'int', 'symbol']);
    }

	/**
	* @ This is a method for Unique and Secure Hash generator.
	* @  HOW TO USE:
		Call the method: Makehash::random().
		NOTE: Calling this method without parameters will return [letters and numbers. LENGHT=50]
	* @ PARAMETERS = 'letter', 'number', 'symbol', 'symletnum', 'all', 'default' and any lenght(number).
		NOTE: 
			-if no lenght is given 50 will be assumed.
			- You can give one parameters. e.g ::generateHash('letters');
				- This will return only letters with lenght=50.
			- If you give only numbers e.g ::random('90') OR ::generateHash(90);
				- This will return a mix of letters and numbers with lenght=90;
			- If you give all parameters. 'all' will overshadow other parameters except the lenght.
			e.g Makehash::random('letters', 'numbers', 'symbols', 'all', 'default', 80);
				- This will return a mix of letters, numbers and symbols with lenght=80.
	* @ return string;
	*
	**/
	public static function random() {
	$args = func_get_args();
	$params = array();
	$hashlenght = array('num'=>50);
		foreach($args as $k=>$key){
			if(is_int($key) OR is_numeric($key)){
				$hashlenght['num'] = (int)intval($key);
				unset($args[$k]);
			}else{
				$params[strtolower($key)] = true;
			}
		}
	
		$allowedArrays = array('letters', 'numbers', 'symbols','symletnums', 'all', 'default');
		
		// This is to check if nothing is parsed in. And if not letters and numbers are used.
		if($params == null){
			$params['default'] = true;
		}
		
		// This is to check if 'all' is amongst the keys parsed in. And if yes, it will overwrite other parameters
		if(array_key_exists('all', $params)){
				unset($params);
				$params['all'] = true;
			}
		
		//This is to check the types of keys parsed, if they are allowed.
		//svar_dump($params);
		
			foreach($params as $xkey=>$xvals){
				if(!in_array($xkey, $allowedArrays)){
					trigger_error($xkey . ' is not allowed', E_USER_WARNING);
					exit; 
				}
			}
			
		$letters = range('a', 'z');
		$LETTERS = range('A', 'Z');
		$numbers = range('0', '9');
		
		$letters = array_merge($letters, $LETTERS);
		$symbols = array('@','*','#','?','=','%','_','-');
		$symletnums = array('_','p','g','-','1','2','4','0');
		
		$randomarrays = array();
		foreach(array_keys($params) as $val){
			if($val == 'all'){
				$randomarrays[] = array_merge($letters, $numbers, $symbols);
				}elseif($val == 'default'){
				$randomarrays[] = array_merge($letters, $numbers);
				}else{

				$randomarrays[] = $$val;
			}
		}
		
		$randomVariables = (count($randomarrays) == 1) ? array_shift($randomarrays) : call_user_func_array('array_merge',$randomarrays);
		
		// Lets start the Algorithm
		$hash = array();
		for($i=0; $i<($hashlenght['num']); $i++){
				mt_srand(time()%2938 * 1000000 + (double)microtime() * 1000000);
				$hash[] = $randomVariables[ mt_rand(0, (count($randomVariables)-1)) ];
		}
		
		//This will add to uniqueness layer for the generated hash
		$md5_time = md5(time() . static::$unique_salt);
		
		$extractType = array(
			'numbers' => 'int',
			'letters' => 'text',
			'symbols' => 'symbol'
		);
		
		$extractorArray = array();
		foreach(array_keys($params) as $val){
			if( isset($extractType[$val]) ){
				$extractorArray[] = $extractType[$val];
			}
		}
		
		$md5_timeArray = str_split( !empty($extractorArray) ? extract_char($md5_time . '*@#%=', $extractorArray) : $md5_time);

		$hash = array_merge($hash, $md5_timeArray);
		shuffle($hash); //Shuffles the hash for security reasons
		$hash = array_reverse($hash); //Reverse the hash for security reasons
		
		$hash = implode('', array_slice($hash, 0, $hashlenght['num']));
		
		return $hash;
	}
}

/*// a new proCrypt instance
$crypt = new Crypt;

// encrypt the string
$encoded = $crypt->encrypt('This is the message to be encoded');

// decrypt the string
$decoded = $crypt->decrypt($encoded);

echo "Encrypted string : " . trim($encoded) . "<br />\n";
echo "Decrypted string : " . trim($decoded) . "<br />\n";*/


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
		if( $string == ''){
			trigger_error(__FUNCTION__ . ' Requires 1 string parameter', E_USER_WARNING);
				return;
		}

		$allowedTypes = array(	'float'		=>	'([\d]+\.[\d]+)|', 
								'int'		=>	'([\d]+)|', 
								'text'		=>	'([a-zA-Z \s \.]+)|', 
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