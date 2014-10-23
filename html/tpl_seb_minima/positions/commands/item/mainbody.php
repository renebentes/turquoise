<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!'); ?>

<?php if ($cck->getValue('command_end_date') == '0000-00-00 00:00:00' || $cck->getValue('command_end_date') == '') : ?>
<div class="command">
<?php endif; ?>
<?php if ($cck->getValue('command_photo')) : ?>
  <img class="img-responsive hasTooltip center-block" src="<?php echo $cck->get('command_photo')->thumb2; ?>" title="<?php echo $cck->getValue('command_title'); ?>" alt="<?php echo $cck->getValue('command_title'); ?>"/>
<?php else : ?>
  <span class="fa fa-image"></span>
<?php endif; ?>
  <h5 class="text-center"><?php echo str_replace($cck->getValue('command_nick'), '<strong>' . $cck->getValue('command_nick') . '</strong>', $cck->getValue('command_title')); ?></h5>
<?php if ($cck->getValue('command_end_date') == '0000-00-00 00:00:00' || $cck->getValue('command_end_date') == '') : ?>
  <p class="small">Início de Comando: <?php echo JHtml::_('date', $cck->getValue('command_start_date'), 'd M Y', null); ?></p>
<?php else : ?>
  <p class="small text-center">Período: <?php echo JHtml::_('date', $cck->getValue('command_start_date'), 'd M Y', null); ?> - <?php echo JHtml::_('date', $cck->getValue('command_end_date'), 'd M Y', null); ?></p>
<?php endif; ?>
<?php if ($cck->getValue('command_end_date') == '0000-00-00 00:00:00' || $cck->getValue('command_end_date') == '') : ?>
</div>
<?php endif; ?>