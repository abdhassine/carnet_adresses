<?php

namespace CarnetAdresses\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CarnetAdressesUserBundle extends Bundle {
    public function getParent() {
        return 'FOSUserBundle';
    }
}
