<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

/**
 * Renders the pagination footer
 *
 * @param   array  $list  Array containing pagination footer
 *
 * @return  string  HTML markup for the full pagination footer
 *
 * @since   2.5
 */
function pagination_list_footer($list)
{
  $html = "<div class=\"wrap-pagination\">\n";
  $html .= $list['pageslinks'];
  $html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"" . $list['limitstart'] . "\" />";
  $html .= "\n</div>";

  return $html;
}

/**
 * Renders the pagination list
 *
 * @param   array  $list  Array containing pagination information
 *
 * @return  string  HTML markup for the full pagination object
 *
 * @since   3.0
 */
function pagination_list_render($list)
{
  // Calculate to display range of pages
  $currentPage = 1;
  $range = 1;
  $step = 5;
  foreach ($list['pages'] as $k => $page)
  {
    if (!$page['active'])
    {
      $currentPage = $k;
    }
  }
  if ($currentPage >= $step)
  {
    if ($currentPage % $step == 0)
    {
      $range = ceil($currentPage / $step) + 1;
    }
    else
    {
      $range = ceil($currentPage / $step);
    }
  }

  $html = '<ul class="pagination pull-right">';
  $html .= $list['start']['data'];
  $html .= $list['previous']['data'];

  foreach($list['pages'] as $k => $page)
  {
    if (in_array($k, range($range * $step - ($step + 1), $range * $step)))
    {
      if (($k % $step == 0 || $k == $range * $step - ($step + 1)) && $k != $currentPage && $k != $range * $step - $step)
      {
        $page['data'] = preg_replace('#(<a.*?>).*?(</a>)#', '$1...$2', $page['data']);
      }
    }

    $html .= $page['data'];
  }

  $html .= $list['next']['data'];
  $html .= $list['end']['data'];

  $html .= '</ul>';
  return $html;
}

/**
 * Renders an active item in the pagination block
 *
 * @param   JPaginationObject  $item  The current pagination object
 *
 * @return  string  HTML markup for active item
 *
 * @since   3.0
 */
function pagination_item_active(JPaginationObject &$item)
{
  // Check for "Start" item
  if ($item->text == JText::_('JLIB_HTML_START'))
  {
    $display = '<i class="fa fa-fast-backward"></i>';
  }

  // Check for "Prev" item
  if ($item->text == JText::_('JPREV'))
  {
    $item->text = JText::_('JPREVIOUS');
    $display = '<i class="fa fa-backward"></i>';
  }

  // Check for "Next" item
  if ($item->text == JText::_('JNEXT'))
  {
    $display = '<i class="fa fa-forward"></i>';
  }

  // Check for "End" item
  if ($item->text == JText::_('JLIB_HTML_END'))
  {
    $display = '<i class="fa fa-fast-forward"></i>';
  }

  // If the display object isn't set already, just render the item with its text
  if (!isset($display))
  {
    $display = $item->text;
  }

  return '<li><a class="hasTooltip" data-original-title="' . $item->text . '" href="' . $item->link . '">' . $display . '</a></li>';
}


/**
 * Renders an inactive item in the pagination block
 *
 * @param   JPaginationObject  $item  The current pagination object
 *
 * @return  string  HTML markup for inactive item
 *
 * @since   3.0
 */
function pagination_item_inactive(&$item)
{
  // Check for "Start" item
  if ($item->text == JText::_('JLIB_HTML_START'))
  {
    return '<li class="disabled"><a class="hasTooltip" data-original-title="' . $item->text . '" ><i class="fa fa-fast-backward"></i></a></li>';
  }

  // Check for "Prev" item
  if ($item->text == JText::_('JPREV'))
  {
    $item->text = JText::_('JPREVIOUS');
    return '<li class="disabled"><a class="hasTooltip" data-original-title="' . $item->text . '" ><i class="fa fa-backward"></i></a></li>';
  }

  // Check for "Next" item
  if ($item->text == JText::_('JNEXT'))
  {
    return '<li class="disabled"><a class="hasTooltip" data-original-title="' . $item->text . '" ><i class="fa fa-forward"></i></a></li>';
  }

  // Check for "End" item
  if ($item->text == JText::_('JLIB_HTML_END'))
  {
    return '<li class="disabled"><a class="hasTooltip" data-original-title="' . $item->text . '" ><i class="fa fa-fast-forward"></i></a></li>';
  }

  // Check if the item is the active page
  if ((isset($item->active) && $item->active) || (is_numeric($item->text) && is_null($item->link)))
  {
    return '<li class="active"><a class="hasTooltip" data-original-title="' . $item->text . '" >' . $item->text . '<span class="sr-only">(current)</span></a></li>';
  }

  // Doesn't match any other condition, render a normal item
  return '<li class="disabled"><a class="hasTooltip" data-original-title="' . $item->text . '" >' . $item->text . '</a></li>';
}