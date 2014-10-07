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
   * @param JDocument $template The html document
   *
   * @return void
   */
  static public function init(&$template)
  {
    $template->params    = !isset($template->params) ? JFactory::getApplication()->getTemplate(true)->params : $template->params;
    $template->language  = !isset($template->language) ? $template->language : $template->language;
    $template->direction = !isset($template->direction) ? $template->direction : $template->direction;
    $template->path      = $template->baseurl . '/templates/' . $template->template;

    self::_setMetadata();
    self::_prepareHead($template);
    self::_clearDefaultJavascript($template);
  }

  /**
   * Attach elements to html head
   *
   * @param JDocument $template The html document
   *
   * @return void
   */
  static private function _prepareHead($template)
  {
    $doc = JFactory::getDocument();
    $doc->addScript($template->path . '/js/application.js');

    if ($template->params->get('load') == 'remote') :
      $doc->addStylesheet('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
      $doc->addStylesheet('http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');

      $doc->addScript('http://code.jquery.com/jquery-1.11.1.min.js');
      $doc->addScript('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');
    else :
      $doc->addStylesheet($template->path . '/css/bootstrap.min.css');
      $doc->addStylesheet($template->path . '/css/font-awesome.min.css');

      $doc->addScript($template->path . '/js/bootstrap.min.js');
      $doc->addScript($template->path . '/js/jquery-1.11.1.min.js');
    endif;

    $doc->addStylesheet($template->path . '/css/template.css');

    $doc->addFavicon($template->params->get('favicon') ? $template->params->get('favicon') : $template->path . '/images/ico/favicon.ico');

    $doc->addHeadlink($template->path . '/images/ico/apple-touch-icon-144-precomposed.png', 'apple-touch-icon-precomposed', 'rel', array('sizes' => '144x144'));
    $doc->addHeadlink($template->path . '/images/ico/apple-touch-icon-114-precomposed.png', 'apple-touch-icon-precomposed', 'rel', array('sizes' => '114x114'));
    $doc->addHeadlink($template->path . '/images/ico/apple-touch-icon-72-precomposed.png', 'apple-touch-icon-precomposed', 'rel', array('sizes' => '72x72'));
    $doc->addHeadlink($template->path . '/images/ico/apple-touch-icon-57-precomposed.png', 'apple-touch-icon-precomposed', 'rel');
  }

  /**
   * Includes site logo
   *
   * @param JDocument $template The html document
   *
   * @return string The html output
   */
  static public function getLogo($template)
  {
    if ($template->params->get('logo')) :
      $logo = $template->baseurl . '/' . $template->params->get('logo');
    else :
      $logo = $template->path . '/images/logo.png';
    endif;

    $alternative = $template->params->get('alternative') ? $template->params->get('alternative') : JFactory::getApplication()->getCfg('sitename');

    return '<img src="' . $logo . '" alt="' . $alternative . '" />';
  }

  /**
   * Checks if the page is the front page display
   *
   * @return boolean True for the front page
   */
  static public function isFrontPage()
  {
    return JFactory::getApplication()->getMenu()->getActive() == JFactory::getApplication()->getMenu()->getDefault();
  }

  /**
   * Disables loading of javascript files
   *
   * @param JDocument $template The html document
   *
   * @return void
   */
  static private function _clearDefaultJavascript($template)
  {
    $doc     = JFactory::getDocument();
    $scripts = $doc->_scripts;
    $script  = $doc->_script;

    if($template->params->get('disablejs'))
    {
      unset($scripts[$template->baseurl . '/media/system/js/mootools-core.js']);
      unset($scripts[$template->baseurl . '/media/system/js/caption.js']);
      unset($scripts[$template->baseurl . '/media/jui/js/jquery.min.js']);
      unset($scripts[$template->baseurl . '/media/jui/js/jquery-noconflict.js']);
      unset($scripts[$template->baseurl . '/media/jui/js/jquery-migrate.min.js']);
      unset($scripts[$template->baseurl . '/media/jui/js/bootstrap.min.js']);

      $filejs = $template->params->get('filejs', '');
      if (trim($filejs) !== '')
      {
        $filejs = explode(',', $filejs);

        foreach ($scripts as $key => $value)
          foreach ($filejs as $file)
            if(strpos($key, trim($file)))
              unset($scripts[$key]);
      }

      foreach ($script as $key => $value)
        if(strpos($value, "new JCaption('img.caption');") !== false) {
          unset($script[$key]);
          break;
        }
    }

    $doc->_scripts = array_reverse($scripts);
    $doc->_script  = $script;
  }

  /**
   * Defines metadata params
   *
   * @param JDocument $template The html document
   */
  private static function _setMetadata()
  {
    $doc = JFactory::getDocument();
    $doc->setGenerator(null);
    $doc->setMetaData('author','Rene Bentes Pinto');
    $doc->setMetaData('X-UA-Compatible','IE=edge,chrome=1', true);
    $doc->setMetaData('viewport','width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0');
  }

  public static function isNewJoomla()
  {
    $jversion = new JVersion;

    return $jversion->isCompatible('3.0');
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

  public static function getPageClass()
  {
    $class = JFactory::getApplication()->getParams()->get('pageclass_sfx', '');
    return !empty($class) ? ' class="' . $class : null;
  }
}