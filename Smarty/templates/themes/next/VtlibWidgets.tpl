{*+*************************************************************************************
 * The contents of this file are subject to the VTECRM License Agreement
 * ("licenza.txt"); You may not use this file except in compliance with the License
 * The Original Code is: VTECRM
 * The Initial Developer of the Original Code is VTECRM LTD.
 * Portions created by VTECRM LTD are Copyright (C) VTECRM LTD.
 * All Rights Reserved.
 ***************************************************************************************}
{* crmv@115268 *} {* crmv@181170 *}
{if $CUSTOM_LINKS && !empty($CUSTOM_LINKS.$WIDGETTYPE)}
	<table border=0 cellspacing=0 cellpadding=5 width=100% id="DetailViewWidgets"> {* crmv@104566 *}
	{assign var="widgetcount" value=0}
	{assign var="widgettotal" value=0}
	{foreach name=detailviewwidget item=CUSTOM_LINK_DETAILVIEWWIDGET from=$CUSTOM_LINKS.$WIDGETTYPE}
		{if !$CUSTOM_LINK_DETAILVIEWWIDGET->validateDisplayWidget($ID)}
			{continue}
		{/if}

		{assign var="widgettotal" value=$widgettotal+1}
		
		{if $CUSTOM_LINK_DETAILVIEWWIDGET->linklabel eq 'DetailViewMyNotesWidget'}
			{assign var="widgetmynotes" value=true}
			{assign var="widgetplain" value=true}
		{else}
			{assign var="widgetmynotes" value=false}
			{assign var="widgetplain" value=false}
		{/if}
		
		{if $CUSTOM_LINK_DETAILVIEWWIDGET->size eq 2}
			<tr>
				<td colspan="2" id="detailviewwidget{$smarty.foreach.detailviewwidget.iteration}">
					<div class="detailViewWidget detailViewWidgetFull {if $widgetplain eq true}detailViewWidgetPlain{/if}">
						{* crmv@168573 *}
						{if $CUSTOM_LINK_DETAILVIEWWIDGET->linklabel neq 'DetailViewMyNotesWidget'}
							{include file='DetailViewWidgetHeader.tpl'}
						{/if}
						{* crmv@168573e *}
						<div class="row">
							<div class="col-sm-12">
								<div class="detailViewWidgetContent">
									{$CUSTOM_LINK_DETAILVIEWWIDGET->displayWidgetContent($ID)}
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
		{elseif $CUSTOM_LINK_DETAILVIEWWIDGET->size eq 1}
			{if $widgetcount eq 0}	
		   		<tr valign="top">
			{/if}
			{assign var="widgetcount" value=$widgetcount+1}
			{if $widgetcount eq 1}
				{assign var="widgetdirection" value="Left"}
			{else}
				{assign var="widgetdirection" value="Right"}
			{/if}
			<td width="50%" id="detailviewwidget{$smarty.foreach.detailviewwidget.iteration}">
				<div class="detailViewWidget detailViewWidget{$widgetdirection} {if $widgetplain eq true}detailViewWidgetPlain{/if}">
					{* crmv@168573 *}
					{if $widgetmynotes eq false}
						{include file='DetailViewWidgetHeader.tpl'}
					{/if}
					{* crmv@168573e *}
					<div class="row">
						<div class="col-sm-12">
							<div class="detailViewWidgetContent"> 
								{$CUSTOM_LINK_DETAILVIEWWIDGET->displayWidgetContent($ID)}
							</div>
						</div>
					</div>
				</div>
			</td>
			{if $widgetcount eq 2}
				</tr>
				{assign var="widgetcount" value=0}
			{/if}
		{/if}
	{/foreach}
	{if $widgettotal is not even}
		<td width="50%" id="detailviewwidget0"></td>
		</tr>
	{/if}
	</table>
{/if}
