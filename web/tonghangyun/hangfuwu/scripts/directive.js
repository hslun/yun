angular.module('airServiceApp').directive('accordion', function() {
    return {
        restrict : 'EA',
        replace : true,
        transclude : true,
        template : '<div ng-transclude></div>',
        controller : function() {
            var expanders = [];
            this.gotOpened = function(selectedExpander) {
                angular.forEach(expanders, function(expander) {
                    if (selectedExpander != expander) {
                        expander.showMe = false;
                    }
                });
            }
            this.addExpander = function(expander) {
                expanders.push(expander);
            }
        }
    }
});
angular.module('airServiceApp').directive('expander', function() {
    return {
        restrict : 'EA',
        replace : true,
        transclude : true,
        require : '^?accordion',
        scope : {
            title : '=expanderTitle'
        },
        template : '<div>'
                   + '<div class="province" ng-click="toggle()">{{title}}</div>'
                   + '<div class="body" ng-show="showMe" ng-transclude></div>'
                   + '</div>',
        link : function(scope, element, attrs, accordionController) {
            scope.showMe = false;
            accordionController.addExpander(scope);
            scope.toggle = function toggle() {
                scope.showMe = !scope.showMe;
                accordionController.gotOpened(scope);
            }
        }
    }
});
angular.module('airServiceApp').directive('dragable',function($document){
    var startX=0,
        startY=0,
        x=10,
        y=80;
    return{
        restrict:'EA',
        replace:true,
        link:function(scope,element,attr){            
            element.bind('mousedown',function(event){
                startX=event.screenX-x;
                startY=event.screenY-y;
                $document.bind('mousemove',mousemove);
                $document.bind('mouseup',mouseup);
            });
            function mousemove(event){
                y=event.screenY-startY;
                x=event.screenX-startX;
                element.css({
                    top:y+'px',
                    left:x+'px'
                });
            }
            function mouseup(){
                $document.unbind('mousemove',mousemove);
                $document.unbind('mouseup',mouseup);
            }
        }

    }
});
angular.module('airServiceApp').directive('tabcontain',function($document){
    var doc_height=document.body.offsetHeight-324-93;
    return{
        restrict:'EA',
        replace:true,
        link:function(scope,element,attr){
            //   element.find('.flightline').css({
            //      height:doc_height-62,
            //  });
            // element.find('.flightline').find('.bottom').css({
            //      height:doc_height-93,
            //  });
             // element.find('.planetype').css({
             //     height:(doc_height-93)*0.12,
             // });
        
            //  element.find('.calculate').css({
            //      height:(doc_height-93)*0.1,
            //  });
             element.css({
                 height:doc_height+'px',
                 // "max-height":(doc_height)-93-313
             // element.find('.calculate').css({
             //     height:doc_height*0.2,
             // });
            //     element.css({
            //     height:document.body.offsetHeight-startY+'px',
            //     display:'block'
             });  
        }
    }
});
angular.module('airServiceApp').directive('pagination',function(){
    return{
        restrict:'EA',
        replace:true,
        transclude:true,
        link:function(scope,element,attr){
        },
        templateUrl:'../views/pagination.html'
    }
});
// 创建tab指令
angular.module('airServiceApp').directive('mytab',function(){
    return{
        restrict:'E',
        transclude:true,
        scope:{},
        controller:function($scope){
            var panes=$scope.panes=[];
            $scope.select=function(pane){
                angular.forEach(panes,function(pane){
                    pane.selected=false;
                });
            pane.selected=true;
            };
            this.addPane=function(pane){
                if(panes.length==0){
                    $scope.select(pane);
                }
                panes.push(pane);
            };
        },
        templateUrl:'../views/my-tabs.html'
    };
});
angular.module('airServiceApp').directive('mypane',function(){
    return{
        require:'^mytab',
        restrict:'E',
        transclude:true,
        scope:{
            title:'@'
        },
        link:function(scope,element,attrs,tabsCtrl){
            tabsCtrl.addPane(scope);
        },
        templateUrl:'../views/my-pane.html'
    };
});
angular.module('airServiceApp').directive('allscreen',function($document){
    var isAllscreen=true;
    return{
        restrict:'EA',
        replace:true,
        link:function(scope,element,attr){
            element.bind('click',function(){
                if(isAllscreen)
               { 
                $(this).find('.toolBtn-ico').css({
                    "background":"url(../images/close-allscreen.png) no-repeat"
                });
                 $(this).find('.toolBtn-cont').text("退出全屏");
                 $("#map").css({
                    top:"0px"
                  });
                 isAllscreen=false;
                }
                else
                {
                    $(this).find('.toolBtn-ico').css({
                    "background":"url(../images/ico-6.png) no-repeat"
                   });
                    $(this).find('.toolBtn-cont').text("全屏");
                    $("#map").css({
                        top:"62px"
                      });
                     isAllscreen=true;
                }
            });      

        }
    }
});
angular.module('airServiceApp').directive('city',function(){
    return{
         restrict : 'EA',
         templateUrl: '../views/cityContent.html',
         scope : {
            provinces : '=citysdata',
            isshow : '=showcitys',
            localcity:'=localcity'
        },
        transclude:true,
        replace: true,
        link:function(scope,elem,attrs,ctrl,transclude){
            scope.select=function(mycity){
                scope.localcity=mycity;
                scope.isshow=false;
            }
            scope.closeCity=function(){
                scope.isshow=false;
            }
            transclude(scope.$parent,function(){
                scope.enterSearch=function(keyEvent){
                    if(keyEvent.which==13){
                        scope.localcity=scope.cityName;
                        scope.$parent.mymap.centerAndZoom(scope.cityName,10);
                        scope.isshow=false;
                       
                        //console.log(myprovinces[0].city.length);
                    }
                }
            })
        }
    };
});
angular.module('airServiceApp').directive(
            "test",
            function( $document){
                //将Angular的上下文链接到DOM事件
                var linkFunction = function( $scope, $element, $attributes ){


                    //获得表达式
                    var scopeExpression = $attributes.bnDocumentClick;

                                        //使用$parse来编译表达式
                    var invoker = $parse( scopeExpression );


                    //绑定click事件
                    $document.on(
                        "click",
                        function( event ){


                            //当点击事件被触发时，我们需要再次调用AngularJS的上下文。再次，我们使用$apply()来确保$digest()方法在幕后被调用
                            $scope.$apply(
                                function(){


                                    //在scope中调用处理函数，将jQuery时间映射到$event对象上
                                    invoker(
                                        $scope,
                                        {
                                            $event: event
                                        }
                                    );

                                }
                            );

                        }
                    );


                    //当父控制器被从渲染文档中移除时监听"$destory"事件

                };

                                  //返回linking函数
                return( linkFunction );

            }
        );