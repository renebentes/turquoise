<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::addIncludePath(dirname(dirname(__FILE__)));
require_once(dirname(dirname(__FILE__)) . '/pagination.php');

$limit = (int) $this->state->get('list.limit') - (int) $this->state->get('list.links');
$this->pagination = new TurquoisePagination($this->pagination->get('total'), $this->state->get('list.start'), $limit);

// Create some shortcuts.
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

// check for at least one editable article
$isEditable = false;
if (!empty($this->items)) :
  foreach ($this->items as $article) :
    if ($article->params->get('access-edit')) :
      $isEditable = true;
      break;
    endif;
  endforeach;
endif;

if (empty($this->items)) :
  if ($this->params->get('show_no_articles', 1)) : ?>
  <div class="alert alert-info">
    <p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
  </div>
  <?php endif;
else : ?>
  <form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" class="form-inline" role="form">
  <?php if ($this->params->get('show_headings') || $this->params->get('filter_field') != 'hide' || $this->params->get('show_pagination_limit')) :?>
    <fieldset class="clearfix">
    <?php if ($this->params->get('filter_field') != 'hide') :?>
      <div class="form-group">
        <label for="filter-search" class="sr-only"><?php echo JText::_('COM_CONTENT_' . $this->params->get('filter_field') . '_FILTER_LABEL'); ?></label>
        <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="form-control hasTooltip" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>"  placeholder="<?php echo JText::_('COM_CONTENT_'.$this->params->get('filter_field').'_FILTER_LABEL'); ?>" />
      </div>
    <?php endif; ?>

    <?php if ($this->params->get('show_pagination_limit')) : ?>
      <div class="form-group pull-right">
        <label for="limit" class="sr-only"><?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?></label>
        <?php echo $this->pagination->getLimitBox(); ?>
      </div>
    <?php endif; ?>
      <input type="hidden" name="filter_order" value="" />
      <input type="hidden" name="filter_order_Dir" value="" />
      <input type="hidden" name="limitstart" value="" />
      <input type="hidden" name="task" value="" />
    </fieldset>
  <?php endif; ?>
  </form>
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-condensed table-hover">
    <?php if ($this->params->get('show_headings')) : ?>
      <thead>
        <tr>
          <th><?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?></th>
          <?php if ($date = $this->params->get('list_show_date')) : ?>
            <th class="text-center">
              <?php if ($date == "created") : ?>
                <?php echo JHtml::_('grid.sort', 'COM_CONTENT_' . $date . '_DATE', 'a.created', $listDirn, $listOrder); ?>
              <?php elseif ($date == "modified") : ?>
                <?php echo JHtml::_('grid.sort', 'COM_CONTENT_' . $date . '_DATE', 'a.modified', $listDirn, $listOrder); ?>
              <?php elseif ($date == "published") : ?>
                <?php echo JHtml::_('grid.sort', 'COM_CONTENT_' . $date . '_DATE', 'a.publish_up', $listDirn, $listOrder); ?>
              <?php endif; ?>
            </th>
          <?php endif; ?>
          <?php if ($this->params->get('list_show_author')) : ?>
            <th><?php echo JHtml::_('grid.sort', 'JAUTHOR', 'author', $listDirn, $listOrder); ?></th>
          <?php endif; ?>
          <?php if ($this->params->get('list_show_hits')) : ?>
            <th class="text-center"><?php echo JHtml::_('grid.sort', 'JGLOBAL_HITS', 'a.hits', $listDirn, $listOrder); ?></th>
          <?php endif; ?>
          <?php if ($isEditable) : ?>
            <th class="text-center"><?php echo JText::_('JOPTIONS'); ?></th>
          <?php endif; ?>
        </tr>
      </thead>
    <?php endif; ?>
      <tbody>
      <?php foreach ($this->items as $i => $article) : ?>
        <tr>
          <td>
          <?php if (in_array($article->access, $this->user->getAuthorisedViewLevels())) : ?>
            <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid)); ?>">
              <?php echo $this->escape($article->title); ?>
            </a>
          <?php else: ?>
          <?php
            echo $this->escape($article->title) . ' : ';
            $menu      = JFactory::getApplication()->getMenu();
            $active    = $menu->getActive();
            $itemId    = $active->id;
            $link      = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
            $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid));
            $fullURL   = new JUri($link);
            $fullURL->setVar('return', base64_encode($returnURL));
          ?>
            <a href="<?php echo $fullURL; ?>">
              <?php echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE'); ?>
            </a>
          <?php endif; ?>
          <?php if ($article->state == 0) : ?>
            <span class="label label-warning">
              <?php echo JText::_('JUNPUBLISHED'); ?>
            </span>
          <?php endif; ?>
          <?php if (strtotime($article->publish_up) > strtotime(JFactory::getDate())) : ?>
            <span class="label label-warning">
              <?php echo JText::_('JNOTPUBLISHEDYET'); ?>
            </span>
          <?php endif; ?>
          <?php if ((strtotime($article->publish_down) < strtotime(JFactory::getDate())) && $article->publish_down != '0000-00-00 00:00:00') : ?>
            <span class="label label-warning">
              <?php echo JText::_('JEXPIRED'); ?>
            </span>
          <?php endif; ?>
          </td>
        <?php if ($this->params->get('list_show_date')) : ?>
          <td class="text-center"><?php echo JHtml::_('date', $article->displayDate, $this->escape($this->params->get('date_format', JText::_('DATE_FORMAT_LC3')))); ?></td>
        <?php endif; ?>
        <?php if ($this->params->get('list_show_author', 1)) : ?>
          <td>
          <?php if (!empty($article->author) || !empty($article->created_by_alias)) : ?>
            <?php $author = $article->author ?>
            <?php $author = ($article->created_by_alias ? $article->created_by_alias : $author);?>
            <?php if (!empty($article->contact_link) && $this->params->get('link_author') == true) : ?>
              <?php echo JHtml::_('link', $article->contact_link, $author); ?>
            <?php else: ?>
              <?php echo $author; ?>
            <?php endif; ?>
          <?php endif; ?>
          </td>
        <?php endif; ?>
        <?php if ($this->params->get('list_show_hits', 1)) : ?>
          <td class="text-center"><?php echo $article->hits; ?></td>
        <?php endif; ?>
        <?php if ($isEditable) : ?>
          <td class="text-center">
          <?php if ($article->params->get('access-edit')) : ?>
            <div class="btn-group">
              <?php echo JHtml::_('icon.edit', $article, $article->params); ?>
            </div>
          <?php endif; ?>
          </td>
        <?php endif; ?>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<?php if ($this->category->getParams()->get('access-create')) : ?>
  <?php echo JHtml::_('icon.create', $this->category, $this->category->params); ?>
<?php  endif; ?>

<?php if (!empty($this->items)) :
  if (($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) :
    echo $this->pagination->getPagesLinks();
    if ($this->params->def('show_pagination_results', 1)) : ?>
      <p class="page-counter text-muted pull-left"><?php echo $this->pagination->getPagesCounter(); ?></p>
    <?php endif;
  endif; ?>
<?php endif; ?>