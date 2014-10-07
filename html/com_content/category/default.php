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
<?php
  $this->subtemplatename = 'articles';
  echo JLayoutHelper::render('joomla.content.category_default', $this);
?>
</section>

<?php if (!empty($this->children[$this->category->id]) && $this->maxLevel != 0) : ?>
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