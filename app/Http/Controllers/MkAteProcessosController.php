<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MkAteProcessoCreateRequest;
use App\Http\Requests\MkAteProcessoUpdateRequest;
use App\Repositories\MkAteProcessoRepository;
use App\Validators\MkAteProcessoValidator;

/**
 * Class MkAteProcessosController.
 *
 * @package namespace App\Http\Controllers;
 */
class MkAteProcessosController extends Controller
{
    /**
     * @var MkAteProcessoRepository
     */
    protected $repository;

    /**
     * @var MkAteProcessoValidator
     */
    protected $validator;

    /**
     * MkAteProcessosController constructor.
     *
     * @param MkAteProcessoRepository $repository
     * @param MkAteProcessoValidator $validator
     */
    public function __construct(MkAteProcessoRepository $repository, MkAteProcessoValidator $validator)
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
        $mkAteProcessos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkAteProcessos,
            ]);
        }

        return view('mkAteProcessos.index', compact('mkAteProcessos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MkAteProcessoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MkAteProcessoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $mkAteProcesso = $this->repository->create($request->all());

            $response = [
                'message' => 'MkAteProcesso created.',
                'data'    => $mkAteProcesso->toArray(),
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
        $mkAteProcesso = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $mkAteProcesso,
            ]);
        }

        return view('mkAteProcessos.show', compact('mkAteProcesso'));
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
        $mkAteProcesso = $this->repository->find($id);

        return view('mkAteProcessos.edit', compact('mkAteProcesso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MkAteProcessoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MkAteProcessoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $mkAteProcesso = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MkAteProcesso updated.',
                'data'    => $mkAteProcesso->toArray(),
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
                'message' => 'MkAteProcesso deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MkAteProcesso deleted.');
    }
}
