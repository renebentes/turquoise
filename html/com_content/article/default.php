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
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $this->item->params->get('access-edit');
$user    = JFactory::getUser();

?>

<section class="article<?php echo $this->pageclass_sfx; ?>">
<?php if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative) :
  echo $this->item->pagination;
endif; ?>
<?php if ($this->params->get('show_page_heading')) : ?>
  <div class="page-header">
    <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
  </div>
<?php endif; ?>
  <article>
  <?php if ($params->get('show_title')) : ?>
    <header class="page-header">
      <h2>
      <?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
        <a href="<?php echo $this->item->readmore_link; ?>"><?php echo $this->escape($this->item->title); ?></a>
      <?php else : ?>
        <?php echo $this->escape($this->item->title); ?>
      <?php endif; ?>
      </h2>
    </header>
  <?php endif; ?>
  <?php if ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_create_date') || $params->get('show_parent_category') || $params->get('show_author') || $params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
    <aside class="clearfix">
    <?php if ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_create_date') || $params->get('show_parent_category') || $params->get('show_author')) : ?>
      <dl class="dl-inline pull-left">
      <?php if ($params->get('show_publish_date')) : ?>
        <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PUBLISH_DATE'); ?>">
          <time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'Y-m-d'); ?>"></time>
          <i class="fa fa-calendar"></i> <?php echo JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
      <?php endif; ?>
      <?php if ($params->get('show_create_date')) : ?>
        <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CREATE_DATE'); ?>">
          <time datetime="<?php echo JHtml::_('date', $this->item->created, 'Y-m-d'); ?>"></time>
          <i class="fa fa-calendar"></i> <?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')); ?>
        </dd>
      <?php endif; ?>
      <?php if ($params->get('show_modify_date')) : ?>
        <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_UPDATE_DATE'); ?>">
          <time datetime="<?php echo JHtml::_('date', $this->item->modified, 'Y-m-d'); ?>"></time>
          <i class="fa fa-calendar"></i> <?php echo JHtml::_('date', $this->item->modified, JText::sprintf('DATE_FORMAT_LC3')); ?>
        </dd>
      <?php endif; ?>
      <?php if ($params->get('show_hits')) : ?>
        <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_HITS'); ?>">
          <i class="fa fa-eye"></i> <?php echo $this->item->hits; ?>
        </dd>
      <?php endif; ?>
      <?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root' && $this->item->parent_slug) : ?>
        <?php $title = $this->escape($this->item->parent_title);
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>'; ?>
        <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PARENT_CATEGORY'); ?>">
          <i class="fa fa-tags"></i>
        <?php if ($params->get('link_parent_category') && $this->item->parent_slug) : ?>
          <?php echo $url; ?>
        <?php else : ?>
          <?php echo $title;?>
        <?php endif; ?>
        </dd>
      <?php endif; ?>
      <?php if ($params->get('show_category')) : ?>
        <?php $title = $this->escape($this->item->category_title);
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';?>
        <dd class=" hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CATEGORY'); ?>">
          <i class="fa fa-tag"></i>
        <?php if ($params->get('link_category') && $this->item->catslug) : ?>
          <?php echo $url; ?>
        <?php else : ?>
          <?php echo $title; ?>
        <?php endif; ?>
      <?php endif; ?>
      <?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
        <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_AUTHOR'); ?>">
          <i class="fa fa-user"></i>
          <?php $author =  $this->item->author; ?>
          <?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

        <?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
          <?php echo JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id=' . $this->item->contactid), $author); ?>
        <?php else :?>
          <?php echo $author; ?>
        <?php endif; ?>
        </dd>
      <?php endif; ?>
      </dl>
    <?php endif; ?>

    <?php if($this->print) : ?>
      <div class="btn-group pull-right hidden-print">
        <?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
      </div>
    <?php else : ?>
      <?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
      <div class="btn-group pull-right">
        <?php if ($params->get('show_print_icon')) :
          echo JHtml::_('icon.print_popup', $this->item, $params);
        endif;
        if ($params->get('show_email_icon')) :
          echo JHtml::_('icon.email', $this->item, $params);
        endif;
        if ($canEdit) :
          echo JHtml::_('icon.edit', $this->item, $params);
        endif; ?>
      </div>
      <?php endif; ?>
    <?php endif; ?>
    </aside>

    <?php if(!$this->print) :
      if ($params->get('show_print_icon') || $params->get('show_email_icon')) :
        if ($params->get('show_print_icon')) :
          echo JHtml::_('icon.addModal', 'modal-print', 'JGLOBAL_PRINT', 'PrintArticle');
        endif;
        if ($params->get('show_email_icon')) :
          JFactory::getLanguage()->load('com_mailto', JPATH_SITE);
          echo JHtml::_('icon.addModal', 'modal-email', 'COM_MAILTO_EMAIL_TO_A_FRIEND', 'SendMail', 'COM_MAILTO_CLOSE_WINDOW');
        endif;
      endif;
    endif;
  endif; ?>

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

    <section class="article-content clearfix">
      <?php echo $this->item->text; ?>
    </section>

    <?php if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative) :
      echo $this->item->pagination;
    endif; ?>

    <?php if (isset($urls) && ((!empty($urls->urls_position)  && $urls->urls_position == '1') || $params->get('urls_position') == '1')) : ?>
      <?php echo $this->loadTemplate('links'); ?>
    <?php endif; ?>
  <?php elseif ($params->get('show_noauth') == true &&  $user->get('guest')) :
    echo $this->item->introtext;
    if ($params->get('show_readmore') && $this->item->fulltext != null) :
      $link1 = JRoute::_('index.php?option=com_users&view=login');
      $link = new JURI($link1); ?>
    <div class="readmore">
      <a class="pull-left" href="<?php echo $link; ?>">
        <i class="fa fa-arrow-circle-right"></i>
      <?php $attribs = json_decode($this->item->attribs);
      if ($attribs->alternative_readmore == null) :
        echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
      elseif ($readmore = $this->item->alternative_readmore) :
        echo $readmore;
        if ($params->get('show_readmore_title', 0) != 0) :
          echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
        endif;
      elseif ($params->get('show_readmore_title', 0) == 0) :
        echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
      else :
        echo JText::_('COM_CONTENT_READ_MORE');
        echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
      endif; ?>
      </a>
    </div>
    <?php endif; ?>
  <?php endif; ?>
  </article>

  <?php if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
    echo $this->item->pagination;
  endif; ?>

  <?php echo $this->item->event->afterDisplayContent; ?>
</section>