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
 * @package   \XoopsModules\Xforms\admin\class
 * @author    XOOPS Module Development Team
 * @copyright Copyright (c) 2001-2017 {@link https://xoops.org XOOPS Project}
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * @since     1.30
 */
use XoopsModules\Xforms\Constants;
use Xmf\Module\Helper\Permission;

//defined('XFORMS_ROOT_PATH') || exit('Restricted access');

/**
 * Class \XoopsModules\Xforms\UserFormHandler
 */
class UserFormHandler extends \XoopsPersistableObjectHandler
{
    /**
     *
     * @var \XoopsDatabase
     */
    public $db;
    /**
     *
     * @var string name of table in database
     */
    public $db_table;
    /**
     *
     * @var string permission name
     */
    //public $perm_name = 'xforms_form_access';
    /**
     *
     * @var string name of the module's root directory
     */
    protected $dirname;


    /**
     * @param $db \XoopsDatabase to use for the form
     */
    public function __construct(\XoopsDatabase $db = null)
    {
        $this->db       = $db;
        $this->db_table = $this->db->prefix('xforms_userform');
        $this->dirname  = basename(dirname(__DIR__));
        parent::__construct($db, 'xforms_userform', UserForm::class, 'uform_id', 'uform_email');
    }

    /**
     * Set the form status and update it in the database
     * @param \XoopsModules\Xforms\Forms $userform
     * @param bool $force true to force write to database independent of security settings
     *
     * @return bool true on success
     */
//     public function setStatus(\XoopsModules\Xforms\UserForms $userform, $status, $force = true)
//     {
//         $ret = true;
//         $userform->setVar('uform_status', $status);
//         $result = $this->insert($userform, (bool)$force);
//
//         if (!$result) {
//             $form->setErrors(sprintf(_MD_XFORMS_ERR_DB_INSERT, $this->db->error(), $this->db->errno()));
//             $ret = false;
//         }
//
//         return $ret;
//     }

    /**
     * Set the form answer and update it in the database
     * @param \XoopsModules\Xforms\Forms $userform
     * @param bool $force true to force write to database independent of security settings
     *
     * @return bool true on success
     */
    public function setAnswer(\XoopsModules\Xforms\UserForms $userform, $data, $force = true)
    {
        $ret = true;
        $userform->setVars($data);

/*
        $userform->setVar('', $data['']);

CREATE TABLE `xforms_userform` (
  `uform_id` mediumint(8) NOT NULL auto_increment,
  `form_id` smallint(5) NOT NULL,
  `uform_status` smallint(5) NOT NULL default '0',
  `uform_user` varchar(80) NOT NULL default '',
  `uform_email` varchar(50) NOT NULL default '',
  `uform_chrono` varchar(50) NOT NULL default '',
  `uform_object` varchar(80) NOT NULL default '',
  `uform_answer` text NOT NULL default '',
  PRIMARY KEY  (`uform_id`),
  KEY `uform_status` (`uform_status`)
) ENGINE=MyISAM;
*/


        $result = $this->insert($userform, (bool)$force);

        if (!$result) {
            $form->setErrors(sprintf(_MD_XFORMS_ERR_DB_INSERT, $this->db->error(), $this->db->errno()));
            $ret = false;
        }

        return $ret;
    }


}
