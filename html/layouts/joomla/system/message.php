<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$messageList = $displayData['msgList'];

$classes = array(
  'error'   => 'danger',
  'message' => 'success',
  'notice'  => 'info',
  'warning' => 'warning',
  ''        => 'success'
);

if (is_array($messageList) && !empty($messageList)) :
  foreach ($messageList as $type => $messages) : ?>
  <div class="alert alert-<?php echo $classes[strtolower($type)]; ?> alert-dismissible fade in" role="alert">
    <button type="button" class="close hasTooltip" title="<?php echo JText::_('TPL_TURQUOISE_CLOSE'); ?>" data-placement="bottom" data-dismiss="alert">
      <span aria-hidden="true">&times;</span>
      <span class="sr-only">Close</span>
    </button>
  <?php if (!empty($messages)) : ?>
    <h4><?php echo JText::_('TPL_TURQUOISE_MESSAGE_' . strtoupper($type)); ?></h4>
    <?php foreach ($messages as $message) : ?>
    <p><?php echo $message; ?></p>
    <?php endforeach; ?>
  <?php endif; ?>
  </div>
  <?php endforeach;
endif;