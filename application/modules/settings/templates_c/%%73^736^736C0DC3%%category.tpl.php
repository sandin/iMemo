<?php /* Smarty version 2.6.26, created on 2009-12-19 13:56:14
         compiled from /home/svn/0019/trunk/application/templates/category.tpl */ ?>
<tr<?php if ((1 & $this->_sections['i']['index'])): ?> class="even"<?php endif; ?>>

  <td class="c_ckbox"><input type="checkbox" /></td>
  <td class="c_name"><?php echo $this->_tpl_vars['categorys'][$this->_sections['i']['index']]['category_name']; ?>
</td>
  <td class="c_rename">
	<a title="a" onclick="return false" href="#" class="js_highlight ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-pencil"></span></a>
  </td>
  <td class="c_del">
	<a title="a" onclick="return false" href="#" class="js_highlight ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a>
  </td>
  <td class="c_share">
	&nbsp;&nbsp;private
  </td>
  <td class="c_id"><?php echo $this->_tpl_vars['categorys'][$this->_sections['i']['index']]['category_id']; ?>
</td>
</tr>