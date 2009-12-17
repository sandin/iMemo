<?php /* Smarty version 2.6.26, created on 2009-12-18 00:19:41
         compiled from /home/svn/0019/trunk/application/templates/header.tpl */ ?>
<?php if (! isset ( $this->_tpl_vars['noLayout'] )): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Memo - 0019</title>
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/share/jquery/css/smoothness/jquery-ui-1.7.2.custom.css" />
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/css/style.css" />
</head>

<body id="<?php echo $this->_tpl_vars['module']; ?>
">
<div id="wrap">
  <div id="header" class="clearfix">
	<a href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
"><img id="logo" src="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/images/logo.gif" alt="Memo" /></a>
	<ul id="nav">
	  <li><a class="now" href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/'><?php echo $this->_tpl_vars['t']->_('Home'); ?>
</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/blog'><?php echo $this->_tpl_vars['t']->_('Memo'); ?>
</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'><?php echo $this->_tpl_vars['t']->_('Follow'); ?>
</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'><?php echo $this->_tpl_vars['t']->_('Shared'); ?>
</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'><?php echo $this->_tpl_vars['t']->_('Friends'); ?>
</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'><?php echo $this->_tpl_vars['t']->_('Help'); ?>
</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'><?php echo $this->_tpl_vars['t']->_('Contacts'); ?>
</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'><?php echo $this->_tpl_vars['t']->_('About'); ?>
</a></li>
    </ul><!-- /nav -->
	<form id="search" action="/note/search">
	  <input name="search_text" id="search_text" class="grepinput" type="text" value="Search your notes" maxlength="60" size="22" title="search your notes" autocomplete="off"></input>
	  <input id="search_submit" class="submit_1" type="submit" value="" />
	</form>

  </div><!-- /header --> 
  <div id="toolbar" class="clearfix">
	<div id="intro"><a href="">Planning your time,Recording your life.</a></div>
	<div id="message"><span>::message::<a href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/undo"><?php echo $this->_tpl_vars['t']->_('Undo'); ?>
</a></span></div>
	<ul id="user">

	  <?php if ($this->_tpl_vars['user']): ?>
	  <li><a id="logout" href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile/index/logout'><?php echo $this->_tpl_vars['t']->_('Logout'); ?>
</a></li>
	  <li><a id="logout" href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'> / <?php echo $this->_tpl_vars['t']->_('Settings'); ?>
 / </a></li>
	  <li><b><?php echo $this->_tpl_vars['user']->username; ?>
</b></li>

	  <?php else: ?>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/login'><?php echo $this->_tpl_vars['t']->_('Login'); ?>
</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/register'><?php echo $this->_tpl_vars['t']->_('Sign Up Now'); ?>
 / </a></li> 
	  <li><?php echo $this->_tpl_vars['t']->_('Welcome'); ?>
: <?php echo $this->_tpl_vars['t']->_('Guest'); ?>
</li>
	  <?php endif; ?>

	</ul><!-- /user -->

  </div><!-- /toolebar -->
  <div id="content" class="clearfix">

<?php endif; ?>
