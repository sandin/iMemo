



/*-------------------------------------------------------------*/

$(window).load(function(){	

  //将大部分表单初始化为ajaxForm类型
  $('.ajaxForm').each(function(){
	var $target = $(this);
	var form = new AjaxForm($target);
	form.factory();
  });

 //del note buttom, click模拟submit 
  $('.del_note_form>a').each(function(){
	$(this).click(function(){
	  $form = $(this).parent();
	  $note = $form.parent().parent();

	  $form.trigger('submit'); 
	  //隐藏删除内容
	  $note.fadeOut('fast'); 
    });
	
  });




  // notes sort
  $(".notes_list").sortable({
	  handle: '.n_lable',
	  cursorAt: { cursor: 'crosshair', top: -3, left: -3 },
  });//.disableSelection();

  // tabs && drop to tabs
  $tabs =  $("#main").tabs({
	selected: 0,
    select: function(event, ui) { 
	  //切换category时将当前category name存入全局变量
	  var current_category  = $(ui.panel).attr('title');   
	  __LDS_GLOBAL.category = current_category;
	  //也存入note_00.input[js_current_category]中,用于addNote时发送给服务器
	  $('#js_current_category').attr('value',current_category);
	}
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


  // db click to change a note content
  $('.n_content').click(function(){
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


  $('ul#icons li,#search_submit,.ui-lds-icon').hover(
	function() { $(this).addClass('ui-state-hover'); },
	 function() { $(this).removeClass('ui-state-hover'); }
  ); 

  //message conter
  $('#message')
	.ajaxStart(function(){
	  $(this).fadeIn();
	  $('span',this).html('Loading');
	})
	.ajaxSend(function(){
	  $('span',this).html('Loading');
	})
	.ajaxSuccess(function(){
	  $('span',this).html('It\'s done.');	
	  $(this).fadeOut();
	})
	.ajaxError(function(){
	  $('span',this).html('Error.');
	});
  
  //main search input 主搜索效果
  $('#search_text').focus(function(){
	var originalText = $(this).attr('value');
	$(this).attr('value','');
	$(this).blur(function(){
	  var text = $(this).attr('value');
	  if (text == null || text == '' || text == originalText ) {
		$(this).attr('value',originalText);	
	  }
	});
  });



}); //end window load

/*-------------------------------------------------------*/

$(window).ready(function(){

});//end window ready
