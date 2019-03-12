<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AcronymProjectTest extends DuskTestCase
{

    public function testCreateAcronymProject()
    {
        $admin = \App\User::find(1);
        $acronym_project = factory('App\AcronymProject')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $acronym_project) {
            $browser->loginAs($admin)
                ->visit(route('admin.acronym_projects.index'))
                ->clickLink('Add new')
                ->select("acronyms_id", $acronym_project->acronyms_id)
                ->select("partner_id", $acronym_project->partner_id)
                ->select("project_id", $acronym_project->project_id)
                ->press('Save')
                ->assertRouteIs('admin.acronym_projects.index')
                ->assertSeeIn("tr:last-child td[field-key='acronyms']", $acronym_project->acronyms->acronym)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $acronym_project->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='project']", $acronym_project->project->name)
                ->logout();
        });
    }

    public function testEditAcronymProject()
    {
        $admin = \App\User::find(1);
        $acronym_project = factory('App\AcronymProject')->create();
        $acronym_project2 = factory('App\AcronymProject')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $acronym_project, $acronym_project2) {
            $browser->loginAs($admin)
                ->visit(route('admin.acronym_projects.index'))
                ->click('tr[data-entry-id="' . $acronym_project->id . '"] .btn-info')
                ->select("acronyms_id", $acronym_project2->acronyms_id)
                ->select("partner_id", $acronym_project2->partner_id)
                ->select("project_id", $acronym_project2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.acronym_projects.index')
                ->assertSeeIn("tr:last-child td[field-key='acronyms']", $acronym_project2->acronyms->acronym)
                ->assertSeeIn("tr:last-child td[field-key='partner']", $acronym_project2->partner->name)
                ->assertSeeIn("tr:last-child td[field-key='project']", $acronym_project2->project->name)
                ->logout();
        });
    }

    public function testShowAcronymProject()
    {
        $admin = \App\User::find(1);
        $acronym_project = factory('App\AcronymProject')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $acronym_project) {
            $browser->loginAs($admin)
                ->visit(route('admin.acronym_projects.index'))
                ->click('tr[data-entry-id="' . $acronym_project->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='acronyms']", $acronym_project->acronyms->acronym)
                ->assertSeeIn("td[field-key='partner']", $acronym_project->partner->name)
                ->assertSeeIn("td[field-key='project']", $acronym_project->project->name)
                ->logout();
        });
    }

}
