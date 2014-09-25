<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$blockPosition = $displayData['params']->get('info_block_position', 0);
?>
<dl class="article-details text-muted pull-left">
<?php if ($displayData['position'] == 'above' && ($blockPosition == 0 || $blockPosition == 2) || $displayData['position'] == 'below' && ($blockPosition == 1)) : ?>
  <?php if ($displayData['params']->get('info_block_show_title', 0) == 1) : ?>
  <dt>
    <?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?>
  </dt>
  <?php endif; ?>
  <?php if ($displayData['params']->get('show_author') && !empty($displayData['item']->author )) : ?>
    <?php echo JLayoutHelper::render('joomla.content.info_block.author', $displayData); ?>
  <?php endif; ?>

  <?php if ($displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug)) : ?>
    <?php echo JLayoutHelper::render('joomla.content.info_block.parent_category', $displayData); ?>
  <?php endif; ?>

  <?php if ($displayData['params']->get('show_category')) : ?>
    <?php echo JLayoutHelper::render('joomla.content.info_block.category', $displayData); ?>
  <?php endif; ?>

  <?php if ($displayData['params']->get('show_publish_date')) : ?>
    <?php echo JLayoutHelper::render('joomla.content.info_block.publish_date', $displayData); ?>
  <?php endif; ?>
<?php endif; ?>
<?php if ($displayData['position'] == 'above' && ($blockPosition == 0) || $displayData['position'] == 'below' && ($blockPosition == 1 || $blockPosition == 2)) : ?>
  <?php if ($displayData['params']->get('show_create_date')) : ?>
    <?php echo JLayoutHelper::render('joomla.content.info_block.create_date', $displayData); ?>
  <?php endif; ?>

  <?php if ($displayData['params']->get('show_modify_date')) : ?>
    <?php echo JLayoutHelper::render('joomla.content.info_block.modify_date', $displayData); ?>
  <?php endif; ?>

  <?php if ($displayData['params']->get('show_hits')) : ?>
    <?php echo JLayoutHelper::render('joomla.content.info_block.hits', $displayData); ?>
  <?php endif; ?>
<?php endif; ?>
</dl>