<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

$regex = "/\<img.+src\s*=\s*\"([^\"]*)\"[^\>]*\>/";
if (preg_match($regex, $separator))
  $separator = null;

?>

<ul class="breadcrumb<?php echo !empty($separator) ? ' breadcrumb-overwrite' : null; ?><?php echo $moduleclass_sfx; ?>">
<?php if ($params->get('showHere', 1))
{
  echo '<li class="showhere"><span class="fa fa-map-marker hasTooltip" data-original-title="' . trim(str_replace(':', '', JText::_('MOD_BREADCRUMBS_HERE'))) . '"></span></li>';
}
for ($i = 0; $i < $count; $i ++) :
  if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link)
    unset($list[$i]);
endfor;

// Find last and penultimate items in breadcrumbs list
end($list);
$last_item_key   = key($list);
prev($list);
$penult_item_key = key($list);

// Make a link if not the last item in the breadcrumbs
$show_last = $params->get('showLast', 1);
foreach ($list as $key => $item) :
  if ($key != $last_item_key) :
    echo '<li>';
    echo !empty($item->link) ? '<a href="' . $item->link . '">' . $item->name . '</a>' : $item->name;
    if (($key != $penult_item_key || $show_last) && !empty($separator)) :
      echo '<span class="separator">' . $separator . '</span>';
    endif;
    echo '</li>';
  elseif ($show_last) :
    echo '<li class="active">' . $item->name . '</li>';
  endif;
endforeach;
?>
</ul>