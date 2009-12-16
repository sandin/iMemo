<?php /* Smarty version 2.6.26, created on 2009-12-16 21:26:14
         compiled from index/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['user']): ?>

<div id="main" class="clearfix">

  <ul id="categorys" class="sidebar">
	<li><a href="#cate-1">Inbox</a></li>
	<li><a href="#cate-2">Today</a></li>
	<li><a href="#cate-2">Next</a></li>
	<li><a href="#cate-2">Maybe</a></li>
	<li><a href="#cate-2">Projects</a></li>
	<li><a href="#cate-2">Areas</a></li>

	<?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['cate_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cate_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cate_name'] => $this->_tpl_vars['cate_data']):
        $this->_foreach['cate_loop']['iteration']++;
?>
	<li><a href="#cate-<?php echo $this->_foreach['cate_loop']['iteration']; ?>
"><?php echo $this->_tpl_vars['cate_name']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
  </ul><!-- /categorys (sidebar) -->

  <div id="innerContent"> 
	<!-- main input -->
	<div id="note_00" class="note clearfix">
	  <form name="add_note_form" id="add_note_form" class="ajaxForm" action="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/add_note" method="post">
		<div class="n_col n_content editing">
		  <input name="note-data" class="ajax-add-note real" type="text" autocomplete="off" src="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/add_note"></input></div>
		<div class="n_col n_submit">
		  <input name="n_submit" type="submit" value="Submit!"></input>
		</div>
	  </form>
	</div><!-- /note_00(addNote) --> 
	
	<!-- note templats -->
	<ul id="js_note_template" style="display:none">
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/note.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</ul><!-- /note js_note_templats -->

  <?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cate_name'] => $this->_tpl_vars['cate_data']):
?>
	<div id="cate-<?php echo $this->_foreach['cate_loop']['iteration']; ?>
"  title="<?php echo $this->_tpl_vars['cate_name']; ?>
" class="cate">
	  <ul class="notes_list clearfix connectedSortable">
		<?php $_from = $this->_tpl_vars['cate_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['item']):
?>
		  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/note.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>	  </ul><!-- /notes_list -->
	</div><!-- /cate -->
<?php endforeach; endif; unset($_from); ?>
  </div><!-- /innerContent -->
</div><!-- /main (main tags)-->

<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/welcome.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>