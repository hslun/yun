'use strict';
angular.module('loginApp')
.config(['$httpProvider',function($httpProvider) {
	$httpProvider.defaults.headers.common['Authorization']="";
}])
.factory('admin', ['$resource', function($resource){
	// return $resource('http://192.168.2.144:5001/login/');
	return $resource('http://192.168.2.183:5000/v1/login/');
}])
.factory('user_regist', ['$resource', function($resource){
	return $resource('http://192.168.2.144:5001/user/');
}]);