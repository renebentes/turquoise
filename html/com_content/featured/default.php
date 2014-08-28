<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::addIncludePath(dirname(dirname(__FILE__)));

?>

<section class="blog-featured<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Blog">
<?php if ($this->params->get('show_page_heading') != 0) : ?>
  <div class="page-header">
    <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
  </div>
<?php endif; ?>

<?php $leadingcount = 0; ?>
<?php if (!empty($this->lead_items)) : ?>
  <?php foreach ($this->lead_items as &$item) : ?>
  <div class="row<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
    <div class="col-md-12">
    <?php $this->item = &$item;
      echo $this->loadTemplate('item'); ?>
    </div>
  </div>
  <hr class="half-rule">
    <?php $leadingcount++;
  endforeach;
endif;

$introcount = (count($this->intro_items));
$counter = 0;

if (!empty($this->intro_items)) :
  foreach ($this->intro_items as $key => &$item) :
    $key = ($key - $leadingcount) + 1;
    $rowcount = (((int) $key - 1) % (int) $this->columns) + 1;
    $row = $counter / $this->columns;

    if ($rowcount == 1) : ?>
    <div class="row">
    <?php endif; ?>
      <div class="col-md-<?php echo round(12/$this->columns); ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
      <?php $this->item = &$item;
        echo $this->loadTemplate('item');
      ?>
      </div>

    <?php $counter++;

    if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>
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
<?php endif;

if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) :
  echo $this->pagination->getPagesLinks();
  if ($this->params->def('show_pagination_results', 1)) : ?>
  <p class="page-counter text-muted pull-right"><?php echo $this->pagination->getPagesCounter(); ?></p>
  <?php  endif;
endif; ?>