<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AgendaTest extends DuskTestCase
{

    public function testCreateAgenda()
    {
        $admin = \App\User::find(1);
        $agenda = factory('App\Agenda')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $agenda) {
            $browser->loginAs($admin)
                ->visit(route('admin.agendas.index'))
                ->clickLink('Add new')
                ->type("date", $agenda->date)
                ->type("hour", $agenda->hour)
                ->type("minute", $agenda->minute)
                ->type("title", $agenda->title)
                ->type("description", $agenda->description)
                ->select("project_id", $agenda->project_id)
                ->type("category", $agenda->category)
                ->type("duration", $agenda->duration)
                ->type("meeting_type", $agenda->meeting_type)
                ->type("date_creation", $agenda->date_creation)
                ->press('Save')
                ->assertRouteIs('admin.agendas.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $agenda->date)
                ->assertSeeIn("tr:last-child td[field-key='hour']", $agenda->hour)
                ->assertSeeIn("tr:last-child td[field-key='minute']", $agenda->minute)
                ->assertSeeIn("tr:last-child td[field-key='title']", $agenda->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $agenda->description)
                ->assertSeeIn("tr:last-child td[field-key='project']", $agenda->project->name)
                ->assertSeeIn("tr:last-child td[field-key='category']", $agenda->category)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $agenda->duration)
                ->assertSeeIn("tr:last-child td[field-key='meeting_type']", $agenda->meeting_type)
                ->assertSeeIn("tr:last-child td[field-key='date_creation']", $agenda->date_creation)
                ->logout();
        });
    }

    public function testEditAgenda()
    {
        $admin = \App\User::find(1);
        $agenda = factory('App\Agenda')->create();
        $agenda2 = factory('App\Agenda')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $agenda, $agenda2) {
            $browser->loginAs($admin)
                ->visit(route('admin.agendas.index'))
                ->click('tr[data-entry-id="' . $agenda->id . '"] .btn-info')
                ->type("date", $agenda2->date)
                ->type("hour", $agenda2->hour)
                ->type("minute", $agenda2->minute)
                ->type("title", $agenda2->title)
                ->type("description", $agenda2->description)
                ->select("project_id", $agenda2->project_id)
                ->type("category", $agenda2->category)
                ->type("duration", $agenda2->duration)
                ->type("meeting_type", $agenda2->meeting_type)
                ->type("date_creation", $agenda2->date_creation)
                ->press('Update')
                ->assertRouteIs('admin.agendas.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $agenda2->date)
                ->assertSeeIn("tr:last-child td[field-key='hour']", $agenda2->hour)
                ->assertSeeIn("tr:last-child td[field-key='minute']", $agenda2->minute)
                ->assertSeeIn("tr:last-child td[field-key='title']", $agenda2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $agenda2->description)
                ->assertSeeIn("tr:last-child td[field-key='project']", $agenda2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='category']", $agenda2->category)
                ->assertSeeIn("tr:last-child td[field-key='duration']", $agenda2->duration)
                ->assertSeeIn("tr:last-child td[field-key='meeting_type']", $agenda2->meeting_type)
                ->assertSeeIn("tr:last-child td[field-key='date_creation']", $agenda2->date_creation)
                ->logout();
        });
    }

    public function testShowAgenda()
    {
        $admin = \App\User::find(1);
        $agenda = factory('App\Agenda')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $agenda) {
            $browser->loginAs($admin)
                ->visit(route('admin.agendas.index'))
                ->click('tr[data-entry-id="' . $agenda->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $agenda->date)
                ->assertSeeIn("td[field-key='hour']", $agenda->hour)
                ->assertSeeIn("td[field-key='minute']", $agenda->minute)
                ->assertSeeIn("td[field-key='title']", $agenda->title)
                ->assertSeeIn("td[field-key='description']", $agenda->description)
                ->assertSeeIn("td[field-key='project']", $agenda->project->name)
                ->assertSeeIn("td[field-key='category']", $agenda->category)
                ->assertSeeIn("td[field-key='duration']", $agenda->duration)
                ->assertSeeIn("td[field-key='meeting_type']", $agenda->meeting_type)
                ->assertSeeIn("td[field-key='date_creation']", $agenda->date_creation)
                ->logout();
        });
    }

}
