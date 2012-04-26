<?php

// Operator autoloading

$eZTemplateOperatorArray = array();

$eZTemplateOperatorArray[] =
  array( 'script' => 'extension/owsimpledom/autoloads/owsimpledomoperators.php',
         'class' => 'owSimpleDomOperators',
         'operator_names' => array( 
									'css_inline'
									),
		 );

?>