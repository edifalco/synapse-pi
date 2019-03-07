<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliverableMemberTest extends DuskTestCase
{

    public function testCreateDeliverableMember()
    {
        $admin = \App\User::find(1);
        $deliverable_member = factory('App\DeliverableMember')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_member) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_members.index'))
                ->clickLink('Add new')
                ->select("member_id", $deliverable_member->member_id)
                ->select("deliverable_id", $deliverable_member->deliverable_id)
                ->press('Save')
                ->assertRouteIs('admin.deliverable_members.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $deliverable_member->member->name)
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_member->deliverable->label_identification)
                ->logout();
        });
    }

    public function testEditDeliverableMember()
    {
        $admin = \App\User::find(1);
        $deliverable_member = factory('App\DeliverableMember')->create();
        $deliverable_member2 = factory('App\DeliverableMember')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable_member, $deliverable_member2) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_members.index'))
                ->click('tr[data-entry-id="' . $deliverable_member->id . '"] .btn-info')
                ->select("member_id", $deliverable_member2->member_id)
                ->select("deliverable_id", $deliverable_member2->deliverable_id)
                ->press('Update')
                ->assertRouteIs('admin.deliverable_members.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $deliverable_member2->member->name)
                ->assertSeeIn("tr:last-child td[field-key='deliverable']", $deliverable_member2->deliverable->label_identification)
                ->logout();
        });
    }

    public function testShowDeliverableMember()
    {
        $admin = \App\User::find(1);
        $deliverable_member = factory('App\DeliverableMember')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $deliverable_member) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverable_members.index'))
                ->click('tr[data-entry-id="' . $deliverable_member->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='member']", $deliverable_member->member->name)
                ->assertSeeIn("td[field-key='deliverable']", $deliverable_member->deliverable->label_identification)
                ->logout();
        });
    }

}
