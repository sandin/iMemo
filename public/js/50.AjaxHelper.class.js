
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

