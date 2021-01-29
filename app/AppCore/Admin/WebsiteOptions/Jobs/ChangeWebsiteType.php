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

use App\AppCore\Admin\Mailers\Jobs\WebsiteTypeChangeNotification;
use App\AppCore\Miscellaneous\Abstractions\Job;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Webconfig, ListingPlan, MembershipPlan, UserGroup, User, DB;

class ChangeWebsiteType extends Job
{
    use DispatchesJobs;
    public $input;

    public function __construct($input)
    {
        $this->input = $input;
    }


    public function handle()
    {

        //loops through existing user groups and changes membership plans, listing plans and statuses
        foreach (UserGroup::all() as $userGroup) {

            //if website is currently listing plans based
            if (appCon()->listingPlansBased()) {

                $membershipPlan = MembershipPlan::find($this->input['membership_plan_for_' . $userGroup->id]);

                if ($membershipPlan) {

                    //if new membership plan is assigned
                    User::where('user_group_id', $userGroup->id)
                        ->update([
                            'membership_plan_id' => $membershipPlan->id,
                            'expires_on' => ($days = $membershipPlan->duration) ? Carbon::now()->addDays($days) : null,
                        ]);

                    //if no membership plan is assigned
                } else {

                    User::where('user_group_id', $userGroup->id)
                        ->update([
                            'membership_plan_id' => null,
                            'expires_on' => null
                        ]);
                }

                //basic update
                    $this->buildListingsQuery($userGroup->id)->update([
                        'listing_plan_id' => null,
                        'st_archived' => true,
                        'listings.expires_on' => null,
                    ]);


            } //if website is currently membership plans based
            else {

                $listingPlan = ListingPlan::find($this->input['listing_plan_for_' . $userGroup->id]);

                //if new listing plan is assigned
                if ($listingPlan) {

                    $this->buildListingsQuery($userGroup->id)->update([
                        'listing_plan_id' => $listingPlan->id,
                        'st_archived' => true,
                        'listings.expires_on' => ($days = $listingPlan->duration) ? Carbon::now()->addDays($days) : null,
                    ]);
                    //if no listing plan is assigned
                } else {

                    $this->buildListingsQuery($userGroup->id)->update([
                        'listing_plan_id' => null,
                        'st_archived' => true,
                        'listings.expires_on' => null,
                    ]);
                }

                //basic update
                User::where('user_group_id', $userGroup->id)
                    ->update([
                        'membership_plan_id' => null,
                        'expires_on' => null,
                    ]);
            }


            //EMAIL SENDING
            if (isset($this->input['notify_user_group_' . $userGroup->id])) {
                foreach ($userGroup->users as $user) {
                    $this->dispatchNow(new WebsiteTypeChangeNotification($user));
                }
            }
        }

        //updates website type
        Webconfig::first()->update([
            'web_type' => appCon()->listingPlansBased() ? 'membership_plans' : 'listing_plans'
        ]);
    }

    //extracted function
    protected function buildListingsQuery($userGroupId)
    {
        return DB::table('listings')->leftJoin('users', 'listings.user_id', '=', 'users.id')->where('users.user_group_id', $userGroupId);
    }

}