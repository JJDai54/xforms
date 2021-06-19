<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>

<{$data.selectOnStatus}>

<{*
<{if $data.noForms <> ''}>
    <fieldset><center><{$data.noForms}></center></fieldset>
<{/if}>
*}>

    <{$data.pagenav}>

<form action="<{$data.url}>" method="post">
<input type="hidden" name="selectStatus" id="selectStatus" value="<{$data.selectStatus}>" />

  <table class="outer width100 bspacing1">
    <thead>'
    <tr><th colspan="8"><{$smarty.const._AM_XFORMS_LISTING}></th></tr>
    <tr>
      <td class="head center bottom width5"><{$smarty.const._AM_XFORMS_NO}></td>
      <td class="head center bottom"><{$smarty.const._AM_XFORMS_TITLE}></td>
      <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_ORDER}><br><{$smarty.const._AM_XFORMS_ORDER_DESC}></td>
      <td class="head center bottom width5"><{$smarty.const._AM_XFORMS_STATUS}></td>
      <td class="head center bottom width5"><{$smarty.const._AM_XFORMS_ANSWER}></td>
      <td class="head center bottom width5"><{$smarty.const._AM_XFORMS_COLOR_SET}></td>
      <td class="head center bottom width15"><{$smarty.const._AM_XFORMS_SENDTO}></td>
      <td class="head center bottom width10"><{$smarty.const._AM_XFORMS_ACTION}></td>
    </tr>
    </thead>
    
    <tbody>
       <{foreach item=form from=$data.allForms}>
        <tr  <{$form.extra}> >    
          <td class="<{$form.ligne}> middle center"><{$form.id}></td>
          <td class="<{$form.ligne}> left"><{$form.title}></td>
          <td class="<{$form.ligne}> middle center"><{$form.order}></td>
          <td class="<{$form.ligne}> middle center"><{$form.setStatus}></td>
          <td class="<{$form.ligne}> middle center"><{$form.fAnswer}></td>
          <td class="<{$form.ligne}> middle center"><{$form.color_set}></td>
          <td class="<{$form.ligne}> middle center"><{$form.sendToTxt}></td>
          


          
          <{* ----- Actions ----- *}>
          <td class="<{$form.ligne}> center">
              <{$form.edit}>
              <{$form.elements}>
          <{* ----- <{$form.fAction}> ----- *}>
              
              
              <{$form.clone}>
              <{$form.delete}>
              <{$form.ids}>
              <{$form.view}>
              
          </td>
        </tr>    
      <{/foreach}>  
      
      <tr class='odd'>
        <td colspan='2'></td>
        <td class='center'><{$data.saveorder}></td>
        <td colspan='5'></td>
      </tr>
    </tbody>
  </table>
</form>

    <{$data.pagenav}>
<{if $data.noForms == ''}>
    <{$data.selectOnStatus}>     
<{/if}>

