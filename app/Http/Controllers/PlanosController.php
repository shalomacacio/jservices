<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PlanoCreateRequest;
use App\Http\Requests\PlanoUpdateRequest;
use App\Repositories\PlanoRepository;
use App\Validators\PlanoValidator;

/**
 * Class PlanosController.
 *
 * @package namespace App\Http\Controllers;
 */
class PlanosController extends Controller
{
    /**
     * @var PlanoRepository
     */
    protected $repository;

    /**
     * @var PlanoValidator
     */
    protected $validator;

    /**
     * PlanosController constructor.
     *
     * @param PlanoRepository $repository
     * @param PlanoValidator $validator
     */
    public function __construct(PlanoRepository $repository, PlanoValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $planos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $planos,
            ]);
        }

        return view('planos.index', compact('planos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PlanoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PlanoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $plano = $this->repository->create($request->all());

            $response = [
                'message' => 'Plano created.',
                'data'    => $plano->toArray(),
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
        $plano = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $plano,
            ]);
        }

        return view('planos.show', compact('plano'));
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
        $plano = $this->repository->find($id);

        return view('planos.edit', compact('plano'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PlanoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PlanoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $plano = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Plano updated.',
                'data'    => $plano->toArray(),
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
                'message' => 'Plano deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Plano deleted.');
    }
}
