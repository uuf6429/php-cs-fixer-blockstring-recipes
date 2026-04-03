<?php declare(strict_types=1);

echo <<<'JSON'
	{
	    "user": {
	        "id": 1,
	        "name": "Alice",
	        "roles": [
	            "admin",
	            "editor",
	            "user"
	        ],
	        "active": true,
	        "profile": {
	            "email": "alice@example.com",
	            "address": {
	                "street": "123 Main St",
	                "city": "Somewhere",
	                "zip": 12345
	            },
	            "phones": [
	                "123-456-7890",
	                "987-654-3210"
	            ]
	        }
	    },
	    "logs": [
	        {
	            "event": "login",
	            "success": true
	        },
	        {
	            "event": "update_profile",
	            "success": false
	        }
	    ]
	}
	JSON;
