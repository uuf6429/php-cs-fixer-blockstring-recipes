<?php declare(strict_types=1);

echo <<<'SCSS'
	$primary :blue;$padding:10px
	
	.container{ display:flex;
	.item{color:$primary;
	&.active{ font-weight:bold}
	button{padding:$padding;background:$primary;
	&:hover{background:darken($primary,10%)} } } }
	
	h1 { color : red}
	SCSS;
