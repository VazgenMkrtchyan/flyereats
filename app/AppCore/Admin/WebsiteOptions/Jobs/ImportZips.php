<?php namespace App\AppCore\Admin\WebsiteOptions\Jobs;
/**
 *
 * This file is part of the software provided by AppsWWW <http://www.appswww.com>
 *
 * Reproduce, re-sell, distribute, sublicense, disclose, market,
 * rent, lease or transfer the Licensed Software is not permitted
 * by this Agreement
 *
 *
 * For full copyright and license information, please visit
 * http://www.appswww.com/license-agreement/
 *
 * @copyright (c) Laimonas Prei (l.preisas@gmail.com)
 */

use App\AppCore\Miscellaneous\Abstractions\Job;

use DB, File, ZipArchive;

class ImportZips extends Job
{
	public $zipsFile, $truncateZips;

	
	public function __construct($zipsFile, $truncateZips)
	{
		$this->zipsFile = $zipsFile;
		$this->truncateZips = $truncateZips;
	}


	public function handle()
	{
		//
		$uploaded = $this->zipsFile;

		//checks if uploaded file is zip archive
		if ($uploaded->getClientOriginalExtension() == "zip")
		{
			$uploaded->move('uploads/tmp_files', 'zip_import.zip');
			//extracts Zip Archive Contents
			$zipAr = new ZipArchive;
			$zipOpen = $zipAr->open(public_path('uploads/tmp_files/zip_import.zip'));
			$sqlFileName = '';
			if ($zipOpen === TRUE) {
				$zipAr->extractTo(public_path('uploads/tmp_files/'));
				//gets extracted file name
				$sqlFileName = $zipAr->getNameIndex(0);
				$zipAr->close();
			}
		}
		else
		{
			$sqlFileName = 'zips.sql';
			$uploaded->move('uploads/tmp_files', $sqlFileName);
		}

		//full path + file name
		$sqlFile = public_path('uploads/tmp_files/' . $sqlFileName);
		$contents = explode("INSERT INTO `zip_codes` (`zip_code`, `lat`, `lng`) VALUES", file_get_contents($sqlFile));

		//clears table before upload
		if ($this->truncateZips)
		{
			DB::statement("TRUNCATE `zip_codes`;");
		}

		for ($i = 1; $i < count($contents); $i++) {
			//uploads file to database
			DB::statement("INSERT INTO `zip_codes` (`zip_code`, `lat`, `lng`) VALUES $contents[$i]");
		}

		//deletes temporary files
		File::cleanDirectory(public_path('uploads/tmp_files/'));
	}

}