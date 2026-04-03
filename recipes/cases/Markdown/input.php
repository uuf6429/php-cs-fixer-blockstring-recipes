<?php declare(strict_types=1);

echo <<<'MD'
	#   Messy Markdown
	
	Some text with  **bold**and *italic * mixed badly.
	
	- item 1
	 - item 2
	-    item 3
	
	1. first
	2.second
	   3.   third
	
	> quote
	>> nested quote
	
	`inline code`and more text   with weird spacing
	|col1| col2 |
	|---|---|
	|a|b|
	| c |  d|
	MD;
