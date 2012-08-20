<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sp 
{
    /**
     * Just trying to get started...
     *
     */
    protected $_ci;
    
    public function __construct()
    {
       // Get CI superobject by reference
       $this->_ci = & get_instance();
    }
    
    /**
     * Single function to run the stored procedure.
     * Pass in parameters as array, stored procedure name as string, and optional out variable name as string
     *
     * @param array $para 
     * @param string $sp_name 
     * @param string $out
     */
    public function run($para, $sp_name, $out = NULL)
    {
        // Get number of parameters
        $i = count($para);
        
        // Put the parameter string together - just the stuff within the parenthesis  
        // CALL sp_example(?,?,?,?,@out_example)
        if($out)
        {
            // I'd be nice to check if the @ is there already or not.  Maybe later...
            $bind = str_repeat('?,',$i). $out;
        }
        else 
        {
            // Without the need for the out parameter, remove the final comma from the string.
            $bind = substr_replace(str_repeat('?,',$i),'',-1);
        }
        
        // This is the entire SQL statement
        $sql = 'CALL '. $sp_name .'('. $bind .')';
        
        //  Did you hear something break?
        if (! $this->_ci->db->query($sql,$para) )
        {
            return FALSE;        
        }
        
        // If we are returning a value, when using MySQL, you have to select the out parameter, otherwise
        // you won't get a value back.
        if( $out )
        {
            $query = $this->_ci->db->query('SELECT '. $out);
            return $query->row();    
        }
        else 
        {
            return TRUE;
        } 
            
    }
    
}