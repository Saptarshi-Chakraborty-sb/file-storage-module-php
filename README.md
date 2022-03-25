# File Storage Module in PHP

This php module will help you to **organize** and store your file in your **local folder** . Organize your storage folder by **year**/**month**/**day** , like WordPress. Use it when your project is receiving files on a regular basis. [Download the File](https://minhaskamal.github.io/DownGit/#/home?url=https://github.com/Saptarshi-Chakraborty-sb/file-storage-module-php/blob/master/storageModule.php)

## Table of Content

1. [How to Use](#how-to-use)
2. [Parameters](#parameters)
3. [Return values](#returns)
4. [Example](#a-quick-example)

---

## How to Use

- [Download](https://minhaskamal.github.io/DownGit/#/home?url=https://github.com/Saptarshi-Chakraborty-sb/file-storage-module-php/blob/master/storageModule.php) and add the `storageModule.php` file in your php project.
- now just call the function `fileStorageModule(filepath, storageFolder, moreDivision, uniqueFilename)` , in your code, and pass the arguments.
- On Success it returns an [associative array](https://www.w3schools.com/php/php_arrays_associative.asp) of which the key , `['value']` will be the new filepath.
- This function will create some subfolder is `year/month/date` format in your given _Storage Folder_ and save your file.
- It will use the default time of your system. You can change your _default timezone_ with `date_default_timezone_set(timezone:string)` function.
- If you want more division in folder structure , you can pass **TRUE** in the 3rd parameter _moreDivision_ . It will create subfolders with alphabet name in your each _day_ folder and go deep one more layer. _Default Value : FALSE_
- If you want to change your filenames and make unique, pass **TRUE** in the 4th parameter _uniqueFilename_ . It will make yor filename unique

## Parameters:

**fileStorageModule(`filepath` , `storage_folder`, `more_division` , `unique_filename`)**

| Parameter       | Requirements | Description                                                                                   |
| :-------------- | :----------: | :-------------------------------------------------------------------------------------------- |
| filepath        |  `required`  | **(string)** The path of the file you want to store.                                          |
| storage_folder  |  `required`  | **(string)** The folder in which you want to store your file ; Default = current folder       |
| more_division   |  `optional`  | **(bool)** TRUE = If you have much much files and want more divided storage ; default = FALSE |
| unique_filename |  `optional`  | **(bool)** TRUE = If you want to change your files to a unique filename ; default = FALSE     |

## Returns:

This function returns an associative array which has two key : [ _status_ , _value_ ]

- `status` : **(int)** | The status code of result. (0 = Success)
- `value` : **(string)** | The detailed message or newFilepath (on success)

| Status | Value                               | Meaning                                                               |
| :----: | :---------------------------------- | :-------------------------------------------------------------------- |
|   0    | (path/of/file)                      | On Success - The New path of file will be in _value_ key of the array |
|   1    | Storage Folder Not Found            | If the given folder to store files is Unavailable                     |
|   2    | Folder Access Denied                | If the program was unable to access the given Storage Folder          |
|   3    | File Not found                      | If the given File is Unavailable in that path                         |
|   4    | Failed to Move File                 | If the program fails to move the file in New location                 |
|   5    | File already exists in new location | If the file already exists in the new location                        |

---

## A quick Example:

```php
    <?php
        require "storageModule.php";

        $file = "abc.txt";
        $storageFolder = "storage";

        $arr = fileStorageModule($file, $storageFolder, true);

        if ($arr['status'] == 0)
            echo "File Move Successfully at [ {$arr['value']} ]";
        else
            echo "result : " . $arr['value'];
    ?>
```
