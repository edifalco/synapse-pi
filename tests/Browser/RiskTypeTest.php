<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RiskTypeTest extends DuskTestCase
{

    public function testCreateRiskType()
    {
        $admin = \App\User::find(1);
        $risk_type = factory('App\RiskType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_types.index'))
                ->clickLink('Add new')
                ->type("name", $risk_type->name)
                ->press('Save')
                ->assertRouteIs('admin.risk_types.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $risk_type->name)
                ->logout();
        });
    }

    public function testEditRiskType()
    {
        $admin = \App\User::find(1);
        $risk_type = factory('App\RiskType')->create();
        $risk_type2 = factory('App\RiskType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $risk_type, $risk_type2) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_types.index'))
                ->click('tr[data-entry-id="' . $risk_type->id . '"] .btn-info')
                ->type("name", $risk_type2->name)
                ->press('Update')
                ->assertRouteIs('admin.risk_types.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $risk_type2->name)
                ->logout();
        });
    }

    public function testShowRiskType()
    {
        $admin = \App\User::find(1);
        $risk_type = factory('App\RiskType')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $risk_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.risk_types.index'))
                ->click('tr[data-entry-id="' . $risk_type->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $risk_type->name)
                ->logout();
        });
    }

}
