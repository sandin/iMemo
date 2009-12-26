
/** 
 * class BindNotes implements IObserver
 * 
 * @return 
 */
function BindNotes()
{ 
  IObserver.call(this);
}

BindNotes.prototype.update = function(){
  var sThis = this;

  $('.notes_list').each(function(){
	if (!$(this).hasClass('binded'))
	{
	  $(this).addClass('binded');

      // notes sort
      $(this).sortable({
                handle   :   '.n_lable',
                cursorAt : { cursor: 'crosshair',
                             top: -3, left: -3 },
                update   : function(event,ui) {
                   var helper = new LdsHelper();
                   //所有note顺序的id
                   var all_arr        = $(this).sortable('toArray');
                   //当前移动的note id解析
                   var curr_arr       = $(ui.item).attr('id').split(':');
                   //当前移动note_id
                   var curr_note_id   = curr_arr[1];
                   var curr_cate_id   = curr_arr[0];
                   //将category和note的混合id数组解析出只包含note_id的数组
                   var all_notes_arr  = helper.parseIdArray(all_arr,'note_id');
                   //console.log(all_notes_arr,all_arr);
                   //当前移动的note在顺序中的数组索引
                   var curr_index     = arrayIndexOf(all_notes_arr,curr_note_id);
                   //移动后,前一note的id
                   var front_note_id  = all_notes_arr[curr_index - 1];
                   if ((typeof front_note_id) == 'undefined') {
                        front_note_id = null;
                   }

                   //准备需要发送的数据
                   var data = {
                            index    : curr_note_id,
                            front    : front_note_id,
                            categorys: curr_cate_id
                   };
                   sThis.sendSortData(data);
                }
      }); //.disableSelection();
	}//fi
  });//end each


  this.bindState();
  this.bindContent();
}//end function

BindNotes.prototype.sendSortData = function(data)
{
  var url =  $('#sort_note_url').attr('href');
  $.ajax({
	type		: "POST",
	url			: url,
	data		: data,
	beforeSend	: function (XMLHttpRequest) {
	},
	success		: function(msg){
                   //console.log(msg);
	}
  });//end ajax
  url = null;
}

BindNotes.prototype.bindState = function()
{
    $('.n_state>.checkbox').each(function(){
        if (!$(this).hasClass('binded'))
        {
            $(this).addClass('binded');
            $(this).toggle(
                function () {
                    $(this).parent().parent().addClass('done');
                },
                function () {
                    $(this).parent().parent().removeClass('done');
                }
            );


        }//fi
    });//end each
}

BindNotes.prototype.bindContent = function ()
{
// db click to change a note content
  $('.n_content').each(function(){
	if (!$(this).hasClass('binded')) {

        $(this).addClass('binded');
        var $note = $(this).parent();
        var old_content;

        $(this).focus(function(){
            old_content = $(this).text();
        });//edn focus

        $(this).blur(function(){
            var content = $(this).text();
            //确保用户修改了内容
            if (content !== old_content) {
                var note_id =  $note.attr('id').split(":")[1];
                var data    =  {content:content,note_id:note_id};
                var url     =  $('#alter_note_url').attr('href');
                $.post(url,data);
                $note       = null;
                old_content = null;
            }
            content = null;
        });//edn blur
	}//fi
  });//end click
}

