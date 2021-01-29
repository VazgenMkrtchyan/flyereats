<?php namespace App\AppCore\Miscellaneous\Presenters;
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

use Laracasts\Presenter\Presenter;

class CompProfilePresenter extends Presenter {

    //profile description
    public function compDesc()
    {
        $description = $this->description;
        $length_limit = 200; //symbols count

        if (strlen($description) > $length_limit)
        {
            return [
                'text' => substr($description, 0, $length_limit),
                'read_more' => '<span class="read_more_text" style="display: none">'. ' ' .substr($description, $length_limit) . '</span><span class="read_more_dots">...</span><br><span class="read_more">'.trans('front.read_more').'</span>'
            ];
        }
        return [
            'text' => $description,
            'read_more' => ''
        ];
    }

}