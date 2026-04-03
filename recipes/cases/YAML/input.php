<?php declare(strict_types=1);

echo <<<'YAML'
	name: Example
	version : "1.0"
	items:
	  - id: 1
	    name: Item One
	  - id : 2
	    name:  Item Two
	settings: {enabled:true ,threshold:10}
	
	users:
	  - name: Alice
	    roles: [admin,user]
	  -  name: Bob
	     roles: [ user ]
	
	nested:
	 level1:
	    level2:    value
	YAML;
