<?php declare(strict_types=1);

echo <<<'SQL'
	SELECT id,
	       name,
	       email
	FROM users
	WHERE is_active = 1
	  AND last_login > '2026-01-01'
	ORDER BY last_login DESC;
	
	
	INSERT INTO orders(user_id, product_id, quantity, total_price)
	VALUES(1, 2, 5, 99.95),
	      (2,3,1,19.99) ,
	      (3,1,2,39.98);
	
	
	UPDATE products
	SET stock = stock -1
	WHERE id = 2;
	
	
	DELETE
	FROM sessions
	WHERE created_at < '2026-01-01';
	
	-- messy join
	
	SELECT u.id,
	       u.name,
	       o.id,
	       o.total_price
	FROM users u
	INNER JOIN orders o ON u.id = o.user_id
	WHERE o.total_price > 50
	ORDER BY o.total_price DESC;
	SQL;
