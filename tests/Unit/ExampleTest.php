<?php

namespace Tests\Unit;

use App\Models\Visitor;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $visitorDay = Visitor::whereDate('created_at', Carbon::today())->count();
        $this->assertTrue($visitorDay);
    }
}
