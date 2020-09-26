<?php


namespace App\Controller\Availibilities;

use App\Entity\UserAvailibility;
use App\Repository\UserAvailibilityRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Egulias\EmailValidator\Exception\CharNotAllowed;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateAvailibilitesController
 * @package App\Controller\Availibilities
 */
final class CreateAvailibilitesController extends AbstractController
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

        foreach ($body['form']['form'] as $data => $value) {
            $exist = $this->repository->findOneBy(['day' => $value['day'], "user" => $user]);
            if ($exist) {

                $exist->setMorning($value['morning']);
                $exist->setMidday($value['midday']);
                $exist->setEvening($value['evening']);
                $exist->setNight($value['night']);

                $this->em->persist($exist);

            } else {
                $availibility = new UserAvailibility();
                $availibility->setUser($user);

                $availibility->setMorning($value['morning']);
                $availibility->setMidday($value['midday']);
                $availibility->setEvening($value['evening']);
                $availibility->setNight($value['night']);
                $availibility->setDay($value['day']);

                $this->em->persist($availibility);
            }

        }

        $this->em->flush();

        return $this->json(['result' => $user->getUserAvailibilities()->toArray()]);

    }

}