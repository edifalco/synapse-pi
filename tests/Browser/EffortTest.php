<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class EffortTest extends DuskTestCase
{

    public function testCreateEffort()
    {
        $admin = \App\User::find(1);
        $effort = factory('App\Effort')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $effort) {
            $browser->loginAs($admin)
                ->visit(route('admin.efforts.index'))
                ->clickLink('Add new')
                ->select("project_id", $effort->project_id)
                ->select("workpackage_id", $effort->workpackage_id)
                ->select("partner_id", $effort->partner_id)
                ->type("value", $effort->value)
                ->type("period", $effort->period)
                ->press('Save')
                ->assertRouteIs('admin.efforts.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $effort->project->name)
                ->assertSeeIn("tr:last-child td[field-key='workpackage']", $effort->workpackage->wp_id)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $effort->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $effort->value)
                ->assertSeeIn("tr:last-child td[field-key='period']", $effort->period)
                ->logout();
        });
    }

    public function testEditEffort()
    {
        $admin = \App\User::find(1);
        $effort = factory('App\Effort')->create();
        $effort2 = factory('App\Effort')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $effort, $effort2) {
            $browser->loginAs($admin)
                ->visit(route('admin.efforts.index'))
                ->click('tr[data-entry-id="' . $effort->id . '"] .btn-info')
                ->select("project_id", $effort2->project_id)
                ->select("workpackage_id", $effort2->workpackage_id)
                ->select("partner_id", $effort2->partner_id)
                ->type("value", $effort2->value)
                ->type("period", $effort2->period)
                ->press('Update')
                ->assertRouteIs('admin.efforts.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $effort2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='workpackage']", $effort2->workpackage->wp_id)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $effort2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $effort2->value)
                ->assertSeeIn("tr:last-child td[field-key='period']", $effort2->period)
                ->logout();
        });
    }

    public function testShowEffort()
    {
        $admin = \App\User::find(1);
        $effort = factory('App\Effort')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $effort) {
            $browser->loginAs($admin)
                ->visit(route('admin.efforts.index'))
                ->click('tr[data-entry-id="' . $effort->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project']", $effort->project->name)
                ->assertSeeIn("td[field-key='workpackage']", $effort->workpackage->wp_id)
                ->assertSeeIn("td[field-key='partner']", $effort->partner->name)
                ->assertSeeIn("td[field-key='value']", $effort->value)
                ->assertSeeIn("td[field-key='period']", $effort->period)
                ->logout();
        });
    }

}
