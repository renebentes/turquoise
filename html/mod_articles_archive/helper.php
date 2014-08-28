<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_SITE . '/modules/mod_articles_archive/helper.php';

abstract class modTurquoiseArchiveHelper extends modArchiveHelper
{
  public static function getList(&$params)
  {
    //get database
    $db    = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select('COUNT(id) AS articles_count, MONTH(created) AS created_month, created, id, title, YEAR(created) AS created_year');
    $query->from('#__content');
    $query->where('state = 2 AND checked_out = 0');
    $query->group('created_year DESC, created_month DESC');

    // Filter by language
    if (JFactory::getApplication()->getLanguageFilter()) {
      $query->where('language IN (' . $db->quote(JFactory::getLanguage()->getTag()) . ', ' . $db->quote('*') . ')');
    }

    $db->setQuery($query, 0, intval($params->get('count')));
    $rows = (array) $db->loadObjectList();

    $app  = JFactory::getApplication();
    $menu = $app->getMenu();
    $item = $menu->getItems('link', 'index.php?option=com_content&view=archive', true);
    $itemid = (isset($item) && !empty($item->id) ) ? '&Itemid=' . $item->id : '';

    $i     = 0;
    $lists = array();
    foreach ($rows as $row) {
      $date = JFactory::getDate($row->created);

      $created_month = $date->format('n');
      $created_year  = $date->format('Y');

      $created_year_cal = JHTML::_('date', $row->created, 'Y');
      $month_name_cal   = JHTML::_('date', $row->created, 'F');

      $lists[$i]        = new stdClass;
      $lists[$i]->link  = JRoute::_('index.php?option=com_content&view=archive&year=' . $created_year . '&month=' . $created_month . $itemid);
      $lists[$i]->text  = JText::sprintf('MOD_ARTICLES_ARCHIVE_DATE', $month_name_cal, $created_year_cal);
      $lists[$i]->count = $row->articles_count;

      $i++;
    }
    return $lists;
  }
}