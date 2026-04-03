<?php declare(strict_types=1);

echo <<<'XML'
	<?xml version="1.0"?><catalog><book id="bk101"
	   genre="Fantasy"><author>Garcia, Debra</author><title> The   Lost   Realm </title>
	<price currency="USD">  19.99</price><publish_date>2023-07-01</publish_date>
	<description> An epic tale of magic, dragons,and destiny. </description></book>
	<book id="bk102" genre="SciFi"   ><author>  Smith, John</author>
	<title>Stars Beyond</title><price currency="EUR">15.5</price>
	<publish_date>2022-11-15</publish_date>
	<description>A journey through space and   time.</description></book><book id="bk103"
	genre="Horror"><author>King,   Anne</author><title>Night Terrors</title>
	<price currency="GBP">12.00</price><publish_date>2021-10-31</publish_date>
	<description>  Fear lurks in every shadow. </description></book>
	<metadata   created="2024-01-01"   updated ="2024-06-01">
	<tags><tag>books</tag><tag>fiction</tag>
	<tag>   mixed-format </tag></tags></metadata></catalog>
	XML;
