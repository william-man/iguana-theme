<?php

describe("Helper_Test", function(){
    beforeEach(function() {
        $this->helpers = new \Dxw\Iguana\Theme\Helpers();
    });
    it("test register function", function(){
        $this->helpers->registerFunction('myFunc', function() {
            return 42;
        });
        expect($this->helpers->myFunc())->toBe(42);
    });

    it("test function arguements", function(){
        $this->helpers->registerFunction('anotherFunc', function($a, $b) {
            return 42 + $a + $b;
        });
        expect($this->helpers->anotherFunc(1,5))->toBe(48);
    });

    it("test register", function(){
        expect($this->helpers)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
        expect(function_exists('h'))->toBeFalsy();

        $this->helpers->register();
        expect(function_exists('h'))->toBeTruthy();
    });
});