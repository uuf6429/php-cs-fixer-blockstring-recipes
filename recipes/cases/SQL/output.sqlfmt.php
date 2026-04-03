<?php declare(strict_types=1);

echo <<<'SQL'
	select id, name, email
	from users
	where is_active = 1 and last_login > '2026-01-01'
	order by last_login desc
	;
	
	insert into orders(user_id,product_id, quantity,total_price)
	values(  1, 2 ,  5 ,  99.95),(2,3,1,19.99) , (3,1,2,39.98);
	
	UPDATE products set stock= stock -1 where id=2;
	
	delete from sessions
	where created_at < '2026-01-01'
	;
	
	-- messy join  
	select u.id, u.name, o.id, o.total_price
	from users u
	inner join orders o on u.id = o.user_id
	where o.total_price > 50
	order by o.total_price desc
	;
	SQL;
