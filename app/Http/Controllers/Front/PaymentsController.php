<?php

namespace App\Http\Controllers\Front;
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

use App\AppCore\Front\MembershipPlans\Repostitories\MembershipPlanRepository;
use App\Http\Controllers\Controller;
use App\AppCore\Front\Payments\Repositories\OrderCacheRepository;
use App\AppCore\Front\Payments\Jobs\BypassPayment;
use Auth;


class PaymentsController extends Controller
{

    //proceeds to payment for listing plan
    public function proceedToListingPlanPayment($listingId, $forId, $for, OrderCacheRepository $orderCacheRepository)
    {
        //places temporary order data
        $orderInfo = $orderCacheRepository->placeOrder(Auth::id(), $for, $forId, $listingId);

        //if it's a free listing plan or payment bypass mode is turned on
        if (appCon()->bypassPayment()
            OR ! $orderInfo->orderFor->price)
        {
            $this->dispatchNow(new BypassPayment($orderInfo));

            switch ($for) {
                case 'listingPlan':
                    flash()->success(trans('front.flash_listing_plan_updated'));
                    break;
                case 'listingFeat':
                    flash()->success(trans('front.flash_listing_featured'));
                    break;
                case 'listingHigh':
                    flash()->success(trans('front.flash_listing_highlighted'));
                    break;
            }
            
            session()->flash('payment_for', $for);
            return redirect()->route('userlistings.edit', $listingId);
        }

        return view('front.process-payment.listing-plan', [
            'orderFor' => $orderInfo->orderFor,
            'invoice' => $orderInfo->invoice_no,
            'for' => $for
        ]);
    }


    //proceeds to payment for membership plan
    public function proceedToMembershipPayment($membershipPlanId, OrderCacheRepository $orderCacheRepository, MembershipPlanRepository $membershipPlanRepository)
    {
        $membershipPlan = $membershipPlanRepository->getById($membershipPlanId);

        //places temporary order data
        $orderInfo = $orderCacheRepository->placeOrder(Auth::id(), 'membershipPlan', $membershipPlanId);

        //if it's a free listing plan or payment bypass mode is turned on
        if (appCon()->bypassPayment() OR
            ! $membershipPlan->price)
        {
            $this->dispatchNow(new BypassPayment($orderInfo));

            flash()->success(trans('front.flash_membership_updated'));
            return redirect()->route('membershipplans.manage');
        }

        return view('front.process-payment.membership-plan', [
            'membershipPlan' => $membershipPlan,
            'invoice' => $orderInfo->invoice_no
        ]);
    }

}
