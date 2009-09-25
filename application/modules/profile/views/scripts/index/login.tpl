{include file="$APPLICATION_PATH/templates/header.tpl"}

<h3 class="title_1">PLEASE LOGIN</h3>
<form id="form_login" action="" method="post">
  {if $message}
	<div class="error">
	  <h4>Tips:</h4>
	  {foreach from=$message key=name item=value}
		  {$name} : {$value}
	  {/foreach}
	</div>
  {/if}
  <label for="user">name</label>
  <input name="user" type="text"></input>
  {include file="$APPLICATION_PATH/templates/error.tpl" error=$message.user}
  <br />

  <label for="user">password</label>
  <input name="password" type="password"></input>
  {include file="$APPLICATION_PATH/templates/error.tpl" error=$message.password}
  <br />

  <label for="captcha">captcha</label>
  <input name="captcha" type="text"></input>
  {include file="$APPLICATION_PATH/templates/error.tpl" error=$message.captcha}
  <div id="captcha">{$captcha} </div>
  <a id="ajax-fetch-captcha" href="{$PUBLIC_URL}/profile/index/fetch-captcha">change captcha</a>
  <br />
  
  <input name="submit" type="submit" value="submit"></input>
  <input id="captcha_id" name="captcha_id" type="hidden" value="{$captcha_id}"></input>

</form>

{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}
{include file="$APPLICATION_PATH/templates/footer.tpl"}
