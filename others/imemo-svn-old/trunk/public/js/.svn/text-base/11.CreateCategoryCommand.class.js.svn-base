
/** 
 * class CreateCategoryCommand extends Command
 * 
 * @param params
 * 
 * @return 
 */
function CreateCategoryCommand(params)
{
  Command.call(this);
  this.name = 'addNote';
}
CreateCategoryCommand.prototype = new Command();

/** 
 * Status success 回调函数
 * 
 * @return 
 */
CreateCategoryCommand.prototype.success = function()
{
  if (this.params.statusText && this.params.statusText.toLowerCase() == 'success') {
	try 
	{
	  //console.log(this.params.ajax.responseText,'responseText');
	  var noteObject = JSON.parse($.trim(this.params.responseText)); 
	  if (noteObject.data) {
		//reload tab zoom
		$('#settings-tabs').tabsExtra({'reload':true});
	  }
      noteObject = null;
	}
	catch(err) 
	{
	  throw 'Error 0x0000: Response data is not a JSON!';
	}
  }
}

CreateCategoryCommand.prototype.beforeSubmit = function()
{
}

CreateCategoryCommand.prototype.getExtraData = function()
{
}

