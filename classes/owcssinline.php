<?php 

//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: OWSimpleDom
// SOFTWARE RELEASE: 1.0
// POWERED BY: OpenWide http://www.openwide.fr/
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//  This program is free software; you can redistribute it and/or
//  modify it under the terms of version 2.0  of the GNU General
//  Public License as published by the Free Software Foundation.
//
//  This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.
//
//  You should have received a copy of version 2.0 of the GNU General
//  Public License along with this program; if not, write to the Free
//  Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//  MA 02110-1301, USA.
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//


class owCssInline {

	public function css_inline( $content, $dir_css ) {
		
		$owSimpleDom = new owSimpleDom();
		
		if ( is_file($dir_css) && is_readable($dir_css) ) {
			
			$html = str_get_html($content);
			$css = file_get_contents($dir_css);
			
			$css = str_replace(array("\r\n",CHR(13),CHR(10),CHR(9))," ",$css);  // Remove tabs and end of lines
			$css = preg_replace("#/\*(([^\*]|\*[^/])+)\*/#", " ", $css);   // Remove comments
			
			$liste = explode('}',$css);
			
			// Parse each css selector block
			foreach( $liste as $block ) {
	
				if ( trim($block) ) {
					
					$descr = explode('{',$block);
	
					if ( count($descr > 1) ) {
						
						// Get css selector and css rules from block
						list( $selector, $args ) = $descr;
						
						$args = trim($args);
						
						if ( $selector!='' && $args!='' && $selector!='\0' && $args!='\0' ) {
							
							// Get matched elements from DOM
							$matches = $html->find($selector);
							
							// Get each DOM node matching by selector
							foreach ( $matches as $match ) {
								
								$old_style = $match->style;
								
								// If there are old styles in html, override old rules with new rules
								if ($old_style) {

									$old_rules_array = array();
									$new_rules_array = array();
									
									$old_styles_array = explode(';', $old_style);
									$new_styles_array = explode(';', $args);
									
									// Store each old css rule from html
									foreach( $old_styles_array as $old_rule ) {
										$old = explode(':', $old_rule);
										if( count($old) > 1) {
											$old_rules_array[trim($old[0])] = trim($old[1]);
										}
									}
									
									// Store each new css rule from css file
									foreach( $new_styles_array as $new_rule ) {
										$new = explode(':', $new_rule);
										if( count($new) > 1) {
											$new_rules_array[trim($new[0])] = trim($new[1]);
										}
									}
									
									// Override old rules by new rules
									foreach( $old_rules_array as $property => $value ) {
										if (! array_key_exists($property, $new_rules_array) ) {
											$new_rules_array[$property] = $value;
										}
									}
									
									// Build new style value to write in dom
									$new_args = '';
									foreach( $new_rules_array as $property => $value ) {
										$new_args .= "$property: $value; ";
									}
									
									$match->style = trim($new_args);
									
								} else {
									// If no old styles in html, directly write css rules
									$match->style = trim($args);
								}
							}
							
						}
					}
	
				}
			}
			
			return $html;
			
		}
		
		$this->error( $dir_css . " is not readable" );
		
		return $content;
	}
	
	protected function error ( $msg ) {
		
		if ($msg) {
			eZDebug::writeError( "[OWSimpleDom] : " . $msg );
		}
		
	}
}

?>