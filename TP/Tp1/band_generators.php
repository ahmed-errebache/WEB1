<?php


/**
 * Generate random bandname
 */
function generate_bandname(){
    $list1 = array(
        "", "Weed","Speed","Smoke", "Shred", "Spit", "Carnal", "Riff", "Rock", 
        "Eletric", "Black", "Saint", "The", "Acid", "Kink","Bong", "The Church of", 
        "Flame", "Sacred", "Lord", "Burning", "Red", "Sapphire", "Night", "Cannabis", 
        "Doom", "Lizard", "Dope", "Worship", "Sludge", "Heavy", "Lady", "Toxic", "Bad", 
        "Monster", "Suck", "Leather", "Warrior", "Snow", "Orange", "Banshee", "Devil", 
        "The Dark", "Smoking", "Funeral", "Vapor", "Toke", "Goat", "Unholy", "Eternal", 
        "Spirit", "Stoner", "Pot", "Blood", "Intersteller", "Sacrificial", "Fuzz", "Tone");

    $list2 = array(
        " King"," Queen"," Lizard", "lord"," Jesus", " Fire", " Wizard", " Destroy", 
        "s", " Ripper", " Sluts", "", " Flame", " Witch", " Sabbath", " Stalker", 
        " Acid", " Burn Out", "opolis", " Warden", " Fettish", " Kink", " Pills", 
        " Sky", " Ash", " Sadist", " Masochist", " Preist", " Sacrafice", " Slayer", 
        " Crown", " Bitch", " Thunder", " Masculinity", " Patriarch", " Strike", 
        " Powder", " City", " Sayer", " Seer", " Mask", " Warrior", " Theif", 
        " Cult", " Occult", " Goblin", " Spit", "killer", " Pyre", " Thunder", 
        " Gas", " Fog", " Blaze", " Sacrafice", " Master", " Sucker", " Whip", 
        "zilla", " Sweat", " Eater", " Magnet", " Sword", " Axe", " Caravan", " Fang", 
        " Void", " Misery", " Stoner", " Junkie", " Marijuana", " Breather", "ess", " Tone", 
        " Ritual", " Weed", " Preistess");

    $name = $list1[array_rand($list1, 1)]."".$list2[array_rand($list2, 1)];
    return $name;
}

/**
 * Generate random logo 
 */
function generate_bandlogo(){
    // TP1: choisir un logo aléatoire dans gift/logos et renvoyer son chemin
    $dirAbs = __DIR__ . '/logos';
    $dirRel = 'logos';

    // récupérer uniquement les fichiers images (jpg/jpeg/png/gif)
    $files = [];
    if (is_dir($dirAbs)) {
        foreach (scandir($dirAbs) as $f) {
            // ignorer les entrées spéciales et dossiers
            if ($f[0] === '.') continue;
            // filtrer par extension
            if (preg_match('/\.(jpe?g|png|gif)$/i', $f)) {
                $files[] = $f;
            }
        }
    }

    // valeur de repli si aucun fichier trouvé
    if (empty($files)) {
        return $dirRel . '/logo01.jpg';
    }

    // choisir un fichier au hasard
    $pick = $files[array_rand($files)];
    return $dirRel . '/' . $pick;
}

?>