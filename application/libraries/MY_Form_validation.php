<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation 
{
    public function __construct($rules = array())
    {
        parent::__construct($rules);
    }

    public function run($module = '', $group = '') {        
        (is_object($module)) AND $this->CI =& $module;
        return parent::run($group);
    }    

    /**
     * Error Array
     *
     * Returns the error messages as an array
     *
     * @return  array
     */
    function error_array()
    {
        if (count($this->_error_array) === 0)
        {
            return FALSE;
        }
        else
            return $this->_error_array;
 
    }

}
/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */ 