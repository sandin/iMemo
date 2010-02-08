<?php /* Smarty version 2.6.26, created on 2010-02-08 12:28:00
         compiled from index/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['user']): ?>

<div id="main" class="clearfix">

  <ul id="categorys" class="sidebar">
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['categorys']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
	  <li><a id="c<?php echo $this->_tpl_vars['categorys'][$this->_sections['i']['index']]['category_id']; ?>
" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/category/<?php echo $this->_tpl_vars['categorys'][$this->_sections['i']['index']]['category_id']; ?>
"><?php echo $this->_tpl_vars['categorys'][$this->_sections['i']['index']]['category_name']; ?>
</a></li>
	<?php endfor; endif; ?>

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
		  <input name="n_submit" class="js_highlight ui-button ui-state-default ui-corner-all" type="submit" value="Submit!"></input>
		  <input id="js_current_category" name="categorys" type="hidden" value="<?php echo $this->_tpl_vars['first_category_name']; ?>
"></input>
		</div>
	  </form>
	</div><!-- /note_00(addNote) --> 
	
	<div id="js_panelsTarget" class=""><!-- Flash Target -->
	</div><!-- /js_panelsTarget -->

	<?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<div id="cate-n"></div>
	<?php endforeach; endif; unset($_from); ?>

  </div><!-- /innerContent -->
</div><!-- /main (main tags)-->

<!-- note templats -->
<ul id="js_note_template" style="display:none">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/note.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</ul><!-- /note js_note_template -->

<a id="sort_note_url" style="display:none" class="request_url hidden" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/sort_note">&nbsp;</a>
<a id="alter_note_url" style="display:none" class="request_url hidden" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/alter_note">&nbsp;</a>
<a id="del_note_url" style="display:none" class="request_url hidden" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/del_note">&nbsp;</a>
<a id="change_category_url" style="display:none" class="request_url hidden" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/change_category">&nbsp;</a>

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