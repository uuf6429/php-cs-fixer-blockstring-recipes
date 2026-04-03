<?php declare(strict_types=1);

echo <<<'VUE'
	<template>
	  <div>
	    <h1>Messy Vue</h1>
	    <button @click="inc">click</button>
	    <p v-if="count > 3">high</p>
	    <p v-else>low</p>
	    <ul>
	      <li v-for="(i, idx) in list" :key="idx">
	        <span v-if="i % 2 === 0">even {{ i }}</span
	        ><span v-else> odd {{ i }} </span>
	      </li>
	    </ul>
	  </div>
	</template>
	
	<script>
	export default {
	  name: "App",
	  data() {
	    return { count: 0, list: [1, 2, 3] };
	  },
	  methods: {
	    inc() {
	      this.count++;
	      this.list.push(this.count);
	    },
	  },
	};
	</script>
	
	<style>
	h1 {
	  color: red;
	}
	button {
	  margin-top: 10px;
	}
	</style>
	VUE;
