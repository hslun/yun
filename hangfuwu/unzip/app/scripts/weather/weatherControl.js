'use strict';
/**
 * @ngdoc function
 * @name airServiceApp.controller:weathercontroller
 * @description
 * # weathercontroller
 * Controller of the airServiceApp
 */
airService
 .controller('weatherCtrl', ['app','$scope','$rootScope','addWeatherLayer', function(app,$scope,$rootScope,addWeatherLayer){
 	 var  citysAPI=app.restAPI.citys;
     citysAPI.get( function (data) {
                      $scope.expanders=data.items;
                    }, function (data) {console.log(data);
                        
                    });   
 	 $scope.weekdays=[{name:'星期三'},{name:'星期五'},{name:'星期六'},{name:'星期日'}];   
 	 $rootScope.openDetail=function(){
       var restAPI = app.restAPI.weather,
           param=app.rootScope.global.info.selectedCity;
            // $scope.city='龙岩';
            //            $scope.date='2014-09-18';
            //            $scope.temperature='14-15℃';
            //            $scope.weather='晴转多云';
                       //$scope.wind=data.data0_wind;
            restAPI.get({
                      id:param
                    }, function (data) {
                      //console.log(data);
                       $scope.city=data.city;console.log()
                       $scope.date=data.data0_date;
                       $scope.realtemperature=data.data0_date_real;
                       $scope.temperature=data.data0_temperature;
                       $scope.weather=data.data0_weather;
                       $scope.wind=data.data0_wind;
                      
                    }, function (data) {console.log(data);
                        
                    });
        $scope.weatherDetailBox=!$scope.weatherDetailBox;
        if($scope.weatherBox)
        {
           $scope.weatherBox=!$scope.weatherBox;
        }  
         addWeatherLayer(); 
    }
   $rootScope.openWeather=function(){
        $scope.weatherBox=!$scope.weatherBox;
        if($scope.weatherDetailBox){
          $scope.weatherDetailBox=false;
        }
        addWeatherLayer(); 
      }
        $scope.closeWeather=function(){
        $scope.weatherBox=false;
      }      
      $scope.searchPosition=function(){
        alert('检索地点功能');
      }

      $scope.closeWeatherDetail=function(){
        $scope.weatherDetailBox=false;
      }
      $scope.changeCity=function(){
         $scope.weatherDetailBox=!$scope.weatherDetailBox;
         $scope.weatherBox=!$scope.weatherBox;
      $scope.closeWeatherDetail=function(){
        $scope.weatherDetailBox=false;
      }

      }
 }])