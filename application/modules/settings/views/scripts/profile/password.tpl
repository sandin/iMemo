<{include file="$APPLICATION_PATH/templates/header.tpl"}>

    <h3 class="title_1"><{t}>Change your password<{/t}></h3>
     <form id="form_change_password" action="" method="post">
        <table cellpadding='17' cellspacing="21" width="400">
         <tbody>
        <tr>
            <td class="lb"><label for="old_password"><{t}>Old Password<{/t}>: </label></td>
            <td><input class="ui-widget-content ui-corner-all" type="password" name="old_password" value=""/></td>
        </tr>
         <tr>
            <td class="lb"><label for="new_password"><{t}>New Password<{/t}>: </label></td>
            <td><input class="ui-widget-content ui-corner-all" type="password" name="new_password" value=""/></td>
        </tr>  
         <tr>
            <td class="lb"><label for="re-password"><{t}>Re-password<{/t}>: </label></td>
            <td><input class="ui-widget-content ui-corner-all" type="password" name="re-password" value=""/></td>
        </tr>  
        <tr><td>&nbsp;</td>
        <td align=""><input class="ui-button ui-state-default js_highlight" type="submit" value="submit" /></td></tr>
        </tbody>
        </table>
     </form>


<{include file="$APPLICATION_PATH/templates/footer.tpl"}>
