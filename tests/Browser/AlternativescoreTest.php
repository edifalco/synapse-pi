<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AlternativescoreTest extends DuskTestCase
{

    public function testCreateAlternativescore()
    {
        $admin = \App\User::find(1);
        $alternativescore = factory('App\Alternativescore')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $alternativescore) {
            $browser->loginAs($admin)
                ->visit(route('admin.alternativescores.index'))
                ->clickLink('Add new')
                ->type("show", $alternativescore->show)
                ->select("project_id", $alternativescore->project_id)
                ->press('Save')
                ->assertRouteIs('admin.alternativescores.index')
                ->assertSeeIn("tr:last-child td[field-key='show']", $alternativescore->show)
                ->assertSeeIn("tr:last-child td[field-key='project']", $alternativescore->project->name)
                ->logout();
        });
    }

    public function testEditAlternativescore()
    {
        $admin = \App\User::find(1);
        $alternativescore = factory('App\Alternativescore')->create();
        $alternativescore2 = factory('App\Alternativescore')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $alternativescore, $alternativescore2) {
            $browser->loginAs($admin)
                ->visit(route('admin.alternativescores.index'))
                ->click('tr[data-entry-id="' . $alternativescore->id . '"] .btn-info')
                ->type("show", $alternativescore2->show)
                ->select("project_id", $alternativescore2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.alternativescores.index')
                ->assertSeeIn("tr:last-child td[field-key='show']", $alternativescore2->show)
                ->assertSeeIn("tr:last-child td[field-key='project']", $alternativescore2->project->name)
                ->logout();
        });
    }

    public function testShowAlternativescore()
    {
        $admin = \App\User::find(1);
        $alternativescore = factory('App\Alternativescore')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $alternativescore) {
            $browser->loginAs($admin)
                ->visit(route('admin.alternativescores.index'))
                ->click('tr[data-entry-id="' . $alternativescore->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='show']", $alternativescore->show)
                ->assertSeeIn("td[field-key='project']", $alternativescore->project->name)
                ->logout();
        });
    }

}
