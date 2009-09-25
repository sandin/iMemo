<?php /* Smarty version 2.6.26, created on 2009-09-25 19:40:21
         compiled from /home/svn/0019/trunk/application/templates/header.tpl */ ?>
<?php if (! isset ( $this->_tpl_vars['noLayout'] )): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Memo - 0019</title>
  <link type="text/css" rel="stylesheet" media="all" href="css/style.css" />
  <link type="text/css" rel="stylesheet" media="all" href="share/jquery/css/smoothness/jquery-ui-1.7.2.custom.css" />
</head>

<body id="<?php echo $this->_tpl_vars['module']; ?>
">
<div id="wrap">
  <div id="header" class="clearfix">
	<img id="logo" src="images/logo.gif" alt="Memo" />
	<ul id="nav">
	  <li><a class="now" href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/'>Home</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/blog'>Memo</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'>Follow</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'>Shared</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'>Friends</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'>Help</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'>Contacts</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'>About</a></li>
    </ul><!-- /nav -->
	<form id="search" action="/note/search">
	  <input name="search_text" id="search_text" class="grepinput" type="text" value="Search your notes" maxlength="60" size="22" title="search your notes" autocomplete="off"></input>
	  <input id="search_submit" class="submit_1" type="submit" value="" />
	</form>

  </div><!-- /header --> 
  <div id="toolbar" class="clearfix">
	<div id="intro"><a href="">Save the cheerleader,Save the world.</a></div>
	<div id="message"><span>test test test it's done!</span></div>
	<ul id="user">
	  <?php if ($this->_tpl_vars['user']): ?>
	  <li><a id="logout" href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile/index/logout'>logout</a></li>
	  <li><a id="logout" href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile/index/logout'>setting</a></li>
	  <li>Welcome: <?php echo $this->_tpl_vars['user']->username; ?>
</li>
	  <?php else: ?>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/login'>login</a></li>
	  <li>Welcome: Guest</li>
	  <?php endif; ?>
	</ul><!-- /user -->

  </div><!-- /toolebar -->
  <div id="content" class="clearfix">

<?php endif; ?>