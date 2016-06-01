<?php

	error_reporting(E_ALL);
	
	
	
	/*	Silent Requires	*/
	$debugFunction			=	@require_once('../commons/HC_debug.inc.php');
	$validationFunctions	=	@require_once('../commons/HC_validation.inc.php');
	$domHelper				=	@require_once('../commons/HC_DOMHelper.inc.php');
	
	
	
	/*	Checking if the requires went well	*/
	//	TO-DO:	Create an ermac (Macro for errors)
	if (! is_callable('hc_debug')) {
		hc_debug('ERROR => NO_DEBUG_FUNCTION', true);
	}
	if (! is_callable('hc_validation')) {
	
		hc_debug('ERROR => NO_VALIDATION_FUNCTIONS', true);
	}
	
	if (! is_callable('hc_DOMHelper')) {
		hc_debug('ERROR => NO_DOM_HELPER', true);
	}
	
	
	
	/*	Loading the configuration file	*/
	$CONFIG	=	@require_once('../conf/config.inc.php');
	
	/*	And checking the configuration file	*/
	if (! hc_validArray($CONFIG)) {
		hc_debug('ERROR => NO_CONFIG', true);
	}
	
	
	
	/**
	 *
	 *	Loading the raw data souce
	 *
	 **/
	 
	/*	Being paranoid	*/
	if (! hc_validArray(	$CONFIG['RAW_DATA']
						,	array(
								'SOURCE'
							,	'SETS_ELEMENT_ID'
							,	'SET_ELEMENTS_CLASS'
							)
						)) {
												
		hc_debug('ERROR => MALFORMED_CONFIG: RAW_DATA', true);
		
	}
	
	if (! hc_validURL($CONFIG['RAW_DATA']['SOURCE'])) {
		hc_debug('ERROR => MALFORMED_CONFIG: RAW_DATA->SOURCE', true);
	}
		
		
		
		
		
	/*	Creating the file handler	*/	
	$rawDataFile	=	@fopen($CONFIG['RAW_DATA']['SOURCE'], 'r');
	
	/*	Let's see if its right	*/
	if (	(! $rawDataFile)
		||	(empty($rawDataFile))
		||	(! is_resource($rawDataFile))) {
			
		@fclose($rawDataFile);
		hc_debug('ERROR => READ_RAW_DATA', true);
			
	}
	
	@fclose($rawDataFile);

	
	
	
	/*	Creating a context to read http file	*/
	$context = stream_context_create(array( 
		'http'	=>	array( 
			'timeout' => 1 
			) 
		) 
	); 
	

	/*	Reading the file itself	*/
	$rawData	=	@file_get_contents(	$CONFIG['RAW_DATA']['SOURCE'], 
										FILE_TEXT, 
										$context); 
	
	if (! hc_validString($rawData)) {
		hc_debug('ERROR => READ_RAW_DATA', true);
	}
	
	
	
	/*	Begin to deal with the data	*/
	$data	=	new DOMDocument;
	@$data->loadHTML($rawData);

	
	/*	Do we have the SETS collection element?	*/
	$setsBar 	= 	$data->getElementById($CONFIG['RAW_DATA']['SETS_ELEMENT_ID']);
	$setsPath	=	$setsBar->getNodePath();
	
	if ((! $setsBar) || ($setsBar->tagName != 'div') || (! $setsPath)) {
		hc_debug('ERROR => SETS_ELEMENT', true);
	}
	
	/*	And the sets	*/
	$setElements = hc_DOMgetElementsByClass(	$data 
											,	'div'
											,	$CONFIG['RAW_DATA']['SET_ELEMENTS_CLASS']
											,	$setsPath);

	
	
	/*	Data itself	*/
	hc_debug($setElements);
	
	
	
	
	
	hc_debug('SUCCESS', true);
	
	

?>
