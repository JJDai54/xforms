<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>

<form action="banish.php?op=list" method="post">
  <table class="outer width100 bspacing1">
    <thead>
        <tr><th colspan="5"><{$smarty.const._AM_XFORMS_BANISH_LIST}></th></tr>
        <tr>
          <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_ID}></td>
          <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_EMAIL}></td>
          <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_ATTEMPTS}></td>        
          <td class="head center bottom width20"><{$smarty.const._AM_XFORMS_LAST_UPDATE}></td>        
          <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_ACTION}></td>
        </tr>
    </thead>
    
    <tbody>
       <{foreach item=banish from=$allBanish}>
        <tr  <{$banish.extra}> >    
          <td class="<{$banish.ligne}> center"><{$banish.id}></td>
          <td class="<{$banish.ligne}> left"><{$banish.email}></td>
          <td class="<{$banish.ligne}> center"><{$banish.attempts}></td>
          <td class="<{$banish.ligne}> center"><{$banish.date_update}></td>
          
          <{* ----- Actions ----- *}>
          <td class="<{$banish.ligne}> center">
              <{$banish.delete}>
          </td>
        </tr>    
      <{/foreach}>  
 
    </tbody>
  </table>
</form>
