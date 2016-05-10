'use strict';
/*global angular*/
var  user=angular.module('userApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
  ]);
user.config(['$httpProvider','userapp',
      function ($httpProvider) {
          $httpProvider.defaults.headers.common['Authorization']="";
     }])
    .run(['userapp', '$q', '$rootScope', '$location','getFile', 'restAPI',
       function(app, $q, $rootScope, $location, getFile,restAPI){
           app.restAPI=restAPI;
           app.location = $location;
     }]);

user.constant('userapp', {
    version: Date.now()
    })
    .provider('getFile', [
        function () {
          this.html = function (fileName) {
              return 'views/' + fileName;
          };
          this.md = function (fileName) {
              return '/app/md/' + fileName;
          };
          this.$get = function () {
              return {
                  html: this.html,
                  md: this.md
              };
          };
  }])
    .config(['$routeProvider', '$locationProvider', 'getFileProvider',
        function ($routeProvider, $locationProvider, getFileProvider) {
               var login = {
                    templateUrl: getFileProvider.html('login.html'),
                    controller: 'userLoginCtrl'
                },
                register = {
                    templateUrl: getFileProvider.html('register.html'),
                    controller: 'userRegisterCtrl'
                };
                $routeProvider.
                when('/login', login).
                when('/register', register).
                when('/', login).
                otherwise({
                    redirectTo: '/'
                });
                //$locationProvider.html5Mode(true).hashPrefix('!');
  }]);

user.controller('userLoginCtrl', ['userapp', '$scope','$cookieStore',
      function (userapp, $scope,$cookieStore) {
              var restAPI = userapp.restAPI.login;
              $scope.submit = function () {
                  if (true) {
                      var data = $scope.login;
                      data.log_time = Date.now();
                      data.passwd = CryptoJS.SHA256(data.passwd).toString();
                      data.passwd = CryptoJS.HmacSHA256(data.passwd, 'jsGen').toString();
                      data.passwd = CryptoJS.HmacSHA256(data.passwd, data.id + ':' + data.log_time).toString();
                      restAPI.save({
                        
                      }, data, function (data) {
                            window.sessionStorage["userInfo"] = JSON.stringify(data);
                            window.location.href='http://192.168.2.15:8000/#/';
                      }, function (data) {console.log(data);
                       
                      });
                  }
            };
  }])
    .controller('userRegisterCtrl', ['userapp', '$scope',
        function (userapp, $scope) {
             var restAPI = userapp.restAPI.regist;
             $scope.submit = function () {
                  if (true) {
                      var data = $scope.regist;
                      data.passwd = CryptoJS.SHA256(data.passwd).toString();
                      data.passwd = CryptoJS.HmacSHA256(data.passwd, 'jsGen').toString();
                      restAPI.save({
                        
                      }, data, function (data) {
                        console.log(data);
                          // app.rootScope.global.user = data.data;
                          // app.checkUser();
                          // $scope.$destroy();
                         // app.location.path('/home');
                      }, function (data) {console.log(data);
                          // $scope.reset.type = data.error.name;
                          // $scope.reset.title = app.locale.RESET[data.error.name];
                      });
                  }
            };
   }]);

user.factory('restAPI', ['$resource',
        function ($resource) {
            return {
                login: $resource('http://192.168.2.183:5000/v1/login/'),
                // login: $resource('http://192.168.2.183:5000/v1/login/');
                //logout: $resource('http://192.168.2.144:5001/logout/'),
                regist: $resource('http://192.168.2.144:5001/v1/user/')
            };
    }]);

