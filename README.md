OWSimpleDom
===========

Provides a simple dom access library for eZPublish (simplehtmldom) and bonus features !

Usage
-----------------------------
 1. You need to declare a new owSimpleDom object
 2. You can use SimpleHTMLDom functions

Example
-----------------------------

	$owSimpleDom = new owSimpleDom();
	$html_dom = str_get_html( $html );
 

About SimpleHTMLDom
-----------------------------
Online documentation of SimpleHTMLDom :  http://simplehtmldom.sourceforge.net/manual.htm

Bonus operators
-----------------------------
 * css_inline : provides a simple css inliner for your mailing.
 Warning : It doesn't support css selector priority (for example, #ids are as important as .classes. You need declare css rules in apply order.)
