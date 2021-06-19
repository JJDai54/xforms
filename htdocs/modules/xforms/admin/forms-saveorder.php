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
 * Main administration page
 *
 * @package   \XoopsModules\Xforms\admin
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use Xmf\Request;
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\FormInput;

require_once __DIR__ . '/admin_header.php';
//echo __DIR__ ."<br>";
require_once  '../include/functions.php';
require_once  'status.php';

$myts = \MyTextSanitizer::getInstance();

        if (!$GLOBALS['xoopsSecurity']->check()) {
            //redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
        }

        $ids = Request::getArray('ids', array(), 'POST');
// echo "<hr><pre>" . print_r($ids, true) . "</pre><hr>";      
// exit;  
        if (empty($ids)) {
            redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_NOTHING_SELECTED);
        }
        $ids = array_map('intval', $ids); //sanitize the array
        // now get and filter the order too
        $order = Request::getArray('order', array(), 'POST');
        array_walk($order, '\XoopsModules\Xforms\Utility::intArray'); // can't use array_map since must preserve keys
        foreach ($ids as $id) {
            $form = $formsHandler->get($id);
            $form->setVar('form_order', $order[$id]);
            $formsHandler->insert($form);
        }
//echo "===>SCRIPT_NAME = " . $_SERVER['SCRIPT_NAME'] ."<br>" ;exit;    
        redirect_header($_SERVER['SCRIPT_NAME'] . "?op=list&selectStatus={$selectStatus}", Constants::REDIRECT_DELAY_NONE, _AM_XFORMS_DBUPDATED);




















include __DIR__ . '/admin_footer.php';
xoops_cp_footer();
