  <div id="setting_profile" class="clearfix">
     <form id="form_profile">
        <table cellpadding='5'>
         <tbody>
        <{*无需修改的基本信息 循环*}>
        <{section name=b loop=$userBaseInfo}>
        <tr>
            <td class="lb"><{$userBaseInfo[b].key|capitalize}></td>
            <td><{$userBaseInfo[b].value}></td>
        </tr>

        <{/section}>
        
        <{*可以修改的用户资料 循环*}>
        <{section name=user loop=$userInfo}>
        <tr>
            <td class="lb"><label for="<{$userInfo[user].name}>"><{$userInfo[user].name|capitalize}></label></td>
            <td><input type="<{$userInfo[user].type}>" name="<{$userInfo[user].name}>" value="<{$userInfo[user].value}>" <{if $userInfo[user].name == 'username'}>disabled="disabled"<{/if}> /></td>
            <td><i><{$userInfo[user].msg}></i></td>
        </tr>
        <{/section}>

        <{*修改密码在另一页面*}>
        <tr>
            <td class="lb"><{t}>Password<{/t}></td>
            <td><a class="js_highlight ui-button ui-state-default ui-corner-all" href="<{$PUBLIC_URL}>/settings/profile/password" title="change password"><{t}>Change your password<{/t}></a></td>
        </tr>
<{debug}>
        </tbody>
        </table>
     </form>


  </div>

