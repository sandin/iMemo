
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
  $login_form = null;

  /** 
   * 无法用冒泡完成 一般元素不支持submit绑定
   * 
   * @param '#form_login'
   * 
   * @return 
   */
  var $form_login = $('#form_login');
  if (!$form_login.hasClass('binded')) { 
	$form_login.addClass('binded')
        .submit(function(){
            var help = new LdsHelper();
            var $password_input = $(this).find('input[name=password]');
            var password    =  $password_input.attr('value');
            var newPassword =  help.makePassword(password);
            $password_input.attr('value',newPassword);

            var $rePassword_input = $(this).find('input[name=repassword]');
            if ($rePassword_input.length > 0) {
                var rePassword    =  $rePassword_input.attr('value');
                var newRePassword =  help.makePassword(rePassword);
                $rePassword_input.attr('value',newRePassword);
            }
            
           //console.log(newPassword);
           //console.log(newRePassword);
           //return false;       
         });
  
  }


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
