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
$params = &$this->params;
?>

<ul class="media-list">
<?php foreach ($this->items as $i => $item) : ?>
  <li class="media">
    <div class="media-body">
      <article>
        <h2 class="media-heading text-justify">
        <?php if ($params->get('link_titles')): ?>
          <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug, $item->language)); ?>">
            <?php echo $this->escape($item->title); ?>
          </a>
        <?php else: ?>
          <?php echo $this->escape($item->title); ?>
        <?php endif; ?>
        </h2>
      <?php if (($params->get('show_author')) || ($params->get('show_parent_category')) || ($params->get('show_category')) || ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date'))  or ($params->get('show_hits'))) : ?>
        <aside class="clearfix">
          <dl class="dl-inline">
          <?php if ($params->get('show_parent_category') && $item->parent_slug != '1:root' && $item->parent_slug) :
            $title = $this->escape($item->parent_title);
            $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_slug)) . '">' . $title . '</a>'; ?>
            <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PARENT_CATEGORY'); ?>">
              <i class="fa fa-tags"></i>
            <?php if ($params->get('link_parent_category') && $item->parent_slug) : ?>
              <?php echo $url; ?>
            <?php else : ?>
              <?php echo $title;?>
            <?php endif; ?>
            </dd>
          <?php endif; ?>
          <?php if ($params->get('show_category')) :
            $title = $this->escape($item->category_title);
            $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)) . '">' . $title . '</a>';?>
            <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CATEGORY'); ?>">
              <i class="fa fa-tag"></i>
            <?php if ($params->get('link_category') && $item->catslug) : ?>
              <?php echo $url; ?>
            <?php else : ?>
              <?php echo $title; ?>
            <?php endif; ?>
            </dd>
          <?php endif; ?>
          <?php if ($params->get('show_create_date')) : ?>
            <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CREATE_DATE'); ?>">
              <time datetime="<?php echo JHtml::_('date', $item->created, 'Y-m-d'); ?>"></time>
              <i class="fa fa-calendar"></i> <?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC3')); ?>
            </dd>
          <?php endif; ?>
          <?php if ($params->get('show_modify_date')) : ?>
            <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_UPDATE_DATE'); ?>">
              <time datetime="<?php echo JHtml::_('date', $item->modified, 'Y-m-d'); ?>"></time>
              <i class="fa fa-calendar"></i> <?php echo JHtml::_('date', $item->modified, JText::sprintf('DATE_FORMAT_LC3')); ?>
            </dd>
          <?php endif; ?>
          <?php if ($params->get('show_publish_date')) : ?>
            <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PUBLISH_DATE'); ?>">
              <time datetime="<?php echo JHtml::_('date', $item->publish_up, 'Y-m-d'); ?>"></time>
              <i class="fa fa-calendar"></i>
              <?php echo JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
            </dd>
          <?php endif; ?>
          <?php if ($params->get('show_author') && !empty($item->author )) : ?>
            <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_AUTHOR'); ?>">
              <i class="fa fa-user"></i>
              <?php $author = $item->author; ?>
              <?php $author = ($item->created_by_alias ? $item->created_by_alias : $author); ?>

            <?php if (!empty($item->contactid ) &&  $params->get('link_author') == true):?>
              <?php echo JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id=' . $item->contactid), $author); ?>
            <?php else :?>
              <?php echo $author; ?>
            <?php endif; ?>
            </dd>
          <?php endif; ?>
          <?php if ($params->get('show_hits')) : ?>
            <dd class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_HITS'); ?>">
              <i class="fa fa-eye"></i><?php echo $item->hits; ?>
            </dd>
          <?php endif; ?>
          </dl>
        </aside>
      <?php endif; ?>
      <?php if ($params->get('show_intro')) :?>
        <?php echo JHtml::_('string.truncate', $item->introtext, $params->get('introtext_limit')); ?>
      <?php endif; ?>
      </article>
    </div>
  </li>
<?php endforeach; ?>
</ul>