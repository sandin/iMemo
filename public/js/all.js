
/*-------------------------------------------------------------*/

$(window).load(function(){	

  //唯一的全局变量
   __LDS_GLOBAL = {};

  //事件普通绑定中心(观察模式),负责需要重复绑定的对象
  var bindCenter = new BindCenter();
  var bindAjaxform = new BindAjaxForm();

  bindCenter.addObserver(bindAjaxform);
  bindCenter.notify();


  //事件冒泡绑定中心,用于ajax新载内容的事件绑定
  $('#content').click(function(e){

	  //删除按钮
	  var $n_del = $(e.target).parent().parent().parent();
	  if ($n_del.hasClass('n_del')) {
		$form = $n_del.find('.del_note_form');
		$note = $form.parent().parent();
		//console.log($form);
		//console.log($note);
		$form.trigger('submit'); 
		//隐藏删除内容
		$note.fadeOut('fast'); 
	  } 
	
	});//冒泡


  // notes sort
  $(".notes_list").sortable({
	  handle: '.n_lable',
	  cursorAt: { cursor: 'crosshair', top: -3, left: -3 },
  });//.disableSelection();

  

  // tabs && drop to tabs
  $tabs =  $("#main").tabs({
	//selected: 0,
	panelsTarget : '#js_panelsTarget',
	spinner: 'Retrieving data...',
	cache: true,
	cookie: {expires: 30,name:'ui-tab'},
    select: function(event, ui) { 
	  //loadding icon
	  //切换category时将当前category name存入全局变量
	  var current_category  = ui.tab.text;   
	  //console.log( current_category);
	  __LDS_GLOBAL.category = current_category;
	  //也存入note_00.input[js_current_category]中,用于addNote时发送给服务器
	  $('#js_current_category').attr('value',current_category);
	}
  });


  function setCurrentCategory()
  {
    var current_category_index = $tabs.tabs('option', 'selected');
    var current_category = 
  	$('#categorys').find('li>a').eq(current_category_index).text();

	__LDS_GLOBAL.category = current_category;
	//console.log(__LDS_GLOBAL.category);
	$('#js_current_category').attr('value',__LDS_GLOBAL.category);
	//console.log($('#js_current_category').attr('value') );
  }
  setCurrentCategory();
  /*
  //读取URL中的#cate-1部分,并切换至
  var hash = window.location.hash;
  if (hash != '') {
	var arr = hash.split('-');
	var num = parseInt(arr[1]);
	num--;
	if (typeof num == 'number') {
	  //console.log(num);
	  $tabs.tabs('select',num);
	}
  }
  */

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



  /*-----------------------------------------------------------*/
	
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
	  //console.log(new Date(),'start');
	})
//	.ajaxSend(function(){
//	  $('span',this).html('Loading');
	  //console.log(new Date(),'send');
//	})
	.ajaxSuccess(function(){
	  //给新载入的内容绑定事件处理函数
	  bindCenter.notify();
	  $(this).fadeOut();
	  //console.log(new Date(),'success');
	})
	.ajaxError(function(){
	  $('span',this).html('Error');
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
