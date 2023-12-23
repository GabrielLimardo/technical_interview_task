<?php

namespace Tests\Unit;

use App\Services\ItemService;
use App\Models\Item;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_filter_items_by_fields()
    {
        // Asumiendo que tienes un factory para Item, crea algunos items.
        $items = Item::factory(5)->create();

        // Aquí, puedes hacer una solicitud simulada como lo harías en un controlador.
        $request = new \Illuminate\Http\Request([
            'fields' => ['name'],
            'filterTypes' => ['contains'],
            'filterValues' => ['sample'],
            'operator' => 'AND',
        ]);

        $service = new ItemService();
        $result = $service->filterItems($request);

        // Aquí, puedes hacer afirmaciones sobre el resultado.
        $this->assertCount(1, $result);
    }

    /** @test */
    public function it_can_sort_items_by_updated_at()
    {
        $items = Item::factory(5)->create();

        $request = new \Illuminate\Http\Request([
            'orderBy' => 'asc',
        ]);

        $service = new ItemService();
        $result = $service->filterItems($request);

        $this->assertTrue($items->first()->is($result->first()));
    }


}
