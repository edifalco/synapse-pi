<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MemberPartnerTest extends DuskTestCase
{

    public function testCreateMemberPartner()
    {
        $admin = \App\User::find(1);
        $member_partner = factory('App\MemberPartner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $member_partner) {
            $browser->loginAs($admin)
                ->visit(route('admin.member_partners.index'))
                ->clickLink('Add new')
                ->select("member_id", $member_partner->member_id)
                ->select("partner_id", $member_partner->partner_id)
                ->press('Save')
                ->assertRouteIs('admin.member_partners.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $member_partner->member->name)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $member_partner->partner->name)
                ->logout();
        });
    }

    public function testEditMemberPartner()
    {
        $admin = \App\User::find(1);
        $member_partner = factory('App\MemberPartner')->create();
        $member_partner2 = factory('App\MemberPartner')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $member_partner, $member_partner2) {
            $browser->loginAs($admin)
                ->visit(route('admin.member_partners.index'))
                ->click('tr[data-entry-id="' . $member_partner->id . '"] .btn-info')
                ->select("member_id", $member_partner2->member_id)
                ->select("partner_id", $member_partner2->partner_id)
                ->press('Update')
                ->assertRouteIs('admin.member_partners.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $member_partner2->member->name)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $member_partner2->partner->name)
                ->logout();
        });
    }

    public function testShowMemberPartner()
    {
        $admin = \App\User::find(1);
        $member_partner = factory('App\MemberPartner')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $member_partner) {
            $browser->loginAs($admin)
                ->visit(route('admin.member_partners.index'))
                ->click('tr[data-entry-id="' . $member_partner->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='member']", $member_partner->member->name)
                ->assertSeeIn("td[field-key='partner']", $member_partner->partner->name)
                ->logout();
        });
    }

}
