<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Anime;
use AppBundle\Entity\News;
use AppBundle\Entity\Studio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * News controller.
 *
 * @Route("news")
 */
class NewsController extends Controller
{
    /**
     * Lists all news entities.
     *
     * @Route("/", name="news_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('AppBundle:News')->getAllForIndex();
        $studios = $em->getRepository('AppBundle:Studio')->findAll();

        return $this->render('news/index.html.twig', array(
            'news' => $news, 'studios' => $studios, 'from_anime' => false,
        ));
    }

    /**
     * Lists all news entities.
     *
     * @Route("/anime/{id}", name="news_anime_index")
     * @Method("GET")
     */
    public function indexByAnimeAction(Anime $anime){
        $em = $this->getDoctrine()->getManager();

        $news = $em->getRepository('AppBundle:News')->getAllForIndexByAnime($anime->getId());
        $studios = $em->getRepository('AppBundle:Studio')->findAll();

        $delete_forms = array_map(
            function ($element) {
                return $this->createDeleteForm($element)->createView();
            }
            , $news
        );

        return $this->render('news/index.html.twig', array(
            'news' => $news, 'studios' => $studios, 'from_anime' => true, 'anime' => $anime,'delete_forms' => $delete_forms, 'ordered' => false,
        ));
    }

    /**
     * Order all news by studio id.
     *
     * @Route("/order/{id}/list/{page}", name="news_index_order")
     * @Method("GET")
     */
    public function orderAction(Studio $studio, $page = 1) {
        $em = $this->getDoctrine()->getManager();

        $studios = $em->getRepository('AppBundle:Studio')->findAll();
        $newsList = $this->getDoctrine()->getRepository('AppBundle:News')->listIndexOrdered($page, 5, $studio->getId());
        $pagination = array(
            'page' => $page,
            'route' => 'news_index_list',
            'pages_count' => ceil(count($newsList) / 5),
            'route_params' => array()
        );

        return $this->render('news/index.html.twig', array(
            'news' => $newsList, 'studios' => $studios, 'from_anime' => false,'pagination' => $pagination, 'ordered' => true, 'studio_id' => $studio->getId(),
        ));
    }

    /**
     * Creates a new news entity.
     *
     * @Route("/new/{id}", name="news_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Anime $anime)
    {
        $news = new News();
        $news->setAnime($anime);
        $form = $this->createForm('AppBundle\Form\NewsType', $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush($news);

            $this->get('session')->getFlashBag()->add('success', 'Ajout de ' .$news->getTitle(). ' enregistré');
            return $this->redirectToRoute('news_anime_index', array('id' => $news->getAnime()->getId()));
        }

        return $this->render('news/new.html.twig', array(
            'news' => $news,
            'anime' => $anime,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a news entity.
     *
     * @Route("/{id}", name="news_show")
     * @Method("GET")
     */
    public function showAction(News $news)
    {
        $deleteForm = $this->createDeleteForm($news);
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('AppBundle:Anime')->incrementConsult($news->getAnime()->getId());


        return $this->render('news/show.html.twig', array(
            'news' => $news,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing news entity.
     *
     * @Route("/{id}/edit", name="news_edit")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, News $news, Anime $anime)
    {
        $deleteForm = $this->createDeleteForm($news);
        $editForm = $this->createForm('AppBundle\Form\NewsType', $news);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('success', 'Modification de ' .$news->getTitle(). ' enregistré');
            return $this->redirectToRoute('news_anime_index', array('id' => $news->getAnime()->getId()));
        }

        return $this->render('news/edit.html.twig', array(
            'news' => $news,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a news entity.
     *
     * @Route("/{id}", name="news_delete")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, News $news)
    {
        $form = $this->createDeleteForm($news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($news);
            $em->flush($news);
            $this->get('session')->getFlashBag()->add('suppression', 'Suppression de ' .$news->getTitle(). ' enregistré');
        }

        return $this->redirectToRoute('news_anime_index', array('id' => $news->getAnime()->getId()));
    }

    /**
     * Creates a form to delete a news entity.
     *
     * @param News $news The news entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(News $news)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array('id' => $news->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /** View products list
     * @Route("/list/1", name="news_index_list_rebase")
     * @Route("/list/{page}", name="news_index_list")
     * @Method("GET")
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function productsListAction($page = 1)
    {
        $newsList = $this->getDoctrine()->getRepository('AppBundle:News')->listIndex($page, 5);
        $pagination = array(
            'page' => $page,
            'route' => 'news_index_list',
            'pages_count' => ceil(count($newsList) / 5),
            'route_params' => array()
        );


        $em = $this->getDoctrine()->getManager();
        $studios = $em->getRepository('AppBundle:Studio')->findAll();

        return $this->render('news/index.html.twig', array(
            'news' => $newsList, 'studios' => $studios, 'from_anime' => false,'pagination' => $pagination, 'ordered' => false,
        ));
    }

}
