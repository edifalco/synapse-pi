<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PublicationTest extends DuskTestCase
{

    public function testCreatePublication()
    {
        $admin = \App\User::find(1);
        $publication = factory('App\Publication')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $publication) {
            $browser->loginAs($admin)
                ->visit(route('admin.publications.index'))
                ->clickLink('Add new')
                ->type("title", $publication->title)
                ->type("year", $publication->year)
                ->type("month", $publication->month)
                ->type("abbr", $publication->abbr)
                ->type("link", $publication->link)
                ->select("project_id", $publication->project_id)
                ->type("authors", $publication->authors)
                ->press('Save')
                ->assertRouteIs('admin.publications.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $publication->title)
                ->assertSeeIn("tr:last-child td[field-key='year']", $publication->year)
                ->assertSeeIn("tr:last-child td[field-key='month']", $publication->month)
                ->assertSeeIn("tr:last-child td[field-key='abbr']", $publication->abbr)
                ->assertSeeIn("tr:last-child td[field-key='link']", $publication->link)
                ->assertSeeIn("tr:last-child td[field-key='project']", $publication->project->name)
                ->assertSeeIn("tr:last-child td[field-key='authors']", $publication->authors)
                ->logout();
        });
    }

    public function testEditPublication()
    {
        $admin = \App\User::find(1);
        $publication = factory('App\Publication')->create();
        $publication2 = factory('App\Publication')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $publication, $publication2) {
            $browser->loginAs($admin)
                ->visit(route('admin.publications.index'))
                ->click('tr[data-entry-id="' . $publication->id . '"] .btn-info')
                ->type("title", $publication2->title)
                ->type("year", $publication2->year)
                ->type("month", $publication2->month)
                ->type("abbr", $publication2->abbr)
                ->type("link", $publication2->link)
                ->select("project_id", $publication2->project_id)
                ->type("authors", $publication2->authors)
                ->press('Update')
                ->assertRouteIs('admin.publications.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $publication2->title)
                ->assertSeeIn("tr:last-child td[field-key='year']", $publication2->year)
                ->assertSeeIn("tr:last-child td[field-key='month']", $publication2->month)
                ->assertSeeIn("tr:last-child td[field-key='abbr']", $publication2->abbr)
                ->assertSeeIn("tr:last-child td[field-key='link']", $publication2->link)
                ->assertSeeIn("tr:last-child td[field-key='project']", $publication2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='authors']", $publication2->authors)
                ->logout();
        });
    }

    public function testShowPublication()
    {
        $admin = \App\User::find(1);
        $publication = factory('App\Publication')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $publication) {
            $browser->loginAs($admin)
                ->visit(route('admin.publications.index'))
                ->click('tr[data-entry-id="' . $publication->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $publication->title)
                ->assertSeeIn("td[field-key='year']", $publication->year)
                ->assertSeeIn("td[field-key='month']", $publication->month)
                ->assertSeeIn("td[field-key='abbr']", $publication->abbr)
                ->assertSeeIn("td[field-key='link']", $publication->link)
                ->assertSeeIn("td[field-key='project']", $publication->project->name)
                ->assertSeeIn("td[field-key='authors']", $publication->authors)
                ->logout();
        });
    }

}
