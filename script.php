<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

// Include dependencies
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.installer.installer');

/**
 * Script file of Turquoise template
 */
class Tpl_TurquoiseInstallerScript
{
  /**
   * Extension name
   *
   * @var string
   */
  private $_extension = 'tpl_turquoise';

  /**
   * Array of sub extensions package
   *
   * @var array
   */
  private $_subextensions = array(
    'modules' => array(
    ),
    'plugins' => array(
    )
  );

  /**
   * Array of obsoletes files and folders
   *
   * @var array
   */
  private $_obsoletes = array(
    'files' => array(
      'templates/turquoise/js/bootstrap.css',
      'templates/turquoise/js/bootstrap.css.map',
      'templates/turquoise/js/font-awesome.css',
      'templates/turquoise/js/bootstrap.js',
      'templates/turquoise/js/jquery.min.js',
      'templates/turquoise/js/jquery-1.10.min.js'
    ),
    'folders' => array(
    )
  );

  /**
   * Method to install the template
   *
   * @param JInstaller $parent
   */
  function install($parent)
  {
    echo JText::_('TPL_TURQUOISE_INSTALL_TEXT');
  }

  /**
   * Method to uninstall the template
   *
   * @param JInstaller $parent
   */
  function uninstall($parent)
  {
    echo JText::_('TPL_TURQUOISE_UNINSTALL_TEXT');
  }

  /**
   * Method to update the template
   *
   * @param JInstaller $parent
   */
  function update($parent)
  {
    echo JText::sprintf('TPL_TURQUOISE_UPDATE_TEXT', '1.0.0');
  }

  /**
   * Method to run before an install/update/uninstall method
   *
   * @param string     $type Installation type (install, update, discover_install)
   * @param JInstaller $parent Parent object
   */
  function preflight($type, $parent)
  {
    $this->_checkCompatible($type, $parent);
  }

  /**
   * Method to run after an install/update/uninstall method
   *
   * @param string     $type install, update or discover_update
   * @param JInstaller $parent
   */
  function postflight($type, $parent)
  {
    $this->_removeObsoletes($this->_obsoletes);
  }

  /**
   * Method for checking compatibility installation environment
   *
   * @param  JInstaller   $parent Parent object
   *
   * @return bool         True if the installation environment is compatible
   */
  private function _checkCompatible($type, $parent)
  {
    // Get the application.
    $app         = JFactory::getApplication();
    $min_version = (string) $parent->get('manifest')->attributes()->version;
    $jversion    = new JVersion;

    if (!$jversion->isCompatible($min_version))
    {
      $app->enqueueMessage(JText::sprintf('TPL_TURQUOISE_VERSION_UNSUPPORTED', $min_version), 'error');
      return false;
    }

    // Storing old release number for process in postflight.
    if ($type == 'update')
    {
      $this->oldRelease = $this->getParam('version');

      // Check if update is allowed (only update from 1.0.0 and higher).
      if (version_compare($this->oldRelease, '1.0.0', '<'))
      {
        $app->enqueueMessage(JText::sprintf('TPL_TURQUOISE_UPDATE_UNSUPPORTED', $this->oldRelease), 'error');
        return false;
      }
    }
  }

  /**
   * Removes obsolete files and folders
   *
   * @param array $obsoletes
   */
  private function _removeObsoletes($obsoletes = array())
  {
    // Remove files
    if(!empty($obsoletes['files']))
    {
      foreach($obsoletes['files'] as $file)
      {
        $f = JPATH_ROOT . '/' . $file;
        if(!JFile::exists($f))
        {
          continue;
        }
        JFile::delete($f);
      }
    }

    // Remove folders
    if(!empty($obsoletes['folders']))
    {
      foreach($obsoletes['folders'] as $folder)
      {
        $f = JPATH_ROOT . '/' . $folder;
        if(!JFolder::exists($f))
        {
          continue;
        }
        JFolder::delete($f);
      }
    }
  }
}