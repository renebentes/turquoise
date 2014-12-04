<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

if ($show_list_desc == 1 && $description != '') : ?>
  <div class="well well-sm"><?php echo JHtml::_('content.prepare', $description); ?></div>
<?php endif; ?>
<?php if ($search->content > 0)
  echo $data;
else
  include dirname(__FILE__) . '/default_items.php';
if ($show_more_link != '') : ?>
  <a<?php echo $show_more_class; ?> href="<?php echo $show_more_link; ?>"><?php echo JText::_('MOD_CCK_LIST_VIEW_ALL'); ?></a>
<?php endif; ?>
<?php if ($show_list_desc == 2 && $description != '') : ?>
  <div class="well well-sm"><?php echo JHtml::_('content.prepare', $description); ?></div>
<?php endif; ?>