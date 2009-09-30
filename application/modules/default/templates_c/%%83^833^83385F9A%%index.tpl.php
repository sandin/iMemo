<?php /* Smarty version 2.6.26, created on 2009-09-30 14:07:10
         compiled from index/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'index/index.tpl', 27, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="main" class="clearfix">

  <ul id="categorys">
	<li><a href="#cate-1">Inbox</a></li>
	<li><a href="#cate-2">Today</a></li>
	<li><a href="#cate-2">Next</a></li>
	<li><a href="#cate-2">Maybe</a></li>
	<li><a href="#cate-2">Projects</a></li>
	<li><a href="#cate-2">Areas</a></li>
	<li><a href="#cate-2">中文</a></li>
  </ul><!-- /categorys (sidebar) -->

  <div id="innerContent"> 
	<div id="note_00" class="cate note clearfix">
		<table>
		  <tbody>
			<tr>
			  <td class="n_content editing"><input name="ajax-add-note" class="ajax-add-note real" type="text" autocomplete="off" src="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/add"></input></td>
			  <td class="n_s"><-- Add a new note</td>
			</tr>
		  </tbody>
		</table>
	</div><!-- /note_00(addNote) --> 
	
	<?php if (count($this->_tpl_vars['notes']) == 0): ?>
	  <?php $this->assign('notes', "array(array('star'=>3))"); ?>
	<?php endif; ?>

	<div id="cate-1" class="cate">
	  
	  <ul class="notes_list clearfix connectedSortable">

		<?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<li class="note clearfix" <?php if (count($this->_tpl_vars['notes']) == 0): ?>id="js_note_templats" style="display:none;"<?php endif; ?> >
		  <table>
			<tbody>
			  <tr>
				<td class="n_lable star_<?php echo $this->_tpl_vars['item']['star']; ?>
">&nbsp;</td>
				<td class="n_t">&nbsp;</td>
				<td class="n_s"><input type="checkbox"></input></td>
				<td class="n_content"><?php echo $this->_tpl_vars['item']['content']; ?>
</td>
				<td class="n_date">1985-12-12 12:02</td>
				<td class="n_del"><li title="" class="ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"/></li></td>
				<td class="n_id hidden"><?php echo $this->_tpl_vars['item']['user_id']; ?>
</td>
			  </tr>
			</tbody>
		  </table>
		  <div class="n_tag">
			  <?php $_from = $this->_tpl_vars['item']['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
				<span><?php echo $this->_tpl_vars['tag']['tag_name']; ?>
</span>
			  <?php endforeach; endif; unset($_from); ?>
		  </div>
		 </li><!-- /note -->
	  <?php endforeach; endif; unset($_from); ?>
	  </ul><!-- /notes_list -->
	</div><!-- /cate -->

	 <div id="cate-2" class="cate">
	  <ul class="notes_list clearfix connectedSortable">

	  </ul>
	</div><!-- /cate -->
  </div><!-- /innerContent -->
</div><!-- /main (main tags)-->


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <!--

		user_id :<?php echo $this->_tpl_vars['item']['user_id']; ?>

		note_id :<?php echo $this->_tpl_vars['item']['note_id']; ?>

		dueDate :<?php echo $this->_tpl_vars['item']['dueDate']; ?>

		category :<?php echo $this->_tpl_vars['item']['category']; ?>

		tags :
<?php $_from = $this->_tpl_vars['item']['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
		<?php echo $this->_tpl_vars['tag']['tag_name']; ?>

<?php endforeach; endif; unset($_from); ?>

		style :<?php echo $this->_tpl_vars['item']['style']; ?>

		star :<?php echo $this->_tpl_vars['item']['star']; ?>

	ts_created :<?php echo $this->_tpl_vars['item']['ts_created']; ?>

	  -->