{pagesetvar name='title' value=$title}

{include file='User/Includes/Header.tpl'}

<h1>{$title}</h1>



{if $result ne ""}
<h3>{gt text="Results:"}</h3>
<ul>
	<li>&alpha; = 90&deg;</li>
	{$result}
</ul>
{else}
<p class="z-informationmsg">
	{gt text='Here is a overview of the identifiers of the triangle:'}
</p>
{/if}

<p style="text-align: center;"><img src="{$baseurl}modules/WebMath/images/triangle_right_angled.png" style="text-align: center;" /></p>

<form class="z-form" action="{modurl modname='webmath' type='user' func='rightangledtriangle'}" method="post">

	<div>
		<fieldset>
			<legend>{gt text="Put in what you know..."}</legend>

		<input type="hidden" name="tries" value="1" />		
		
		<!--<div class="z-formrow">
			<label>{gt text="Angle"} &alpha;</label>
			<input id="alpha" type="text" name="alpha" size="20" maxlength="100" value="90 (fixed)" />
		</div>-->
		
			<div class="z-formrow">
				<label for="beta">{gt text="Angle"} &beta;</label>
				<input id="beta" type="text" name="beta" size="20" maxlength="100" value="{$beta}" />
			</div>

		
		<div class="z-formrow">
				<label for="gamma">{gt text="Angle"} &gamma;</label>
				<input id="gamma" type="text" name="gamma" size="20" maxlength="100" value="{$gamma}" />
		</div>		   

		<div class="z-formrow">
				<label for="sa">{gt text="Side"} a</label>
				<input id="sa" type="text" name="sa" size="20" maxlength="100" value="{$sa}" />
		</div> 
		
		<div class="z-formrow">
				<label for="sb">{gt text="Side"} b</label>
				<input id="sb" type="text" name="sb" size="20" maxlength="100" value="{$sb}" />
		</div>
		
		<div class="z-formrow">
				<label for="sc">{gt text="Side"} c</label>
				<input id="sc" type="text" name="sc" size="20" maxlength="100" value="{$sc}" />
		</div>
			
		</fieldset>

		<div class="z-formbuttons">
			<button type="submit" name="submit" title="{gt text='Send}"><img src="/images/icons/small/button_ok.gif" alt="{gt text='Send}" /></button>
		</div>

	</div>
</form>


{include file='User/Includes/Footer.tpl'}
