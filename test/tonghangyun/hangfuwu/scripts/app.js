'use strict';
/*global angular*/
var airService =angular.module('airServiceApp', [
    'ngAnimate',
     'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',


  ]);

airService.config(['$httpProvider','app',
    function ($httpProvider) {
       $httpProvider.defaults.headers.common['Authorization']="";
    }
])
.run(['app', '$q', '$rootScope', '$location','getFile', 'restAPI','$cookieStore','airporttype','airport','planetype','plane',
       function(app, $q, $rootScope, $location,getFile,restAPI,$cookieStore,airporttype,airport,planetype,plane){

        var global = $rootScope.global = {
                isAdmin: false,
                isEditor: false,
                isLogin: false,
                info: {
                   selectedCity:'北京'
                }
            }

           app.restAPI=restAPI;
           app.rootScope = $rootScope;
           app.Airporttype=airporttype;
           app.Airport=airport;
           app.Planetype=planetype;
           app.Plane=plane;
           app.location = $location;
          
           app.checkUser = function () {
                global.isLogin = !! global.user;
                // global.isAdmin = global.user && global.user.role === 5;
                // global.isEditor = global.user && global.user.role >= 4;
            };
          $rootScope.logout = function () {
            restAPI.logout.put( function () {
                global.user = null;
                app.checkUser();
                $location.path('/');
            });
        };
          
}]);

