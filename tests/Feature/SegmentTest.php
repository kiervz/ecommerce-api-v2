<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SegmentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_if_can_fetch_all_segments()
    {
        $this->createSegments();

        $response = $this->get(route('segment.index'))
            ->assertSuccessful();

        $response->assertJsonCount(10, 'response');
    }

    public function test_if_can_fetch_specific_segment()
    {
        $segment = $this->createSegment();

        $this->get(route('segment.show', ['segment' => $segment]))
            ->assertSuccessful();
    }

    public function test_if_can_create_segment()
    {
        $this->post(route('segment.store'), [
            'name' => 'Kids'
        ])->assertCreated();

        $this->assertDatabaseHas('segments', ['name' => 'Kids']);
    }
}
