<?php /* Smarty version 2.6.26, created on 2009-12-21 17:22:52
         compiled from category/index.tpl */ ?>
<div title="<?php echo $this->_tpl_vars['category_name']; ?>
" class="cate">
  <ul class="notes_list clearfix connectedSortable">
	<?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['item']):
?>
	  <?php $this->assign('nid', $this->_tpl_vars['item']['note_id']); ?>
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/note.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endforeach; endif; unset($_from); ?>  </ul><!-- /notes_list -->
</div><!-- /cate -->