<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Medication;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MedicationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_medication()
    {
        $medication = Medication::factory()->create();

        $this->assertDatabaseHas('medications', [
            'id' => $medication->id,
            'nom' => $medication->nom,
            'dosage' => $medication->dosage,
        ]);
    }

    /** @test */
    public function it_can_delete_a_medication()
    {
        $medication = Medication::factory()->create();
        $medication->delete();

        $this->assertDatabaseMissing('medications', [
            'id' => $medication->id,
        ]);
    }
}
