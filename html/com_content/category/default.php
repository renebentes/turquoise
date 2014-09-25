<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
JHtml::addIncludePath(dirname(dirname(__FILE__)));

?>
<section class="category-list<?php echo $this->pageclass_sfx; ?>">
<?php if ($this->params->get('show_page_heading') or $this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
  <div class="page-header">
  <?php if ($this->params->get('show_page_heading')) : ?>
    <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
  <?php endif; ?>
  <?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
    <h2><?php echo $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title')) : ?>
      <small><?php echo $this->category->title; ?></small>
    <?php endif; ?>
    </h2>
  <?php endif; ?>
  </div>
<?php endif; ?>

<?php if (($this->params->get('show_description_image') && $this->category->getParams()->get('image')) || ($this->params->get('show_description') && $this->category->description)) : ?>
  <div class="well well-sm clearfix">
  <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
    <img class="img-responsive pull-left" src="<?php echo $this->category->getParams()->get('image'); ?>"/>
  <?php endif; ?>
  <?php if ($this->params->get('show_description') && $this->category->description) : ?>
    <?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
  <?php endif;?>
  </div>
<?php endif; ?>

  <?php echo $this->loadTemplate('articles'); ?>
</section>

<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
<section class="cat-children">
  <div class="panel panel-info">
  <?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?></h3>
    </div>
  <?php endif; ?>
    <?php echo $this->loadTemplate('children'); ?>
  </div>
</section>
<?php endif; ?>