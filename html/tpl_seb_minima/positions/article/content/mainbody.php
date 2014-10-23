<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

echo $cck->getValue('art_introtext');
echo $cck->getValue('art_fulltext');

if ($cck->getValue('art_image_gallery')) :
  for ($i = 0; $i <= count($cck->getValue('art_image_gallery')) - 1; $i++) :
    if ($i % 2 == 0) : ?>
    <div class="row">
    <?php endif; ?>
      <div class="col-md-4">
        <div class="thumbnail">
          <img class="img-responsive hasTooltip" src="<?php echo $cck->getValue('art_image_gallery')[$i]->thumb2; ?>" title="<?php echo $cck->getValue('art_image_gallery')[$i]->image_title; ?>" alt="<?php echo $cck->getValue('art_image_gallery')[$i]->image_alt; ?>" />
          <div class="caption">
            <p><?php echo $cck->getValue('art_image_gallery')[$i]->image_alt; ?></p>
          </div>
        </div>
      </div>
    <?php if ($i % 2 != 0 || $i == count($cck->getValue('art_image_gallery')) - 1) : ?>
    </div>
    <?php endif; ?>
  <?php endfor; ?>
<?php endif; ?>