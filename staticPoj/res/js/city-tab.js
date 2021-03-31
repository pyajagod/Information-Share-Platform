window.onload = function(){
	var aDiv = getClass(document,'.izk-city-list');
	var	oUl = getClass(document,'.izk-city-nav')[0],
	   aBtn = getTagName(oUl,'li');	   
	var timer = null,t = 0,b = 0;	
		
	fnAutoPlay(aDiv[5])
	
	//自动播放每一组播放完回调自已切换下一组
	function fnAutoPlay(e,n){
		var aLi = getTagName(e,'li'),
			 aP = getTagName(e,'p');
		var n = n||0;
		fnActive(aLi,aP,n%aLi.length)
		timer = setInterval(function(){
			n++	
			b = n
			fnActive(aLi,aP,n%aLi.length)			
			if(n%aLi.length === 0){
				clearInterval(timer)
				t++					
				fnActive(aBtn,aDiv,t%aDiv.length)
				fnAutoPlay(aDiv[t%aDiv.length])		
			}
		},10000)		
	}	
	
	for(var i = 0; i < aDiv.length; i++){
		fnMouse(aDiv[i])
	}
	
	//鼠标移入停止播放	
	function fnMouse(e){
		var aLi = getTagName(e,'li'),
			 aP = getTagName(e,'p'),
			 aImg = getTagName(e,'img');
		for(var i = 0; i < aLi.length; i++){
			(function(index){
				aP[index].onmouseover = aLi[index].onmouseover = function(){	
					clearInterval(timer)
					fnActive(aLi,aP,index)
				}
				aP[index].onmouseout = aLi[index].onmouseout = function(){
					fnAutoPlay(e,index)						
				}
			})(i)			
		}
	}
	
	function fnActive(ele,ele2,n){
		for(var i = 0 ; i < ele.length; i++) {
			ele[i].className = ''
			ele2[i].style.display = 'none'
		}		
		ele[n].className = 'cur'
		ele2[n].style.display = 'block'
	}
	
	//主菜单移入事件 如果不是选中状态清0 当前下的所有li的Active清空,默认第一个选中
	//主菜单移开事件 如果当前选中状态记录N的值，移开后继续从N开始
	for(var i = 0; i < aBtn.length; i++){
		(function(index){
			aBtn[index].onmouseover = function(){				
				clearInterval(timer)
				if(aBtn[index].className != 'cur'){
					b = 0
					var aLi = getTagName(aDiv[index],'li')
					var  aP = getTagName(aDiv[index],'p')
					fnActive(aLi,aP,b)			
				}
				fnActive(aBtn,aDiv,index)
			}
			aBtn[index].onmouseout = function(){
				fnAutoPlay(aDiv[index],b)
				t = index				
			}
		})(i)		
	}	
}