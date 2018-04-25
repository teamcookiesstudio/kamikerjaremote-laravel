<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SkillSetCreateRequest;
use App\Http\Requests\SkillSetUpdateRequest;
use App\Repositories\SkillSetRepository;

/**
 * Class SkillSetsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SkillSetsController extends Controller
{
    /**
     * @var SkillSetRepository
     */
    protected $repository;

    /**
     * SkillSetsController constructor.
     *
     * @param SkillSetRepository $repository
     */
    public function __construct(SkillSetRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $skillSets = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $skillSets,
            ]);
        }

        return view('skillSets.index', compact('skillSets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SkillSetCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SkillSetCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $skillSet = $this->repository->create($request->all());

            $response = [
                'message' => 'SkillSet created.',
                'data'    => $skillSet->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $skillSet = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $skillSet,
            ]);
        }

        return view('skillSets.show', compact('skillSet'));
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
        $skillSet = $this->repository->find($id);

        return view('skillSets.edit', compact('skillSet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SkillSetUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SkillSetUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $skillSet = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SkillSet updated.',
                'data'    => $skillSet->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'SkillSet deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SkillSet deleted.');
    }
}
