<?php

/**
 *
 *	Função que printa os conteúdos de uma variável
 *
 *	@param	mixed	$data	A variável a ser debugada na tela
 *	@param	bool	$die	Se === true mata o programa após debuggar
 *
 *	@return	void
 *
 **/
if (! function_exists('hc_debug')) 
{

	function hc_debug (		$data	=	array()
						,	$die 	= 	false	
						,	$plain	=	false
					   )
	{
		
		if (! is_array($data)) {
			$data=	array($data);
		}
	
		$tag	=	(($plain === true) ? ('textarea') : ('pre'));
		
		$style	=	array(
		
				'pre'		=>	'text-align: left;'
				
			,	'textarea'	=>	'width:	100%; min-height: 666px;'
		
		);
		
		echo('<' . $tag . ' style="' . $style[$tag] . '"><hr />');
		
		print_r($data);
		
		if ($die === true) {
			die('<hr /></'. $tag .'>');
		} else {
			echo('<hr /></'	. $tag . '>');
		}
	
	}

}
