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
 *css_inline*
 It provides a simple css inliner for your mailing.
 Warning : It doesn't support css selector priority (for example, #ids are as important as .classes. You need to declare css rules in apply order.)

	{set-block variable=$html}
		<h3>Title</h3>
		<div class="example"><p>Content</p></div>
	{/set-block}
	{$html|css_inline('stylesheets/style.css'|ezdesign(no))}

