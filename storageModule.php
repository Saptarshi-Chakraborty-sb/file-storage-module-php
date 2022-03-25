<?php
if (!defined('STORAGE_MODULE')) {
    define("STORAGE_MODULE", true);

    /**  Custom Storage Module   */
    // @Returns - Associative array [status (int), value(string)] : 0 = Success ; 1 = Storage Folder not found ; 2 = folder access denied ; 3 = file not found ; 4 = failed to move file ; 5 = File already exists in new path

    function fileStorageModule(string $filepath, string $storageFolder = "/", bool $moreDividedStorage = false, bool $uniqueFilename = false)
    {
        if (!is_dir($storageFolder))
            return ['status' => 1, 'value' => 'Storage Folder Not Found'];

        $year = date("Y");
        $month = strtolower(date("F"));
        $day = date("d");
        $hour = (int)date("G");
        $hourArr = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x"];
        $currentStoragePath = $storageFolder . "/" . $year . "/" . $month . "/" . $day;  // path to save file

        if ($moreDividedStorage == true)
            $currentStoragePath .= "/" . $hourArr[$hour];

        if (!is_dir($currentStoragePath)) {
            if (!mkdir($currentStoragePath, 0777, true))
                return ['status' => 2, 'value' => 'Folder Access Denied'];
        }

        $oldFilePath = $filepath;
        // extract the filename only from file path
        if ($uniqueFilename == true)
            $fileName = $hourArr[$hour] . "" . uniqid();
        else
            $fileName = basename($oldFilePath);
        $newFilePath = $currentStoragePath . "/" . $fileName;

        if (!is_file($oldFilePath))
            return ['status' => 3, 'value' => 'File Not found'];

        if (is_file($newFilePath))
            return ['status' => 5, 'value' => 'File already exists in new location'];

        if (rename($oldFilePath, $newFilePath))  // move the file
            return ['status' => 0, 'value' => $newFilePath];
        else
            return ['status' => 4, 'value' => 'Failed to Move File'];
    }
}
