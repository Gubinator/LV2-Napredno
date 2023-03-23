<?php 
/* Skripta prima podatke iz baze podataka i sprema ih u txt datoteku
koja se nakon toga sažima pomoću biblioteke zlib */
 
//Naziv baze podataka
$db_name = 'lv2_database';

//Direktorij za backup
$dir = "backup/$db_name";

//Ako direktorij ne postoji stvori ga 
if (!is_dir($dir)) {
    if (!@mkdir($dir)) {
        die("<p>Ne možemo stvoriti direktorij $dir.</p></body></html>");
    }
}

//Trenutno vrijeme
$time = time();

//Spoj na bazu podataka
$dbc = @mysqli_connect('localhost', 'root', '', $db_name) OR die("<p>Ne možemo se spojiti na bazu $db_name.</p></body></html>");

//Pokaži sve tablice iz baze podataka
$r = mysqli_query($dbc, 'SHOW TABLES');

//Radimo backup ako postoji barem jedna tablica
if (mysqli_num_rows($r) > 0) {

    //Poruka da se radi backup
    echo "<p>Backup za bazu podataka '$db_name'.</p>";
    
    //Dohvati ime svake tablice
    while (list($table) = mysqli_fetch_array($r, MYSQLI_NUM)) {
    
        //Dohvati podatke iz tablice
        $query = "SELECT * FROM $table";
        $r2 = mysqli_query($dbc, $query);

        $columnQuery = "DESCRIBE $table";
        $columnResult = mysqli_query($dbc, $columnQuery);
        
        //Ako postoje podaci
        if (mysqli_num_rows($r2) > 0) {

            //Otvori datoteku
            if ($fp = gzopen ("$dir/{$table}_{$time}.sql.gz", 'w9')) {
                

                $columns = array();

                while($row = mysqli_fetch_array($columnResult)){
                    $columns[] = $row['Field'];
                }
                //print_r(count($columns));
                //Dohvat podataka iz tablice
                while ($row = mysqli_fetch_array($r2, MYSQLI_NUM)) {
                    $insertQuery = "INSERT INTO {$table} (";

                    for($i=0; $i<count($columns); $i++){
                        if($i==count($columns)-1){
                            $insertQuery.="$columns[$i]) ";
                        } else{
                            $insertQuery.="$columns[$i],";
                        }
                    }
                    
                    $insertQuery .= "VALUES (";  

                    for($i=0; $i<count($row); $i++){
                        if($i==count($row)-1){
                            $insertQuery.="'$row[$i]');";
                        } else{
                            $insertQuery.="'$row[$i]',";
                        }
                    }
                    gzwrite ($fp, $insertQuery);
                    //Novi redak za svaki redak iz baze 
                    gzwrite ($fp, "\n"); 

                } //Kraj while petlje

                //Zatvori datoteku
                gzclose ($fp); 
            
                //Ispiši da je backup uspješno izvršen
                echo "<p>Tablica '$table' je pohranjena.</p>";

            } else { //Ne možemo stvoriti datoteku
                echo "<p>Datoteka $dir/{$table}_{$time}.sql.gz se ne može otvoriti.</p>";
                break; //Prekini while petlju
            } // Kraj gzopen() 

        } //Kraj mysqli_num_rows() 
        
    } //Kraj while petlje

} else {
    echo "<p>Baza $db_name ne sadrži tablice.</p>";
}

?>
