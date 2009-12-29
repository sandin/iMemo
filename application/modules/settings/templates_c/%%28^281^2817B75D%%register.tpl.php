<?php /* Smarty version 2.6.26, created on 2009-12-29 13:23:44
         compiled from index/register.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form id="form_login" action="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/register" method="post">
<h3 class="title_1"><?php echo $this->_tpl_vars['t']->_('WELCOME'); ?>
 :: <?php echo $this->_tpl_vars['t']->_('REGISTER'); ?>
</h3>
  <?php if ($this->_tpl_vars['message']): ?>
	<div class="error">
	  <h4><?php echo $this->_tpl_vars['t']->_('Tips:'); ?>
</h4>
		<ul>
		  <?php $_from = $this->_tpl_vars['message']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['value']):
?>
		  <li><?php echo $this->_tpl_vars['name']; ?>
 : <?php echo $this->_tpl_vars['value']; ?>
</li>	
		  <?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
  <?php endif; ?>
  <label for="email"><?php echo $this->_tpl_vars['t']->_('Email'); ?>
</label>
  <input name="email" class="text ui-widget-content ui-corner-all" type="text"></input>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['email'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <br />

  <label for="password"><?php echo $this->_tpl_vars['t']->_('Password'); ?>
</label>
  <input name="password" class="text ui-widget-content ui-corner-all" type="password"></input>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['password'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <br />

  <label for="repassword"><?php echo $this->_tpl_vars['t']->_('Confirm Password'); ?>
</label>
  <input name="repassword" class="text ui-widget-content ui-corner-all" type="password"></input>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/error.tpl", 'smarty_include_vars' => array('error' => $this->_tpl_vars['message']['repassword'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <br />
  <br />
  
  <input name="submit" type="submit" class="ui-button js_highlight ui-state-default ui-corner-all" value="<?php echo $this->_tpl_vars['t']->_('submit'); ?>
"></input>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>