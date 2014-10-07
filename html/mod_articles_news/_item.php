<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access!');

if ($params->get('item_title')) : ?>
  <<?php echo $params->get('item_heading'); ?>>
  <?php if ($params->get('link_titles') && $item->link != '') : ?>
    <a href="<?php echo $item->link;?>">
      <?php echo $item->title;?>
    </a>
  <?php else : ?>
    <?php echo $item->title; ?>
  <?php endif; ?>
  </<?php echo $params->get('item_heading'); ?>>
<?php endif; ?>

<?php if (!$params->get('intro_only')) :
	echo $item->afterDisplayTitle;
endif; ?>

<?php echo $item->beforeDisplayContent; ?> <?php echo $item->introtext; ?>
<?php if (isset($item->link) && $item->readmore && $params->get('readmore')) :
	echo '<a class="pull-right" href="' . $item->link . '"><i class="glyphicon glyphicon-circle-arrow-right"></i>' . $item->linkText . '</a>';
  echo '<div class="clearfix"></div>';
endif; ?>