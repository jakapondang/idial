<?php
class Pages_model extends CI_Model {
   
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getMainMenu($table)
    {
        $query = $this->db->query('SELECT name FROM '.$table.' WHERE parent_id=0');

        return $query->result_array();
    }
    
   
}
/*$this->db->select('content.*, mainmenu.label');
        $this->db->from('content');
        $this->db->join('mainmenu', 'mainmenu.id = content.katId', 'left');
        $this->db->where('mainmenu.label', mysql_escape_string(urldecode(end($this->uri->segments))));

        $query = $this->db->get();

        return $query->result_array();*/