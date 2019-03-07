<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MetriciconTest extends DuskTestCase
{

    public function testCreateMetricicon()
    {
        $admin = \App\User::find(1);
        $metricicon = factory('App\Metricicon')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $metricicon) {
            $browser->loginAs($admin)
                ->visit(route('admin.metricicons.index'))
                ->clickLink('Add new')
                ->type("metric_id", $metricicon->metric_id)
                ->type("icon_id", $metricicon->icon_id)
                ->select("project_id", $metricicon->project_id)
                ->press('Save')
                ->assertRouteIs('admin.metricicons.index')
                ->assertSeeIn("tr:last-child td[field-key='metric_id']", $metricicon->metric_id)
                ->assertSeeIn("tr:last-child td[field-key='icon_id']", $metricicon->icon_id)
                ->assertSeeIn("tr:last-child td[field-key='project']", $metricicon->project->name)
                ->logout();
        });
    }

    public function testEditMetricicon()
    {
        $admin = \App\User::find(1);
        $metricicon = factory('App\Metricicon')->create();
        $metricicon2 = factory('App\Metricicon')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $metricicon, $metricicon2) {
            $browser->loginAs($admin)
                ->visit(route('admin.metricicons.index'))
                ->click('tr[data-entry-id="' . $metricicon->id . '"] .btn-info')
                ->type("metric_id", $metricicon2->metric_id)
                ->type("icon_id", $metricicon2->icon_id)
                ->select("project_id", $metricicon2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.metricicons.index')
                ->assertSeeIn("tr:last-child td[field-key='metric_id']", $metricicon2->metric_id)
                ->assertSeeIn("tr:last-child td[field-key='icon_id']", $metricicon2->icon_id)
                ->assertSeeIn("tr:last-child td[field-key='project']", $metricicon2->project->name)
                ->logout();
        });
    }

    public function testShowMetricicon()
    {
        $admin = \App\User::find(1);
        $metricicon = factory('App\Metricicon')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $metricicon) {
            $browser->loginAs($admin)
                ->visit(route('admin.metricicons.index'))
                ->click('tr[data-entry-id="' . $metricicon->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='metric_id']", $metricicon->metric_id)
                ->assertSeeIn("td[field-key='icon_id']", $metricicon->icon_id)
                ->assertSeeIn("td[field-key='project']", $metricicon->project->name)
                ->logout();
        });
    }

}
