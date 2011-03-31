
/** 
 * class BindAjaxForm implements IObserver
 * 
 * @return 
 */
function BindAjaxForm()
{ 
  IObserver.call(this);
}

BindAjaxForm.prototype.update = function(){
  //将大部分表单初始化为ajaxForm类型
  $('.ajaxForm').each(function(){
	if (!$(this).hasClass('binded'))
	{
	  $(this).addClass('binded');
	  var $target = $(this);
	  var form    = new AjaxForm($('.ajaxForm'));
	  form.factory();
      $target = null;
      form    = null;
	}
  });
}

