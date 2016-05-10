'use strict';

/**
 * @ngdoc function
 * @name airServiceApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the airServiceApp
 */
angular.module('airServiceApp')
  .controller('MainCtrl',['app','$scope','$rootScope','$location',function (app,$scope,$rootScope,$location) {
      $scope.search=function(){
       //智能搜索Localsearch类
            var options = {renderOptions: {map: window.map, panel: "results"}};
            var myLocalsearch = new BMap.LocalSearch(map,options);
            var value_keyword_1 =$scope.keywords;
            if(value_keyword_1.indexOf("机场")>0)
            {
               var len=markers.length;
               for(var i=len;i--;){
                  if(markers[i].name==value_keyword_1)
                  {
                    map.setCenter(markers[i].getPosition());
                  }
               }
            }
            else
            {
               myLocalsearch.search(value_keyword_1);
            }
      } 
      /*导航栏部分*/
      $scope.switchPlanePort=function(){
        $scope.planePortSwitch=!$scope.planePortSwitch;
      }
      /*航线部分*/
      var planesAPI=app.restAPI.planes;
      planesAPI.get(function(data){
        $scope.myPlanes=data.items;
      },function(data){
      });
      //获取s
      $scope.myPlaneManufacturer='';
      $scope.selectPlaneManufacturer=function(){
        for(var i=0;i<$scope.myPlanes.length;i++){
          if ($scope.myPlanes[i].manufacturer==$scope.myPlaneManufacturer) {
            $scope.flightline.planeType=$scope.myPlanes[i].planetype;
            break;
          };
        }
      }
      $scope.selectPlaneType=function(){
        var planetbytypeAPI=app.restAPI.planebytype;
        planetbytypeAPI.get({id:$scope.flightline.planeType},function(data){
         $scope.planeDetail=data;
        },function(data){})
      }
      /*图例*/
      $scope.$on('legends', function(d,data) {  
        $scope.legends=data;
      });
      $scope.resetLine=function(){
        $scope.linePoints=[];
      }
      $scope.addFilghtLineTool=function(){
         $scope.flightLine='myflight';
          $scope.lineSwitch=true;
          window.myDistanceToolObject.open();
      }
      $scope.closeFilghtLineTool=function(){
        $scope.flightLine='';
        $scope.lineSwitch=false;
        window.myDistanceToolObject.close();
       }

      if(window.sessionStorage["userInfo"])
      {
      	var user=JSON.parse(window.sessionStorage["userInfo"]);
           app.rootScope.global.user = user;
           app.checkUser();
        }

      $scope.login=function(){
      	window.location.href='http://localhost:9090/login.html';
      }
       $scope.closeInfoWindow=function(){alert('ddd');
          // if(myCompOverlay)
          //   map.removeOverlay(myCompOverlay);
         // isInfo=false;
          $scope.mouseX = event.pageX;
                    $scope.mouseY = event.pageY; 
     }
 }]);
