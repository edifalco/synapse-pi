<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AcronymTest extends DuskTestCase
{

    public function testCreateAcronym()
    {
        $admin = \App\User::find(1);
        $acronym = factory('App\Acronym')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $acronym) {
            $browser->loginAs($admin)
                ->visit(route('admin.acronyms.index'))
                ->clickLink('Add new')
                ->type("acronym", $acronym->acronym)
                ->select("partner_id", $acronym->partner_id)
                ->press('Save')
                ->assertRouteIs('admin.acronyms.index')
                ->assertSeeIn("tr:last-child td[field-key='acronym']", $acronym->acronym)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $acronym->partner->name)
                ->logout();
        });
    }

    public function testEditAcronym()
    {
        $admin = \App\User::find(1);
        $acronym = factory('App\Acronym')->create();
        $acronym2 = factory('App\Acronym')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $acronym, $acronym2) {
            $browser->loginAs($admin)
                ->visit(route('admin.acronyms.index'))
                ->click('tr[data-entry-id="' . $acronym->id . '"] .btn-info')
                ->type("acronym", $acronym2->acronym)
                ->select("partner_id", $acronym2->partner_id)
                ->press('Update')
                ->assertRouteIs('admin.acronyms.index')
                ->assertSeeIn("tr:last-child td[field-key='acronym']", $acronym2->acronym)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $acronym2->partner->name)
                ->logout();
        });
    }

    public function testShowAcronym()
    {
        $admin = \App\User::find(1);
        $acronym = factory('App\Acronym')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $acronym) {
            $browser->loginAs($admin)
                ->visit(route('admin.acronyms.index'))
                ->click('tr[data-entry-id="' . $acronym->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='acronym']", $acronym->acronym)
                ->assertSeeIn("td[field-key='partner']", $acronym->partner->name)
                ->logout();
        });
    }

}
