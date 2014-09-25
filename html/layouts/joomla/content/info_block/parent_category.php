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
<dd class="extra-tooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PARENT_CATEGORY'); ?>">
  <span class="fa fa-folder-open"></span>
  <?php $title = $this->escape($displayData['item']->parent_title);
if ($displayData['params']->get('link_parent_category') && !empty($displayData['item']->parent_slug)) :
  $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData['item']->parent_slug)) . '" itemprop="genre">' . $title . '</a>';
  echo $url;
else :
  echo '<span itemprop="genre">' . $title . '</span>';
endif; ?>
</dd>