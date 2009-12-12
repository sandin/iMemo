function Note(id)
{
  this.id = id || null;
}

/** 
 * 行动调度中心,处理各种命令,如'addNote','delNote'...
 * 
 * @param String command
 * @param String url
 * @param Object(json) data
 * 
 * @return 
 */
Note.prototype.controlCenter = function(command,url,data)
{

  var succesFunction = 'this.' + command + "Succes";
 
  //ajax放送数据,并如果回调函数存在,则调用. 
  $.ajax({
    type:"POST",
    url: url,
    data: data,
    success: function(data, textStatus){
	  //检查回调函数是否存在
	  if (eval(succesFunction) && eval(succesFunction) != null) {
	    eval(succesFunction + '(' + data + ', ' + textStatus + ')');
	  }//end if
	}//end success 
  });//end $.ajax

}

/** 
 * 执行addNote命令时succes状态的回调函数
 * 
 * @param data
 * @param testStatus
 * 
 * @return 
 */
Note.prototype.addNoteSucces = function(data, testStatus)
{
  var noteObject = JSON.parse(data); 
	
  console.log('adding note');
}

Note.prototype.makeOneNote = function (oData){
  var $new_note = $('#js_note_templats').clone(true);
  $new_note.removeAttr('id').removeAttr('style');
  //console.log($new_note);

  $new_note.find('td').not('.n.s').html('');
  $new_note.find('.n_content').html(oData.content);
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


var testNote = new Note();
testNote.controlCenter('addNote');
console.log(2);
testNote.controlCenter('delNote');
