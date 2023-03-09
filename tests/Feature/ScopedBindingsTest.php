<?php

namespace Tests\Feature;

use App\Models\ChildItem;
use App\Models\ParentItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScopedBindingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_scoped_bindings(): void
    {
        // Create a parent and child items
        $parentItem = ParentItem::factory()->create();
        $childItem = ChildItem::factory()->for($parentItem)->create();

        // Create another unrelated set
        $unrelatedParentItem = ParentItem::factory()->create();
        $unrelatedChildItem = ChildItem::factory()->for($unrelatedParentItem)->create();

        // Should pass scoped binding checks because they are related
        $this->get(route(
            'works',
            [
                'parentItem' => $parentItem,
                'childItem' => $childItem,
            ]
        ))
            ->assertOk();

        // Should fail scoped binding checks, as they are not related
        $this->get(route(
            'works',
            [
                'parentItem' => $parentItem,
                'childItem' => $unrelatedChildItem,
            ]
        ))
            ->assertNotFound();

        // Try again with the problem route
        // Should pass scoped binding checks because they are related
        $this->get(route(
            'broken',
            [
                'parentItem' => $parentItem,
                'between' => 'breaks',
                'childItem' => $childItem,
            ]
        ))
            ->assertOk();

        // This should fail, as they are not related, but it succeeds because of the
        // new parameter added between the child and parent parameters.
        $this->get(route(
            'broken',
            [
                'parentItem' => $parentItem,
                'between' => 'breaks',
                'childItem' => $unrelatedChildItem,
            ]
        ))
            ->assertOk();
    }
}
