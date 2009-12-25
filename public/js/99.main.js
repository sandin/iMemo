
$(window).load(function(){	

/*------------------------init-----------------------------*/
  //唯一的全局变量
   __LDS_GLOBAL = {};
   __LDS_GLOBAL.baseUrl = '/';  

  //绑定中心初始化
    var bindCenter = new BindCenter();
  //注册绑定
    bindCenter.addObserver(new BindHighLight)
			.addObserver(new BindAjaxForm)
			.addObserver(new BindDelButton)
			.addObserver(new BindNotes)
			.addObserver(new BindLoginForm);


  //执行全部绑定
  bindCenter.notify();
/*------------------------index page-----------------------------*/
if ($('body').attr('id').toLowerCase() == 'default')
{


  //事件冒泡绑定中心,用于ajax新载内容的事件绑定
    $('#content').click(function(e){

	  //删除按钮
	  var $n_del = $(e.target).parent().parent().parent();
	  if ($n_del.hasClass('n_del')) {
		var $form = $n_del.find('.del_note_form');
		var $note = $form.parent().parent();
		//console.log($form);
		//console.log($note);
		$form.trigger('submit'); 
		//隐藏删除内容
		$note.fadeOut('fast'); 
        $from = null;
        $note = null;
	  } 
      $n_del = null;

	});//冒泡


  // tabs && drop to tabs
  $("#main").tabs({
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
     current_category = null
	}
  });


  function setCurrentCategory()
  {
    var current_category_index = $('#main').tabs('option', 'selected');
    var current_category = 	$('#categorys').find('li>a').eq(current_category_index).text();

	__LDS_GLOBAL.category = current_category;
	//console.log(__LDS_GLOBAL.category);
	$('#js_current_category').attr('value',__LDS_GLOBAL.category);
	//console.log($('#js_current_category').attr('value') );
    current_category = null;
    current_category_index = null;
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

  $("#categorys").sortable({axis:'y'});

  var $tab_items = $("#main ul:first li").droppable({
	tolerance: 'pointer',
	accept: ".connectedSortable li",
	hoverClass: "ui-state-hover",
	drop: function(ev, ui) {
		var $item = $(this);
		var $list = $($item.find('a').attr('href')).find('.connectedSortable');

		ui.draggable.hide('slow', function() {
			// auto change tab on/off
			$('#main').tabs('select', $('#main ul:first li').index($item));
			$(this).prependTo($list).show('slow');
		});//end hide
        $item = null;
        $list = null;
	}
  });
  $tab_items = null;


  //$('.n_c').TextAreaExpander(); 

  // date picker
  $(".datepicker").datepicker({
	dateFormat: 'yy-mm-dd',
	showOn: 'button',
   	buttonImage: 'images/icon_calendar.gif'
   	//buttonImageOnly: true
  });




}//end index page

/*-------------------all page-----------------------------------*/


  $("#settings-tabs").tabs({
	cookie: {expires: 30,name:'settings-tab'}
  });


  //message conter
  $('#message')
	.ajaxStart(function(){
	  $(this).fadeIn();
	  $('span',this).html('Loading');
	  //console.log(new Date(),'start');
	})
	.ajaxSend(function(){
	  $('span',this).html('Loading');
	  //console.log(new Date(),'send');
	})
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
	  if (text === null || text === '' || text == originalText ) {
		$(this).attr('value',originalText);	
        originalText = null;
	  }
      text = null;
	});//end blur
  });//end focus


  $("#nav").sortable();


/*-----------------------------------------------------------*/
	

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
                    url = null;
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
	  });
	return false;
  });//end click

  ////////////////////////////////////////////////////////
  
 
  //登录按钮
  $('.js_login').each(function(){
	$(this).click(function() {
	  var $url = $(this).attr('href');
	  var title = $(this).attr('title');
	  var $login_form = $('div#login_form');

	  //如果载入过,而且载入的内容相同,则直接打开dialog
	  if ($login_form.length > 0 && $login_form.attr('title') == title ) {
		$login_form.dialog('open');
	  } else {
		//如果没有载入过,则新建载入的容器
		if ($login_form.length < 1) {
		  $login_form = $('<div id="login_form"></div>');
		  $('body').append($login_form);
		} 
		//标记载入的目标,用于以后判断
		$login_form.attr('title',title);

		//ajax请求html并载入到容器中
		$login_form.load($url + " #form_login",{},function(){
		  $('div#login_form').dialog('open');
		  //为了绑定change captcha按钮
		  bindCenter.notify();
		});//end load
	  }//fi
      
      $url  = null;
      title = null;
      $login_form = null;
	  return false;
	});//end click
  });//end each


}); //end window load
/*-------------------------------------------------------*/

$(window).ready(function(){
 
});//end window ready

	  

