{pagesetvar name='title' __value='Calculating acceleration'}
{include file='User/Includes/Header.tpl'}

<h3>{gt text="Calculating acceleration"}</h3>

{form cssClass="z-form"}
{formerrormessage id='error'}
{formvalidationsummary}


<fieldset>
	<legend>{gt text='General information'}</legend>

	<div class="z-formrow">
		{formlabel for="acceleration" __text='Acceleration in m/s^2' mandatorysym=true}
		{formfloatinput id="acceleration" maxLength="80" mandatory=true text='10'}
	</div>

	<div class="z-formrow">
		{formlabel for="time" __text='Time in seconds' mandatorysym=true}
		{formfloatinput id="time" mandatory=true text=10}
	</div>

</fieldset>

<fieldset>
	<legend>{gt text='Optional information'}</legend>

	<div class="z-formrow">
		{formlabel for="cw" __text='Coefficient of drag c_w'}
		{formfloatinput id="cw"}
	</div>

	<div class="z-formrow">
		{formlabel for="density" __text='Density d'}
		{formfloatinput id="density"}
	</div>

	<div class="z-formrow">
		{formlabel for="area" __text='Cross-section area A'}
		{formfloatinput id="area"}
	</div>

	<div class="z-formrow">
		{formlabel for="mass" __text='Mass of the object m'}
		{formfloatinput id="mass"}
	</div>


</fieldset>


{$distanceGraph}
{if $distanceGraph}
	<a href="javascript:void(0);" onclick="document.getElementById('distanceTable').style.display = ''; this.style.display = 'none';">{gt text="Show datatable"}</a>

	<table id="distanceTable" class="z-datatable" style="width: 100%; display: none;" width="100%; border: 1px solid grey;">
		<thead style="width: 100%;">
			<tr>
				<th>{gt text="x"}</th>
				<th>{gt text="y"}</th>
			</tr>
		</thead>
		<tbody id="WorkerPlan_Conditions_TableBody">
		
			{foreach from=$distanceValue item='item' key='key'}
				<tr class="{cycle values='z-odd,z-even'}">
					<td>{$key}</td>
					<td>{$item}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
{/if}

{$speedGraph}

{if $speedGraph}
	<a href="javascript:void(0);" onclick="document.getElementById('speedTable').style.display = ''; this.style.display = 'none';">{gt text="Show datatable"}</a>
	<table id="speedTable" class="z-datatable" style="width: 100%; display: none;" width="100%; border: 1px solid grey;">
		<thead style="width: 100%;">
			<tr>
				<th>{gt text="x"}</th>
				<th>{gt text="y"}</th>
			</tr>
		</thead>
		<tbody id="WorkerPlan_Conditions_TableBody">
		
			{foreach from=$speedValue item='item' key='key'}
				<tr class="{cycle values='z-odd,z-even'}">
					<td>{$key}</td>
					<td>{$item}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
{/if}


<div class="z-formbuttons z-buttons">
	{formbutton class="z-bt-ok" commandName="calc" __text="Calc"}
	{formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
</div>

{/form}



{include file='User/Includes/Footer.tpl'}
