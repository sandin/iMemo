<{include file="$APPLICATION_PATH/templates/header.tpl"}>

<form id="form_login" action="<{$PUBLIC_URL}>/login" method="post" title="login">
  <h3 class="title_1"><{t}>WELCOME<{/t}> :: <{t}>LOGIN<{/t}></h3>
  <{if $message}>
	<div class="error">
	  <h4><{t}>Tips:<{/t}></h4>
	  <{foreach from=$message key=name item=value}>
		  <{$name}> : <{$value}>
	  <{/foreach}>
	</div>
  <{/if}>

	<label for="user"><{t}>Name<{/t}></label>
	<input name="user" class="text ui-widget-content ui-corner-all" type="text"></input>
	<{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.user}>

	<label for="user"><{t}>Password<{/t}></label>
	<input name="password" class="text ui-widget-content ui-corner-all" type="password"></input>
	<{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.password}>
 
	<label for="captcha"><{t}>Captcha<{/t}></label>
	<input id='input_captcha' name="captcha" class="text ui-widget-content ui-corner-all" type="text"></input>
	<{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.captcha}>

  <div id="captcha"><{*$captcha*}><div class="loading hidden"></div></div>
  <a id="ajax-fetch-captcha" class="" href="<{$PUBLIC_URL}>/settings/index/fetch-captcha"><{t}>change captcha<{/t}></a>

  <br /><br />

  <input name="submit" class="ui-button js_highlight ui-state-default" type="submit" value="<{t}>submit<{/t}>"></input>
  <input id="captcha_id" name="captcha_id" type="hidden" value="<{$captcha_id}>"></input>
  <br />
  
  <div id="goto_register" class="clearfix">
	<{t}>Don\'t have a login? <{/t}> 
	<a id="js_goto_register" class="" title="register" href='<{$PUBLIC_URL}>/register'><{t}>Sign Up<{/t}></a>
  </div>

</form>

<{include file="$APPLICATION_PATH/templates/footer.tpl"}>
