<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MemberTest extends DuskTestCase
{

    public function testCreateMember()
    {
        $admin = \App\User::find(1);
        $member = factory('App\Member')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $member) {
            $browser->loginAs($admin)
                ->visit(route('admin.members.index'))
                ->clickLink('Add new')
                ->type("name", $member->name)
                ->type("surname", $member->surname)
                ->select("partner_id", $member->partner_id)
                ->type("email", $member->email)
                ->type("phone", $member->phone)
                ->type("notes", $member->notes)
                ->press('Save')
                ->assertRouteIs('admin.members.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $member->name)
                ->assertSeeIn("tr:last-child td[field-key='surname']", $member->surname)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $member->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $member->email)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $member->phone)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $member->notes)
                ->logout();
        });
    }

    public function testEditMember()
    {
        $admin = \App\User::find(1);
        $member = factory('App\Member')->create();
        $member2 = factory('App\Member')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $member, $member2) {
            $browser->loginAs($admin)
                ->visit(route('admin.members.index'))
                ->click('tr[data-entry-id="' . $member->id . '"] .btn-info')
                ->type("name", $member2->name)
                ->type("surname", $member2->surname)
                ->select("partner_id", $member2->partner_id)
                ->type("email", $member2->email)
                ->type("phone", $member2->phone)
                ->type("notes", $member2->notes)
                ->press('Update')
                ->assertRouteIs('admin.members.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $member2->name)
                ->assertSeeIn("tr:last-child td[field-key='surname']", $member2->surname)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $member2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $member2->email)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $member2->phone)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $member2->notes)
                ->logout();
        });
    }

    public function testShowMember()
    {
        $admin = \App\User::find(1);
        $member = factory('App\Member')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $member) {
            $browser->loginAs($admin)
                ->visit(route('admin.members.index'))
                ->click('tr[data-entry-id="' . $member->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $member->name)
                ->assertSeeIn("td[field-key='surname']", $member->surname)
                ->assertSeeIn("td[field-key='partner']", $member->partner->name)
                ->assertSeeIn("td[field-key='email']", $member->email)
                ->assertSeeIn("td[field-key='phone']", $member->phone)
                ->assertSeeIn("td[field-key='notes']", $member->notes)
                ->logout();
        });
    }

}
