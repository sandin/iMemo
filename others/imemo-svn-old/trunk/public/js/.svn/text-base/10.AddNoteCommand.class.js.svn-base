
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
	    var noteObject = JSON.parse(this.params.responseText); 
	}
	catch(err) 
	{
        var noteObject = {};
        throw 'Error 0x0000: Response data is not a JSON!';
	}
	  var note = new Note();
	  note.makeNoteHTML(noteObject);
      noteObject = null;
      note = null;
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

