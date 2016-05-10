function dragCtrl($scope){
	var bool=false;
	var offsetX=0;
	var offsetY=0;
	$scope.dragOver=function(){
		//$scope.css('cursor','move');
	}
   $scope.dragDown=function(){
   	bool=true;
   	offsetX=event.offsetX;
   	offsetY=event.offsetY;
   }
   $scope.dragMove=function(){
   if(!bool)
   return;
   var x=event.clientX-offsetX;
   var y=event.clientY-offsetY;   	
   }
}