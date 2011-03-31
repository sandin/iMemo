<li class="note clearfix" id="<{$category_id}>:<{$item.note_id}>">
	<div class="n_col n_lable star_<{$item.star}>">&nbsp;</div>
	<div class="n_col ">&nbsp;</div>
	<div class="n_col n_state"><div class="checkbox">&nbsp;</div></div>
	<div class="n_col n_content" contenteditable="" unselectable=""><{$item.content}></div>
	<div class="n_col n_del"><a title="a" onclick="return false" href="#" class="js_highlight ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a></div>
	<input type="text" class="n_col n_time n_input<{if $item.dueDate.time}><{else}> c_min<{/if}>" value="<{$item.dueDate.time}>" />
	<input type="text" class="n_col n_date n_input<{if $item.dueDate.date}><{else}> c_min<{/if}>" value="<{if $item.dueDate.dateHuman}><{$item.dueDate.dateHuman}><{else}><{$item.dueDate.date}><{/if}>" />
	<div class="n_tag c_min">
	  <{foreach from=$item.tags item=tag}>
		<span><{$tag.tag_name}></span>
	  <{/foreach}>
	</div>
</li><!-- /note -->
