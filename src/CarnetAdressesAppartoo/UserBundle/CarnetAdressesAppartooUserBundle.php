<?php

namespace CarnetAdressesAppartoo\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;


class CarnetAdressesAppartooUserBundle extends Bundle {
    public function getParent() {
        return 'FOSUserBundle';
    }
	
}