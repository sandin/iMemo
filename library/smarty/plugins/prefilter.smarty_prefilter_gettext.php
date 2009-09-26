<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File: prefilter.pre01.php
 * Type: prefilter
 * Name: pre01
 * Purpose: 
 * -------------------------------------------------------------
 */
// function smarty_prefilter_pre01($source, &$smarty)
 function smarty_prefilter_smarty_prefilter_gettext($source, &$smarty)
 {
// return preg_replace('/<{t}>[^<]+\\</', 'TTTTTTTT', $source);
 return preg_replace('/<{t}>([^<]+)\\<{\/t/', '<{$t->_(\'$1\')', $source);
 }
//<{t}>123<{/t}>
//<{$t->_('123')}>
?>

