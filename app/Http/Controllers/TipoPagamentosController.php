<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TipoPagamentoCreateRequest;
use App\Http\Requests\TipoPagamentoUpdateRequest;
use App\Repositories\TipoPagamentoRepository;
use App\Validators\TipoPagamentoValidator;

/**
 * Class TipoPagamentosController.
 *
 * @package namespace App\Http\Controllers;
 */
class TipoPagamentosController extends Controller
{
    /**
     * @var TipoPagamentoRepository
     */
    protected $repository;

    /**
     * @var TipoPagamentoValidator
     */
    protected $validator;

    /**
     * TipoPagamentosController constructor.
     *
     * @param TipoPagamentoRepository $repository
     * @param TipoPagamentoValidator $validator
     */
    public function __construct(TipoPagamentoRepository $repository, TipoPagamentoValidator $validator)
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
        $tipoPagamentos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoPagamentos,
            ]);
        }

        return view('tipoPagamentos.index', compact('tipoPagamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TipoPagamentoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TipoPagamentoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tipoPagamento = $this->repository->create($request->all());

            $response = [
                'message' => 'TipoPagamento created.',
                'data'    => $tipoPagamento->toArray(),
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
        $tipoPagamento = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tipoPagamento,
            ]);
        }

        return view('tipoPagamentos.show', compact('tipoPagamento'));
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
        $tipoPagamento = $this->repository->find($id);

        return view('tipoPagamentos.edit', compact('tipoPagamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TipoPagamentoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TipoPagamentoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tipoPagamento = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TipoPagamento updated.',
                'data'    => $tipoPagamento->toArray(),
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
                'message' => 'TipoPagamento deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TipoPagamento deleted.');
    }
}
