airService
.factory('airporttype', [
    function(){
       var airporttype=function(){
             this.name='';
             this.airports=[];
             this.minzoom=0;
             this.maxzoom=0;
       };
       airporttype.prototype.addAirport=function(airport){
           if(airport.airport_type==this.name)
            {
              this.airports.push(airport);
            }
       };
       airporttype.prototype.addAirports=function(airports){
           for(var i=0;i<airports.length;i++){
              this.addAirport(airports[i]);
           }
       };
       airporttype.prototype.getAirports=function(){
           return this.airports;
       }
       airporttype.prototype.getAirportsCount=function(){
           return this.airports.length;
       }
       return airporttype;
    }
]);
