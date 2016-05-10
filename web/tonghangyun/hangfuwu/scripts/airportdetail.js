angular.module('airServiceApp').controller('airportdetailCtrl', ['app','$scope','$routeParams', function(app,$scope,$routeParams){
	getAirportInformation();
	getKfInformation();
	//按照机场名字获取机场的详细信息
	function getAirportInformation(){
		var airportdetailAPI=app.restAPI.airportbyname;
		airportdetailAPI.get({id:$routeParams.id},function(data){
			$scope.airportDetail=data;
		},function(data){
			console.log(data);
		});
	}
	//获取快飞网资讯
	function getKfInformation(){
		var kfInformationAPI=app.restAPI.kfinformation;
		kfInformationAPI.get(function(data){
			$scope.kfinformations=data.items;
		},function(data){
			console.log(data);
		})
	}
}])