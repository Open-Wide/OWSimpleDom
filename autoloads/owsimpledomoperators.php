<?php

class owSimpleDomOperators
{
    /*!
     Constructor
    */
    function owSimpleDomOperators()
    {
        $this->Operators = array( 
									'css_inline'
        );
    }

    /*!
     Returns the operators in this class.
    */
    function &operatorList()
    {
        return $this->Operators;
    }

    /*!
     \return true to tell the template engine that the parameter list
    exists per operator type, this is needed for operator classes
    that have multiple operators.
    */
    function namedParameterPerOperator()
    {
        return true;
    }

    /*!
     Both operators have one parameter.
     See eZTemplateOperator::namedParameterList()
    */
    function namedParameterList()
    {

		return array( 																  
						'css_inline' => array( 'css_file' => array( 'type' => 'string',
                                                                  'required' => true,
                                                                  'default' => '' ) 
						
				  );
    }

    /*!
     \Executes the needed operator(s).
     \Checks operator names, and calls the appropriate functions.
    */
    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace,
                     &$currentNamespace, &$operatorValue, &$namedParameters )
    {
        switch ( $operatorName )
        {
            
			case 'css_inline':
				$owCssInline = new owCssInline();
				$operatorValue = $owCssInline->css_inline( $operatorValue, $namedParameters['css_inline'] );
			break;
			
			
    	}
    }


    /// \privatesection
    var $Operators;
}

?>