<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskProximityTest extends DuskTestCase
{

    public function testCreateRiskProximity()
    {
        $admin = \App\User::find(1);
        $risk_proximity = factory('App\RiskProximity')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_proximity) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_proximities.index'))
                ->clickLink('Add new')
                ->type("name", $risk_proximity->name)
                ->press('Save')
                ->assertRouteIs('admin.risk_proximities.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $risk_proximity->name)
                ->logout();
        });
    }

    public function testEditRiskProximity()
    {
        $admin = \App\User::find(1);
        $risk_proximity = factory('App\RiskProximity')->create();
        $risk_proximity2 = factory('App\RiskProximity')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_proximity, $risk_proximity2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_proximities.index'))
                ->click('tr[data-entry-id="' . $risk_proximity->id . '"] .btn-info')
                ->type("name", $risk_proximity2->name)
                ->press('Update')
                ->assertRouteIs('admin.risk_proximities.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $risk_proximity2->name)
                ->logout();
        });
    }

    public function testShowRiskProximity()
    {
        $admin = \App\User::find(1);
        $risk_proximity = factory('App\RiskProximity')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_proximity) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_proximities.index'))
                ->click('tr[data-entry-id="' . $risk_proximity->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $risk_proximity->name)
                ->logout();
        });
    }

}
