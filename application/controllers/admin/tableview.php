<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Tableview extends CI_Controller {

        /**
        * Index Page for this controller.
        *
        * Maps to the following URL
        * 		http://example.com/index.php/welcome
        *	- or -  
        * 		http://example.com/index.php/welcome/index
        *	- or -
        * Since this controller is set as the default controller in 
        * config/routes.php, it's displayed at http://example.com/
        *
        * So any other public methods not prefixed with an underscore will
        * map to /index.php/welcome/<method_name>
        * @see http://codeigniter.com/user_guide/general/urls.html
        */
        
        public function __construct() {
            parent::__construct();
            $this->load->library(array('cor3'));


            if($this->session->userdata('user_admin')==NULL){
                print '<script>window.location="'.base_url().'jp/?err=2";</script>';
            }

        }
        
         public function index(){

             /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
          * Easy set variables
          */

             /* Array of database columns which should be read and sent back to DataTables. Use a space where
              * you want to insert a non-database field (for example a counter or static image)
              */

             $aColumns = explode(',',$_GET['colTab']);


             /* Indexed column (used for fast and accurate table cardinality) */
             $sIndexColumn = $_GET['icl'];

             /* DB table to use */
             $sTable = $_GET['tBn'];

             /*
             * Paging
             */
             $sLimit = "";
             if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
             {
                 $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
                     intval( $_GET['iDisplayLength'] );
             }


             /*
              * Ordering
              */
             $sOrder = "";
             if ( isset( $_GET['iSortCol_0'] ) )
             {
                 $sOrder = "ORDER BY  ";
                 for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
                 {
                     if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                     {
                         $sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
                             ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                     }
                 }

                 $sOrder = substr_replace( $sOrder, "", -2 );
                 if ( $sOrder == "ORDER BY" )
                 {
                     $sOrder = "";
                 }
             }


             /*
              * Filtering
              * NOTE this does not match the built-in DataTables filtering which does it
              * word by word on any field. It's possible to do here, but concerned about efficiency
              * on very large tables, and MySQL's regex functionality is very limited
              */
             $sWhere = "";
             if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
             {
                 $sWhere = "WHERE (";
                 for ( $i=0 ; $i<count($aColumns) ; $i++ )
                 {
                     $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                 }
                 $sWhere = substr_replace( $sWhere, "", -3 );
                 $sWhere .= ')';
             }

             /* Individual column filtering */
             for ( $i=0 ; $i<count($aColumns) ; $i++ )
             {
                 if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
                 {
                     if ( $sWhere == "" )
                     {
                         $sWhere = "WHERE ";
                     }
                     else
                     {
                         $sWhere .= " AND ";
                     }
                     $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
                 }
             }


             /*
              * SQL queries
              * Get data to display
              */
             $sQuery = "
                SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
                FROM   $sTable
                $sWhere
                $sOrder
                $sLimit
                ";
             $rResult = mysql_query( $sQuery ) or die(mysql_error());

             /* Data set length after filtering */
             $sQuery = "
                SELECT FOUND_ROWS()
            ";
             $rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error());
             $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
             $iFilteredTotal = $aResultFilterTotal[0];

             /* Total data set length */
             $sQuery = "
                SELECT COUNT(`".$sIndexColumn."`)
                FROM   $sTable
            ";
             $rResultTotal = mysql_query( $sQuery ) or die(mysql_error());
             $aResultTotal = mysql_fetch_array($rResultTotal);
             $iTotal = $aResultTotal[0];


             /*
              * Output
              */
             $output = array(
                 "sEcho" => intval($_GET['sEcho']),
                 "iTotalRecords" => $iTotal,
                 "iTotalDisplayRecords" => $iFilteredTotal,
                 "aaData" => array()
             );

             while ( $aRow = mysql_fetch_array( $rResult ) )
             {
                 $row = array();
                 for ( $i=0 ; $i<count($aColumns) ; $i++ )
                 {
                     if ( $aColumns[$i] == "version" )
                     {
                         /* Special output formatting for 'version' column */
                         $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
                     }
                     else if ( $aColumns[$i] != ' ' )
                     {
                         /* General output */
                         // status
                         if($aColumns[$i] == 'status'){
                             if($aRow[ $aColumns[$i] ]>0){
                                 $row[] = "enabled";
                             }else{
                                 $row[] = "disabled";
                             }

                         }else{
                             $row[] = $aRow[ $aColumns[$i] ];
                            }
                     }
                 }
                 $output['aaData'][] = $row;
             }

             echo json_encode( $output );

         }




        public function tjoin(){

            /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

            /* Array of database columns which should be read and sent back to DataTables. Use a space where
             * you want to insert a non-database field (for example a counter or static image)
             */

            $aColumns1 = explode(',',$_GET['colTab1']);


            $aColumns2 = explode(',',$_GET['colTab2']);



            /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = $_GET['icl'];

            $columnWhereKey = explode(',',$_GET['cWk']);
            $queryWherKey = array();
            for($i=0;$i<count($columnWhereKey);$i++){
                $queryWherKey[] = " '".$columnWhereKey[$i]."' ";

            }
            $queryWherKey = implode(",",$queryWherKey);

            /* DB table to use */
            $sTable1 = $_GET['tBn1'];

            $sTable2 = $_GET['tBn2'];

            /*ORDER / SQUENCE*/

            $columnSetOrderQuery = $_GET['Oc'];
            $columnSetOrder = $columnSetOrderQuery;

            /*
             * SQL queries
             * Get data to display
             */
            $aColumns1Query = array();
            $rowC = count($aColumns1);
            for($i=0;$i<$rowC;$i++){
                $aColumns1Query[] = "A.".$aColumns1[$i];
            }
            //table join
            $aColumns2Query = array();
            $rowC = count($aColumns2);
            for($i=0;$i<$rowC;$i++){
                $aColumns2Query[] = "B.".$aColumns2[$i];
            }
            // table 1
            $columnSetOrderQuery = str_replace($aColumns1,$aColumns1Query,$columnSetOrderQuery);
            // table 2
            $columnSetOrderQuery = str_replace($aColumns2,$aColumns2Query,$columnSetOrderQuery);
            // array
            $columnSetOrderQuery = explode(',',$columnSetOrderQuery);
            $columnSetOrder = explode(',',$columnSetOrder);

            /*
            * Paging
            */
            $sLimit = "";
            if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
            {
                $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
                    intval( $_GET['iDisplayLength'] );
            }


            /*
             * Ordering
             */
            $sOrder = "";
            if ( isset( $_GET['iSortCol_0'] ) )
            {
                $sOrder = "ORDER BY  ";
                for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
                {
                    if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                    {
                        $sOrder .= $columnSetOrderQuery[ intval( $_GET['iSortCol_'.$i] ) ]." ".
                            ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                    }
                }

                $sOrder = substr_replace( $sOrder, "", -2 );
                if ( $sOrder == "ORDER BY" )
                {
                    $sOrder = "";
                }
            }


            /*
             * Filtering
             * NOTE this does not match the built-in DataTables filtering which does it
             * word by word on any field. It's possible to do here, but concerned about efficiency
             * on very large tables, and MySQL's regex functionality is very limited
             */
            $sWhere = "";
            if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
            {
                $sWhere = "AND (";
                for ( $i=0 ; $i<count($columnSetOrderQuery) ; $i++ )
                {
                    $sWhere .= "".$columnSetOrderQuery[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                }
                $sWhere = substr_replace( $sWhere, "", -3 );
                $sWhere .= ')';
            }

            /* Individual column filtering */
            for ( $i=0 ; $i<count($columnSetOrderQuery) ; $i++ )
            {
                if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
                {
                    if ( $sWhere == "" )
                    {
                        $sWhere = "and ";
                    }
                    else
                    {
                        $sWhere .= " AND ";
                    }
                    $sWhere .= "".$columnSetOrderQuery[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
                }
            }

            $sQuery = "
                SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $columnSetOrderQuery))."

                FROM   $sTable1 A LEFT JOIN $sTable2 B ON A.$sIndexColumn = B.$sIndexColumn
                 WHERE (B.meta_key IN ($queryWherKey)  OR B.meta_key IS NULL)
                $sWhere
                $sOrder
                $sLimit
                ";
            //print $sQuery;

            $rResult = mysql_query( $sQuery ) or die(mysql_error());

            /* Data set length after filtering */
            $sQuery = "
                SELECT FOUND_ROWS()
            ";
            $rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error());
            $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
            $iFilteredTotal = $aResultFilterTotal[0];

            /* Total data set length */
            $sQuery = "
                SELECT COUNT(`".$sIndexColumn."`)
                FROM   $sTable1
            ";
            $rResultTotal = mysql_query( $sQuery ) or die(mysql_error());
            $aResultTotal = mysql_fetch_array($rResultTotal);
            $iTotal = $aResultTotal[0];


            /*
             * Output
             */
            $output = array(
                "sEcho" => intval($_GET['sEcho']),
                "iTotalRecords" => $iTotal,
                "iTotalDisplayRecords" => $iFilteredTotal,
                "aaData" => array()
            );

            // merge join
            //$aColumns1 = array_merge($aColumns2,$aColumns1);

            while ( $aRow = mysql_fetch_array( $rResult ) )
            {
                $row = array();
                for ( $i=0 ; $i<count($columnSetOrder) ; $i++ )
                {
                    if ( $columnSetOrder[$i] == "version" )
                    {
                        /* Special output formatting for 'version' column */
                        $row[] = ($aRow[ $columnSetOrder[$i] ]=="0") ? '-' : $aRow[ $columnSetOrder[$i] ];
                    }
                    else if ( $columnSetOrder[$i] != ' ' )
                    {
                        /* General output */
                        // status
                        if($columnSetOrder[$i] == 'status'){
                            if($aRow[ $columnSetOrder[$i] ]>0){
                                $row[] = "enabled";
                            }else{
                                $row[] = "disabled";
                            }

                        }
                        elseif($columnSetOrder[$i] == 'meta_value'){

                                $row[] = "<img src='".base_url()."assets/upload/brand/".$aRow[ $columnSetOrder[$i] ]."' width='100px'/>";


                        }else{
                            $row[] = $aRow[ $columnSetOrder[$i] ];
                        }
                    }
                }
                $output['aaData'][] = $row;
            }

            echo json_encode( $output );

        }


        public function ijoin(){

            /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
          * Easy set variables
          */

            /* Array of database columns which should be read and sent back to DataTables. Use a space where
             * you want to insert a non-database field (for example a counter or static image)
             */

            $aColumns1 = explode(',',$_GET['colTab1']);


            $aColumns2 = explode(',',$_GET['colTab2']);



            /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = $_GET['icl'];


            /* DB table to use */
            $sTable1 = $_GET['tBn1'];

            $sTable2 = $_GET['tBn2'];

            /*ORDER / SQUENCE*/

            $columnSetOrderQuery = $_GET['Oc'];
            $columnSetOrder = $columnSetOrderQuery;

            /*
             * SQL queries
             * Get data to display
             */
            $aColumns1Query = array();
            $rowC = count($aColumns1);
            for($i=0;$i<$rowC;$i++){
                $aColumns1Query[] = "A.".$aColumns1[$i];
            }
            //table join
            $aColumns2Query = array();
            $rowC = count($aColumns2);
            for($i=0;$i<$rowC;$i++){
                $aColumns2Query[] = "B.".$aColumns2[$i];
            }
            // table 1
            $columnSetOrderQuery = str_replace($aColumns1,$aColumns1Query,$columnSetOrderQuery);
            // table 2
            $columnSetOrderQuery = str_replace($aColumns2,$aColumns2Query,$columnSetOrderQuery);
            // array
            $columnSetOrderQuery = explode(',',$columnSetOrderQuery);
            $columnSetOrder = explode(',',$columnSetOrder);

            /*
            * Paging
            */
            $sLimit = "";
            if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
            {
                $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
                    intval( $_GET['iDisplayLength'] );
            }


            /*
             * Ordering
             */
            $sOrder = "";
            if ( isset( $_GET['iSortCol_0'] ) )
            {
                $sOrder = "ORDER BY  ";
                for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
                {
                    if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                    {
                        $sOrder .= $columnSetOrderQuery[ intval( $_GET['iSortCol_'.$i] ) ]." ".
                            ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                    }
                }

                $sOrder = substr_replace( $sOrder, "", -2 );
                if ( $sOrder == "ORDER BY" )
                {
                    $sOrder = "";
                }
            }


            /*
             * Filtering
             * NOTE this does not match the built-in DataTables filtering which does it
             * word by word on any field. It's possible to do here, but concerned about efficiency
             * on very large tables, and MySQL's regex functionality is very limited
             */
            $sWhere = "";
            if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
            {
                $sWhere = "AND (";
                for ( $i=0 ; $i<count($columnSetOrderQuery) ; $i++ )
                {
                    $sWhere .= "".$columnSetOrderQuery[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                }
                $sWhere = substr_replace( $sWhere, "", -3 );
                $sWhere .= ')';
            }

            /* Individual column filtering */
            for ( $i=0 ; $i<count($columnSetOrderQuery) ; $i++ )
            {
                if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
                {
                    if ( $sWhere == "" )
                    {
                        $sWhere = "and ";
                    }
                    else
                    {
                        $sWhere .= " AND ";
                    }
                    $sWhere .= "".$columnSetOrderQuery[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
                }
            }

            $sQuery = "
                SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $columnSetOrderQuery))."

                FROM   $sTable1 A LEFT JOIN $sTable2 B ON A.$sIndexColumn = B.$sIndexColumn
                $sWhere
                $sOrder
                $sLimit
                ";
            //print $sQuery;

            $rResult = mysql_query( $sQuery ) or die(mysql_error());

            /* Data set length after filtering */
            $sQuery = "
                SELECT FOUND_ROWS()
            ";
            $rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error());
            $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
            $iFilteredTotal = $aResultFilterTotal[0];

            /* Total data set length */
            $sQuery = "
                SELECT COUNT(`".$sIndexColumn."`)
                FROM   $sTable1
            ";
            $rResultTotal = mysql_query( $sQuery ) or die(mysql_error());
            $aResultTotal = mysql_fetch_array($rResultTotal);
            $iTotal = $aResultTotal[0];


            /*
             * Output
             */
            $output = array(
                "sEcho" => intval($_GET['sEcho']),
                "iTotalRecords" => $iTotal,
                "iTotalDisplayRecords" => $iFilteredTotal,
                "aaData" => array()
            );

            // merge join
            //$aColumns1 = array_merge($aColumns2,$aColumns1);

            while ( $aRow = mysql_fetch_array( $rResult ) )
            {
                $row = array();
                for ( $i=0 ; $i<count($columnSetOrder) ; $i++ )
                {
                    if ( $columnSetOrder[$i] == "version" )
                    {
                        /* Special output formatting for 'version' column */
                        $row[] = ($aRow[ $columnSetOrder[$i] ]=="0") ? '-' : $aRow[ $columnSetOrder[$i] ];
                    }
                    else if ( $columnSetOrder[$i] != ' ' )
                    {
                        /* General output */
                        // status
                        if($columnSetOrder[$i] == 'status'){
                            if($aRow[ $columnSetOrder[$i] ]>0){
                                $row[] = "enabled";
                            }else{
                                $row[] = "disabled";
                            }

                        }
                        elseif($columnSetOrder[$i] == 'meta_value'){

                            $row[] = "<img src='".base_url()."assets/upload/brand/".$aRow[ $columnSetOrder[$i] ]."' width='100px'/>";


                        }else{
                            $row[] = $aRow[ $columnSetOrder[$i] ];
                        }
                    }
                }
                $output['aaData'][] = $row;
            }

            echo json_encode( $output );
        }

    }
    
    /* End of file homeroot.php */
    /* Location: ./application/controllers/homeroot.php

    SELECT SQL_CALC_FOUND_ROWS A.`bra_id`, A.`name`, A.`status`, A.`created`, A.`updated`
                FROM   jp_brand A INNER JOIN jp_brandmeta B ON A.bra_id = B.bra_id
                WHERE B.`meta_key` = 'imgName'
                ORDER BY  A.`bra_id` desc
                LIMIT 0, 10
               */