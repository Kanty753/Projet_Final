<?php
include_once('connect.php');

function savefile($fichier)
{
    $uploadDir = __DIR__ . '/../uploads/';
    $maxSize = 100 * 1024 * 1024; // 100 Mo
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf', 'video/mp4'];
    
    $newName = null; // <-- initialisation
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($fichier)) {
        $file = $fichier;
        if ($file['error'] !== UPLOAD_ERR_OK) {
            die('Erreur lors de l’upload : ' . $file['error']);
        }
        if ($file['size'] > $maxSize) {
            die('Le fichier est trop volumineux.');
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mime, $allowedMimeTypes)) {
            die('Type de fichier non autorisé : ' . $mime);
        }
        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = $originalName . '_' . uniqid() . '.' . $extension;
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
            // succès, on retourne le nouveau nom
            return $newName;
        } else {
            die("Échec du déplacement du fichier.");
        }
    } else {
        die("Aucun fichier reçu.");
    }
    
   
}

function getMembrebyEmail($email)
{
    $requete = sprintf("SELECT  * FROM membre WHERE email=%d", $email);
    $resultat = mysqli_query(dbconnect(), $requete);
    $membre = array();
    while ($donnees = mysqli_fetch_assoc($resultat)) {
        $membre['id'] = $donnees['id'];
        $membre['email'] = $donnees['email'];
        $membre['mdp'] = $donnees['mdp'];
    }
    return $membre;
}
function isMembre($email)
{
    $sql = "select * from Membre where email='$email'";
    $req = mysqli_query(dbconnect(), $sql);
    $result = mysqli_fetch_assoc($req);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
function getallvideo()
{
    $sql = "select * from vue_video_membre ";
    $return[] = array();
    $resultat = mysqli_query(dbconnect(), $sql);
    while ($donnees = mysqli_fetch_assoc($resultat)) {
        $return[] = array(
            'link' => $donnees['link'],
            'description' => $donnees['description'],
            'date' => $donnees['date'],
            'membre_id' => $donnees['membre_id'],
            'video_id' => $donnees['video_id'],
            'pseudo' => $donnees['pseudo'],
            'membre_id' => $donnees['membre_id']
        );
    }
    return $return ; 
}



function Like($video_id, $membre_id)
{
    $conn = dbconnect(); 

    
    $video_id = intval($video_id);
    $membre_id = intval($membre_id);

    
    $verif_sql = "SELECT * FROM like_video WHERE video_id = $video_id AND membre_id = $membre_id";
    $verif_result = mysqli_query($conn, $verif_sql);

    if (mysqli_num_rows($verif_result) > 0) {
       
        $delete_sql = "DELETE FROM like_video WHERE video_id = $video_id AND membre_id = $membre_id";
        if (mysqli_query($conn, $delete_sql)) {
            return "vofafa";
        } 
    } else {
       
        $insert_sql = "INSERT INTO like_video (video_id, membre_id) VALUES ($video_id, $membre_id)";
        if (mysqli_query($conn, $insert_sql)) {
            return "vo like";
        } 
    }
}
function addcomment($txt, $idmembre, $idpublication, $bdd)
{
    $requete = sprintf("INSERT INTO Commentaire (DateHeureCommentaire,TexteCommentaire,idMembre,idPublication) VALUES (NOW(), '%s',%d,%d)", $txt, $idmembre, $idpublication);
    $resultat = mysqli_query($bdd, $requete);
}

function getallcomment($video_id, $bdd)
{
    $video_id = intval($video_id); 
    $requete = "SELECT * FROM Commentaire WHERE video_id = $video_id";
    $resultat = mysqli_query($bdd, $requete);

    $publication = array();
    while ($donnees = mysqli_fetch_assoc($resultat)) {
        $publication[] = array(
            'video_id' => $donnees['video_id'],
            'DateHeureCommentaire' => $donnees['DateHeureCommentaire'] ?? '', 
            'TexteCommentaire' => $donnees['Comment'], 
            'idMembre' => $donnees['membre_id'],
            'idCommentaire' => $donnees['id']
        );
    }
    return $publication;
}

function getobjet() {
    $bdd=dbconnect();
    $sql = "SELECT objet.id_objet, objet.nom_objet, categorie_objet.nom_categorie, membre.nom AS nom_membre
            FROM objet
            JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie
            JOIN membre ON objet.id_membre = membre.id_membre";
    $result = mysqli_query($bdd, $sql);
    $objets = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }
    return $objets;
}

function filtreparcateg($bdd, $id_categorie = 0) {
    $objets = array();
    if ($id_categorie > 0) {
        $sql = "SELECT objet.id_objet, objet.nom_objet, categorie_objet.nom_categorie, membre.nom AS nom_membre
                FROM objet
                JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie
                JOIN membre ON objet.id_membre = membre.id_membre
                WHERE objet.id_categorie = " . intval($id_categorie);
    } else {
        $sql = "SELECT objet.id_objet, objet.nom_objet, categorie_objet.nom_categorie, membre.nom AS nom_membre
                FROM objet
                JOIN categorie_objet ON objet.id_categorie = categorie_objet.id_categorie
                JOIN membre ON objet.id_membre = membre.id_membre";
    }
    $result = mysqli_query($bdd, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }
    return $objets;
}

?>