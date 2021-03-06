<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');
?>
<dd class="extra-tooltip" title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CATEGORY'); ?>">
  <span class="fa fa-folder"></span>
  <?php $title = $this->escape($displayData['item']->category_title);
if ($displayData['params']->get('link_category') && $displayData['item']->catslug) :
  $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->catslug)) . '" itemprop="genre">' . $title . '</a>';
  echo $url;
else :
  echo '<span itemprop="genre">' . $title . '</span>';
endif; ?>
</dd>