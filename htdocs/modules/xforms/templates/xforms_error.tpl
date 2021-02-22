<{if $smarty.const._XFORMS_SHOW_TPL_NAME==1}>
<div style="text-align: center; background-color: black;"><span style="color: yellow;">Template : <{$smarty.template}></span></div>
<{/if}>

<div id="xforms">
<h4><{$error_heading}></h4>
<div class="errorMsg">
<{section name=err loop=$errors}>
    <{$errors[err]}>
    <br>
<{/section}>
<a href="<{$xforms_url}>" onclick="ReturnToForm();"><{$go_back}></a>
</div>
<{*
<script type="text/javascript">function ReturnToForm() {window.location = "<{$xforms_url}>";} window.setTimeout("ReturnToForm()", 6000);</script>
*}>


<script type="text/javascript">
function ReturnToForm() {window.location = "javascript:history.go(0)"} window.setTimeout("ReturnToForm()", 6000);

</script>


</div>
