angular.module('gbApp')
.controller('gbCtrl', ['$scope','gbAPI', function($scope,gbAPI){
	var flag=true;
	//获取系统服务信息的数据
	gbAPI.introduceInfos.get(function(data){
		$scope.mysystemInfos=data.systemInfo;
	},function(data){
		console.log("error"+data);
	});
	if(flag){
		// $scope.loginstr='#/privacyinfo_true';
			$scope.submit=function(){//在session中判断如果用户名存在时也要进行该操作
				//不使用ng-show指令的原因是因为在刷新的时候会闪现
				// $scope.loginshow='moduleshow';
				// $scope.loginhide='modulehide';
		}
	}else{
		$scope.loginstr='#/';
	}
	$scope.loginbtn=true;
	$scope.toLogin=function(){
		// $scope.loginbtn=false;
	}
}])
.controller('detailinfoCtrl', ['$scope','gbAPI', function($scope,gbAPI){
	//获取联系我们的数据
	gbAPI.contactInfos.get(function(data){
		$scope.mycontactInfos=data;
	},function(data){
		console.log("error"+data);
	});
	//获取情报信息的数据
	// gbAPI.introduceInfos.get(function(data){
	// 	$scope.myprivacyInfos=data.privacyInfo;
	// },function(data){
	// 	console.log("error"+data);
	// });
	//获取系统服务信息的数据
	gbAPI.introduceInfos.get(function(data){
		$scope.mysystemInfos=data.systemInfo;
	},function(data){
		console.log("error"+data);
	});
}])
.controller('publicinfoCtrl', ['$scope', function($scope){
	
}])
.controller('systeminfoCtrl', ['$scope', function($scope){
	
}])
.controller('loginCtrl', ['$scope', function($scope){
}])
.controller('registerCtrl', ['$scope','gbAPI', function($scope,gbAPI){
	
	gbAPI.works.get(function(data){
		$scope.works=data.items;
	},function(data){
		console.log("error"+data);
	});

	$scope.showworks=false;

	$scope.chooseWorks=function(){
		$scope.showworks=true;
	}
	}])