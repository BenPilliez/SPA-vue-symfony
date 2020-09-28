<?php


namespace App\Controller\Availibilities;

use App\Entity\UserAvailibility;
use App\Repository\UserAvailibilityRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateAvailibilitesController
 * @package App\Controller\Availibilities
 */
final class EditAvailibilitesController extends AbstractController
{
    /**
     * @var UserAvailibilityRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * CreateAvailibilitesController constructor.
     * @param UserAvailibilityRepository $availibilityRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(UserRepository $userRepository, UserAvailibilityRepository $availibilityRepository, EntityManagerInterface $em)
    {
        $this->repository = $availibilityRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */

    /**
     * @Route(
     *     name="availibility_update",
     *     path="/api/user_availibilities/{id}",
     *     methods={"PUT"},
     *     defaults={
     *         "_api_resource_class"=UserAvailibility::class,
     *         "_api_item_operation_name"="update_availibilities"
     *     }
     * )
     */
    public function update(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);
        $user = $this->userRepository->find($body['user_id']);

        foreach ($body['form']['form'] as $data => $value) {

            /*$userAvaibility = $this->repository->findOneBy(['user' => $user, 'day' => $value['day']]);

            $userAvaibility->setMorning($value['morning']);
            $userAvaibility->setMidday($value['midday']);
            $userAvaibility->setEvening($value['evening']);
            $userAvaibility->setNight($value['night']);

            $this->em->persist($userAvaibility);*/

        }

        $this->em->flush();

        return $this->json(['result' => $user->getUserAvailibilities()->toArray()]);

    }

}