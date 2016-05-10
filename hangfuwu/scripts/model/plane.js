airService
.factory('plane', [
    function(){
       var plane=function(){
            this.ID="", 
            this.Altitude=0, 
            this.Device=0,
            this.Direction=0,
            this.Owner="", 
            this.Speed=0,
            this.Latitude=0, 
            this.Longitude=0,
            this.LatitudeC=0, 
            this.LongitudeC=0,
            this.Timestamp=0
       };
        plane.prototype.setAltitude=function(altitude){
            this.Altitude=altitude;
       };
       plane.prototype.setID=function(id){
            this.ID=id;
       };
        plane.prototype.setDevice=function(device){
            this.Device=device;
       };
        plane.prototype.setDirection=function(direction){
            this.Direction=direction;
       };
       plane.prototype.setOwner=function(owner){
            this.Owner=owner;
       };
       plane.prototype.setLatitude=function(latitude){
            this.Latitude=latitude;
       };
       plane.prototype.setLongitude=function(longitude){
            this.Longitude=longitude;
       }
        plane.prototype.setLatitudeC=function(latitudec){
            this.LatitudeC=latitudec;
       };
       plane.prototype.setLongitudeC=function(longitudec){
            this.LongitudeC=longitudec;
       }
       plane.prototype.setSpeed=function(speed){
            this.Speed=speed;
       }
        plane.prototype.setTimestamp=function(timestamp){
            this.Timestamp=timestamp;
       }

      
       plane.prototype.getID=function(){
            return this.ID;
       };
       plane.prototype.getAltitude=function(){
            return this.Altitude;
       };
        plane.prototype.getDevice=function(){
            return this.Device;
       };
        plane.prototype.getDirection=function(){
            return this.Direction;
       };
       plane.prototype.getOwner=function(){
            return this.Owner;
       };
       plane.prototype.getLatitude=function(){
           return this.Latitude;
       };
       plane.prototype.getLongitude=function(){
           return this.Longitude;
       };
        plane.prototype.getLatitudeC=function(){
           return  this.LatitudeC;
       };
       plane.prototype.getLongitudeC=function(){
           return this.LongitudeC;
       }
        plane.prototype.getSpeed=function(){
           return this.Speed;
       }
        plane.prototype.getTimestamp=function(){
           return this.Timestamp;
       }
       return plane;
    }
]);