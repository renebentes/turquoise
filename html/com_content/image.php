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
 * Content Component Image Helper
 * @static
 * @package Turquoise
 * @subpackage com_content
 * @since 2.5
 */
abstract class TurquoiseImage
{
  /**
   * Gets the first occurrence of this images in articles
   *
   * @param  array $item Array with data item
   *
   * @return string       String with path to an image
   */
  public static function getImage($item)
  {
    $image  = null;
    $images = json_decode($item->images);
    if (isset($images->image_intro) && isset($images->image_fulltext))
    {
      if (!empty($images->image_fulltext))
      {
        $image = $images->image_fulltext;
      }
      elseif (!empty($images->image_intro))
      {
        $image = $images->image_intro;
      }
    }

    if (empty($image))
    {
      $regex = "/\<img.+src\s*=\s*\"([^\"]*)\"[^\>]*\>/";
      preg_match($regex, $item->introtext, $matches);
      if (count($matches))
      {
        $image = $matches[1];
      }
      elseif (isset($item->fulltext))
      {
        preg_match($regex, $item->fulltext, $matches);
        $image = count($matches) ? $matches[1] : '';
      }
      else
      {
        preg_match($regex, self::_getFullText($item->id), $matches);
        $image = count($matches) ? $matches[1] : '';
      }
    }

    return $image;
  }

  /**
   * Gets the alternative text for image in articles
   *
   * @param  array $item Array with data item
   *
   * @return string       String with an alternative text
   */
  public static function getAltText($item)
  {
    $alt_text = null;
    $registry = json_decode($item->images);
    if (isset($registry->image_intro_caption) && isset($registry->image_fulltext_caption))
    {
      if (!empty($registry->image_fulltext_caption))
      {
        $alt_text = $registry->image_fulltext_caption;
      }
      elseif (!empty($registry->image_intro_caption))
      {
        $alt_text = $registry->image_intro_caption;
      }
    }
    elseif (isset($registry->image_intro_alt) && isset($registry->image_fulltext_alt))
    {
      if (!empty($registry->image_fulltext_alt))
      {
        $alt_text = $registry->image_fulltext_alt;
      }
      elseif (!empty($registry->image_intro_alt))
      {
        $alt_text = $registry->image_intro_alt;
      }
    }

    if (empty($alt_text))
    {
      $regex = "/\<img.+alt=\"([^\"]*)\"/";
      preg_match($regex, $item->introtext, $matches);
      if (count($matches))
      {
        $alt_text = $matches[1];
      }
      elseif (isset($item->fulltext))
      {
        preg_match($regex, $item->fulltext, $matches);
        $alt_text = count($matches) ? $matches[1] : $item->title;
      }
      else
      {
        preg_match($regex, self::_getFullText($item->id), $matches);
        $alt_text = count($matches) ? $matches[1] : '';
      }
    }

    return $alt_text;
  }

  /**
   * Gets fulltext from the article.
   *
   * @param  int    $pk The identifier of the article
   *
   * @return string     An string contains fulltext from the article
   */
  private static function _getFullText($pk)
  {
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $query->select($db->quoteName('a.fulltext'));
    $query->from($db->quoteName('#__content') . ' AS a');
    $query->where($db->quoteName('a.id') . ' = ' . (int) $pk);
    $db->setQuery($query);

    return $db->loadResult();
  }
}