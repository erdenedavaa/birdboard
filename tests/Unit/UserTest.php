<?php

namespace Tests\Unit;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_projects()
    {
        $user = factory('App\User')->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
    }

    /** @test */
    public function a_user_has_accessible_projects()
    {
        $ongoo = $this->signIn();

        ProjectFactory::ownedBy($ongoo)->create();

        $this->assertCount(1, $ongoo->accessibleProjects());

        $mogjoo = factory(User::class)->create();
        $bujaa = factory(User::class)->create();

//        $project = ProjectFactory::ownedBy($mogjoo)->create();
//        $project->invite($bujaa);
        $project = tap(ProjectFactory::ownedBy($mogjoo)->create())->invite($bujaa);

        $this->assertCount(1, $ongoo->accessibleProjects());

        $project->invite($ongoo);
        $this->assertCount(2, $ongoo->accessibleProjects());

    }
}
