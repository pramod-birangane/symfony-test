<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Teams;
use App\Entity\Leagues;
use App\Entity\User;

class ApiController extends AbstractController
{

    public function getAllTeamsInLeague($leagueId) {

      dump($this->getUser()->getUsername());


      $league = $this->getDoctrine()->getRepository(Leagues::class)->getLeagueById($leagueId);
      if(empty($league)){
        return new Response(json_encode(array("response" => "No league found")), 404);
      } else {
        $teams = $this->getDoctrine()->getRepository(Teams::class)->getTeamsByLeagueId($leagueId);
        if(empty($teams)){
          return new Response(json_encode(array("response" => "No team Found")), 404);
        } else {
          $arrTeamNames = [];
          foreach ($teams as $key => $value) {
            $arrTeamNames[] = $value->getName();
          }
          return new Response(json_encode($arrTeamNames), 200);
        }
      }
    }

    public function deleteLeague($leagueId){
      $this->getDoctrine()->getRepository(Leagues::class)->deleteLeague($leagueId);
      return new Response(json_encode(array("response" => "League deleted successfully")), 200);
    }

    public function forbidden()
    {
      return new Response(json_encode(array("response" => "Forbidden")), 403);
    }

}
