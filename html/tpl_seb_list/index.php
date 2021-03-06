<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

// -- Initialize
require_once JPATH_THEMES . '/seb_list/config.php';

$cck = CCK_Rendering::getInstance($this->template);
if ($cck->initialize() === false)
  return;

// Fix path to overrides
$cck->path = JPATH_THEMES . '/seb_list';

// -- Prepare
$class        = trim($cck->getStyleParam('class', '')) != '' ? ' class="' . trim($cck->getStyleParam('class', '')) . '"' : '';
$display_mode = (int)$cck->getStyleParam('list_display', '0');
$html         = '';
$items        = $cck->getItems();
$fieldnames   = $cck->getFields('element', '', false);
$multiple     = (count($fieldnames) > 1) ? true : false;
$count        = count($items);
$auto_clean   = ($count == 1) ? $cck->getStyleParam('auto_clean', 0) : 0;

// -- Render
if ($cck->id_class) : ?>
  <div class="<?php echo trim($cck->id_class); ?>">
<?php endif; ?>
<?php if (!$auto_clean) : ?>
  <ul<?php echo $class; ?>>
<?php endif; ?>
<?php if ($count) :
  if ($display_mode == 2) :
    foreach ($items as $item) :
      $row = $item->renderPosition('element');
      if ($row)
        $row = '<li>' . $row . '</li>';
      $html .= $row;
    endforeach;
  elseif ($display_mode == 1) :
    foreach ($items as $pk => $item) :
      $row = $cck->renderItem($pk);
      if ($row && !$auto_clean)
        $row = '<li>' . $row . '</li>';
      $html .= $row;
    endforeach;
  else :
    foreach ($items as $item) :
      $row = '';
      foreach ($fieldnames as $fieldname) :
        $content = $item->renderField($fieldname);
        if ($content != '') :
          if ($item->getMarkup($fieldname) != 'none' && ($multiple || $item->getMarkup_Class($fieldname)))
            $row .= '<div' . ($item->getMarkup_Class($fieldname) ? ' class="' . $item->getMarkup_Class($fieldname) . '"' : null) .'>' . $content . '</div>';
          else
            $row .= $content;
        endif;
      endforeach;
      if ($row && !$auto_clean)
        $row = '<li>' . $row . '</li>';
      $html .= $row;
    endforeach;
  endif;
  echo $html;
endif;
if (!$auto_clean) : ?>
  </ul>
<?php endif; ?>
<?php if ($cck->id_class) : ?>
  </div>
<?php endif;

// -- Finalize
$cck->finalize();
?>