'use strict';

/**
 * @ngdoc function
 * @name airServiceApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the airServiceApp
 */
angular.module('airServiceApp')
  .controller('MainCtrl',['$scope', '$location',function ($scope,$location) {
      var map=null;
      Microsoft.Maps.loadModule('Microsoft.Maps.Overlays.Style', { callback: GetMap });
      function GetMap(){        
        var mapOptions={
          credentials:"AkUV_-FCAjSWanyamMSBLbVsx-guOiEZFxUxN5TVSwqmf_qTzVQtTgVB_anQ5TYc",
          center:new Microsoft.Maps.Location(26.3,110.5),
          customizeOverlays: true,
          enableSearchLogo:false,
          enableClickableLogo:false,
          showCopyright:false,
          showBreadcrumb:true,
          zoom:4
        } 
        //初始化地图
        map = new Microsoft.Maps.Map(document.getElementById("hfMap"), mapOptions);
        var loc=new Microsoft.Maps.Location(26.2,118.3);
        var loc2=new Microsoft.Maps.Location(38.2,118.3);
        addAirportLayer(loc2);
        addPlaneLayer(loc); 
        //添加点击事件
        Microsoft.Maps.Events.addHandler(map, 'click', displayLatLong); 
      } 
      //添加飞机图层
      function addPlaneLayer(loc){
        map.entities.push(new Microsoft.Maps.Pushpin(loc,{icon:'../../images/plane.png'}));
      }
      //添加机场图层
      function addAirportLayer(loc){
        map.entities.push(new Microsoft.Maps.Pushpin(loc, {text: "H"}));
      }
      //获取经纬度
       function displayLatLong(e) {
              if (e.targetType == "map") {
                  var point = new Microsoft.Maps.Point(e.getX(), e.getY());
                  var loc = e.target.tryPixelToLocation(point);
                  alert(loc.latitude + ", " + loc.longitude);
              }
          }
          $scope.local=function(){
            $location.path('/about')
          }
        $scope.closeInfoWindow=function(){alert('ddd');
          // if(myCompOverlay)
          //   map.removeOverlay(myCompOverlay);
         // isInfo=false;
          $scope.mouseX = event.pageX;
                    $scope.mouseY = event.pageY; 
     }
  }]);
