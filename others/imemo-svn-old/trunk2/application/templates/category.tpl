<tr<{if $smarty.section.i.index is odd}> class="even"<{/if}>>

  <td class="c_ckbox"><input type="checkbox" /></td>
  <td class="c_name"><{$categorys[i].category_name}></td>
  <td class="c_rename">
	<{* 小于10的cecategory为系统预留,不能重命名 *}>
	<{if $categorys[i].category_id > 10}>
	<a title="a" onclick="return false" href="#" class="js_highlight ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-pencil"></span></a>
	<{else}>
	&nbsp;
	<{/if}>
  </td>
  <td class="c_del">
	<a title="a" onclick="return false" href="<{$PUBLIC_URL}>/note/del_category" class="js_highlight ui-lds-icon ui-state-default ui-corner-all">
	  <span class="ui-icon ui-icon-closethick"></span>
	</a>
  </td>
  <td class="c_share">
	&nbsp;&nbsp;private
  </td>
  <td class="c_id"><{$categorys[i].category_id}></td>
</tr>
