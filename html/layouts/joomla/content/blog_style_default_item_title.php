<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$params = $displayData->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
?>

<?php if ($params->get('show_title') || $displayData->state == 0 || ($params->get('show_author') && !empty($displayData->author ))) : ?>
  <header class="page-header">
  <?php if ($params->get('show_title')) : ?>
    <h2 itemprop="name">
    <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
      <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid)); ?>" itemprop="url">
        <?php echo $this->escape($displayData->title); ?>
      </a>
    <?php else : ?>
      <?php echo $this->escape($displayData->title); ?>
    <?php endif; ?>
    </h2>
  <?php endif; ?>
  <?php if ($displayData->state == 0) : ?>
    <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
  <?php endif; ?>
  <?php if (strtotime($displayData->publish_up) > strtotime(JFactory::getDate())) : ?>
    <span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
  <?php endif; ?>
  <?php if ((strtotime($displayData->publish_down) < strtotime(JFactory::getDate())) && $displayData->publish_down != '0000-00-00 00:00:00') : ?>
    <span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
  <?php endif; ?>
  </header>
<?php endif; ?>