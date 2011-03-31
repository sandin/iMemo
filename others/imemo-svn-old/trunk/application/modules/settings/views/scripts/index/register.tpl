<{include file="$APPLICATION_PATH/templates/header.tpl"}>
<{*debug*}>
<form id="form_login" action="<{$PUBLIC_URL}>register" method="post">
	<h3 class="title_1"><{t}>WELCOME<{/t}> :: <{t}>REGISTER<{/t}></h3>
	<{if isset($message)}>
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
	<input name="email" class="text ui-widget-content ui-corner-all" type="text"></input>
	<{if isset($message.email)}>
	<{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.email}>
	<{/if}>
	<br />

	<label for="password"><{t}>Password<{/t}></label>
	<input name="password" class="text ui-widget-content ui-corner-all" type="password"></input>
	<{if isset($message.password)}>
	<{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.password}>
	<{/if}>
	<br />

	<label for="repassword"><{t}>Confirm Password<{/t}></label>
	<input name="repassword" class="text ui-widget-content ui-corner-all" type="password"></input>
	<{if isset($message.repassword)}>
	<{include file="$APPLICATION_PATH/templates/error.tpl" error=$message.repassword}>
	<{/if}>
	<br />
	<br />

	<input name="submit" type="submit" class="ui-button js_highlight ui-state-default ui-corner-all" value="<{t}>submit<{/t}>"></input>

</form>

<{include file="$APPLICATION_PATH/templates/footer.tpl"}>
