<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProjectMemberTest extends DuskTestCase
{

    public function testCreateProjectMember()
    {
        $admin = \App\User::find(1);
        $project_member = factory('App\ProjectMember')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project_member) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_members.index'))
                ->clickLink('Add new')
                ->select("project_id", $project_member->project_id)
                ->select("member_id", $project_member->member_id)
                ->select("partner_id", $project_member->partner_id)
                ->press('Save')
                ->assertRouteIs('admin.project_members.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $project_member->project->name)
                ->assertSeeIn("tr:last-child td[field-key='member']", $project_member->member->name)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $project_member->partner->name)
                ->logout();
        });
    }

    public function testEditProjectMember()
    {
        $admin = \App\User::find(1);
        $project_member = factory('App\ProjectMember')->create();
        $project_member2 = factory('App\ProjectMember')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $project_member, $project_member2) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_members.index'))
                ->click('tr[data-entry-id="' . $project_member->id . '"] .btn-info')
                ->select("project_id", $project_member2->project_id)
                ->select("member_id", $project_member2->member_id)
                ->select("partner_id", $project_member2->partner_id)
                ->press('Update')
                ->assertRouteIs('admin.project_members.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $project_member2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='member']", $project_member2->member->name)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $project_member2->partner->name)
                ->logout();
        });
    }

    public function testShowProjectMember()
    {
        $admin = \App\User::find(1);
        $project_member = factory('App\ProjectMember')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $project_member) {
            $browser->loginAs($admin)
                ->visit(route('admin.project_members.index'))
                ->click('tr[data-entry-id="' . $project_member->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project']", $project_member->project->name)
                ->assertSeeIn("td[field-key='member']", $project_member->member->name)
                ->assertSeeIn("td[field-key='partner']", $project_member->partner->name)
                ->logout();
        });
    }

}
