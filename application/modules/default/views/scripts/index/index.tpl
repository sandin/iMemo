<{include file="$APPLICATION_PATH/templates/header.tpl"}>
<{*debug*}>

<{*如果已经登录则显示个人主页,否则显示网站欢迎页面 *}>
<{if $user}>

<div id="main" class="clearfix">

  <ul id="categorys" class="sidebar">
	<{section name=i loop=$categorys}>
	  <li><a href="<{$PUBLIC_URL}>/category/<{$categorys[i].category_id}>"><{$categorys[i].category_name}></a></li>
	<{/section}>

  </ul><!-- /categorys (sidebar) -->

  <div id="innerContent"> 
	<!-- main input -->
	<div id="note_00" class="note clearfix">
	  <form name="add_note_form" id="add_note_form" class="ajaxForm" action="<{$PUBLIC_URL}>/note/add_note" method="post">
		<div class="n_col n_content editing">
		  <input name="note-data" class="ajax-add-note real" type="text" autocomplete="off" src="<{$PUBLIC_URL}>/note/add_note"></input></div>
		<div class="n_col n_submit">
		  <input name="n_submit" class="js_highlight ui-button ui-state-default ui-corner-all" type="submit" value="Submit!"></input>
		  <input id="js_current_category" name="categorys" type="hidden" value="<{$first_category_name}>"></input>
		</div>
	  </form>
	</div><!-- /note_00(addNote) --> 
	
	<div id="js_panelsTarget" class=""><!-- Flash Target -->
	</div><!-- /js_panelsTarget -->

	<{foreach from=$notes item=item}>
	<div id="cate-n"></div>
	<{/foreach}>

  </div><!-- /innerContent -->
</div><!-- /main (main tags)-->

<!-- note templats -->
<ul id="js_note_template" style="display:none">
  <{include file="$APPLICATION_PATH/templates/note.tpl"}>
</ul><!-- /note js_note_template -->

<a id="sort_note_url" style="display:none" class="hidden" href="<{$PUBLIC_URL}>/note/sort_note">&nbsp;</a>
<a id="alter_note_url" style="display:none" class="hidden" href="<{$PUBLIC_URL}>/note/alter_note">&nbsp;</a>

<{else}>
<{include file="$APPLICATION_PATH/templates/welcome.tpl"}>
<{/if}>

<{include file="$APPLICATION_PATH/templates/footer.tpl"}>
