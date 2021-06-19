<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>

<form action="contact.php?op=list" method="post">
    <{$smarty.const._AM_XFORMS_LISTING_CONTACT}> : <{$selectForm}>
</form>
        
<table class="outer width100 bspacing1">
    <thead>
      <tr><th colspan="8"><{$smarty.const._AM_XFORMS_LISTING}></th></tr>    
      <tr>    
        <td class="head center bottom width5"><{$smarty.const._AM_XFORMS_NO}></td>
        <td class="head center bottom"><{$smarty.const._AM_XFORMS_TITLE}></td>
        <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_CHRONO}></td>
        <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_USER}></td>
        <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_EMAIL}></td>
        <td class="head center bottom width20"><{$smarty.const._AM_XFORMS_OBJECT}></td>
        <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_STATUS}></td>
        <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_ACTION}></td>
      </tr>    
    </thead>    
    
  <tbody>
    <{foreach item=message from=$messages}>
      <tr  style='height:10px;color:<{$message.color}>;'>    
        <td class="<{$message.ligne}> center"><{$message.uform_id}></td>
        <td class="<{$message.ligne}> left"><{$message.form_name}></td>
        <td class="<{$message.ligne}> left"><{$message.chrono}></td>
        <td class="<{$message.ligne}> left"><{$message.user}></td>
        <td class="<{$message.ligne}> left"><{$message.email}></td>
        <td class="<{$message.ligne}> left"><{$message.object}></td>
        <td class="<{$message.ligne}> center"><{$message.status}></td>
        
        
        <{* ----- Actions ----- *}>
        <td class="<{$message.ligne}> center">
            <{$message.view}>&nbsp;
            <{$message.mail}>&nbsp;
            <{$message.delete}>&nbsp;
            <{$message.banish}>
        </td>
      </tr>    
    <{/foreach}>  
  </tbody>
</table>




