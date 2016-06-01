<?php

error_reporting(E_ALL);

/**
 *
 *	Dummy function of the validators, if it's a callable 
 *	( is_callable('hc_validation') ) maybe the library was loaded correctly
 *
 **/
if (! function_exists('hc_validation'))
{
	
	function	hc_validation	()
	{
		// DUMMY !!!
	}
	
}	



/**
 *
 *	Verify if it's an valid array
 *
 *	@param	mixed	$data	O provável array a ser verificado
 *
 *	@return	bool	É ou não um array válido
 *
 **/
if (! function_exists('hc_validArray')) 
{

	function	hc_validArray	(		$data 			=	array()
									,	$fieldsNeeded	=	array())
	{
		
		// Basic Failure
		if ((! isset($data))
		||	(! $data) 
		|| 	(empty($data)) 
		|| 	(! is_array($data)) 
		|| 	(count($data)	== 	0)) {
			
			return (false);
			
		}
		
		if (! is_array($fieldsNeeded)) {
			$fieldsNeeded	=	array($fieldsNeeded);
		}
		
		foreach ($fieldsNeeded	as	$i	=>	$field) {
			
			if (! hc_validString($field)) {
				continue;
			}
			
			if (! isset($data[$field])) {
				return (false);
			}
			
		}
		
		return (true);
	
	}

}





/**
 *
 *	Verify if it's an valid string
 *
 *	@param	mixed	$data	A provável string a ser verificada
 *
 *	@return	bool	É ou não uma string válida
 *
 **/
if (! function_exists('hc_validString')) 
{

	function	hc_validString	($data	=	'')
	{
		
		$data		=	@trim($data);
		
		// Spurious cases
		$redAlert	=	(	($data	===	'0')
						||	($data	===	'false')
						||	($data	===	'null'));
		
		// Basic Failure
		if ((! isset($data))
		||	((! $data) && (! $redAlert))
		||	((empty($data)) && (! $redAlert))
		||	(! is_string($data))
		||	(strlen($data)	==	0)) {
			
			return (false);
			
		}
		
		return (true);
	
	}

}





/**
 *
 *	Verify if it's an valid URL
 *
 *	@param	mixed	$data	A provável URL a ser verificada
 *
 *	@return	bool	É ou não uma URL válida
 *
 **/
if (! function_exists('hc_validURL')) 
{

	function	hc_validURL	($data	=	'')
	{
		
		// Basic Failure
		if (! hc_validString($data)) {
			return (false);
		}

		return (filter_var($data, FILTER_VALIDATE_URL));
	
	}

}
