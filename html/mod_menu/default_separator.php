<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

if ($item->menu_image)
{
  $item->params->get('menu_text', 1 ) ? $linktype = '<img src="'. $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' : $linktype = '<img src="'. $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
  $linktype = $item->title;
}

echo $linktype;