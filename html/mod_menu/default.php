<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$tag = $params->get('tag_id') != NULL ? ' id="' . $params->get('tag_id') . '"' : '';
?>

<ul class="nav<?php echo $class_sfx;?>"<?php echo $tag; ?>>
<?php
foreach ($list as $i => &$item) :
  $class = 'item-'.$item->id;
  if ($item->id == $active_id) :
    $class .= ' current';
  endif;

  if (in_array($item->id, $path)) :
    $class .= ' active';
  elseif ($item->type == 'alias') :
    $aliasToId = $item->params->get('aliasoptions');
    if (count($path) > 0 && $aliasToId == $path[count($path) - 1]) :
      $class .= ' active';
    elseif (in_array($aliasToId, $path)) :
      $class .= ' alias-parent-active';
    endif;
  endif;

  if ($item->type == 'separator') :
    if ($item->deeper && $item->parent) :
      $item->type = 'heading';
    else :
      $class       .= ' nav-divider';
      $item->title = '';
    endif;
  endif;

  if ($item->deeper) :
    if ($item->level == 1 && preg_match('/navbar-nav/', $class_sfx)) :
      $class .= ' dropdown';
    endif;
    $class .= ' deeper';
  endif;

  if ($item->parent) :
    $class .= ' parent';
  endif;

  if (!empty($class)) :
    $class = ' class="' . trim($class) . '"';
  endif;

  echo '<li' . $class . '>';

  // Render the menu item.
  switch ($item->type) :
    case 'separator':
    case 'url':
    case 'component':
    case 'heading':
      require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
      break;
    default:
      require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
      break;
  endswitch;

  // The next item is deeper.
  if ($item->deeper) :
    if ($item->level == 1 && preg_match('/navbar-nav/', $class_sfx)) :
      echo '<ul class="dropdown-menu">';
    else :
      echo '<ul class="nav">';
    endif;
  // The next item is shallower.
  elseif ($item->shallower) :
    echo '</li>';
    echo str_repeat('</ul></li>', $item->level_diff);
  // The next item is on the same level.
  else :
    echo '</li>';
  endif;
endforeach;
?></ul>