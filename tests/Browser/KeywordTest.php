<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class KeywordTest extends DuskTestCase
{

    public function testCreateKeyword()
    {
        $admin = \App\User::find(1);
        $keyword = factory('App\Keyword')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $keyword) {
            $browser->loginAs($admin)
                ->visit(route('admin.keywords.index'))
                ->clickLink('Add new')
                ->type("word", $keyword->word)
                ->press('Save')
                ->assertRouteIs('admin.keywords.index')
                ->assertSeeIn("tr:last-child td[field-key='word']", $keyword->word)
                ->logout();
        });
    }

    public function testEditKeyword()
    {
        $admin = \App\User::find(1);
        $keyword = factory('App\Keyword')->create();
        $keyword2 = factory('App\Keyword')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $keyword, $keyword2) {
            $browser->loginAs($admin)
                ->visit(route('admin.keywords.index'))
                ->click('tr[data-entry-id="' . $keyword->id . '"] .btn-info')
                ->type("word", $keyword2->word)
                ->press('Update')
                ->assertRouteIs('admin.keywords.index')
                ->assertSeeIn("tr:last-child td[field-key='word']", $keyword2->word)
                ->logout();
        });
    }

    public function testShowKeyword()
    {
        $admin = \App\User::find(1);
        $keyword = factory('App\Keyword')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $keyword) {
            $browser->loginAs($admin)
                ->visit(route('admin.keywords.index'))
                ->click('tr[data-entry-id="' . $keyword->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='word']", $keyword->word)
                ->logout();
        });
    }

}
