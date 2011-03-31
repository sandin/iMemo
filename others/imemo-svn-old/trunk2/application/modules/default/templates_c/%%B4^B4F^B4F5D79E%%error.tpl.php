<?php /* Smarty version 2.6.26, created on 2009-12-30 14:38:35
         compiled from error/error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'debug', 'error/error.tpl', 11, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Zend Framework Default Application</title>
</head>
<body>
  <h1>Error.</h1>

  <?php echo $this->_tpl_vars['message']; ?>

  <?php echo smarty_function_debug(array(), $this);?>

</body>
</html>