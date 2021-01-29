<?php
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

class Photo extends Eloquent {

	//presenter
	use \Laracasts\Presenter\PresentableTrait;
	protected $presenter = 'App\AppCore\Miscellaneous\Presenters\PhotoPresenter';

	public $timestamps = false;

	//protected $fillable = [];
	protected $guarded = [];

}