<?php /* Smarty version 2.6.26, created on 2009-12-27 13:38:32
         compiled from index/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="main" class="clearfix">

  <div id="settings-tabs">
	<ul>
	  <li><a href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/settings/profile"><?php echo $this->_tpl_vars['t']->_('Preferences'); ?>
</a></li>
	  <li><a href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/settings/profile"><?php echo $this->_tpl_vars['t']->_('Profile'); ?>
</a></li>
	  <li><a href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/settings/categorys"><?php echo $this->_tpl_vars['t']->_('Categorys'); ?>
</a></li>
	  <li><a href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/settings/profile"><?php echo $this->_tpl_vars['t']->_('Tags'); ?>
</a></li>
	</ul>
</div>


</div>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>