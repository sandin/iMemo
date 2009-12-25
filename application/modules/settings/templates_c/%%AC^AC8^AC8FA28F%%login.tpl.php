<?php /* Smarty version 2.6.26, created on 2009-12-25 10:17:20
         compiled from index/login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form id="form_login" action="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/login" method="post" title="login">
  <h3 class="title_1"><?php echo $this->_tpl_vars['t']->_('WELCOME'); ?>
 :: <?php echo $this->_tpl_vars['t']->_('LOGIN'); ?>
</h3>
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
	<input name="user" class="text ui-widget-content ui-corner-all" type="text"></input>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['user'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<label for="user"><?php echo $this->_tpl_vars['t']->_('Password'); ?>
</label>
	<input name="password" class="text ui-widget-content ui-corner-all" type="password"></input>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['password'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 
	<label for="captcha"><?php echo $this->_tpl_vars['t']->_('Captcha'); ?>
</label>
	<input id='input_captcha' name="captcha" class="text ui-widget-content ui-corner-all" type="text"></input>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['captcha'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <div id="captcha"><div class="loading hidden"></div></div>
  <a id="ajax-fetch-captcha" class="" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/settings/index/fetch-captcha"><?php echo $this->_tpl_vars['t']->_('change captcha'); ?>
</a>

  <br /><br />

  <input name="submit" class="ui-button js_highlight ui-state-default" type="submit" value="<?php echo $this->_tpl_vars['t']->_('submit'); ?>
"></input>
  <input id="captcha_id" name="captcha_id" type="hidden" value="<?php echo $this->_tpl_vars['captcha_id']; ?>
"></input>
  <br />
  
  <div id="goto_register" class="clearfix">
	<?php echo $this->_tpl_vars['t']->_('Don\'t have a login? '); ?>
 
	<a id="js_goto_register" class="" title="register" href='<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/register'><?php echo $this->_tpl_vars['t']->_('Sign Up'); ?>
</a>
  </div>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>