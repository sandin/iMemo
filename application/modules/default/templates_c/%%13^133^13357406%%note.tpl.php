<?php /* Smarty version 2.6.26, created on 2009-12-18 17:12:36
         compiled from /home/svn/0019/trunk/application/templates/note.tpl */ ?>
<li class="note clearfix">
	<div class="n_col n_lable star_<?php echo $this->_tpl_vars['item']['star']; ?>
">&nbsp;</div>
	<div class="n_col ">&nbsp;</div>
	<div class="n_col n_state"><input type="checkbox"></input></div>
	<div class="n_col n_content"><?php echo $this->_tpl_vars['item']['content']; ?>
</div>
	<div class="n_col n_del">
	  <form name="del_note_form" class="ajaxForm del_note_form" action="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/del_note" method="post">
		<a title="a" onclick="return false" href="#" class="ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a>
				<input class="note_id" type="hidden" name="smarty_bug" value="<?php echo $this->_tpl_vars['nid']; ?>
"></input>
		<input class="note_id" name="n_id" value="<?php echo $this->_tpl_vars['nid']; ?>
" type="hidden"></input>
		</form>
	</div>
	<div class="n_col n_date">1985-12-12 12:02</div>

	<div class="n_tag">
	  <?php $_from = $this->_tpl_vars['item']['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
		<span><?php echo $this->_tpl_vars['tag']['tag_name']; ?>
</span>
	  <?php endforeach; endif; unset($_from); ?>
	</div>
</li><!-- /note -->