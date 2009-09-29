<?php /* Smarty version 2.6.26, created on 2009-09-29 18:51:48
         compiled from index/login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h3 class="title_1"><?php echo $this->_tpl_vars['t']->_('LOGIN NOW'); ?>
</h3>
<form id="form_login" action="" method="post">
  <?php if ($this->_tpl_vars['message']): ?>
	<div class="error">
	  <h4><?php echo $this->_tpl_vars['t']->_('Tips:'); ?>
</h4>
	  <?php $_from = $this->_tpl_vars['message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['value']):
?>
		  <?php echo $this->_tpl_vars['name']; ?>
 : <?php echo $this->_tpl_vars['value']; ?>

	  <?php endforeach; endif; unset($_from); ?>
	</div>
  <?php endif; ?>
  <label for="user"><?php echo $this->_tpl_vars['t']->_('Name'); ?>
</label>
  <input name="user" type="text"></input>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['user'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <br />

  <label for="user"><?php echo $this->_tpl_vars['t']->_('Password'); ?>
</label>
  <input name="password" type="password"></input>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['password'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <br />

  <label for="captcha"><?php echo $this->_tpl_vars['t']->_('Captcha'); ?>
</label>
  <input name="captcha" type="text"></input>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['captcha'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div id="captcha"><?php echo $this->_tpl_vars['captcha']; ?>
 </div>
  <a id="ajax-fetch-captcha" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/profile/index/fetch-captcha"><?php echo $this->_tpl_vars['t']->_('change captcha'); ?>
</a>
  <br />
  
  <input name="submit" type="submit" value="<?php echo $this->_tpl_vars['t']->_('submit'); ?>
"></input>
  <input id="captcha_id" name="captcha_id" type="hidden" value="<?php echo $this->_tpl_vars['captcha_id']; ?>
"></input>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>