'use strict'
/**
 * @ngdoc service
 * @name airServiceApp.weather
 * @description
 * # weather
 * Factory in the airServiceApp.
 */
angular.module('airServiceApp')
.config(['$httpProvider', function ($httpProvider) {
  
  //$httpProvider.defaults.useXDomain = true;
  $httpProvider.defaults.headers.common['Authorization']="";
   //delete $httpProvider.defaults.headers.common['X-Request-Width'];
   }])
  .factory('weather', ['$resource',
  	function($resource){
      return $resource('http://api.map.baidu.com/telematics/v3/weather?location=北京&output=json&ak=WFQqRMGlj5gt5QmXAh3T3POo');
}]);
  /**
 * @ngdoc service
 * @name airService.weatherLoader
 * @description
 * # weatherLoader
 * Factory in the airServiceApp.
 */
 angular.module('airServiceApp')
 .factory('weatherLoader', ['weather','$q', function(weather,$q){
 	return function (){
 		var delay=$q.defer();
 		weather.query(function(weathers){
 			delay.resolve(weathers);
 		},function(){
 			delay.reject('unable to fetch weathers');
 		});
 		return delay.promise;
 	};
 }]);