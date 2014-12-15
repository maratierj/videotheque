<?php

namespace Movie\ListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// N'oubliez pas ce use pour l'annotation
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Movie\ListBundle\Entity\Movie;
use Movie\ListBundle\Form\MovieType;
use Movie\ListBundle\Form\MovieEditType;

use Symfony\Component\HttpFoundation\Response;

class MovieListController extends Controller
{	
    public function indexAction($page)
    {
		// On ne sait pas combien de pages il y a
		// Mais on sait qu'une page doit être supérieure ou égale à 1
		if ($page < 1) {
		  // On déclenche une exception NotFoundHttpException, cela va afficher
		  // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
		  throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}
		
		// Ici je fixe le nombre d'annonces par page à 3
		// Mais bien sûr il faudrait utiliser un paramètre, et y accéder via $this->container->getParameter('nb_per_page')
		$nbPerPage = 30;

		$em = $this->getDoctrine()->getManager();
		// On récupère tous les films
		$listMovies = $em
		  ->getRepository('MovieListBundle:Movie')
		  ->getAllMovies($page, $nbPerPage)
		;

		// On calcule le nombre total de pages grâce au count($listAdverts) qui retourne le nombre total d'annonces
		$nbPages = ceil(count($listMovies)/$nbPerPage);

		// Si la page n'existe pas, on retourne une 404
		if ($page > $nbPages) {
		  throw $this->createNotFoundException("La page ".$nbPages." n'existe pas.");
		}

		// On donne toutes les informations nécessaires à la vue
		return $this->render('MovieListBundle:MovieList:index.html.twig', array(
		  'listMovies' => $listMovies,
		  'nbPages'     => $nbPages,
		  'page'        => $page
		));
    }
	
	/**
        * @Route("movie/{movie_id}", name="movie_list_view", options={"expose"=true}) 
	* @ParamConverter("movie", options={"mapping": {"movie_id": "id"}})
	*/
	public function viewAction(Movie $movie)
	{
                if($movie != null){
		// $id vaut 5 si l'on a appelé l'URL /platform/advert/5

		// Ici, on récupèrera depuis la base de données
		// l'annonce correspondant à l'id $id.
		// Puis on passera l'annonce à la vue pour
		// qu'elle puisse l'afficher

		/*$em = $this->getDoctrine()->getManager();
		// On récupère l'annonce $id
		$movie = $em
		  ->getRepository('MovieListBundle:Movie')
		  ->find($movie_id)
		;*/

                    return $this->render('MovieListBundle:MovieList:view.html.twig', array('movie' => $movie));
                }
                else{
                    echo 'coucou';
                }
	}
	
	/**
        * @Route("add", name="movie_list_add", options={"expose"=true})
	* @Security("has_role('ROLE_ADMIN')")
	*/
	 public function addAction(Request $request)
	{
		// La gestion d'un formulaire est particulière, mais l'idée est la suivante :

		// Si on n'est pas en POST, alors on affiche le formulaire
		//On crée un objet Movie
		$movie = new Movie();
		
		 // On crée le FormBuilder grâce au service form factory
		$form = $this->createForm(new MovieType(), $movie);		

		// On vérifie que les valeurs entrées sont correctes
		// (Nous verrons la validation des objets en détail dans le prochain chapitre)
                
		if ($form->handleRequest($request)->isValid()) {
                   
		  // On l'enregistre notre objet $advert dans la base de données, par exemple
		  $em = $this->getDoctrine()->getManager();
		  $em->persist($movie);
                  
                  //echo $movie->getImage()->getUrl() . "<br/>" . $movie->getImage()->getUploadDir() . "<br/>" . $movie->getImage()->getWebPath();
		  $em->flush();

		  //$request->getSession()->getFlashBag()->add('notice', 'film bien enregistré.');
//		  echo $movie->getImage()->getUrl() . " coucoucoucoucoucoucocuoucuo" ;
		  //echo __DIR__;

		  // On redirige vers la page de visualisation de l'annonce nouvellement créée
		  //return $this->redirect($this->generateUrl('movie_list_view', array('movie_id' => $movie->getId())));
                  return new Response($movie->getId());
		}
                

		// À ce stade, le formulaire n'est pas valide car :
		// - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
		// - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
		return $this->render('MovieListBundle:MovieList:add.html.twig', array(
		  'form' => $form->createView(),
		));
	}
        /**
        * @Route("edit/{id}", name="movie_list_edit", options={"expose"=true})
	*/
	public function editAction($id, Request $request)
	{
		// Ici, on récupérera l'annonce correspondante à $id
		$em = $this->getDoctrine()->getManager();
		// On récupère l'annonce $id
		$movie = $em
		  ->getRepository('MovieListBundle:Movie')
		  ->find($id)
		;
		
		 // On crée le FormBuilder grâce au service form factory
		$form = $this->createForm(new MovieEditType(), $movie);

		// Même mécanisme que pour l'ajout
		if ($form->handleRequest($request)->isValid()) 
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($movie);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

			return $this->redirect($this->generateUrl('movie_list_view', array('movie_id' => $movie->getId())));
		}

		return $this->render('MovieListBundle:MovieList:edit.html.twig', array(
		  'form' => $form->createView(),
		));
	}

	public function deleteAction($id)
	{
		// Ici, on récupérera l'annonce correspondant à $id

		// Ici, on gérera la suppression de l'annonce en question

		return $this->render('MovieListBundle:MovieList:delete.html.twig');
		
		
		/*// On récupère l'EntityManager
		$em = $this->getDoctrine()->getManager();

		// On récupère l'entité correspondant à l'id $id
		$advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

		// Si l'annonce n'existe pas, on affiche une erreur 404
		if ($advert == null) {
		  throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
		}

		if ($request->isMethod('POST')) {
		  // Si la requête est en POST, on deletea l'article

		  $request->getSession()->getFlashBag()->add('info', 'Annonce bien supprimée.');

		  // Puis on redirige vers l'accueil
		  return $this->redirect($this->generateUrl('oc_platform_home'));
		}

		// Si la requête est en GET, on affiche une page de confirmation avant de delete
		return $this->render('OCPlatformBundle:Advert:delete.html.twig', array(
		  'advert' => $advert
		));*/
	}
	
	public function menuAction($limit)
	{
		$movieRepository = $this->getDoctrine()->getManager()->getRepository('MovieListBundle:Movie');
		$listMovies = $movieRepository->getLastMovieAdd($limit);

		return $this->render('MovieListBundle:MovieList:menu.html.twig', array(
		  // Tout l'intérêt est ici : le contrôleur passe
		  // les variables nécessaires au template !
		  'listMovies' => $listMovies
		));
	}
        
        /**
        * @Route("search", name="movie_list_search", options={"expose"=true})
	*/
        public function searchAction(){           
            return $this->render('MovieListBundle:MovieList:search.html.twig');
        }
        
        /**
        * @Route("list", name="movie_list_list", options={"expose"=true})
        */
        public function listAction(){
            return $this->render('MovieListBundle:MovieList:list.html.twig');
        }
}
