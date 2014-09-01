<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$canEdit = $displayData['params']->get('access-edit');

if (empty($displayData['print'])) :
  if ($canEdit || $displayData['params']->get('show_print_icon') || $displayData['params']->get('show_email_icon')) : ?>
    <div class="btn-group pull-right">
      <?php if ($displayData['params']->get('show_print_icon')) :
        echo JHtml::_('icon.print_popup', $displayData['item'], $displayData['params']);
      endif;
      if ($displayData['params']->get('show_email_icon')) :
        echo JHtml::_('icon.email', $displayData['item'], $displayData['params']);
      endif;
      if ($canEdit) :
        echo JHtml::_('icon.edit', $displayData['item'], $displayData['params']);
      endif; ?>
    </div>
  <?php endif; ?>
<?php else : ?>
<div class="pull-right hidden-print">
  <?php echo JHtml::_('icon.print_screen', $displayData['item'], $displayData['params']); ?>
</div>
<?php endif; ?>