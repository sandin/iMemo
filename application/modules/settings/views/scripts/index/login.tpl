<{include file="$APPLICATION_PATH/templates/header.tpl"}>

<h3 class="title_1"><{t}>LOGIN NOW<{/t}></h3>
<form id="form_login" action="" method="post">
  <{if $message}>
	<div class="error">
	  <h4><{t}>Tips:<{/t}></h4>
	  <{foreach from=$message key=name item=value}>
		  <{$name}> : <{$value}>
	  <{/foreach}>
	</div>
  <{/if}>
  <label for="user"><{t}>Name<{/t}></label>
  <input name="user" class="ui-state-default" type="text"></input>
  <{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.user}>
  <br />

  <label for="user"><{t}>Password<{/t}></label>
  <input name="password" class="ui-state-default" type="password"></input>
  <{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.password}>
  <br />

  <label for="captcha"><{t}>Captcha<{/t}></label>
  <input name="captcha" class="ui-state-default" type="text"></input>
  <{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.captcha}>
  <br />
  <br />
  <div id="captcha"><{$captcha}> </div>
  <a id="ajax-fetch-captcha" class="" href="<{$PUBLIC_URL}>/settings/index/fetch-captcha"><{t}>change captcha<{/t}></a>
  <br />
  <br />
  
  <input name="submit" class="ui-button js_highlight ui-state-default" type="submit" value="<{t}>submit<{/t}>"></input>
  <input id="captcha_id" name="captcha_id" type="hidden" value="<{$captcha_id}>"></input>

</form>

<{include file="$APPLICATION_PATH/templates/footer.tpl"}>
