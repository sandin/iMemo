<li class="note clearfix" id="<{$category_id}>:<{$item.note_id}>">
	<div class="n_col n_lable star_<{$item.star}>">&nbsp;</div>
	<div class="n_col ">&nbsp;</div>
	<div class="n_col n_state"><div class="checkbox">&nbsp;</div></div>
	<div class="n_col n_content" contenteditable='' unselectable=""><{$item.content}></div>
	<div class="n_col n_del">
		<a title="a" onclick="return false" href="#" class="js_highlight ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a>
	</div>
	<div class="n_col n_date">1985-12-12 12:02</div>

	<div class="n_tag">
	  <{foreach from=$item.tags item=tag}>
		<span><{$tag.tag_name}></span>
	  <{/foreach}>
	</div>
</li><!-- /note -->
