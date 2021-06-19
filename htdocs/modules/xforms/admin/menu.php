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
 * Admin header file
 *
 * @package   \XoopsModules\Xforms\admin
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 *
 * @see \Xmf\Module\Admin
 */

//JJDai
//-------------------------------------------------------
require_once dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$module_handler  = xoops_gethandler('module');
$module          = $module_handler->getByDirname($moduleDirName);
$moduleId      = $module->mid();

$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
//$pathLanguage    = $path . $pathModuleAdmin;


$moduleDirNameUpper = mb_strtoupper($moduleDirName);

$helper =  \XoopsModules\Xforms\Helper::getInstance();

$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->getModule()->getInfo('modicons32');
}

//-------------------------------------------------------
$adminmenu = array(
    array('title' => _MI_XFORMS_ADMENU0,
          'link'  => 'admin/index.php',
          'desc'  => _MI_XFORMS_ADMENU0_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('home.png')
    ),
    array('title' => _MI_XFORMS_ADMENU1,
          'link'  => 'admin/forms.php',
          'desc'  => _MI_XFORMS_ADMENU1_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('manage.png')
    ),
    array('title' => _MI_XFORMS_ADMENU2,
          'link'  => 'admin/forms.php?op=edit',
          'desc'  => _MI_XFORMS_ADMENU2_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('add.png')
    ),
    array('title' => _MI_XFORMS_ADMENU3,
          'link'  => 'admin/editelement.php',
          'desc'  => _MI_XFORMS_ADMENU3_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('insert_table_row.png')
    ),
    array('title' => _MI_XFORMS_ADMENU4,
          'link'  => 'admin/report.php',
          'desc'  => _MI_XFORMS_ADMENU4_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('content.png')
    ),
    array('title' => _MI_XFORMS_ADMENU7,
          'link'  => 'admin/contact.php',
          'desc'  => _MI_XFORMS_ADMENU4_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('mail_foward.png')
    ),
    array('title' => _MI_XFORMS_ADMENU8,
          'link'  => 'admin/banish.php',
          'desc'  => _MI_XFORMS_ADMENU8_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('manage.png')
    ),
    array('title' => _MI_XFORMS_ADMENU6,
          'link'  => 'admin/import.php',
          'desc'  => _MI_XFORMS_ADMENU6_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('exec.png')
    ),
    array('title' => _MI_XFORMS_ADMENU5,
          'link'  => 'admin/about.php',
          'desc'  => _MI_XFORMS_ADMENU5_DESC,
          'icon'  => \Xmf\Module\Admin::menuIconPath('about.png')
    )
);
// JJDai
// $adminmenu[] = [
//     'title' => _MI_XFORMS_ABOUT,
//     'link'  => 'admin/about.php',
//     'icon'  => $pathIcon32 . '/about.png',
// ];
//

//---modif JJDai
/*
$adminmenu[] = [
    'title' => _MI_XFORMS_PREFERENCE,
    'menu'  => "preferences",
    'link'  => "../system/admin.php?fct=preferences&op=showmod&mod={$moduleId}",
    'icon'  => $pathIcon32 . '/exec.png'
];

$adminmenu[] = [
    'title' => _MI_XFORMS_UPGRADE,
    'menu'  => "update",
    'link'  => "../system/admin.php?fct=modulesadmin&op=update&module={$moduleDirName}",
    'icon'  => $pathIcon32 . '/update.png'
];

$adminmenu[] = [
    'title' => _MI_XFORMS_BLOCKS,
    'menu'  => "blocks",
    'link'  => "../system/admin.php?fct=blocksadmin&op=list&filter=1&selgen={$moduleId}&selmod=-2&selgrp=2&selvis=-1",
    'icon'  => $pathIcon32 . '/block.png'
];
*/




