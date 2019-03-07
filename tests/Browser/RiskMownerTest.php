<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskMownerTest extends DuskTestCase
{

    public function testCreateRiskMowner()
    {
        $admin = \App\User::find(1);
        $risk_mowner = factory('App\RiskMowner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_mowner) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_mowners.index'))
                ->clickLink('Add new')
                ->select("member_id", $risk_mowner->member_id)
                ->select("risk_id", $risk_mowner->risk_id)
                ->press('Save')
                ->assertRouteIs('admin.risk_mowners.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $risk_mowner->member->name)
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_mowner->risk->code)
                ->logout();
        });
    }

    public function testEditRiskMowner()
    {
        $admin = \App\User::find(1);
        $risk_mowner = factory('App\RiskMowner')->create();
        $risk_mowner2 = factory('App\RiskMowner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_mowner, $risk_mowner2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_mowners.index'))
                ->click('tr[data-entry-id="' . $risk_mowner->id . '"] .btn-info')
                ->select("member_id", $risk_mowner2->member_id)
                ->select("risk_id", $risk_mowner2->risk_id)
                ->press('Update')
                ->assertRouteIs('admin.risk_mowners.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $risk_mowner2->member->name)
                ->assertSeeIn("tr:last-child td[field-key='risk']", $risk_mowner2->risk->code)
                ->logout();
        });
    }

    public function testShowRiskMowner()
    {
        $admin = \App\User::find(1);
        $risk_mowner = factory('App\RiskMowner')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_mowner) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_mowners.index'))
                ->click('tr[data-entry-id="' . $risk_mowner->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='member']", $risk_mowner->member->name)
                ->assertSeeIn("td[field-key='risk']", $risk_mowner->risk->code)
                ->logout();
        });
    }

}
