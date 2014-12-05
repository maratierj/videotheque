<?php
//src\Movie\ListBundle\VerifDoublons\MovieVerifDoublons.php

namespace Movie\ListBundle\VerifDoublons;

class MovieVerifDoublons
{
	/**
	*Vérifie que le titre n'est pas trop long
	*/
	public function isTooLong($text)
	{
		return strlen($text) < 50;
	}
}