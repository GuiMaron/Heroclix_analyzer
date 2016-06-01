<?php

error_reporting(E_ALL);



/**
 *
 *	Dummy function of the DOMHelper, if it's a callable 
 *	( is_callable('hc_DOMHelper') ) maybe the library was loaded correctly
 *
 **/
if (! function_exists('hc_DOMHelper'))
{
	
	function	hc_DOMHelper	()
	{
		// DUMMY !!!
	}
	
}	



if (! function_exists('hc_DOMgetElementByAttrValue'))
{

	function	hc_DOMgetElementsByAttrValue	(	$dom
												,	$tagName 
												,	$attrName
												,	$attrValue
												,	$path	=	'//'
												) 
	{
	
		$html 		= 	'';
		$domxpath	= 	new DOMXPath($dom);
		$newDom		= 	new DOMDocument;
		
		$newDom->formatOutput	=	true;

		$filtered = $domxpath->query("{$path}//{$tagName}[@{$attrName}='{$attrValue}']");
		// $filtered =  $domxpath->query('//div[@class="className"]');
		// '//' when you don't know 'absolute' path

		// 	since above returns DomNodeList Object
		// 	I use following routine to convert it to string(html); copied it from
		//	someone's post in this site. Thank you.
		
		$i = 0;
		
		while ( $myItem = $filtered->item($i) ) {
			$node = $newDom->importNode( $myItem, true );	// import node
			$newDom->appendChild($node);                    // append node
			$i++;
		}
		
		$html = $newDom->saveHTML();
		
		return ($html);
		
	}

}



if (! function_exists('hc_DOMgetElementsByClass'))
{

	function	hc_DOMgetElementsByClass	(	$dom
											,	$tagName
											, 	$className
											,	$path	=	'//'
											) 
	{
	
		return(hc_DOMgetElementsByAttrValue(	$dom
											,	$tagName
											,	'class'
											,	$className
											,	$path));
		
	}

}

