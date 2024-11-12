<?php
	/************************************************
	* Copyright (C) 2015-2022  Alexandre Spangaro   <alexandre@inovea-conseil.com>
	* Copyright (C) 2022       Sylvain Legrand      <contact@infras.fr>
	*
	* This program is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 3 of the License, or
	* (at your option) any later version.
	*
	* This program is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	*
	* You should have received a copy of the GNU General Public License
	* along with this program.  If not, see <http://www.gnu.org/licenses/>.
	************************************************/

	/************************************************
	* 	\file		../oblyon/admin/options.php
	* 	\ingroup	oblyon
	* 	\brief		Options Page < Oblyon Theme Configurator >
	************************************************/

	// Dolibarr environment *************************
	require '../config.php';

	// Libraries ************************************
	require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
	require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';
	require_once '../lib/oblyon.lib.php';

	// Translations *********************************
	$langs->loadLangs(array('admin', 'oblyon@oblyon', 'inovea@oblyon'));

	// Access control *******************************
	if (! $user->admin)				accessforbidden();

	// Actions **************************************
	$action							= GETPOST('action','alpha');
	$result							= '';
	// Sauvegarde / Restauration
	if ($action == 'bkupParams')	$result	= oblyon_bkup_module ('oblyon');
	if ($action == 'restoreParams')	$result	= oblyon_restore_module ('oblyon');
	// On / Off management
	if (preg_match('/set_(.*)/', $action, $reg)) {
		$confkey	= $reg[1];
		$result		= dolibarr_set_const($db, $confkey, GETPOST('value'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
	// Update buttons management
	if (preg_match('/update_(.*)/', $action, $reg)) {
		$list									= array ('Gen' => array('OBLYON_FONT_SIZE', 'OBLYON_IMAGE_HEIGHT_TABLE', 'OBLYON_FONT', 'OBLYON_FONT_FAMILY'));
		$confkey								= $reg[1];
		$error									= 0;
		foreach ($list[$confkey] as $constname)	$result	= dolibarr_set_const($db, $constname, GETPOST($constname, 'alpha'), 'chaine', 0, 'Oblyon module', $conf->entity);
	}
	// Retour => message Ok ou Ko
	if ($result == 1)			setEventMessages($langs->trans('SetupSaved'), null, 'mesgs');
	if ($result == -1)			setEventMessages($langs->trans('Error'), null, 'errors');
	$_SESSION['dol_resetcache']	= dol_print_date(dol_now(), 'dayhourlog');	// Reset cache

	// init variables *******************************
	// Liste des polices web standards
	$font_options				= array ('Arial' 				=> 'Arial',
										'Arial Black' 			=> 'Arial Black',
										'Arial Narrow' 			=> 'Arial Narrow',
										'Calibri' 				=> 'Calibri',
										'Cambria' 				=> 'Cambria',
										'Candara' 				=> 'Candara',
										'Century Gothic' 		=> 'Century Gothic',
										'Comic Sans MS' 		=> 'Comic Sans MS',
										'Consolas' 				=> 'Consolas',
										'Courier New' 			=> 'Courier New',
										'Copperplate Gothic'	=> 'Copperplate Gothic',
										'Franklin Gothic'		=> 'Franklin Gothic',
										'Georgia' 				=> 'Georgia',
										'Gill Sans'				=> 'Gill Sans',
			    						'Helvetica' 			=> 'Helvetica',
										'Impact' 				=> 'Impact',
										'Lucida Console'		=> 'Lucida Console',
										'Lucida Sans'			=> 'Lucida Sans',
										'Microsoft Sans Serif'	=> 'Microsoft Sans Serif',
										'Open Sans' 			=> 'Open Sans',
										'Palatino Linotype' 	=> 'Palatino Linotype',
										'Sans-serif' 			=> 'Sans-serif',
										'Segoe UI'				=> 'Segoe UI',
										'Tahoma' 				=> 'Tahoma',
										'Times New Roman' 		=> 'Times New Roman',
			    						'Trebuchet MS' 			=> 'Trebuchet MS',
			    						'Verdana' 				=> 'Verdana',
										);
	$currentFont				= getDolGlobalString('OBLYON_FONT_FAMILY', 'Arial');

	// View *****************************************
	$page_name					= $langs->trans('OblyonOptionsTitle');
	llxHeader('', $page_name);
	$linkback					= '<a href = "'.DOL_URL_ROOT.'/admin/modules.php?restore_lastsearch_values=1">'.$langs->trans('BackToModuleList').'</a>';
	print load_fiche_titre($page_name, $linkback);

	// Configuration header *************************
	$head						= oblyon_admin_prepare_head();
	print dol_get_fiche_head($head, 'options', $langs->trans('Module432573Name'), 0, 'inovea@oblyon');

	// setup page goes here *************************
	$easyaVersion = (float) !empty($conf->global->EASYA_VERSION) ? $conf->global->EASYA_VERSION : '';

	$labs_picto = ' '.img_picto($langs->trans('WIP'), 'fa-flask', '', false, 0, 0, '', 'error ');

	print '	<script type = "text/javascript">
				$(document).ready(function() {
					$(".action").keyup(function(event) {
						if (event.which === 13)	$("#action").click();
					});
				});
			</script>
			<form action = "'.$_SERVER['PHP_SELF'].'" method = "POST">
			<input type="hidden" name="token" value="'.newToken().'" />
			<input type="hidden" name="action" value="update">
			<input type="hidden" name="page_y" value="">
			<input type="hidden" name="dol_resetcache" value="1">';
	// Sauvegarde / Restauration
	oblyon_print_backup_restore();
	clearstatcache();
	print '		<div class = "div-table-responsive-no-min">
					<table summary = "edit" class = "noborder centpercent editmode tableforfield">';
	$metas						= array('*', '156px', '300px');
	oblyon_print_colgroup($metas);
	// General
	$metas						= array(array(3), 'General');
	oblyon_print_liste_titre($metas);
	$metas						= array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '10', 'max' => '16');
	oblyon_print_input('OBLYON_FONT_SIZE', 'input', $langs->trans('OblyonFontSize'), '', $metas, 2, 1);	// Font size

	// Définir les métadonnées pour le champ de sélection
	$metas			= $form->selectarray('OBLYON_FONT_FAMILY', $font_options, $currentFont, 0, 0, 0, 'class = "fontsizeinherit nopadding cursorpointer"', 0, 0, 0, '', 'maxwidth200');
	oblyon_print_input('OBLYON_FONT_FAMILY', 'select', $langs->trans('OblyonFontFamily'), '', $metas, 2, 1);
	$metas						= array('type' => 'number', 'class' => 'flat quatrevingtpercent right action', 'dir' => 'rtl', 'min' => '24', 'max' => '128');
	oblyon_print_input('OBLYON_IMAGE_HEIGHT_TABLE', 'input', $langs->trans('OblyonImageHeightTable'), '', $metas, 2, 1);	// Max height for Image on table list
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('OBLYON_DISABLE_VERSION', 'on_off', $langs->trans('OblyonDisableVersion'), '', $metas, 2, 1);	// Disable version of Dolibarr
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('MAIN_STATUS_USES_IMAGES', 'on_off', $langs->trans('MainStatusUseImages'), '', $metas, 2, 1);	// Status use images
	$metas						= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('MAIN_USE_TOP_MENU_QUICKADD_DROPDOWN', 'on_off', $langs->trans('OblyonMainUseQuickAddDropdown'), '', $metas, 2, 1);	// Quickadd dropdown menu
	if (!empty($conf->bookmark->enabled)) {
		$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
		oblyon_print_input('MAIN_USE_TOP_MENU_BOOKMARK_DROPDOWN', 'on_off', $langs->trans('OblyonMainUseBookmarkDropdown'), '', $metas, 2, 1);    // Bookmark dropdown menu
	}
	$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('OBLYON_PADDING_RIGHT_BOTTOM', 'on_off', $langs->trans('OblyonPaddingRightBottom'), '', $metas, 2, 1);	// Add padding on bottom
	// Login
	$metas	= array(array(3), 'OblyonLogin');
	oblyon_print_liste_titre($metas);
	$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('MAIN_LOGIN_RIGHT', 'on_off', $langs->trans('LoginRight'), '', $metas, 2, 1);	// Login box on the right
	// Card
	$metas	= array(array(3), 'Card');
	oblyon_print_liste_titre($metas);
	$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
	oblyon_print_input('FIX_AREAREF_TABACTION', 'on_off', $langs->trans('FixAreaRefAndTabAction'), '', $metas, 2, 1);	// Sticky area ref & tab action
	if ($easyaVersion >= "2022.5.2" || (float) DOL_VERSION >= 17.0) {
		$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
		oblyon_print_input('FIX_STICKY_TABS_CARD', 'on_off', $langs->trans('FixStickyTabsCard').$labs_picto, '', $metas, 2, 1);    // Sticky tabs card
	}
	// List
	$metas	= array(array(3), 'List');
	oblyon_print_liste_titre($metas);
	if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 18.0) {
		$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
		oblyon_print_input('MAIN_CHECKBOX_LEFT_COLUMN', 'on_off', $langs->trans('SwitchColunmOnLeft'), '', $metas, 2, 1);    // Sticky table headers columns
	}
	if ($easyaVersion >= "2024.0.0" || (float) DOL_VERSION >= 18.0) {
		$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
		oblyon_print_input('OBLYON_DISABLE_KANBAN_VIEW_IN_LIST', 'on_off', $langs->trans('RemoveKanbanViewInList').$labs_picto, '', $metas, 2, 1);    // Remove button kanban view in list
	}
	if ($easyaVersion >= "2022.5.2" || (float) DOL_VERSION >= 17.0) {
		$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
		oblyon_print_input('FIX_STICKY_HEADER_CARD', 'on_off', $langs->trans('FixStickyTableHeadersColumns'), '', $metas, 2, 1);    // Sticky table headers columns
	}
	if ($easyaVersion >= "2022.5.2" || (float) DOL_VERSION >= 14.0) {
		$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
		oblyon_print_input('OBLYON_STICKY_COLUMN_FIRST', 'on_off', $langs->trans('FixStickyFirstColumn').$labs_picto, '', $metas, 2, 1);    // Sticky table first column
	}
	if ($easyaVersion >= "2022.5.2" || (float) DOL_VERSION >= 14.0) {
		$metas	= array(array(), $conf->entity, 0, 0, 1, 0, 0, 0, '', 'options');
		oblyon_print_input('OBLYON_STICKY_COLUMN_LAST', 'on_off', $langs->trans('FixStickyLastColumn').$labs_picto, '', $metas, 2, 1);    // Sticky table last column
	}
	print '			</table>
				</div>';
	print dol_get_fiche_end();
	oblyon_print_btn_action('Gen');
	print '	</form>
			<br/>';
	// End of page
	llxFooter();
	$db->close();
?>
