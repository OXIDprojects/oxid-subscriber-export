[{* debug *}]

[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<script type="text/javascript">
    if (top) {
        top.sMenuItem    = "[{ oxmultilang ident="mxservice" }]";
        top.sMenuSubItem = "[{ oxmultilang ident="PBI_MAILEXPORT" }]";
        top.sWorkArea    = "[{$_act}]";
        top.setTitle();
    }
</script>

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
	<input type="hidden" name="cl" value="pbi_mailexport">
	<input type="hidden" name="fnc" value="">
	<input type="hidden" name="oxid" value="[{ $oxid }]">
	<input type="hidden" name="voxid" value="[{ $oxid }]">
</form>

<div id="pbi_mailexport">
    
	<form action="[{ $oViewConf->getSelfLink() }]" method="post">
		[{ $oViewConf->getHiddenSid() }]
		<input type="hidden" name="cl" value="pbi_mailexport">
		<input type="hidden" name="fnc" value="">
		<input type="hidden" name="oxid" value="[{ $oxid }]">
		<input type="hidden" name="voxid" value="[{ $oxid }]">
		
		<div class="pbi_exportform_row">
			
			<label for="pbi_exportform_stateid">[{oxmultilang ident="PBI_MAILEXPORT_STATEID_LABEL"}]</label>

			<select id="pbi_exportform_stateid" name="pbi_exportform_stateid" onchange="this.form.submit()">
				<option value="0" [{ if 0 == $optinid}]selected[{/if}]>[{oxmultilang ident="PBI_MAILEXPORT_STATEID0"}]</option>
				<option value="1" [{ if 1 == $optinid}]selected[{/if}]>[{oxmultilang ident="PBI_MAILEXPORT_STATEID1"}]</option>
				<option value="2" [{ if 2 == $optinid}]selected[{/if}]>[{oxmultilang ident="PBI_MAILEXPORT_STATEID2"}]</option>
			</select>

			<!-- <input type="submit" value="[{oxmultilang ident="PBI_MAILEXPORT_REFRESH"}]"> -->
			
		</div>
	</form>


	<form action="[{ $oViewConf->getSelfLink() }]" method="post">
		[{ $oViewConf->getHiddenSid() }]
		<input type="hidden" name="cl" value="pbi_mailexport">
		<input type="hidden" name="fnc" value="export">
		<input type="hidden" name="oxid" value="[{ $oxid }]">
		<input type="hidden" name="voxid" value="[{ $oxid }]">

		<input type="hidden" name="pbi_exportform_stateid" value="[{$optinid}]">

		<div class="pbi_exportform_row">
			
			[{oxmultilang ident="PBI_MAILEXPORT_EXPORTAMOUNT"}] [{$optinid_counter}]

			<input name="pbi_exportform_refresh" type="submit" value="[{oxmultilang ident="PBI_MAILEXPORT_EXPORT"}]">
					
		</div>
	</form>
</div>
