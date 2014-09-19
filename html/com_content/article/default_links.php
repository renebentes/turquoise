<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

// Create shortcut
$urls = json_decode($this->item->urls);

// Create shortcuts to some parameters.
$params = $this->item->params;
if ($urls && (!empty($urls->urla) || !empty($urls->urlb) || !empty($urls->urlc))) :
?>
<ul class="nav nav-pills">
<?php
  $urlarray = array(
                array($urls->urla, $urls->urlatext, $urls->targeta, 'a'),
                array($urls->urlb, $urls->urlbtext, $urls->targetb, 'b'),
                array($urls->urlc, $urls->urlctext, $urls->targetc, 'c')
              );
  foreach ($urlarray as $url) :
    $link   = $url[0];
    $label  = $url[1];
    $target = $url[2];
    $id     = $url[3];

    if (!$link) :
      continue;
    endif;

    // If no label is present, take the link
    $label = ($label) ? $label : $link;

    // If no target is present, use the default
    $target = $target ? $target : $params->get('target' . $id); ?>
    <li>
    <?php
      // Compute the correct link
      switch ($target) :
        case 1 :
          // open in a new window
          echo '<a href="'. htmlspecialchars($link) . '" target="_blank"  rel="nofollow">' . htmlspecialchars($label) .'</a>';
          break;
        case 2 :
          // open in a popup window
          $attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600';
          echo '<a href="' . htmlspecialchars($link) . '" onclick="window.open(this.href, \'targetWindow\', \'' . $attribs . '\'); return false;">' . htmlspecialchars($label) . '</a>';
          break;
        case 3:
          // open in a modal window
          echo '<a class="modal-remote" href="' . htmlspecialchars($link) . '" data-target="#modal-remote-' . $id . '">' . htmlspecialchars($label) . '</a>';
          echo '<div class="modal fade" id="modal-remote-' . $id . '" tabindex="-1" role="dialog" aria-labelledby="' . htmlspecialchars($label) . '" aria-hidden="true">';
          echo '  <div class="modal-dialog modal-lg">';
          echo '    <div class="modal-content">';
          echo '      <div class="modal-header">';
          echo '        <button type="button" class="close hasTooltip" data-original-title="' . JText::_('TPL_TURQUOISE_CLOSE') . '" data-dismiss="modal" aria-hidden="true">×</button>';
          echo '        <h4>' . htmlspecialchars($label) . '</h4>';
          echo '      </div>';
          echo '      <div class="modal-body"></div>';
          echo '    </div>';
          echo '  </div>';
          echo '</div>';
          break;

        default:
          // open in parent window
          echo '<a href="' . htmlspecialchars($link) . '" rel="nofollow">' . htmlspecialchars($label) . '</a>';
          break;
      endswitch; ?>
      </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>