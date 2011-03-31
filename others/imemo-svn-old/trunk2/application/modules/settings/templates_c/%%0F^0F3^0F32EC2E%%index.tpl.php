<?php /* Smarty version 2.6.26, created on 2009-12-30 17:17:13
         compiled from profile/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'profile/index.tpl', 8, false),array('function', 'debug', 'profile/index.tpl', 28, false),)), $this); ?>
  <div id="setting_profile" class="clearfix">
     <form id="form_profile">
        <table cellpadding='5'>
         <tbody>
                <?php unset($this->_sections['b']);
$this->_sections['b']['name'] = 'b';
$this->_sections['b']['loop'] = is_array($_loop=$this->_tpl_vars['userBaseInfo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['b']['show'] = true;
$this->_sections['b']['max'] = $this->_sections['b']['loop'];
$this->_sections['b']['step'] = 1;
$this->_sections['b']['start'] = $this->_sections['b']['step'] > 0 ? 0 : $this->_sections['b']['loop']-1;
if ($this->_sections['b']['show']) {
    $this->_sections['b']['total'] = $this->_sections['b']['loop'];
    if ($this->_sections['b']['total'] == 0)
        $this->_sections['b']['show'] = false;
} else
    $this->_sections['b']['total'] = 0;
if ($this->_sections['b']['show']):

            for ($this->_sections['b']['index'] = $this->_sections['b']['start'], $this->_sections['b']['iteration'] = 1;
                 $this->_sections['b']['iteration'] <= $this->_sections['b']['total'];
                 $this->_sections['b']['index'] += $this->_sections['b']['step'], $this->_sections['b']['iteration']++):
$this->_sections['b']['rownum'] = $this->_sections['b']['iteration'];
$this->_sections['b']['index_prev'] = $this->_sections['b']['index'] - $this->_sections['b']['step'];
$this->_sections['b']['index_next'] = $this->_sections['b']['index'] + $this->_sections['b']['step'];
$this->_sections['b']['first']      = ($this->_sections['b']['iteration'] == 1);
$this->_sections['b']['last']       = ($this->_sections['b']['iteration'] == $this->_sections['b']['total']);
?>
        <tr>
            <td class="lb"><?php echo ((is_array($_tmp=$this->_tpl_vars['userBaseInfo'][$this->_sections['b']['index']]['key'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</td>
            <td><?php echo $this->_tpl_vars['userBaseInfo'][$this->_sections['b']['index']]['value']; ?>
</td>
        </tr>

        <?php endfor; endif; ?>
        
                <?php unset($this->_sections['user']);
$this->_sections['user']['name'] = 'user';
$this->_sections['user']['loop'] = is_array($_loop=$this->_tpl_vars['userInfo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['user']['show'] = true;
$this->_sections['user']['max'] = $this->_sections['user']['loop'];
$this->_sections['user']['step'] = 1;
$this->_sections['user']['start'] = $this->_sections['user']['step'] > 0 ? 0 : $this->_sections['user']['loop']-1;
if ($this->_sections['user']['show']) {
    $this->_sections['user']['total'] = $this->_sections['user']['loop'];
    if ($this->_sections['user']['total'] == 0)
        $this->_sections['user']['show'] = false;
} else
    $this->_sections['user']['total'] = 0;
if ($this->_sections['user']['show']):

            for ($this->_sections['user']['index'] = $this->_sections['user']['start'], $this->_sections['user']['iteration'] = 1;
                 $this->_sections['user']['iteration'] <= $this->_sections['user']['total'];
                 $this->_sections['user']['index'] += $this->_sections['user']['step'], $this->_sections['user']['iteration']++):
$this->_sections['user']['rownum'] = $this->_sections['user']['iteration'];
$this->_sections['user']['index_prev'] = $this->_sections['user']['index'] - $this->_sections['user']['step'];
$this->_sections['user']['index_next'] = $this->_sections['user']['index'] + $this->_sections['user']['step'];
$this->_sections['user']['first']      = ($this->_sections['user']['iteration'] == 1);
$this->_sections['user']['last']       = ($this->_sections['user']['iteration'] == $this->_sections['user']['total']);
?>
        <tr>
            <td class="lb"><label for="<?php echo $this->_tpl_vars['userInfo'][$this->_sections['user']['index']]['name']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['userInfo'][$this->_sections['user']['index']]['name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</label></td>
            <td><input type="<?php echo $this->_tpl_vars['userInfo'][$this->_sections['user']['index']]['type']; ?>
" name="<?php echo $this->_tpl_vars['userInfo'][$this->_sections['user']['index']]['name']; ?>
" value="<?php echo $this->_tpl_vars['userInfo'][$this->_sections['user']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['userInfo'][$this->_sections['user']['index']]['name'] == 'username'): ?>disabled="disabled"<?php endif; ?> /></td>
            <td><i><?php echo $this->_tpl_vars['userInfo'][$this->_sections['user']['index']]['msg']; ?>
</i></td>
        </tr>
        <?php endfor; endif; ?>

                <tr>
            <td class="lb"><?php echo $this->_tpl_vars['t']->_('Password'); ?>
</td>
            <td><a class="js_highlight ui-button ui-state-default ui-corner-all" href="<?php echo $this->_tpl_vars['PUBLIC_URL']; ?>
/settings/profile/password" title="change password"><?php echo $this->_tpl_vars['t']->_('Change your password'); ?>
</a></td>
        </tr>
<?php echo smarty_function_debug(array(), $this);?>

        </tbody>
        </table>
     </form>


  </div>
