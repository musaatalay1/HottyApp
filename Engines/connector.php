<?php



    class Connection

    {

        

        public $Connection;



        private $prepare;


        private $prepared;


        public $query_count=0;



        private $assistant=NULL;

        private $assistant_string_permission=FALSE;

        private $assistant_count_permission=FALSE;

        public $assistant_err=FALSE;

        public $assistant_error=NULL;



        function __construct()

        {

            

            if( func_num_args() == 1 )

            {



                return $this->Connection( func_get_arg( 0 ) );



            }

            

            if( func_num_args() == 3 )

            {

                

                return $this->Connection( func_get_arg( 0 ), func_get_arg( 1 ), func_get_arg( 2 ) );



            }



        }



        function Assistant( $name )

        {

            

            if( !empty( $GLOBALS[$name] ) && is_object( $GLOBALS[$name] ) && get_class( $GLOBALS[$name] ) == "Assistant" )

            {

                

                $this->assistant = $name;

                

            }else{

                

                 $this->assistant_err = TRUE;



                 $this->assistant_error = "Asistan tanımlaması olarak 'Assistant Nesnesi'`ne ait ismi atayabilirsiniz => ".get_class($GLOBALS[$name]);



            }



        }



        function SetAssistant( $assistant_count_permission = NULL, $assistant_string_permission = NULL  )

        {

            

            if( !empty( $GLOBALS[$this->assistant] ) && is_object( $GLOBALS[$this->assistant] ) && get_class( $GLOBALS[$this->assistant] ) == "Assistant" )

            {



                if( $assistant_count_permission != NULL )

                {

                

                    if( is_bool( $assistant_count_permission ) )

                    {



                        $this->assistant_count_permission = $assistant_count_permission;



                    }else{

                        

                        $this->assistant_err = TRUE;



                        $this->assistant_error = "Asistan yetki olarak yalnızca mantıksal değer atanmalıdır -> TRUE yada FALSE";



                    }



                }



                if( $assistant_string_permission != NULL )

                {

                    if( is_bool( $assistant_string_permission ) )

                    {

                        

                        $this->assistant_string_permission = $assistant_string_permission;



                    }else{

                        

                        $this->assistant_err = TRUE;



                        $this->assistant_error = "Asistan yetki olarak yalnızca mantıksal değer atanmalıdır -> TRUE yada FALSE";



                    }



                }



            }else{

                

                $this->assistant_err = TRUE;



                $this->assistant_error = "Bağlantı Asistanı Tanımlanmamış";



            }



        }



        function Connection( $ConnectionString, $clientName = " ", $clientPassword = " " )

        {



                $databaseTypes = array( "mysql" => "MySQL", "mssql" => "MsSQL", "msaccess" => "MsAccess" );



                if( $clientName == " " || $clientPassword == " " )

                {

                

                    preg_match( '/(.*):dbname=(.*);host=(.*);user=(.*);pass=(.*)/', $ConnectionString, $parseDB_Host );



                    $clientName = $parseDB_Host[4];



                    $clientPassword = $parseDB_Host[5];



                }else{

                

                    preg_match( '/(.*):dbname=(.*);host=(.*)/', $ConnectionString, $parseDB_Host );



                }



                $this->$databaseTypes[$parseDB_Host[1]]( $parseDB_Host[1].":dbname=".$parseDB_Host[2].";host=".$parseDB_Host[3], $clientName, $clientPassword );



        }



        function MySQL( $ConnectionString, $clientName, $clientPassword )

        {



            preg_match( '/mysql:dbname=(.*);host=(.*)/', $ConnectionString, $parseDB_Host );



            $this->Connection = mysql_connect( $parseDB_Host[2], $clientName, $clientPassword )or die("Hata:Veritabanı sunucusuna bağlanılamadı!");



            $this->Database( "mysql:".$parseDB_Host[1], $this->Connection );



        }



        function Database( $database, $link )

        {

            

            preg_match( '/(.*):(.*)/', $database, $dbName );



            if( $dbName[1] == "mysql" )

            {



                mysql_select_db( $dbName[2], $link ) or die("Hata:Veritabanı seçilemedi!");



            }



        }



        function Query()

        {



            /*

                

                *** Kullanılışı ***

                

                #prepare("SQL QUERY VALUES = ?");



                #Query( array( VALUES ) ) veya Query( SQL QUERY VALUES = ?, array( VALUES ) );



            */



            $query = func_get_args();



            if( count( $query ) >= 2 || is_array( $query[0] ) )

            {

                

                if( !is_array( $query[0] ) && is_array( $query[1] ) )

                {

                    

                    $return = $query[0];



                    for( $i = 0; $i < count( $query[1] ); $i++ )

                    {



                        $uzaklik = strpos( $return, "?" );



                        $return = substr_replace( $return, mysql_real_escape_string($query[1][$i]), $uzaklik, 1 );

                        

                    }



                }



                if( !is_array( $query[0] ) && !is_array( $query[1] ) )

                {

                    

                    $return = $this->prepare;



                    for( $i = 0; $i < count( $query ); $i++ )

                    {



                        $uzaklik = strpos( $return, "?" );



                        $return = substr_replace( $return, mysql_real_escape_string($query[$i]), $uzaklik, 1 );

                        

                    }



                }



                if( count( $query ) == 1 && is_array( $query[0] ) )

                {

                    

                    $return = $this->prepare;



                    for( $i = 0; $i < count( $query ); $i++ )

                    {



                        for( $x = 0; $x < count( $query[$i] ); $x++ )

                        {

                            

                            $uzaklik = strpos( $return, "?" );



                            $return = substr_replace( $return, mysql_real_escape_string($query[$i][$x]), $uzaklik, 1 );



                        }

                        

                    }



                }



            }else{

                

                $return = $query[0];



            }



            #echo $return."<br />";



            #$this->query_count++;

            if( !empty( $GLOBALS[$this->assistant] ) && is_object( $GLOBALS[$this->assistant] ) && get_class( $GLOBALS[$this->assistant] ) == "Assistant" )

            {



                if( $this->assistant_string_permission ==TRUE ){}



                if( $this->assistant_count_permission ==TRUE ){$GLOBALS[$this->assistant]->_setQueryCount(1);}



            }



            return mysql_query( $return );



        }


        function Q(){

            if(func_num_args()==1){

                $this->prepared = $this->Query(func_get_arg(0));

            }

            if(func_num_args()==2){

                $this->prepared = $this->Query(func_get_arg(0),func_get_arg(1));
                
            }

            return $this;

        }

        function fetch_obj(){

            return mysql_fetch_object($this->prepared);

        }

        function prepare( $query )

        {



            return $this->prepare = $query;



        }







        function makeQuery( $Query )

        {

            

            $search = array( "select", "update", "delete", "insert", "into", "from", "where", "values", "and", "or", "set", "sum", "count" );



            $replace = array( "SELECT", "UPDATE", "DELETE", "INSERT", "INTO", "FROM", "WHERE", "VALUES", "AND", "OR", "SET", "SUM", "COUNT" );



            return str_replace( $search, $replace, $Query );



        }



        function SetNames( $charset )

        {

            

            mysql_query("SET NAMES '".$charset."'", $this->Connection );



            return $this;



        }



        function SetCharacter( $charset )

        {

            

            mysql_query( "SET CHARACTER SET ".$charset, $this->Connection );



            return $this;



        }



        function SetCollation( $charset )

        {

            

            mysql_query("SET COLLATION_CONNECTION = '".$charset."'", $this->Connection ); 



            return $this;



        }



        function utf8()

        {

            

            mysql_query("SET NAMES 'utf8'");

            mysql_query("SET CHARACTER SET utf8");

            mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");



            return $this;



        }



        function charset( $charset )

        {

            

            mysql_query("SET NAMES '".$charset."'", $this->Connection );

            mysql_query( "SET CHARACTER SET ".$charset, $this->Connection );

            mysql_query("SET COLLATION_CONNECTION = '".$charset."'", $this->Connection ); 



            return $this;



        }



    }    



    /*



    ### ÖRNEK KULLANIMLAR



    $baglanti = new Connection;



    //$baglanti = new Connection("mysql:dbname=medyacom_test;host=localhost;user=medyacom_tekmau;pass=Tb{JLn?SnzI=");



    $baglanti->MySQL("mysql:dbname=medyacom_test;host=localhost","medyacom_tekmau","Tb{JLn?SnzI=");



    //$baglanti->Connection("mysql:dbname=medyacom_test;host=localhost","medyacom_tekmau","Tb{JLn?SnzI=");



    //$baglanti->Connection("mysql:dbname=medyacom_test;host=localhost;user=medyacom_tekmau;pass=Tb{JLn?SnzI=");



    $baglanti->SetNames( "utf8" );



    $baglanti->SetCharacter( "utf8" );



    $baglanti->SetCollation( "utf8_general_ci" );



    //$baglanti->utf8();



    //baglanti->charset("utf8");



    $query1 = $baglanti->Query( "SELECT * FROM personel" );



    $query2_preparing = $baglanti->prepare("SELECT *,COUNT(*) AS SAYI FROM tekmasiparis WHERE sdurum = '?' AND (onaytarih BETWEEN '?' AND '?') GROUP BY onayid ORDER BY SAYI");



    $query2 = $baglanti->Query(array("AB","AC","AD"));

    

    while( $data =  mysql_fetch_object( $query1 ) )

    {

        

        echo $data->isim." <br /> ";



    }

    

    */



?>