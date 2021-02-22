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
 * @author    XOOPS Module Development Team / JJDai
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     2.00
 */
use XoopsModules\Xforms;
use XoopsModules\Xforms\FormInput;

defined('XFORMS_ROOT_PATH') || exit('Restricted access');

if (!class_exists('\XoopsModules\Xforms\FormInput')) {
    xoops_load('FormInput', basename(dirname(dirname(__DIR__))));
}

/**
 * Chrono element
 *
 * value [0] = start or current value
 *       [1] = nb digits
 *       [2] = step size
 *       [3] = prefix
 *       [4] = suffix
 *       [5] = gras
 */


$currentValue = !empty($value[0]) ? (int)$value[0] : 0;
$nbDigits     = !empty($value[1]) ? (int)$value[1] : 5;
$step         = !empty($value[2]) ? (int)$value[2] : 1;
$prefix       = isset($value[3]) ? $value[3] : '';
$suffix       = isset($value[4]) ? $value[4] : '';
$bold         = !empty($value[5]) ? (int)$value[5] : 0;

//$chrono       = '#####';

//==============================================================
//$defTray   = new \XoopsFormElementTray(_AM_XFORMS_ELE_DEFAULT, '<br>', 'defTray');
$defInput  = new FormInput(_AM_XFORMS_ELE_NEXT_VALUE, 'ele_value[0]', 7, 7, $currentValue, null, 'number');
$defInput->setAttribute('size', 7);
$defInput->setAttribute('pattern', '[0-9].');
//$defTray->addElement($defInput);
$defInput->setDescription(_AM_XFORMS_ELE_NEXT_VALUE_DESC);

$nbDigitsInput = new FormInput(_AM_XFORMS_ELE_NB_DIGITS, 'ele_value[1]', 7, 255, $nbDigits, null, 'number');
$nbDigitsInput->setAttribute('size', 7);
$nbDigitsInput->setAttribute('min', 1);
$nbDigitsInput->setAttribute('max', 10);
$nbDigitsInput->setAttribute('pattern', '[0-9].');
$nbDigitsInput->setDescription(_AM_XFORMS_ELE_NB_DIGITS_DESC);



$stepInput = new FormInput(_AM_XFORMS_ELE_CHRONO_STEP, 'ele_value[2]', 7, 255, $step, null, 'number');
$stepInput->setAttribute('size', 7);
$stepInput->setAttribute('min', 1);
$nbDigitsInput->setAttribute('max', 10);
$stepInput->setAttribute('pattern', '[1-9].');
$stepInput->setDescription(_AM_XFORMS_ELE_CHRONO_STEP_DESC);


$prefixInput = new \XoopsFormText(_AM_XFORMS_ELE_PREFIX, 'ele_value[3]', 25, 25, $prefix);
$prefixInput->setDescription(_AM_XFORMS_ELE_PREFIX_DESC);

$suffixInput = new \XoopsFormText(_AM_XFORMS_ELE_SUFFIX, 'ele_value[4]', 25, 25, $suffix);
$suffixInput->setDescription(_AM_XFORMS_ELE_SUFFIX_DESC);

$boldEle  = new \XoopsFormRadioYN(_AM_XFORMS_ELE_BOLD, 'ele_value[5]', $bold);

//$chronoInput = new \XoopsFormHidden('ele_value[5]', $chrono);
// $chronoInput = new \XoopsFormText("zzzzz", 'ele_value[5]', 10, 10, $chrono);
// $chronoInput->setDescription("Laisser vide ce champ.");

//==============================================================
$output->addElement($defInput);
$output->addElement($nbDigitsInput);
$output->addElement($stepInput);
$output->addElement($prefixInput);
$output->addElement($suffixInput);
$output->addElement($boldEle);
//$output->addElement($chronoInput);
//==============================================================




