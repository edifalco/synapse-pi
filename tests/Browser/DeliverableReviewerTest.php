<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliverableReviewerTest extends DuskTestCase
{

    public function testCreateDeliverableReviewer()
    {
        $admin = \App\User::find(1);
        $deliverable_reviewer = factory('App\DeliverableReviewer')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_reviewer) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_reviewers.index'))
                ->clickLink('Add new')
                ->select("deliverable_id", $deliverable_reviewer->deliverable_id)
                ->select("member_id", $deliverable_reviewer->member_id)
                ->press('Save')
                ->assertRouteIs('admin.deliverable_reviewers.index')
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_reviewer->deliverable->label_identification)
                ->assertSeeIn("tr:last-child td[field-key='member']", $deliverable_reviewer->member->name)
                ->logout();
        });
    }

    public function testEditDeliverableReviewer()
    {
        $admin = \App\User::find(1);
        $deliverable_reviewer = factory('App\DeliverableReviewer')->create();
        $deliverable_reviewer2 = factory('App\DeliverableReviewer')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_reviewer, $deliverable_reviewer2) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_reviewers.index'))
                ->click('tr[data-entry-id="' . $deliverable_reviewer->id . '"] .btn-info')
                ->select("deliverable_id", $deliverable_reviewer2->deliverable_id)
                ->select("member_id", $deliverable_reviewer2->member_id)
                ->press('Update')
                ->assertRouteIs('admin.deliverable_reviewers.index')
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_reviewer2->deliverable->label_identification)
                ->assertSeeIn("tr:last-child td[field-key='member']", $deliverable_reviewer2->member->name)
                ->logout();
        });
    }

    public function testShowDeliverableReviewer()
    {
        $admin = \App\User::find(1);
        $deliverable_reviewer = factory('App\DeliverableReviewer')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $deliverable_reviewer) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_reviewers.index'))
                ->click('tr[data-entry-id="' . $deliverable_reviewer->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='deliverable']", $deliverable_reviewer->deliverable->label_identification)
                ->assertSeeIn("td[field-key='member']", $deliverable_reviewer->member->name)
                ->logout();
        });
    }

}
