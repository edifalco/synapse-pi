<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliverableStatusTest extends DuskTestCase
{

    public function testCreateDeliverableStatus()
    {
        $admin = \App\User::find(1);
        $deliverable_status = factory('App\DeliverableStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_statuses.index'))
                ->clickLink('Add new')
                ->type("label", $deliverable_status->label)
                ->press('Save')
                ->assertRouteIs('admin.deliverable_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='label']", $deliverable_status->label)
                ->logout();
        });
    }

    public function testEditDeliverableStatus()
    {
        $admin = \App\User::find(1);
        $deliverable_status = factory('App\DeliverableStatus')->create();
        $deliverable_status2 = factory('App\DeliverableStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_status, $deliverable_status2) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_statuses.index'))
                ->click('tr[data-entry-id="' . $deliverable_status->id . '"] .btn-info')
                ->type("label", $deliverable_status2->label)
                ->press('Update')
                ->assertRouteIs('admin.deliverable_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='label']", $deliverable_status2->label)
                ->logout();
        });
    }

    public function testShowDeliverableStatus()
    {
        $admin = \App\User::find(1);
        $deliverable_status = factory('App\DeliverableStatus')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $deliverable_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_statuses.index'))
                ->click('tr[data-entry-id="' . $deliverable_status->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='label']", $deliverable_status->label)
                ->logout();
        });
    }

}
