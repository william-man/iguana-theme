<?php

use \Dxw\Iguana\Theme\Testing;

class LayoutRegisterTestHelper{
    use Testing;
}

describe("layout register test", function(){

    beforeEach(function(){
        \WP_Mock::setUp();
        $this->helper = new LayoutRegisterTestHelper();
    });
    afterEach(function(){
        \WP_Mock::tearDown();
        \Dxw\Iguana\Theme\Layout::$wordpress_template = null;
    });

    it("test register", function(){
        $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($this->helper->getHelpers());
        
        expect($layoutRegister)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);

        \WP_Mock::expectFilterAdded('template_include',[\Dxw\Iguana\Theme\Layout::class, 'apply'],99);
        $layoutRegister->register();

    });

    it("test construct",function(){
        $helpers = $this->helper->getHelpers(\Dxw\Iguana\Theme\LayoutRegister::class,['w_requested_template'=>'wRequestedTemplate',]);
        $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($helpers);

        $this->helper->assertFunctionsRegistered();
    });

    it("test wrequested template",function(){
        $layoutRegister = new \Dxw\Iguana\Theme\LayoutRegister($this->helper->getHelpers());
        $file = \org\bovigo\vfs\vfsStream::setup()->url().'/file.php';

        file_put_contents($file, '<?php global $called; $called++;');
        \Dxw\Iguana\Theme\Layout::$wordpress_template = $file;

        global $called;
        $called = 0;

        $layoutRegister->wRequestedTemplate();

        expect($called)->toBe(1);
    });

});