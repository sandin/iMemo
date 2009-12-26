
//唯一的全局变量
__LDS_GLOBAL = {};
__LDS_GLOBAL.baseUrl = '/';  

$(window).load(function(){	

/*------------------------init-----------------------------*/

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

    //冒泡绑定中心
    var bubbleBind = new BubbleBind();
    //帮助函数
    var helper     = new LdsHelper();

/*------------------------index page-----------------------------*/
if ($('body').attr('id').toLowerCase() == 'default')
{
    //设置捕捉器
    bubbleBind.setTarget('#wrap');

    //删除note按钮
    bubbleBind.bind('.n_del a>span','click',function(e){
        var $note   = e.parent().parent().parent();
        var note_id = $note.attr('id').split(':')[1];
        var data    = {note_id:note_id};
        var url     = $('#del_note_url').attr('href');
        $.post(url,data,function(){});
		$note.fadeOut('fast'); 
        $note   = null;
        note_id = null;
        data    = null;
        url     = null;
    });

  //储存category的tab index
  $('#categorys>li').each(function(i){
    $(this).data('i',i);        
  });

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
	  var $current_category_ul_a  = $(ui.tab);  
      helper.setCurrentCategory($current_category_ul_a);
      current_category = null
	}
  });

    //设置当前category
    var current_category_index = $('#main').tabs('option', 'selected');
    var $current_category_ul_a = $('#categorys').find('li>a').eq(current_category_index);
    helper.setCurrentCategory($current_category_ul_a);

  $("#categorys").sortable({axis:'y'});

  var $tab_items = $("#main ul:first li").droppable({
	tolerance: 'pointer',
	accept: ".connectedSortable li",
	hoverClass: "ui-state-hover",
	drop: function(ev, ui) {
        //ul#category>li,拖到的目的地
		var $item = $(this);
        var target_tab_index =  $item.data('i');
        var url   = $('#change_category_url').attr('href');
        var data  = {
            old_category_id : __LDS_GLOBAL.category_id,
            new_category_id : $item.find('a').attr('id').replace('c',''),
            note_id         : $(ui.draggable).attr('id').split(':')[1]
        };

        $.post(url,data,function(){
            //ui.draggale => li.note
		    ui.draggable.hide('slow');
            $('#main').tabsExtra({reload:true,reloadIndex:target_tab_index});
        });
           
        $item = null;
        $list = null;
        url   = null;
        data  = null;
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

	  

