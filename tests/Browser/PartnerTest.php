<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PartnerTest extends DuskTestCase
{

    public function testCreatePartner()
    {
        $admin = \App\User::find(1);
        $partner = factory('App\Partner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $partner) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners.index'))
                ->clickLink('Add new')
                ->type("name", $partner->name)
                ->type("acronym", $partner->acronym)
                ->type("image", $partner->image)
                ->select("country_id", $partner->country_id)
                ->press('Save')
                ->assertRouteIs('admin.partners.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $partner->name)
                ->assertSeeIn("tr:last-child td[field-key='acronym']", $partner->acronym)
                ->assertSeeIn("tr:last-child td[field-key='image']", $partner->image)
                ->assertSeeIn("tr:last-child td[field-key='country']", $partner->country->title)
                ->logout();
        });
    }

    public function testEditPartner()
    {
        $admin = \App\User::find(1);
        $partner = factory('App\Partner')->create();
        $partner2 = factory('App\Partner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $partner, $partner2) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners.index'))
                ->click('tr[data-entry-id="' . $partner->id . '"] .btn-info')
                ->type("name", $partner2->name)
                ->type("acronym", $partner2->acronym)
                ->type("image", $partner2->image)
                ->select("country_id", $partner2->country_id)
                ->press('Update')
                ->assertRouteIs('admin.partners.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $partner2->name)
                ->assertSeeIn("tr:last-child td[field-key='acronym']", $partner2->acronym)
                ->assertSeeIn("tr:last-child td[field-key='image']", $partner2->image)
                ->assertSeeIn("tr:last-child td[field-key='country']", $partner2->country->title)
                ->logout();
        });
    }

    public function testShowPartner()
    {
        $admin = \App\User::find(1);
        $partner = factory('App\Partner')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $partner) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners.index'))
                ->click('tr[data-entry-id="' . $partner->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $partner->name)
                ->assertSeeIn("td[field-key='acronym']", $partner->acronym)
                ->assertSeeIn("td[field-key='image']", $partner->image)
                ->assertSeeIn("td[field-key='country']", $partner->country->title)
                ->logout();
        });
    }

}
