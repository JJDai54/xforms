<?php
/*
 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: xForms
 *
 * @package   \XoopsModules\Xforms\admin\blocks
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link http://xoops.org XOOPS Project}
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     2.00
 */
use XoopsModules\Xforms\Helper;

// instantiate module helper
/* @var \XoopsModules\Xforms\Helper $helper */
$helper = Helper::getInstance();     // module helper
require_once $helper->path('include/common.php');

/**
 * Display the form block
 *
 * @param array $options
 *
 * @return boolean
 */
function b_xforms_xbootstrap_show($options) {
global $xoopsDB;

    $moduleDirName = basename(dirname(__DIR__));
    // Instantiate module helper
    $helper = Helper::getInstance();
    $helper->loadLanguage('admin');

    $block = array();
    //----------------------------------------------------
    $formsHandler = $helper::getInstance()->getHandler('Forms');
    //$forms = $formsHandler->getPermittedForms();
    //$rst  = $formsHandler->getSingleFormPermission((int)$options[0]);

    $forms = $formsHandler->getPermittedForms();
    $MenuItems = [];
    $urlModule =  XOOPS_URL . "/modules/" . $moduleDirName;
    $url = $urlModule . "/index.php?form_id=";

    if (!empty($forms)) {
        foreach ($forms as $form) {
            $form_id = $form->getVar('form_id');
            $MenuItems[$form_id] = [
                         'id'  => $form_id,
                         'lib' => $form->getVar('form_title', 's'),
                         'url' => $url . $form_id
                         ];

        }
    }

//===============================================================================

    //$block['MenuItems'] = $MenuItems;

    $block['module']['url'] = $urlModule;
    $block['module']['lib'] = _MB_XFORMS_TITLE_XBOOTSTRAP;

    $block['main']['forms']['url'] = $urlModule. "/index.php";
    $block['main']['forms']['lib'] = _MB_XFORMS_TITLE_XBOOTSTRAP;
    $block['main']['forms']['submenu'] = $MenuItems;


    $block['module']['nbMainMenu'] = count($block['main']);
    $block['module']['isMainMenu'] = intval($options[0]); //0 = menu / 1=sous menu

    //mode d'insertion du menu dans la barre : 0 = menu principal / 1=sous menu / 2=liste dans le menu courant
    $block['module']['level'] = ((isset($options[0])) ? intval($options[0]) : 0);

    // ajoute un separateur dans les menus
    $block['module']['add_sep_before'] = ((isset($options[1])) ? intval($options[1]) : 0);

    // ajoute un separateur dans les menus
    $block['module']['add_sep_after']  = ((isset($options[2])) ? intval($options[2]) : 0);

    /* Pour les test forçage des valeur d'affichage
    $block['module']['level'] = 2;
    $block['module']['add_sep_before'] = 1; 
    $block['module']['add_sep_after'] = 0; 
    */



//echo "<hr>Liste des formulaires : <pre>". print_r($block, true)  . "</pre>";
    return $block;
}

/**
 * Create HTML for block editing functionality
 *
 * @param array $options[0] = id of form to show
 *
 * @return string html for edit form
 *
 */
function b_xforms_xbootstrap_edit($options) {
    return null;
}
