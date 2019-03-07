<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliverablePartnerTest extends DuskTestCase
{

    public function testCreateDeliverablePartner()
    {
        $admin = \App\User::find(1);
        $deliverable_partner = factory('App\DeliverablePartner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_partner) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_partners.index'))
                ->clickLink('Add new')
                ->select("partner_id", $deliverable_partner->partner_id)
                ->select("deliverable_id", $deliverable_partner->deliverable_id)
                ->press('Save')
                ->assertRouteIs('admin.deliverable_partners.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $deliverable_partner->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_partner->deliverable->label_identification)
                ->logout();
        });
    }

    public function testEditDeliverablePartner()
    {
        $admin = \App\User::find(1);
        $deliverable_partner = factory('App\DeliverablePartner')->create();
        $deliverable_partner2 = factory('App\DeliverablePartner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_partner, $deliverable_partner2) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_partners.index'))
                ->click('tr[data-entry-id="' . $deliverable_partner->id . '"] .btn-info')
                ->select("partner_id", $deliverable_partner2->partner_id)
                ->select("deliverable_id", $deliverable_partner2->deliverable_id)
                ->press('Update')
                ->assertRouteIs('admin.deliverable_partners.index')
                ->assertSeeIn("tr:last-child td[field-key='partner']", $deliverable_partner2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_partner2->deliverable->label_identification)
                ->logout();
        });
    }

    public function testShowDeliverablePartner()
    {
        $admin = \App\User::find(1);
        $deliverable_partner = factory('App\DeliverablePartner')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $deliverable_partner) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_partners.index'))
                ->click('tr[data-entry-id="' . $deliverable_partner->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='partner']", $deliverable_partner->partner->name)
                ->assertSeeIn("td[field-key='deliverable']", $deliverable_partner->deliverable->label_identification)
                ->logout();
        });
    }

}
