<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ThresholdDeliverableTest extends DuskTestCase
{

    public function testCreateThresholdDeliverable()
    {
        $admin = \App\User::find(1);
        $threshold_deliverable = factory('App\ThresholdDeliverable')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $threshold_deliverable) {
            $browser->loginAs($admin)
                ->visit(route('admin.threshold_deliverables.index'))
                ->clickLink('Add new')
                ->type("value", $threshold_deliverable->value)
                ->select("project_id", $threshold_deliverable->project_id)
                ->press('Save')
                ->assertRouteIs('admin.threshold_deliverables.index')
                ->assertSeeIn("tr:last-child td[field-key='value']", $threshold_deliverable->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $threshold_deliverable->project->name)
                ->logout();
        });
    }

    public function testEditThresholdDeliverable()
    {
        $admin = \App\User::find(1);
        $threshold_deliverable = factory('App\ThresholdDeliverable')->create();
        $threshold_deliverable2 = factory('App\ThresholdDeliverable')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $threshold_deliverable, $threshold_deliverable2) {
            $browser->loginAs($admin)
                ->visit(route('admin.threshold_deliverables.index'))
                ->click('tr[data-entry-id="' . $threshold_deliverable->id . '"] .btn-info')
                ->type("value", $threshold_deliverable2->value)
                ->select("project_id", $threshold_deliverable2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.threshold_deliverables.index')
                ->assertSeeIn("tr:last-child td[field-key='value']", $threshold_deliverable2->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $threshold_deliverable2->project->name)
                ->logout();
        });
    }

    public function testShowThresholdDeliverable()
    {
        $admin = \App\User::find(1);
        $threshold_deliverable = factory('App\ThresholdDeliverable')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $threshold_deliverable) {
            $browser->loginAs($admin)
                ->visit(route('admin.threshold_deliverables.index'))
                ->click('tr[data-entry-id="' . $threshold_deliverable->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='value']", $threshold_deliverable->value)
                ->assertSeeIn("td[field-key='project']", $threshold_deliverable->project->name)
                ->logout();
        });
    }

}
