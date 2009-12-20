<div id="settings_categorys" class="clearfix">
  <div id="setting_toolbar" class="clearfix">
	Select : <a href="">All</a>, <a href="">None</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<select class="ui-state-default ui-corner-all">
	  <option>option</option>
	  <option>option</option>
	</select>&nbsp;&nbsp;&nbsp;
	<input type="button" class="ui-state-default ui-button js_highlight ui-corner-all" name="" value="<{t}>Delete selected<{/t}>" />
	<form id="create_category_form" action="<{$PUBLIC_URL}>/note/create_category" method="post" class="ajaxForm">
	  <input type="text" class="ui-state-default ui-corner-all" name="category_name" value="" />
	  <input type="submit" class="ui-state-default ui-button js_highlight ui-corner-all" name="submit" value="<{t}>Create Category<{/t}>" />
	  </form>
  </div>
  <table class="categorys_list" cellpadding="0" width="100%">
	<tbody>
	  <{section name=i loop=$categorys}>
		<{include file="$APPLICATION_PATH/templates/category.tpl"}>
	  <{/section}>

	</tbody>
  </table>

</div>


