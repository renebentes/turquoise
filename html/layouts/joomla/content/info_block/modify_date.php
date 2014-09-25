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
<dd class="extra-tooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_UPDATE_DATE'); ?>">
  <span class="fa fa-calendar"></span>
  <time datetime="<?php echo JHtml::_('date', $displayData['item']->modified, 'c'); ?>" itemprop="dateModified">
    <?php echo JHtml::_('date', $displayData['item']->modified, JText::sprintf('DATE_FORMAT_LC3')); ?>
  </time>
</dd>