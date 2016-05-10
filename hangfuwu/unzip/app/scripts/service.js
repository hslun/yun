airService
.factory('restAPI', ['$resource',
    function ($resource) {
        var ip="http://192.168.2.220:5000/v1";
        //var ip2="http://192.168.2.183:5000/v1";
        return {
            //login: $resource(ip2+'/login/'),
            //logout: $resource(ip2+'/logout/',{},{put:{isArray:false,method:'PUT'}}),
            //regist: $resource(ip2+'/user/'),

            weather: $resource(ip+'/weather/:id', {id: '@id'}),
            citys: $resource(ip+'/city'),
            airports: $resource(ip+'/airportname'),
            airportbyname: $resource(ip+'/airportinformation/:id',{id:'@id'}),
            planes:$resource(ip+'/planetypename'),
            planebytype:$resource(ip+'/planetypeinformation/:id',{id:'@id'}),
            calculate: $resource(ip+'/calculate/'),
            aircrafts:$resource(ip+'/aircraft'),
            airporttypes:$resource('../json/airporttypes.json'),
            airportstyle:$resource('../json/airportstyle.json'),
            planestyles:$resource('../json/planestyles.json'),
            planetypes:$resource('../json/planetypes.json'),
            kfinformation:$resource(ip+'/kfinformation'),
            // airports: $resource('../json/airportname.json'),
            // airportbyname: $resource('../json/airportname.json/:id',{id:'@id'}),
            // planes:$resource('../json/planetypename.json'),
            // planebytype:$resource('../json/planetypename.json/:id',{id:'@id'}),
            // airporttypes:$resource('../json/airporttypes.json'),
            // airportstyle:$resource('../json/airportstyle.json'),
            // aircrafts:$resource('../json/planes.json'),
            provinceandcitys:$resource('../json/ProvinceAndCityJson.json')
            
            //tag: $resource('/api/tag/:ID/:OP')
        };
    }
]);