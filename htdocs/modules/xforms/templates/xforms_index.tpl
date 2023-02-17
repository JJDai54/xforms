<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>


<{if $forms}>
<div id="xforms">
    <div class="item-head">
      <h1 class="center"><{$default_title}></h1>
    </div>
    <div id="xforms" class="item-foot" style="text-align:center">
        <p><{$forms_intro}></p>
    </div>
<br>
    <{foreach item=form from=$forms}>
        <div class="item-head <{$form.color_set}>-item-head">
          <h2>
            <{* <span  class="item-title"><a href="index.php?form_id=<{$form.id}>"><{$form.title}></a></span> *}>
            <span><a href="index.php?form_id=<{$form.id}>"><{$form.title}></a></span>
          </h2>
        </div>
        <div  class="item-body <{$form.color_set}>-item-body">
        <p><{$form.desc}></p>
        </div>

        <div class="item-foot <{$form.color_set}>-item-foot">
          <a href="<{$form.form_edit_link.location}>" class="middle inline" style="padding-left: 1em;" target="<{$form.form_edit_link.target}>">
            <img src="<{$form.form_edit_link.icon_location}>" alt="<{$form.form_edit_link.icon_alt}>" title="<{$form.form_edit_link.icon_title}>">
          </a>
        </div><br>
    <{/foreach}>
<{else}>
    <h4 class="center"><{$noform}></h4>
<{/if}>
</div>
