<?php
/*
 * Name: modinfo.php
 * Description:
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package : XOOPS
 * @Module : Xoops FAQ
 * @subpackage : Menu Language
 * @since 2.5.7
 * @author John Neill
 * @version $Id: modinfo.php 0000 10/04/2009 09:08:46 John Neill $
 * Traduction: LionHell 
 * upgrade to xoops 2.5.7 by Jean-Jacques DELALANDRE
 */
 
defined( 'XOOPS_ROOT_PATH' ) or die( 'Accès restreint' );

define('_MI_XFORMS_INST_TABLE_EXISTS', "%s table already exists");
define('_MI_XFORMS_INST_NO_TABLE', "%s table does not exist");
define('_MI_XFORMS_GLOBAL_DEFAULT', "[b]* Required[/b]");
define('_MI_XFORMS_BLK_FORM_DESC', "A block to display a single available form (permissions aware)");
define('_MI_XFORMS_BLK_LIST_DESC', "A block to list available forms (permissions aware)");
define('_MI_XFORMS_ADMENU5', "About");
define('_MI_XFORMS_ADMENU5_DESC', "About this module");
define('_MI_XFORMS_ADMENU0_DESC', "Admin Home page");
define('_MI_XFORMS_UPLOADDIR_DESC', "All upload files will be stored here when a form is sent via private message");
define('_MI_XFORMS_BLOCKS', "Blocks");
define('_MI_XFORMS_CAPTCHA_EVERYONE', "Captcha for All users");
define('_MI_XFORMS_CAPTCHA_ANON_ONLY', "Captcha for anonymous users");
define('_MI_XFORMS_INST_NO_DEL_DIRS', "Could not delete old directories");
define('_MI_XFORMS_INST_NO_DEL_UPLOAD', "Could not delete upload directory (%s)");
define('_MI_XFORMS_INST_DIR_NOT_FOUND', "Could not find the %s directory");
define('_MI_XFORMS_ADMENU2', "Create/Edit a form");
define('_MI_XFORMS_ADMENU3_DESC', "Create/Edit a form element");
define('_MI_XFORMS_ADMENU2_DESC', "Create/Edit a specific form");
define('_MI_XFORMS_ADMENU3', "Create/Edit form element");
define('_MI_XFORMS_ADMENU4_DESC', "Create/View a form report");
define('_MI_XFORMS_TEXTAREA_COLS', "Default columns of text areas");
define('_MI_XFORMS_DEFAULT_TITLE', "Default Main Page Title");
define('_MI_XFORMS_TEXT_MAX', "Default maximum length of text boxes");
define('_MI_XFORMS_TEXTAREA_ROWS', "Default rows of text areas");
define('_MI_XFORMS_TEXT_WIDTH', "Default width of text boxes");
define('_MI_XFORMS_CAPTCHA_NONE', "Do not use captcha");
define('_MI_XFORMS_INTRO_DEFAULT', "Feel free to contact us via the following means:");
define('_MI_XFORMS_BLK_FORM', "Form block");
define('_MI_XFORMS_HELP_ELEMENTS', "Form Elements");
define('_MI_XFORMS_BLK_LIST', "Form list block");
define('_MI_XFORMS_ADMENU4', "Form report");
define('_MI_XFORMS_DEFAULT_TITLE_DESC', "Forms Page");
define('_MI_XFORMS_ADMENU0', "Home");
define('_MI_XFORMS_ADMENU6', "Import");
define('_MI_XFORMS_IMPORT', "Import");
define('_MI_XFORMS_ADMENU6_DESC', "Import data from similar module(s)");
define('_MI_XFORMS_CAPTCHA_INHERIT', "Inherit settings from XOOPS");
define('_MI_XFORMS_INTRO', "Introduction text in main page");
define('_MI_XFORMS_HELP_ISSUES', "Issues");
define('_MI_XFORMS_MAIL_CHARSET_DESC', "Leave blank for " .  _CHARSET . "");
define('_MI_XFORMS_TMPL_MAIN_DESC', "Main page of \"xforms\"");
define('_MI_XFORMS_ADMENU1_DESC', "Manage defined forms");
define('_MI_XFORMS_ADMENU1', "Manage forms");
define('_MI_XFORMS_UPGRADE', "Mise � jour");
define('_MI_XFORMS_PERPAGE', "Number of forms to show per page (in Admin)");
define('_MI_XFORMS_SHOW_TPL_NAME_DESC', "Option to use only for developpement, desactvate it in production");
define('_MI_XFORMS_HELP_OVERVIEW', "Overview");
define('_MI_XFORMS_TMPL_ERROR_DESC', "Page to show when error occurs");
define('_MI_XFORMS_UPLOADDIR', "Physical path for storing uploaded files WITHOUT trailing slash");
define('_MI_XFORMS_PREFERENCE', "Preference");
define('_MI_XFORMS_ELE_SELECT_CTRY_DEFAULT', "Select Default Country");
define('_MI_XFORMS_CAPTCHA_DESC', "Select users who will use captcha when submitting forms.<br>Default: <em>'" .  _MI_XFORMS_CAPTCHA_INHERIT  . "'</em>");
define('_MI_XFORMS_MOREINFO', "Send additional information along with the submitted data");
define('_MI_XFORMS_SHOWFORMS', "Show \"xForm\" on index page?");
define('_MI_XFORMS_SHOW_TPL_NAME', "Show templates names");
define('_MI_XFORMS_NOFORM_DEFAULT', "Sorry, there are currently no forms (visible for you).");
define('_MI_XFORMS_MOREINFO_IP', "Submitter's IP address");
define('_MI_XFORMS_MOREINFO_AGENT', "Submitter's user agent (browser info)");
define('_MI_XFORMS_TMPL_FORM_DESC', "Template for forms");
define('_MI_XFORMS_TMPL_POLL_DESC', "Template for polls");
define('_MI_XFORMS_MAIL_CHARSET', "Text encoding for sending emails");
define('_MI_XFORMS_PREFIX', "Text prefix for required fields");
define('_MI_XFORMS_NOFORM', "Text shown when there are no forms visible to the current user");
define('_MI_XFORMS_SUFFIX', "Text suffix for required fields");
define('_MI_XFORMS_GLOBAL', "Text to be displayed in every form page");
define('_MI_XFORMS_DESC', "This module is used to create forms to collect user input.");
define('_MI_XFORMS_MOREINFO_FORM', "URL of the submitted form");
define('_MI_XFORMS_CAPTCHA', "Use captcha when submitting forms?");
define('_MI_XFORMS_MOREINFO_USER', "User name and url to user info page");
define('_MI_XFORMS_NAME', "xForms");
define('_MI_XFORMS_SHOWFORMS_DESC', "Yes - the forms available to the user will be shown on the index page. No - the user will be sent to the site home page if no specific form is form selected.");
define('_MI_XFORMS_PERPAGE_DESC', "Per page");
define('_MI_XFORMS_EDITOR_ADMIN', "Editor to use (admin):");
define('_MI_XFORMS_EDITOR_ADMIN_DESC', "Select the text editor to use in the Back office. If you have a standard installation you can just select DHTML, Compact and tinyMCE");
define('_MI_XFORMS_EDITOR_USER', "Editor to use (user):");
define('_MI_XFORMS_EDITOR_USER_DESC', "Select the text editor to use in the Front office. If you have a standard installation you can just select DHTML, Compact and tinyMCE");
define('_MI_XFORMS_BLOCKS_ADMIN', "Admin Blocks");
define('_MI_XFORMS_CAPTCHA_MODE', "Return mode on captcha error");
define('_MI_XFORMS_CAPTCHA_MODE0', "Return to a blank form");
define('_MI_XFORMS_CAPTCHA_MODE1', "Return to a pre-filled form");
define('_MI_XFORMS_CSS_FOLDER', "Location of style sheets");
define('_MI_XFORMS_CSS_FOLDER_DESC', "Style sheets can be placed in a common folder for use by other modules. <br> Leaving empty uses CSS sheets from the default module. <br> The path must be given relative to the site root.");
define('_MI_XFORMS_ADMENU7', "Contact");
define('_MI_XFORMS_ADMENU7_DESC', "Contact forms, allows you to respond to submissions");
define('_MI_XFORMS_COLOR_SET', "Color scheme");
define('_MI_XFORMS_COLOR_SET_DESC', "Set the default color scheme for items. The color schemes are defined in the CSS \"style-item-color.css \" module or theme or JJD framework (see module options)");


define('_MI_XFORMS_BANISH', "Avertissement pour les banissements");
define('_MI_XFORMS_BANISH_DESC', "Ce texte sera affiché aux utilisateurs bannis");
define('_MI_XFORMS_BANISH_DEFAULT', "Votre courriel a été bannis, probablement pour cause de spam.");

define('_MI_XFORMS_ADMENU8', "Bannis");
define('_MI_XFORMS_ADMENU8_DESC', "Email bannis pour cause de spam");


?>