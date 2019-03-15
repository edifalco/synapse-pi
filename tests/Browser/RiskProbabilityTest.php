<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskProbabilityTest extends DuskTestCase
{

    public function testCreateRiskProbability()
    {
        $admin = \App\User::find(1);
        $risk_probability = factory('App\RiskProbability')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_probability) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_probabilities.index'))
                ->clickLink('Add new')
                ->type("name", $risk_probability->name)
                ->press('Save')
                ->assertRouteIs('admin.risk_probabilities.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $risk_probability->name)
                ->logout();
        });
    }

    public function testEditRiskProbability()
    {
        $admin = \App\User::find(1);
        $risk_probability = factory('App\RiskProbability')->create();
        $risk_probability2 = factory('App\RiskProbability')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_probability, $risk_probability2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_probabilities.index'))
                ->click('tr[data-entry-id="' . $risk_probability->id . '"] .btn-info')
                ->type("name", $risk_probability2->name)
                ->press('Update')
                ->assertRouteIs('admin.risk_probabilities.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $risk_probability2->name)
                ->logout();
        });
    }

    public function testShowRiskProbability()
    {
        $admin = \App\User::find(1);
        $risk_probability = factory('App\RiskProbability')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_probability) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_probabilities.index'))
                ->click('tr[data-entry-id="' . $risk_probability->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $risk_probability->name)
                ->logout();
        });
    }

}
