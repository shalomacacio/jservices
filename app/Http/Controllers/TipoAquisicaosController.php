<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TipoAquisicaoCreateRequest;
use App\Http\Requests\TipoAquisicaoUpdateRequest;
use App\Repositories\TipoAquisicaoRepository;
use App\Validators\TipoAquisicaoValidator;

/**
 * Class TipoAquisicaosController.
 *
 * @package namespace App\Http\Controllers;
 */
class TipoAquisicaosController extends Controller
{
    /**
     * @var TipoAquisicaoRepository
     */
    protected $repository;

    /**
     * @var TipoAquisicaoValidator
     */
    protected $validator;

    /**
     * TipoAquisicaosController constructor.
     *
     * @param TipoAquisicaoRepository $repository
     * @param TipoAquisicaoValidator $validator
     */
    public function __construct(TipoAquisicaoRepository $repository, TipoAquisicaoValidator $validator)
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
        $tipoAquisicaos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoAquisicaos,
            ]);
        }

        return view('tipoAquisicaos.index', compact('tipoAquisicaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoAquisicaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TipoAquisicaoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipoAquisicao = $this->repository->create($request->all());

            $response = [
                'message' => 'TipoAquisicao created.',
                'data'    => $tipoAquisicao->toArray(),
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
        $tipoAquisicao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoAquisicao,
            ]);
        }

        return view('tipoAquisicao.show', compact('tipoAquisicao'));
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
        $tipoAquisicao = $this->repository->find($id);

        return view('tipoAquisicaos.edit', compact('tipoAquisicao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TipoAquisicaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TipoAquisicaoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipoAquisicao = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TipoAquisicao updated.',
                'data'    => $tipoAquisicao->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('tipoAquisicao.index')->with('message', $response['message']);
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
                'message' => 'TipoAquisicao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TipoAquisicao deleted.');
    }
}
