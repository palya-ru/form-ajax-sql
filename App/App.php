<?php

namespace App;
class App
{
    public function start()
    {
        new ErrorsDis();
        new View();
        $form = new Form();
        $form->go();
    }
}
