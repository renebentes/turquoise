<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// no direct access
defined('_JEXEC') or die;
?>

<ul class="newsflash-vert list-unstyled">
	<?php for ($i = 0, $n = count($list); $i < $n; $i ++) :
	$item = $list[$i]; ?>
	<li class="newsflash-item">
		<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_item');
	if ($n > 1 && (($i < $n - 1) || $params->get('showLastSeparator'))) : ?>
		<span class="article-separator">&#160;</span>
		<?php endif; ?>
	</li>
	<?php endfor; ?>
</ul>
