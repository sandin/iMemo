
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
    if (typeof oData.data.dueDate !== 'undefined') {
        $new_note.find('.n_time').html(oData.data.dueDate.time);
        $new_note.find('.n_date').html(oData.data.dueDate.date);
    }
    $('.notes_list:visible').append($new_note);

    $new_note = null;
    id = null;
}  

