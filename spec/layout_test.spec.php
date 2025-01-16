<?php

describe(\Dxw\Iguana\Theme\Layout::class, function(){
    beforeEach(function(){
        $this->layout = new \Dxw\Iguana\Theme\Layout();
    });

    afterEach(function(){
    });

    it("test apply", function(){
        $test = $this->layout::apply('x/y/z.php');
        expect($test)->toBeAnInstanceOf(\Dxw\Iguana\Theme\Layout::class);
        expect(\Dxw\Iguana\Theme\Layout::$wordpress_template)->toBe('x/y/z.php');
        expect(\Dxw\Iguana\Theme\Layout::$base)->toBe('z');
    });

    it("test to string", function(){
		$this->layout->slug = 'slug';
        $this->layout->templates = ['layouts/main.php'];

        allow('apply_filters')->toBeCalled()
        ->with('roots_wrap_'.$this->layout->slug, $this->layout->templates)
        ->andReturn(['layouts/my-layout.php']);

        allow('locate_template')
        ->toBeCalled()
        ->with(['layouts/my-layout.php'])
        ->andReturn('correct output');

        expect($this->layout->__toString())->toBe('correct output');
    });

    it("test constructor", function(){

    });
});