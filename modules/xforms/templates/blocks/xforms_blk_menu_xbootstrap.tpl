<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>

<{if $block.module.level==0}>
  <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;"><{$block.module.lib}><b class="caret"></b></a>
      <ul class="dropdown-menu">
<{/if}>

<{if $block.module.add_sep_before == 1}>
  <li><hr></li>
<{/if}>

<{if $block.module.level == 1}>
  <{if $block.module.nbMainMenu > 0}>
          <{foreach from=$block.main key=kItem item=mainItem}>
              <{if !empty($mainItem.submenu) }>
                <li class="dropdown-submenu">
                  <a href="<{$mainItem.url}>"><{$mainItem.lib}></a>
                  <ul class="dropdown-menu">
                    <{foreach from=$mainItem.submenu key=kSubmenu item=subMenu}>
                      <li><a href="<{$subMenu.url}>"><{$subMenu.lib}></a></li>
                    <{/foreach}>
                  </ul>
                </li>

              <{else}>
                <li><a href="<{$mainItem.url}>"><{$mainItem.lib}></a></li>
              <{/if}>
          <{/foreach}>
  <{/if}>
<{else}>
  <{if $block.module.nbMainMenu > 0}>
          <{foreach from=$block.main key=kItem item=mainItem}>
              <{if !empty($mainItem.submenu) }>
                    <{foreach from=$mainItem.submenu key=kSubmenu item=subMenu}>
                      <li><a href="<{$subMenu.url}>"><{$subMenu.lib}></a></li>
                    <{/foreach}>
              <{else}>
                <li><a href="<{$mainItem.url}>"><{$mainItem.lib}></a></li>
              <{/if}>
          <{/foreach}>
  <{/if}>
<{/if}>


<{if $block.module.add_sep_after == 1}>
  <li><hr></li>
<{/if}>



<{if $block.module.isMainMenu==1}>
      </ul>
<{/if}>

<{if $block.module.level==0}>
  </li>
<{/if}>
