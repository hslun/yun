airService
.factory('planetype', [
    function(){
       var planetype=function(){
             this.name='';
             this.minzoom=5,
             this.maxzoom=19,
             this.planes=[];
             this.owner=0;
       };
       planetype.prototype.addPlane=function(plane){
           if(plane.Owner==this.owner)
            {
              this.planes.push(plane);
            }
       };
       planetype.prototype.addPlanes=function(planes){
           for(var i=0;i<planes.length;i++){
              this.addPlane(planes[i]);
           }
       };
       planetype.prototype.getPlanes=function(){
           return this.planes;
       }
       planetype.prototype.getPlanesCount=function(){
           return this.planes.length;
       }
       return planetype;
    }
]);
