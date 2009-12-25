
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
      noteObject = null;
      note = null;
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

/** 
 * beforSubmit
 * 
 * @return 
 */
AddNoteCommand.prototype.beforeSubmit = function()
{
  var note_content = $('.ajax-add-note',this.params.jqForm).attr('value');

  //如果用户没有输入任何内容,则取消Ajax请求
  if (note_content == 'undefined' || note_content == '')
  {
	return false;
  }
  note_content = null;
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

