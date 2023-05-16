<?php
$dir = './'; // Cesta k požadované složce (v tomto případě aktuální složka)

// Funkce pro získání seznamu souborů a složek
function getDirectoryListing($dir)
{
    $listing = scandir($dir); // Seznam souborů a složek ve složce

    // Oddělení složek a souborů
    $folders = [];
    $files = [];
    foreach ($listing as $item) {
        if ($item != '.' && $item != '..') {
            $path = $dir . '/' . $item;
            if (is_dir($path)) {
                $folders[] = $item;
            } else {
                $files[] = $item;
            }
        }
    }

    // Seřazení složek a souborů podle názvu
    natcasesort($folders);
    natcasesort($files);

    echo '<ul>';

    // Odkaz na předchozí složku
    $parentFolder = dirname($dir);
    echo '<li><img src="folder-icon.png" height="16" alt="Folder Icon" class="icon"><a href="directory_listing.php?folder=' . urlencode($parentFolder) . '">..</a></li>';

    // Výpis složek s ikonou
    foreach ($folders as $folder) {
        $path = $dir . '/' . $folder;
        echo '<li><img src="folder-icon.png" height="16" alt="Folder Icon" class="icon"><a href="directory_listing.php?folder=' . urlencode($path) . '">' . $folder . '</a></li>';
    }

    // Výpis souborů
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        echo '<li><img src="file-icon.png" height="16" alt="File Icon" class="icon"><a href="' . $path . '">' . $file . '</a></li>';
    }

    echo '</ul>';
}

// Pokud je předán parametr folder v URL, zobrazí obsah dané složky
if (isset($_GET['folder'])) {
    $folder = $_GET['folder'];
    getDirectoryListing($folder);
} else {
    getDirectoryListing($dir);
}
