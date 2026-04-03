<?php declare(strict_types=1);

echo <<<'GQL'
	query GetUsers($limit: Int, $active: Boolean) {
	  users(limit: $limit, active: $active) {
	    id
	    name
	    email
	    posts {
	      id
	      title
	      comments {
	        id
	        content
	      }
	    }
	  }
	}
	
	mutation AddUser($name: String!, $email: String!) {
	  createUser(name: $name, email: $email) {
	    id
	    name
	    email
	  }
	}
	GQL;
