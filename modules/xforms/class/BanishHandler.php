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
 * Class \XoopsModules\Xforms\BanishHandler
 */
class BanishHandler extends \XoopsPersistableObjectHandler
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
        $this->db_table = $this->db->prefix('xforms_banish');
        $this->dirname  = basename(dirname(__DIR__));
        parent::__construct($db, 'xforms_banish', Banish::class, 'banish_id', 'banish_email');
    }

    
    /**
     * @param $email email à banir
     */
    public function add_banish($email){
        if (!$this->is_banish($email, true)){
          $sql ="INSERT INTO " . $this->db->prefix('xforms_banish')
          . " (banish_email, banish_attempts, banish_update) VALUES('{$email}', 1, " . time() . ");";
          $this->db->query($sql);
        }
    }
    
    /**
     * @param $email email à banir
     */
    public function remove_banish($email){
        //if ($this->is_banish($email, false)){
          $sql ="DELETE FROM " . $this->db->prefix('xforms_banish')
             . " WHERE banish_email LIKE '%{$email}%';";
          $this->db->query($sql);
//         }
//         exit;
    }
    
    /**
     * @param $email recherche si cet email est banni
     */
    public function is_banish($email, $increment_attempts = true){
        if ($email == "") return 0;
        
        $sql ="SELECT * FROM " . $this->db->prefix('xforms_banish')
             . " WHERE banish_email LIKE '%{$email}%';";
        $rst = $this->db->query($sql);
        if ($this->db->getRowsNum($rst) > 0){
            $t = $this->db->fetchArray($rst);
            $attempts = $t['banish_attempts'];
            $banish_id = $t['banish_id'];
        }else{
            $attempts = 0;
            $banish_id = 0;
        }
        
        if($increment_attempts){
            $this->increment_attempts($email);
        }
         
//         echo "is_banish : email = {$email} - attempts = {$attempts}<br>";    
//         exit;    
        return $attempts;
    }
    

    /**
     * @param $email recherche si cet email est banni
     */
    public function increment_attempts($email){
        $sql ="UPDATE " . $this->db->prefix('xforms_banish')
             . " SET banish_attempts = (banish_attempts + 1) "
             . " , banish_update = " . time()
             . " WHERE banish_email LIKE '%{$email}%';";
        $this->db->query($sql);
        echo "increment_attempts : email = {$email}<br>";
 
        
    }
    

    
    
} // Fin de class
