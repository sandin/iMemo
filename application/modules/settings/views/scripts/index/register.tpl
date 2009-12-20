<{include file="$APPLICATION_PATH/templates/header.tpl"}>
<{*debug*}>
<h3 class="title_1"><{t}>WELCOME<{/t}> :: <{t}>REGISTER<{/t}></h3>
<form id="form_login" action="" method="post">
  <{if $message}>
	<div class="error">
	  <h4><{t}>Tips:<{/t}></h4>
		<ul>
		  <{foreach from=$message key=name item=value}>
		  <li><{$name}> : <{$value}></li>	
		  <{/foreach}>
		</ul>
	</div>
  <{/if}>
  <label for="email"><{t}>Email<{/t}></label>
  <input name="email" class="ui-state-default" type="text"></input>
  <{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.email}>
  <br />

  <label for="password"><{t}>Password<{/t}></label>
  <input name="password" class="ui-state-default" type="password"></input>
  <{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.password}>
  <br />

  <label for="repassword"><{t}>Confirm Password<{/t}></label>
  <input name="repassword" class="ui-state-default" type="password"></input>
  <{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.repassword}>
  <br />
  <br />
  
  <input name="submit" type="submit" class="ui-button js_highlight ui-state-default ui-corner-all" value="<{t}>submit<{/t}>"></input>

</form>

<{include file="$APPLICATION_PATH/templates/footer.tpl"}>
