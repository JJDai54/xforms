<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>

<{if !empty($block)}>
    <div class="xforms-blk-list">
    <ul>
    <{foreach from=$block key=id item=txt}>
        <li>
        <a href="<{$xoops_url}>/modules/xforms/index.php?form_id=<{$id}>" title="<{$txt.desc}>"><{$txt.title}></a>
        </li>
    <{/foreach}>
    </ul>
    </div>
<{/if}>
