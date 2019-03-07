<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliverableWorkpackageTest extends DuskTestCase
{

    public function testCreateDeliverableWorkpackage()
    {
        $admin = \App\User::find(1);
        $deliverable_workpackage = factory('App\DeliverableWorkpackage')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_workpackage) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_workpackages.index'))
                ->clickLink('Add new')
                ->select("deliverable_id", $deliverable_workpackage->deliverable_id)
                ->select("workpackage_id", $deliverable_workpackage->workpackage_id)
                ->press('Save')
                ->assertRouteIs('admin.deliverable_workpackages.index')
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_workpackage->deliverable->label_identification)
                ->assertSeeIn("tr:last-child td[field-key='workpackage']", $deliverable_workpackage->workpackage->wp_id)
                ->logout();
        });
    }

    public function testEditDeliverableWorkpackage()
    {
        $admin = \App\User::find(1);
        $deliverable_workpackage = factory('App\DeliverableWorkpackage')->create();
        $deliverable_workpackage2 = factory('App\DeliverableWorkpackage')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_workpackage, $deliverable_workpackage2) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_workpackages.index'))
                ->click('tr[data-entry-id="' . $deliverable_workpackage->id . '"] .btn-info')
                ->select("deliverable_id", $deliverable_workpackage2->deliverable_id)
                ->select("workpackage_id", $deliverable_workpackage2->workpackage_id)
                ->press('Update')
                ->assertRouteIs('admin.deliverable_workpackages.index')
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_workpackage2->deliverable->label_identification)
                ->assertSeeIn("tr:last-child td[field-key='workpackage']", $deliverable_workpackage2->workpackage->wp_id)
                ->logout();
        });
    }

    public function testShowDeliverableWorkpackage()
    {
        $admin = \App\User::find(1);
        $deliverable_workpackage = factory('App\DeliverableWorkpackage')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $deliverable_workpackage) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_workpackages.index'))
                ->click('tr[data-entry-id="' . $deliverable_workpackage->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='deliverable']", $deliverable_workpackage->deliverable->label_identification)
                ->assertSeeIn("td[field-key='workpackage']", $deliverable_workpackage->workpackage->wp_id)
                ->logout();
        });
    }

}
