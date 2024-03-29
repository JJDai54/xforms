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
 * Module: xForms
 *
 * @package   \XoopsModules\Xforms\class
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2017 {@link http://xoops.org XOOPS Project}
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     2.00
 */

defined('XFORMS_ROOT_PATH') || exit('Restricted access');

/**
 * Class \XoopsModules\Xforms\EfUserDataHandler
 *
 * @see \XoopsPersistableObjectHandler
 */
class EfUserDataHandler extends \XoopsPersistableObjectHandler
{
    /**
     *
     * @var XoopsDatabase
     */
    public $db;
    /**
     *
     * @var string name of table in database
     */
    public $db_table;

    /**
     * \XoopsModules\Xforms\EfUserDataHandler constructor
     *
     * @param $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        $this->db       = $db;
        $this->db_table = $this->db->prefix('eforms_userdata');
        parent::__construct($db, 'eforms_userdata', EfUserData::class, 'udata_id');
    }
}
