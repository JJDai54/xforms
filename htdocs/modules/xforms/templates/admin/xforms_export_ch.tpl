<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>

<{strip}>
"<{$smarty.const._AM_XFORMS_RPT_USER}>"<{$delim}>"<{$smarty.const._AM_XFORMS_RPT_DATETIME}>"<{$delim}>"<{$smarty.const._AM_XFORMS_RPT_IP}>"
<{foreach item=caption from=$captions}>
  <{$delim}>"<{$caption}>"
<{/foreach}>
<{/strip}>
<{* start of element loop*}>
<{foreach item=rptLine from=$rptArray}>
<{strip}>
"<{$rptLine.user}>"<{$delim}>"<{$rptLine.time}>"<{$delim}>"<{$rptLine.ip}>"
        <{foreach item=element from=$rptLine.elements}>
          <{$delim}>"<{$element}>"
        <{/foreach}>
<{/strip}>
<{/foreach}>
