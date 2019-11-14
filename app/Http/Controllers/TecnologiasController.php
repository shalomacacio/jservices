<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TecnologiaCreateRequest;
use App\Http\Requests\TecnologiaUpdateRequest;
use App\Repositories\TecnologiaRepository;
use App\Validators\TecnologiaValidator;

/**
 * Class TecnologiasController.
 *
 * @package namespace App\Http\Controllers;
 */
class TecnologiasController extends Controller
{
    /**
     * @var TecnologiaRepository
     */
    protected $repository;

    /**
     * @var TecnologiaValidator
     */
    protected $validator;

    /**
     * TecnologiasController constructor.
     *
     * @param TecnologiaRepository $repository
     * @param TecnologiaValidator $validator
     */
    public function __construct(TecnologiaRepository $repository, TecnologiaValidator $validator)
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
        $tecnologias = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tecnologias,
            ]);
        }

        return view('tecnologias.index', compact('tecnologias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TecnologiaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TecnologiaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tecnologium = $this->repository->create($request->all());

            $response = [
                'message' => 'Tecnologia created.',
                'data'    => $tecnologium->toArray(),
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
        $tecnologium = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tecnologium,
            ]);
        }

        return view('tecnologias.show', compact('tecnologium'));
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
        $tecnologium = $this->repository->find($id);

        return view('tecnologias.edit', compact('tecnologium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TecnologiaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TecnologiaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tecnologium = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Tecnologia updated.',
                'data'    => $tecnologium->toArray(),
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
                'message' => 'Tecnologia deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Tecnologia deleted.');
    }
}
