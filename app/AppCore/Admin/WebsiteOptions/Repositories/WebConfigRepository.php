<?php namespace App\AppCore\Admin\WebsiteOptions\Repositories;
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

use App\AppCore\Miscellaneous\Abstractions\EloquentRepository;
use Webconfig;

class WebConfigRepository extends EloquentRepository {

	protected $model;

	function __construct(Webconfig $model)
	{
		$this->model = $model;
	}


	public function uploadLogo($fileName)
	{
		$this->update('1', ['logo' => $fileName]);
	}


	public function deleteLogo()
	{
		$this->update('1', ['logo' => null]);
	}


	public function currentLogo()
	{
		return $this->getFirst()->logo;
	}

} 