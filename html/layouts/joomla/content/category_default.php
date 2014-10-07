<?php
/**
 * @package     Turqupise
 * @subpackage  tpl_turqupise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$params    = $displayData->params;
$extension = $displayData->get('category')->extension;
$canEdit   = $params->get('access-edit');

if ($params->get('show_page_heading') || $params->get('show_category_title', 1) || $params->get('page_subheading')) : ?>
  <div class="page-header">
  <?php if ($params->get('show_page_heading')) : ?>
    <h1><?php echo $this->escape($params->get('page_heading')); ?></h1>
  <?php endif; ?>
  <?php if ($params->get('show_category_title', 1) || $params->get('page_subheading')) : ?>
    <h2><?php echo $this->escape($params->get('page_subheading'));
    if ($params->get('show_category_title')) : ?>
      <small><?php echo JHtml::_('content.prepare', $displayData->get('category')->title, '', $extension . '.category'); ?></small>
    <?php endif; ?>
    </h2>
  <?php endif; ?>
  </div>
<?php endif;
if ($params->get('show_cat_tags', 1) && !empty($displayData->get('category')->tags->itemTags)) :
  echo JLayoutHelper::render('joomla.content.tags', $displayData->get('category')->tags->itemTags);
endif;
if ($params->get('show_description', 1) || $params->def('show_description_image', 1)) : ?>
  <div class="well well-sm clearfix">
  <?php if ($params->get('show_description_image') && $displayData->get('category')->getParams()->get('image')) : ?>
    <figure class="col-md-4">
      <img class="img-responsive" src="<?php echo $displayData->get('category')->getParams()->get('image'); ?>"/>
    </figure>
  <?php endif; ?>
  <?php if ($params->get('show_description') && $displayData->get('category')->description) : ?>
    <?php if ($params->get('show_description_image') && $displayData->get('category')->getParams()->get('image')) : ?>
    <div class="col-md-8">
    <?php endif; ?>
    <?php echo JHtml::_('content.prepare', $displayData->get('category')->description, '', $extension . '.category'); ?>
    <?php if ($params->get('show_description_image') && $displayData->get('category')->getParams()->get('image')) : ?>
    </div>
    <?php endif; ?>
  <?php endif;?>
  </div>
<?php endif;
  echo $displayData->loadTemplate($displayData->subtemplatename); ?>