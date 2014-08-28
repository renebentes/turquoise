<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$class    = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
$title    = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';
$dropdown = null;
if ($item->menu_image)
{
  $item->params->get('menu_text', 1 ) ? $linktype = '<img src="'. $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' : $linktype = '<img src="'. $item->menu_image . '" alt="' . $item->title . '" />';
}
elseif ($item->deeper)
{
  if ($item->level == 1)
  {
    $dropdown = ' class="dropdown-toggle" data-toggle="dropdown" ';
    $item->flink = '#';
    $linktype = $item->title . ' <i class="caret"></i>';
  }
  else
  {
    $linktype = $item->title;
    $item->flink = '#';
  }
}
else
{
  $linktype = $item->title;
}

$flink = $item->flink;

if ($flink == '#')
{
  $class= $class ? '<i ' . $class . '></i>' : '';
  echo '<a href="' . $flink .'"' . $dropdown . $title .'>' . $linktype .'</a>';
}
else
{
  echo $title . $linktype;
}
?>