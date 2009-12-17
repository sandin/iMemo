<{include file="$APPLICATION_PATH/templates/header.tpl"}>
<{*debug*}>

<{*如果已经登录则显示个人主页,否则显示网站欢迎页面 *}>
<{if $user}>

<div id="main" class="clearfix">

  <ul id="categorys" class="sidebar">
	<{foreach from=$notes name=cate_side_loop item=cate_data key=cate_name}>
	<li><a href="#cate-<{$smarty.foreach.cate_side_loop.iteration}>"><{$cate_name}></a></li>

	<{* note_00.input[categorys]需要第一个category name *}>
	<{if $smarty.foreach.cate_side_loop.iteration == 1}>
	  <{assign value=$cate_name var="first_category_name"}>
	<{/if}>

	<{/foreach}>
  </ul><!-- /categorys (sidebar) -->

  <div id="innerContent"> 
	<!-- main input -->
	<div id="note_00" class="note clearfix">
	  <form name="add_note_form" id="add_note_form" class="ajaxForm" action="<{$PUBLIC_URL}>/note/add_note" method="post">
		<div class="n_col n_content editing">
		  <input name="note-data" class="ajax-add-note real" type="text" autocomplete="off" src="<{$PUBLIC_URL}>/note/add_note"></input></div>
		<div class="n_col n_submit">
		  <input name="n_submit" type="submit" value="Submit!"></input>
		  <input id="js_current_category" name="categorys" type="hidden" value="<{$first_category_name}>"></input>
		</div>
	  </form>
	</div><!-- /note_00(addNote) --> 
	
	<!-- note templats -->
	<ul id="js_note_template" style="display:none">
	  <{include file="$APPLICATION_PATH/templates/note.tpl"}>
	</ul><!-- /note js_note_templats -->

  <{* catogroy loop start *}>
  <{foreach from=$notes item=cate_data key=cate_name name=cate_loop }>
	<div id="cate-<{$smarty.foreach.cate_loop.iteration}>"  title="<{$cate_name}>" class="cate">
	  <ul class="notes_list clearfix connectedSortable">
		<{foreach from=$cate_data item=item key=i}>
		  <{assign value=$item.note_id var=nid}>
		  <{include file="$APPLICATION_PATH/templates/note.tpl"}>
		<{/foreach}><{* note loop end *}>
	  </ul><!-- /notes_list -->
	</div><!-- /cate -->
<{/foreach}><{* category loop end *}>

  </div><!-- /innerContent -->
</div><!-- /main (main tags)-->

<{else}>
<{include file="$APPLICATION_PATH/templates/welcome.tpl"}>
<{/if}>

<{include file="$APPLICATION_PATH/templates/footer.tpl"}>
