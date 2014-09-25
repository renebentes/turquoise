<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$template = JFactory::getApplication()->getTemplate();
require_once JPATH_SITE . '/templates/' . $template . '/html/com_content/image.php';

?>

<ul class="latestnews media-list">
<?php foreach ($list as $item) : ?>
  <li class="media">
  <?php if (TurquoiseImage::getImage($item) != null) : ?>
    <a class="pull-left" href="<?php echo $item->link; ?>">
      <img class="media-object img-rounded" src="<?php echo TurquoiseImage::getImage($item); ?>" alt="<?php echo TurquoiseImage::getAltText($item); ?>" />
    </a>
  <?php else : ?>
    <i class="fa fa-picture-o fa-5x pull-left text-muted"></i>
  <?php endif; ?>
    <div class="media-body">
      <h5 class="media-heading text-justify">
        <a href="<?php echo $item->link; ?>">
          <?php echo $item->title; ?>
        </a>
      </h5>
      <p class="small pull-right">
        <i class="fa fa-calendar"></i>
        <time datetime="<?php echo JHtml::_('date', $item->publish_up, 'Y-m-d'); ?>">
          <?php echo JHtml::_('date.relative', $item->publish_up); ?>
        </time>
      </p>
    </div>
  </li>
<?php endforeach; ?>
</ul>