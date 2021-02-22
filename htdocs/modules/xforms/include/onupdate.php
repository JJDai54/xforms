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
 * @package   \XoopsModules\Xforms\include
 * @author    Richard Griffith <richard@geekwright.com>
 * @author    trabis <lusopoemas@gmail.com>
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     2.00
 */

use XoopsModules\Xforms;
use XoopsModules\Xforms\Helper as xHelper;
use XoopsModules\Xforms\Utility;

/**
 * @internal {Make sure you PROTECT THIS FILE}
 */

if ((!defined('XOOPS_ROOT_PATH'))
    || !($GLOBALS['xoopsUser'] instanceof \XoopsUser)
    || !($GLOBALS['xoopsUser']->isAdmin()))
{
    exit('Restricted access' . PHP_EOL);
}

/**
 * Upgrade works to update Xforms from previous versions
 *
 * @param \XoopsModule $module
 * @param string $prev_version version * 100
 *
 * @uses \Xmf\Module\Admin
 * @uses \XoopsModules\Xforms\Utility
 *
 * @return bool
 *
 */
function xoops_module_update_xforms(\XoopsModule $module, $prev_version)
{
    /* @var \XoopsModules\Xforms\Utility $utility */
    $utility = new Utility();

    $success = true;
    $success = $utility::checkVerXoops($module);
    $success = $utility::checkVerPHP($module);
    if (!$success) {
        return false;
    }
    /*
     =============================================================
     Upgrade for Xforms < 2.0
     =============================================================
     =====================================
     - rename xforms_forms to xforms_form
     - init following columns in xforms_form:
     =====================================
     form_save_db       tinyint(1)
     form_send_to_other varchar(255)
     form_send_copy     tinyint(1)
     form_email_header  text
     form_email_footer  text
     form_email_uheader text
     form_email_ufooter text
     form_display_style varchar(1)
     form_begin         int(10)
     form_end           int(10)
     form_active        tinyint(1)
     =====================================
     - rename xforms_formelements to xforms_element
     - add index disp_ele_by_form
     - change all ele_type 'select2' column data to 'country'
     =====================================
     - create the xforms_userdata table
     =====================================
     - remove old .css, .js, and .image
       and (sub)directories if they exist
     - remove old element files (./admin/ele_*.php)
     =====================================
     =============================================================
    */
echo "version = {$prev_version}<br>";
    $success = true;

    /* @var \XoopsModules\Xforms\Helper $helper */
    $helper = xHelper::getInstance();
    $helper->loadLanguage('modinfo');

    require_once $helper->path('include/common.php');
    //$fldVersions = XOOPS_ROOT_PATH . 'modules/xforms/include/versions/';
    $fldVersions = 'versions/';
    //---------------------------------------------------------------------
    if ($prev_version < 200) {
      $success = include_once ($fldVersions . 'version-200.php');
    }
    //---------------------------------------------------------------------
    if ($prev_version < 204) {
      $success = include_once ($fldVersions . 'version-204.php');
    }
    //---------------------------------------------------------------------
    if ($prev_version < 209 || true) {
      $success = include_once ($fldVersions . 'version-205.php');
    }
    //---------------------------------------------------------------------

     return $success;
}
