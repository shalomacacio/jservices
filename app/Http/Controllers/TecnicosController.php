<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TecnicoCreateRequest;
use App\Http\Requests\TecnicoUpdateRequest;
use App\Repositories\TecnicoRepository;
use App\Validators\TecnicoValidator;

/**
 * Class TecnicosController.
 *
 * @package namespace App\Http\Controllers;
 */
class TecnicosController extends Controller
{
    /**
     * @var TecnicoRepository
     */
    protected $repository;

    /**
     * @var TecnicoValidator
     */
    protected $validator;

    /**
     * TecnicosController constructor.
     *
     * @param TecnicoRepository $repository
     * @param TecnicoValidator $validator
     */
    public function __construct(TecnicoRepository $repository, TecnicoValidator $validator)
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
        $tecnicos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tecnicos,
            ]);
        }

        return view('tecnicos.index', compact('tecnicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TecnicoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TecnicoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tecnico = $this->repository->create($request->all());

            $response = [
                'message' => 'Tecnico created.',
                'data'    => $tecnico->toArray(),
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
        $tecnico = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tecnico,
            ]);
        }

        return view('tecnicos.show', compact('tecnico'));
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
        $tecnico = $this->repository->find($id);

        return view('tecnicos.edit', compact('tecnico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TecnicoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TecnicoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tecnico = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Tecnico updated.',
                'data'    => $tecnico->toArray(),
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
                'message' => 'Tecnico deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Tecnico deleted.');
    }
}
