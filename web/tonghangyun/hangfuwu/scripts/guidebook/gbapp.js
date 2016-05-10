'use strict';
var permissionList;
// angular.element(document).ready(function(){
//   $.get('../json/userRole.json',function(data){
//       permissionList=data.hfga.permissionList;
//       angular.bootstrap(document,['gbApp']);
//   })
// });
var gbapp=angular.module('gbApp',[
	'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch'
 ]);
/**
   * if route change then check if user has permission
   */
//   gbapp.run(['$rootScope','$location','gbAPI','angularPermission', function($rootScope,$location,gbAPI,angularPermission){
//     gbAPI.permissionList.get(function(data){
// 		$rootScope.userPermissionList=data.hfga.permissionList;
// 	},function(data){
// 		console.log("error"+data);
// 	});
//     angularPermission.setPermissions($rootScope.userPermissionList);
//     $rootScope.$on('$routeChangeStart', function(event, next, current) {
//       var permission = next.$$route.permission;
//       if(angular.isString(permission) && !angularPermission.hasPermission(permission)){
//         // here I redirect page to '/unauthorized',you can edit it
//         $location.path('/unauthorized');
//       }
//     });
//   }])

//   /**
//    * factory service provide permission data set and check
//    */
//   gbapp.factory('angularPermission', ['$rootScope',function ($rootScope) {
//     var userPermissionList;
//     return {
//       setPermissions: function(permissions) {
//         userPermissionList = permissions;
//         $rootScope.$broadcast('permissionsChanged')
//       },
//       hasPermission: function (permission) {
//         if(userPermissionList.indexOf(permission.trim()) > -1){
//           return true;
//         }else{
//           return false;
//         }
//       }
//    };
// }]);
gbapp.provider('getFile',[
	function(){
		this.html=function(fileName){
			return '../../views/'+fileName;
		};
		this.$get=function(){
			return{
				html:this.html
			};
		};
	}
])
gbapp.config(['$routeProvider','$locationProvider','getFileProvider',
	function($routeProvider,$locationProvider,getFileProvider){
		var privacyinfo={
			templateUrl:getFileProvider.html('privacyinfo.html'),
			controller:'detailinfoCtrl'
		},
		publicinfo={
			templateUrl:getFileProvider.html('publicinfo.html'),
			controller:'publicinfoCtrl',
			permission:'edit'
		},
		systeminfo={
			templateUrl:getFileProvider.html('systeminfo.html'),
			controller:'systeminfoCtrl'
		},
		privacyinfo_true={
			templateUrl:getFileProvider.html('privacyinfo_true.html')
		},
		login={
			templateUrl:getFileProvider.html('guidebooklogin.html'),
			controller:'loginCtrl'
		},
		register={
			templateUrl:getFileProvider.html('guidebookregister.html'),
			controller:'registerCtrl'
		},
		error = {
			templateUrl:getFileProvider.html('error.html')
		};
		$routeProvider
		.when('/',privacyinfo)
		.when('/publicinfo',publicinfo)
		.when('/systeminfo',systeminfo)
		.when('/privacyinfo_true',privacyinfo_true)
		.when('/unauthorized',error)
		.when('/login',login)
		.when('/register',register)
		.otherwise({redirectTo:'/'});
	}]);

