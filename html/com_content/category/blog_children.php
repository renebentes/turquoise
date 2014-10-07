<?php
/**
 * @package     Tureuoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

if (count($this->children[$this->category->id]) > 0 && $this->maxLevel != 0) : ?>
  <ul class="nav nav-pills nav-stacked">
  <?php foreach($this->children[$this->category->id] as $id => $child) : ?>
    <?php if ($this->params->get('show_empty_categories') || $child->numitems || count($child->getChildren())) : ?>
    <li>
      <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>"<?php echo $this->params->get('show_subcat_desc') == 1 && $child->description ? ' class="hasPopover" data-content="' . JHtml::_('content.prepare', $child->description, '', 'com_content.category') . '" data-placement="top"' : null; ?>>
      <?php if ($this->params->get('show_cat_num_articles', 1)) : ?>
        <span class="badge hasTooltip pull-right" title="<?php echo JText::_('COM_CONTENT_NUM_ITEMS'); ?>">
          <?php echo $child->getNumItems(true); ?>
        </span>
      <?php endif ; ?>
        <?php echo $this->escape($child->title); ?>
      </a>
      <?php if (count($child->getChildren()) > 0) :
        $this->children[$child->id] = $child->getChildren();
        $this->category = $child;
        $this->maxLevel--;
        if ($this->maxLevel != 0) :
          echo $this->loadTemplate('children');
        endif;
        $this->category = $child->getParent();
        $this->maxLevel++; ?>
      <?php endif; ?>
    </li>
    <?php endif; ?>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>