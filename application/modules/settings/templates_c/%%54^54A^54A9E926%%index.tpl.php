<?php /* Smarty version 2.6.26, created on 2009-12-23 11:33:33
         compiled from categorys/index.tpl */ ?>
<div id="settings_categorys" class="clearfix">
  <div id="setting_toolbar" class="clearfix">
	Select : <a href="">All</a>, <a href="">None</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<select class="ui-state-default ui-corner-all">
	  <option>option</option>
	  <option>option</option>
	</select>&nbsp;&nbsp;&nbsp;
	<input type="button" class="ui-state-default ui-button js_highlight ui-corner-all" name="" value="<?php echo $this->_tpl_vars['t']->_('Delete selected'); ?>
" />
	<form id="create_category_form" action="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/note/create_category" method="post" class="ajaxForm">
	  <input type="text" class="ui-state-default ui-corner-all" name="category_name" value="" />
	  <input type="submit" class="ui-state-default ui-button js_highlight ui-corner-all" name="submit" value="<?php echo $this->_tpl_vars['t']->_('Create Category'); ?>
" />
	  </form>
  </div>
  <table class="categorys_list" cellpadding="0" width="100%">
	<tbody>
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
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/category.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  <?php endfor; endif; ?>

	</tbody>
  </table>

</div>

