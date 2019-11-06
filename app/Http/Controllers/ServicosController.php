<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ServicoCreateRequest;
use App\Http\Requests\ServicoUpdateRequest;
use App\Repositories\ServicoRepository;
use App\Validators\ServicoValidator;

/**
 * Class ServicosController.
 *
 * @package namespace App\Http\Controllers;
 */
class ServicosController extends Controller
{
    /**
     * @var ServicoRepository
     */
    protected $repository;

    /**
     * @var ServicoValidator
     */
    protected $validator;

    /**
     * ServicosController constructor.
     *
     * @param ServicoRepository $repository
     * @param ServicoValidator $validator
     */
    public function __construct(ServicoRepository $repository, ServicoValidator $validator)
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
        $servicos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $servicos,
            ]);
        }

        return view('servicos.index', compact('servicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ServicoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ServicoCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $servico = $this->repository->create($request->all());

            $response = [
                'message' => 'Servico created.',
                'data'    => $servico->toArray(),
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
        $servico = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $servico,
            ]);
        }

        return view('servicos.show', compact('servico'));
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
        $servico = $this->repository->find($id);

        return view('servicos.edit', compact('servico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ServicoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ServicoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $servico = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Servico updated.',
                'data'    => $servico->toArray(),
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
                'message' => 'Servico deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Servico deleted.');
    }
}
