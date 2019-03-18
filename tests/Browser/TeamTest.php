<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TeamTest extends DuskTestCase
{

    public function testCreateTeam()
    {
        $admin = \App\User::find(1);
        $team = factory('App\Team')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $team) {
            $browser->loginAs($admin)
                ->visit(route('admin.teams.index'))
                ->clickLink('Add new')
                ->select("member_id", $team->member_id)
                ->select("project_id", $team->project_id)
                ->type("role", $team->role)
                ->select("partner_id", $team->partner_id)
                ->press('Save')
                ->assertRouteIs('admin.teams.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $team->member->surname)
                ->assertSeeIn("tr:last-child td[field-key='project']", $team->project->name)
                ->assertSeeIn("tr:last-child td[field-key='role']", $team->role)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $team->partner->name)
                ->logout();
        });
    }

    public function testEditTeam()
    {
        $admin = \App\User::find(1);
        $team = factory('App\Team')->create();
        $team2 = factory('App\Team')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $team, $team2) {
            $browser->loginAs($admin)
                ->visit(route('admin.teams.index'))
                ->click('tr[data-entry-id="' . $team->id . '"] .btn-info')
                ->select("member_id", $team2->member_id)
                ->select("project_id", $team2->project_id)
                ->type("role", $team2->role)
                ->select("partner_id", $team2->partner_id)
                ->press('Update')
                ->assertRouteIs('admin.teams.index')
                ->assertSeeIn("tr:last-child td[field-key='member']", $team2->member->surname)
                ->assertSeeIn("tr:last-child td[field-key='project']", $team2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='role']", $team2->role)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $team2->partner->name)
                ->logout();
        });
    }

    public function testShowTeam()
    {
        $admin = \App\User::find(1);
        $team = factory('App\Team')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $team) {
            $browser->loginAs($admin)
                ->visit(route('admin.teams.index'))
                ->click('tr[data-entry-id="' . $team->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='member']", $team->member->surname)
                ->assertSeeIn("td[field-key='project']", $team->project->name)
                ->assertSeeIn("td[field-key='role']", $team->role)
                ->assertSeeIn("td[field-key='partner']", $team->partner->name)
                ->logout();
        });
    }

}
