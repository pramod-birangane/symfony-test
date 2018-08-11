<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Teams;
use App\Entity\Leagues;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AuthController extends AbstractController
{

  public function testFunction(Request $request){
    $arr['_username'] = $request->query->get('_username');
    $arr['_password'] = $request->query->get('_password');
    $arr['method'] = $request->getMethod();
    $teams = $this->getDoctrine()->getRepository(Teams::class)->getTeamsByLeagueId(1);
    return json_encode($arr);
  }

    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {

      $username = $request->request->get('_username');
      $password = $request->request->get('_password');

      $user = $this->getDoctrine()->getRepository(User::class)->createUser($username, $password, $encoder);

      return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }    

    public function api($leagueId, Request $request)
    {

      if(!empty($this->getUser()->getUsername())) {

        if(!empty($leagueId)){
          $league = $this->getDoctrine()->getRepository(Leagues::class)->getLeagueById($leagueId);
          if(empty($league)){
            return new Response(json_encode(array("response" => "No league found")), 404);
          }
        } else {
          return new Response(json_encode(array("response" => "Insufficient data")), 401);
        }
        if($request->getMethod() === "GET") {
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
        } elseif ($request->getMethod() === "DELETE" && !empty($leagueId)) {
          $this->getDoctrine()->getRepository(Leagues::class)->deleteLeague($league);
          return new Response(json_encode(array("response" => "League deleted successfully")), 200);
        }
      }
    }

    public function forbidden()
    {
      return new Response(json_encode(array("response" => "Forbidden")), 403);
    }
}
