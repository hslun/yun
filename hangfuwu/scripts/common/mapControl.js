 'use strict';
 /**
 * @ngdoc function
 * @name airServiceApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the airServiceApp
 */
 angular.module('airServiceApp')
 .controller('mapCtrl', ['app','$scope','$rootScope','addWeatherLayer', function(app,$scope,$rootScope,addWeatherLayer){
  var markers=[],legends=[];
  var map=new Object();

  createMap();
 

  $scope.legends=legends;
  $scope.planepicture="../images/pic-1.png";
  $rootScope.markers=markers;
  $scope.lineStatus="linebtn-close";

  var imag_url_pre="../images/";
  var airportstyles={
            "民航机场":{
                 "imag":imag_url_pre+"ico-8.png",
                 "overimag":imag_url_pre+"ico-8-s.png",
                 "legendimg":imag_url_pre+"minhang.png",
                 "imagcolor":"#6190dc"
                  },
             "通用机场":{
                  "imag":imag_url_pre+"ico-9.png",
                  "overimag":imag_url_pre+"ico-9-s.png",
                   "legendimg":imag_url_pre+"tongqin.png",
                  "imagcolor":"#988080"
             },
             "直升机场":{
                  "imag":imag_url_pre+"ico-10.png",
                  "overimag":imag_url_pre+"ico-10-s.png",
                   "legendimg":imag_url_pre+"zhishengjichang.png",
                  "imagcolor":"#fe6869"
             },
             "临时":{
                  "imag":imag_url_pre+"ico-9.png",
                  "overimag":imag_url_pre+"ico-9-s.png",
                   "legendimg":imag_url_pre+"linshi.png", 
                  "imagcolor":"#fbb846"
             },
             "直升机":{
                  "imag":imag_url_pre+"ico-12.png",
                  "overimag":imag_url_pre+"ico-12.png",
                  "legendimg":imag_url_pre+"ico-12.png",
                  "imagcolor":"#846c6c"
             },
            "固定翼":{
                  "imag":imag_url_pre+"ico-13.png",
                  "overimag":imag_url_pre+"ico-13.png",
                   "legendimg":imag_url_pre+"ico-13.png",
                   "imagcolor":"#846c6c"
             }

  };
  
  var airportypes={
     
            "民航机场":{
              "markers":[],
              "minZoom":5,
              "maxZoom":19,
              "mgr":new BMapLib.MarkerManager(map,{borderPadding: 4,maxZoom: 19,trackMarkers: true})
            },
             "通用机场":{
              "markers":[],
              "minZoom":7,
              "maxZoom":19,
               "mgr":new BMapLib.MarkerManager(map,{borderPadding: 4,maxZoom: 19,trackMarkers: true})
            },
           
             "直升机场":{
              "markers":[],
               "minZoom":7,
              "maxZoom":19,
               "mgr":new BMapLib.MarkerManager(map,{borderPadding: 4,maxZoom: 19,trackMarkers: true})
            },
             "临时":{
              "markers":[],
              "minZoom":12,
              "maxZoom":19,
               "mgr":new BMapLib.MarkerManager(map,{borderPadding: 4,maxZoom: 19,trackMarkers: true})
            },
             "直升机":{
              "markers":[],
              "minZoom":5,
              "maxZoom":19,
               "mgr":new BMapLib.MarkerManager(map,{borderPadding: 4,maxZoom: 19,trackMarkers: true})
             },
            "固定翼":{
              "markers":[],
              "minZoom":5,
              "maxZoom":19,
               "mgr":new BMapLib.MarkerManager(map,{borderPadding: 4,maxZoom: 19,trackMarkers: true})
             }
  };
    var legend={
     
            "民航机场":{
              "markers":[],
            },
             "通用机场":{
              "markers":[],
            },
           
             "直升机场":{
              "markers":[],
            },
             "临时":{
              "markers":[],
            },
             "直升机":{
              "markers":[],
             },
            "固定翼":{
              "markers":[],
             }
  };
  var distance_lable_style={
              color : "black",
              backgroundColor:"transparent",
              border:"0px", 
              fontSize : "12px", 
              height : "20px",
              lineHeight : "20px",
              fontFamily:"微软雅黑"
};

   //创建地图
    function createMap(){
        map=new BMap.Map('baiduMap',{minZoom:5,enableMapClick:false});
        var myCity = new BMap.LocalCity();
           myCity.get(function(result){
            var cityName = result.name;
                map.centerAndZoom(cityName,10);
           });
           map.addEventListener('load',function(){
                 initMap();
           });
       
    }

    //初始化地图
    function initMap(){
                addAirports();
                setMapEvent();
                addControl();
                createCopyright();
    }
     //添加控件
     function addControl(){
          var scaleControl = new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT});
          var navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_LEFT,offset: new BMap.Size(8, 52)}); 
          var mapType=new BMap.MapTypeControl({anchor: BMAP_ANCHOR_TOP_RIGHT,offset: new BMap.Size(8, 52),mapTypes:[BMAP_NORMAL_MAP,BMAP_SATELLITE_MAP]});
          map.addControl(mapType);//添加地图类型控件
          map.addControl(scaleControl);
          map.addControl(navigation);
     }
    //添加版权信息
    function createCopyright(){
        var cr = new BMap.CopyrightControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT,enableMapClick:false});
        map.addControl(cr); //添加版权控件
        cr.addCopyright({id: 1, content: "<p href='#' style='font-size:14px;'>2014&copy海丰通航</p>"});  
    }
    map.addEventListener("zoomend", function(){

        $scope.$apply(function(){
          drawLegend();
        }); 
    }); 
    map.addEventListener("dragend", function(){
        $scope.$apply(function(){
          drawLegend();    
        }); 
    }); 
    $rootScope.closeOverlay=function(index){
      var typename=legends[index].typename;
          airportypes[typename].mgr.toggle();
         drawLegend();
    }
  function addAirports(){
            var  airportsAPI=app.restAPI.airports;
                 airportsAPI.get( function (data) {
                          var airports=data.items;
                          for(var i=0;i<airports.length;i++)
                            {
                              var lng=airports[i].longitude;
                              var lat=airports[i].latitude;
                              var lev=airports[i].airport_type;
                              var name=airports[i].airport_name;
                              var pt = new BMap.Point(lng, lat);
                              var style = airportstyles[lev];
                              var myIcon = new BMap.Icon(style.imag, new BMap.Size(16,16));
                              var marker = new BMap.Marker(pt,{icon:myIcon});
                                  marker.lev=lev;
                                  marker.name=name;
                                  markers.push(marker);  
                             }
                              showMarkers();
                              drawLegend();

                        }, function (data) {console.log(data);
                            
                        });  
    }
    //添加一个点
    function showMarkers(){
       var len=markers.length;
      for (var i = len-1; i--;) {
          var lev=markers[i].lev;
            initalOneMarker( markers[i]);
            airportypes[lev].markers.push( markers[i]);
       }
       for(var item in  airportypes){
        var airporttype=airportypes[item];
         airporttype.mgr.addMarkers(airporttype.markers,airporttype.minZoom,airporttype.maxZoom);
        airporttype.mgr.showMarkers();
       }
    }
    function initalOneMarker(marker){
         var label = new BMap.Label(marker.name,{offset:new BMap.Size(16,0)});
            //label.setStyle({ border: "1px solid #7aa3cc", backgroundColor: "#f0f7ff" ,fontSize:"12px",color:"#224b73"});
             label.setStyle({ "color":"#5C4242","filter": "Glow(Color=#ff0000, Strength=2)","backgroundColor": "transparent","border":"0px","font-family":"黑体","font-weight":"700"});
         marker.setLabel(label);
         addEvent(marker);
    }
    //为marker添加信息窗口

    var infoBoxTmp=null;
    function addEvent(marker){
        if(marker!=null){  
            marker.addEventListener("click", function(e){
                var  airportAPI=app.restAPI.airportbyname;
                var sContent = "";
                airportAPI.get({id:e.target.name}, function (data) {
                     var p=e.target;
                     var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
                         sContent="<div class='myinfoBox'>"+
                                      "<div class='myinfoBoxTitle'>"+data.airport_name+
                                        // "<a>详情>></a>"+
                                      "</div>"+
                                      "<div class='myinfoBoxContent'>"+
                                          "<div class='infoBoxWeather'>"+
                                              "<div class='weather_img'>"+
                                                    "<img id='test' alt='首都机场' src='"+data.weather.data0_daypictureurl+"'>"+
                                                "</div>"+
                                                "<div class='weather_detail'>"+
                                                   "<p class='weather_templ'><span class='templ_real'>"+data.weather.data0_date_real+"</span><span class='templ_range'>"+data.weather.data0_temperature+"</span></p>"+
                                                   "<p><span class='weather_describ'>"+data.weather.data0_weather+"</span><span class='weather_wind'>"+data.weather.data0_wind+"</span></p>"+
                                                "</div>"+
                                                "<div class='address'>"+
                                                   "<p><span>地址:</span>"+data.address+"</p>"+
                                                "</div>"+
                                          "</div>"+
                                          "<div class='infoBoxDetail'>"+
                                              "<table>"+
                                                 "<tbody>"+
                                                  "<tr><th>经度:</th><td>"+data.latitude+"</td><th>纬度:</th><td>"+data.longitude+"</td></tr>"+
                                                  "<tr><th>海拔:</th><td>"+data.hight+"m</td><th>飞行区等级:</th><td>"+data.the_airfield_level+"</td></tr>"+
                                                  "<tr><th>跑道数量:</th><td>"+data.ttn+"</td><th>停机坪数量:</th><td>"+data.apron+"</td></tr>"+
                                                 "<tbody>"+
                                              "</table>"+
                                              "<table>"+
                                                 "<tbody>"+
                                                  "<tr><th>维修服务:</th><td>"+data.maintenance+"</td><th>航油供应:</th><td>"+data.fuel+"</td></tr>"+
                                                  "<tr><th>驻场公司:</th><td>"+data.inacompany+"</td><th>联系电话:</th><td>"+data.tel+"</td></tr>"+
                                                 "<tbody>"+
                                              "</table>"+
                                          "</div>"+
                                          "<div class='infoBoxImg'>"+
                                              "<img alt='首都机场' src='http://pcsv0.map.bdimg.com//pr/?qt=poiprv&uid=e1bfdd9c943c3796f32d8389&width=323&height=101&quality=80&fovx=250'>"+
                                          "</div>"+
                                          "<div class='infoMore'>"+
                                          "</div>"+
                                      "</div>"+
                                       "<div style='position:absolute;left:150px'>"+
                                           "<img alt='首都机场' src='http://webmap0.map.bdimg.com/image/api/iw_tail.png'>"+
                                       "</div>"+
                                 "</div>";
                      var infoBoxOptions={
                                  offset:{width:22,height:39},
                                  closeIconMargin:'10px 10px 0 0',
                                  closeIconUrl:'images/ico-close-1.png',
                                  enableAutoPan:true,
                          };
                      var infoBox = new BMapLib.InfoBox(map,sContent,infoBoxOptions);
                      if(infoBoxTmp){
                        infoBoxTmp.close();
                      }
                      infoBoxTmp=infoBox;
                      infoBox.open(marker);
              }, function (data) {
                      console.log(data);    
              });                  
           });
            marker.addEventListener("mouseover", function(e){
                var self=e.target;
                var overimag=airportstyles[marker.lev].overimag;
                self.setIcon(new BMap.Icon(overimag, new BMap.Size(16,16)));
                if(map.getZoom()==self.minZoom)
                 {
                  self.getLabel().show();
                 }
             });
            marker.addEventListener("mouseout", function(e){
                var self=e.target;
                var imag=airportstyles[marker.lev].imag;
                self.setIcon(new BMap.Icon(imag, new BMap.Size(16,16)));
               if(map.getZoom()==self.minZoom)
                   {
                    self.getLabel().hide();
                   }
             });
        }
    }
    function drawLegend(){

      var len=legends.length;
          if(len==0)
           {
            for(var item in  airportypes){
            var legend={"typename":"","typelegendimg":"","isshow":"legendopen","markerscount":""};
             legend.typename=item;
             legend.typelegendimg=airportstyles[item].legendimg;
             legend.markerscount=airportypes[item].mgr.getMarkerCount(map.getZoom());
             if(legend.markerscount==0)
              {
                legend.isshow="legendclose";
              }
              else
              {
                legend.isshow="legendopen";
              }

             legends.push(legend);
           }
       }  
       else{
          for(var i=len;i--;)
          {
             legends[i].markerscount=airportypes[legends[i].typename].mgr.getMarkerCount(map.getZoom());
              if(legends[i].markerscount==0)
              {
                legends[i].isshow="legendclose";
              }
              else
               {
                  legends[i].isshow="legendopen";
               } 
          }
       }     
  }
    
  var url=imag_url_pre+"position.png";
  var markerToolIcon = new BMap.Icon(url, new BMap.Size(23,27),{anchor:new BMap.Size(6,25)});
 
  var markerToolOpts={icon:markerToolIcon,
                      autoClose: false, 
                      followText: "点击左键标记位置,按右键或Esc退出"};
    //标记工具
    var markertool=new BMapLib.MarkerTool(map,markerToolOpts);
        markertool.addEventListener("markend", function(e){  // 监听事件，提示标注点坐标信息 
               map.disableDoubleClickZoom();
                var tagmarker=e.marker;
                    tagmarker.lines=[];
                    tagmarker.labels=[];

                for(var item in  airportypes){
                  var airporttype=airportypes[item];
                  var markers= airporttype.mgr.getMarkers(map.getZoom());
                  drawlines(tagmarker,markers);
                 }
                addEventForMarkerTool(tagmarker);
                tagmarker.enableDragging();
        }); 

  function drawlines(tagmarker,markers){
     var markers=markers;
     var len=markers.length;
     var opts = { position : tagmarker.point,offset   : new BMap.Size(-25, 25)};
     var  taglable=new BMap.Label(tagmarker.point.lng.toFixed(2)+","+tagmarker.point.lat.toFixed(2), opts);
         // tagmarker.setLabel(taglable);
           for (var i = len; i--;) {
                  var linestyle={strokeColor:airportstyles[markers[i].lev].imagcolor, strokeWeight:3, strokeOpacity:1,strokeStyle:"solid"};
                  var polyline = new BMap.Polyline([tagmarker.point, markers[i].point],linestyle);   
                  var distance=map.getDistance(tagmarker.point,markers[i].point);
                  var lablestyle= { color : "#ffffff","border-radius":"4px", backgroundColor:airportstyles[markers[i].lev].imagcolor,border:"1px solid "+airportstyles[markers[i].lev].imagcolor, fontSize : "12px", height : "20px"};
                  if(distance<=100000)
                      {
                        var centerlng=tagmarker.point.lng+(markers[i].point.lng-tagmarker.point.lng)/2;
                        var centerlat=tagmarker.point.lat+(markers[i].point.lat-tagmarker.point.lat)/2;
                        var centerpoint=new BMap.Point(centerlng,centerlat);
                        var opts = { position : centerpoint,    // 指定文本标注所在的地理位置
                                     offset   : new BMap.Size(10,0)    //设置文本偏移量
                                   };
                        var label= new BMap.Label((distance/1000).toFixed(2)+"km", opts);
                            label.setStyle(lablestyle);
                        polyline.label=label;
                            map.addOverlay(polyline);  
                            map.addOverlay(label);
                        tagmarker.lines.push(polyline);
                        tagmarker.labels.push(label);
                     }
          }

  }
  function addEventForMarkerTool(marker){
      marker.addEventListener("click", function(e){  // 监听事件，提示标注点坐标信息 
          var lines=e.target.lines;
          var labels=e.target.labels;
          var len=lines.length;
          for (var i = len; i--;) {
              map.removeOverlay(lines[i]);
              map.removeOverlay(labels[i]);
          }
           map.removeOverlay(e.target);
           map.removeOverlay(e.target.getLabel());
      });
      marker.addEventListener("dragging",function(e){
              var lines=e.target.lines;
              var len=lines.length;
              for (var i = len; i--;){
                var path = lines[i];
                var linepoints=path.getPath();
                path.setPositionAt(0, e.point);
                var newdistance=map.getDistance(linepoints[0],linepoints[1]);
                var centerlng=linepoints[0].lng+(linepoints[1].lng-linepoints[0].lng)/2;
                var centerlat=linepoints[0].lat+(linepoints[1].lat-linepoints[0].lat)/2;
                var centerpoint=new BMap.Point(centerlng,centerlat);
                 lines[i].label.setContent((newdistance/1000).toFixed(2)+"km");
                 lines[i].label.setPosition(centerpoint);
              }  
      });
  }
 $rootScope.addMarkerTool=function(){
      markertool.open();  

 }
 var options = {renderOptions: {map: map, panel: "results"},onSearchComplete:function(results){
       if(myLocalsearch.getStatus()==2)
             {
               alert("没有找到您输入的地址！");
             }
 }};
 var myLocalsearch = new BMap.LocalSearch(map,options);
 function mysearch(){
     //智能搜索Localsearch类
          var value_keyword_1 =$scope.keywords;
          var tag=false;
          if(value_keyword_1!=""&&value_keyword_1.indexOf("机场")>0)
          {
             var len=markers.length;
             for(var i=len;i--;)
             {
               if(markers[i].name==value_keyword_1)
               {
                 map.centerAndZoom(markers[i].getPosition(), 16);
                 markers[i].dispatchEvent('click');
                 tag=true;
               }
             }
             
          }
          if(tag==false)
          {
             myLocalsearch.search(value_keyword_1);
          }
  }
 $scope.searchairport=function(){
   mysearch();
 }
 $scope.enterSearch=function(keyEvent) {
  if (keyEvent.which === 13)
    mysearch();
}
    //测距工具
    var myDis = new BMapLib.DistanceTool(map, {lineStroke : 2});
       // myDistanceToolObject.addEventListener("addpoint", function(e) {  alert(e.distance);  });
    $rootScope.addDistanceTool=function(){
          myDis.open();     
     }
   
    // $rootScope.flightline.distance='0';
    var flightline={
      "planetype":"",
      "points":[],
      "weight":"0",
      "distance":0
    };
    $scope.flightline=flightline;
    var myDistanceToolObject = new BMapLib.DistanceTool(map, {lineStroke : 3,cursor:"images/point.png",lineColor:'#fc4848'});
    //window.myDistanceToolObject=myDistanceToolObject;
    var linePoint={
      "name":"",
      "longitude":"",
      "latitude":""
    };
    //打开航线规划

     myDistanceToolObject.addEventListener("addpoint", function(e) {
       var pointtext="空地";
       var pointlng=e.point.lng.toFixed(4),
          pointlat=e.point.lat.toFixed(4);
       var len=markers.length;
       for(var i=len;i--;){
          if(map.getDistance(markers[i].getPosition(),e.point)<1000)
          {
             pointtext=markers[i].name;
             pointlng=markers[i].getPosition().lng;
             pointlat=markers[i].getPosition().lat;
          }
        }
        $scope.$apply(function(){
          linePoint.pointIndex=e.index+1;
          linePoint.name=pointtext;
          linePoint.longitude=pointlng;
          linePoint.latitude=pointlat;
          var long_interger=parseInt(pointlng);
          var long_flat=pointlng-long_interger;
          var lat_interger=parseInt(pointlat);
          var lat_flat=pointlat-lat_interger;
          if(long_interger>0){
            linePoint.longitude_show=long_interger+"°"+(long_flat*60).toFixed(2)+"'E";
          }else{
            linePoint.longitude_show=long_interger+"°"+(long_flat*60).toFixed(2)+"'W";
          }
          if (lat_interger>0) {
            linePoint.latitude_show=lat_interger+"°"+(lat_flat*60).toFixed(2)+"'N";
          }else{
            linePoint.latitude_show=lat_interger+"°"+(lat_flat*60).toFixed(2)+"'S";
          }
          flightline.points.push(linePoint);
          linePoint=new Object();
        });
         
       });
      myDistanceToolObject.addEventListener("drawend", function(e) { 
         $scope.$apply(function(){
            flightline.distance=(e.distance/1000).toFixed(1); 
          });
         calculate();
      });
      myDistanceToolObject.addEventListener("removepolyline", function(){
            flightline.points=[];
            flightline.distance=0;
            calculate();
      });
      $scope.changeWeight=function(){
        if(!flightline.distance||flightline.planetype!="")
          calculate();
      }
    function calculate(){
       var calculaterestAPI = app.restAPI.calculate;
            if (true) {
                var data = $scope.flightline;
                calculaterestAPI.save({
                  
                }, data, function (data) {
                 $scope.time=data.time;
                 $scope.oil=data.oilconsumption;
              
                }, function (data) {

                });
            }
    }
    //打开航线规划
    function myaddFilghtLineTool(){
      $scope.mapstatus='smallmapcont';
         $scope.lineStatus="linebtn-open"
         $scope.lineSwitch=true;
         myDistanceToolObject.open();
         if(flightline.distance!=0)
         myDistanceToolObject._closebtn.dispatchEvent('click');
    }
    //关闭航线规划
    function mycloseFilghtLineTool(){
      $scope.lineStatus="linebtn-close"
        $scope.mapstatus='';
        $scope.lineSwitch=false;
        myDistanceToolObject.close();
    }
    $scope.addFilghtLineTool=function(){
      myaddFilghtLineTool();
    }
    $scope.closeFilghtLineTool= function(){
      mycloseFilghtLineTool();
    }

    $scope.lineControl=function(){
      if($scope.lineStatus=="linebtn-close"){
        myaddFilghtLineTool();
      }else{
        mycloseFilghtLineTool();
      }
    }
          /*航线部分*/
      var planesAPI=app.restAPI.planes;
      planesAPI.get(function(data){
        $scope.myPlanes=data.items;
      },function(data){
      });
    $scope.selectPlaneManufacturer=function(){
        for(var i=0;i<$scope.myPlanes.length;i++){
          if ($scope.myPlanes[i].manufacturer==$scope.myPlaneManufacturer) {
            $scope.myPlaneTypes=$scope.myPlanes[i].planetype;
            break;
          };
        }
    }
    $scope.selectPlaneType=function(){
        var planetbytypeAPI=app.restAPI.planebytype;
        planetbytypeAPI.get({id:$scope.flightline.planetype},function(data){
         $scope.planeDetail=data;
         $scope.planepicture=data.picture;
         calculate();
        },function(data){})
    }
    //地图事件
     map.addEventListener("rightclick", function(){          
         if(markertool)
           {markertool.close();
            map.enableDoubleClickZoom();}
    });
    //切换地图响应的事件
    map.addEventListener("maptypechange",function(){
      var len=markers.length;
      //console.log(map.getMapType().getName());
      if ('卫星'==map.getMapType().getName()) {
      for(var i=len;i--;){
        markers[i].getLabel().setStyle({ "color":"#dde8f4","filter": "Glow(Color=#c93756, Strength=0.5)","backgroundColor": "transparent","border":"0px","font-family":"黑体","font-weight":"400"});
       }
     }else{
       for(var i=len;i--;){
        markers[i].getLabel().setStyle({ "color":"#5C4242","filter": "Glow(Color=#ff0000, Strength=2)","backgroundColor": "transparent","border":"0px","font-family":"黑体","font-weight":"700"});
       }
     }
    });
    var isflightline=false;
    map.addEventListener("click", function(){ 
           
         
    });
    function setMapEvent(){
      map.enableScrollWheelZoom(true);
       map.enableDragging(); 
    }

 }]).factory('addWeatherLayer',function(){
  return function(){
    var weatherLayer;
    if (weatherLayer) {
        map.removeTileLayer(weatherLayer);
    }
    weatherLayer=new BMap.CustomLayer({
        geotableId: 78292,
        q: '', //检索关键字
        tags: '', //空格分隔的多字符串
        filter: '' //过滤条件,参考http://developer.baidu.com/map/lbs-geosearch.htm#.search.nearby
    });
    weatherLayer.addEventListener('hotspotclick',callback);
    map.addTileLayer(weatherLayer);
    //addWeatherLayer();
  };
 });
   function callback(e){
    alert('触发天气事件！');
   }