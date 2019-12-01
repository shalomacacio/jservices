<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TipoUsuarioCreateRequest;
use App\Http\Requests\TipoUsuarioUpdateRequest;
use App\Repositories\TipoUsuarioRepository;
use App\Validators\TipoUsuarioValidator;

/**
 * Class TipoUsuariosController.
 *
 * @package namespace App\Http\Controllers;
 */
class TipoUsuariosController extends Controller
{
    /**
     * @var TipoUsuarioRepository
     */
    protected $repository;

    /**
     * @var TipoUsuarioValidator
     */
    protected $validator;

    /**
     * TipoUsuariosController constructor.
     *
     * @param TipoUsuarioRepository $repository
     * @param TipoUsuarioValidator $validator
     */
    public function __construct(TipoUsuarioRepository $repository, TipoUsuarioValidator $validator)
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
        $tipoUsuarios = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoUsuarios,
            ]);
        }

        return view('tipoUsuarios.index', compact('tipoUsuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoUsuarioCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TipoUsuarioCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipoUsuario = $this->repository->create($request->all());

            $response = [
                'message' => 'TipoUsuario created.',
                'data'    => $tipoUsuario->toArray(),
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
        $tipoUsuario = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoUsuario,
            ]);
        }

        return view('tipoUsuarios.show', compact('tipoUsuario'));
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
        $tipoUsuario = $this->repository->find($id);

        return view('tipoUsuarios.edit', compact('tipoUsuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TipoUsuarioUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TipoUsuarioUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipoUsuario = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TipoUsuario updated.',
                'data'    => $tipoUsuario->toArray(),
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
                'message' => 'TipoUsuario deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TipoUsuario deleted.');
    }
}
