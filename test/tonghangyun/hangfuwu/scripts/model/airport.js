airService
.factory('airport', [
    function(){
       var airport=function(){
            this.address="", 
            this.airport_name="", 
            this.airport_type="", 
            this.latitude=0, 
            this.longitude=0
       };
       airport.prototype.getName=function(){
            return this.airport_name;
       };
       airport.prototype.getLatitude=function(){
           return this.latitude;
       };
       airport.prototype.getLongitude=function(){
           return this.longitude;
       }
       return airport;
    }
]);