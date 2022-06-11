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
        $this->createSegment();
    }
    public function test_if_can_fetch_all_segment()
    {
        $this->get(route('segment.ind ex'))
            ->assertSuccessful();
    }
}
