
/** 
 * class BindDelButton implements IObserver
 * 
 * @return 
 */
function BindDelButton()
{ 
  IObserver.call(this);
  this._delAllNote;
}

BindDelButton.prototype.update = function(){
  var sThis = this;

  $('.c_del').each(function(){
	if (!$(this).hasClass('binded'))
	{
	  $(this).addClass('binded');
	  var $tr = $(this).parent();
	  var $a = $(this).children();
	  $a.click(function(){
	  // dialog
	  $('<p>Delete notes of this category?</p>').dialog({
			  title: "Comfirm",
			  bgiframe: true,
			  resizable: false,
			  height:140,
			  modal: true,
			  overlay: {
				  backgroundColor: '#000',
				  opacity: 0.5
			  },
			  buttons: {
				  'Just delete this category': function() {
					sThis._delAllNote = 0
					sThis.ajaxSend($tr,$a);
					$(this).dialog('close');
                    $tr = null;
                    $a  = null;
                    sThis = null;
				  },
				  'Delete notes': function() {
					sThis._delAllNote = 1;
					sThis.ajaxSend($tr,$a);
					$(this).dialog('close');
                    $tr = null;
                    $a  = null;
                    sThis = null;
				  }
			  }
		});
	  });//end click
	}//fi
  });//end each
}//end function

BindDelButton.prototype.ajaxSend = function($tr,$a)
{
  var id   = $tr.find('.c_id').text();
  var url  = $a.attr('href');
  var data = {categorys_id : id,delAllNote:this._delAllNote};
  $.ajax({
	type		: "POST",
	url			: url,
	data		: data,
	beforeSend	: function (XMLHttpRequest) {
	},
	success		: function(msg){
	  //reload tab zoom
	  $('#settings-tabs').tabsExtra({'reload':true});
	}
  });//end ajax
  id   = null;
  url  = null;
  data = null;
}

