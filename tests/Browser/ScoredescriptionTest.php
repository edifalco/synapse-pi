<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ScoredescriptionTest extends DuskTestCase
{

    public function testCreateScoredescription()
    {
        $admin = \App\User::find(1);
        $scoredescription = factory('App\Scoredescription')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $scoredescription) {
            $browser->loginAs($admin)
                ->visit(route('admin.scoredescriptions.index'))
                ->clickLink('Add new')
                ->type("description", $scoredescription->description)
                ->select("project_id", $scoredescription->project_id)
                ->type("score_id", $scoredescription->score_id)
                ->press('Save')
                ->assertRouteIs('admin.scoredescriptions.index')
                ->assertSeeIn("tr:last-child td[field-key='description']", $scoredescription->description)
                ->assertSeeIn("tr:last-child td[field-key='project']", $scoredescription->project->name)
                ->assertSeeIn("tr:last-child td[field-key='score_id']", $scoredescription->score_id)
                ->logout();
        });
    }

    public function testEditScoredescription()
    {
        $admin = \App\User::find(1);
        $scoredescription = factory('App\Scoredescription')->create();
        $scoredescription2 = factory('App\Scoredescription')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $scoredescription, $scoredescription2) {
            $browser->loginAs($admin)
                ->visit(route('admin.scoredescriptions.index'))
                ->click('tr[data-entry-id="' . $scoredescription->id . '"] .btn-info')
                ->type("description", $scoredescription2->description)
                ->select("project_id", $scoredescription2->project_id)
                ->type("score_id", $scoredescription2->score_id)
                ->press('Update')
                ->assertRouteIs('admin.scoredescriptions.index')
                ->assertSeeIn("tr:last-child td[field-key='description']", $scoredescription2->description)
                ->assertSeeIn("tr:last-child td[field-key='project']", $scoredescription2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='score_id']", $scoredescription2->score_id)
                ->logout();
        });
    }

    public function testShowScoredescription()
    {
        $admin = \App\User::find(1);
        $scoredescription = factory('App\Scoredescription')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $scoredescription) {
            $browser->loginAs($admin)
                ->visit(route('admin.scoredescriptions.index'))
                ->click('tr[data-entry-id="' . $scoredescription->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='description']", $scoredescription->description)
                ->assertSeeIn("td[field-key='project']", $scoredescription->project->name)
                ->assertSeeIn("td[field-key='score_id']", $scoredescription->score_id)
                ->logout();
        });
    }

}
