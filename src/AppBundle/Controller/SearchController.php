<?php
/**
 * Created by PhpStorm.
 * User: eesan
 * Date: 15/6/18
 * Time: 10:32 PM
 */

namespace AppBundle\Controller;


use Algolia\SearchBundle\IndexManagerInterface;
use EmpBundle\Entity\EduList;
use EmpBundle\Entity\FinList;
use EmpBundle\Entity\JobList;
use EmpBundle\Entity\ReList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    protected $indexManager;

    public function __construct(IndexManagerInterface $indexingManager)
    {
        $this->indexManager = $indexingManager;
    }


    /**
     * @Route("/search", name="search_results")
     * @Method({"GET", "POST"})
     */
    public function searchAction(Request $request)
    {


//        $em = $this->getDoctrine()->getManagerForClass(JobList::class);


        $search = $this->indexManager->rawSearch('query', JobList::class,  2, 50);
//        $search1 = $this->indexManager->rawsearch('query', FinList::class,  2, 50);
//        $search2 = $this->indexManager->rawsearch('query', ReList::class, 2, 50);
//        $search3 = $this->indexManager->rawSearch('query', EduList::class,  2, 50);

//        $queries = [
//        [
//            'indexName' => 'jobList',
//            'query' => $search,
//            'hitsPerPage' => 10
//        ],
//        [
//            'indexName' => 'finList',
//            'query' => $search1,
//            'hitsPerPage' => 10,
//
//        ],
//        [
//            'indexName' => 'reList',
//            'query' => $search2,
//            'hitsPerPage' => 10
//        ],
//
//        [
//            'indexName' => 'eduList',
//            'query' => $search3,
//            'hitsPerPage' => 10
//        ]
//    ];


//        $results = $client->multipleQueries($queries );

        return $this->render('Web/search.html.twig', [
            'result' => $search
        ]);


//        var_dump($results['results']);

    }

}