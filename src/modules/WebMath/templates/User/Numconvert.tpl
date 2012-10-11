{pagesetvar name='title' value='Convert a number'}
{insert name='getstatusmsg'}

{include file='User/Includes/Header.tpl'}

<h1>{gt text="Convert a number"}</h1>

{if $results ne ""}
<h3>{gt text="Results:"}</h3>
<ul>
	{$results}
</ul>
{else}
<p class="z-informationmsg">
	{gt text='You can put in 2-36 as "input format" and as "output format". In this case decimal is 10 and binary is 2.'}
</p>
{/if}

<form class="z-form" action="{modurl modname='webmath' type='user' func='numconvert'}" method="post">

	<div>
		<fieldset>
			<legend>{gt text="Convert..."}</legend>

		<input type="hidden" name="tries" value="1" />

			<div class="z-formrow">
				<label for="number">{gt text="Number"}</label>
				<input id="number" type="text" name="number" size="20" maxlength="100" value="{$number}" />
			</div>

		
		<div class="z-formrow">
				<label for="format_given">{gt text="Input format"}</label>
				<input id="format_given" type="text" name="format_given" size="20" maxlength="2" value="{$format_given}" />
			</div>		   

		<div class="z-formrow">
				<label for="format_wanted">{gt text="Output format"}</label>
				<input id="format_wanted" type="text" name="format_wanted" size="20" maxlength="2" value="{$format_wanted}" />
			</div> 
			
					</fieldset>

		<div class="z-formbuttons">
			<button type="submit" name="submit" title="{gt text="Send"}"><img src="/images/icons/small/button_ok.gif" alt="{gt text="Send"}" /></button>
		</div>

	</div>
</form>


{include file='User/Includes/Footer.tpl'}
