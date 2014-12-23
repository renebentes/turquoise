<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') || die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::addIncludePath(dirname(dirname(__FILE__)));

// Create shortcuts to some parameters.
$params     = $this->item->params;
$images     = json_decode($this->item->images);
$urls       = json_decode($this->item->urls);
$canEdit    = $params->get('access-edit');
$user       = JFactory::getUser();
$info       = $this->item->params->get('info_block_position', 0);
$useDefList = $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author');
$showIcons  = $params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit;
?>

<section class="article<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="http://schema.org/Article">
<meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
<?php if ($this->params->get('show_page_heading', 1)) : ?>
  <div class="page-header">
    <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
  </div>
<?php endif; ?>
<?php if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative) :
  echo $this->item->pagination;
endif; ?>
  <article>
  <?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

  <?php if (($useDefList && ($info == 0 || $info == 2)) && ($this->print || !$this->print)) : ?>
    <aside class="clearfix">
    <?php if (!$this->print) :
      if ($showIcons) :
        echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false));
      endif;
    else :
      echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => true));
    endif;
    if ($useDefList && ($info == 0 || $info == 2)) :
      echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above'));
    endif; ?>
    </aside>
  <?php endif; ?>

  <?php if (!$params->get('show_intro')) : ?>
    <?php echo $this->item->event->afterDisplayTitle; ?>
  <?php endif; ?>

  <?php if (!empty($this->item->event->beforeDisplayContent)) : ?>
    <div class="well well-sm clearfix">
      <?php echo $this->item->event->beforeDisplayContent; ?>
    </div>
  <?php endif; ?>

  <?php if (isset ($this->item->toc)) : ?>
    <?php echo $this->item->toc; ?>
  <?php endif; ?>

  <?php if (isset($urls) && ((!empty($urls->urls_position) && $urls->urls_position == '0') || ($params->get('urls_position') == '0' && empty($urls->urls_position))) || (empty($urls->urls_position) && !$params->get('urls_position'))) : ?>
    <?php echo $this->loadTemplate('links'); ?>
  <?php endif; ?>

  <?php if ($params->get('access-view')) :
    if (isset($images->image_fulltext) && !empty($images->image_fulltext)) :
      $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
      <figure class="thumbnail article-image<?php echo $imgfloat != 'none' ? ' pull-' . htmlspecialchars($imgfloat) : null; ?>">
        <img class="img-responsive" src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" />
      <?php if ($images->image_fulltext_caption): ?>
        <figcaption class="caption"><?php echo htmlspecialchars($images->image_fulltext_caption); ?></figcaption>
      <?php endif; ?>
      </figure>
    <?php endif; ?>

    <?php if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative) :
      echo $this->item->pagination;
    endif; ?>

    <div class="article-content clearfix" itemprop="articleBody">
      <?php echo $this->item->text; ?>
    </div>

    <?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
      <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
    <?php endif; ?>

    <?php if ($params->get('show_tags') && !empty($this->item->tags->itemTags)) : ?>
      <?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
    <?php endif; ?>

    <?php if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative) :
      echo $this->item->pagination;
    endif; ?>

    <?php if (isset($urls) && ((!empty($urls->urls_position)  && $urls->urls_position == '1') || $params->get('urls_position') == '1')) : ?>
      <?php echo $this->loadTemplate('links'); ?>
    <?php endif; ?>
  <?php elseif ($params->get('show_noauth') == true && $user->get('guest')) :
    echo $this->item->introtext;
    if ($params->get('show_readmore') && $this->item->fulltext != null) :
      $link = new JUri(JRoute::_('index.php?option=com_users&view=login'));
      echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link));
    endif;
  endif; ?>
  </article>

  <?php if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
    echo $this->item->pagination;
  endif; ?>

<?php if (!empty($this->item->event->afterDisplayContent)) : ?>
  <div class="well well-sm clearfix">
    <?php echo $this->item->event->beforeDisplayContent; ?>
  </div>
<?php endif; ?>
</section>