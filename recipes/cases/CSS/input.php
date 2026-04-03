<?php declare(strict_types=1);

echo <<<'CSS'
	body{margin:0;padding:0;background:#f5f5f5}
	.container { display:flex;flex-direction:column; align-items:center}
	h1{color:red;font-size:24px }
	button{background:blue;color:white;border:none;padding:10px  20px}
	button:hover{background : darkblue}
	.item{margin-top:10px}
	.item.active{color:green;font-weight:bold }
	CSS;
