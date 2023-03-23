<html>
    <?php
    include_once 'parser.php';
    $profileId = $_GET['id'];
    echo $profileId; 
    if(!$profileId)
    {
        die('No id specified');
    }
    $profile = findProfileById('./xml/LV2.xml', $profileId);

    echo 
    '<article style="display:flex; flex-flow: column wrap; align-items: center; row-gap:1rem;"> <img src="' . $profile->slika . '" style="object-fit:contain;"/>
    <span>' . $profile->ime . ' ' . $profile->prezime . '</span>
    <span>' . $profile->email . '</span>
    <span>' . $profile->spol . '</span>
    <span>' . $profile->zivotopis . '</span> </article>';
    ?>
</html>