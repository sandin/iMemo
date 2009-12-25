
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
	  var noteObject = JSON.parse(this.params.responseText); 
	  if (noteObject.data) {
		//reload tab zoom
		$('#settings-tabs').tabsExtra({'reload':true});
	  }
      noteObject = null;
	}
	catch(err) 
	{
	  var txt =	 'Error: Response data is not a JSON!\n\n';
	  txt += 'Code: 0x0000;\n\n';
	  txt += 'Error name: ' + err.name + '\n\n';
	  txt += 'Error message: ' + err.message + '\n\n';
	  txt += 'Description: ' + err.description + '\n\n';
	  
	  if (console && console != null) {
		console.log(txt);
	  } else {
		alert(txt);
	  }
      txt = null;
	}
  }
}

CreateCategoryCommand.prototype.beforeSubmit = function()
{
}

CreateCategoryCommand.prototype.getExtraData = function()
{
}

