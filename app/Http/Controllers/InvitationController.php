<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvitationRequest;
use App\Mail\InvitationSend;
use App\Repositories\InvitationRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class InvitationController
 *
 * @package App\Http\Controllers
 */
class InvitationController extends Controller
{
    use ResponseTrait;

    /**
     * @var InvitationRepository
     */
    private $invitationRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * InvitationController constructor.
     *
     * @param InvitationRepository $invitationRepository
     * @param UserRepository       $userRepository
     * @param ProjectRepository    $projectRepository
     */
    public function __construct(InvitationRepository $invitationRepository, UserRepository $userRepository, ProjectRepository $projectRepository)
    {
        $this->invitationRepository = $invitationRepository;
        $this->userRepository       = $userRepository;
        $this->projectRepository    = $projectRepository;
    }

    /**
     * @param CreateInvitationRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function send(CreateInvitationRequest $request)
    {
        $data = $request->validated();
        do {
            $token = Str::random();
        } while ($this->invitationRepository->findWhere(['token' => $token])->first());

        $data['token'] = $token;
        $invitation    = $this->invitationRepository->create($data);

        Mail::to($data['email'])->send(new InvitationSend($request->user(), $invitation));

        return $this->json('Email Sent');
    }

    /**
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function accept(string $token)
    {
        $invitation = $this->invitationRepository->findWhere(['token' => $token])->first();
        $user       = $this->userRepository->findWhere(['email' => $invitation->email])->first();

        if (is_null($user)) {

            return $this->json('You need to register');
        }

        $project = $this->projectRepository->find($invitation->project_id);
        $project->users()->save($user);
        $invitation->delete();

        return $this->json('Successfully join the project');
    }
}
