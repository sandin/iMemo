
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
    var id = oData.data.category_id + ":" + oData.data.note_id;

    $new_note.removeAttr('id').removeAttr('style');
    $new_note.attr('id',id);
    //console.log($new_note);

    $new_note.find('td').not('.n.s').html('');

    $new_note.find('.n_content').html(oData.data.content);
    //如果提供了到期时间
    if (typeof oData.data.dueDate !== 'undefined') {
        //设置时间
        $new_note.find('.n_time').attr('value',oData.data.dueDate.time).removeClass('c_min');
        //如果提供了dateHuman(人读日期)
        if (typeof oData.data.dueDate.dateHuman !== 'undefined') {
            var newDate = oData.data.dueDate.dateHuman;
        } else {
            var newDate = oData.data.dueDate.date;
        }
        //设置日期
        $new_note.find('.n_date').attr('value',newDate).removeClass('c_min');
    }
    $('.notes_list:visible').append($new_note);

    $new_note = null;
    id = null;
}  


