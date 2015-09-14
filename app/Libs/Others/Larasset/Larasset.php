<?php namespace App\Libs\Others\Larasset;

// LAST EDIT DATE 4TH JULY 2015

Class Larasset{

	// Larasset::start()->storeCss($assets);
	// Larasset::start('header')->css('twitter-bootstrap')


	/* CALLING IN THE VIEW  */
	// Larasset::start('header')->show(scripts);
	// Larasset::start('footer')->show(styles);
	// Larasset::start('footer')->show('scripts');
	// Larasset::start('header')->show(styles);

	/* FILTERS METHOD*/
	/*
	* There are two types of Filters method
	* except() and only()
	* 
	* Except() will add all assets of scripts or styles except the listed
	* How to use: Larasset::start('header')->except('bootstrap', 'ace')->show(styles);
	*
	* Only() will add only the selected assets of script or styles
	* How to use: Larasset::start('footer')->only('jquery', 'jquery-ui')->show(scripts);
	*/
	
	/*
	* Used Directly
	* $css = array('name1'=>'dir/to/the/style1.css', 'name2'=>'dir/to/the/style2.css');
	* $js = array('name1'=>'dir/to/the/style1.js', 'name2'=>'dir/to/the/style2.js');
	* Larasset::start('header')->storeCss($css)->css('name1', 'name2');
	* Larasset::start('footer')->storeJs($js)->js('name1', 'name2');
	*
	*/
	
	/**
	* Last Or First Order set
	*	Larasset::start()->firstJsOrder('namex');
	*	Larasset::start()->lastJsOrder('namez');
	*	Larasset::start()->lastCssOrder('namez');
	*	Larasset::start()->lastCssOrder('namez');
	*
	* NOTE.. 
	* The "namex" or "namez" must be set already in "Larasset::start('header')->css('namei', 'namev', 'name1')"
	*/
	
	/**
	* Removing assets at run time
	* Larasset::start()->removeJs = array('amazon-styled-dropdown-style') // This would remove the Js file in Larasset Js Keys
	* Larasset::start()->removeCss = array('amazon-styled-dropdown-style') // This would remove the Css file in Larasset Css Keys
	*
	* NOTE.. This must be set before the css() or js() is called.
	*
	* Larasset::start('header')->css('genius-style');
	* Larasset::start('footer')->js('genius-style');
	*/

	public $vendor_dir = '';
	private $inlineScripts = [];
	public static $assetStoreCss = [];
	public static $assetStoreJs = [];
	private $place;
	private $onlyAssets = NULL;
	private $exceptAssets = NULL;

	public $styles = [];
	public $scripts = [];
	public $removeJs = [];
	public $removeCss = [];
	
	private $lastCssOrder = [];
	private $firstCssOrder = [];
	private $lastJsOrder = [];
	private $firstJsOrder = [];

	private static $ini = false;

	public static function start($place=''){
		self::$ini = (self::$ini === false ) ? new self : self::$ini;
		self::$ini->place = $place;
		return self::$ini;
	}

	public function assetsUrl( $file )
	{
		return asset( $this->vendor_dir . $file );
	}
	
	//This would input and set the inline JS
	public function set_inlinescript($script=''){
		$this->inlineScripts[] = $script;
	}
	
	//This would output the inline JS at the bottom of the page
	public function get_inlinescript(){
		if( !empty($this->inlineScripts) ){
			return implode(' ', $this->inlineScripts);
		}
		
		//We have to reset it to free memory
		$this->inlineScripts = [];
	}

	public function __call($method, $args){
		$method = strtolower($method);

		if( $method == 'storecss' || $method == 'storestyle' ){
		
			$this->_cssBank($args[0]);
		}

		if( $method == 'css' || $method == 'style' ){
			$this->_cssInternal($args);
		}

		if( $method == 'externalcss' || $method == 'externalstyle' ){
			$this->_cssExternal($args);
		}


		if( $method == 'storejs' || $method == 'storescript' ){
			$this->_jsBank($args[0]);
		}		

		if( $method == 'storeexternaljs' || $method == 'storeexternalscript' ){
			$this->_externaljsBank($args[0]);
		}

		if( $method == 'js' || $method == 'script' ){
			$this->_jsInternal($args);
		}

		if( $method == 'externaljs' || $method == 'externalscript' ){
			$this->_jsExternal($args);
		}
			return $this; // Return the Instantiation of this class for chainability
	}

	private function _assetsDir($assetsArray)
	{

		$assets = [];

		//Lets check for directory wahala
		foreach ($assetsArray as $dir => $assetFiles) {
			//if(  )
				//$directory = str_replace(',', '/', $dir) . '/';

				foreach ($assetFiles as $key => $file) {
					//$assets[$key] = $directory . $file;
					$assets[$key] = $dir . '/' . $file;
				}
		}

			return $assets;
	}

	private function _cssBank(Array $assetsArray){
		//self::$assetStoreCss = Cache::rememberForever('cssAssets', function() use($assetsArray){
		//	return array_merge(self::$assetStoreCss, $assetsArray);
		//});

		self::$assetStoreCss = array_merge(self::$assetStoreCss, $this->_assetsDir($assetsArray));

		//dd(self::$assetStoreCss );
	}

	private function _jsBank(Array $assetsArrayx){
		//self::$assetStoreJs = Cache::rememberForever('jsAssets', function() use($assetsArrayx){
		//	return array_merge(self::$assetStoreJs, $assetsArrayx);
		//});
		self::$assetStoreJs = array_merge(self::$assetStoreJs, $this->_assetsDir($assetsArrayx));
	}

	private function _externaljsBank(Array $assetsArrayx){
		self::$assetStoreJs = array_merge(self::$assetStoreJs, $assetsArrayx);
	}

	public function only(){
		$this->onlyAssets = func_get_args();
		return $this;
	}

	public function except(){
		$this->exceptAssets = func_get_args();
		return $this;
	}

	private function resetException(){
		$this->onlyAssets = NULL;
		$this->exceptAssets = NULL;
		$this->lastCssOrder = [];
		$this->lastJsOrder = [];
		$this->firstCssOrder = [];
		$this->firstJsOrder = [];
	}
	
	public function flushAllCache(){
		Cache::flush('jsAssets');
		Cache::flush('cssAssets');
		Cache::flush('showStyle');
		Cache::flush('showScript');
	}

	public function show($type){
		$this->onlyAssets = ($this->onlyAssets != NULL) ? array_flip($this->onlyAssets) : NULL;
		$this->exceptAssets = ($this->exceptAssets != NULL) ? array_flip($this->exceptAssets) : NULL;


		if( $type == 'styles' ){
			//return Cache::rememberForever('showStyle', function(){
				$styles = '';
				if( isset($this->styles[$this->place]) ){
					$arrayCssOrder = ['first' => $this->firstCssOrder, 'last' => $this->lastCssOrder];
					//Merging all the Asset arrays into one
					$allCssArrayToOne = call_user_func_array('array_merge', $this->styles[$this->place]);
					
						//We remove all removeJs property array value
						if( !empty($this->removeCss)  ){
							$allCssArrayToOne = $this->removeAssets( $allCssArrayToOne, $this->removeCss );
						}

					$results = $this->_loopOnlyOrExcept($allCssArrayToOne, $arrayCssOrder );
					//$this->resetException();
					return $results;
				}
			//});
		}

		if( $type == 'scripts' ){
			//return Cache::rememberForever('showScript', function(){
				$scripts = '';

				if( isset($this->scripts[$this->place]) ){
					$arrayJsOrder = ['first' => $this->firstJsOrder, 'last' => $this->lastJsOrder];

					//Merging all the Asset arrays into one
					$allJsArrayToOne = call_user_func_array('array_merge', $this->scripts[$this->place]);
					
						//We remove all removeJs propert array value
						if( !empty($this->removeJs)  ){
							$allJsArrayToOne = $this->removeAssets( $allJsArrayToOne, $this->removeJs );
						}

					
					$results = $this->_loopOnlyOrExcept($allJsArrayToOne , $arrayJsOrder );
					//$this->resetException();
					return $results;
				}
			//});
		}
	}
	
	private function removeAssets($AssetArray, $removeArray){
		foreach( $removeArray as $asset ){
			if( isset($AssetArray[$asset]) ){
				unset($AssetArray[$asset]);
			}
		}
		
		return $AssetArray;
	}
	
	private function _loopOnlyOrExcept($array, $arrayOrder=NULL ){
		$type = '';
		$firstOrders = '';
		$lastOrders = '';
		$saveLastArray = NULL;
		$saveFirstArray = NULL;
		
		//foreach( $array as $sets ){
			foreach($array as $key => $set ){
				
				if( $this->onlyAssets != NULL &&   $this->exceptAssets == NULL){
					//We work with only();
					if( isset($this->onlyAssets[$key]) ){
						$type .=$set;
					}
				}elseif($this->onlyAssets == NULL &&   $this->exceptAssets != NULL){
					//We work with except();
					if( !isset($this->exceptAssets[$key]) ){
						$type .=$set;
					}
				}else{
					if( $arrayOrder !== NULL && !empty($arrayOrder['first']) && in_array($key, $arrayOrder['first']) ){
						$saveFirstArray[$key] = $set;
					}elseif( $arrayOrder !== NULL && !empty($arrayOrder['last']) && in_array($key, $arrayOrder['last']) ){
						$saveLastArray[$key] = $set;
					}else{
						$type .=$set;
					}
				}

			}
		//}

		//Lets arrange the last Order sets
		if( $saveLastArray !== NULL ){
			foreach( $arrayOrder['last'] as $k ){
				if( !isset($saveLastArray[$k]) ){
					dd($k . ' is not set', true);
				}else{
					$lastOrders .= $saveLastArray[$k];
				}
			}
		}
		
		//Lets arrange the First order sets
		if( $saveFirstArray !== NULL ){
			foreach( $arrayOrder['first'] as $k ){
				if( !isset($saveFirstArray[$k]) ){
					dd($k . ' is not set', true);
				}else{
					$firstOrders .= $saveFirstArray[$k];
				}
			}
		}
		
		return $firstOrders . $type . $lastOrders;
	}
	
	private function _cssInternal($fileArray){
		//If empty. Return ''
		if( empty($fileArray)){ return '';	}
		$this->_central($fileArray, 'css', 'style', 'styles');
	}

	private function _jsInternal($fileArray){
		//If empty. Return ''
		if( empty($fileArray)){ return '';	}
		$this->_central($fileArray, 'js', 'script', 'scripts');
	}

	private function _cssExternal($fileArray){
		if( empty($fileArray)){ return '';	}
		$this->_central($fileArray, 'css', 'external', 'styles');
	}

	private function _jsExternal($fileArray){
		if( empty($fileArray)){ return '';	}
		$this->_central($fileArray, 'js', 'external', 'scripts');
	}

	private function _central( $fileArray, $type, $network, $assetType ){
		$r = $this->processAssets($fileArray, $type, $network);
		
		$place = $this->place;

		if( $assetType == 'scripts' ){
				$this->scripts[$place][] = $r;
		}elseif( $assetType == 'styles' ){
				$this->styles[$place][] = $r;
		}
	}

	private function processAssets($filesArray, $type, $scr){
		$urlLink = ( $type == 'css' ) ? self::$assetStoreCss : self::$assetStoreJs;

		//dd($urlLink, true, 'In process');
		
		if( empty($urlLink) || !is_array($urlLink) ){
			dd('Nothing in ' . $scr . ' shop!');
			return false;
		}

		$files = array();

		//dd($urlLink, true);
		
		foreach($filesArray as $xs){
			$d = $xs;
		//	dd($d, true);
			if(isset($urlLink[$d])){
				if( $scr == 'external' ){
					//dd('same here');
					if( $type == 'css' ){
						$files[$d]= '<link href="' . $urlLink[$d] . '" rel="stylesheet" type="text/css" media="all">';
					}elseif( $type == 'js' ){
						if( strpos($urlLink[$d], '<script') !== FALSE ){
							$files[$d] = $urlLink[$d];
						}else{
							$files[$d]= '<script src="' . $urlLink[$d] . '"></script>';
						}
					}
				}else{
					if( !is_array($urlLink[$d]) ){
						$assetMethod = '_'.$scr;
						//$files[$d]= HTML::$scr( $this->vendor_dir . $urlLink[$d] );
						$files[$d]= $this->$assetMethod( $urlLink[$d] );
						//unset($urlLink[$d]);
					}else{
						$url =  $urlLink[$d]['url'];
						$attributes =  $urlLink[$d]['attr'];
						$assetMethod = '_'.$scr;
						//$files[$d]= HTML::$scr( $this->vendor_dir . $url, $attributes );
						$files[$d]= $this->$assetMethod( $url, $attributes );
						//unset($urlLink[$d]);
					}
				}
			}
		}
		
		return $files;
	}

	private function _style($file, $attributes='')
	{
		return "<link href='". $this->assetsUrl($file) ."' rel='stylesheet' type='text/css' media='all' {$attributes}>";
	}

	private function _script($file, $attributes='')
	{
		return "<script src='". $this->assetsUrl($file) ."' {$attributes}></script>";
	}
	
	public function lastCssOrder(){
		$lastOrder = func_get_args();
		$this->lastCssOrder = array_merge($this->lastCssOrder, $lastOrder);
	}
	
	public function firstCssOrder(){
		$lastOrder = func_get_args();
		$this->firstCssOrder = array_merge($this->firstCssOrder, $lastOrder);
	}
	
	public function lastJsOrder(){
		$lastOrder = func_get_args();
		$this->lastJsOrder = array_merge($this->lastJsOrder, $lastOrder);
	}
	
	public function firstJsOrder(){
		$orders = func_get_args();
		$this->firstJsOrder = array_merge($this->firstJsOrder, $orders);
	}
}