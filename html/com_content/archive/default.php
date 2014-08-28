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
?>
<section class="archive<?php echo $this->pageclass_sfx; ?>">
<?php if ($this->params->get('show_page_heading')) : ?>
  <div class="page-header">
    <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
  </div>
<?php endif; ?>
  <form id="adminForm" action="<?php echo JRoute::_('index.php')?>" class="form-inline" method="post" role="form">
    <fieldset class="clearfix">
    <?php if ($this->params->get('filter_field') != 'hide') : ?>
      <div class="form-group">
        <label for="filter-search" class="sr-only"><?php echo JText::_('COM_CONTENT_' . $this->params->get('filter_field') . '_FILTER_LABEL'); ?></label>
        <input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="form-control hasTooltip" onchange="document.adminForm.submit();" data-original-title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />
      </div>
    <?php endif; ?>
      <div class="form-group">
        <?php echo str_replace('inputbox', 'form-control', $this->form->monthField); ?>
      </div>
      <div class="form-group">
        <?php echo str_replace('inputbox', 'form-control', $this->form->yearField); ?>
      </div>
      <div class="form-group">
        <?php echo str_replace('inputbox', 'form-control', $this->form->limitField); ?>
      </div>
      <button type="submit" class="btn btn-primary"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>

      <input type="hidden" name="view" value="archive" />
      <input type="hidden" name="option" value="com_content" />
      <input type="hidden" name="limitstart" value="0" />
    </fieldset>
  </form>
  <?php echo $this->loadTemplate('items'); ?>
</section>