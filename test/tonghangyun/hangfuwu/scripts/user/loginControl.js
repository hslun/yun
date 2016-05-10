'use strict';

/*
 * @ngdoc function
 * @name loginApp.controller:LoginCtrl
 * @description
 * # LoginCtrl
 * Controller of the loginApp
 */
user
.controller('userLoginCtrl', ['app', '$scope',
  function (app, $scope) {
    var restAPI = app.restAPI.login;
	 $scope.submit = function () {
            if (true) {
                var data = $scope.login;
                data.log_time = Date.now();
                data.passwd = CryptoJS.SHA256(data.passwd).toString();
                alert(data.passwd);
                data.passwd = CryptoJS.HmacSHA256(data.passwd, 'jsGen').toString();
                console.log(data.passwd);
                data.passwd = CryptoJS.HmacSHA256(data.passwd, data.id + ':' + data.log_time).toString();
                console.log(data.passwd);

                restAPI.save({
                  
                }, data, function (data) {
                	console.log(data);
                	$scope.passwd='';
                    // app.rootScope.global.user = data.data;
                    // app.checkUser();
                    // $scope.$destroy();
                   // app.location.path('/home');
                  // $window.location.href='http://localhost:9090/#about/';
                }, function (data) {console.log(data);
                	$scope.login={
                          passwd:''
	                       };
                    // $scope.reset.type = data.error.name;
                    // $scope.reset.title = app.locale.RESET[data.error.name];
                });
            }
        };
}])
.controller('userRegisterCtrl', ['app', '$scope',
    function (app, $scope) {
     var restAPI = app.restAPI.regist;
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
