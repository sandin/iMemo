<?php /* Smarty version 2.6.26, created on 2009-12-27 19:17:58
         compiled from /home/svn/0019/trunk/application/templates/note.tpl */ ?>
<li class="note clearfix" id="<?php echo $this->_tpl_vars['category_id']; ?>
:<?php echo $this->_tpl_vars['item']['note_id']; ?>
">
	<div class="n_col n_lable star_<?php echo $this->_tpl_vars['item']['star']; ?>
">&nbsp;</div>
	<div class="n_col ">&nbsp;</div>
	<div class="n_col n_state"><div class="checkbox">&nbsp;</div></div>
	<div class="n_col n_content" contenteditable='' unselectable=""><?php echo $this->_tpl_vars['item']['content']; ?>
</div>
	<div class="n_col n_del">
		<a title="a" onclick="return false" href="#" class="js_highlight ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a>
	</div>
	<div class="n_col n_time"><?php echo $this->_tpl_vars['item']['dueDate']['time']; ?>
</div>
	<div class="n_col n_date"><?php echo $this->_tpl_vars['item']['dueDate']['date']; ?>
</div>

	<div class="n_tag">
	  <?php $_from = $this->_tpl_vars['item']['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
		<span><?php echo $this->_tpl_vars['tag']['tag_name']; ?>
</span>
	  <?php endforeach; endif; unset($_from); ?>
	</div>
</li><!-- /note -->