<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

jimport('joomla.html.pagination');

/**
 * Turquoise Pagination Class.
 *
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @since       3.3
 */
class TurquoisePagination extends JPagination
{
  /**
   * Constructor.
   *
   * @param   integer  $total       The total number of items.
   * @param   integer  $limitstart  The offset of the item to start at.
   * @param   integer  $limit       The number of items to display per page.
   * @param   string   $prefix      The prefix used for request variables.
   *
   * @since   11.1
   */
  public function __construct($total, $limitstart, $limit, $prefix = '')
  {
    parent::__construct($total, $limitstart, $limit, $prefix);
  }
  /**
   * Creates a dropdown box for selecting how many records to show per page.
   *
   * @return  string  The HTML for the limit # input box.
   *
   * @since   3.0
   */
  public function getLimitBox()
  {
    $app = JFactory::getApplication();

    // Initialise variables.
    $limits = array();

    // Make the option list.
    for ($i = 5; $i <= 30; $i += 5)
    {
      $limits[] = JHtml::_('select.option', "$i");
    }
    $limits[] = JHtml::_('select.option', '50', JText::_('J50'));
    $limits[] = JHtml::_('select.option', '100', JText::_('J100'));
    $limits[] = JHtml::_('select.option', '0', JText::_('JALL'));

    $selected = $this->viewall ? 0 : $this->limit;

    // Build the select list.
    if ($app->isAdmin())
    {
      $html = JHtml::_(
        'select.genericlist',
        $limits,
        $this->prefix . 'limit',
        'class="inputbox input-mini" size="1" onchange="Joomla.submitform();"',
        'value',
        'text',
        $selected
      );
    }
    else
    {
      $html = JHtml::_(
        'select.genericlist',
        $limits,
        $this->prefix . 'limit',
        'class="form-control" size="1" onchange="this.form.submit()"',
        'value',
        'text',
        $selected
      );
    }
    return $html;
  }
}