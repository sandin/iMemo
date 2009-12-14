<?php /* Smarty version 2.6.26, created on 2009-12-14 15:06:42
         compiled from error/error.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Zend Framework Default Application</title>
</head>
<body>
  <h1>An error occurred</h1>
  <h2><?php echo '<?php'; ?>
 echo $this->message <?php echo '?>'; ?>
</h2>

  <?php echo '<?php'; ?>
 if ('development' == APPLICATION_ENV): <?php echo '?>'; ?>


  <h3>Exception information:</h3>
  <p>
      <b>Message:</b> <?php echo '<?php'; ?>
 echo $this->exception->getMessage() <?php echo '?>'; ?>

  </p>

  <h3>Stack trace:</h3>
  <pre><?php echo '<?php'; ?>
 echo $this->exception->getTraceAsString() <?php echo '?>'; ?>

  </pre>

  <h3>Request Parameters:</h3>
  <pre><?php echo '<?php'; ?>
 echo var_export($this->request->getParams(), true) <?php echo '?>'; ?>

  </pre>
  <?php echo '<?php'; ?>
 endif <?php echo '?>'; ?>


</body>
</html>