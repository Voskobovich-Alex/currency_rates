<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<?
$currentRate = $arResult["ITEMS"][$arResult["CURRENT_CODE"]];
?>
<p><?=Loc::getMessage("TEXT")?> <?=$arResult["ACTUAL_DATE"]?></p>
<form method="post" name="convert" action="" class="form" id="convert">
	<div class="form__container">
		<div class="form__block"  id="cur_from">
			<input type="number" data-cur="<?=$currentRate["CURRENCY"]?>" value="1"/>
			<select>
			<?foreach ($arResult["ITEMS"] as $arItem) {?>
				<option 
					data-id="<?=$arItem["ID"]?>"
					value="<?=$arItem["CURRENCY"]?>"
					<?if($arParams["CUR_FROM"]==$arItem['CURRENCY']){?>selected<?}?>
					> <?=$arItem["CURRENCY"]?>
				</option>
			<?}?>
			</select>
		</div>
		<div class="form__block" id="cur_to">
			<input  type="number" data-cur="<?=$arParams["CUR_TO"]?>" value="<?=$currentRate["RATE"]?>"/>
			<select>
			<option data-id="" value="<?=$arParams["CUR_TO"]?>" selected ><?=$arParams["CUR_TO"]?></option>
			<?foreach ($arResult["ITEMS"] as $arItem) {?>
				<option 
					data-id="<?=$arItem["ID"]?>"
					value="<?=$arItem["CURRENCY"]?>"
					> <?=$arItem["CURRENCY"]?>
				</option>
			<?}?>
			</select>
		</div>
		<div class="form__button"><button><?=Loc::getMessage("BUTTON")?></button></div>
	</div>
</form>
