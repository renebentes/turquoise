<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::addIncludePath(dirname(dirname(__FILE__)));

?>

<section class="blog<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog">
<?php if ($this->params->get('show_page_heading') || $this->params->get('show_category_title', 1) || $this->params->get('page_subheading')) : ?>
  <div class="page-header">
  <?php if ($this->params->get('show_page_heading')) : ?>
    <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
  <?php endif; ?>
  <?php if ($this->params->get('show_category_title', 1) || $this->params->get('page_subheading')) : ?>
    <h2><?php echo $this->escape($this->params->get('page_subheading'));
    if ($this->params->get('show_category_title')) : ?>
      <small><?php echo $this->category->title; ?></small>
    <?php endif; ?>
    </h2>
  <?php endif; ?>
  </div>
<?php endif; ?>

<?php if ($this->params->get('show_description') || $this->params->get('show_description_image')) : ?>
  <div class="well well-sm clearfix">
  <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
    <figure class="col-md-4">
      <img class="img-responsive" src="<?php echo $this->category->getParams()->get('image'); ?>"/>
    </figure>
  <?php endif; ?>
  <?php if ($this->params->get('show_description') && $this->category->description) : ?>
    <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
    <div class="col-md-8">
    <?php endif; ?>
    <?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
    <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
    </div>
    <?php endif; ?>
  <?php endif;?>
  </div>
<?php endif; ?>

<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) :
  $this->category->tagLayout = new JLayoutFile('joomla.content.tags');
  echo $this->category->tagLayout->render($this->category->tags->itemTags);
endif; ?>

<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
  <?php if ($this->params->get('show_no_articles', 1)) : ?>
  <div class="alert alert-info">
    <p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
  </div>
  <?php endif; ?>
<?php endif; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) :
  foreach ($this->lead_items as &$item) : ?>
  <div class="row" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
    <div class="col-md-12">
      <?php $this->item = &$item;
      echo $this->loadTemplate('item'); ?>
    </div>
  </div>
  <hr class="half-rule">
  <?php
    $leadingcount++;
  endforeach;
endif;

$introcount = (count($this->intro_items));
$counter    = 0;

if (!empty($this->intro_items)) :
  foreach ($this->intro_items as $key => &$item) :
    $rowcount = ((int) $key % (int) $this->columns) + 1;
    if ($rowcount == 1) :
      $row = $counter / $this->columns; ?>
    <div class="row">
    <?php endif; ?>
      <div class="col-md-<?php echo round(12/$this->columns); ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
      <?php
        $this->item = &$item;
        echo $this->loadTemplate('item');
      ?>
      </div>
      <?php $counter++; ?>

      <?php if (($rowcount == $this->columns) || ($counter == $introcount)) : ?>
    </div>
    <hr class="half-rule">
    <?php endif;
  endforeach;
endif; ?>
</section>

<?php if (!empty($this->link_items)) : ?>
<section class="items-more">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo JText::_('COM_CONTENT_MORE_ARTICLES'); ?></h3>
    </div>
    <?php echo $this->loadTemplate('links'); ?>
  </div>
</section>
<?php endif; ?>

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

<?php if ($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
  <?php echo $this->pagination->getPagesLinks(); ?>
  <?php if ($this->params->def('show_pagination_results', 1)) : ?>
  <p class="page-counter text-muted pull-left"><?php echo $this->pagination->getPagesCounter(); ?></p>
  <?php  endif; ?>
<?php endif; ?>