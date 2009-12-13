<{include file="$APPLICATION_PATH/templates/header.tpl"}>
<{debug}>
<{*如果已经登录则显示个人主页,否则显示网站欢迎页面 *}>
<{if $user}>

<div id="main" class="clearfix">

  <ul id="categorys">
	<li><a href="#cate-1">Inbox</a></li>
	<li><a href="#cate-2">Today</a></li>
	<li><a href="#cate-2">Next</a></li>
	<li><a href="#cate-2">Maybe</a></li>
	<li><a href="#cate-2">Projects</a></li>
	<li><a href="#cate-2">Areas</a></li>
  </ul><!-- /categorys (sidebar) -->

  <div id="innerContent"> 
	<div id="note_00" class="cate note clearfix">
	  <div class="n_col n_content editing"><input name="ajax-add-note" class="ajax-add-note real" type="text" autocomplete="off" src="<{$PUBLIC_URL}>/note/add_note"></input></div>
	  <div class="n_col n_s">Add a new note</div>
	</div><!-- /note_00(addNote) --> 
	
	<div id="cate-1" class="cate">
	  
	  <ul class="notes_list clearfix connectedSortable">
			<!-- note templats -->
			<li class="note clearfix" id="js_note_templats" style="display:none;">
				<div class="n_col n_lable star_<{$item.star}>">&nbsp;</div>
				<div class="n_col ">&nbsp;</div>
				<div class="n_col n_state"><input type="checkbox"></input></div>
				<div class="n_col n_content">::content::</div>
				<div class="n_col n_del">
				  <a title="a" onclick="return false" href="<{$PUBLIC_URL}>/note/del_note" class="ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a>
				</div>
				<div class="n_col n_date">::n_date::</div>
				<div class="n_col n_id hidden">::note_id::</div>

				<div class="n_tag">
				   <span>::tag::</span>
				</div>
			</li><!-- /note js_note_templats -->
		<{foreach from=$notes item=item}>
			<li class="note clearfix" <{if $notes == 0 }>id="js_note_templats" style="display:none;"<{/if}> >
				<div class="n_col n_lable star_<{$item.star}>">&nbsp;</div>
				<div class="n_col ">&nbsp;</div>
				<div class="n_col n_state"><input type="checkbox"></input></div>
				<div class="n_col n_content"><{$item.content}></div>
				<div class="n_col n_del">
				  <a title="a" onclick="return false" href="<{$PUBLIC_URL}>/note/del_note" class="ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"></span></a>
				</div>
				<div class="n_col n_date">1985-12-12 12:02</div>
				<div class="n_col n_id hidden"><{$item.note_id}></div>

				<div class="n_tag">
				  <{foreach from=$item.tags item=tag}>
					<span><{$tag.tag_name}></span>
				  <{/foreach}>
			    </div>
			</li><!-- /note -->
	  <{/foreach}>
	  </ul><!-- /notes_list -->
	</div><!-- /cate -->

	 <div id="cate-2" class="cate">
	  <ul class="notes_list clearfix connectedSortable">

	  </ul>
	</div><!-- /cate -->
  </div><!-- /innerContent -->
</div><!-- /main (main tags)-->

<{else}>
<{include file="$APPLICATION_PATH/templates/welcome.tpl"}>
<{/if}>

<{include file="$APPLICATION_PATH/templates/footer.tpl"}>
  <!--

		user_id :<{$item.user_id}>
		note_id :<{$item.note_id}>
		dueDate :<{$item.dueDate}>
		category :<{$item.category}>
		tags :
<{foreach from=$item.tags item=tag}>
		<{$tag.tag_name}>
<{/foreach}>

		style :<{$item.style}>
		star :<{$item.star}>
	ts_created :<{$item.ts_created}>
	  -->
