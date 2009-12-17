<li class="note clearfix">
	<div class="n_col n_lable star_<{$item.star}>">&nbsp;</div>
	<div class="n_col ">&nbsp;</div>
	<div class="n_col n_state"><input type="checkbox"></input></div>
	<div class="n_col n_content"><{$item.content}></div>
	<div class="n_col n_del">
	  <form name="del_note_form" class="ajaxForm del_note_form" action="<{$PUBLIC_URL}>/note/del_note" method="post">
		<a title="a" onclick="return false" href="#" class="ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a>
		<{* 这里的input name属性就是不能为note_id,smarty原因,具体原因不清楚 *}>
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
