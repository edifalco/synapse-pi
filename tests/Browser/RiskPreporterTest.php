<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskPreporterTest extends DuskTestCase
{

    public function testCreateRiskPreporter()
    {
        $admin = \App\User::find(1);
        $risk_preporter = factory('App\RiskPreporter')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_preporter) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_preporters.index'))
                ->clickLink('Add new')
                ->select("partner_id", $risk_preporter->partner_id)
                ->select("risk_id", $risk_preporter->risk_id)
                ->press('Save')
                ->assertRouteIs('admin.risk_preporters.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $risk_preporter->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_preporter->risk->code)
                ->logout();
        });
    }

    public function testEditRiskPreporter()
    {
        $admin = \App\User::find(1);
        $risk_preporter = factory('App\RiskPreporter')->create();
        $risk_preporter2 = factory('App\RiskPreporter')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_preporter, $risk_preporter2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_preporters.index'))
                ->click('tr[data-entry-id="' . $risk_preporter->id . '"] .btn-info')
                ->select("partner_id", $risk_preporter2->partner_id)
                ->select("risk_id", $risk_preporter2->risk_id)
                ->press('Update')
                ->assertRouteIs('admin.risk_preporters.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $risk_preporter2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_preporter2->risk->code)
                ->logout();
        });
    }

    public function testShowRiskPreporter()
    {
        $admin = \App\User::find(1);
        $risk_preporter = factory('App\RiskPreporter')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_preporter) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_preporters.index'))
                ->click('tr[data-entry-id="' . $risk_preporter->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='partner']", $risk_preporter->partner->name)
                ->assertSeeIn("td[field-key='risk']", $risk_preporter->risk->code)
                ->logout();
        });
    }

}
