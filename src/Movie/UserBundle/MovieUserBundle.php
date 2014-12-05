<?php

namespace Movie\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MovieUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
