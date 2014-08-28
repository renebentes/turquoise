<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

if($module->position == 'search') :
  $moduleclass_sfx = ' class="navbar-form' . $moduleclass_sfx . '"';
elseif ($moduleclass_sfx) :
  $moduleclass_sfx = ' class="' . $moduleclass_sfx;
endif;
?>

<form name="search" action="<?php echo JRoute::_('index.php');?>" method="post"<?php echo $moduleclass_sfx; ?> role="search">
<?php
  $output = '<div class="form-group">';

  if (!empty($label)) :
    $label = '<label for="mod-search-searchword" class="sr-only">' . $label . '</label>';
  endif;

  $input  = '<input name="searchword" id="mod-search-searchword" maxlength="' . $maxlength . '" class="form-control input-sm" type="search" size="' . $width . '" placeholder="' . $text . '" />';

  if (!empty($button)) :
    if ($imagebutton) :
      $button = '<a class="btn btn-primary btn-sm" href="#" onclick="javascript:document.search.submit();"><i class="glyphicon glyphicon-search"></i></a>';
    else :
      $button = '<a class="btn btn-primary btn-sm" href="#" onclick="javascript:document.search.submit();">' . $button_text . '</a>';
    endif;

    switch ($button_pos) :
      case 'top' :
        $output = $button . '<br>' . $output . $label . $input . '</div>';
        break;

      case 'bottom' :
        $output = $output . $label . $input . '</div>' . $button;
        break;

      case 'right' :
        $output = $output . $label . '<div class="input-group">' . $input . '<span class="input-group-btn extra-tooltip" data-original-title="' . JText::_('MOD_SEARCH') . '">' . $button . '</span></div></div>';
        break;

      case 'left' :
      default :
        $output = $output . $label . '<div class="input-group"><span class="input-group-btn extra-tooltip" data-original-title="' . JText::_('MOD_SEARCH') . '">' . $button . '</span>' . $input . '</div></div>';
        break;
    endswitch;
  else :
    $output = $output . $label . $input . '</div>';
  endif;

  echo $output;
  ?>

  <input type="hidden" name="task" value="search" />
  <input type="hidden" name="option" value="com_search" />
  <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
</form>