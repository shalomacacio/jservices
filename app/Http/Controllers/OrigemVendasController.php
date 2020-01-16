<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrigemVendaCreateRequest;
use App\Http\Requests\OrigemVendaUpdateRequest;
use App\Repositories\OrigemVendaRepository;
use App\Validators\OrigemVendaValidator;

/**
 * Class OrigemVendasController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrigemVendasController extends Controller
{
    /**
     * @var OrigemVendaRepository
     */
    protected $repository;

    /**
     * @var OrigemVendaValidator
     */
    protected $validator;

    /**
     * OrigemVendasController constructor.
     *
     * @param OrigemVendaRepository $repository
     * @param OrigemVendaValidator $validator
     */
    public function __construct(OrigemVendaRepository $repository, OrigemVendaValidator $validator)
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
        $origemVendas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $origemVendas,
            ]);
        }

        return view('origemVendas.index', compact('origemVendas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrigemVendaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrigemVendaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $origemVenda = $this->repository->create($request->all());

            $response = [
                'message' => 'OrigemVenda created.',
                'data'    => $origemVenda->toArray(),
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
        $origemVenda = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $origemVenda,
            ]);
        }

        return view('origemVendas.show', compact('origemVenda'));
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
        $origemVenda = $this->repository->find($id);

        return view('origemVendas.edit', compact('origemVenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrigemVendaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrigemVendaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $origemVenda = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrigemVenda updated.',
                'data'    => $origemVenda->toArray(),
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
                'message' => 'OrigemVenda deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrigemVenda deleted.');
    }
}
