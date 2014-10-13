<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!'); ?>

<div class="thumbnail command">
<?php if ($cck->getValue('command_photo')) : ?>
  <img class="img-responsive hasTooltip center-block" src="<?php echo $cck->getValue('command_photo')->thumb2; ?>" title="<?php echo $cck->getValue('command_title'); ?>" alt="<?php echo $item->getValue('command_title'); ?>"/>
<?php else : ?>
  <span class="fa fa-image"></span>
<?php endif; ?>
  <div class="caption">
    <h4>
      <?php echo str_replace($cck->getValue('command_nick'), '<strong>' . $cck->getValue('command_nick') . '</strong>', $cck->getValue('command_title')); ?>
    </h4>
    <p>Período de Comando: <?php echo $cck->getValue('command_start_date'); ?></p>
  </div>
</div>