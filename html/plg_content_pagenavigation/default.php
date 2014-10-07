<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

defined('_JEXEC') or die; ?>

<ul class="pager">
<?php if ($row->prev) : ?>
  <li class="previous">
    <a class="hasTooltip" href="<?php echo $row->prev; ?>" title="<?php echo JText::_('JPREVIOUS') . ': ' . $row->prevTitle; ?>"><i class="fa fa-long-arrow-left"></i></a>
  </li>
<?php else : ?>
  <li class="previous disabled">
    <a class="hasTooltip" href="#" title="<?php echo JText::_('JPREVIOUS'); ?>"><i class="fa fa-long-arrow-left"></i></a>
  </li>
<?php endif; ?>
<?php if ($row->next) : ?>
  <li class="next">
    <a class="hasTooltip" href="<?php echo $row->next; ?>" title="<?php echo JText::_('JNEXT') . ': ' . $row->nextTitle; ?>"><i class="fa fa-long-arrow-right"></i></a>
  </li>
<?php else : ?>
  <li class="next disabled">
    <a class="hasTooltip" href="#" title="<?php echo JText::_('JNEXT'); ?>"><i class="fa fa-long-arrow-right"></i></a>
  </li>
<?php endif; ?>
</ul>
