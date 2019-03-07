<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MemberroleTest extends DuskTestCase
{

    public function testCreateMemberrole()
    {
        $admin = \App\User::find(1);
        $memberrole = factory('App\Memberrole')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $memberrole) {
            $browser->loginAs($admin)
                ->visit(route('admin.memberroles.index'))
                ->clickLink('Add new')
                ->select("member_id", $memberrole->member_id)
                ->type("role", $memberrole->role)
                ->select("project_id", $memberrole->project_id)
                ->select("partner_id", $memberrole->partner_id)
                ->press('Save')
                ->assertRouteIs('admin.memberroles.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $memberrole->member->name)
                ->assertSeeIn("tr:last-child td[field-key='role']", $memberrole->role)
                ->assertSeeIn("tr:last-child td[field-key='project']", $memberrole->project->name)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $memberrole->partner->name)
                ->logout();
        });
    }

    public function testEditMemberrole()
    {
        $admin = \App\User::find(1);
        $memberrole = factory('App\Memberrole')->create();
        $memberrole2 = factory('App\Memberrole')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $memberrole, $memberrole2) {
            $browser->loginAs($admin)
                ->visit(route('admin.memberroles.index'))
                ->click('tr[data-entry-id="' . $memberrole->id . '"] .btn-info')
                ->select("member_id", $memberrole2->member_id)
                ->type("role", $memberrole2->role)
                ->select("project_id", $memberrole2->project_id)
                ->select("partner_id", $memberrole2->partner_id)
                ->press('Update')
                ->assertRouteIs('admin.memberroles.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $memberrole2->member->name)
                ->assertSeeIn("tr:last-child td[field-key='role']", $memberrole2->role)
                ->assertSeeIn("tr:last-child td[field-key='project']", $memberrole2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $memberrole2->partner->name)
                ->logout();
        });
    }

    public function testShowMemberrole()
    {
        $admin = \App\User::find(1);
        $memberrole = factory('App\Memberrole')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $memberrole) {
            $browser->loginAs($admin)
                ->visit(route('admin.memberroles.index'))
                ->click('tr[data-entry-id="' . $memberrole->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='member']", $memberrole->member->name)
                ->assertSeeIn("td[field-key='role']", $memberrole->role)
                ->assertSeeIn("td[field-key='project']", $memberrole->project->name)
                ->assertSeeIn("td[field-key='partner']", $memberrole->partner->name)
                ->logout();
        });
    }

}
