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
 * Turquoise template helper.
 *
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @since       2.5
 */
abstract class tplTurquoiseHelper
{
  /**
   * Initialize template configuration
   *
   * @param JDocument $document The html document
   *
   * @return void
   */
  public static function init(&$document)
  {
    $app = JFactory::getApplication();

    $document->params = !isset($document->params) ? $app->getTemplate(true)->params : $document->params;
    $document->path   = $document->baseurl . '/templates/' . $document->template;

    self::_setMetadata();
    self::_prepareHead($document);
    self::_clearDefaultScripts($document->params);
  }

  /**
   * Defines metadata params
   */
  private static function _setMetadata()
  {
    $doc = JFactory::getDocument();

    $doc->setGenerator(null);
    $doc->setMetaData('author','Rene Bentes Pinto');
    $doc->setMetaData('X-UA-Compatible','IE=edge,chrome=1', true);
    $doc->setMetaData('viewport','width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0');
  }

  /**
   * Attach elements to html head
   *
   * @param JDocument $document The html document
   *
   * @return void
   */
  private static function _prepareHead($document)
  {
    $doc = JFactory::getDocument();

    // JS
    JHtml::_('bootstrap.framework');
    $doc->addScript($document->path . '/js/application.js');
    $doc->addScript($document->path . '/js/holder.js');

    // CSS
    $doc->addStyleSheet($document->path . '/css/template.css.php?baseurl=' . $document->baseurl . '&template=' . $document->template);

    // Favicon & Icons
    $favicon  = $document->params->get('favicon') ? $document->baseurl . '/' . $document->params->get('favicon') : $document->path . '/images/ico/favicon.ico';
    $iconpath = substr($favicon, 0, strrpos($favicon, '/'));
    $doc->addFavicon($favicon);

    $icons = array(
      'icon-144' => array('sizes' => '144x144'),
      'icon-114' => array('sizes' => '114x114'),
      'icon-72' => array('sizes' => '72x72'),
      'icon-57' => array()
    );

    foreach ($icons as $key => $value)
      $doc->addHeadlink($iconpath . '/apple-touch-' . $key . '-precomposed.png', 'apple-touch-icon-precomposed', 'rel', $value);
  }

  /**
   * Disables loading of javascript files
   *
   * @param Array $params The template params
   *
   * @return void
   */
  private static function _clearDefaultScripts($params)
  {
    $doc     = JFactory::getDocument();
    $scripts = $doc->_scripts;
    $script  = $doc->_script;

    if($params['disablejs'])
    {
      $filejs = $params['filejs'];

      unset($scripts[JUri::base(true) . '/media/system/js/mootools-core.js']);
      unset($scripts[JUri::base(true) . '/media/system/js/mootools-more.js']);
      unset($scripts[JUri::base(true) . '/media/system/js/caption.js']);

      if (trim($filejs) !== '')
      {
        $filejs = explode(',', $filejs);

        foreach ($scripts as $key => $value)
        {
          foreach ($filejs as $file)
            if (strpos($key, trim($file)))
              unset($scripts[$key]);
        }
      }

      foreach ($script as $key => $value)
        if(strpos($value, "new JCaption('img.caption');") !== false)
        {
          unset($script[$key]);
          break;
        }
    }

    $doc->_scripts = $scripts;
    $doc->_script  = $script;
  }

  /**
   * Get classes css for pages
   *
   * @return  strinf  CSS classes
   */
  public static function getPageClass()
  {
    $app       = JFactory::getApplication();
    $menu      = $app->getMenu();
    $active    = $menu->getActive();
    $alias     = isset($active->alias) ? ' ' . $active->alias : '';
    $pageClass = $app->getParams()->get('pageclass_sfx', '') ? ' ' . $app->getParams()->get('pageclass_sfx', '') : '';
    return ' class="' . ($active == $menu->getDefault() ? 'front' : 'site' . $alias . $pageClass) . '"';
  }

  /**
   * Includes site logo
   *
   * @param JDocument $document The html document
   *
   * @return string The html output
   */
  public static function getLogo($document)
  {
    if ($document->params->get('logo')) :
      $logo = $document->baseurl . '/' . $document->params->get('logo');
    else :
      $logo = $document->path . '/images/logo.png';
    endif;

    $alternative = $document->params->get('alternative') ? $document->params->get('alternative') : JFactory::getApplication()->getCfg('sitename');

    return '<img src="' . $logo . '" alt="' . $alternative . '" />';
  }

  /**
   * Checks if the page is the front page display
   *
   * @return boolean True for the front page
   */
  public static function isFrontPage()
  {
    return JFactory::getApplication()->getMenu()->getActive() == JFactory::getApplication()->getMenu()->getDefault();
  }

  /**
   * Get and prepare system message data for output
   *
   * @return Array An array contains system message
   */
  private static function _getMessage()
  {
    $lists    = array();
    $messages = JFactory::getApplication()->getMessageQueue();

    if (is_array($messages) && !empty($messages))
    {
      foreach ($messages as $message)
      {
        if (isset($message['type']) && isset($message['message']))
        {
          $lists[$message['type']][] = $message['message'];
        }
      }
    }

    return $lists;
  }

  /**
   * Render the HTML output
   *
   * @return void
   */
  public static function renderMessages()
  {
    $messageList = self::_getMessage();

    $classes = array(
      'error'   => 'danger',
      'message' => 'success',
      'notice'  => 'info',
      'warning' => 'warning',
      ''        => 'success'
    );

    if (is_array($messageList) && !empty($messageList)) :
      foreach ($messageList as $type => $messages) : ?>
        <div class="alert alert-<?php echo strtolower($classes[$type]); ?> alert-dismissible fade in" role="alert">
          <button type="button" class="close hasTooltip" data-original-title="<?php echo JText::_('TPL_TURQUOISE_CLOSE'); ?>" data-placement="bottom" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
          </button>
        <?php if (!empty($messages)) : ?>
          <h4><?php echo JText::_('TPL_TURQUOISE_MESSAGE_' . strtoupper($type)); ?></h4>
          <?php foreach ($messages as $message) : ?>
            <p><?php echo $message; ?></p>
          <?php endforeach; ?>
        <?php endif; ?>
        </div>
      <?php endforeach;
    endif;
  }
}