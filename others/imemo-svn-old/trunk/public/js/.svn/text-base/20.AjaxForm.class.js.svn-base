
/** 
 * AjaxForm构造器,负责将一个普通form构造成ajax-form
 * 
 * @param String targetObj, jQuery选择器 
 * 
 * @return 
 */
function AjaxForm(targetObj)
{
  this.$_targetObj = targetObj;
  this._URL = targetObj.attr('action');
  this._command = '';
}

/** 
 * 构造工厂
 * 
 * @return 
 */
AjaxForm.prototype.factory = function() 
{
  if (this.$_targetObj.length != 0) { 
	var options = this.makeAjaxFormOptions();
	//console.log(options);
    this.$_targetObj.addClass('binded').ajaxForm(options);
  }
}

/** 
 * Options构造器,为factory中的初始ajaxform提供options
 *
 * 根据Form的action属性(URL地址),判断请求命令类型,
 * 并利用AjaxHelper.callback智能分配各状态下的回调函数.
 * 
 * @return 
 */
AjaxForm.prototype.makeAjaxFormOptions = function()
{
  var command = this.parseURL(this._URL);
  //console.log(command);
  var c = new CommandFactory(command);
  var ajaxHelper = new AjaxHelper(c);

  var options = { 
	// target element(s) to be updated with server response 
	//target:        '#null', 
	beforeSubmit:  function(formData, jqForm, options)
				   {
					return ajaxHelper.callback({
						  'status'  : 'beforeSubmit',
						  'formData': formData,
						  'jqForm'  : jqForm,
						  'options' : options
						 });
				   },
	success:       function(responseText, statusText)
				   {
					 return ajaxHelper.callback({
						  'status'      : 'success',
						  'responseText': responseText,
						  'statusText'  : statusText
						 });
					}, 
	data:		    ajaxHelper.getExtraData(),
    beforeSend:     function(XMLHttpRequest)
					{
					  return ajaxHelper.callback({
						  'status'		  : 'beforeSend',
						  'XMLHttpRequest': 'XMLHttpRequest'
						  });
					},
   //dataType: 'json',

	// other available options: 
	//url:       url         // override for form's 'action' attribute 
	//type:      type        // 'get' or 'post', override for form's 'method' attribute 
	//dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
	clearForm: true        // clear all form fields after successful submit 
	//resetForm: true        // reset the form after successful submit 

	// $.ajax options can be used here too, for example: 
	//timeout:   3000 
  }; //options

  return options;
} 

AjaxForm.prototype.parseURL = function()
{
  var result = '';

  var arr = this._URL.split('/');
  //含下划线字符串
  var str = arr[arr.length-1];

  if (str.search('_') == -1) {
	result = str;
  } else {
	//分离单词
	var arr2 = str.split('_');
	for (var i = 0; i< arr2.length; i++) {
	  //首个单词无需大写转换
	  if (i == 0) {
		result += arr2[i];
	  } else {
		result += ucwords(arr2[i]);
	  }
	}

  }//if
  //返回驼峰形式
  return result;
}

