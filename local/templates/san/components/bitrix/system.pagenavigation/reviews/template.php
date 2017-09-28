<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arResult */
/** @global CMain $APPLICATION */

$iCur = $arResult['NavPageNomer'];
$iEnd = $arResult['nEndPage'];
if ($iEnd <= 1)
	return;

$url = $APPLICATION->GetCurPageParam('', array('page', 'city'));
if (strpos($url, '?') !== false)
	$urlPage = $url . '&page=';
else
	$urlPage = $url . '?page=';

$iStart = $iCur - 2;
$iFinish = $iCur + 2;
if ($iStart < 1) {
	$iFinish -= $iStart - 1;
	$iStart = 1;
}
if ($iFinish > $iEnd) {
	$iStart -= $iFinish - $iEnd;
	if ($iStart < 1) {
		$iStart = 1;
	}
	$iFinish = $iEnd;
}

?>
<div class="el-page engBox-body">
	<ul><?

		if ($iCur > 1) {
			if ($iCur == 2)
				$href = $url;
			else
				$href = $urlPage . ($iCur - 1);
			?>
			<li class="prev">
			<a href="<?= P_HREF ?><?= $href ?>" data-page="<?= ($iCur - 1) ?>"></a>
			</li><?
		} else {
			?>
			<li class="prev">
				<span></span>
			</li><?
		}
		if ($iStart > 1) {
			$href = $url;
			?>
			<li>
			<a href="<?= P_HREF ?><?= $href ?>" data-page="1">1</a>
			</li><?

			if ($iStart > 2) {
				?>
				<li>
					<span>...</span>
				</li><?
			}
		}
		for ($i = $iStart; $i <= $iFinish; $i++) {
			if ($i == $iCur) {
				?>
				<li>
				<span class="active"><?= $i ?></span>
				</li><?
			} else {
				if ($i == 1)
					$href = $url;
				else
					$href = $urlPage . $i;
				?>
				<li>
				<a href="<?= P_HREF ?><?= $href ?>" data-page="<?= $i ?>"><?= $i ?></a>
				</li><?
			}
		}
		if ($iFinish < $iEnd) {
			if ($iFinish < $iEnd - 1) {
				?>
				<li>
					<span>...</span>
				</li><?
			}

			$href = $urlPage . $iEnd;
			?>
			<li>
			<a href="<?= P_HREF ?><?= $href ?>" data-page="<?= $iEnd ?>"><?= $iEnd ?></a>
			</li><?
		}
		if ($iCur < $iEnd) {
			$href = $urlPage . ($iCur + 1);
			?>
			<li class="next">
			<a href="<?= P_HREF ?><?= $href ?>" data-page="<?= ($iCur + 1) ?>"></a>
			</li><?
		} else {
			?>
			<li class="next">
				<span></span>
			</li><?
		}

		?>
	</ul>
</div><?
