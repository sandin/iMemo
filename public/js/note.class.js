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
  this.ajax = {};
}

/** 
 * 行动调度中心,处理各种命令,如'createNote','delNote'...
 * 
 * @param String command
 * @param String url
 * @param Object(json) data
 * 
 * @return 
 */
Note.prototype.controlCenter = function(command,url,data)
{
  //保留指针
  var thisNote = this;
  var successFunction = 'thisNote.' + command + "Success";
 
  //ajax放送数据,并如果回调函数存在,则调用. 
  $.ajax({
    type:"POST",
    url: url,
    data: data,
    success: function(data, textStatus){
	  thisNote.ajax.data = data;
	  thisNote.ajax.textStatus = textStatus;
	  //确认回调函数是否存在
	  if (eval(successFunction) && eval(successFunction) != null) {
	    eval(successFunction + '();');
	  }
	} 
  });

}

Note.prototype.getStatus = function ()
{
  return this.ajax.testStatus;
}

Note.prototype.getData = function ()
{
  return this.ajax.data;
}

/** 
 * 执行addNote命令时succes状态的回调函数
 * 
 * @param data
 * @param testStatus
 * 
 * @return 
 */
Note.prototype.createNoteSuccess = function()
{
  if (this.ajax.data && this.ajax.data != null) {
	try 
	{
	  var noteObject = JSON.parse(this.ajax.data); 
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

Note.prototype.makeNoteHTML = function (oData){
  var $new_note = $('#js_note_templats').clone(true);
  $new_note.removeAttr('id').removeAttr('style');
  //console.log($new_note);

  $new_note.find('td').not('.n.s').html('');
  $new_note.find('.n_id').html(oData.data.note_id);
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
