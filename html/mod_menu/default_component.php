<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

// Note. It is important to remove spaces between elements.
$class    = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
$title    = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';
$dropdown = null;
if ($item->menu_image)
{
  $item->params->get('menu_text', 1 ) ? $linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' : $linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
elseif ($item->deeper)
{
  if ($item->level == 1)
  {
    $dropdown    = ' class="dropdown-toggle" data-toggle="dropdown"';
    $item->flink = '#';
    $linktype    = $item->title . ' <span class="caret"></span>';
  }
  else
  {
    $linktype = $item->title;
  }
}
else
{
  $linktype = $item->title;
}

switch ($item->browserNav) :
  default:
  case 0: ?>
    <a href="<?php echo $item->flink; ?>"<?php echo $dropdown; ?> <?php echo $title; ?>><?php echo $class ? '<span ' . $class . '></span>' : ''; ?><?php echo $linktype; ?></a>
  <?php break;
  case 1:
    // _blank ?>
    <a href="<?php echo $item->flink; ?>" target="_blank"<?php echo $dropdown; ?> <?php echo $title; ?>><?php echo $class ? '<span ' . $class . '></span>' : ''; ?><?php echo $linktype; ?></a>
    <?php break;
  case 2:
  // window.open
  $options = 'this.href,\'targetWindow\',\'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes\''; ?>
  <a href="<?php echo $item->flink; ?>"<?php echo $dropdown; ?> onclick="window.open(<?php echo $onclick; ?>); return false;" <?php echo $title; ?>><?php echo $class ? '<span ' . $class . '></span>' : ''; ?><?php echo $linktype; ?></a>
  <?php break;
endswitch;