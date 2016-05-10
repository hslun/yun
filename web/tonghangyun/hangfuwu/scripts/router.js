'use strict';
/*global angular, airService*/

airService
.constant('app', {
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
    }
])
.config(['$routeProvider', '$locationProvider', 'getFileProvider',
    function ($routeProvider, $locationProvider, getFileProvider) {
        var boss={
            templateUrl:'guidebook.html',
            },
            index = {
                templateUrl: getFileProvider.html('about.html'),
                controller: 'mapCtrl'
            },
            airportdetail={
                templateUrl: getFileProvider.html('airportdetail.html'),
                controller: 'airportdetailCtrl'
            },
            airportdetail_miyun={
                templateUrl: getFileProvider.html('miyun/airportdetail_miyun.html')
                // controller: 'airportdetailCtrl'
            },
            login = {
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
        when('/', index).
        when('/airportdetail_miyun',airportdetail_miyun).
        when('/airportdetail/:id',airportdetail).
        otherwise({
            redirectTo: '/'
        });
        //$locationProvider.html5Mode(true).hashPrefix('!');
    }
]);