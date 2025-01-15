<?php

describe("Layout_Test", function(){
    beforeEach(function(){
        \WP_Mock::setUp();
    });

    afterEach(function(){
        \WP_Mock::tearDown();

        \Dxw\Iguana\Theme\Layout::$wordpress_template = null;
		\Dxw\Iguana\Theme\Layout::$base = null;
    });

    it("test apply", function(){
        expect(\Dxw\Iguana\Theme\Layout::apply('x/y/z.php'))->toBeAnInstanceOf(\Dxw\Iguana\Theme\Layout::class);
        expect(\Dxw\Iguana\Theme\Layout::$wordpress_template)->toBe('x/y/z.php');
        expect(\Dxw\Iguana\Theme\Layout::$base)->toBe('z');
    });

    it("test to string", function(){
        $layout = new \Dxw\Iguana\Theme\Layout();
		$layout->slug = 'slug';

        \WP_Mock::onFilter('roots_wrap_slug')
        ->with(['layouts/main.php'])
        ->reply(['layouts/my-layout.php']);

		\WP_Mock::wpFunction('locate_template', [
			'args' => [['layouts/my-layout.php']],
			'return' => 'correct output',
		]);

        expect($layout->__toString())->toBe('correct output');
    });

    it("test constructor", function(){

    });
});