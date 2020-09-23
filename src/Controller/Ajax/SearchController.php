<?php


namespace App\Controller\Ajax;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class searchController
 * @package App\Controller\Ajax
 * @Route("/search")
 */
class SearchController extends AbstractController
{
    private $client;

    /**
     * searchController constructor.
     * @param HttpClientInterface $client
     */

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @Route("/mapbox")
     */
    public function Mapbox(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);

        $option = $body['option'] === 'place' ? 'place' : 'country';

        $response = $this->client->request(
            'GET',
            'https://api.mapbox.com/geocoding/v5/mapbox.places/' . $body['search'] . '.json',
            ['query' => [
                'types' => $option,
                'access_token' => $_ENV['MAPBOX']]
            ]
        );


        try {
            return new JsonResponse($response->toArray(), Response::HTTP_OK);
        } catch (ClientExceptionInterface $e) {
        } catch (DecodingExceptionInterface $e) {
        } catch (RedirectionExceptionInterface $e) {
        } catch (ServerExceptionInterface $e) {
        } catch (TransportExceptionInterface $e) {
        }

        return new JsonResponse($response->toArray());

    }

}