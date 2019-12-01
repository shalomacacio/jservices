<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TipoComissaoCreateRequest;
use App\Http\Requests\TipoComissaoUpdateRequest;
use App\Repositories\TipoComissaoRepository;
use App\Validators\TipoComissaoValidator;

/**
 * Class TipoComissaosController.
 *
 * @package namespace App\Http\Controllers;
 */
class TipoComissaosController extends Controller
{
    /**
     * @var TipoComissaoRepository
     */
    protected $repository;

    /**
     * @var TipoComissaoValidator
     */
    protected $validator;

    /**
     * TipoComissaosController constructor.
     *
     * @param TipoComissaoRepository $repository
     * @param TipoComissaoValidator $validator
     */
    public function __construct(TipoComissaoRepository $repository, TipoComissaoValidator $validator)
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
        $tipoComissaos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoComissaos,
            ]);
        }

        return view('tipoComissaos.index', compact('tipoComissaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoComissaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TipoComissaoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipoComissao = $this->repository->create($request->all());

            $response = [
                'message' => 'TipoComissao created.',
                'data'    => $tipoComissao->toArray(),
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
        $tipoComissao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoComissao,
            ]);
        }

        return view('tipoComissaos.show', compact('tipoComissao'));
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
        $tipoComissao = $this->repository->find($id);

        return view('tipoComissaos.edit', compact('tipoComissao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TipoComissaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TipoComissaoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipoComissao = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TipoComissao updated.',
                'data'    => $tipoComissao->toArray(),
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
                'message' => 'TipoComissao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TipoComissao deleted.');
    }
}
