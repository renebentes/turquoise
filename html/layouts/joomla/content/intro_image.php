<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

$params = $displayData->params;
$images = json_decode($displayData->images);
?>

<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
<?php $imgfloat = empty($images->float_intro) ? $params->get('float_intro') : $images->float_intro; ?>
  <figure class="thumbnail<?php echo $imgfloat != 'none' ? ' col-md-5 pull-' . htmlspecialchars($imgfloat) : ' col-md-6 col-md-offset-3'; ?>">
    <img class="img-responsive" src="<?php echo htmlspecialchars($images->image_intro); ?>"<?php echo $images->image_intro_caption ? ' title="' . htmlspecialchars($images->image_intro_caption) . '"' : null; ?> alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
  <?php if ($images->image_intro_caption) : ?>
    <figcaption class="caption"><?php echo htmlspecialchars($images->image_intro_caption); ?></ficaption>
  <?php endif; ?>
  </figure>
<?php endif; ?>