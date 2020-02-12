<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PesquisaSatisfacaoCreateRequest;
use App\Http\Requests\PesquisaSatisfacaoUpdateRequest;
use App\Repositories\PesquisaSatisfacaoRepository;
use App\Validators\PesquisaSatisfacaoValidator;

/**
 * Class PesquisaSatisfacaosController.
 *
 * @package namespace App\Http\Controllers;
 */
class PesquisaSatisfacaosController extends Controller
{
    /**
     * @var PesquisaSatisfacaoRepository
     */
    protected $repository;

    /**
     * @var PesquisaSatisfacaoValidator
     */
    protected $validator;

    /**
     * PesquisaSatisfacaosController constructor.
     *
     * @param PesquisaSatisfacaoRepository $repository
     * @param PesquisaSatisfacaoValidator $validator
     */
    public function __construct(PesquisaSatisfacaoRepository $repository, PesquisaSatisfacaoValidator $validator)
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
        $pesquisaSatisfacaos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pesquisaSatisfacaos,
            ]);
        }

        return view('pesquisaSatisfacaos.index', compact('pesquisaSatisfacaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PesquisaSatisfacaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PesquisaSatisfacaoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $pesquisaSatisfacao = $this->repository->create($request->all());

            $response = [
                'message' => 'PesquisaSatisfacao created.',
                'data'    => $pesquisaSatisfacao->toArray(),
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
        $pesquisaSatisfacao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pesquisaSatisfacao,
            ]);
        }

        return view('pesquisaSatisfacaos.show', compact('pesquisaSatisfacao'));
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
        $pesquisaSatisfacao = $this->repository->find($id);

        return view('pesquisaSatisfacaos.edit', compact('pesquisaSatisfacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PesquisaSatisfacaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PesquisaSatisfacaoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $pesquisaSatisfacao = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PesquisaSatisfacao updated.',
                'data'    => $pesquisaSatisfacao->toArray(),
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
                'message' => 'PesquisaSatisfacao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PesquisaSatisfacao deleted.');
    }
}
