
/** 
 * class BindLoginForm implements IObserver
 * 
 * @return 
 */
function BindLoginForm()
{ 
  IObserver.call(this);
}

BindLoginForm.prototype.update = function(){
  var sThis = this;

  var $login_form = $('div#login_form');
  if ($login_form.length < 1 || !$login_form.hasClass('binded')) { 
	$login_form.addClass('binded')
		.dialog({
			width: 340,
			bgiframe: true,
			autoOpen: false,
			modal: true,
			buttons: {
			},
			close: function() {
			}
		});//end dialog
  }//fi

  // ajax - fetch captcha
  var $fetch_captch = $('#ajax-fetch-captcha');
  if (!$fetch_captch.hasClass('binded'))
  {
	$fetch_captch.addClass('binded');
	$fetch_captch.click(function(){
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
    $fetch_captch = null;
  }//fi


  var $input_captcha = $('#input_captcha');
  if (!$input_captcha.hasClass('binded')) 
  {
	$input_captcha.addClass('binded');
	$input_captcha.focus(function(){
      //确保只在第一次点击时自动更新验证码,以后要更新需手动
      if (!$(this).hasClass('once')) {
        $(this).addClass('once');
	    $('#captcha>.loading').slideDown();
	    $('#ajax-fetch-captcha').trigger('click');
      }      
    });
  }//fi
  $input_captcha = null;

  var $goto_register = $('#js_goto_register');
  if (!$goto_register.hasClass('binded')) 
  {
	$goto_register.addClass('binded');
    $goto_register.click(function(){
        $('#js_register').trigger('click');
	    return false;
	});///end click
  }//fi
  $goto_register = null;
  
}//end function
