<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskMreporterTest extends DuskTestCase
{

    public function testCreateRiskMreporter()
    {
        $admin = \App\User::find(1);
        $risk_mreporter = factory('App\RiskMreporter')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_mreporter) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_mreporters.index'))
                ->clickLink('Add new')
                ->select("member_id", $risk_mreporter->member_id)
                ->select("risk_id", $risk_mreporter->risk_id)
                ->press('Save')
                ->assertRouteIs('admin.risk_mreporters.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $risk_mreporter->member->name)
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_mreporter->risk->code)
                ->logout();
        });
    }

    public function testEditRiskMreporter()
    {
        $admin = \App\User::find(1);
        $risk_mreporter = factory('App\RiskMreporter')->create();
        $risk_mreporter2 = factory('App\RiskMreporter')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_mreporter, $risk_mreporter2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_mreporters.index'))
                ->click('tr[data-entry-id="' . $risk_mreporter->id . '"] .btn-info')
                ->select("member_id", $risk_mreporter2->member_id)
                ->select("risk_id", $risk_mreporter2->risk_id)
                ->press('Update')
                ->assertRouteIs('admin.risk_mreporters.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $risk_mreporter2->member->name)
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_mreporter2->risk->code)
                ->logout();
        });
    }

    public function testShowRiskMreporter()
    {
        $admin = \App\User::find(1);
        $risk_mreporter = factory('App\RiskMreporter')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_mreporter) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_mreporters.index'))
                ->click('tr[data-entry-id="' . $risk_mreporter->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='member']", $risk_mreporter->member->name)
                ->assertSeeIn("td[field-key='risk']", $risk_mreporter->risk->code)
                ->logout();
        });
    }

}
