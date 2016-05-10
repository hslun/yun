angular.module('gbApp').factory('gbAPI', ['$resource', 
	function($resource){
		var ip='';
		return {
			contactInfos:$resource('../../../json/contactInfo.json'),
			introduceInfos:$resource('../../../json/introduceInfo.json'),
			permissionList:$resource('../../../json/userRole.json'),
			works:$resource('../../../json/works.json')
		};
	}
])