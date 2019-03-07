<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskPownerTest extends DuskTestCase
{

    public function testCreateRiskPowner()
    {
        $admin = \App\User::find(1);
        $risk_powner = factory('App\RiskPowner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_powner) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_powners.index'))
                ->clickLink('Add new')
                ->select("partner_id", $risk_powner->partner_id)
                ->select("risk_id", $risk_powner->risk_id)
                ->press('Save')
                ->assertRouteIs('admin.risk_powners.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $risk_powner->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_powner->risk->code)
                ->logout();
        });
    }

    public function testEditRiskPowner()
    {
        $admin = \App\User::find(1);
        $risk_powner = factory('App\RiskPowner')->create();
        $risk_powner2 = factory('App\RiskPowner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_powner, $risk_powner2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_powners.index'))
                ->click('tr[data-entry-id="' . $risk_powner->id . '"] .btn-info')
                ->select("partner_id", $risk_powner2->partner_id)
                ->select("risk_id", $risk_powner2->risk_id)
                ->press('Update')
                ->assertRouteIs('admin.risk_powners.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $risk_powner2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_powner2->risk->code)
                ->logout();
        });
    }

    public function testShowRiskPowner()
    {
        $admin = \App\User::find(1);
        $risk_powner = factory('App\RiskPowner')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_powner) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_powners.index'))
                ->click('tr[data-entry-id="' . $risk_powner->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='partner']", $risk_powner->partner->name)
                ->assertSeeIn("td[field-key='risk']", $risk_powner->risk->code)
                ->logout();
        });
    }

}
