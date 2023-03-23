<?php
function loadXmlFile($file)
{

    $xml = simplexml_load_file($file);

    return $xml;
}
function findProfileById($xml, $id)
{
    if($profiles = loadXmlFile($xml))
    {
        foreach ($profiles as $profile)
        {
            if($profile->id == $id)
            {
                return $profile;
            }
        }
    }

    return false;
}
?>