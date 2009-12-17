<div title="<{$category_name}>" class="cate">
  <ul class="notes_list clearfix connectedSortable">
	<{foreach from=$notes item=item key=i}>
	  <{assign value=$item.note_id var=nid}>
	  <{include file="$APPLICATION_PATH/templates/note.tpl"}>
	<{/foreach}><{* note loop end *}>
  </ul><!-- /notes_list -->
</div><!-- /cate -->
