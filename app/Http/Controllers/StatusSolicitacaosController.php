<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\StatusSolicitacaoCreateRequest;
use App\Http\Requests\StatusSolicitacaoUpdateRequest;
use App\Repositories\StatusSolicitacaoRepository;
use App\Validators\StatusSolicitacaoValidator;

/**
 * Class StatusSolicitacaosController.
 *
 * @package namespace App\Http\Controllers;
 */
class StatusSolicitacaosController extends Controller
{
    /**
     * @var StatusSolicitacaoRepository
     */
    protected $repository;

    /**
     * @var StatusSolicitacaoValidator
     */
    protected $validator;

    /**
     * StatusSolicitacaosController constructor.
     *
     * @param StatusSolicitacaoRepository $repository
     * @param StatusSolicitacaoValidator $validator
     */
    public function __construct(StatusSolicitacaoRepository $repository, StatusSolicitacaoValidator $validator)
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
        $statusSolicitacaos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $statusSolicitacaos,
            ]);
        }

        return view('statusSolicitacaos.index', compact('statusSolicitacaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StatusSolicitacaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(StatusSolicitacaoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $statusSolicitacao = $this->repository->create($request->all());

            $response = [
                'message' => 'StatusSolicitacao created.',
                'data'    => $statusSolicitacao->toArray(),
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
        $statusSolicitacao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $statusSolicitacao,
            ]);
        }

        return view('statusSolicitacaos.show', compact('statusSolicitacao'));
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
        $statusSolicitacao = $this->repository->find($id);

        return view('statusSolicitacaos.edit', compact('statusSolicitacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StatusSolicitacaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StatusSolicitacaoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $statusSolicitacao = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'StatusSolicitacao updated.',
                'data'    => $statusSolicitacao->toArray(),
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
                'message' => 'StatusSolicitacao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'StatusSolicitacao deleted.');
    }
}
