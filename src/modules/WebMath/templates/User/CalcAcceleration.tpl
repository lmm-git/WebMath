{include file='User/Includes/Header.tpl'}
{pagesetvar name='title' __value='calculating acceleration'}

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


<div class="z-formbuttons z-buttons">
	{formbutton class="z-bt-ok" commandName="calc" __text="Calc"}
	{formbutton class="z-bt-cancel" commandName="cancel" __text="Cancel"}
</div>

{/form}

{include file='User/Includes/Footer.tpl'}
