<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$dropdown = null;

if ($item->deeper) :
  if ($item->level == 1 && preg_match('/navbar-nav/', $class_sfx)) :
    $dropdown    = ' class="dropdown-toggle" data-toggle="dropdown"';
    $item->title = $item->title . ' <span class="caret"></span>';
  endif;
endif;
?>
<a href="#"<?php echo $dropdown; ?>><?php echo $item->title; ?></a>
