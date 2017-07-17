<?php

namespace Tests\Feature\Event;

use App\Modules\Event\Event;
use App\User;
use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTest extends TestCase
{
	use DatabaseMigrations;

	protected function setUp()
	{
		parent::setUp();

		$this->user = factory(User::class)->create();
	}

	/** @test */
	public function a_guest_should_not_see_events_section()
	{
		$this->get(route('events'))
			->assertRedirect(route('login'));
	}

	/** @test */
	public function a_user_can_see_list_of_events()
	{
		$event = factory(Event::class)->create();

		$this->actingAs($this->user)
			->get(route('events'))
			->assertStatus(200)
			->assertSeeText($event->title)
			->assertSeeText($event->description);
	}

	/** @test */
	public function a_user_can_view_event_details()
	{
		$event = factory(Event::class)->create();

		$this->actingAs($this->user)
			->get(route('event-view', $event))
			->assertSeeText($event->title)
			->assertSeeText($event->creator->name);
	}
}
