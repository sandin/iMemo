<div id="settings_categorys" class="clearfix">
  <div>
	Select : <a href="">All</a>, <a href="">None</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<select><option>doing</option></select>&nbsp;&nbsp;&nbsp;
	<input type="button" name="" value="<{t}>Delete selected<{/t}>" />
  </div>
  <table class="categorys_list" cellpadding="0" width="100%">
	<tbody>
	  <{section name=i loop=$categorys}>
		<{include file="$APPLICATION_PATH/templates/category.tpl"}>
	  <{/section}>

	</tbody>
  </table>

</div>


