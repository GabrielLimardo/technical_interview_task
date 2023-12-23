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
    public function it_can_filter_items_by_contain_id()
    {
        $items = Item::factory(5)->create();

        $request = new \Illuminate\Http\Request([
            'perPage' => '3',
            'fields' =>
                array (
                0 => 'id'
                ),
            'filterTypes' =>
                array (
                    0 => 'contains'
                ),
            'filterValues' =>
                array (
                    0 => '0'
                ),
        ]);

        $service = new ItemService();
        $result = $service->filterItems($request);

        $items = $result->items();

        foreach ($items as $item) {
            $id = (string) $item->id; // Convertir el ID a string para tratarlo como texto
            $this->assertTrue(strpos($id, '0') !== false, "El ID $id no contiene el dígito 0.");
        }
    }

    public function it_can_filter_items_by_equal_name()
    {
        $items = Item::factory(5)->create();

        $request = new \Illuminate\Http\Request([
            'perPage' => '3',
            'fields' =>
                array (
                0 => 'name'
                ),
            'filterTypes' =>
                array (
                    0 => 'is'
                ),
            'filterValues' =>
                array (
                    0 => 'webcam'
                ),
        ]);

        $service = new ItemService();
        $result = $service->filterItems($request);

        $items = $result->items();

        foreach ($items as $item) {
            $id = (string) $item->id; // Convertir el ID a string para tratarlo como texto
            $this->assertTrue(strpos($id, '0') !== false, "El ID $id no contiene el dígito 0.");
        }
    }


}
