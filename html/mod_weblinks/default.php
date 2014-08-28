<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

?>

<ul class="weblinks nav<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $item) :
?>
  <li>
  <?php
  $link = $item->link;
  $hits = $params->get('hits', 0) ?'<span class="badge badge-info hasTooltip pull-right" data-original-title="' . JText::_('MOD_WEBLINKS_HITS') . '">' . $item->hits . '</span>' : null ;
  $description = $params->get('description', 0) && $item->description ? ' class="hasPopover" data-content="' . htmlspecialchars($item->description, ENT_COMPAT, 'UTF-8') . '" data-placement="top"' : null;
  switch ($params->get('target', 3))
  {
    case 1:
      // open in a new window
      echo '<a href="'. $link .'" target="_blank" rel="'. $params->get('follow', 'no follow') . '"' . $description . '>';
      echo '<i class="glyphicon glyphicon-link"></i> ' . htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8');
      echo  $hits . '</a>';
      break;

    case 2:
      // open in a popup window
      echo '<a href="#" onclick="window.open("' . $link . '", "", "toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550"); return false"' . $description . '>';
      echo '<i class="glyphicon glyphicon-link"></i> ' . htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8');
      echo  $hits . '</a>';
      break;

    default:
      // open in parent window
      echo '<a href="'. $link . '" rel="' . $params->get('follow', 'no follow') . '"' . $description . '>';
      echo '<i class="glyphicon glyphicon-link"></i> ' . htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8');
      echo  $hits . '</a>';
      break;
  }
  ?>
  </li>
<?php endforeach; ?>
</ul>