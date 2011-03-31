<?php /* Smarty version 2.6.26, created on 2009-12-30 17:17:01
         compiled from profile/password.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <h3 class="title_1"><?php echo $this->_tpl_vars['t']->_('Change your password'); ?>
</h3>
     <form id="form_change_password" action="" method="post">
        <table cellpadding='17' cellspacing="21" width="400">
         <tbody>
        <tr>
            <td class="lb"><label for="old_password"><?php echo $this->_tpl_vars['t']->_('Old Password'); ?>
: </label></td>
            <td><input class="ui-widget-content ui-corner-all" type="password" name="old_password" value=""/></td>
        </tr>
         <tr>
            <td class="lb"><label for="new_password"><?php echo $this->_tpl_vars['t']->_('New Password'); ?>
: </label></td>
            <td><input class="ui-widget-content ui-corner-all" type="password" name="new_password" value=""/></td>
        </tr>  
         <tr>
            <td class="lb"><label for="re-password"><?php echo $this->_tpl_vars['t']->_('Re-password'); ?>
: </label></td>
            <td><input class="ui-widget-content ui-corner-all" type="password" name="re-password" value=""/></td>
        </tr>  
        <tr><td>&nbsp;</td>
        <td align=""><input class="ui-button ui-state-default js_highlight" type="submit" value="submit" /></td></tr>
        </tbody>
        </table>
     </form>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['APPLICATION_PATH'])."/templates/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>