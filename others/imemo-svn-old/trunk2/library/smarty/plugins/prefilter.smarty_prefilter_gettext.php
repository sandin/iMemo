<?php
/* smarty prefileter gettext 
 * Smarty plugin
 * 
 * for Zend_Translate to change tags 
 *
 * like <{t}>text<{/t}> to <{$t->_('text')}>
 * the text between tags <{t}> and <{/t}> cannot include '<' , if you have to ,pleace use '&it;'
 *
 */

 function smarty_prefilter_smarty_prefilter_gettext($source, &$smarty)
 {
   return preg_replace('/<{t}>([^<]+)\\<{\/t/', '<{$t->_(\'$1\')', $source);
 }

?>

