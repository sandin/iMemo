<{include file="$APPLICATION_PATH/templates/header.tpl"}>

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
		<table>
		  <tbody>
			<tr>
			  <td class="n_content editing"><input name="ajax-add-note" class="ajax-add-note real" type="text" autocomplete="off" src="<{$PUBLIC_URL}>/note/add"></input></td>
			  <td class="n_s"><-- Add a new note</td>
			</tr>
		  </tbody>
		</table>
	</div><!-- /note_00(addNote) --> 
	
	<{if $notes|@count == 0 }>
	  <{assign var='notes' value="array(array('star'=>3))" }>
	<{/if}>

	<div id="cate-1" class="cate">
	  
	  <ul class="notes_list clearfix connectedSortable">

		<{foreach from=$notes item=item}>
		<li class="note clearfix" <{if $notes|@count == 0 }>id="js_note_templats" style="display:none;"<{/if}> >
		  <table>
			<tbody>
			  <tr>
				<td class="n_lable star_<{$item.star}>">&nbsp;</td>
				<td class="n_t">&nbsp;</td>
				<td class="n_s"><input type="checkbox"></input></td>
				<td class="n_content"><{$item.content}></td>
				<td class="n_date">1985-12-12 12:02</td>
				<td class="n_del"><li title="" class="ui-lds-icon ui-state-default ui-corner-all"><span class="ui-icon ui-icon-closethick"/></li></td>
				<td class="n_id hidden"><{$item.user_id}></td>
			  </tr>
			</tbody>
		  </table>
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
