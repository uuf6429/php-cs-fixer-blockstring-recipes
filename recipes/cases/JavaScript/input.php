<?php declare(strict_types=1);

echo <<<'JS'
	function  calcStuff(a,b){let result=0
	if(a>10){
	for(let i=0;i<b;i++){ result+=i* a
	if(i%2===0){console.log("even",i)} else
	{ console.log( "odd", i )}}}
	else{
	let obj={x:1,y:2,z:[1,2,3].map(n=>{return n*a})}
	Object.keys(obj).forEach((k)=>{
	if(typeof obj[k]==="number"){result+=obj[k]}
	else if(Array.isArray(obj[k])){
	obj[k].forEach(v=>{result+=v})}})}
	
	let weird = [1,2,3,4].reduce((acc,cur)=>{
	if(cur>2){return acc+cur}else{return acc}},0)
	
	return {   result:result , extra:weird}
	}
	
	
	
	const data =[ {name:"Alice",age:25},{name:"Bob",age:30} ,{name:"Charlie",age:35}]
	data.forEach((person)=>{
	if(person.age>28){ console.log( person.name.toUpperCase() )}
	else{console.log(person.name.toLowerCase())}})
	JS;
