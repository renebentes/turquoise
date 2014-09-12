<?php
/**
 * @package     Turquoise
 * @subpackage  tpl_turquoise
 * @copyright   Copyright (C) 2014 Rene Bentes Pinto, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see http://www.gnu.org/licenses/gpl-2.0.html
 */

defined( '_JEXEC' ) or die;

$js = array();
if ((JCck::getConfig_Param('validation', 2) > 1) && $this->config['validation'] != '')
{
	Helper_Include::addValidation($this->config['validation'], $this->config['validation_options']);
	$js[]	=	'if (jQuery("#seblod_form").validationEngine("validate",task) === true) {';
	$js[] = '  Joomla.submitform((task == "save" ? "search" : task), document.getElementById("seblod_form"));';
	$js[] = '}';
}
else
{
	$js[]	=	'Joomla.submitform((task == "save" ? "search" : task), document.getElementById("seblod_form"));';
}
$app = JFactory::getApplication();
?>

<script type="text/javascript">
	<?php echo $this->config['submit']; ?> = function(task) {
		<?php echo implode("\n", $js); ?>
	};

	Joomla.submitbutton = function(task, cid) {
		if (task == "delete") {
			if (!confirm(Joomla.JText._('COM_CCK_CONFIRM_DELETE'))) {
				return false;
			}
		}
		jQuery("#seblod_form").append('<input type="hidden" id="return" name="return" value="<?php echo base64_encode( JFactory::getURI() ); ?>">');
		Joomla.submitform(task,document.getElementById('seblod_form'));
	}
</script>

<div class="list<?php echo $this->pageclass_sfx; ?>">
<?php if ($this->params->get('show_page_heading') || $this->show_list_title) : ?>
	<div class="page-header">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<h1><?php echo $this->escape($this->params->get('page_heading')) ? $this->escape($this->params->get('page_heading')) : $this->escape($this->params->get('page_title')); ?></h1>
	<?php endif;
	if ($this->show_list_title) :
		$class = trim($this->class_list_title) ? ' class="' . trim($this->class_list_title) . '"' : '';
		echo '<' . $this->tag_list_title . $class . '>' . @$this->search->title . '</' . $this->tag_list_title . '>';
	endif; ?>
	</div>
<?php endif;

if ($this->show_list_desc == 1 && $this->description != '') : ?>
	<div class="well well-sm">
		<?php echo JHtml::_( 'content.prepare', $this->description ); ?>
	</div>
<?php endif;

	echo $this->config['action'] ? $this->config['action'] : '<form action="' . ($this->home ? JUri::base(true) : JRoute::_('index.php?option=' . $this->option)). '" autocomplete="off" method="get" id="seblod_form" name="seblod_form" role="form">';

if ($this->show_form == 1)
{
	echo $this->form;
} ?>

		<input type="hidden" name="boxchecked" value="0" />
	<?php if (!JFactory::getApplication()->getCfg('sef') || !$this->config['Itemid']) : ?>
		<input type="hidden" name="option" value="com_cck" />
		<input type="hidden" name="view" value="list" />
		<?php if ( $this->home === false ) : ?>
		<input type="hidden" name="Itemid" value="<?php echo $app->input->getInt( 'Itemid', 0 ); ?>" />
		<?php endif;
	endif;

	$tmpl	=	$app->input->get('tmpl', '');
	if ($tmpl) : ?>
		<input type="hidden" name="tmpl" value="<?php echo $tmpl; ?>" />
	<?php endif; ?>
		<input type="hidden" name="search" value="<?php echo $this->search->name; ?>" />
		<input type="hidden" name="task" value="search" />
<?php /* ?>
<div class="cck_page_list<?php echo $this->pageclass_sfx; ?> cck-clrfix" id="system">
<?php } ?>
	<?php
	if ( isset( $this->pagination->pagesTotal ) ) {
		$pages_total	=	$this->pagination->pagesTotal;
	} elseif ( isset( $this->pagination->{'pages.total'} ) ) {
		$pages_total	=	$this->pagination->{'pages.total'};
	} else {
		$pages_total	=	0;
	}
	$pagination_replace	=	'';
	if ( $this->show_pagination > -2 && $pages_total > 1 ) {
		$url			=	JUri::getInstance()->toString().'&';
		if ( strpos( $url, '=&' ) !== false ) {
			$vars		=	JUri::getInstance()->getQuery( true );
			if ( count( $vars ) ) {
				foreach ( $vars as $k=>$v ) {
					if ( $v == '' ) {
						$pagination_replace	.=	$k.'=&';
					}
				}
			}
		}
	}*/
	if ($this->show_items_number)
	{
		$label = $this->label_items_number;
		if ($this->config['doTranslation'])
		{
			$label = JText::_( 'COM_CCK_' . str_replace(' ', '_', strtoupper(trim($label))));
		}
		echo '<div class="' . $this->class_items_number . '"><span>' . $this->total . '</span> ' . $label . '</div>';
	}/*
	if ( ( $this->show_pagination == -1 || $this->show_pagination == 1 ) && $pages_total > 1 ) {
		echo '<div class="'.$this->class_pagination.'">' . ( ( $pagination_replace != '' ) ? str_replace( '?', '?'.$pagination_replace, $this->pagination->getPagesLinks() ) : $this->pagination->getPagesLinks() ) . '</div>';
	}
	if ( @$this->search->content > 0 ) {
		echo ( $this->raw_rendering ) ? $this->data : '<div class="cck_page_items">'.$this->data.'</div>';
	} else {
		echo $this->loadTemplate( 'items' );
	}
	if ( ( $this->show_pages_number || $this->show_pagination > -1 ) && $pages_total > 1 ) {
	    echo '<div class="'.$this->class_pagination.'">';
		$pagesCounter	=	$this->pagination->getPagesCounter();
    	if ( $this->show_pages_number && $pagesCounter ) {
	        echo '<p class="counter">' . $pagesCounter . '</p>';
    	}
		if ( $this->show_pagination > -1 ) {
			echo ( $pagination_replace != '' ) ? str_replace( '?', '?'.$pagination_replace, $this->pagination->getPagesLinks() ) : $this->pagination->getPagesLinks();
		}
	    echo '</div>';
	}
    ?>
<?php if ( !$this->raw_rendering ) { ?>
</div>
<?php } ?>
<?php
if ( $this->show_form == 2 ) {
	echo ( $this->raw_rendering ) ? $this->form : '<div class="clr"></div><div class="cck_page_search'.$this->pageclass_sfx.'">' . $this->form . '</div>';
}
*/?>
</form>

<?php if ( $this->show_list_desc == 2 && $this->description != '' ) : ?>
	<div class="well well-sm">
		<?php echo JHtml::_( 'content.prepare', $this->description ); ?>
	</div>
<?php endif; ?>
</div>