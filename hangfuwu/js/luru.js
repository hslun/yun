// 收缩展开效果
$(document).ready(function(){
	var luru=null;
	//$("div.luru_nr").hide();//默认隐藏div，或者在样式表中添加.text{display:none}，推荐使用后者
	$(".luru h3 span").click(function(){
		$(this).parent().next(".luru_nr").slideToggle("slow");
		$(this).toggleClass("shou");
	})
	$(".luru_nr p .sub").click(function(){
		$(this).parent().parent(".luru_nr").slideToggle("slow");
		$(this).parent().parent().prev().children("span").toggleClass("shou");
	})
	$("#rad32_1").click(function(){
		$("#luru3").css("display","block");
		$("#luru4").css("display","none");
	})
	$("#rad32_2").click(function(){
		$("#luru4").css("display","block");
		$("#luru3").css("display","none");
	})
	$("#rad32_3").click(function(){
		$("#luru4").css("display","block");
		$("#luru3").css("display","block");
	})
	$(".jia").click(function(){
		//var jia=$(this).parent().prev().attr("class");//这里获取class值;
		//var array=jia.split(" ");//split双引号里面是空格，把class值用空格分开，转换为数组
		//if(luru==null){
			var divOld =$(this).parent().prev();
		//}else{
			//var divOld = luru;
		//}
		var newDiv = divOld.clone(true);		
		divOld.after(newDiv);
		var No = parseInt(divOld.find("font").html())+1;   //假设你用p标签显示序号
		newDiv.find("font").html(No);	
	})
	$(".jian").click(function() { // del为删除input的id
		var divOld =$(this).parent().parent();
		if(parseInt(divOld.find("font").html())==1){
			luru=divOld.clone(true);	
		}else{
			$(this).parent().parent().remove();
		}
	});
});	
 function click_scroll(nu) {
  var scroll_offset = $("#tiao"+nu).offset();  //得到pos这个div层的offset，包含两个值，top和left
  $("body,html").animate({
   scrollTop:scroll_offset.top  //让body的scrollTop等于pos的top，就实现了滚动
   },1000);
 }
 
 function diqu(){
	if($("#rad0_1").attr("checked") == "checked"){
		$(".huadong").css("display","block");
		$(".qita").css("display","none");
	}else{
		$(".huadong").css("display","none");
		$(".qita").css("display","block");
		//未选中时的操作
	} 	 
 }
	
