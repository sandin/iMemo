<{if !isset($noLayout)}>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Memo - 0019</title>
  <link type="text/css" rel="stylesheet" media="all" href="<{$PUBLIC_URL}>share/jquery/css/lds/jquery-ui-1.7.2.custom.css" />
  <link type="text/css" rel="stylesheet" media="all" href="<{$PUBLIC_URL}>css/style.css" />
</head>

<body id="<{$module}>">
<div id="wrap">
  <div id="header" class="clearfix">
	<a href="<{$PUBLIC_URL}>"><img id="logo" src="<{$PUBLIC_URL}>images/logo.gif" alt="Memo" /></a>
	<ul id="nav">
	  <li><a class="now" href='<{$PUBLIC_URL}>'><{t}>Home<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>shared'><{t}>Shared<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>friends'><{t}>Friends<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>projects'><{t}>Projects<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>help'><{t}>Help<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>about'><{t}>About<{/t}></a></li>
    </ul><!-- /nav -->
	<form id="search" action="/note/search">
	  <input name="search_text" id="search_text" class="grepinput" type="text" value="Search your notes" maxlength="60" size="22" title="search your notes" autocomplete="off"></input>
	  <input id="search_submit" class="submit_1" type="submit" value="" />
	</form>

  </div><!-- /header --> 
  <div id="toolbar" class="clearfix">
	<div id="intro"><a href="">Planning your time,Recording your life.</a></div>
	<div id="message"><span>::message::<a href="<{$PUBLIC_URL}>note/undo"><{t}>Undo<{/t}></a></span></div>
	<ul id="user">

	  <{if $user}>
	  <li><a id="logout" href='<{$PUBLIC_URL}>logout'><{t}>Logout<{/t}></a></li>
	  <li><a id="logout" href='<{$PUBLIC_URL}>settings'> / <{t}>Settings<{/t}> / </a></li>
	  <li><b><{$user->username}></b></li>

	  <{else}>
	  <li><a class="js_login" id="login" title="login" href='<{$PUBLIC_URL}>login'><{t}>Login<{/t}></a></li>
	  <li><a class="js_login" id="js_register" title="register" href='<{$PUBLIC_URL}>register'><{t}>Sign Up Now<{/t}> / </a></li> 
	  <li><{t}>Welcome<{/t}>: <{t}>Guest<{/t}></li>
	  <{/if}>

	</ul><!-- /user -->

  </div><!-- /toolebar -->
  <div id="content" class="clearfix">

<{/if}>

