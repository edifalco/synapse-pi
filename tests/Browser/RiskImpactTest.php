<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskImpactTest extends DuskTestCase
{

    public function testCreateRiskImpact()
    {
        $admin = \App\User::find(1);
        $risk_impact = factory('App\RiskImpact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_impact) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_impacts.index'))
                ->clickLink('Add new')
                ->type("name", $risk_impact->name)
                ->press('Save')
                ->assertRouteIs('admin.risk_impacts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $risk_impact->name)
                ->logout();
        });
    }

    public function testEditRiskImpact()
    {
        $admin = \App\User::find(1);
        $risk_impact = factory('App\RiskImpact')->create();
        $risk_impact2 = factory('App\RiskImpact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_impact, $risk_impact2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_impacts.index'))
                ->click('tr[data-entry-id="' . $risk_impact->id . '"] .btn-info')
                ->type("name", $risk_impact2->name)
                ->press('Update')
                ->assertRouteIs('admin.risk_impacts.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $risk_impact2->name)
                ->logout();
        });
    }

    public function testShowRiskImpact()
    {
        $admin = \App\User::find(1);
        $risk_impact = factory('App\RiskImpact')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_impact) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_impacts.index'))
                ->click('tr[data-entry-id="' . $risk_impact->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $risk_impact->name)
                ->logout();
        });
    }

}
