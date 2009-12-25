<li class="note clearfix" id="<{$category_id}>:<{$item.note_id}>">
	<div class="n_col n_lable star_<{$item.star}>">&nbsp;</div>
	<div class="n_col ">&nbsp;</div>
	<div class="n_col n_state"><div class="checkbox">&nbsp;</div></div>
	<div class="n_col n_content" contenteditable='' unselectable=""><{$item.content}></div>
	<div class="n_col n_del">
	  <form name="del_note_form" class="ajaxForm del_note_form" action="<{$PUBLIC_URL}>/note/del_note" method="post">
		<a title="a" onclick="return false" href="#" class="js_highlight ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a>
		<{* 这里的input name属性就是不能为note_id,smarty原因,是因为循环标签用错了foreach改成s loop *}>
		<input class="note_id" type="hidden" name="smarty_bug" value="<{$nid}>"></input>
		<input class="note_id" name="n_id" value="<{$nid}>" type="hidden"></input>
		</form>
	</div>
	<div class="n_col n_date">1985-12-12 12:02</div>

	<div class="n_tag">
	  <{foreach from=$item.tags item=tag}>
		<span><{$tag.tag_name}></span>
	  <{/foreach}>
	</div>
</li><!-- /note -->
