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
 * @package   \XoopsModules\Xforms\frontside
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2019 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use Xmf\Request;
use XoopsModules\Xforms;
use XoopsModules\Xforms\Constants;
use XoopsModules\Xforms\Captcha;
use XoopsModules\Xforms\Utility;
use XoopsModules\Xforms\MediaUploader;
use Xmf\FilterInput;

require __DIR__ . '/header.php';
require_once 'include/functions.php';
$myts   = \MyTextSanitizer::getInstance();

/* @var string $moduleDirName  */
/* @var \XoopsModules\Xforms\Helper $helper */
$helper->loadLanguage('admin');

$submit = Request::getCmd('submit', '', 'POST');
            require_once $GLOBALS['xoops']->path('/header.php');
            Xforms\load_css();

if (empty($submit)) {
    include_once('index-view.php');
}else{
  //-------------------------------
  // execute the form
  //-------------------------------
    include_once('index-send.php');
}


