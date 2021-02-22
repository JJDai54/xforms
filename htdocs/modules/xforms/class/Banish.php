<?php

namespace XoopsModules\Xforms;

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
 * Module: Xforms
 *
 * @package   \XoopsModules\Xforms\class
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2017 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */

defined('XFORMS_ROOT_PATH') || exit('Restricted access');

/**
 * Class \XoopsModules\Xforms\Banish
 */
class Banish extends \XoopsObject
{
    /**
     * \XoopsModules\Xforms\Banish contructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('banish_id', XOBJ_DTYPE_INT, null, false);
        $this->initVar('banish_email', XOBJ_DTYPE_TXTBOX, _SUBMIT, true, 50);
        $this->initVar('banish_attempts', XOBJ_DTYPE_INT, 0, false);
        $this->initVar('banish_update', XOBJ_DTYPE_INT, 0, false);
    }
}
