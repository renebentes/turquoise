<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') || die;

// Create a shortcut for params.
$params     = &$this->item->params;
$images     = json_decode($this->item->images);
$canEdit    = $this->item->params->get('access-edit');
$info       = $this->item->params->get('info_block_position', 0);
$useDefList = $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $this->params->get('show_tags', 1);
$showIcons  = $params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit;
?>

<article>
<?php if ($params->get('show_title')) : ?>
  <header class="page-header">
    <h2 itemprop="name">
    <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
      <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>" itemprop="url">
        <?php echo $this->escape($this->item->title); ?>
      </a>
    <?php else : ?>
      <?php echo $this->escape($this->item->title); ?>
    <?php endif; ?>
    </h2>
    <?php if ($this->item->state == 0) : ?>
      <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
    <?php endif; ?>
    <?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
      <span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
    <?php endif; ?>
    <?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00') : ?>
      <span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
    <?php endif; ?>
  </header>
<?php endif; ?>

<?php if (($useDefList && ($info == 0 || $info == 2)) || $showIcons) : ?>
  <aside class="clearfix">
  <?php if ($showIcons) :
    echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false));
  endif; ?>

  <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
    <ul class="article-details pull-left">
    <?php if ($params->get('show_author') && !empty($this->item->author)) : ?>
      <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_AUTHOR'); ?>" itemprop="author" itemscope itemtype="http://schema.org/Person">
        <span class="fa fa-user"></span>
        <?php $author = '<span itempro="name">' . $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author . '</span>'; ?>

      <?php if (!empty($this->item->contact_link) &&  $params->get('link_author')) : ?>
        <?php echo JHtml::_('link', $this->item->contact_link, $author, array('itemprop' => 'url')); ?>
      <?php else : ?>
        <?php echo $author; ?>
      <?php endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
      <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PARENT_CATEGORY'); ?>">
        <span class="fa fa-tags"></span>
      <?php $title = $this->escape($this->item->parent_title);
      if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) :
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '" itemprop="genre">' . $title . '</a>';
        echo $url;
      else :
        echo '<span itemprop="genre">' . $title . '</span>';
      endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($params->get('show_category')) : ?>
      <li class=" hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CATEGORY'); ?>">
        <span class="fa fa-tag"></span>
        <?php $title = $this->escape($this->item->category_title);
      if ($params->get('link_category') && $this->item->catslug) :
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '" itemprop="genre">' . $title . '</a>';
        echo $url;
      else :
        echo '<span itemprop="genre">' . $title . '</span>';
      endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($params->get('show_publish_date')) : ?>
      <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PUBLISH_DATE'); ?>">
        <span class="fa fa-calendar"></span>
        <time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>" itemprop="datePublished">
          <?php echo JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
        </time>
    <?php endif; ?>
    <?php if($info == 0) : ?>
      <?php if ($params->get('show_modify_date')) : ?>
        <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_UPDATE_DATE'); ?>">
          <span class="fa fa-calendar"></span>
          <time datetime="<?php echo JHtml::_('date', $this->item->modified, 'c'); ?>" itemprop="dateModified">
            <?php echo JHtml::_('date', $this->item->modified, JText::sprintf('DATE_FORMAT_LC3')); ?>
          </time>
        </li>
      <?php endif; ?>
      <?php if ($params->get('show_create_date')) : ?>
        <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CREATE_DATE'); ?>">
          <span class="fa fa-calendar"></span>
          <time datetime="<?php echo JHtml::_('date', $this->item->created, 'c'); ?>" itemprop="dateCreated">
            <?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')); ?>
          </time>
        </li>
      <?php endif; ?>
      <?php if ($params->get('show_hits')) : ?>
        <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_HITS'); ?>">
          <meta itemprop="interactionCount" content="UserPageVisits:<?php echo $this->item->hits; ?>" />
          <span class="fa fa-eye"></span><?php echo $this->item->hits; ?>
        </li>
      <?php endif; ?>
    <?php endif; ?>
    <?php if ($this->params->get('show_tags', 1)) : ?>
      <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_TAGS'); ?>">
        <?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
        <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
      </li>
    <?php endif; ?>
    </ul>
  <?php endif; ?>

  </aside>
<?php endif; ?>

<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
<?php $imgfloat = empty($images->float_intro) ? $params->get('float_intro') : $images->float_intro; ?>
  <figure class="thumbnail<?php echo $imgfloat != 'none' ? ' col-md-5 pull-' . htmlspecialchars($imgfloat) : ' col-md-6 col-md-offset-3'; ?>">
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
<?php if (isset($images->image_intro) && !empty($images->image_intro) && $imgfloat != 'none') : ?>
  <div class="col-md-7">
<?php endif; ?>
    <?php echo $this->item->introtext; ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro) && $imgfloat != 'none') : ?>
  </div>
<?php endif; ?>

<?php if ($useDefList && ($info == 1 ||  $info == 2)) : ?>
  <ul class="article-details pull-left">
  <?php if ($info == 1) : ?>
    <?php if ($params->get('show_author') && !empty($this->item->author)) : ?>
      <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_AUTHOR'); ?>">
        <span class="fa fa-user"></span>
        <?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>

      <?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
        <?php echo JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id=' . $this->item->contactid), $author); ?>
      <?php else :?>
        <?php echo $author; ?>
      <?php endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
      <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PARENT_CATEGORY'); ?>">
        <span class="fa fa-tags"></span>
      <?php $title = $this->escape($this->item->parent_title);
      if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) :
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>';
        echo $url;
      else :
        echo $title;
      endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($params->get('show_category')) : ?>
      <li class=" hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CATEGORY'); ?>">
        <span class="fa fa-tag"></span>
        <?php $title = $this->escape($this->item->category_title);
      if ($params->get('link_category') && $this->item->catslug) :
        $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';
        echo $url;
      else :
        echo $title;
      endif; ?>
      </li>
    <?php endif; ?>
    <?php if ($params->get('show_publish_date')) : ?>
      <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_PUBLISH_DATE'); ?>">
        <span class="fa fa-calendar"></span>
        <time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>">
          <?php echo JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3')); ?>
        </time>
    <?php endif; ?>
  <?php endif; ?>

  <?php if ($params->get('show_modify_date')) : ?>
    <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_UPDATE_DATE'); ?>">
      <span class="fa fa-calendar"></span>
      <time datetime="<?php echo JHtml::_('date', $this->item->modified, 'c'); ?>">
        <?php echo JHtml::_('date', $this->item->modified, JText::sprintf('DATE_FORMAT_LC3')); ?>
      </time>
    </li>
  <?php endif; ?>
  <?php if ($params->get('show_create_date')) : ?>
    <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_CREATE_DATE'); ?>">
      <span class="fa fa-calendar"></span>
      <time datetime="<?php echo JHtml::_('date', $this->item->created, 'c'); ?>">
        <?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')); ?>
      </time>
    </li>
  <?php endif; ?>
  <?php if ($params->get('show_hits')) : ?>
    <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_HITS'); ?>">
      <span class="fa fa-eye"></span><?php echo $this->item->hits; ?>
    </li>
  <?php endif; ?>
  <?php if ($this->params->get('show_tags', 1)) : ?>
    <li class="hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_TOOLTIP_TAGS'); ?>">
      <?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
      <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
    </li>
  <?php endif; ?>
  </ul>
<?php endif;?>

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
</article>

<?php echo $this->item->event->afterDisplayContent; ?>