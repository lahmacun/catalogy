<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {
	/**
	 * @return Response
	 *
	 * @Route("/", name="default_index");
	 */
	public function index() {
		return new Response('Index Here!');
	}

	/**
	 * @return Response
	 *
	 * @Route("/api/test", name="default_api");
	 */
	public function api() {
		$user = $this->getUser();
		dump($user);
		return new Response('API Here!');
	}
}