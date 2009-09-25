/*---------------- function ---------------------*/ 


/** 
 * add a new note by ajax when keydown [ENTER] 
 * 
 * @param jquery-object $target 
 * 
 * @return 
 */
  function addNoteBindKeyDown($target)
  {
   
   var $addNote = $target.keydown(function(e){
	// console.log(e.keyCode);
	// bug-001 linux scim(拼音) sometimes 090925	
   if (e.keyCode == 13) {
	  var data = $(this).attr('value');
	  var json = {
		data : data
	  };
	  function postFunc(data,textStatus)
	  {	
		$addNote.attr('value',''); 
		return false; 
	  }
	  function preFunc()
	  {
		var obj = {content: data};
		makeNoteHTML(obj);
	  }
	  ajaxAddNote(preFunc,postFunc,json);
	}
	});  
  }

 /** 
  * ajax to add/modify a new note
  * 
  * @param function func (ajax success function(data, textStatus))
  * 
  * @return 
  */
 function ajaxAddNote(preFunc,postFunc,data)
 {
  preFunc();
		  
  if ($(this).hasClass('real')) {
	var url = $(this).attr('src');
  } else {
	var url = $('.ajax-add-note.real').attr('src');
  }

  $.ajax({
	type:"POST",
  	url: url,
	data: data,
	success: postFunc 
  });
 }

 /** 
  *	make note Html 
  * 
  * @param json obj 
  * 
  * @return  void
  */
 function makeNoteHTML(obj){
	var $new_note = $('#js_note_templats>li').clone();
	$new_note.find('.n_c').html(obj.content);
	$('.notes_list:visible').prepend($new_note);
  }

/*-------------------------------------------------------------*/

$(function(){
  
  ///////////////////////////////////////////////////////	
	
  $note = $('.note');

  // notes sort
  $(".notes_list").sortable({
	  handle: '.n_l',
	  cursorAt: { cursor: 'crosshair', top: -3, left: -3 },
  });//.disableSelection();

  // tabs && drop to tabs
  $tabs =  $("#main").tabs({
	selected: 0 
  });

  $tabs.find(".ui-tabs-nav").sortable({axis:'y'});

  var $tab_items = $("ul:first li",$tabs).droppable({
	tolerance: 'pointer',
	accept: ".connectedSortable li",
	hoverClass: "ui-state-hover",
	drop: function(ev, ui) {
		var $item = $(this);
		var $list = $($item.find('a').attr('href')).find('.connectedSortable');

		ui.draggable.hide('slow', function() {
			// auto change tab on/off
			$tabs.tabs('select', $tab_items.index($item));
			$(this).prependTo($list).show('slow');

		});
	}
  });

  /////////////////////////////////////////////////////////

  // db click to change a note content
  $('.n_c').dblclick(function(){
	if (!$(this).hasClass('editing')) {
	  var $td = $(this);
	  $(this).addClass('editing');
	  var old_html = $(this).html();
	  var new_html = '<input id="editContent" class="ajax-add-note" value="' +
					  old_html +
					  '"></input>';
	  $(this).html(new_html);
	  
	  var $editContent = $('#editContent').bind('blur',function(){
		  var value = $(this).attr('value');
		  var data = {
			data: value
		  };
		  $(this).replaceWith(value);
		  $td.removeClass('editing');
		  //::lds:: save content ajax
		  ajaxAddNote(null,null,data);
		})
		$editContent.focus();
		addNoteBindKeyDown($editContent);
	}
  })
  


  //$('.n_c').TextAreaExpander(); 

  // date picker
  $(".datepicker").datepicker({
	dateFormat: 'yy-mm-dd',
	showOn: 'button',
   	buttonImage: 'images/icon_calendar.gif',
   	//buttonImageOnly: true
  });



  /////////////////////////////////////////////////////////
	
  $("#nav").sortable();
  $("#tabs").tabs();

  // logout dialog
  $("#logout").click(function(){
	var url = $(this).attr('href');
	$('<p>Are you sure?</p>').dialog({
			title:	"Comfirm",
			bgiframe: true,
			resizable: false,
			height:140,
			modal: true,
			overlay: {
				backgroundColor: '#000',
				opacity: 0.5
			},
			buttons: {
				'Comfirm': function() {
					location.href = url;
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
	  });
	return false;
  });

  ////////////////////////////////////////////////////////
  
  // ajax - fetch captcha
  $('#ajax-fetch-captcha').click(function(){
	  var url = $(this).attr('href');
	  $.ajax({
		type:"POST",
		dataType:"json",
		url: url ,
		success: function(data,textStatus) {
		  var dataObj = eval('(' + data + ')');
		  $('#captcha').empty().append(dataObj.captcha_html);
		  $('#captcha_id').attr('value', dataObj.captcha_id);
		}	
	  });
	return false; 
	});//.trigger('click');	  

  // bind add note
  addNoteBindKeyDown($('.ajax-add-note')); 

  $('ul#icons li,#search_submit').hover(
	function() { $(this).addClass('ui-state-hover'); },
	 function() { $(this).removeClass('ui-state-hover'); }
  ); 


}); //end funtcion


$(window).load(function(){	

}); //end window load
