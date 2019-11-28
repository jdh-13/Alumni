<?php
namespace App\Service\Helpers;

class FileSystemHelper
{
	public function write(string $path, string $content)
	{
		$folders = substr($path, 0, strrpos($path, '/'));
		//vérifie si il y a un dossier sinon le crée
		$this ->checkAndCreateFolders($folders);

		$file = fopen($path, 'w');
		fwrite($file, $content);
		fclose($file);
			// dump($content); exit;
	}

	public function checkAndCreateFolders(string $path)
	{
		if(!is_dir($path)){
			mkdir($path, 755, true);
		}
	}
}










