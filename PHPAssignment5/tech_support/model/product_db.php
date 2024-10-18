<?php
function add_product($code, $name, $version, $release_date) {
    global $db;
    $query = 'INSERT INTO products 
                 (productCode, name, version, releaseDate)
              VALUES 
                 (:code, :name, :version, :release_date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->execute();
    $statement->closeCursor();
}
?>