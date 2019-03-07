<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CdEmailTest extends DuskTestCase
{

    public function testCreateCdEmail()
    {
        $admin = \App\User::find(1);
        $cd_email = factory('App\CdEmail')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_email) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_emails.index'))
                ->clickLink('Add new')
                ->type("month", $cd_email->month)
                ->type("value", $cd_email->value)
                ->select("project_id", $cd_email->project_id)
                ->press('Save')
                ->assertRouteIs('admin.cd_emails.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_email->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_email->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_email->project->name)
                ->logout();
        });
    }

    public function testEditCdEmail()
    {
        $admin = \App\User::find(1);
        $cd_email = factory('App\CdEmail')->create();
        $cd_email2 = factory('App\CdEmail')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $cd_email, $cd_email2) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_emails.index'))
                ->click('tr[data-entry-id="' . $cd_email->id . '"] .btn-info')
                ->type("month", $cd_email2->month)
                ->type("value", $cd_email2->value)
                ->select("project_id", $cd_email2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.cd_emails.index')
                ->assertSeeIn("tr:last-child td[field-key='month']", $cd_email2->month)
                ->assertSeeIn("tr:last-child td[field-key='value']", $cd_email2->value)
                ->assertSeeIn("tr:last-child td[field-key='project']", $cd_email2->project->name)
                ->logout();
        });
    }

    public function testShowCdEmail()
    {
        $admin = \App\User::find(1);
        $cd_email = factory('App\CdEmail')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $cd_email) {
            $browser->loginAs($admin)
                ->visit(route('admin.cd_emails.index'))
                ->click('tr[data-entry-id="' . $cd_email->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='month']", $cd_email->month)
                ->assertSeeIn("td[field-key='value']", $cd_email->value)
                ->assertSeeIn("td[field-key='project']", $cd_email->project->name)
                ->logout();
        });
    }

}
