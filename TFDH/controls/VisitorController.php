<?php

namespace TFDH\controls;
use ao\php\framework\controls\abstractController;

class VisitorController extends AbstractController {

    public function __construct($control, $model) {
        parent::__construct($control, $model);
    }

    protected function defaultAction() {
        $this->forward('default', 'user');
    }

}