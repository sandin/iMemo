var __LDS_GLOBAL = {};


/*---------------------------------------------------------*/

/** 
 * Class AjaxHelper , Ajax帮助类,Command模式
 * 
 * @param String command
 *
 * @return 
 */
function AjaxHelper(command)
{
  this.command = command || null;
  //this.command = new AddNoteCommand();
  this.params = {};
}

/** 
 * 设置command
 * 
 * @param command
 * 
 * @return 
 */
AjaxHelper.prototype.setCommand = function(command)
{
  this.command = command;
}

AjaxHelper.prototype.assignFunction = function(requestFunction)
{
  //确认回调函数是否存在
  if (eval(requestFunction) && eval(requestFunction) != null) {
	return eval(requestFunction + '();');
  }
}

/** 
 * 回调函数工厂,分配各种命令各状态下的回调函数
 * 调用的函数命名采用骆峰形式:
 * 
 * @param Object params, 回调函数需要的参数
 * params = [command,status,statusText,statusText]
 * 
 * @return 
 */
AjaxHelper.prototype.callback = function(params)
{
  this.params = params;
  this.command.setParams(params);

  var requestFunction = 'this.command.' + params.status;
  //console.log(requestFunction);
  return this.assignFunction(requestFunction);
 
}

/** 
 * AJAX格外数据工厂
 * ajaxForm只能传递input数据,有时则需要向服务器附送发送格外的数据
 * 调用的函数命名采用骆峰形式,格式如下:
 * command + 'ExtraData'
 *  
 * @param params
 * 
 * @return 
 */
AjaxHelper.prototype.getExtraData = function(params)
{
  var requestFunction = 'this.command.getExtraData';
  return this.assignFunction(requestFunction);
}

/** 
 * 读取AJAX的执行状态
 * 
 * @return String
 */
AjaxHelper.prototype.getStatus = function ()
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
AjaxHelper.prototype.getResponse = function ()
{
  if (this.params.responseText) {
	return this.params.responseText;
  }
}



/*--------------------------------------------------------*/
/** 
 * class Note
 * 
 * @param note_id
 * 
 * @return 
 */
function Note(note_id)
{
  this.note_id = note_id;
}

/** 
 * 根据note模板新建一个note的HTML,并更新到视图
 * 
 * @param Object oData
 * 
 * @return void
 */
Note.prototype.makeNoteHTML = function (oData)
{
  var $new_note = $('#js_note_template>li').clone(true);
  $new_note.removeAttr('id').removeAttr('style');
  //console.log($new_note);

  $new_note.find('td').not('.n.s').html('');
  $new_note.find('.n_del>form>.note_id').attr('value',oData.data.note_id);
  //console.log( $new_note.find('.n_del>form>.note_id') );
  
  $new_note.find('.n_content').html(oData.data.content);
  $('.notes_list:visible').prepend($new_note);
}  


/*---------------------------------------------------*/
/** 
 * class Output
 * 
 * @return 
 */
function Output()
{

}

/** 
 * 新建input的HTML,如果指定了target则直接append其中.
 * 
 * @param name
 * @param value
 * @param $target
 * 
 * @return 
 */
Output.prototype.makeInputHTML = function(name, value, $target)
{
  var $new_input = $('<input type="hidden"></input>');
  $new_input.attr('name',name);
  $new_input.attr('value',value);
  if ($target && $target.length != 0) {
	$target.append($new_input);
  }
}

/*-----------------------------------------------------*/
function CommandFactory(commandType)
{
  var command = ucwords(commandType);
  command += 'Command';

  //确认所请求的Command类是存在的
  if (eval('typeof ' + command + ' != "undefined"')) {
	return eval('new ' + command + '()');
  } else {
	//如果不存在,则返回一个超类做替代,超类不调用任何回调函数
	return new Command();
  }
}


/** 
 * class Command
 * Command的超类
 * 
 * @param params
 * 
 * @return 
 */
function Command(params)
{
  this.params = params || {};
}

Command.prototype.setParams = function(params)
{
  this.params = params;
}


/** 
 * class AddNoteCommand extends Command
 * 
 * @param params
 * 
 * @return 
 */
function AddNoteCommand(params)
{
  Command.call(this);
  this.name = 'addNote';
}
AddNoteCommand.prototype = new Command();

/** 
 * Command addNote,Status success 回调函数
 * 
 * @return 
 */
AddNoteCommand.prototype.success = function()
{
  if (this.params.statusText && this.params.statusText.toLowerCase() == 'success') {
	try 
	{
	  //console.log(this.params.ajax.responseText,'responseText');
	  var noteObject = JSON.parse(this.params.responseText); 
	  var note = new Note();
	  note.makeNoteHTML(noteObject);
	}
	catch(err) 
	{
	  txt =	 'Error: Response data is not a JSON!\n\n';
	  txt += 'Code: 0x0000;\n\n';
	  txt += 'Error name: ' + err.name + '\n\n';
	  txt += 'Error message: ' + err.message + '\n\n';
	  txt += 'Description: ' + err.description + '\n\n';
	  
	  if (console && console != null) {
		console.log(txt);
	  } else {
		alert(txt);
	  }
	}
  }
}

AddNoteCommand.prototype.beforeSubmit = function()
{
  var note_content = $('.ajax-add-note',this.params.jqForm).attr('value');

  //如果用户没有输入任何内容,则取消Ajax请求
  if (note_content == 'undefined' || note_content == '')
  {
	return false;
  }
}
/** 
 * Command addNote的extra data
 * 包含categorys,
 * 
 * @return Object
 */
AddNoteCommand.prototype.getExtraData = function()
{
  //var category = $('.cate:visible').attr('title');
  //return {categorys:category};
}


/*====================================================================*/

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
						  'options' : options,
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


/*==================================================================*/

//首字大写
function ucwords(str)
{
  return str.replace(/\b\w+\b/g, function(word) {
	return word.substring(0,1).toUpperCase( ) +	word.substring(1);
	});
}
