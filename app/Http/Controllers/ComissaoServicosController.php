<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ComissaoServicoCreateRequest;
use App\Http\Requests\ComissaoServicoUpdateRequest;
use App\Repositories\ComissaoServicoRepository;
use App\Validators\ComissaoServicoValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class ComissaoServicosController.
 *
 * @package namespace App\Http\Controllers;
 */
class ComissaoServicosController extends Controller
{
    /**
     * @var ComissaoServicoRepository
     */
    protected $repository;

    /**
     * @var ComissaoServicoValidator
     */
    protected $validator;

    /**
     * ComissaoServicosController constructor.
     *
     * @param ComissaoServicoRepository $repository
     * @param ComissaoServicoValidator $validator
     */
    public function __construct(ComissaoServicoRepository $repository, ComissaoServicoValidator $validator)
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
        $comissaoServicos = $this->repository->all();
        $tipoComissaos = DB::table('tipo_comissaos')->get();
        $servicos = DB::table('servicos')->get();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $comissaoServicos,
            ]);
        }

        return view('comissaoServicos.index', compact('comissaoServicos', 'tipoComissaos', 'servicos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ComissaoServicoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ComissaoServicoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $comissaoServico = $this->repository->create($request->all());

            $response = [
                'message' => 'ComissaoServico created.',
                'data'    => $comissaoServico->toArray(),
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
        $comissaoServico = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $comissaoServico,
            ]);
        }

        return view('comissaoServicos.show', compact('comissaoServico'));
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
        $comissaoServico = $this->repository->find($id);
        $tipoComissaos = DB::table('tipo_comissaos')->get();
        $servicos = DB::table('servicos')->get();

        return view('comissaoServicos.edit', compact('comissaoServico', 'tipoComissaos','servicos' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ComissaoServicoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ComissaoServicoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $comissaoServico = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ComissaoServico updated.',
                'data'    => $comissaoServico->toArray(),
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
                'message' => 'ComissaoServico deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ComissaoServico deleted.');
    }
}
