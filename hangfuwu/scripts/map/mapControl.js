 'use strict';
 /**
 * @ngdoc function
 * @name airServiceApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the airServiceApp
 */
 angular.module('airServiceApp')
 .controller('mapCtrl', ['app','$scope','$rootScope',function(app,$scope,$rootScope){
  var legends=[];
  var map=new Object();
  var airports=[];
  var airporttypes=[];
  var airportstyles=[];

  var planes=[];
  var planetypes=[];
  var planestyles=[];

  var allairportsmark=[];
  var allplanesmark=[];
  var localName='全国';
  var userInfo=window.sessionStorage.userInfo;
  var interval;


  var makermanagers={};
  $scope.lineStatus="linebtn-close";
  var imag_url_pre="../images/";
    (function inital(){
         getAirporttype(); //获取机场类别
         getAiportStyle(); //获取机场样式
         getPlanetype();   //获取飞机类型
         getPlaneStyle();  //获取飞机样式
         createMap();      //创建地图
    })();
    //获取机场类别数据，并创建对象添加到airporttypes数组中
    function getAirporttype(){
          //获取机场类型数据并加载样式
          var  airporttypesAPI=app.restAPI.airporttypes;
               airporttypesAPI.get(function(data){
                  var data=data.items;
                  for(var i=0;i<data.length;i++){ 
                      var airporttype=new app.Airporttype();
                          airporttype.name=data[i].name;
                          airporttype.minzoom=data[i].minzoom;
                          airporttype.maxzoom=data[i].maxzoom;
                      airporttypes.push(airporttype);
                  }
               },function(data){
                   console.log("error"+data);
               });
    }
    //获取机场数据,，并创建对象添加到airports数组中
    function getAirports(){
          var  airportsAPI=app.restAPI.airports;
               airportsAPI.get( function (data) {
                  var data=data.items;
                  for(var i=0;i<data.length;i++){
                         var airport=new app.Airport();
                         airport=data[i];
                         airports.push(airport);
                  }
                  addAirportsForType();
                  drawAirportsToMap();
                  drawLegend();
              }, function (data) {
                 console.log("error:"+data); 
              }); 
    }
    //获取样式数据
    function getAiportStyle(){
          var   styleAPI=app.restAPI.airportstyle;
                styleAPI.get(function(data){
                     airportstyles=data;
                },function(data){
              });
    }
    //获取飞机类别数据，并创建对象添加到planetypes数组中
     function getPlanetype(){
          //获取飞机类型数据并加载样式
          var  planetypesAPI=app.restAPI.planetypes;
               planetypesAPI.get(function(data){
                  var data=data.items;
                  for(var i=0;i<data.length;i++){ 
                      var planetype=new app.Planetype();
                          planetype.name=data[i].name;
                          planetype.minzoom=data[i].minzoom;
                          planetype.maxzoom=data[i].maxzoom;
                          planetype.owner=data[i].owner;
                      planetypes.push(planetype);
                  }
               },function(data){
                   console.log("error"+data);
               });
    }
    //获取样式数据
    function getPlaneStyle(){
          var  planestylesAPI=app.restAPI.planestyles;
                planestylesAPI.get(function(data){
                     planestyles=data;
                },function(data){
              });
    }
    //创建地图
    $scope.mymap=map;
    function createMap(){
          map=new BMap.Map('baiduMap',{minZoom:5,enableMapClick:false}); 
          var myCity = new BMap.LocalCity();
              myCity.get(function(result){ 
                  localName = result.name;
                  map.centerAndZoom(localName,5);
                  $scope.cityName=localName;
             });
            //添加地图控件
            addControl();
            //添加版权信息
            addCopyright();
            //地图加载完成后

            map.addEventListener('load',function(){
                  createMgr(airporttypes);
                  createMgr(planetypes);
                  getAirports();    //获取机场数据
                  setMapEvent(); //添加地图事件
                  getPlanesAndTimer();
            });    
    }
    //根据机场种类创建MarkerManager
    function createMgr(mytypes){
       var len=mytypes.length;
          for(var i=0;i<len;i++){
                 var mgr=new BMapLib.MarkerManager(map,mytypes[i].name,{borderPadding: 4,maxZoom:mytypes[i].maxzoom,trackMarkers: true});
                     //添加对应的marker管理对象
                     makermanagers[mytypes[i].name]=mgr;
              }
    }
    //添加地图控件
    function addControl(){
          //比列尺
          var scaleControl = new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT});
          //缩放级别
          var navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_LEFT,offset: new BMap.Size(8, 52)}); 
          //地图类型
          var mapType=new BMap.MapTypeControl({anchor: BMAP_ANCHOR_TOP_RIGHT,offset: new BMap.Size(8, 52),mapTypes:[BMAP_NORMAL_MAP,BMAP_SATELLITE_MAP]});
          map.addControl(mapType);
          map.addControl(scaleControl);
          map.addControl(navigation);
    }     
    //添加版权信息
    function addCopyright(){
          var cr = new BMap.CopyrightControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT,enableMapClick:false});
          map.addControl(cr); //添加版权控件
          cr.addCopyright({id: 1, content: "<p href='#' style='font-size:14px;'>2014&copy海丰通航</p>"});  
    }

    //设置地图事件
     function setMapEvent(){
         //滚轮缩放
         map.enableScrollWheelZoom(true);
         //可拖拽
         map.enableDragging(); 
         //地图缩放结束时，更改图例
         map.addEventListener("zoomend", function(){
            // $scope.$apply(function(){
            //   drawLegend();
            // }); 
            drawLegend();
         });
         //地图拖拽结束时，更改图例
          map.addEventListener("dragend", function(){
            $scope.$apply(function(){
              drawLegend();    
            }); 
         });
             //给地图右键事件(关闭标记功能、开启双击放大地图功能)
         map.addEventListener("rightclick", function(){          
             if(markertool)
               {markertool.close();
                map.enableDoubleClickZoom();}
        });
         //地图拖拽是更改当地城市
         // map.addEventListener('dragging',function(){
         //  var geoc = new BMap.Geocoder();
         //  geoc.getLocation(map.getCenter(),function(rs){
         //    var addComp = rs.addressComponents;
         //    $scope.cityName=addComp.city;
         //  })
          
         // });
        //切换地图类型响应的事件(改变maker中的label文字显示)
        map.addEventListener("maptypechange",function(){
            var len=allairportsmark.length;
            if ('卫星'==map.getMapType().getName()) {
                  for(var i=len;i--;){
                      allairportsmark[i].getLabel().setStyle({ "color":"#dde8f4",
                                                     "filter": "Glow(Color=#c93756, Strength=0.5)",
                                                     "backgroundColor": "transparent",
                                                     "border":"0px",
                                                     "font-family":"黑体",
                                                     "font-weight":"400"});
                   }
           }else{
                  for(var i=len;i--;){ 
                    allairportsmark[i].getLabel().setStyle({ "color":"#5C4242",
                                                    "filter": "Glow(Color=#ff0000, Strength=2)",
                                                    "backgroundColor": "transparent",
                                                    "border":"0px",
                                                    "font-family":"黑体",
                                                    "font-weight":"700"});
                   }
           }
        });   
    }
    //将机场数据划分到不同的类别中
    function addAirportsForType(){
          //划分类别
          for(var i=0;i<airporttypes.length;i++){ 
             airporttypes[i].addAirports(airports);
          }
    }
    //将机场数据按类别添加到地图中
    function drawAirportsToMap(){
          var len=airporttypes.length;
              for(var i=0;i<len;i++){
                 var markers=[];
                 var airports=airporttypes[i].getAirports(); //获取某类型中的机场对象数据
                 //将机场对象数据生成marker
                     for(var j=0;j<airports.length;j++){
                       var marker=createOneMarker(airports[j]);
                           addEventForMarker(marker);
                           markers.push(marker);
                           allairportsmark.push(marker);
                     }
                    makermanagers[airporttypes[i].name].addMarkers(markers,airporttypes[i].minzoom,airporttypes[i].maxzoom);
                    makermanagers[airporttypes[i].name].showMarkers();
              }
    }
   
  //创建一个marker
  function createOneMarker(airport){
         var marker;
         //创建一个marker
         var name=airport.airport_name,
             lat=airport.latitude,
             lng=airport.longitude,
             type=airport.airport_type;
         var pt = new BMap.Point(lng, lat);
            
         //根据类型type获得对应的样式
         var style=airportstyles[type];
         //设置marker的lable样式
           
         //设置maker的图片样式   
         var myIcon = new BMap.Icon(style.imag, new BMap.Size(16,16)),
             marker = new BMap.Marker(pt,{icon:myIcon});
             marker.name=name;
             marker.type=type;
         var label = new BMap.Label(marker.name,{offset:new BMap.Size(16,0)});
             label.setStyle(style.lablestyle); 
             marker.setLabel(label); 
         return marker;    
  }

  //为marker添加事件
  var infoBoxTmp=null;//定义存储信息框的临时变量
  function addEventForMarker(marker){
        if(marker!=null){  
            marker.addEventListener("click", function(e){
                var  airportAPI=app.restAPI.airportbyname;
                var sContent = "";
                airportAPI.get({id:e.target.name}, function (data) {
                     var p=e.target;
                     var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
                     if(data.airport_name=="北京密云机场"){
                      sContent="<div class='myinfoBox'>"+
                                      "<div class='myinfoBoxTitle'>"+data.airport_name+
                                        "<a href='#airportdetail_miyun' target='_blank'>详情>></a>"+
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
                                                  "<tr><th>海拔:</th><td>135m</td><th>飞行区等级:</th><td>1A</td></tr>"+
                                                  "<tr><th>跑道数量:</th><td>"+data.ttn+"</td><th>停机坪数量:</th><td>"+data.apron+"</td></tr>"+
                                                 "<tbody>"+
                                              "</table>"+
                                              "<table>"+
                                                 "<tbody>"+
                                                  "<tr><th>维修服务:</th><td>有</td><th>航油供应:</th><td>"+data.fuel+"</td></tr>"+
                                                  "<tr><th>驻场公司:</th><td>北京华彬天星通用航空有限公司</td><th>联系电话:</th><td>010-61069156</td></tr>"+
                                                 "<tbody>"+
                                              "</table>"+
                                          "</div>"+
                                          "<div class='infoBoxImg'>"+
                                              "<img alt='首都机场' src='/images/pic-miyun.png'>"+
                                              // "<img alt='首都机场' src='http://pcsv0.map.bdimg.com//pr/?qt=poiprv&uid=e1bfdd9c943c3796f32d8389&width=323&height=101&quality=80&fovx=250'>"+
                                          "</div>"+
                                          "<div class='infoMore'>"+
                                          "</div>"+
                                      "</div>"+
                                       "<div style='position:absolute;left:88px;top:-30px'>"+
                                           "<img alt='首都机场' src='/images/iw_tail.png'>"+
                                       "</div>"+
                                 "</div>";
                     }else{
                      sContent="<div class='myinfoBox'>"+
                                      "<div class='myinfoBoxTitle'>"+data.airport_name+
                                        "<a href='#airportdetail/"+data.airport_name+"' target='_blank'>详情>></a>"+
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
                                              "<img alt='首都机场' src='"+data.picture+"'>"+
                                              // "<img alt='首都机场' src='http://pcsv0.map.bdimg.com//pr/?qt=poiprv&uid=e1bfdd9c943c3796f32d8389&width=323&height=101&quality=80&fovx=250'>"+
                                          "</div>"+
                                          "<div class='infoMore'>"+
                                          "</div>"+
                                      "</div>"+
                                       "<div style='position:absolute;left:88px;top:-30px'>"+
                                           "<img alt='首都机场' src='/images/iw_tail.png'>"+
                                       "</div>"+
                                 "</div>";
                     }
                         
                      var infoBoxOptions={
                                  offset:{width:22,height:39},
                                  closeIconMargin:'10px 10px 0 0',
                                  closeIconUrl:'images/ico-close-1.png',
                                  enableAutoPan:true,
                                  align:INFOBOX_AT_BOTTOM
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
            //当鼠标进入标注图标区域时会触发此事件
            marker.addEventListener("mouseover", function(e){
                var overimag=airportstyles[e.target.type].overimag;
                e.target.setIcon(new BMap.Icon(overimag, new BMap.Size(16,16)));
                if(map.getZoom()==e.target.minZoom)
                 {
                  e.target.getLabel().show();
                 }
             });
            //鼠标移出地图区域时触发此事件
            marker.addEventListener("mouseout", function(e){
                var imag=airportstyles[e.target.type].imag;
                e.target.setIcon(new BMap.Icon(imag, new BMap.Size(16,16)));
                if(map.getZoom()==e.target.minZoom)
                   {
                    e.target.getLabel().hide();
                   }
             });
        }
  }
/*===========飞机态势============*/
  var planesIsShow=true;
  //关闭态势

  $scope.planeSwitch=function(){
     if(planesIsShow)
     {
       hidePlaneLayer();
     }
     else
     {
       showPlaneLayer();
     }
     planesIsShow=!planesIsShow;
        

  }
  function showPlaneLayer(){
        for(var j=0;j<planetypes.length;j++){
         makermanagers[planetypes[j].name].show();
       }
  }
  function hidePlaneLayer(){
        for(var j=0;j<planetypes.length;j++){
         makermanagers[planetypes[j].name].hide();
       }
  }
  //地图加载时调用
  function getPlanesAndTimer(){
      planeCtrl();
      interval=setInterval(planeCtrl,3000);
  }
  //获取飞机数据并加载到地图上，每隔时间间隔都执行一次
  function planeCtrl(){ 
     if(planesIsShow)
       {

          if (allplanesmark.length!=0) {
            clearPlanes();
          }
          getAircraft();
        } 
  }
  //获取态势数据
  function getAircraft(){
      var  aircraftAPI=app.restAPI.aircrafts;
           aircraftAPI.get(function(data){ 
                  var data=data.AircraftInfos;
                      clearPlanes();
                      for(var i=0;i<data.length;i++){
                          var  plane=new app.Plane();
                               plane.setID(data[i].ID);
                               plane.setAltitude(data[i].Altitude);
                               plane.setOwner(data[i].Owner);
                               plane.setDevice(data[i].Device);
                               plane.setDirection(data[i].Direction);
                               plane.setLatitude(data[i].Latitude);
                               plane.setLongitude(data[i].Longitude);
                               plane.setLatitudeC(data[i].LatitudeC);
                               plane.setLongitudeC(data[i].LongitudeC);
                               plane.setSpeed(data[i].Speed);
                               plane.setTimestamp(data[i].Timestamp);
                               planes.push(plane);
                      }
                      addPlanesForType();
                      drawPlanesToMap();
                      drawLegend();
            },function(data){
        });
  }
  //对飞机进行分类
  function addPlanesForType(){ 
        //划分类别
        for(var i=0;i<planetypes.length;i++){ 
           planetypes[i].addPlanes(planes);
        }
  }
  //对飞机进行分类
  function clearPlanes(){ 
        if (allplanesmark.length!=0) {
            for(var i=0;i<planetypes.length;i++){ 
                makermanagers[planetypes[i].name].clearMarkers();
             }
              planes=[];
            //划分类别
            for(var i=0;i<planetypes.length;i++){ 
               planetypes[i].planes=[];
            }
        }
  }
  //绘制所有飞机到地图上，并分类管理
  function drawPlanesToMap(){ 
        for(var j=0;j<planetypes.length;j++){
            var planesMakers=[];
            var planes=planetypes[j].planes;
            var len=planes.length;
                for(var i=0;i<len;i++){
                  var planeMarker=createPlaneMarker(planes[i]);
                    
                      planesMakers.push(planeMarker);  
                }

                makermanagers[planetypes[j].name].addMarkers(planesMakers,5,19);
                makermanagers[planetypes[j].name].showMarkers();       
        }

  }
  //创建一个飞机态势marker
  function createPlaneMarker(plane){
        var planeMarker;
        var id=plane.getID(),
            lat=plane.getLatitudeC(),
            owner=plane.getOwner(),
            lng=plane.getLongitudeC(),
            alt=plane.getAltitude(),
            speed=plane.getSpeed(),
            direction=plane.getDirection();

        var style=planestyles[owner];
        var content="<div class='label-plane'>"+
                          "<p class='label-id'>"+ id+"</p>"+
                          "<p class='label-latlng label-Con'>"+
                              "<span>纬度:"+lat.toFixed(2)+"</span>"+
                              "<span>经度:"+lng.toFixed(2)+"</span"+
                          "</p>"+
                          "<p class='label-heightspeed label-Con'>"+
                            "<span>高度:"+alt.toFixed(2)+"</span>"+
                            " <span>航速:"+speed.toFixed(2)+"</span>"+
                          "</p>"+
                    "</div>";
        var isMarkerExsit=false;
            for(var i=0;i<allplanesmark.length;i++){
               if(id==allplanesmark[i].ID)
               {
                  isMarkerExsit=true;
                  planeMarker=allplanesmark[i];
                  break;
               }
            }
            if(isMarkerExsit)
            {
             var label = new BMap.Label(content,{offset:new BMap.Size(-124,-96)});
              label.setStyle(style.lablestyle); 
              planeMarker.setLabel(label); 
              if(!planeMarker.labelIsShow)
              {
               planeMarker.getLabel().hide(); 
              }
            }
            else
            {
             
              var pt=new BMap.Point(lng,lat),
                  myIcon=new BMap.Icon(style.imag,new BMap.Size(25,25));
                  planeMarker=new BMap.Marker(pt,{icon:myIcon,rotation:direction});
                  planeMarker.ID=plane.ID;
                  planeMarker.type="plane";
                  planeMarker.labelIsShow=false;
              var label = new BMap.Label(content,{offset:new BMap.Size(-124,-96)});
                  label.setStyle(style.lablestyle); 
                  planeMarker.setLabel(label); 
                  planeMarker.getLabel().hide();
                  allplanesmark.push(planeMarker);
                  addEventForPlaneMarker(planeMarker);
          }
           
        return planeMarker;

  }
  function addEventForPlaneMarker(marker){
    // marker.addEventListener("mouseover", function(e){
    //    var marker=e.target;
    //    if(marker.getLabel()&&!marker.labelIsShow)
    //    {
    //      marker.getLabel().show();
    //    }     
    // });
    // marker.addEventListener("mouseout", function(e){
    //  var marker=e.target;
    //    if(marker.getLabel()&&!marker.labelIsShow)
    //    {
    //      marker.getLabel().hide();
    //    }  
    // });
   
    marker.addEventListener("click", function(e){
         var marker=e.target;
         if(marker.getLabel())
         {
          var label=marker.getLabel();
              marker.labelIsShow=!marker.labelIsShow;
             if(marker.labelIsShow)
             {
               label.show();
             }
             else
             {
               label.hide();
             }
         }
    });
  }

/*===========飞机态势============*/

/*===========图例============*/
  $scope.legends=legends;
  function drawLegend(){
        var len=legends.length;
            if(len==0){
                for(var i=0;i<airporttypes.length;i++){
                    var legend={"typename":"","typelegendimg":"","isshow":"legendopen","markerscount":""};
                        legend.typename=airporttypes[i].name;
                        legend.typelegendimg=airportstyles[legend.typename].legendimg;
                        //从markermanagers中获取对应的marker数量
                        legend.markerscount=makermanagers[legend.typename].getMarkerCount(map.getZoom());
                        legend.isshow=(legend.markerscount==0)? "legendclose" : "legendopen";
                        legends.push(legend);
                }
                for(var i=0;i<planetypes.length;i++){
                    var legend={"typename":"","typelegendimg":"","isshow":"legendopen","markerscount":""};
                        legend.typename=planetypes[i].name;
                        legend.typelegendimg=planestyles[planetypes[i].owner].legendimg;
                        //从markermanagers中获取对应的marker数量
                        legend.markerscount=makermanagers[legend.typename].getMarkerCount(map.getZoom());
                        legend.isshow=(legend.markerscount==0)? "legendclose" : "legendopen";
                        legends.push(legend);
                }
           }  
           else{
              for(var i=len;i--;){
                 //从markermanagers中获取对应的marker数量
                 legends[i].markerscount=makermanagers[legends[i].typename].getMarkerCount(map.getZoom());
                 legends[i].isshow=(legends[i].markerscount==0)? "legendclose" : "legendopen";
              }
           }     
  }
  //在图例中关闭某个类型机场的图层并重绘图标
  $scope.closeOverlay=function(index){
        var typename=legends[index].typename;
            makermanagers[typename].toggle();
            drawLegend();
  }
/*===========图例============*/

/*===========测距工具============*/
  var myDis = new BMapLib.DistanceTool(map, {lineStroke : 2});
  $scope.addDistanceTool=function(){
        myDis.open();     
 }
/*===========测距工具============*/

   
/*===========标记工具============*/
  //开启标记功能
  $scope.addMarkerTool=function(){
      markertool.open();  
  }
  //标记工具样式
  var url=imag_url_pre+"position.png",
      markerToolIcon = new BMap.Icon(url, new BMap.Size(23,27),{anchor:new BMap.Size(6,25)}),
      markerToolOpts={ icon:markerToolIcon,autoClose: false, followText: "点击左键标记位置,按右键或Esc退出" };
  //创建标记工具
  var markertool=new BMapLib.MarkerTool(map,markerToolOpts);
  //为标记工具添加markend事件，完成链接100公里内的机场
      markertool.addEventListener("markend", function(e){  // 监听事件，提示标注点坐标信息 
              map.disableDoubleClickZoom(); //禁止地图双击
              e.marker.enableDragging();    //使得标记可以拖拽
              e.marker.lines=[];
              e.marker.labels=[];
              for(var i=0;i<airporttypes.length;i++){
                  var typename=airporttypes[i].name;
                  var markers=makermanagers[typename].getMarkers(map.getZoom());
                  drawlines(e.marker,markers);
               }
              addEventForMarkerTool(e.marker);
      }); 
  //添加标记时，画出距离该标记100公里内的机场的连线
  function drawlines(tagmarker,markers){
     var markers=markers;
     var len=markers.length;
     var opts = { position : tagmarker.point,offset   : new BMap.Size(-25, 25)};
     var taglable=new BMap.Label(tagmarker.point.lng.toFixed(2)+","+tagmarker.point.lat.toFixed(2), opts);
         tagmarker.setLabel(taglable);
         for (var i = len; i--;) {
              var linestyle={strokeColor:airportstyles[markers[i].type].imagcolor, strokeWeight:3, strokeOpacity:1,strokeStyle:"solid"};
              var polyline = new BMap.Polyline([tagmarker.point, markers[i].point],linestyle);   
              var distance=map.getDistance(tagmarker.point,markers[i].point);
              var lablestyle= { color : "#ffffff","border-radius":"4px", backgroundColor:airportstyles[markers[i].type].imagcolor,border:"1px solid "+airportstyles[markers[i].type].imagcolor, fontSize : "12px", height : "20px"};
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
  //为标记添加事件，单击时删除，拖拽时重新画线并更改距离
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
      //给标记点添加拖拽事件，并重绘与可视区域内机场的事件
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
/*===========标记工具============*/

/*===========航线工具============*/
  var flightline={
            "planetype":"",
            "points":[],
            "weight":"0",
            "distance":0
  };
  $scope.flightline=flightline;
  var myFlightlineToolObject = new BMapLib.DistanceTool(map, {lineStroke : 3,cursor:"images/point.png",lineColor:'#fc4848'});
  var linePoint={
            "name":"",
            "longitude":"",
            "latitude":""
  };
 
  //打开航线规划事件
    $scope.addFilghtLineTool=function(){
        if (!$scope.lineSwitch) {
          myaddFilghtLineTool();
          $scope.resultSwitch=false;
       }else{
          mycloseFilghtLineTool();
       }
    }
    //关闭航线规划事件
    $scope.closeFilghtLineTool= function(){
      mycloseFilghtLineTool();
    }
  //打开航线规划方法
    function myaddFilghtLineTool(){
      $scope.mapstatus='smallmapcont';
         $scope.lineStatus="linebtn-open"
         $scope.lineSwitch=true;
         myFlightlineToolObject.open();
    }
  //关闭航线规划方法
    function mycloseFilghtLineTool(){
      $scope.lineStatus="linebtn-close"
        $scope.mapstatus='';
        $scope.lineSwitch=false;
        if($scope.flightline.points.length){
          myFlightlineToolObject._closebtn.dispatchEvent('click');
      }
        myFlightlineToolObject.close();
    }
      myFlightlineToolObject.addEventListener("addpoint", function(e) {
               var pointtext="空地";
               var pointlng=e.point.lng.toFixed(4),
                   pointlat=e.point.lat.toFixed(4);
               var len=allairportsmark.length;
               for(var i=len;i--;){
                  if(map.getDistance(allairportsmark[i].getPosition(),e.point)<1000)
                  {
                     pointtext=allairportsmark[i].name;
                     pointlng=allairportsmark[i].getPosition().lng;
                     pointlat=allairportsmark[i].getPosition().lat;
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
     //绘制航线结束时触发的事件(显示航线距离并计算预计用时，和预计油耗)
      myFlightlineToolObject.addEventListener("drawend", function(e) { 
               $scope.$apply(function(){
                  flightline.distance=(e.distance/1000).toFixed(1); 
                });
               calculate();
      });
      //删除航线时触发的事件(清除航线距离并计算预计用时，和预计油耗)
      myFlightlineToolObject.addEventListener("removepolyline", function(){
              flightline.points=[];
              flightline.distance=0;
              calculate();
      });
    //显示、隐藏航线规划事件
    $scope.mapstatus='mapcont';
    $scope.lineControl=function(){
      if($scope.lineStatus=="linebtn-close"){
         openFlightlineWin();
      }else{
          closeFlightlineWin();
          closeResultWin();
        }
    }
    function openFlightlineWin(){
      $scope.mapstatus='smallmapcont';
      $scope.lineStatus="linebtn-open";
      $scope.lineSwitch=true;
    }
    function closeFlightlineWin(){
      $scope.mapstatus='mapcont';
      $scope.lineStatus="linebtn-close";
      // $scope.mapstatus='';
      $scope.lineSwitch=false;
    }
    //总载重发生变化时出发的事件(计算预计用时，和预计油耗)
    $scope.changeWeight=function(){
       if(!flightline.distance||flightline.planetype!="")
       {
         calculate();
       } 
    }
  //计算预计用时，和预计油耗的方法
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
   //获取飞机详细信息
  var planesAPI=app.restAPI.planes;
      planesAPI.get(function(data){
        $scope.myPlanes=data.items;
      },function(data){
  });
    //用户选定生产厂商时触发的事件(获取厂商下拥有的机型)
  $scope.selectPlaneManufacturer=function(){
        for(var i=0;i<$scope.myPlanes.length;i++){
          if ($scope.myPlanes[i].manufacturer==$scope.myPlaneManufacturer) {
            $scope.myPlaneTypes=$scope.myPlanes[i].planetype;
            break;
          };
        }
  }
  //用户选定机型触发的事件(计算预计用时与预计油耗)
  $scope.planepicture="../../images/pic-1.png";
  $scope.selectPlaneType=function(){
        var planetbytypeAPI=app.restAPI.planebytype;
            planetbytypeAPI.get({id:$scope.flightline.planetype},function(data){
             $scope.planeDetail=data;
             $scope.planepicture=data.picture;
             calculate();
            },function(data){

            });
  }
/*===========航线工具============*/


/*===========搜索工具============*/
   $scope.myCondition='机场';
   $scope.selectOPts=[{name:'城市'},{name:'机场'},{name:'飞机'}];
   var myLocalsearch = new BMap.LocalSearch(map,options);
   var options = {renderOptions: {map: map, panel: "results"},
                  onSearchComplete:function(results){
                         if(myLocalsearch.getStatus()==2)
                             {
                               alert("没有找到您输入的地址！");
                             }
   }};
   $scope.searchairport=function(){
      mysearch();
      if('飞机'===$scope.myCondition){
        openResultWin();
      }
   }
   //回车搜索
   $scope.enterSearch=function(keyEvent) {
     if (keyEvent.which === 13)
        {
          mysearch();
         if('飞机'===$scope.myCondition){
            openResultWin();
           }
        }
   }
  
 function mysearch(){
     //智能搜索Localsearch类
          var value_keyword_1 =$scope.keywords;
          var cond=$scope.myCondition;
          switch(cond){
            case '城市':
            myLocalsearch.search(value_keyword_1);
            break;
            case '机场':
            var len=allairportsmark.length;
             for(var i=len;i--;)
             {
               if((allairportsmark[i].name).indexOf(value_keyword_1)>=0)
               {
                 map.centerAndZoom(allairportsmark[i].getPosition(), 10);
                 allairportsmark[i].dispatchEvent('click');
               }
             }
            break;
            case '飞机':
            searchPlanes();
            break;
            default:
            break;
          }
  }
  //飞机搜索
  var searchResult=[];
  $scope.searchplanes=searchResult;
  function searchPlanes(){
      searchResult=[];
      var value_keyword_1 =$scope.keywords;
      var len=planetypes.length;
      if(value_keyword_1!=null){
        for(var i=0;i<len;i++){
            var typename=planetypes[i].name;
            var markers=makermanagers[typename].getMarkers(map.getZoom());
            for(var j=0;j<markers.length;j++){
              if((markers[j].ID).toLowerCase().indexOf(value_keyword_1.toLowerCase())>=0)
               {
                  var thisplaneid=markers[j].ID;
                  var  planes=planetypes[i].planes;
                  map.centerAndZoom(markers[j].getPosition(), 5);
                  for(var m=0;m<planes.length;m++){
                     if(planes[m].ID==thisplaneid)
                     {
                        searchResult.push(planes[m]);
                     }
                  }
               }
            }
        }
        $scope.searchplanes=searchResult;
        $scope.resultLength=searchResult.length;
      }
  }
  // 分页显示飞机搜索结果
  $scope.itemsPerPage = 3;
  $scope.currentPage = 0; 
  $scope.prevPage = function() { 
        if ($scope.currentPage > 0) {
            $scope.currentPage--; 
        }
  };
  $scope.prevPageDisabled = function() {
      return $scope.currentPage === 0 ? "disabled" : "";
  };
  $scope.pageCount = function() {
      return Math.ceil($scope.searchplanes.length/$scope.itemsPerPage)-1;
  };
  $scope.range=function(){
    var page=[];
    var pagenum=$scope.searchplanes.length/$scope.itemsPerPage;
    for(var i=0;i<pagenum;i++){
      page.push(i);
    }
    return page;
     // return [0,1,2,3,4];
  };
  $scope.setPage=function(num){
    $scope.currentPage=num;
  }
  $scope.nextPage = function() {
      if ($scope.currentPage < $scope.pageCount()) {
          $scope.currentPage++;
       }
  };
 $scope.nextPageDisabled = function() {
      return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
  };
  //飞机在地图上定位
  $scope.selectPlane=function(planeId){
    localPlane(planeId);
  }
  //定位飞机函数
  function localPlane(keywords){
    var len=planetypes.length;
    for(var i=0;i<len;i++){
      var typename=planetypes[i].name;
      var markers=makermanagers[typename].getMarkers(map.getZoom());//暂时使用可视范围
      for(var j=0;j<markers.length;j++){
        if(markers[j].ID==keywords){
          map.centerAndZoom(markers[j].getPosition(),5);
          markers[j].getLabel().show();
        }
      }
    }
  }
//打开右侧信息页面
  function openResultWin(){
    $scope.mapstatus='smallmapcont';
    $scope.lineStatus="linebtn-open";
    $scope.resultSwitch=true;
    $scope.lineSwitch=false;
  }
//关闭右侧信息页面
  function closeResultWin(){
    $scope.lineStatus="linebtn-close";
    // $scope.mapstatus='';
    $scope.mapstatus='mapcont';
    $scope.resultSwitch=false;
  }
/*===========搜索工具============*/

/*===========切换城市============*/
    $scope.isshow=false;
    $scope.changeCity=function(){
       app.restAPI.provinceandcitys.get( function (data) {
        $scope.citys=data.province;
         }, function (data) {
         });  
      $scope.isshow=!$scope.isshow;
    }
   $scope.$watch('cityName',function(){
    if($scope.cityName=='全国'){
      map.centerAndZoom('北京',5);
    }else{
      map.centerAndZoom($scope.cityName,10);
    }
   })
/*===========切换城市============*/
}]);