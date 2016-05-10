angular.module('airServiceApp').filter('letter',function(){
	return function(item){
		return String.fromCharCode(item+65);
	}
})
.filter('offset',function(){
	return function(input,start){
		start=parseInt(start,10);
		return input.slice(start); 
	}
})
.filter('num2',function(){
	return function(item){
		return item.toFixed(2);
	}
})
.filter('num4',function(){
	return function(item){
		return item.toFixed(4);
	}
})
.filter('addmeter',function(){
	return function(item){
		return item+'米';
	}
})
.filter('emptydata',function(){
	return function(item){
		if(item==''){
			return '暂无数据';
		}else{
			return item;
		}
	}
})
