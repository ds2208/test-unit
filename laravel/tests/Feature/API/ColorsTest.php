<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Models\Color;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ColorsTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /**
     *Return list of colors.
     *
     * @return void
     */
    public function test_all()
    {
        $response = $this->get('/api/colors/list');
        $response->assertStatus(200);
    }

    /**
     * Return one color by id.
     * 
     * @return void
     */
    public function test_get_color_by_id()
    {
        $color = $this->get_instance_of_color();
        $response = $this->get("/api/colors/$color->id");
        $response->assertStatus(200);
    }
    
    /**
     * Create new color.
     * 
     * @return void
     */
    public function test_create()
    {
        $response = $this->postJson('/api/colors/create', [
            'name' => "Test",
            'hex_value' => '111111',
            'status' => 1
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('colors', [
            'name' => "Test",
            'hex_value' => '#111111',
            'status' => 1
        ]);
    }

    /**
     * Edit color.
     *
     * @return void
     */
    public function test_edit()
    {
        $color = $this->get_instance_of_color();

        $response = $this->patchJson("/api/colors/$color->id/edit", [
            'name' => "EditColor",
            'hex_value' => '999999',
            'status' => 0
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('colors', [
            'name' => "EditColor",
            'hex_value' => '#999999',
            'status' => 0
        ]);
    }

    /**
     * Edit color.
     *
     * @return void
     */
    public function test_change_status()
    {
        $color = $this->get_instance_of_color();

        $response = $this->patchJson("/api/colors/$color->id/change-status");
        $response->assertStatus(200);
        $this->assertDatabaseHas('colors', [
            'name' => "MarinePury",
            'hex_value' => '779A54',
            'status' => !$color->status
        ]);
    }

    /**
     * Edit color.
     *
     * @return void
     */
    public function test_delete()
    {
        $color = $this->get_instance_of_color();

        $response = $this->deleteJson("/api/colors/$color->id/delete");
        $response->assertStatus(200);
        $this->assertModelMissing($color);
    }

    /**
     * Get default instance of color.
     * 
     * @return Color
     */
    private function get_instance_of_color()
    {
        return Color::create([
            'name' => "MarinePury",
            'hex_value' => '779A54',
            'status' => 1
        ]);
    }
}
