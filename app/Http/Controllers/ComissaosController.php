<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ComissaoCreateRequest;
use App\Http\Requests\ComissaoUpdateRequest;
use App\Repositories\ComissaoRepository;
use App\Validators\ComissaoValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class ComissaosController.
 *
 * @package namespace App\Http\Controllers;
 */
class ComissaosController extends Controller
{
    /**
     * @var ComissaoRepository
     */
    protected $repository;

    /**
     * @var ComissaoValidator
     */
    protected $validator;

    /**
     * ComissaosController constructor.
     *
     * @param ComissaoRepository $repository
     * @param ComissaoValidator $validator
     */
    public function __construct(ComissaoRepository $repository, ComissaoValidator $validator)
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
        $comissaos = $this->repository->all();
        $tipoComissaos = DB::table('tipo_comissaos')->get();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $comissaos,
            ]);
        }

        return view('comissaos.index', compact('comissaos', 'tipoComissaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ComissaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ComissaoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $comissao = $this->repository->create($request->all());

            $response = [
                'message' => 'Comissao created.',
                'data'    => $comissao->toArray(),
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
        $comissao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $comissao,
            ]);
        }

        return view('comissaos.show', compact('comissao'));
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
        $comissao = $this->repository->find($id);
        $tipoComissaos = DB::table('tipo_comissaos')->get();

        return view('comissaos.edit', compact('comissao', 'tipoComissaos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ComissaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ComissaoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $comissao = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Comissao updated.',
                'data'    => $comissao->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('comissaos.index')->with('message', $response['message']);
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
                'message' => 'Comissao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Comissao deleted.');
    }
}
