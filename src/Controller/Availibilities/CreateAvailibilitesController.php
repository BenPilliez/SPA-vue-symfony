<?php


namespace App\Controller\Availibilities;

use App\Entity\UserAvailibility;
use App\Repository\UserAvailibilityRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Egulias\EmailValidator\Exception\CharNotAllowed;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateAvailibilitesController
 * @package App\Controller\Availibilities
 */
final class CreateAvailibilitesController
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
    public function __invoke(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);

        $user = $this->userRepository->find($body['user_id']);
        $test =['morning'];

        foreach ($body as $data => $value) {
            $availibility = new UserAvailibility();
            $availibility->setUser($user);

            if (array_key_exists('morning', $value)) {
                $availibility->setMorning($value['morning']);
            }
       
            if (array_key_exists('midday', $value)) {
                $availibility->setMidday($value['midday']);

            }

            if (array_key_exists('evening', $value)) {
                $availibility->setEvening($value['evening']);

            }

            if (array_key_exists('night', $value)) {
                $availibility->setNight($value['night']);
            }

            $availibility->setDay($data);
            $this->em->persist($availibility);
        }

        $this->em->flush();

        $userAvailibity = $this->repository->findBy(['user' => $user]);

        return new JsonResponse(['availibility' => $userAvailibity]);

    }

}