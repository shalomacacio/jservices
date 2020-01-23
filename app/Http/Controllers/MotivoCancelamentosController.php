<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MotivoCancelamentoCreateRequest;
use App\Http\Requests\MotivoCancelamentoUpdateRequest;
use App\Repositories\MotivoCancelamentoRepository;
use App\Validators\MotivoCancelamentoValidator;

/**
 * Class MotivoCancelamentosController.
 *
 * @package namespace App\Http\Controllers;
 */
class MotivoCancelamentosController extends Controller
{
    /**
     * @var MotivoCancelamentoRepository
     */
    protected $repository;

    /**
     * @var MotivoCancelamentoValidator
     */
    protected $validator;

    /**
     * MotivoCancelamentosController constructor.
     *
     * @param MotivoCancelamentoRepository $repository
     * @param MotivoCancelamentoValidator $validator
     */
    public function __construct(MotivoCancelamentoRepository $repository, MotivoCancelamentoValidator $validator)
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
        $motivoCancelamentos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $motivoCancelamentos,
            ]);
        }

        return view('motivoCancelamentos.index', compact('motivoCancelamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MotivoCancelamentoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MotivoCancelamentoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $motivoCancelamento = $this->repository->create($request->all());

            $response = [
                'message' => 'MotivoCancelamento created.',
                'data'    => $motivoCancelamento->toArray(),
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
        $motivoCancelamento = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $motivoCancelamento,
            ]);
        }

        return view('motivoCancelamentos.show', compact('motivoCancelamento'));
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
        $motivoCancelamento = $this->repository->find($id);

        return view('motivoCancelamentos.edit', compact('motivoCancelamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MotivoCancelamentoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MotivoCancelamentoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $motivoCancelamento = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'MotivoCancelamento updated.',
                'data'    => $motivoCancelamento->toArray(),
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
                'message' => 'MotivoCancelamento deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'MotivoCancelamento deleted.');
    }
}
