/** 
 * Class Note
 * 
 * @param String id
 * 
 * @return 
 */
function Note(id)
{
  this.id = id || null;
  this.params = {};
}

/** 
 * 回调函数工厂,分配各种命令各状态下的回调函数
 * 
 * @param Object params, 回调函数需要的参数
 * params = [command,status,statusText,statusText]
 * 
 * @return 
 */
Note.prototype.callback = function(params)
{
  this.params = params;

  //保留指针
  var thisNote = this;
  var requestFunction = 'thisNote.' + params.command + params.status;
  //console.log(requestFunction);
 
  //确认回调函数是否存在
  if (eval(requestFunction) && eval(requestFunction) != null) {
	eval(requestFunction + '();');
  }

}

/** 
 * 读取AJAX的执行状态
 * 
 * @return String
 */
Note.prototype.getStatus = function ()
{
  if (this.params.statusText) {
	return this.params.statusText;
  }
}

/** 
 * 读取AJAX返回的数据
 * 
 * @return 
 */
Note.prototype.getResponse = function ()
{
  if (this.params.responseText) {
	return this.params.responseText;
  }
}

Note.prototype.addNoteBeforeSubmit = function()
{
  var note_data = this.params.formData[0].value;
  console.log(note_data);
}

/** 
 * 执行addNote命令时succes状态的回调函数
 * 
 * @param responseText
 * @param statusText
 * 
 * @return 
 */
Note.prototype.addNoteSuccess = function()
{
  if (this.params.statusText && this.params.statusText.toLowerCase() == 'success') {
	try 
	{
	  //console.log(this.params.ajax.responseText,'responseText');
	  var noteObject = JSON.parse(this.params.responseText); 
	  this.makeNoteHTML(noteObject);
	}
	catch(err) 
	{
	  txt =	 'Error: Response data is not a JSON!\n\n';
	  txt += 'Code: 0x0000;\n\n';
	  txt += 'Description: ' + err.description + '\n\n';
	  
	  if (console && console != null) {
		console.log(txt);
	  } else {
		alert(txt);
	  }
	}
  }
}

/** 
 * 根据note模板新建一个note的HTML,并更新到视图
 * 
 * @param Object oData
 * 
 * @return void
 */
Note.prototype.makeNoteHTML = function (oData){
  var $new_note = $('#js_note_templats').clone(true);
  $new_note.removeAttr('id').removeAttr('style');
  //console.log($new_note);

  $new_note.find('td').not('.n.s').html('');
  $new_note.find('.n_del>form>.note_id').attr('value',oData.data.note_id);
  console.log( $new_note.find('.n_del>form>.note_id') );
  
  $new_note.find('.n_content').html(oData.data.content);
  $('.notes_list:visible').prepend($new_note);
}  

/*
 继承实例
function ClassB(sColor,sName) {
ClassA.call(this,sColor);
this.name = sName;      
this.arr = ['a3','a4'];
}
*/


/*============================================
 *
 * =========================================*/

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
    this.$_targetObj.ajaxForm(options);
  }
}

/** 
 * Options构造器,为factory中的初始ajaxform提供options
 *
 * 根据Form的action属性(URL地址),判断请求命令类型,
 * 并利用Note.callback智能分配各状态下的回调函数.
 * 
 * @return 
 */
AjaxForm.prototype.makeAjaxFormOptions = function()
{
  var command = this.parseURL(this._URL);
  //console.log(command);
  var note = new Note();

  var options = { 
	// target element(s) to be updated with server response 
	//target:        '#null', 
	beforeSubmit:  function(formData, jqForm, options)
				   {
					 note.callback({
						  'command' : command,
						  'status'  : 'BeforeSubmit',
						  'formData': formData,
						  'jqForm'  : jqForm,
						  'options' : options
						 });
				   },
	success:       function(responseText, statusText)
				   {
					 note.callback({
						  'command'     : command,
						  'status'      : 'Success',
						  'responseText': responseText,
						  'statusText'  : statusText
						 });
					}, 

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


/*===============================================*/

//首字大写
function ucwords(str)
{
  return str.replace(/\b\w+\b/g, function(word) {
	return word.substring(0,1).toUpperCase( ) +	word.substring(1);
	});
}
