<?php /* Smarty version 2.6.26, created on 2009-12-29 13:50:37
         compiled from /home/svn/0019/trunk/application/templates/note.tpl */ ?>
<li class="note clearfix" id="<?php echo $this->_tpl_vars['category_id']; ?>
:<?php echo $this->_tpl_vars['item']['note_id']; ?>
">
	<div class="n_col n_lable star_<?php echo $this->_tpl_vars['item']['star']; ?>
">&nbsp;</div>
	<div class="n_col ">&nbsp;</div>
	<div class="n_col n_state"><div class="checkbox">&nbsp;</div></div>
	<div class="n_col n_content" contenteditable="" unselectable=""><?php echo $this->_tpl_vars['item']['content']; ?>
</div>
	<div class="n_col n_del"><a title="a" onclick="return false" href="#" class="js_highlight ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a></div>
	<input type="text" class="n_col n_time n_input<?php if ($this->_tpl_vars['item']['dueDate']['time']): ?><?php else: ?> c_min<?php endif; ?>" value="<?php echo $this->_tpl_vars['item']['dueDate']['time']; ?>
" />
	<input type="text" class="n_col n_date n_input<?php if ($this->_tpl_vars['item']['dueDate']['date']): ?><?php else: ?> c_min<?php endif; ?>" value="<?php if ($this->_tpl_vars['item']['dueDate']['dateHuman']): ?><?php echo $this->_tpl_vars['item']['dueDate']['dateHuman']; ?>
<?php else: ?><?php echo $this->_tpl_vars['item']['dueDate']['date']; ?>
<?php endif; ?>" />
	<div class="n_tag c_min">
	  <?php $_from = $this->_tpl_vars['item']['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
		<span><?php echo $this->_tpl_vars['tag']['tag_name']; ?>
</span>
	  <?php endforeach; endif; unset($_from); ?>
	</div>
</li><!-- /note -->