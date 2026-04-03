<?php declare(strict_types=1);

echo <<<'TS'
	type User ={id:number,name:string,active?:boolean}
	
	function processUsers(users:User[] ){
	let result :number=0
	let names:string[]=[]
	
	users.forEach((u)=>{
	if(u.active===true){
	result+=u.id
	names.push(u.name.toUpperCase())
	}else{
	if(u.active===false){
	names.push(u.name.toLowerCase())}
	else{
	names.push("unknown")}}})
	
	const extra = users.map((u)=>{
	return { ...u , label : u.name + "-" + u.id }})
	
	return {result:result,names:names,extra:extra}
	}
	TS;
