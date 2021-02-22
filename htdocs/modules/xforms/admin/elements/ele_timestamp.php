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
 * @package   \XoopsModules\Xforms\admin\elements
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     2.00
 */
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\FormInput;
use XoopsModules\Xforms\FormRaw;

defined('XFORMS_ROOT_PATH') || exit('Restricted access');

if (!class_exists('\XoopsModules\Xforms\FormRaw')) {
    xoops_load('formraw', basename(dirname(dirname(__DIR__))));
}
/**default timestamp    'timestamp'
 * Timestamp
 *
 * value [0] = forrmat d'affichage
 *       [1] = gras
 *       [2] = valeur courante (function)
 */

// define('ele_timestamp_value')
$tsFormat   = !empty($value[0]) ? $value[0] : '%A %d %B %Y à %Hh:%M'; //'Y-m-d H:i:s'       d-m-Y à H:i:s       <br>Exemple : \"%A %d %B %Y à %Hh:%M\"
$bold       = !empty($value[1]) ? (int)$value[1] : 0;
//$value      = date($tsFormat);


//$valueEle    = new FormLabel('', 'ele_value[2]', 15, 15, date($tsFormat), null, 'string');
$formatEle   = new XoopsFormText(_AM_XFORMS_ELE_FORMAT, 'ele_value[0]', 25, 25, $tsFormat);
$formatEle->setDescription(_AM_XFORMS_ELE_FORMAT_DESC);
$boldEle  = new \XoopsFormRadioYN(_AM_XFORMS_ELE_BOLD, 'ele_value[1]', $bold);


//======================================================
//$output->addElement($valueEle);
$output->addElement($formatEle);
$output->addElement($boldEle);

