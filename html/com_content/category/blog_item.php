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
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$params     = &$this->item->params;
$images     = json_decode($this->item->images);
$canEdit    = $this->item->params->get('access-edit');
$info       = $this->item->params->get('info_block_position', 0);
$useDefList = $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author');
$showIcons  = $params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit;
?>

<article>
  <?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

<?php if (($useDefList && ($info == 0 || $info == 2)) || $showIcons) : ?>
  <aside class="clearfix">
  <?php if ($showIcons) :
    echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false));
  endif; ?>

  <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
    <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
  <?php endif; ?>
  </aside>
<?php endif; ?>

<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>

<?php if (!$params->get('show_intro')) : ?>
  <?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro) && $imgfloat != 'none') : ?>
  <div class="col-md-7">
<?php endif; ?>
    <?php echo $this->item->introtext; ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro) && $imgfloat != 'none') : ?>
  </div>
<?php endif; ?>

<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
  <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
<?php endif; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
  if ($params->get('access-view')) :
    $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
  else :
    $menu      = JFactory::getApplication()->getMenu();
    $active    = $menu->getActive();
    $itemId    = $active->id;
    $link1     = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
    $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
    $link      = new JUri($link1);
    $link->setVar('return', base64_encode($returnURL));
  endif; ?>

  <?php echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>

<?php endif; ?>
<?php if ($params->get('show_tags') && !empty($this->item->tags->itemTags)) : ?>
  <?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
<?php endif; ?>
</article>

<?php echo $this->item->event->afterDisplayContent; ?>