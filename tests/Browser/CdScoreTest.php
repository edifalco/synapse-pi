<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CdScoreTest extends DuskTestCase
{

    public function testCreateCdScore()
    {
        $admin = \App\User::find(1);
        $cd_score = factory('App\CdScore')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_score) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_scores.index'))
                ->clickLink('Add new')
                ->type("month", $cd_score->month)
                ->type("value", $cd_score->value)
                ->select("project_id", $cd_score->project_id)
                ->press('Save')
                ->assertRouteIs('admin.cd_scores.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_score->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_score->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_score->project->name)
                ->logout();
        });
    }

    public function testEditCdScore()
    {
        $admin = \App\User::find(1);
        $cd_score = factory('App\CdScore')->create();
        $cd_score2 = factory('App\CdScore')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_score, $cd_score2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_scores.index'))
                ->click('tr[data-entry-id="' . $cd_score->id . '"] .btn-info')
                ->type("month", $cd_score2->month)
                ->type("value", $cd_score2->value)
                ->select("project_id", $cd_score2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.cd_scores.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_score2->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_score2->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_score2->project->name)
                ->logout();
        });
    }

    public function testShowCdScore()
    {
        $admin = \App\User::find(1);
        $cd_score = factory('App\CdScore')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $cd_score) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_scores.index'))
                ->click('tr[data-entry-id="' . $cd_score->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='month']", $cd_score->month)
                ->assertSeeIn("td[field-key='value']", $cd_score->value)
                ->assertSeeIn("td[field-key='project']", $cd_score->project->name)
                ->logout();
        });
    }

}
