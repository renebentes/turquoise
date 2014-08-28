<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Content Component HTML Helper Icon
 *
 * @static
 * @package     Content
 * @subpackage  com_content
 * @since       2.5
 */
class JHtmlIcon
{
  /**
   * Display an create icon for the item.
   *
   * @param  object  $category  The category for insert item
   * @param  object  $params  The item parameters
   * @param  array  $attribs  The attributes for HTML tag <a>
   *
   * @return  string  The HTML for the item edit icon.
   * @since  2.5
   */
  public static function create($category, $params, $attribs = array())
  {
    $uri = JUri::getInstance();

    $url = 'index.php?option=com_content&task=article.add&return=' . base64_encode($uri) . '&c_id=0&catid=' . $category->id;

    if ($params->get('show_icons'))
    {
      $text                           = '<i class="glyphicon glyphicon-plus"></i>';
      $attribs['class']               = 'btn btn-default btn-xs extra-tooltip';
      $attribs['data-original-title'] = JText::_('JNEW');
    }
    else
    {
      $text = JText::_('JNEW');
    }

    $button = JHtml::_('link', JRoute::_($url), $text, $attribs);
    return '<span class="pull-right">' . $button . '</span>';
  }

  /**
   * Display a email icon for the send item
   *
   * @param  object  $item    The item in question.
   * @param  object  $params  The item parameters
   * @param  array  $attribs  The attributes for HTML tag <a>
   *
   * @return  string  The HTML for the item email icon.
   * @since  2.5
   */
  public static function email($item, $params, $attribs = array())
  {
    require_once JPATH_SITE . '/components/com_mailto/helpers/mailto.php';

    $uri      = JUri::getInstance();
    $base     = $uri->toString(array('scheme', 'host', 'port'));
    $template = JFactory::getApplication()->getTemplate();
    $link     = $base . JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid), false);
    $url      = 'index.php?option=com_mailto&tmpl=component&template=' . $template . '&link=' . MailToHelper::addLink($link);

    if ($params->get('show_icons'))
    {
      $text                           = '<i class="glyphicon glyphicon-envelope"></i>';
      $attribs['class']               = 'btn btn-default btn-xs extra-tooltip modal-remote';
      $attribs['data-original-title'] = JText::_('JGLOBAL_EMAIL');
    }
    else
    {
      $text             = JText::_('JGLOBAL_EMAIL');
      $attribs['class'] = 'modal-remote';
    }

    $attribs['data-target'] = '#modal-email';

    $output = JHtml::_('link', JRoute::_($url), $text, $attribs);
    return $output;
  }

  /**
   * Display an edit icon for the item.
   *
   * This icon will not display in a popup window, nor if the item is trashed.
   * Edit access checks must be performed in the calling code.
   *
   * @param  object  $item    The item in question.
   * @param  object  $params  The item parameters
   * @param  array  $attribs  The attributes for HTML tag <a>
   *
   * @return  string  The HTML for the item edit icon.
   * @since  2.5
   */
  public static function edit($item, $params, $attribs = array())
  {
    $user   = JFactory::getUser();
    $userId = $user->get('id');
    $uri    = JUri::getInstance();

    // Ignore if in a popup window.
    if ($params && $params->get('popup'))
    {
      return;
    }

    if ($params && !$params->get('show_icons')) {
      return;
    }

    // Ignore if the published is negative (trashed).
    if ($item->state < 0)
    {
      return;
    }

    // Show checked_out icon if the item is checked out by a different user
    if (property_exists($item, 'checked_out') && property_exists($item, 'checked_out_time') && $item->checked_out > 0 && $item->checked_out != $userId)
    {
      $checkoutUser                   = JFactory::getUser($item->checked_out);
      $date                           = JHtml::_('date', $item->checked_out_time);
      $url                            = "#";
      $text                           = '<i class="glyphicon glyphicon-lock"></i>';
      $attribs['class']               = 'btn btn-default btn-xs extra-tooltip';
      $attribs['data-original-title'] = htmlspecialchars(JText::_('JLIB_HTML_CHECKED_OUT') .' :: '. JText::sprintf('COM_CONTENT_CHECKED_OUT_BY', $checkoutUser->name) . ' - ' . $date);

      return JHtml::_('link', JRoute::_($url), $text, $attribs);
    }

    $url = 'index.php?option=com_content&task=article.edit&a_id=' . $item->id . '&return=' . base64_encode(urlencode($uri));

    $text                           = '<i class="glyphicon glyphicon-pencil"></i>';
    $attribs['class']               = 'btn btn-default btn-xs extra-tooltip';
    $attribs['data-original-title'] = JText::_('JGLOBAL_EDIT');

    return JHtml::_('link', JRoute::_($url), $text, $attribs);
  }

  /**
   * Display an icon print for the item.
   *
   * The icon call an popup window for the item print.
   *
   * @param  object  $item    The item in question.
   * @param  object  $params  The item parameters
   * @param  array  $attribs  The attributes for HTML tag <a>
   *
   * @return  string  The HTML for the item print icon.
   * @since  2.5
   */
  public static function print_popup($item, $params, $attribs = array())
  {
    $url = ContentHelperRoute::getArticleRoute($item->slug, $item->catid);
    $url .= '&tmpl=component&print=1&layout=default&page=' . @ $request->limitstart;

    // checks template image directory for image, if non found default are loaded
    if ($params->get('show_icons'))
    {
      $text                           = '<i class="glyphicon glyphicon-print"></i> ';
      $attribs['class']               = 'btn btn-default btn-xs extra-tooltip modal-remote';
      $attribs['data-original-title'] = JText::_('JGLOBAL_PRINT');
    }
    else
    {
      $text             = JText::_('JGLOBAL_PRINT');
      $attribs['class'] = 'modal-remote';
    }

    $attribs['data-target'] = "#modal-print";

    return JHtml::_('link', JRoute::_($url), $text, $attribs);
  }

  /**
   * Display an print icon for the item.
   *
   * The icon call direct the print function.
   *
   * @param  object  $item    The item in question.
   * @param  object  $params  The item parameters
   * @param  array  $attribs  The attributes for HTML tag <a>
   *
   * @return  string  The HTML for the item print icon.
   * @since  2.5
   */
  public static function print_screen($item, $params, $attribs = array())
  {
    // checks template image directory for image, if non found default are loaded
    if ($params->get('show_icons'))
    {
      $text = '<i class="glyphicon glyphicon-print"></i> ';
      $attribs['rel']                 = 'tooltip';
      $attribs['class']               = 'btn btn-default btn-xs extra-tooltip';
      $attribs['data-original-title'] = JText::_('JGLOBAL_PRINT');
      $attribs['data-placement']      = 'left';
    }
    else
    {
      $text = JText::_('JGLOBAL_PRINT');
    }
    $attribs['onclick'] = "window.print();return false;";

    return JHtml::_('link', '#', $text, $attribs);
  }

  /**
   * Add html structure for modal displays
   *
   * @param string $target  Target for insert content modal
   * @param string $title   Title for modal
   * @param string $label   Label for accessible modals
   * @param string $tooltip Tooltip hint for button close
   *
   * @return string The HTML for the modal structure
   * @since 2.5
   */
  public static function addModal($target = 'modal-remote', $title = '', $label = 'modalRemote', $tooltip = 'TPL_TURQUOISE_CLOSE')
  {
    $output   = array();
    $output[] = '<div class="modal fade" id="' . $target . '" tabindex="-1" role="dialog" aria-labelledby="' . $label . '" aria-hidden="true">';
    $output[] = '  <div class="modal-dialog">';
    $output[] = '    <div class="modal-content">';
    $output[] = '      <div class="modal-header">';
    $output[] = '        <button type="button" class="close hasTooltip" data-original-title="' . JText::_($tooltip) . '" data-dismiss="modal" aria-hidden="true" data-placement="left">&times;</button>';
    $output[] = '        <h4 class="modal-title" id="' . $label . '">' . JText::_($title) . '</h4>';
    $output[] = '      </div>';
    $output[] = '      <div class="modal-body"></div>';
    $output[] = '    </div>';
    $output[] = '  </div>';
    $output[] = '</div>';
    return implode("\n", $output);
  }

  /**
   * Display an publish icon for the item.
   *
   * This icon will not display in a popup window, nor if the item is trashed.
   * Edit access checks must be performed in the calling code.
   *
   * @param  object  $item    The item in question.
   * @param  object  $params  The item parameters
   * @param  array  $attribs  The attributes for HTML tag <a>
   *
   * @return  string  The HTML for the item publish icon.
   * @since  2.5
   */
  public static function publish($item, $params, $attribs = array())
  {
    $user   = JFactory::getUser();
    $userId = $user->get('id');
    $uri    = JUri::getInstance();

    // Ignore if in a popup window.
    if ($params && $params->get('popup'))
    {
      return;
    }

    if ($params && !$params->get('show_icons')) {
      return;
    }

    // Ignore if the published is negative (trashed).
    if ($item->state < 0)
    {
      return;
    }

    // Show checked_out icon if the item is checked out by a different user
    if (property_exists($item, 'checked_out') && property_exists($item, 'checked_out_time') && $item->checked_out > 0 && $item->checked_out != $userId)
    {
      $checkoutUser                   = JFactory::getUser($item->checked_out);
      $date                           = JHtml::_('date', $item->checked_out_time);
      $url                            = "#";
      $text                           = '<i class="glyphicon glyphicon-lock"></i>';
      $attribs['class']               = 'btn btn-default btn-xs extra-tooltip';
      $attribs['data-original-title'] = htmlspecialchars(JText::_('JLIB_HTML_CHECKED_OUT') .' :: '. JText::sprintf('COM_CONTENT_CHECKED_OUT_BY', $checkoutUser->name) . ' - ' . $date);

      return JHtml::_('link', JRoute::_($url), $text, $attribs);
    }

    $url = 'index.php?option=com_content&task=article.publish&a_id=' . $item->id . '&return=' . base64_encode(urlencode($uri));

    $text                           = '<i class="glyphicon glyphicon-ok-circle"></i>';
    $attribs['class']               = 'btn btn-default btn-xs extra-tooltip';
    $attribs['data-original-title'] = JText::_('JGLOBAL_EDIT');

    return JHtml::_('link', JRoute::_($url), $text, $attribs);
  }
}