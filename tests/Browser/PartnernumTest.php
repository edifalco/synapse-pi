<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PartnernumTest extends DuskTestCase
{

    public function testCreatePartnernum()
    {
        $admin = \App\User::find(1);
        $partnernum = factory('App\Partnernum')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $partnernum) {
            $browser->loginAs($admin)
                ->visit(route('admin.partnernums.index'))
                ->clickLink('Add new')
                ->type("value", $partnernum->value)
                ->select("partner_id", $partnernum->partner_id)
                ->select("project_id", $partnernum->project_id)
                ->press('Save')
                ->assertRouteIs('admin.partnernums.index')
                ->assertSeeIn("tr:last-child td[field-key='value']", $partnernum->value)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $partnernum->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='project']", $partnernum->project->name)
                ->logout();
        });
    }

    public function testEditPartnernum()
    {
        $admin = \App\User::find(1);
        $partnernum = factory('App\Partnernum')->create();
        $partnernum2 = factory('App\Partnernum')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $partnernum, $partnernum2) {
            $browser->loginAs($admin)
                ->visit(route('admin.partnernums.index'))
                ->click('tr[data-entry-id="' . $partnernum->id . '"] .btn-info')
                ->type("value", $partnernum2->value)
                ->select("partner_id", $partnernum2->partner_id)
                ->select("project_id", $partnernum2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.partnernums.index')
                ->assertSeeIn("tr:last-child td[field-key='value']", $partnernum2->value)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $partnernum2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='project']", $partnernum2->project->name)
                ->logout();
        });
    }

    public function testShowPartnernum()
    {
        $admin = \App\User::find(1);
        $partnernum = factory('App\Partnernum')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $partnernum) {
            $browser->loginAs($admin)
                ->visit(route('admin.partnernums.index'))
                ->click('tr[data-entry-id="' . $partnernum->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='value']", $partnernum->value)
                ->assertSeeIn("td[field-key='partner']", $partnernum->partner->name)
                ->assertSeeIn("td[field-key='project']", $partnernum->project->name)
                ->logout();
        });
    }

}
