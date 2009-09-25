<?php /* Smarty version 2.6.26, created on 2009-09-18 15:56:43
         compiled from /home/lds/test/helloworld/application/templates/header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Zend frameword - helloworld</title>
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/css/style.css" />
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/share/jquery/css/smoothness/jquery-ui-1.7.2.custom.css" />
  <script type="text/javascript" src="share/jquery/js/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="share/jquery/js/jquery-ui-1.7.2.custom.min.js"></script>
  <script type="text/javascript" src="js/all.js"></script>
</head>

<body id="<?php echo $this->_tpl_vars['module']; ?>
">
<div id="wrap">
  <div id="header" class="clearfix">
	<ul id="nav">
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/'>home</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/blog'>blog</a></li>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile'>profile</a></li>
    </ul>
	<ul id="user_toolbar">
	<?php if ($this->_tpl_vars['user']): ?>
	  <li><a id="logout" href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile/index/logout'>logout</a></li>
	  <li>Welcome: <?php echo $this->_tpl_vars['user']->name; ?>
</li>
	<?php else: ?>
	  <li><a href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/login'>login</a></li>
	  <li>Welcome: Guest</li>
	<?php endif; ?>
	</ul>
  </div>
  <hr />
<div id="content">