<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ThresholdRiskTest extends DuskTestCase
{

    public function testCreateThresholdRisk()
    {
        $admin = \App\User::find(1);
        $threshold_risk = factory('App\ThresholdRisk')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $threshold_risk) {
            $browser->loginAs($admin)
                ->visit(route('admin.threshold_risks.index'))
                ->clickLink('Add new')
                ->type("value", $threshold_risk->value)
                ->select("project_id", $threshold_risk->project_id)
                ->press('Save')
                ->assertRouteIs('admin.threshold_risks.index')
                ->assertSeeIn("tr:last-child td[field-key='value']", $threshold_risk->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $threshold_risk->project->name)
                ->logout();
        });
    }

    public function testEditThresholdRisk()
    {
        $admin = \App\User::find(1);
        $threshold_risk = factory('App\ThresholdRisk')->create();
        $threshold_risk2 = factory('App\ThresholdRisk')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $threshold_risk, $threshold_risk2) {
            $browser->loginAs($admin)
                ->visit(route('admin.threshold_risks.index'))
                ->click('tr[data-entry-id="' . $threshold_risk->id . '"] .btn-info')
                ->type("value", $threshold_risk2->value)
                ->select("project_id", $threshold_risk2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.threshold_risks.index')
                ->assertSeeIn("tr:last-child td[field-key='value']", $threshold_risk2->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $threshold_risk2->project->name)
                ->logout();
        });
    }

    public function testShowThresholdRisk()
    {
        $admin = \App\User::find(1);
        $threshold_risk = factory('App\ThresholdRisk')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $threshold_risk) {
            $browser->loginAs($admin)
                ->visit(route('admin.threshold_risks.index'))
                ->click('tr[data-entry-id="' . $threshold_risk->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='value']", $threshold_risk->value)
                ->assertSeeIn("td[field-key='project']", $threshold_risk->project->name)
                ->logout();
        });
    }

}
