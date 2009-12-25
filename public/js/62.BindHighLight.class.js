/** 
 * class BindHighLight implements IObserver
 * 
 * @return 
 */
function BindHighLight()
{ 
  IObserver.call(this);
}

BindHighLight.prototype.update = function(){
  //将大部分表单初始化为ajaxForm类型
  $('.js_highlight').each(function(){
	if (!$(this).hasClass('binded'))
	{
	  $(this).addClass('binded');
	  $(this).hover(
		function() { $(this).addClass('ui-state-hover'); },
		function() { $(this).removeClass('ui-state-hover'); }
	  ); 
	 }//fi
  });//end each
}

