<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;
use App\Http\Requests\ProfileCreateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\ProfileRepository;
use App\Repositories\SkillSetRepository;
use App\Repositories\UserRepository;
use App\Http\Traits\TraitController;

/**
 * Class ProfilesController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProfilesController extends Controller
{
    use TraitController;

    /**
     * @var SkillSetRepository
     */
    protected $SkillSetRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var ProfileRepository
     */
    protected $profileRepository;

    /**
     * ProfilesController constructor.
     *
     * @param ProfileRepository $repository
     * @param ProfileValidator $validator
     */
    public function __construct(
            ProfileRepository $profileRepository,
            SkillSetRepository $SkillSetRepository,
            UserRepository $userRepository
        )
    {
        $this->userRepository = $userRepository;
        $this->SkillSetRepository = $SkillSetRepository;
        $this->profileRepository = $profileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfileCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProfileCreateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        foreach ($request->skill_set_name as $value) {

            $skillset[] = $this->SkillSetRepository->firstOrCreate(['skill_set_name' => $value])->id;
        }

        $this->userRepository->update($request->only('first_name', 'last_name'), $id);
        
        $profile = $this->profileRepository->firstOrCreate(['member_id' => $id]);

        $profile->update($request->only('occupation', 'location', 'summary', 'website'));

        $profile->skillsets()->sync($skillset);

        $attributes = array(
            'url_photo_profile' => $profile->url_photo_profile, 
            'image_header' => $profile->image_header
        );
        
        $this->insertImage($request, $profile, $attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
