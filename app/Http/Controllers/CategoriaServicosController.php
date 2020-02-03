<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CategoriaServicoCreateRequest;
use App\Http\Requests\CategoriaServicoUpdateRequest;
use App\Repositories\CategoriaServicoRepository;
use App\Validators\CategoriaServicoValidator;


/**
 * Class CategoriaServicosController.
 *
 * @package namespace App\Http\Controllers;
 */
class CategoriaServicosController extends Controller
{

    /**
     * @var CategoriaServicoRepository
     */
    protected $repository;

    /**
     * @var CategoriaServicoValidator
     */
    protected $validator;

    /**
     * CategoriaServicosController constructor.
     *
     * @param CategoriaServicoRepository $repository
     * @param CategoriaServicoValidator $validator
     */
    public function __construct(CategoriaServicoRepository $repository, CategoriaServicoValidator $validator)
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
        $categoriaServicos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $categoriaServicos,
            ]);
        }

        return view('categoriaServicos.index', compact('categoriaServicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoriaServicoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CategoriaServicoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $categoriaServico = $this->repository->create($request->all());

            $response = [
                'message' => 'CategoriaServicos created.',
                'data'    => $categoriaServico->toArray(),
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
        $categoriaServico = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $categoriaServico,
            ]);
        }

        return view('categoriaServicos.show', compact('categoriaServico'));
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
        $categoriaServico = $this->repository->find($id);

        return view('categoriaServicos.edit', compact('categoriaServico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoriaServicoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CategoriaServicoUpdateRequest $request, $id)
    {
        try {
            // $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $categoriaServico = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'CategoriaServicos updated.',
                'data'    => $categoriaServico->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('categoriaServicos.index')->with('message', $response['message']);
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
                'message' => 'CategoriaServicos deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'CategoriaServicos deleted.');
    }
}
