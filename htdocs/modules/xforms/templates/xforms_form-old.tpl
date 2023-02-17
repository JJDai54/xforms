<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>


<{if '' != $form_intro}>
<{/if}>
<style>
.Xforms\intro{
  background-color: #C8EBFA;
  border: 1px solid;
  width: 100%;
  padding: 8px;
  border-radius: 8px 8px 0px 0px;

}
.Xforms\Foot{
  background-color: #C8EBFA;
  border: 1px solid;
  width: 100%;
  padding: 8px;
  border-radius: 0px 0px 8px 8px;

}

#xFormInput td{
  padding:12px;
}

.tblForm {
  border:0px;
}
.tblForm td{
  border:0px;
}
</style>



<{* ================================================== *}>
<div class="item-head <{$form_color_set}>-item-head"><p><h1 class="center"><{$form_output.title}></h1></p></div>

<div class="item-info <{$form_color_set}>-item-info"><p><{$form_intro}></p></div>

<div id="xforms">

<{$form_output.javascript}>
<form name="<{$form_output.name}>" id="<{$form_output.name}>" action="<{$form_output.action}>" method="<{$form_output.method}>" class="xforms" <{$form_output.extra}>>
<table id="xFormInput" name="xFormInput" class="outer bspacing1 tblForm  <{$form_color_set}>-item-body" width="100%">
<{foreach item=element from=$form_output.elements}>
    <{if 'html' != $element.ele_type}>
        <{if true != $element.hidden}>
            <{if 1 == $element.display_row}>
                <tr>

                <td class="head width33">
                  <{if '' == $element.caption}>&nbsp;<{/if}>
                  <{if 1 == $element.required}><{$form_req_prefix}><{/if}>
                  <{$element.caption}>
                  <{if 1 == $element.required}><{$form_req_suffix}><{/if}>
                </td>
                <td class="<{cycle values="even,odd"}> width66">
                  <{$element.body}>
                </td>
                </tr>
            <{else}>
                <tr><td class="head" colspan="2">
                <{if '' == $element.caption}>&nbsp;<{/if}>
                <{if 1 == $element.required}><{$form_req_prefix}><{/if}>
                <{$element.caption}>
                <{if 1 == $element.required}><{$form_req_suffix}><{/if}>
                </td></tr>
                <tr><td class="<{cycle values="even,odd"}>" colspan="2"><{$element.body}></td></tr>
            <{/if}>
        <{/if}>
    <{else}>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td colspan="2" class="outer center bold pad5"><{$element.body}></td></tr>
    <{/if}>
<{/foreach}>
</table>
<{foreach item=element from=$form_output.elements}>
    <{if true == $element.hidden}><{$element.body}><{/if}>
<{/foreach}>

</form>
</div>


<div class="item-foot <{$form_color_set}>-item-foot">
<{if '' != $form_text_global}><{$form_text_global}><{/if}>
<{if '' != $form_edit_link}>
    <a href="<{$form_edit_link.location}>" class="floatleft" target="<{$form_edit_link.target}>"><img src="<{$form_edit_link.icon_location}>" alt="<{$form_edit_link.icon_alt}>" title="<{$form_edit_link.icon_title}>"></a>
<{/if}>

</div>
