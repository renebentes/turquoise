<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 || later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') || die;

// Create a shortcut for params.
$params  = &$this->item->params;
$images  = json_decode($this->item->images);
$canEdit = $this->item->params->get('access-edit');
?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>
  <article>
  <?php if ($params->get('show_title')) : ?>
    <header class="page-header">
      <h2>
      <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
        <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
          <?php echo $this->escape($this->item->title); ?>
        </a>
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
      <?php if ($params->get('show_publish_date')) : ?>
        <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PUBLISH_DATE'); ?>">
          <time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'Y-m-d'); ?>"></time>
          <i class="fa fa-calendar"></i>
          <?php echo JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
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
        <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CATEGORY'); ?>">
          <i class="fa fa-tag"></i>
        <?php if ($params->get('link_category') && $this->item->catslug) : ?>
          <?php echo $url; ?>
        <?php else : ?>
          <?php echo $title; ?>
        <?php endif; ?>
        </dd>
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

    <?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) :
      echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false));
    endif; ?>
    </aside>
  <?php endif; ?>

  <?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
  <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
    <figure class="thumbnail article-image<?php echo $imgfloat != 'none' ? ' pull-' . htmlspecialchars($imgfloat) : null; ?>">
      <img class="img-responsive" src="<?php echo htmlspecialchars($images->image_intro); ?>"<?php echo $images->image_intro_caption ? ' title="' . htmlspecialchars($images->image_intro_caption) . '"' : null; ?> alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
    <?php if ($images->image_intro_caption) : ?>
      <figcaption class="caption"><?php echo htmlspecialchars($images->image_intro_caption); ?></ficaption>
    <?php endif; ?>
    </figure>
  <?php endif; ?>

  <?php if (!$params->get('show_intro')) : ?>
    <?php echo $this->item->event->afterDisplayTitle; ?>
  <?php endif; ?>

  <?php echo $this->item->event->beforeDisplayContent; ?>

  <section class="article-intro clearfix">
    <?php echo $this->item->introtext; ?>
  </section>

  <?php if ($params->get('show_readmore') && $this->item->readmore) :
    if ($params->get('access-view')) :
      $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
    else :
      $menu = JFactory::getApplication()->getMenu();
      $active = $menu->getActive();
      $itemId = $active->id;
      $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
      $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
      $link = new JURI($link1);
      $link->setVar('return', base64_encode($returnURL));
    endif; ?>

    <div class="readmore">
      <a class="pull-left" href="<?php echo $link; ?>">
        <i class="fa fa-arrow-circle-right"></i>
      <?php if (!$params->get('access-view')) :
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
  </article>
<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>