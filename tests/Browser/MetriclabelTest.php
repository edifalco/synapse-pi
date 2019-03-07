<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MetriclabelTest extends DuskTestCase
{

    public function testCreateMetriclabel()
    {
        $admin = \App\User::find(1);
        $metriclabel = factory('App\Metriclabel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $metriclabel) {
            $browser->loginAs($admin)
                ->visit(route('admin.metriclabels.index'))
                ->clickLink('Add new')
                ->type("label", $metriclabel->label)
                ->select("project_id", $metriclabel->project_id)
                ->type("metric_id", $metriclabel->metric_id)
                ->press('Save')
                ->assertRouteIs('admin.metriclabels.index')
                ->assertSeeIn("tr:last-child td[field-key='label']", $metriclabel->label)
                ->assertSeeIn("tr:last-child td[field-key='project']", $metriclabel->project->name)
                ->assertSeeIn("tr:last-child td[field-key='metric_id']", $metriclabel->metric_id)
                ->logout();
        });
    }

    public function testEditMetriclabel()
    {
        $admin = \App\User::find(1);
        $metriclabel = factory('App\Metriclabel')->create();
        $metriclabel2 = factory('App\Metriclabel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $metriclabel, $metriclabel2) {
            $browser->loginAs($admin)
                ->visit(route('admin.metriclabels.index'))
                ->click('tr[data-entry-id="' . $metriclabel->id . '"] .btn-info')
                ->type("label", $metriclabel2->label)
                ->select("project_id", $metriclabel2->project_id)
                ->type("metric_id", $metriclabel2->metric_id)
                ->press('Update')
                ->assertRouteIs('admin.metriclabels.index')
                ->assertSeeIn("tr:last-child td[field-key='label']", $metriclabel2->label)
                ->assertSeeIn("tr:last-child td[field-key='project']", $metriclabel2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='metric_id']", $metriclabel2->metric_id)
                ->logout();
        });
    }

    public function testShowMetriclabel()
    {
        $admin = \App\User::find(1);
        $metriclabel = factory('App\Metriclabel')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $metriclabel) {
            $browser->loginAs($admin)
                ->visit(route('admin.metriclabels.index'))
                ->click('tr[data-entry-id="' . $metriclabel->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='label']", $metriclabel->label)
                ->assertSeeIn("td[field-key='project']", $metriclabel->project->name)
                ->assertSeeIn("td[field-key='metric_id']", $metriclabel->metric_id)
                ->logout();
        });
    }

}
