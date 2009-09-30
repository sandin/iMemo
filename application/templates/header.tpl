<{if !isset($noLayout)}>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Memo - 0019</title>
  <link type="text/css" rel="stylesheet" media="all" href="<{$PUBLIC_URL}>/share/jquery/css/smoothness/jquery-ui-1.7.2.custom.css" />
  <link type="text/css" rel="stylesheet" media="all" href="<{$PUBLIC_URL}>/css/style.css" />
</head>

<body id="<{$module}>">
<div id="wrap">
  <div id="header" class="clearfix">
	<a href="<{$PUBLIC_URL}>"><img id="logo" src="<{$PUBLIC_URL}>/images/logo.gif" alt="Memo" /></a>
	<ul id="nav">
	  <li><a class="now" href='<{$PUBLIC_URL}>/'><{t}>Home<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>/blog'><{t}>Memo<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>/profile'><{t}>Follow<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>/profile'><{t}>Shared<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>/profile'><{t}>Friends<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>/profile'><{t}>Help<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>/profile'><{t}>Contacts<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>/profile'><{t}>About<{/t}></a></li>
    </ul><!-- /nav -->
	<form id="search" action="/note/search">
	  <input name="search_text" id="search_text" class="grepinput" type="text" value="Search your notes" maxlength="60" size="22" title="search your notes" autocomplete="off"></input>
	  <input id="search_submit" class="submit_1" type="submit" value="" />
	</form>

  </div><!-- /header --> 
  <div id="toolbar" class="clearfix">
	<div id="intro"><a href="">Save the cheerleader,Save the world.</a></div>
	<div id="message"><span>Test <{$t->_('Test')}> test it's <{$t->_('done')}>! <a href="<{$PUBLIC_URL}>/note/undo"><{t}>Undo<{/t}></a></span></div>
	<ul id="user">
	  <{if $user}>
	  <li><a id="logout" href='<{$PUBLIC_URL}>/profile/index/logout'><{t}>Logout<{/t}></a></li>
	  <li><a id="logout" href='<{$PUBLIC_URL}>/profile'> / <{t}>Setting<{/t}> / </a></li>
	  <li><b><{$user->username}></b></li>
	  <{else}>
	  <li><a href='<{$PUBLIC_URL}>/login'><{t}>Login<{/t}></a></li>
	  <li><a href='<{$PUBLIC_URL}>/register'><{t}>Sign Up Now<{/t}> / </a></li> 
	  <li><{t}>Welcome<{/t}>: <{t}>Guest<{/t}></li>
	  <{/if}>
	</ul><!-- /user -->

  </div><!-- /toolebar -->
  <div id="content" class="clearfix">

<{/if}>

