<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');
?>

<?php if (!empty($displayData)) : ?>
  <p class="tags">
    <span class="fa fa-tags hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_TAGS'); ?>"></span>
  <?php foreach ($displayData as $i => $tag) : ?>
    <?php if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))) : ?>
      <?php $tagParams = new JRegistry($tag->params); ?>
        <a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . '-' . $tag->alias)) ?>">
          <span class="<?php echo $tagParams->get('tag_link_class', 'label label-info');?>" itemprop="keywords">
            <?php echo $this->escape($tag->title); ?>
          </span>
        </a>
    <?php endif; ?>
  <?php endforeach; ?>
  </p>
<?php endif; ?>