<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

if ($item->getValue('command_photo')) : ?>
  <img class="img-responsive hasTooltip" src="<?php echo $item->getValue('command_photo')->thumb2; ?>" title="<?php echo $item->getValue('command_title'); ?>" alt="<?php echo $item->getValue('command_title'); ?>"/>
<?php else : ?>
  <span class="fa fa-image fa-6x"></span>
<?php endif; ?>