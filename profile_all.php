<html>
<body>
<div>
    <p>Profiles</p>
    <ul>
        <?php
        include_once 'parser.php';

        $xmlFilePath = './xml/LV2.xml';
        $profiles = loadXmlFile($xmlFilePath);

        if (!$profiles) {
            echo '<li>No profiles found.</li>';
        }

        foreach ($profiles as $profile) {
            $profileLink = 'profile_show.php?id=' . $profile->id;
            $profileName = $profile->ime . ' ' . $profile->prezime;

            echo '<li>
                    <a href="' . $profileLink . '">
                        <span>' . $profileName . '</span>
                    </a>
                  </li>';
        }
        ?>
    </ul>
</div>
</body>
</html>