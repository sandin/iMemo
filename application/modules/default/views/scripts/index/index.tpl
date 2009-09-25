{include file="$APPLICATION_PATH/templates/header.tpl"}

<div id="main" class="clearfix">

  <ul id="categorys">
	<li><a href="#cate-1">Inbox</a></li>
	<li><a href="#cate-2">Today</a></li>
	<li><a href="#cate-2">Next</a></li>
	<li><a href="#cate-2">Maybe</a></li>
	<li><a href="#cate-2">Projects</a></li>
	<li><a href="#cate-2">Areas</a></li>
	<li><a href="#cate-2">中文</a></li>
  </ul><!-- /categorys (sidebar) -->

  <div id="innerContent"> 
	<div id="note_00" class="cate note clearfix">
		<table>
		  <tbody>
			<tr>
			  <td class="n_content editing"><input name="ajax-add-note" class="ajax-add-note real" type="text" autocomplete="off" src="{$PUBLIC_URL}/note/add"></input></td>
			  <td class="n_s"><-- Add a new note</td>
			</tr>
		  </tbody>
		</table>
	</div><!-- /note_00(addNote) --> 
	
	<ul id="js_note_templats" style="display:none">
	 	<li class="note clearfix">
		  <table>
			<tbody>
			  <tr>
				<td class="n_lable star_{*$item.star*}">&nbsp;</td>
				<td class="n_t">&nbsp;</td>
				<td class="n_s"><input type="checkbox"></input></td>
				<td class="n_content">{$item.content}</td>
				<td class="n_tag">
				  {foreach from=$item.tags item=tag}
					<span>[{$tag.tag_name}]</span>
				  {/foreach}
				</td>
				<td class="n_date">12:02</td>
			  </tr>
			</tbody>
		  </table>
		 </li><!-- /note -->
	</ul><!-- /js_note_templats -->

	<div id="cate-1" class="cate">
	  <ul class="notes_list clearfix connectedSortable">
	   {foreach from=$notes item=item}
		{if $item.content|count_characters:true > 0}
		<li class="note clearfix">
		  <table>
			<tbody>
			  <tr>
				<td class="n_lable star_{*$item.star*}">&nbsp;</td>
				<td class="n_t">&nbsp;</td>
				<td class="n_s"><input type="checkbox"></input></td>
				<td class="n_content">{$item.content}</td>
				<td class="n_tag">
				  {foreach from=$item.tags item=tag}
					<span>[{$tag.tag_name}]</span>
				  {/foreach}
				</td>
				<td class="n_date">12:02</td>
			  </tr>
			</tbody>
		  </table>
		 </li><!-- /note -->
		{/if}
	  {/foreach}
	  </ul><!-- /notes_list -->
	</div><!-- /cate -->

	 <div id="cate-2" class="cate">
	  <ul class="notes_list clearfix connectedSortable">
	  {foreach from=$notes item=item}
		{if $item.content|count_characters:true > 0}
		<li class="note clearfix">
		  <table>
			<tbody>
			  <tr>
				<td class="n_l">{$item.star}</td>
				<td class="n_c">{$item.content}</td>
				<td class="n_i">time date something</td>
			  </tr>
			</tbody>
		  </table>
		 </li>
		{/if}
	  {/foreach}
	  </ul>
	</div><!-- /cate -->
  </div><!-- /innerContent -->
</div><!-- /main (main tags)-->


{debug}
{include file="$APPLICATION_PATH/templates/footer.tpl"}
  <!--

		user_id :{$item.user_id}
		note_id :{$item.note_id}
		dueDate :{$item.dueDate}
		category :{$item.category}
		tags :
{foreach from=$item.tags item=tag}
		{$tag.tag_name}
{/foreach}

		style :{$item.style}
		star :{$item.star}
	ts_created :{$item.ts_created}
	  -->
