<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TipoMidiaCreateRequest;
use App\Http\Requests\TipoMidiaUpdateRequest;
use App\Repositories\TipoMidiaRepository;
use App\Validators\TipoMidiaValidator;

/**
 * Class TipoMidiasController.
 *
 * @package namespace App\Http\Controllers;
 */
class TipoMidiasController extends Controller
{
    /**
     * @var TipoMidiaRepository
     */
    protected $repository;

    /**
     * @var TipoMidiaValidator
     */
    protected $validator;

    /**
     * TipoMidiasController constructor.
     *
     * @param TipoMidiaRepository $repository
     * @param TipoMidiaValidator $validator
     */
    public function __construct(TipoMidiaRepository $repository, TipoMidiaValidator $validator)
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
        $tipoMidias = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoMidias,
            ]);
        }

        return view('tipoMidias.index', compact('tipoMidias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoMidiaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TipoMidiaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipoMidium = $this->repository->create($request->all());

            $response = [
                'message' => 'TipoMidia created.',
                'data'    => $tipoMidium->toArray(),
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
        $tipoMidium = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoMidium,
            ]);
        }

        return view('tipoMidias.show', compact('tipoMidium'));
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
        $tipoMidium = $this->repository->find($id);

        return view('tipoMidias.edit', compact('tipoMidium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TipoMidiaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TipoMidiaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipoMidium = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TipoMidia updated.',
                'data'    => $tipoMidium->toArray(),
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
                'message' => 'TipoMidia deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TipoMidia deleted.');
    }
}
