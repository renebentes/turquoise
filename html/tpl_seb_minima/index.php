<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

// No direct access.
defined('_JEXEC') or die('Restricted access!');

// -- Initialize
require_once JPATH_THEMES . '/seb_minima/config.php';

$cck = CCK_Rendering::getInstance($this->template);
if ($cck->initialize() === false)
  return;

$doc = JFactory::getDocument();
echo '<pre>';
print_r($doc);
echo '</pre>';

// Fix path to overrides
$cck->path = JPATH_THEMES . '/seb_minima';

// -- Render
if ($cck->id_class != '')
  echo '<div class="' . trim($cck->id_class) . '">' . $cck->renderPosition('mainbody', '', $cck->h('mainbody')) . '</div>';
else
  echo $cck->renderPosition('mainbody', '', $cck->h('mainbody'));

if ($cck->countFields('modal') && JCck::on()) : ?>
  <div class="modal-open modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
            <span class="fa fa-times" aria-hidden="true"></span>
            <span class="sr-only">Close</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo $cck->renderPosition('modal'); ?>
        </div>
      </div>
    </div>
  </div>
<?php endif;

if ($cck->countFields('hidden')) : ?>
  <div class="hidden">
    <?php echo $cck->renderPosition('hidden'); ?>
  </div>
<?php endif;

// -- Finalize
$cck->finalize();
?>