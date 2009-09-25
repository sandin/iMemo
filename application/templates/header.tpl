{if !isset($noLayout)}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Memo - 0019</title>
  <link type="text/css" rel="stylesheet" media="all" href="share/jquery/css/smoothness/jquery-ui-1.7.2.custom.css" />
  <link type="text/css" rel="stylesheet" media="all" href="css/style.css" />
</head>

<body id="{$module}">
<div id="wrap">
  <div id="header" class="clearfix">
	<img id="logo" src="images/logo.gif" alt="Memo" />
	<ul id="nav">
	  <li><a class="now" href='{$PUBLIC_URL}/'>Home</a></li>
	  <li><a href='{$PUBLIC_URL}/blog'>Memo</a></li>
	  <li><a href='{$PUBLIC_URL}/profile'>Follow</a></li>
	  <li><a href='{$PUBLIC_URL}/profile'>Shared</a></li>
	  <li><a href='{$PUBLIC_URL}/profile'>Friends</a></li>
	  <li><a href='{$PUBLIC_URL}/profile'>Help</a></li>
	  <li><a href='{$PUBLIC_URL}/profile'>Contacts</a></li>
	  <li><a href='{$PUBLIC_URL}/profile'>About</a></li>
    </ul><!-- /nav -->
	<form id="search" action="/note/search">
	  <input name="search_text" id="search_text" class="grepinput" type="text" value="Search your notes" maxlength="60" size="22" title="search your notes" autocomplete="off"></input>
	  <input id="search_submit" class="submit_1" type="submit" value="" />
	</form>

  </div><!-- /header --> 
  <div id="toolbar" class="clearfix">
	<div id="intro"><a href="">Save the cheerleader,Save the world.</a></div>
	<div id="message"><span>Test test test it's done!</span></div>
	<ul id="user">
	  {if $user}
	  <li><a id="logout" href='{$PUBLIC_URL}/profile/index/logout'>Logout</a></li>
	  <li><a id="logout" href='{$PUBLIC_URL}/profile/index/logout'>Setting</a></li>
	  <li>Welcome: {$user->username}</li>
	  {else}
	  <li><a href='{$PUBLIC_URL}/login'>Login</a></li>
	  <li>Welcome: Guest</li>
	  {/if}
	</ul><!-- /user -->

  </div><!-- /toolebar -->
  <div id="content" class="clearfix">

{/if}
