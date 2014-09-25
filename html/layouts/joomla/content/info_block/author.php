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
<dd class="extra-tooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_AUTHOR'); ?>" itemprop="author" itemscope itemtype="http://schema.org/Person">
  <span class="fa fa-user"></span>
  <?php $author = '<span itemprop="name">' . ($displayData['item']->created_by_alias ? $displayData['item']->created_by_alias : $displayData['item']->author)  . '</span>'; ?>
<?php if (!empty($displayData['item']->contactid ) && $displayData['params']->get('link_author') == true):?>
  <?php echo JHtml::_('link', $displayData['item']->contact_link, $author, array('itemprop' => 'url')); ?>
<?php else :?>
  <?php echo $author; ?>
<?php endif; ?>
</dd>